<?php

/**
 * Model untuk table b_pajak_model
 *
 * @version 1.0.0
 *
 * @package Model\B_Pajak\Api_Admin
 * @since 1.0.0
 */
class B_Pajak_Model extends SENE_Model
{
	var $tbl = 'b_pajak';
	var $tbl_as = 'bp';
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

    public function countByStatus($availability = "", $utype = "")
    {
        $this->db->flushQuery();
        $availability = $this->db->esc($availability);
        $utype = $this->db->esc($utype);
        $this->db->where_as("$this->tbl_as.availability", $availability);
        if (strlen($utype)) {
            $this->db->where_as("$this->tbl_as.utype", $utype);
        }

        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);

        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return (int)$d->jumlah;
        return 0;
    }


    private function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->tbl2_as.nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl2_as.utype", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl2_as.no_pol", $keyword, "OR", "%like%", 0, 1);
        }
    }
	public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl2_as.nama", "kendaraan", 0);
        $this->db->select_as("$this->tbl2_as.utype", "jenis_kendaraan", 0);
        $this->db->select_as("$this->tbl2_as.no_pol", "plat_nomor", 0);
        $this->db->select_as("$this->tbl_as.tahun_pembuatan", "tahun_pembuatan", 0);
        $this->db->select_as("$this->tbl_as.berlaku", "berlaku", 0);
        $this->db->select_as("$this->tbl_as.nominal_pajak", "nominal_pajak", 0);
        $this->db->select_as("$this->tbl_as.perpanjang_pajak", "perpanjang_pajak", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter_keyword($keyword);
      
        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $is_active = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter_keyword($keyword);

        $d = $this->db->get_first("object", 0);
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