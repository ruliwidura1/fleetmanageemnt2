<?php

/**
 * Controller untuk Driver
 *
 * @version 1.0.0
 *
 * @package FleetManagement\Api_Admin
 * @since 1.0.0
 */
class Driver extends \JI_Controller
{
	var $is_email = 1;
	public function __construct()
	{
		parent::__construct();
		$this->load("api_admin/b_driver_model", 'bdm');
		$this->current_parent = 'fleetmanagement';
		$this->current_page = 'fleetmanagement_driver';
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
		$sEcho = $this->input->post("sEcho");
		$page = $this->input->post("iDisplayStart");
		$pagesize = $this->input->post("iDisplayLength");

		$iSortCol_0 = $this->input->post("iSortCol_0");
		$sSortDir_0 = $this->input->post("sSortDir_0");


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
				$sortCol = "nama";
				break;
			case 2:
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
		$dcount = $this->bdm->countAll($keyword);
		$ddata = $this->bdm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword);

		foreach ($ddata as $dt) {
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
		if (!isset($di['nama'])) $di['nama'] = "";

		if (strlen($di['nama']) < 0) {
			$this->status = 101;
			$this->message = 'Nama wajib diisi';
			$this->__json_out($data);
			die();
		}
		$res = $this->bdm->set($di);
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
		$this->status = 200;
		$this->message = 'Berhasil';
		$data = $this->bdm->getById($id);
		$this->__json_out($data);
	}

	public function edit($id)
	{
		$d = $this->__init();
		$id = (int) $id;
		$data = array();
		if (!$this->admin_login) {
			$this->status = 400;
			$this->message = 'Harus login';
			header("HTTP/1.0 400 Harus login");
			$this->__json_out($data);
			die();
		}
		$du = $_POST;
		if (!isset($du['nama'])) $du['nama'] = '';
		if (isset($du['id'])) unset($du['id']);
		if ($id > 0 && strlen($du['nama']) > 0) {
			$res = $this->bdm->update($id, $du);
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
			$res = $this->bdm->del($id);
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
		$data = $this->bdm->cari($keyword);
		array_unshift($data, $p);
		$this->__json_select2($data);
	}
}
