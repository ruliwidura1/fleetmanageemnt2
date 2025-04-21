<?php
class D_Pengiriman_Model extends SENE_Model
{
    var $tbl = 'd_pengiriman';
    var $tbl_as = 'dp';
    var $tbl2 = 'c_muatan';
    var $tbl2_as = 'cm';

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
            $this->db->where_as("$this->tbl2_as.barang", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.kode", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl_as.tujuan", $keyword, "OR", "%like%", 0, 1);
        }
    }

    private function filter($keyword = "", $sdate = "", $edate = "")
    {
        $this
            ->filter_created_at($sdate, $edate)
            ->filter_keyword($keyword);

        return $this;
    }

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_delivered = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.cdate", "cdate", 0);
        $this->db->select_as("$this->tbl_as.kode", "kode", 0);
        $this->db->select_as("$this->tbl2_as.barang", "barang", 0);
        $this->db->select_as("$this->tbl_as.tujuan", "tujuan", 0);
        $this->db->select_as("CONCAT($this->tbl_as.provinsi,' - ',kabkota)", "Alamat", 0);
        $this->db->select_as("$this->tbl_as.is_delivered", "is_delivered", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'c_muatan_id', '');
        $this->filter($keyword, $sdate, $edate);
        if (strlen($is_delivered)) {
            $this->db->where_as("$this->tbl_as.is_delivered", $is_delivered);
        }

        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $is_delivered = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'c_muatan_id', '');
        $this->filter($keyword, $sdate, $edate);
        if (strlen($is_delivered)) {
            $this->db->where_as("$this->tbl_as.is_delivered", $is_delivered);
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

    public function checkSku($kode, $id = 0)
    {
        $this->db->select_as("COUNT(*)", "jumlah", 0);
        $this->db->where("sku", $kode);
        if (!empty($id)) {
            $this->db->where("id", $id, 'AND', '!=');
        }
        $d = $this->db->from($this->tbl)->get_first("object", 0);
        if (isset($d->jumlah)) {
            return $d->jumlah;
        }
        return 0;
    }
}
