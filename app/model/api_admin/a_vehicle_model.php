<?php
class A_Vehicle_Model extends \Model\A_Vehicle_Concern
{
    var $tbl = 'a_vehicle';
    var $tbl_as = 'av';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }

    public function countByStatus($availability = "", $utype = "")
    {
        $this->db->flushQuery();
        $availability = $this->db->esc($availability);
        $utype = $this->db->esc($utype);
        $this->db->where_as("$this->tbl_as.availability", $availability);
        if (strlen($utype)) {
            $this->db->where_as("$this->tbl_as.utype", $utype);
        }

        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);

        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return (int)$d->jumlah;
        return 0;
    }

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $created_at_from = '', $created_at_to = '', $is_active = '')

    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.nama", "nama", 0);
        $this->db->select_as("$this->tbl_as.utype", "utype", 0);
        $this->db->select_as("$this->tbl_as.no_pol", "no_pol", 0);
        $this->db->select_as("$this->tbl_as.merk", "merk", 0);
        $this->db->select_as("$this->tbl_as.warna", "warna", 0);
        $this->db->select_as("$this->tbl_as.kapasitas_mesin", "kapasitas_mesin", 0);
        $this->db->select_as("$this->tbl_as.kapasitas_angkutan", "kapasitas_angkutan", 0);
        $this->db->select_as("$this->tbl_as.availability", "availability", 0);
        $this->db->select_as("$this->tbl_as.created_at", "created_at", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->filter_keyword($keyword)->filter_is_active($is_active)->filter_created_at($created_at_from, $created_at_to);


        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function countAll($keyword = '', $created_at_from = '', $created_at_to = '', $is_active = '')

    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->filter_keyword($keyword)->filter_is_active($is_active)->filter_created_at($created_at_from, $created_at_to);


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
