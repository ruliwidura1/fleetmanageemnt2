<?php

/**
 * Controller untuk Bensin
 *
 * @version 1.0.0
 *
 * @package FleetManagement\Api_Admin
 * @since 1.0.0
 */
class Bahanbakar extends \JI_Controller
{
    var $is_email = 1;
    public function __construct()
    {
        parent::__construct();
        $this->load("api_admin/b_bensin_model", 'bbm');
        $this->load('a_vehicle_concern');
        $this->load("api_admin/a_vehicle_model", "avm");
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_bahanbakar';
    }
    public function index()
    {
        $d = $this->initialize();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $draw = $this->input->post("draw");
        $sval = $this->input->post("search");
        $sSearch = $this->input->post("sSearch");
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
                $sortCol = "a_vechicle_id";
                break;
            case 2:
                $sortCol = "tgl_beli";
                break;
            case 3:
                $sortCol = "jenis";
                break;
            case 4:
                $sortCol = "driver";
                break;
            case 5:
                $sortCol = "jumlah_beli";
                break;
            case 6:
                $sortCol = "harga";
                break;
            case 7:
                $sortCol = "total_harga";
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
        $dcount = $this->bbm->countAll($keyword);
        $ddata = $this->bbm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword);

        foreach ($ddata as $dt) {
            $jumlah_beli = isset($dt->jumlah_beli) ? $dt->jumlah_beli : 0;
            $harga = isset($dt->harga) ? $dt->harga : 0;
            $dt->total_harga = $jumlah_beli * $harga;
            
            if (isset($dt->harga)) {
                $dt->harga = 'Rp' . number_format($dt->harga);
            }
            if (isset($dt->total_harga)) {
                $dt->total_harga = 'Rp' . number_format($dt->total_harga);
            }
            if (isset($dt->kapasitas)) {
                $dt->kapasitas .= ' Liter';
            }
            if (isset($dt->jumlah_beli)) {
                $dt->jumlah_beli .= ' Liter';
            }
            if (isset($dt->is_active)) {
                if (!empty($dt->is_active)) {
                    $dt->is_active = '<label class="label label-success">Aktif</label>';
                } else {
                    $dt->is_active = '<label class="label label-default">Tidak Aktif</label>';
                }
            }
        }

        $this->__jsonDataTable($ddata, $dcount);
    }
    public function tambah()
    {
        $d = $this->initialize();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $di = $_POST;
        foreach ($di as $k => $v) {
            $di[$k] = strip_tags($v);
        }

        $res = $this->bbm->set($di);
        if ($res) {
            $this->status = 200;
            $this->message = 'Data baru berhasil ditambahkan';
        } else {
            $this->status = 900;
            $this->message = 'Tidak dapat menyimpan data baru, silakan coba beberapa saat lagi';
        }
        $this->__json_out($data);
    }

    public function detail($id)
    {
        $id = (int) $id;
        $d = $this->initialize();
        $data = array();
        if (!$this->admin_login && empty($id)) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $this->status = 200;
        $this->message = 'Berhasil';
        $data = $this->bbm->getById($id);
        $this->__json_out($data);
    }

    public function edit($id)
    {
        $d = $this->initialize();
        $data = array();

        $id = (int) $id;
        if ($id <= 0) {
            $this->status = 444;
            $this->message = 'Invalid Departure ID';
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

        if (isset($du['id'])) {
            unset($du['id']);
        }

        if ($id > 0) {
            $res = $this->bbm->update($id, $du);
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
        $d = $this->initialize();
        $data = array();
        if (!$this->admin_login && empty($id)) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $this->status = 200;
        $this->message = 'Berhasil';
        if ($id > 0) {
            $res = $this->bbm->del($id);
            if (!$res) {
                $this->status = 902;
                $this->message = 'Data gagal dihapus';
            }
        } else {
            $this->status = 402;
            $this->message = 'ID tidak ditemukan';
        }
        $this->__json_out($data);
    }

    public function cari()
    {
        $keyword = $this->input->request("keyword");
        if (empty($keyword)) $keyword = "";
        $p = new stdClass();
        $p->id = 'NULL';
        $p->text = '-';
        $data = $this->bbm->cari($keyword);
        array_unshift($data, $p);
        $this->__json_select2($data);
    }
}