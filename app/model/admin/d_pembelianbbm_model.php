<?php
/**
 * Undocumented class
 */
class D_Pembelianbbm_Model extends \Model\D_Pembelianbbm_Concern
{

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->table, $this->table_alias);
    }
}