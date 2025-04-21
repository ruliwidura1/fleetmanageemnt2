<?php
class TujuanPengiriman extends JI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lib("seme_purifier");
        $this->load("api_admin/d_pengiriman_model", 'dpm');
        $this->load("api_admin/c_muatan_model", 'cmm');
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_tujuanpengiriman';
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
        $is_delivered = $this->input->post("is_delivered", '');
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

        $tbl_as = $this->dpm->tbl_as;
        $tbl2_as = $this->dpm->tbl2_as;

        switch ($iSortCol_0) {
            case 0:
                $sortCol = "$tbl_as.id";
                break;
            case 1:
                $sortCol = "$tbl_as.cdate";
                break;
            case 2:
                $sortCol = "$tbl_as.kode";
                break;
            case 3:
                $sortCol = "$tbl2_as.c_muatan_id";
                break;
            case 4:
                $sortCol = "$tbl_as.tujuan";
                break;
            case 5:
                $sortCol = "$tbl_as.is_delivered";
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
        $dcount = $this->dpm->countAll($keyword, $is_delivered, $sdate, $edate);
        $ddata = $this->dpm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $is_delivered, $sdate, $edate);

        foreach ($ddata as &$gd) {
            if (isset($gd->is_delivered)) {
                if ($gd->is_delivered == 1) {
                    $gd->is_delivered = '<label class="label label-success">Diterima</label>';
                } elseif ($gd->is_delivered == 0) {
                    $gd->is_delivered = '<label class="label label-warning">Dikirim</label>';
                } elseif ($gd->is_delivered == 2) {
                    $gd->is_delivered = '<label class="label label-danger">Batal</label>';
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

        if (!isset($di['cdate'])) $di['cdate'] = "";
        if (!isset($di['c_muatan_id'])) $di['c_muatan_id'] = "";
        if (!isset($di['tujuan'])) $di['tujuan'] = "";

        if (strlen($di['cdate']) > 1 && strlen($di['c_muatan_id']) > 1 && strlen($di['tujuan']) > 1) {
            $this->status = 101;
            $this->message = 'Diperlukan satu atau lebih paramater';
            $this->__json_out($data);
            die();
        }
        $this->dpm->trans_start();
        $dpm_id = $this->dpm->getLastId();

        $res = $this->dpm->set($di);
        if ($res) {
            $this->dpm->trans_commit();
            $this->status = 200;
            $this->message = 'Data baru berhasil ditambahkan';
        } else {
            $this->status = 110;
            $this->message = 'Gagal menambahkan data baru';
            $this->dpm->trans_rollback();
        }
        $this->dpm->trans_end();
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
        $data = $this->dpm->id($id);
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
            $this->message = 'Invalid Tujuan Pengiriman ID';
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
            $res = $this->dpm->update($id, $du);
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

        $dpm = $this->dpm->id($id);
        if (!isset($dpm->id)) {
            $this->status = 520;
            $this->message = 'ID tidak ditemukan atau telah dihapus';
            $this->__json_out($data);
            die();
        }
        $res = $this->dpm->del($id);
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
        $data = $this->dpm->getSearch($keyword);
        $this->__json_select2($data);
    }
}
