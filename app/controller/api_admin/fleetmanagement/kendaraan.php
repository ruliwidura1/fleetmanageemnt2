<?php
class Kendaraan extends JI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lib("seme_purifier");
        $this->load('a_vehicle_concern');
        $this->load("api_admin/a_vehicle_model", 'avm');
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_kendaraan';
    }

    public function index()
    {
        $d = $this->__init();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;

        $draw = $this->input->post("draw");
        $sval = $this->input->post("search");
        $sSearch = $this->input->post("sSearch");
        $utype = $this->input->post("utype", '');
        $sEcho = $this->input->post("sEcho");
        $page = $this->input->post("iDisplayStart");
        $pagesize = $this->input->post("iDisplayLength");

        $iSortCol_0 = $this->input->post("iSortCol_0");
        $sSortDir_0 = $this->input->post("sSortDir_0");

        $sortCol = "date";
        $sortDir = strtoupper($sSortDir_0);
        if (empty($sortDir)) $sortDir = "DESC";
        if (strtolower($sortDir) != "desc") {
            $sortDir = "ASC";
        }

        $tbl_as = $this->avm->tbl_as;

        switch ($iSortCol_0) {
            case 0:
                $sortCol = "$tbl_as.id";
                break;
            case 1:
                $sortCol = "$tbl_as.nama";
                break;
            case 2:
                $sortCol = "$tbl_as.utype";
                break;
            case 3:
                $sortCol = "$tbl_as.no_pol";
                break;
            case 4:
                $sortCol = "$tbl_as.merk";
                break;
            case 5:
                $sortCol = "$tbl_as.warna";
                break;
            case 6:
                $sortCol = "$tbl_as.kapasitas_mesin";
                break;
            case 7:
                $sortCol = "$tbl_as.kapasitas_angkutan";
                break;
            case 8:
                $sortCol = "$tbl_as.availability";
                break;
            case 9:
                $sortCol = "$tbl_as.is_active";
                break;
            default:
                $sortCol = "$tbl_as.id";
        }

        if (empty($draw)) $draw = 0;
        if (empty($pagesize)) $pagesize = 10;
        if (empty($page)) $page = 0;

        $keyword = $sSearch;

        $this->status = 200;
        $this->message = 'Berhasil';
        $dcount = $this->avm->countAll($keyword, $utype);
        $ddata = $this->avm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $utype);

        foreach ($ddata as &$gd) {
            if (isset($gd->nama)) {
                $gd->nama = htmlentities(rtrim($gd->nama, ' - '));
            }
            if (isset($gd->is_active)) {
                if (!empty($gd->is_active)) {
                    $gd->is_active = '<label class="label label-success">Aktif</label>';
                } else {
                    $gd->is_active = '<label class="label label-default">Tidak Aktif</label>';
                }
            }
        }

        $this->__jsonDataTable($ddata, $dcount);
    }

    // public function get_data()
    // {
    //     $d = $this->__init();
    //     $data = array();
    //     if (!$this->admin_login) {
    //         $this->status = 400;
    //         $this->message = 'Harus login';
    //         header("HTTP/1.0 400 Harus login");
    //         $this->__json_out($data);
    //         die();
    //     }
    //     $pengguna = $d['sess']->admin;

    //     $draw = $this->input->post("draw");
    //     $sval = $this->input->post("search");
    //     $sSearch = $this->input->post("sSearch");
    //     $sEcho = $this->input->post("sEcho");
    //     $page = $this->input->post("iDisplayStart");
    //     $pagesize = $this->input->post("iDisplayLength");

    //     $iSortCol_0 = $this->input->post("iSortCol_0");
    //     $sSortDir_0 = $this->input->post("sSortDir_0");


    //     $sortCol = "date";
    //     $sortDir = strtoupper($sSortDir_0);
    //     if (empty($sortDir)) $sortDir = "DESC";
    //     if (strtolower($sortDir) != "desc") {
    //         $sortDir = "ASC";
    //     }

    //     switch ($iSortCol_0) {
    //         case 0:
    //             $sortCol = "id";
    //             break;
    //         case 1:
    //             $sortCol = "nama";
    //             break;
    //         default:
    //             $sortCol = "id";
    //     }

    //     if (empty($draw)) $draw = 0;
    //     if (empty($pagesize)) $pagesize = 10;
    //     if (empty($page)) $page = 0;

    //     $keyword = $sSearch;

    //     $this->status = 200;
    //     $this->message = 'Berhasil';
    //     $dcount = $this->avm->countAll($page, $pagesize, $sortCol, $sortDir, $keyword);
    //     $ddata = $this->avm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword);

    //     foreach ($ddata as &$gd) {
    //         if (isset($gd->is_active)) {
    //             if (!empty($gd->is_active)) {
    //                 $gd->is_active = 'Aktif';
    //             } else {
    //                 $gd->is_active = 'Tidak Aktif';
    //             }
    //         }
    //     }

    //     $data['kendaraan'] = $ddata;
    //     //sleep(3);
    //     $this->__json_out($data);
    // }

    public function baru()
    {
        $d = $this->__init();

        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;

        $di = $_POST;
        foreach ($di as $key => &$val) {
            if (is_string($val)) {
                if ($key == 'deskripsi') {
                    $val = $this->seme_purifier->richtext($val);
                } else {
                    $val = $this->__f($val);
                }
            }
        }
        if (!isset($di['nama'])) $di['nama'] = "";
        if (strlen($di['nama']) <= 0) {
            $this->status = 101;
            $this->message = 'Diperlukan satu atau lebih paramater';
            $this->__json_out($data);
            die();
        }
        $this->avm->trans_start();
        $avm_id = $this->avm->getLastId();

        $di['id'] = $avm_id;
        $res = $this->avm->set($di);
        if ($res) {
            $this->avm->trans_commit();
            $this->status = 200;
            $this->message = 'Data baru berhasil ditambahkan';
        } else {
            $this->status = 110;
            $this->message = 'Gagal menambahkan data baru';
            $this->avm->trans_rollback();
        }
        $this->avm->trans_end();
        $this->__json_out($data);
    }

    public function detail($id)
    {
        $id = (int) $id;
        $d = $this->__init();
        $data = array();
        if (!$this->admin_login && empty($id)) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;

        $this->status = 200;
        $this->message = 'Berhasil';
        $data = $this->avm->id($id);
        if (!isset($data->id)) {
            $data = new stdClass();
            $this->status = 441;
            $this->message = 'No Data';
            $this->__json_out($data);
            die();
        }
        $this->__json_out($data);
    }

    public function edit($id)
    {
        $d = $this->__init();
        $data = array();

        $id = (int) $id;
        if ($id <= 0) {
            $this->status = 444;
            $this->message = 'Invalid Kendaraan ID';
            $this->__json_out($data);
            die();
        }

        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;


        $du = $_POST;

        if (isset($du['id'])) unset($du['id']);
        if (!isset($du['nama'])) $du['nama'] = "";
        if (strlen($du['nama']) <= 0) {
            $this->status = 110;
            $this->message = 'Nama harus diisi';
            $this->__json_out($data);
            die();
        }

        $res = $this->avm->update($id, $du);
        if ($res) {
            $this->status = 200;
            $this->message = 'Success';
        } else {
            $this->status = 901;
            $this->message = 'Tidak dapat menambahkan data kendaraan';
        }
        $this->__json_out($data);
    }

    public function hapus($id)
    {
        $id = (int) $id;
        $d = $this->__init();
        $data = array();
        if ($id <= 0) {
            $this->status = 500;
            $this->message = 'Invalid ID';
            $this->__json_out($data);
            die();
        }
        if (!$this->admin_login && empty($id)) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;

        $avm = $this->avm->id($id);
        if (!isset($avm->id)) {
            $this->status = 520;
            $this->message = 'ID tidak ditemukan atau telah dihapus';
            $this->__json_out($data);
            die();
        }
        $res = $this->avm->del($id);
        if ($res) {
            $this->status = 200;
            $this->message = 'Berhasil';
        } else {
            $this->status = 902;
            $this->message = 'Tidak dapat menghapus data kendaraan';
        }
        $this->__json_out($data);
    }

    public function statistik()
    {
        $d = $this->__init();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $utype = $this->input->post('utype');
        $statistik = array();
        $statistik['tersedia'] = $this->avm->countByStatus('Tersedia', $utype);
        $statistik['digunakan'] = $this->avm->countByStatus('Digunakan', $utype);
        $statistik['diperbaiki'] = $this->avm->countByStatus('Diperbaiki', $utype);

        $this->status = 200;
        $this->message = 'Berhasil';
        $data = $statistik;
        $this->__json_out($data);
    }

    public function cari()
    {
        $keyword = $this->input->request("keyword");
        if (empty($keyword)) $keyword = "";
        $data = $this->avm->getSearch($keyword);
        $this->__json_select2($data);
    }
}