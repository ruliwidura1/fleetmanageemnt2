<?php
class C_Acservice_Model extends \Model\C_Acservice_Concern
{
  var $tbl = 'c_acservice';
  var $tbl_as = 'cam';

  public function __construct()
  {
    parent::__construct();
    $this->db->from($this->tbl, $this->tbl_as);
  }

  public function getAll($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $sdate = '', $edate = '', $is_proses = '')
  {
    $this->db->flushQuery();
    $this->db->select_as("$this->tbl_as.id", "id", 0);
    $this->db->select_as("$this->tbl_as.pelanggan_nama", "pelanggan_nama", 0);
    $this->db->select_as("$this->tbl_as.merk_ac", "merk_ac", 0);
    $this->db->select_as("$this->tbl_as.remot_jenis", "remot_jenis", 0);
    $this->db->select_as("$this->tbl_as.remot_kode", "remot_kode", 0);
    $this->db->select_as("$this->tbl_as.telp", "telp", 0);
    $this->db->select_as("$this->tbl_as.deskripsi_kerusakan", "deskripsi_kerusakan", 0);
    $this->db->select_as("$this->tbl_as.tanggal_perbaikan", "tanggal_perbaikan", 0);
    $this->db->select_as("$this->tbl_as.teknisi_1_nama", "teknisi_1_nama", 0);
    $this->db->select_as("$this->tbl_as.teknisi_2_nama", "teknisi_2_nama", 0);
    $this->db->select_as("$this->tbl_as.teknisi_3_nama", "teknisi_3_nama", 0);
    $this->db->select_as("$this->tbl_as.is_proses", "is_proses", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->filter_keyword($keyword)->filter_is_proses($is_proses)->filter_sdate($sdate, $edate);

    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }

  public function countAll($keyword = '', $sdate = '', $edate = '' , $is_proses = '')
  {
    $this->db->flushQuery();
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->filter_keyword($keyword)->filter_is_proses($is_proses)->filter_sdate($sdate, $edate);


    $d = $this->db->get_first("object", 0);
    if (isset($d->jumlah)) return $d->jumlah;
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
