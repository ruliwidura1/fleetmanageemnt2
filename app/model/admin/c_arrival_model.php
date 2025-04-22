<?php
/**
* Model untuk table c_arrival_model
*
* @version 1.0.0
*
* @package Model\C_Arrival\Admin
* @since 1.0.0
*/
class C_Arrival_Model extends SENE_Model
{
	var $tbl = 'c_arrival';
	var $tbl_as = 'ca';
    var $tbl2 = 'b_driver';
	var $tbl2_as = 'bd';
    var $tbl3 = 'a_vehicle';
	var $tbl3_as = 'av';

	public function __construct(){
		parent::__construct();
		$this->db->from($this->tbl,$this->tbl_as);
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