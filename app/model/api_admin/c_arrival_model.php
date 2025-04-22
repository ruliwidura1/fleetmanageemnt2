<?php

/**
 * Model untuk table c_arrival_model
 *
 * @version 1.0.0
 *
 * @package Model\C_Arrival\Api_Admin
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

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }

    public function get($is_active = "12")
    {
        $this->db->from($this->tbl, $this->tbl_as);
        if (strlen($is_active)) $this->db->where("is_active", $is_active);
        $this->db->order_by('nama', 'asc');
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

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_completed = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.cdate", "cdate", 0);
        $this->db->select_as("$this->tbl2_as.nama", "driver", 0);
        $this->db->select_as("$this->tbl3_as.nama", "kendaraan", 0);
        $this->db->select_as("$this->tbl_as.jam_masuk", "jam_masuk", 0);
        $this->db->select_as("$this->tbl_as.destination", "destination", 0);
        $this->db->select_as("$this->tbl_as.is_completed", "is_completed", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter($keyword, $sdate, $edate);
        if (strlen($is_completed)) {
            $this->db->where_as("$this->tbl_as.is_completed", $is_completed);
        }

        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $is_completed = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter($keyword, $sdate, $edate);
        if (strlen($is_completed)) {
            $this->db->where_as("$this->tbl_as.is_completed", $is_completed);
        }

        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return $d->jumlah;
        return 0;
    }

    public function getById($id)
    {
        $this->db->where("id", $id);
        return $this->db->get_first();
    }

    public function id($id)
    {
        $this->db->where("id", $id);
        return $this->db->get_first();
    }

    public function set($di)
    {
        return $this->db->insert($this->tbl, $di, 0, 0);
    }

    public function update($id, $du)
    {
        if (!is_array($du)) return 0;
        $this->db->where("id", $id);
        return $this->db->update($this->tbl, $du, 0);
    }

    public function del($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete($this->tbl);
    }

    public function cari($keyword = "")
    {
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("CONCAT($this->tbl_as.nama,' (',$this->tbl_as.kode,')')", "text", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->tbl_as.nama", ($keyword), "OR", "LIKE%%", 1, 0);
        }
        $this->db->order_by("$this->tbl_as.nama", "asc");
        return $this->db->get('', 0);
    }
}