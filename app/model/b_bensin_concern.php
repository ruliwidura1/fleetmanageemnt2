<?php
namespace Model;
register_namespace(__NAMESPACE__);
/**
* Define all general method(s) and constant(s) for b_insentif table,
*   can be inherited a Concern class also can be reffered as class constants
*
* @version 1.0.0
*
* @package Model\D_Pembelianbbm\Concern
* @since 1.0.0
*/
class B_Bensin_Concern extends \JI_Model
{
	public $table 	    = 'b_bensin';
	public $table_alias = 'bbm';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->table, $this->table_alias);
    }
}