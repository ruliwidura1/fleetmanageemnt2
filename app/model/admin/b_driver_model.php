<?php
/**
* Model untuk table b_driver_model
*
* @version 1.0.0
*
* @package Model\B_Driver\Admin
* @since 1.0.0
*/
class B_Driver_Model extends SENE_Model{
	var $tbl = 'b_driver';
	var $tbl_as = 'bd';
	public function __construct(){
		parent::__construct();
		$this->db->from($this->tbl,$this->tbl_as);
	}

	public function id($id)
	{
		$this->db->where_as("$this->tbl_as.id", $this->db->esc($id));
		return $this->db->get_first();
	}

	public function get($is_active="1"){
		$this->db->from($this->tbl,$this->tbl_as);
		if(strlen($is_active)) $this->db->where("is_active",$is_active);
		$this->db->order_by('nama','asc');
		return $this->db->get();
	}
}
