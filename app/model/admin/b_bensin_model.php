<?php
/**
* Model untuk table b_bensin_model
*
* @version 1.0.0
*
* @package Model\B_Bensin\Admin
* @since 1.0.0
*/
class B_Bensin_Model extends SENE_Model{
	var $tbl = 'b_bensin';
	var $tbl_as = 'bb';
    var $tbl2 = 'a_vehicle';
	var $tbl2_as = 'av';
	public function __construct(){
		parent::__construct();
		$this->db->from($this->tbl,$this->tbl_as);
	}
	
	public function id($id)
	{
		$this->db->where_as("$this->tbl_as.id", $this->db->esc($id));
		return $this->db->get_first();
	}
}