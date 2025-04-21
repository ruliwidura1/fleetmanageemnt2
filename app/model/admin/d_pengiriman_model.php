<?php

/**
 * Model untuk table d_pengiriman_model
 *
 * @version 1.0.0
 *
 * @package Model\D_Pengiriman\Admin
 * @since 1.0.0
 */
class D_Pengiriman_Model extends SENE_Model
{
	var $tbl = 'd_pengiriman';
	var $tbl_as = 'dp';
	var $tbl2 = 'c_muatan';
	var $tbl2_as = 'cm';

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
