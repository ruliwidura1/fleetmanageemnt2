<?php
/**
 * Undocumented class
 */
class B_Bensin_Model extends \Model\B_Bensin_Concern
{

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->table, $this->table_alias);
    }
}