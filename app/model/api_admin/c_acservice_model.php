<?php
class C_Acservice_Model extends \Model\A_Vehicle_Concern
{
    var $tbl = 'c_acservice';
    var $tbl_as = 'cam';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }


    private function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->tbl_as.pelanggan_nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.pk", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl_as.teknisi_1_nama", $keyword, "OR", "%like%", 0, 0);

        }
    }

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $utype = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.pelanggan_nama", "pelanggan_nama", 0);
        $this->db->select_as("$this->tbl_as.merk_ac", "merk_ac", 0);
        $this->db->select_as("$this->tbl_as.telp", "telp", 0);
        $this->db->select_as("$this->tbl_as.deskripsi_kerusakan", "deskripsi_kerusakan", 0);
        $this->db->select_as("$this->tbl_as.tanggal_perbaikan", "tanggal_perbaikan", 0);
        $this->db->select_as("$this->tbl_as.teknisi_1_nama", "teknisi_1_nama", 0);
        $this->db->select_as("$this->tbl_as.teknisi_2_nama", "teknisi_2_nama", 0);
        $this->db->select_as("$this->tbl_as.teknisi_3_nama", "teknisi_3_nama", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->filter_keyword($keyword);

        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $utype = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->filter_keyword($keyword);

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

    public function getSearch($keyword = '')
    {
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.nama", "text", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->where("is_active", 1);
        if ($keyword) {
            $this->db->where("nama", $keyword, "like%%", "AND", "!=");
            $this->db->where("utype", $keyword, "like%%", "AND", "!=");
            $this->db->where("no_pol", $keyword, "like%%", "AND", "!=");
            $this->db->where("availability", $keyword, "like%%", "AND", "!=");
        }
        return $this->db->get();
    }
}
