<?php
class Monitoring extends JI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->lib("seme_purifier");
    $this->load('a_vehicle_concern');
    $this->load("api_admin/c_monitoring_model", 'cmm');
    $this->current_parent = 'fleetmanagement';
    $this->current_page = 'fleetmanagement_monitoring';
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

    $tbl_as = $this->cmm->tbl_as;

    switch ($iSortCol_0) {
      case 0:
      $sortCol = "$tbl_as.id";
      break;
      case 1:
      $sortCol = "$tbl_as.integrasi_gps_tracking";
      break;
      case 2:
      $sortCol = "$tbl_as.pelacakan_posisi_realtime_kendaraan";
      break;
      case 3:
      $sortCol = "$tbl_as.riwayat_rute_perjalanan";
      break;
      case 4:
      $sortCol = "$tbl_as.alert_perjalanan_berlebih";
      break;
      case 5:
      $sortCol = "$tbl_as.geofencing";
      break;
      case 6:
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
    $dcount = $this->cmm->countAll($keyword, $utype);
    $ddata = $this->cmm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $utype);

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
    if (!isset($di['geofencing'])) $di['geofencing'] = "";
    if (strlen($di['geofencing']) <= 0) {
      $this->status = 101;
      $this->message = 'Diperlukan satu atau lebih paramater';
      $this->__json_out($data);
      die();
    }
    $this->cmm->trans_start();
    $cmm_id = $this->cmm->getLastId();

    $di['id'] = $cmm_id;
    $res = $this->cmm->set($di);
    if ($res) {
      $this->cmm->trans_commit();
      $this->status = 200;
      $this->message = 'Data baru berhasil ditambahkan';
    } else {
      $this->status = 110;
      $this->message = 'Gagal menambahkan data baru';
      $this->cmm->trans_rollback();
    }
    $this->cmm->trans_end();
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
    $data = $this->cmm->id($id);
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
    if (!isset($du['jenis_kendaraan'])) $du['jenis_kendaraan'] = "";
    if (strlen($du['jenis_kendaraan']) <= 0) {
      $this->status = 110;
      $this->message = 'Nama harus diisi';
      $this->__json_out($data);
      die();
    }

    $res = $this->cmm->update($id, $du);
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

    $cmm = $this->cmm->id($id);
    if (!isset($cmm->id)) {
      $this->status = 520;
      $this->message = 'ID tidak ditemukan atau telah dihapus';
      $this->__json_out($data);
      die();
    }
    $res = $this->cmm->del($id);
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
    $data = $this->cmm->getSearch($keyword);
    $this->__json_select2($data);
  }
}
