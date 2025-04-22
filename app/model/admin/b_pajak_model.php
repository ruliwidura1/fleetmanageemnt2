<?php

/**
 * Model untuk table b_pajak_model
 *
 * @version 1.0.0
 *
 * @package Model\B_Pajak\Admin
 * @since 1.0.0
 */
class B_Pajak_Model extends SENE_Model
{
    var $tbl = 'b_pajak';
    var $tbl_as = 'bp';
    var $tbl2 = 'a_vehicle';
    var $tbl2_as = 'av';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }

    public function id($id)
    {
        $this->db->where_as("$this->tbl_as.id", $this->db->esc($id));
        return $this->db->get_first();
    }
    public function get()
    {
        $this->db->from($this->tbl2, $this->tbl2_as);
        return $this->db->get();
    }
}