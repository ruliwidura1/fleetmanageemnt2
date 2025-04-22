<?php

/**
 * Controller untuk Departure
 *
 * @version 1.0.0
 *
 * @package FleetManagement\Api_Admin
 * @since 1.0.0
 */
class Departure extends \JI_Controller
{
    var $is_email = 1;
    public function __construct()
    {
        parent::__construct();
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_departure';
        $this->load("api_admin/c_departure_model", "crm");
        $this->load('a_vehicle_concern');
        $this->load("api_admin/a_vehicle_model", "avm");
        $this->load("api_admin/b_driver_model", "bdm");
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

        $draw = $this->input->post("draw");
        $sval = $this->input->post("search");
        $sSearch = $this->input->post("sSearch");
        $is_departure = $this->input->post("is_departure", '');
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

        $tbl_as = $this->crm->tbl_as;
        $tbl2_as = $this->crm->tbl2_as;
        $tbl3_as = $this->crm->tbl3_as;

        switch ($iSortCol_0) {
            case 0:
                $sortCol = "$tbl_as.id";
                break;
            case 1:
                $sortCol = "$tbl_as.cdate";
                break;
            case 2:
                $sortCol = "$tbl2_as.nama";
                break;
            case 3:
                $sortCol = "$tbl3_as.nama";
                break;
            case 4:
                $sortCol = "$tbl_as.jam_keluar";
                break;
            case 5:
                $sortCol = "$tbl_as.area_tujuan";
                break;
            case 6:
                $sortCol = "$tbl_as.destination";
                break;
            case 7:
                $sortCol = "$tbl_as.is_departure";
                break;
            case 8:
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
        $dcount = $this->crm->countAll($keyword, $is_departure, $sdate, $edate);
        $ddata = $this->crm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $is_departure, $sdate, $edate);

        foreach ($ddata as &$gd) {
            if (isset($gd->is_active)) {
                $gd->is_active = !empty($gd->is_active)
                    ? '<label class="label label-success">Aktif</label>'
                    : '<label class="label label-default">Tidak Aktif</label>';
            }
            if (isset($gd->is_departure)) {
                $gd->is_departure = ($gd->is_departure == 0)
                    ? '<label class="label label-warning">Perjalanan</label>'
                    : '<label class="label label-info">Selesai</label>';
            }
        }

        $this->__jsonDataTable($ddata, $dcount);
    }
    public function tambah()
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
        $di = $_POST;
        foreach ($di as $k => $v) {
            $di[$k] = strip_tags($v);
        }

        $res = $this->crm->set($di);
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
        $data = $this->crm->id($id);
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
            $res = $this->crm->update($id, $du);
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

        $crm = $this->crm->id($id);
        if (!isset($crm->id)) {
            $this->status = 520;
            $this->message = 'ID tidak ditemukan atau telah dihapus';
            $this->__json_out($data);
            die();
        }
        $res = $this->crm->del($id);
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
        $p = new stdClass();
        $p->id = 'NULL';
        $p->text = '-';
        $data = $this->crm->cari($keyword);
        array_unshift($data, $p);
        $this->__json_select2($data);
    }
}