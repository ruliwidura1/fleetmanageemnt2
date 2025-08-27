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
class D_Pembelianbbm_Concern extends \JI_Model
{
	public $table 	    = 'd_pembelianbbm';
	public $table_alias = 'pbbm';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->table, $this->table_alias);
    }
}