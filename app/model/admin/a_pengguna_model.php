<?php

class A_Pengguna_Model extends \Model\A_Pengguna_Concern
{
    public $tbl = 'a_pengguna';
    public $tbl_as = 'ap';
    public $tbl2 = 'a_jabatan';
    public $tbl2_as = 'aj';
    public $tbl3 = 'c_produk';
    public $tbl3_as = 'cp';
    public $tbl4 = 'd_order';
    public $tbl4_as = 'dor';
    public $tbl5 = 'd_order_detail';
    public $tbl5_as = 'dod';
    public $tbl6 = 'b_kategori';
    public $tbl6_as = 'bk';
    public $tbl7 = 'd_redeem_produk';
    public $tbl7_as = 'drp';
    public $tbl8 = 'd_redeem';
    public $tbl8_as = 'dr';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }
    public function auth($username)
    {
        $username = strtolower($username);
        $this->db
            ->select("*")
            ->where_as("LOWER(email)", $this->db->esc($username), "OR", "like")
            ->where_as("LOWER(username)", $this->db->esc($username), "OR", "like");
        return $this->db->get_first('object', 0);
    }
    public function update($id, $du)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tbl, $du);
    }
    public function id($id)
    {

        $this->db->where("", $id);
        return $this->db->get_first();
    }

    public function getDokterByCabang($a_company_id)
    {
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "a_jabatan_id", "left");
        $this->db->where_as("LOWER($this->tbl2_as.nama)", $this->db->esc('dokter'));
        $this->db->where("a_company_id", $a_company_id);
        return $this->db->get();
    }

    public function getTerapisByCabang($a_company_id)
    {
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "a_jabatan_id", "left");
        $this->db->where_as("$this->tbl_as.is_active", 1);
        $this->db->where_as("$this->tbl_as.a_company_id", $a_company_id);
        $this->db->where_in("LOWER($this->tbl2_as.nama)", array('terapis','dokter','perawat'));
        return $this->db->get();
    }

    public function getTerapisPoinRedeem($a_pengguna_id, $beli_mindate, $beli_maxdate)
    {
        $this->db->select_as("$this->tbl7_as.a_pengguna_id_terapis", 'a_pengguna_id_terapis', 0);
        $this->db->select_as("$this->tbl3_as.nama", 'produk', 0);
        $this->db->select_as("$this->tbl3_as.poin_terapis", 'poin_terapis', 0);
        $this->db->select_as("COUNT(*)", 'total_tindakan', 0);
        $this->db->select_as("((cp.poin_terapis) * COUNT(*))", 'total_poin', 0);
        $this->db->from($this->tbl7, $this->tbl7_as);
        $this->db->between("DATE($this->tbl8_as.cdate)", "DATE('$beli_mindate')", "DATE('$beli_maxdate')");
        $this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl7_as, 'c_produk_id', '');
        $this->db->join($this->tbl8, $this->tbl8_as, "id", $this->tbl7_as, 'd_redeem_id', '');
        $this->db->join($this->tbl4, $this->tbl4_as, "id", $this->tbl8_as, 'd_order_id', '');
        $this->db->where_as("COALESCE($this->tbl7_as.a_pengguna_id_terapis,'0')", $a_pengguna_id);
        $this->db->where_as("COALESCE($this->tbl4_as.utype,'0')", $this->db->esc("order_selesai"));
        $this->db->group_by("$this->tbl7_as.c_produk_id");
        return $this->db->get('', 0);
    }

    public function getTerapisPoinOrder($a_pengguna_id, $beli_mindate, $beli_maxdate)
    {
        $this->db->select_as("$this->tbl5_as.a_pengguna_id_terapis", 'a_pengguna_id_terapis', 0);
        $this->db->select_as("$this->tbl3_as.nama", 'produk', 0);
        $this->db->select_as("$this->tbl3_as.utype", 'c_produk_utype', 0);
        $this->db->select_as("$this->tbl3_as.poin_terapis", 'poin_terapis', 0);
        $this->db->select_as("SUM($this->tbl5_as.qty)", 'total_tindakan', 0);
        $this->db->select_as("(($this->tbl3_as.poin_terapis) * SUM($this->tbl5_as.qty))", 'total_poin', 0);
        $this->db->from($this->tbl5, $this->tbl5_as);
        $this->db->join($this->tbl4, $this->tbl4_as, "id", $this->tbl5_as, 'd_order_id', '');
        $this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl5_as, 'c_produk_id', '');
        $this->db->where_as("COALESCE($this->tbl5_as.a_pengguna_id_terapis,'0')", $a_pengguna_id);
        $this->db->where_as("COALESCE($this->tbl4_as.utype,'0')", $this->db->esc("order_selesai"));
        $this->db->between("DATE($this->tbl4_as.date_order)", "DATE('$beli_mindate')", "DATE('$beli_maxdate')");
        $this->db->group_by("CONCAT($this->tbl5_as.c_produk_id,'-',$this->tbl5_as.a_pengguna_id_terapis)");
        return $this->db->get('', 0);
    }

    public function getAsistensiPoinRedeem($a_pengguna_id, $beli_mindate, $beli_maxdate)
    {
        $this->db->select_as("$this->tbl7_as.a_pengguna_id_asistensi", 'a_pengguna_id_asistensi', 0);
        $this->db->select_as("$this->tbl3_as.nama", 'produk', 0);
        $this->db->select_as("$this->tbl3_as.poin_asistensi", 'poin_asistensi', 0);
        $this->db->select_as("COUNT(*)", 'total_tindakan', 0);
        $this->db->select_as("((cp.poin_asistensi) * COUNT(*))", 'total_poin', 0);
        $this->db->from($this->tbl7, $this->tbl7_as);
        $this->db->between("DATE($this->tbl8_as.cdate)", "DATE('$beli_mindate')", "DATE('$beli_maxdate')");
        $this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl7_as, 'c_produk_id', '');
        $this->db->join($this->tbl8, $this->tbl8_as, "id", $this->tbl7_as, 'd_redeem_id', '');
        $this->db->join($this->tbl4, $this->tbl4_as, "id", $this->tbl8_as, 'd_order_id', '');
        $this->db->where_as("COALESCE($this->tbl7_as.a_pengguna_id_asistensi,'0')", $a_pengguna_id);
        $this->db->where_as("COALESCE($this->tbl4_as.utype,'0')", $this->db->esc("order_selesai"));
        $this->db->group_by("$this->tbl7_as.c_produk_id");
        return $this->db->get('', 0);
    }

    public function getAsistensiPoinOrder($a_pengguna_id, $beli_mindate, $beli_maxdate)
    {
        $this->db->select_as("$this->tbl5_as.a_pengguna_id_asistensi", 'a_pengguna_id_asistensi', 0);
        $this->db->select_as("$this->tbl3_as.nama", 'produk', 0);
        $this->db->select_as("$this->tbl3_as.poin_asistensi", 'poin_asistensi', 0);
        $this->db->select_as("SUM($this->tbl5_as.qty)", 'total_tindakan', 0);
        $this->db->select_as("((cp.poin_asistensi) * SUM($this->tbl5_as.qty))", 'total_poin', 0);
        $this->db->from($this->tbl5, $this->tbl5_as);
        $this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl5_as, 'c_produk_id', '');
        $this->db->join($this->tbl4, $this->tbl4_as, "id", $this->tbl5_as, 'd_order_id', '');
        $this->db->between("DATE($this->tbl4_as.date_order)", "DATE('$beli_mindate')", "DATE('$beli_maxdate')");
        $this->db->where_as("COALESCE($this->tbl5_as.a_pengguna_id_asistensi,'0')", $a_pengguna_id);
        $this->db->where_as("COALESCE($this->tbl4_as.utype,'0')", $this->db->esc("order_selesai"));
        $this->db->group_by("$this->tbl5_as.c_produk_id");
        return $this->db->get('', 0);
    }
}