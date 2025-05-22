<?php

/**
 * Model untuk table a_vehicle_model
 *
 * @version 1.0.0
 *
 * @package Model\A_Vehicle\Admin
 * @since 1.0.0
 */
class C_Monitoring_Model extends \Model\A_Vehicle_Concern
{
	var $tbl = 'c_monitoring';
	var $tbl_as = 'cm';

	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
	}

	public function get()
	{
		return $this->db->get();
	}
}
