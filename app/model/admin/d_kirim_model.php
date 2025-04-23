<?php

/**
 * Model untuk table d_kirim_model
 *
 * @version 1.0.0
 *
 * @package Model\D_Kirim\Admin
 * @since 1.0.0
 */
class D_Kirim_Model extends SENE_Model
{
    var $tbl = 'd_kirim';
    var $tbl_as = 'dk';
    var $tbl2 = 'b_driver';
    var $tbl2_as = 'bd';
    var $tbl3 = 'c_departure';
    var $tbl3_as = 'cr';
    var $tbl4 = 'c_arrival';
    var $tbl4_as = 'ca';
    var $tbl5 = 'c_muatan';
    var $tbl5_as = 'cm';
    var $tbl6 = 'd_pengiriman';
    var $tbl6_as = 'dp';
    var $tbl7 = 'a_vehicle';
    var $tbl7_as = 'av';

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
        return $this->db->get();
    }

    private function filter_created_at($sdate, $edate)
    {
        if (strlen($sdate) == 10 && strlen($edate) == 10) {
            $this->db->between("$this->tbl_as.cdate", '"' . $sdate . ' 00:00:00"', '"' . $edate . ' 23:59:59"');
        } elseif (strlen($sdate) == 10 && strlen($edate) != 10) {
            $this->db->where_as("$this->tbl_as.cdate", '"' . $sdate . ' 00:00:00"', 'AND', '>=');
        } elseif (strlen($sdate) != 10 && strlen($edate) == 10) {
            $this->db->where_as("$this->tbl_as.cdate", '"' . $edate . ' 23:59:59"', 'AND', '<=');
        }

        return $this;
    }

    private function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->tbl2_as.nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl3_as.nama", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl_as.destination", $keyword, "OR", "%like%", 0, 1);
        }
    }

    private function filter($keyword = "", $sdate = "", $edate = "")
    {
        $this
            ->filter_created_at($sdate, $edate)
            ->filter_keyword($keyword);

        return $this;
    }

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_departure = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.cdate", "cdate", 0);
        $this->db->select_as("$this->tbl2_as.nama", "driver", 0);
        $this->db->select_as("$this->tbl7_as.merk", "merk", 0);
        $this->db->select_as("$this->tbl7_as.no_pol", "no_pol", 0);
        $this->db->select_as("$this->tbl7_as.nama", "kendaraan", 0);
        $this->db->select_as("$this->tbl6_as.kode", "SKU", 0);
        $this->db->select_as("$this->tbl5_as.jumlah_muatan", "jumlah_muatan", 0);
        $this->db->select_as("$this->tbl5_as.berat", "berat", 0);
        $this->db->select_as("$this->tbl3_as.jam_keluar", "jam_keluar", 0);
        $this->db->select_as("$this->tbl4_as.jam_masuk", "jam_masuk", 0);
        $this->db->select_as("$this->tbl6_as.tujuan", "tujuan", 0);
        $this->db->select_as("$this->tbl6_as.kabkota", "KabKota", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'c_departure_id', '');
        $this->db->join($this->tbl4, $this->tbl4_as, 'id', $this->tbl_as, 'c_arrival_id', '');
        $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl_as, 'c_muatan_id', '');
        $this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl_as, 'd_pengiriman_id', '');
        $this->db->join($this->tbl7, $this->tbl7_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter($keyword, $sdate, $edate);
        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $is_departure = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'c_departure_id', '');
        $this->db->join($this->tbl4, $this->tbl4_as, 'id', $this->tbl_as, 'c_arrival_id', '');
        $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl_as, 'c_muatan_id', '');
        $this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl_as, 'd_pengiriman_id', '');
        $this->db->join($this->tbl7, $this->tbl7_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter($keyword, $sdate, $edate);
        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return $d->jumlah;
        return 0;
    }

    public function getKirimXls($sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.cdate", "cdate", 0);
        $this->db->select_as("$this->tbl2_as.nama", "driver", 0);
        $this->db->select_as("$this->tbl7_as.merk", "merk", 0);
        $this->db->select_as("$this->tbl7_as.no_pol", "no_pol", 0);
        $this->db->select_as("$this->tbl7_as.nama", "kendaraan", 0);
        $this->db->select_as("$this->tbl6_as.kode", "SKU", 0);
        $this->db->select_as("$this->tbl5_as.jumlah_muatan", "jumlah_muatan", 0);
        $this->db->select_as("$this->tbl5_as.berat", "berat", 0);
        $this->db->select_as("$this->tbl3_as.jam_keluar", "jam_keluar", 0);
        $this->db->select_as("$this->tbl4_as.jam_masuk", "jam_masuk", 0);
        $this->db->select_as("$this->tbl6_as.tujuan", "tujuan", 0);
        $this->db->select_as("$this->tbl6_as.kabkota", "KabKota", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'c_departure_id', '');
        $this->db->join($this->tbl4, $this->tbl4_as, 'id', $this->tbl_as, 'c_arrival_id', '');
        $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl_as, 'c_muatan_id', '');
        $this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl_as, 'd_pengiriman_id', '');
        $this->db->join($this->tbl7, $this->tbl7_as, 'id', $this->tbl_as, 'a_vehicle_id', '');

        if (!empty($sdate) && !empty($edate)) {
            $this->db->where_as("$this->tbl_as.cdate", '"' . $sdate . ' 00:00:00"', 'AND', '>=');
            $this->db->where_as("$this->tbl_as.cdate", '"' . $edate . ' 23:59:59"', 'AND', '<=');
        } elseif (!empty($sdate)) {
            $this->db->where_as("$this->tbl_as.cdate", '"' . $sdate . ' 00:00:00"', 'AND', '>=');
        } elseif (!empty($edate)) {
            $this->db->where_as("$this->tbl_as.cdate", '"' . $edate . ' 23:59:59"', 'AND', '<=');
        }

        return $this->db->get("object", 0);
    }

    public function getById($id)
    {
        $this->db->where("id", $id);
        return $this->db->get_first();
    }
}