<?php

/**
 * Model untuk table a_pemeliharaan_service
 *
 * @version 1.0.0
 *
 * @package Model\A_Pemeliharaan_Service\Admin
 * @since 1.0.0
 */
class A_Pemeliharaan_Service_Model extends SENE_Model
{
	var $tbl = 'a_pemeliharaan_service';
	var $tbl_as = 'aps';
	var $tbl2 = 'b_driver';
	var $tbl2_as = 'bd';
	var $tbl3 = 'a_vehicle';
	var $tbl3_as = 'av';

	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
	}

	public function id($id)
	{
		$this->db->where_as("$this->tbl_as.id", $this->db->esc($id));
		return $this->db->get_first();
	}

	public function get()
	{
		return $this->db->get();
	}
}
