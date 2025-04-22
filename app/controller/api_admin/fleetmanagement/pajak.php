<?php

/**
 * Controller untuk Pajak
 *
 * @version 1.0.0
 *
 * @package FleetManagement\Api_Admin
 * @since 1.0.0
 */
class Pajak extends \JI_Controller
{
	var $is_email = 1;
	public function __construct()
	{
		parent::__construct();
		$this->load("api_admin/b_pajak_model", 'bpm');
        $this->load('a_vehicle_concern');
        $this->load("api_admin/a_vehicle_model", 'avm');
		$this->current_parent = 'fleetmanagement';
		$this->current_page = 'fleetmanagement_pajak';
        
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
                $sortCol = "a_vehicle_id";
                break;
            case 2:
                $sortCol = "jenis_kendaraan";
                break;
            case 3:
                $sortCol = "plat_nomor";
                break;
            case 4:
                $sortCol = "tahun_pembuatan";
                break;
            case 5:
                $sortCol = "berlaku";
                break;
            case 6:
                $sortCol = "nominal_pajak";
                break;
            case 7:
                $sortCol = "perpanjang_pajak";
                break;
            case 8:
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
        
        $dcount = $this->bpm->countAll($keyword);
        $ddata = $this->bpm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword);



        foreach ($ddata as $dt) {
            if(isset($dt->nominal_pajak)) {
                $dt->nominal_pajak = 'Rp'.number_format($dt->nominal_pajak);
            }
        }
        foreach ($ddata as &$dt) {
            if (isset($dt->is_active)) {
                if ($dt->is_active == 1) {
                    $dt->is_active = '<label class="label label-success">Selesai</label>';
                } elseif ($dt->is_active == 2) {
                    $dt->is_active = '<label class="label label-danger">Proses Pembayaran</label>';
				} else {
					$dt->is_active = '<label class="label label-default">belum bayar</label>';
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
		$res = $this->bpm->set($di);
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
		$data = $this->bpm->getById($id);
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
        $res = $this->bpm->update($id, $du);
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
			$res = $this->bpm->del($id);
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
		$data = $this->bpm->cari($keyword);
		array_unshift($data, $p);
		$this->__json_select2($data);
	}
}