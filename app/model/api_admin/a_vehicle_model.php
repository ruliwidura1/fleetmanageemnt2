<?php
class A_Vehicle_Model extends \Model\A_Vehicle_Concern
{
    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->table, $this->table_alias);
    }

    public function countByStatus($availability = "", $utype = "")
    {
        $availability = $this->db->esc($availability);
        $utype = $this->db->esc($utype);
        $this->db->where_as("$this->table_alias.availability", $availability);
        if (strlen($utype)) {
            $this->db->where_as("$this->table_alias.utype", $utype);
        }

        $this->db->select_as("COUNT($this->table_alias.id)", "jumlah", 0);

        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return (int)$d->jumlah;
        return 0;
    }

    public function datatable_list($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $utype='', $created_at_from = '', $created_at_to = '', $is_active = '')
    {
        $this->db->select_as("$this->table_alias.id", "id", 0);
        $this->db->select_as("$this->table_alias.nama", "nama", 0);
        $this->db->select_as("$this->table_alias.utype", "utype", 0);
        $this->db->select_as("$this->table_alias.plat_nomor", "plat_nomor", 0);
        $this->db->select_as("$this->table_alias.merk", "merk", 0);
        $this->db->select_as("$this->table_alias.warna", "warna", 0);
        $this->db->select_as("$this->table_alias.kapasitas_mesin", "kapasitas_mesin", 0);
        $this->db->select_as("$this->table_alias.kapasitas_angkutan", "kapasitas_angkutan", 0);
        $this->db->select_as("$this->table_alias.availability", "availability", 0);
        $this->db->select_as("$this->table_alias.created_at", "created_at", 0);
        $this->db->select_as("$this->table_alias.is_active", "is_active", 0);
        $this->db->from($this->table, $this->table_alias);
        $this->filter_keyword($keyword)->filter_utype($utype)->filter_is_active($is_active)->filter_created_at($created_at_from, $created_at_to);
        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function datatable_count($keyword = '', $utype = '', $created_at_from = '', $created_at_to = '', $is_active = '')
    {
        $this->db->select_as("COUNT($this->table_alias.id)", "total", 0);
        $this->db->from($this->table, $this->table_alias);
        $this->filter_keyword($keyword)->filter_utype($utype)->filter_is_active($is_active)->filter_created_at($created_at_from, $created_at_to);


        $d = $this->db->get_first("object", 0);
        if (isset($d->total)) return $d->total;
        return 0;
    }

    public function get()
    {
        $this->db->where("is_active", 1);
        return $this->db->get();
    }

    public function count()
    {
        $this->db->select_as("COUNT(*)", "total", 0);
        $this->db->where("is_active", 1);
        $d = $this->db->get_first();
        if (isset($d->total)) return $d->total;
        return 0;
    }

    public function getSearch($keyword = '')
    {
        $this->db->select_as("$this->table_alias.id", "id", 0);
        $this->db->select_as("$this->table_alias.nama", "text", 0);
        $this->db->where("is_active", 1);
        if ($keyword) {
            $this->db->where("nama", $keyword, "like%%", "AND", "!=");
            $this->db->where("utype", $keyword, "like%%", "AND", "!=");
            $this->db->where("plat_nomor", $keyword, "like%%", "AND", "!=");
            $this->db->where("availability", $keyword, "like%%", "AND", "!=");
        }
        return $this->db->get();
    }
}
