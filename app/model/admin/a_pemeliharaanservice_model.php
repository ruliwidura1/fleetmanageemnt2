<?php

/**
 * Model untuk table a_vehicle_model
 *
 * @version 1.0.0
 *
 * @package Model\A_Vehicle\Admin
 * @since 1.0.0
 */
class A_Pemeliharaanservice_Model extends \Model\A_Vehicle_Concern
{
	var $tbl = 'a_pemeliharaanservice';
	var $tbl_as = 'ap';

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
