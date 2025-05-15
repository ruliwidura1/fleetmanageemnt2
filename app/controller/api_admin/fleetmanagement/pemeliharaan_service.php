<?php
class Pemeliharaan_Service extends JI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lib("seme_purifier");
        $this->load("api_admin/a_pemeliharaan_service_model", 'apsm');

        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_pemeliharaan_service';
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
        $is_active = $this->input->post("is_active", '');
        $sEcho = $this->input->post("sEcho");
        $page = $this->input->post("iDisplayStart");
        $pagesize = $this->input->post("iDisplayLength");

        $iSortCol_0 = $this->input->post("iSortCol_0");
        $sSortDir_0 = $this->input->post("sSortDir_0");

        $sdate = $this->input->request("sdate");
        $edate = $this->input->request("edate");

        if (strlen($sdate) == 10 && strlen($edate) == 10) {
            $sdate = date("Y-m-d", strtotime($sdate));
            $edate = date("Y-m-d", strtotime($edate));
        } else if (strlen($sdate) == 10 && strlen($edate) != 10) {
            $sdate = date("Y-m-d", strtotime($sdate));
            $edate = $sdate;
        } else if (strlen($sdate) != 10 && strlen($edate) == 10) {
            $edate = date("Y-m-d", strtotime($edate));
            $sdate = $edate;
        }

        $sortCol = "id";
        $sortDir = strtoupper($sSortDir_0);
        if (empty($sortDir)) $sortDir = "DESC";
        if (strtolower($sortDir) != "desc") {
            $sortDir = "ASC";
        }

        switch ($iSortCol_0) {
            case 0:
                $sortCol = "id";
                break;
            case 1:
                $sortCol = "cdate";
                break;
            case 2:
                $sortCol = "jenis_kendaraan";
                break;
            case 3:
                $sortCol = "deskripsi_kerusakan";
                break;
            case 4:
                $sortCol = "tindakan_perbaikan";
                break;
            case 5:
                $sortCol = "biaya_perbaikan";
                break;
            case 6:
                $sortCol = "is_active";
                break;
            default:
                $sortCol = "id";
        }

        if (empty($draw)) $draw = 0;
        if (empty($pagesize)) $pagesize = 10;
        if (empty($page)) $page = 0;

        $keyword = $sSearch;

        $this->status = 200;
        $this->message = 'Berhasil';
        $dcount = $this->apsm->countAll($keyword, $is_active, $sdate, $edate);
        $ddata = $this->apsm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $is_active, $sdate, $edate);

        foreach ($ddata as &$gd) {
            if (isset($gd->jumlah_muatan) && isset($gd->satuan)) {
                $gd->jumlah_muatan .= ' '.$gd->satuan;
            }
            if (isset($gd->tindakan_perbaikan)) {
                $gd->tindakan_perbaikan .= ' Kg';
            }
            if (isset($gd->is_active)) {
                $gd->is_active = !empty($gd->is_active)
                    ? '<label class="label label-success">Aktif</label>'
                    : '<label class="label label-default">Tidak Aktif</label>';
            }
            if (isset($gd->kapasitas_kendaraan)) {
                if ($gd->kapasitas_kendaraan == 1) {
                    $gd->kapasitas_kendaraan = '<label class="label label-info">Sesuai</label>';
                } elseif ($gd->kapasitas_kendaraan == 2) {
                    $gd->kapasitas_kendaraan = '<label class="label label-warning">Kurang</label>';
                } elseif ($gd->kapasitas_kendaraan == 3) {
                    $gd->kapasitas_kendaraan = '<label class="label label-danger">Lebih</label>';
                }
            }
        }

        $this->__jsonDataTable($ddata, $dcount);
    }

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

        if (isset($di['a_vehicle_id'])) {
            $combined_value = explode(' - ', $di['a_vehicle_id']);
            if (count($combined_value) == 2) {
                $di['a_vehicle_utype'] = $combined_value[0];
                $di['a_vehicle_no_pol'] = $combined_value[1];
            } else {
                $di['a_vehicle_utype'] = '';
                $di['a_vehicle_no_pol'] = '';
            }
        }

        if (!isset($di['cdate'])) $di['cdate'] = "";
        if (!isset($di['b_driver_id'])) $di['b_driver_id'] = "";
        if (!isset($di['jenis_kendaraan'])) $di['jenis_kendaraan'] = "";
        if (!isset($di['tanggal_perbaikan'])) $di['tanggal_perbaikan'] = "";
        if (!isset($di['deskripsi_kerusakan'])) $di['deskripsi_kerusakan'] = "";
        if (!isset($di['tindakan_perbaikan'])) $di['tindakan_perbaikan'] = "";
        if (!isset($di['biaya_perbaikan'])) $di['biaya_perbaikan'] = "";

        if (strlen($di['cdate']) > 1 && strlen($di['b_driver_id']) > 1 && strlen($di['a_vehicle_id']) > 1 && strlen($di['jumlah_muatan']) > 1 && strlen($di['berat']) > 1 && strlen($di['kapasitas_kendaraan']) > 1) {
            $this->status = 101;
            $this->message = 'Diperlukan satu atau lebih paramater';
            $this->__json_out($data);
            die();
        }
        $this->apsm->trans_start();
        $apsm_id = $this->apsm->getLastId();

        $res = $this->apsm->set($di);
        if ($res) {
            $this->apsm->trans_commit();
            $this->status = 200;
            $this->message = 'Data baru berhasil ditambahkan';
        } else {
            $this->status = 110;
            $this->message = 'Gagal menambahkan data baru';
            $this->apsm->trans_rollback();
        }
        $this->apsm->trans_end();
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
        $data = $this->apsm->id($id);
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
            $this->message = 'Invalid Muatan ID';
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

        if (isset($du['a_vehicle_id'])) {
            $combined_value = explode(' - ', $du['a_vehicle_id']);
            if (count($combined_value) == 2) {
                $du['a_vehicle_utype'] = $combined_value[0];
                $du['a_vehicle_no_pol'] = $combined_value[1];
            } else {
                $du['a_vehicle_utype'] = '';
                $du['a_vehicle_no_pol'] = '';
            }
        }

        if (isset($du['id'])) {
            unset($du['id']);
        }

        if ($id > 0) {
            $res = $this->apsm->update($id, $du);
            if ($res) {
                $this->status = 200;
                $this->message = 'Perubahan berhasil diterapkan';
            } else {
                $this->status = 901;
                $this->message = 'Tidak dapat melakukan perubahan ke basis data';
            }
        } else {
            $this->status = 448;
            $this->message = 'ID Tidak ditemukan';
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

        $apsm = $this->apsm->id($id);
        if (!isset($apsm->id)) {
            $this->status = 520;
            $this->message = 'ID tidak ditemukan atau telah dihapus';
            $this->__json_out($data);
            die();
        }
        $res = $this->apsm->del($id);
        if ($res) {
            $this->status = 200;
            $this->message = 'Berhasil';
        } else {
            $this->status = 902;
            $this->message = 'Tidak dapat menghapus data muatan';
        }
        $this->__json_out($data);
    }

    public function cari()
    {
        $keyword = $this->input->request("keyword");
        if (empty($keyword)) $keyword = "";
        $data = $this->apsm->getSearch($keyword);
        $this->__json_select2($data);
    }
}
