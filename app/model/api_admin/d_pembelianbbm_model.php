<?php
/**
 * Model for table d_pembelianbbm for api_admin point of view
*
* @version 1.0.0
*
* @package Model\D_Pembelianbbm\Concern
* @since 1.0.0
 */
class D_Pembelianbbm_Model extends \Model\D_Pembelianbbm_Concern
{

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->table, $this->table_alias);
    }

    /**
     * Enable filter by keyword for certain column(s) on current table(s)
     *
     * @param string $keyword
     * @return object
     */
    private function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->table_alias.kendaraan", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->table_alias.jenis", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->table_alias.driver", $keyword, "OR", "%like%", 0, 1);
        }

        return $this;
    }

    /**
     * List all data against current table for data table response
     *
     * @param string $keyword
     * @return array
     */
    public function datatable_list($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->table_alias.id", "id", 0);
        $this->db->select_as("$this->table_alias.created_at", "created_at", 0);
        $this->db->select_as("$this->table_alias.kendaraan", "kendaraan", 0);
        $this->db->select_as("$this->table_alias.driver", "driver", 0);
        $this->db->select_as("$this->table_alias.jenis", "jenis", 0);
        $this->db->select_as("'0'", "total_pembelian", 0);
        $this->db->select_as("$this->table_alias.total_pembelian_per_liter", "total_pembelian_per_liter", 0);
        $this->db->select_as("$this->table_alias.total_pembelian_harga", "total_pembelian_harga", 0);
        $this->db->from($this->table, $this->table_alias);
        $this->filter_keyword($keyword);

        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    /**
     * Count all data against current table for data table response
     *
     * @param string $keyword
     * @return int
     */
    public function datatable_count($keyword = '')
    {
        $this->db->flushQuery();
        $this->db->from($this->table, $this->table_alias);
        $this->db->select_as("COUNT($this->table_alias.id)", "jumlah", 0);
        $this->filter_keyword($keyword);

        $d = $this->db->get_first("object", 0);
        if (isset($d->jumlah)) return $d->jumlah;
        return 0;
    }
}