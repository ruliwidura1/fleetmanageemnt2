<?php

namespace Model;

register_namespace(__NAMESPACE__);
/**
 * Define all general method(s) and constant(s) for b_insentif table,
 *   can be inherited a Concern class also can be reffered as class constants
 *
 * @version 1.0.0
 *
 * @package Model\A_Vehicle\Concern
 * @since 1.0.0
 */
class A_Vehicle_Concern extends \JI_Model
{
    public $table     = 'a_vehicle';
    public $table_alias     = 'av';

    const COLUMNS = [
        'cdate',
        'nama',
        'utype',
        'plat_nomor',
        'merk',
        'warna',
        'kapasitas_mesin',
        'kapasitas_angkutan',
        'availability',
        'is_active'
    ];

    const DEFAULTS = [
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '1',
    ];

    const REQUIREDS = [
        'cdate',
        'nama',
        'utype',
        'plat_nomor',
        'kapasitas_mesin',
        'kapasitas_angkutan',
        'availability'
    ];

	public function __construct()
	{
		parent::__construct();
        $this->db->from($this->table, $this->table_alias);
	}

    /**
     * Install HTML bootstrap label into certain columns
     *
     * @return object this current object
     */
    private function _install_labels()
    {
        $this->labels['is_active'] = new \Seme_Flaglabel();
        $this->labels['is_active']->init_is_active();

        return $this;
    }
    protected function filter_utype($utype = '')
    {
        if (strlen($utype) > 0) {
            $this->db->where_as("$this->table_alias.utype", $this->db->esc($utype));
        }
        return $this;
    }
    protected function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->table_alias.nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->table_alias.utype", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->table_alias.plat_nomor", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->table_alias.availability", $keyword, "OR", "%like%", 0, 1);
        }
        return $this;
    }
    protected function filter_is_active($is_active = '')
    {
        if (strlen($is_active) > 0) {
            $this->db->where_as("$this->table_alias.is_active", $this->db->esc($is_active));
        }
        return $this;
    }
    protected function filter_created_at($created_at_from = '', $created_at_to = '')
    {
        if (strlen($created_at_from) == 10 && strlen($created_at_to) == 10) {
            $this->db->between("$this->table_alias.created_at", $this->db->esc($created_at_from), $this->db->esc($created_at_to));
        }
        return $this;
    }
}
