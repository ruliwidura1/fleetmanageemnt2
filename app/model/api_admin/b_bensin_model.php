<?php

/**
 * Model untuk table b_bensin_model
 *
 * @version 1.0.0
 *
 * @package Model\B_bensin\Api_Admin
 * @since 1.0.0
 */
class B_Bensin_Model extends SENE_Model
{
	var $tbl = 'b_bensin';
	var $tbl_as = 'bb';
    var $tbl2 = 'a_vehicle';
	var $tbl2_as = 'av';
	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
	}
	public function get($is_active = "12")
	{
		$this->db->from($this->tbl, $this->tbl_as);
		if (strlen($is_active)) $this->db->where("is_active", $is_active);
		$this->db->order_by('nama', 'asc');
		return $this->db->get();
	}
	public function getAll($page = 0, $pagesize = 10, $sortCol = "kode", $sortDir = "ASC", $keyword = "", $sdate = "", $edate = "")
	{
		$this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.tgl_beli", "tgl_beli", 0);
        $this->db->select_as("$this->tbl2_as.nama", "kendaraan", 0);
        $this->db->select_as("$this->tbl_as.jenis", "jenis", 0);
        $this->db->select_as("$this->tbl_as.driver", "driver", 0);
        $this->db->select_as("$this->tbl_as.jumlah_beli", "jumlah_beli", 0);
        $this->db->select_as("$this->tbl_as.harga", "harga", 0);
        $this->db->select_as("$this->tbl_as.total_harga", "total_harga", 0);

        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
		if (strlen($keyword) > 1) {
            $this->db->where_as("$this->tbl2_as.nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.jenis", $keyword, "OR", "%like%", 0, 1); 

		}
		$this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
		return $this->db->get("object", 0);
	}
	public function countAll($keyword = "", $sdate = "", $edate = "")
	{
		$this->db->flushQuery();
		$this->db->select_as("COUNT(*)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
		if (strlen($keyword) > 1) {
            $this->db->where_as("$this->tbl2_as.nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.jenis", $keyword, "OR", "%like%", 0, 1);
		}
		$d = $this->db->from($this->tbl)->get_first("object", 0);
		if (isset($d->jumlah)) return $d->jumlah;
		return 0;
	}
	public function getById($id)
	{
		$this->db->where("id", $id);
		return $this->db->get_first();
	}
	public function set($di)
	{
		return $this->db->insert($this->tbl, $di, 0, 0);
	}
	public function update($id, $du)
	{
		if (!is_array($du)) return 0;
		$this->db->where("id", $id);
		return $this->db->update($this->tbl, $du, 0);
	}
	public function del($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete($this->tbl);
	}
}