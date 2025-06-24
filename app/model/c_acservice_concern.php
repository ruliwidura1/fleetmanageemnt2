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
class C_Acservice_Concern extends \JI_Model
{
	public $tbl 	= 'c_acservice';
	public $tbl_as 	= 'ca';

    const COLUMNS = [
        'cdate',
        'nama',
        'utype',
        'no_pol',
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
        'no_pol',
        'kapasitas_mesin',
        'kapasitas_angkutan',
        'availability'
    ];

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
    protected function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->tbl_as.pelanggan_nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.pk", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl_as.teknisi_1_nama", $keyword, "OR", "%like%", 0, 0);
        }
        return $this;
    }
    protected function filter_is_proses($is_proses = '')
    {
        if (strlen($is_proses) > 0) {
            $this->db->where_as("$this->tbl_as.is_proses", $this->db->esc($is_proses));
        }
        return $this;
    }

    protected function filter_sdate($sdate = '', $edate = '')
    {
        if (strlen($sdate) == 10 && strlen($edate) == 10) {
            $this->db->between("$this->tbl_as.tanggal_perbaikan", $this->db->esc($sdate), $this->db->esc($edate));
        }
        return $this;
    }
}
