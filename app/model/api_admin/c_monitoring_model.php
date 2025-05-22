<?php
class C_Monitoring_model extends \Model\A_Vehicle_Concern
{
    var $tbl = 'c_monitoring';
    var $tbl_as = 'cm';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }


    private function filter_keyword($keyword = '')
    {
        if (strlen($keyword) > 0) {
            $this->db->where_as("$this->tbl_as.nama", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.utype", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("$this->tbl_as.no_pol", $keyword, "OR", "%like%", 0, 0);

        }
    }

    public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $utype = '', $sdate = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("$this->tbl_as.id", "id", 0);
        $this->db->select_as("$this->tbl_as.integrasi_gps_tracking", "integrasi_gps_tracking", 0);
        $this->db->select_as("$this->tbl_as.pelacakan_posisi_realtime_kendaraan", "pelacakan_posisi_realtime_kendaraan", 0);
        $this->db->select_as("$this->tbl_as.riwayat_rute_perjalanan", "riwayat_rute_perjalanan", 0);
        $this->db->select_as("$this->tbl_as.alert_perjalanan_berlebih", "alert_perjalanan_berlebih", 0);
        $this->db->select_as("$this->tbl_as.geofencing", "geofencing", 0);
        $this->db->select_as("$this->tbl_as.is_active", "is_active", 0);
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
