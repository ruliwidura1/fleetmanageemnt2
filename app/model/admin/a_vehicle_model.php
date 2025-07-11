<?php

/**
 * Model untuk table a_vehicle_model
 *
 * @version 1.0.0
 *
 * @package Model\A_Vehicle\Admin
 * @since 1.0.0
 */
class A_Vehicle_Model extends \Model\A_Vehicle_Concern
{
	var $tbl = 'a_vehicle';
	var $tbl_as = 'av';

	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
	}
	
	public function get()
	{
		return $this->db->get();
	}
	public function laporan_xls($created_at_from, $created_at_to, $is_active)
	{
		$this->filter_is_active($is_active)->filter_created_at($created_at_from, $created_at_to);
		return $this->db->get();
	}
}