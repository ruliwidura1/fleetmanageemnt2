<?php
class Acservice extends JI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->lib("seme_purifier");
    $this->load('c_acservice_concern');
    $this->load("api_admin/c_acservice_model", 'cam');
    $this->current_parent = 'fleetmanagement';
    $this->current_page = 'fleetmanagement_acservice';
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

    $tbl_as = $this->cam->tbl_as;

    switch ($iSortCol_0) {
      case 0:
      $sortCol = "$tbl_as.id";
      break;
      case 1:
      $sortCol = "$tbl_as.pelanggan_nama";
      break;
      case 2:
      $sortCol = "$tbl_as.merk_ac";
      break;
      case 3:
      $sortCol = "$tbl_as.jenis_remot";
      break;
      case 4:
      $sortCol = "$tbl_as.remot_kode";
      break;
      case 5:
      $sortCol = "$tbl_as.telp";
      break;
      case 6:
      $sortCol = "$tbl_as.deskripsi_kerusakan";
      break;
      case 7:
      $sortCol = "$tbl_as.tanggal_perbaikan";
      break;
      case 8:
      $sortCol = "$tbl_as.teknisi_1_nama";
      break;
      case 9:
      $sortCol = "$tbl_as.teknisi_2_nama";
      break;
      case 10:
      $sortCol = "$tbl_as.teknisi_3_nama";
      break;
      case 11:
        $sortCol = "$tbl_as.is_proses";
      break;
      case 12:
      default:
      $sortCol = "$tbl_as.id";
    }

    if (empty($draw)) $draw = 0;
    if (empty($pagesize)) $pagesize = 10;
    if (empty($page)) $page = 0;

    $sdate = $this->input->request('sdate');
    $edate = $this->input->request('edate');
    $is_proses = $this->input->request('is_proses');

    $keyword = $sSearch;

    $this->status = 200;
    $this->message = 'Berhasil';
    $dcount = $this->cam->countAll($keyword, $sdate, $edate, $is_proses);
    $ddata = $this->cam->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $sdate, $edate, $is_proses);

    foreach ($ddata as &$gd) {
      if (isset($gd->nama)) {
        $gd->nama = htmlentities(rtrim($gd->nama, ' - '));
      }
      if (isset($gd->is_proses)) {
        if (!empty($gd->is_proses)) {
          $gd->is_proses = '<label class="label label-success">Sedang di Proses</label>';
        } else {
          $gd->is_proses = '<label class="label label-default">Selesai</label>';
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
    if (!isset($di['pelanggan_nama'])) $di['pelanggan_nama'] = "";
    if (strlen($di['pelanggan_nama']) <= 0) {
      $this->status = 101;
      $this->message = 'Diperlukan satu atau lebih paramater';
      $this->__json_out($data);
      die();
    }
    $this->cam->trans_start();
    $cam_id = $this->cam->getLastId();

    $di['id'] = $cam_id;
    $res = $this->cam->set($di);
    if ($res) {
      $this->cam->trans_commit();
      $this->status = 200;
      $this->message = 'Data baru berhasil ditambahkan';
    } else {
      $this->status = 110;
      $this->message = 'Gagal menambahkan data baru';
      $this->cam->trans_rollback();
    }
    $this->cam->trans_end();
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
    $data = $this->cam->id($id);
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
      $this->message = 'Invalid jenis merk kendaraan ID';
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
    if (!isset($du['pelanggan_nama'])) $du['pelanggan_nama'] = "";
    if (strlen($du['pelanggan_nama']) <= 0) {
      $this->status = 110;
      $this->message = 'Nama harus diisi';
      $this->__json_out($data);
      die();
    }

    $res = $this->cam->update($id, $du);
    if ($res) {
      $this->status = 200;
      $this->message = 'Success';
    } else {
      $this->status = 901;
      $this->message = 'Tidak dapat menambahkan data jenis merk kendaraan';
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

    $cam = $this->cam->id($id);
    if (!isset($cam->id)) {
      $this->status = 520;
      $this->message = 'ID tidak ditemukan atau telah dihapus';
      $this->__json_out($data);
      die();
    }
    $res = $this->cam->del($id);
    if ($res) {
      $this->status = 200;
      $this->message = 'Berhasil';
    } else {
      $this->status = 902;
      $this->message = 'Tidak dapat menghapus data jenis merk kendaraan';
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


    $this->status = 200;
    $this->message = 'Berhasil';
    $data = $statistik;
    $this->__json_out($data);
  }

  public function cari()
  {
    $keyword = $this->input->request("keyword");
    if (empty($keyword)) $keyword = "";
    $data = $this->cam->getSearch($keyword);
    $this->__json_select2($data);
  }
}
