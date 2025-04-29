<?php

/**
 * Model untuk table b_driver_model
 *
 * @version 1.0.0
 *
 * @package Model\B_Driver\Api_Admin
 * @since 1.0.0
 */
class B_Driver_Model extends SENE_Model
{
	var $tbl = 'b_driver';
	var $tbl_as = 'bd';
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
		$this->db->select('id');
		$this->db->select('nama');
		$this->db->select('sim');
		$this->db->select('is_active');
		$this->db->from($this->tbl, $this->tbl_as);
		if (strlen($keyword) > 1) {
			$this->db->where("nama", $keyword, "OR", "%like%", 0, 0);
		}
		$this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
		return $this->db->get("object", 0);
	}
	public function countAll($keyword = "", $sdate = "", $edate = "")
	{
		$this->db->flushQuery();
		$this->db->select_as("COUNT(*)", "jumlah", 0);
		if (strlen($keyword) > 1) {
			$this->db->where("nama", $keyword, "OR", "%like%", 0, 0);
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
	public function cari($keyword = "")
	{
		$this->db->select_as("$this->tbl_as.id", "id", 0);
		$this->db->select_as("CONCAT($this->tbl_as.nama,' (',$this->tbl_as.kode,')')", "text", 0);
		$this->db->from($this->tbl, $this->tbl_as);
		if (strlen($keyword) > 0) {
			$this->db->where_as("$this->tbl_as.nama", ($keyword), "OR", "LIKE%%", 1, 0);
		}
		$this->db->order_by("$this->tbl_as.nama", "asc");
		return $this->db->get('', 0);
	}
}
