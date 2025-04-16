<?php
class C_Muatan_Model extends SENE_Model
{
    var $tbl = 'c_muatan';
    var $tbl_as = 'cm';
    var $tbl2 = 'b_driver';
    var $tbl2_as = 'bd';
    var $tbl3 = 'a_vehicle';
    var $tbl3_as = 'av';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
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
            $this->db->where_as("$this->tbl3_as.utype", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl_as.barang", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl3_as.no_pol", $keyword, "OR", "%like%", 0, 1);
        }
    }

    private function filter($keyword = "", $sdate = "", $edate = "")
    {
        $this
            ->filter_created_at($sdate, $edate)
            ->filter_keyword($keyword);

        return $this;
    }

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.cdate", "cdate", 0);
        $this->db->select_as("$this->tbl2_as.nama", "nama", 0);
        $this->db->select_as("CONCAT($this->tbl3_as.utype, ' - ', $this->tbl3_as.no_pol)", "Jenis - No Pol Kendaraan", 0);
        $this->db->select_as("$this->tbl_as.barang", "barang", 0);
        $this->db->select_as("$this->tbl_as.jumlah_muatan", "jumlah_muatan", 0);
        $this->db->select_as("$this->tbl_as.berat", "berat", 0);
        $this->db->select_as("$this->tbl_as.kapasitas_kendaraan", "kapasitas_kendaraan", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
        $this->db->select_as("$this->tbl_as.satuan", "satuan", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter($keyword, $sdate, $edate);
        if (strlen($is_active)) {
            $this->db->where_as("$this->tbl_as.is_active", $is_active);
        }

        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $is_active = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_driver_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'a_vehicle_id', '');
        $this->filter($keyword, $sdate, $edate);
        if (strlen($is_active)) {
            $this->db->where_as("$this->tbl_as.is_active", $is_active);
        }

        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return $d->jumlah;
        return 0;
    }

    public function id($id)
    {
        $this->db->where("id", $id);
        return $this->db->get_first();
    }

    public function set($di)
    {
        if (!is_array($di)) return 0;
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

    public function trans_start()
    {
        $r = $this->db->autocommit(0);
        if ($r) return $this->db->begin();
        return false;
    }

    public function trans_commit()
    {
        return $this->db->commit();
    }

    public function trans_rollback()
    {
        return $this->db->rollback();
    }

    public function trans_end()
    {
        return $this->db->autocommit(1);
    }

    public function getLastId()
    {
        $this->db->select_as("MAX($this->tbl_as.id)+1", "last_id", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $d = $this->db->get_first('', 0);
        if (isset($d->last_id)) return $d->last_id;
        return 0;
    }

    public function get()
    {
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->where("is_active", 1);
        return $this->db->get();
    }

    public function count()
    {
        $this->db->select_as("COUNT(*)", "total", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->where("is_active", 1);
        $d = $this->db->get_first();
        if (isset($d->total)) return $d->total;
        return 0;
    }
}
