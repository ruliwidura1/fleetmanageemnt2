<?php

namespace Model\Admin\API;

register_namespace(__NAMESPACE__);

use Model;

/**
* Scoped `api_admin` class model for `b_vote` table
*
* @version 1.0.0
*
* @package Model\a_pengguna_model\Admin\API
* @since 1.0.0
*/
class A_Pengguna_Model extends \Model\A_Pengguna_Concern
{
    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }

    public function trans_start()
    {
        $r = $this->db->autocommit(0);
        if($r) {
            return $this->db->begin();
        }
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
        $this->db->select_as("COALESCE(MAX($this->tbl_as.id),0)+1", "last_id", 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $d = $this->db->get_first('', 0);
        if(isset($d->last_id)) {
            return $d->last_id;
        }
        return 0;
    }

    public function getAll($page = 1, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as('id', 'id', 0)
             ->select('foto')
             ->select('username')
             ->select('email')
                         ->select('nama')
                         ->select('is_active')
        ;
        $this->db->from($this->tbl, $this->tbl_as);
        if(strlen($is_active) > 0) {
            $this->db->where_as("is_active", $this->db->esc($is_active));
        }
        if(strlen($keyword) > 0) {
            $this->db->where("username", $keyword, "OR", "%like%", 1, 0);
            $this->db->where("email", $keyword, "OR", "%like%", 0, 1);
        }
        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }
    public function countAll($keyword = '', $is_active = '', $edate = '')
    {
        $this->db->flushQuery();
        $this->db->select_as("COUNT(*)", "jumlah", 0);
        if(strlen($is_active) > 0) {
            $this->db->where_as("is_active", $this->db->esc($is_active));
        }
        if(strlen($keyword) > 0) {
            $this->db->where("username", $keyword, "OR", "%like%", 1, 0);
            $this->db->where("email", $keyword, "OR", "%like%", 0, 1);
        }
        $d = $this->db->from($this->tbl)->get_first("object", 0);
        if(isset($d->jumlah)) {
            return $d->jumlah;
        }
        return 0;
    }
    public function id($id)
    {
        $this->db->where("id", $id);
        return $this->db->get_first();
    }
    public function set($di)
    {
        if(!is_array($di)) {
            return 0;
        }
        return $this->db->insert($this->tbl, $di, 0, 0);
    }
    public function update($id, $du)
    {
        if(!is_array($du)) {
            return 0;
        }
        $this->db->where("id", $id);
        return $this->db->update($this->tbl, $du, 0);
    }
    public function del($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete($this->tbl);
    }
    public function checkusername($username, $id = 0)
    {
        $this->db->select_as("COUNT(*)", "jumlah", 0);
        $this->db->where("username", $username);
        if(!empty($id)) {
            $this->db->where("id", $id, 'AND', '!=');
        }
        $d = $this->db->from($this->tbl, $this->tbl_as)->get_first("object", 0);
        if(isset($d->jumlah)) {
            return $d->jumlah;
        }
        return 0;
    }

    public function getTerapisByCompanyId($keyword = "", $a_company_id = "", $who_first = "")
    {
        $this->db->select_as("$this->tbl_as.*, COALESCE($this->tbl2_as.nama,'terapis')", 'jabatan', 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_jabatan_id', 'left');

        $this->db->where_as("$this->tbl_as.is_active", $this->db->esc('1'));
        if(strlen($a_company_id)) {
            $this->db->where_as("$this->tbl_as.a_company_id", $a_company_id, 'AND', '=', 0, 0);
        }

        $this->db->where_as("$this->tbl2_as.nama", ('Dokter'), 'OR', '%like%', 1, 0);
        $this->db->where_as("$this->tbl2_as.nama", ('Perawat'), 'OR', '%like%', 0, 0);
        $this->db->where_as("$this->tbl2_as.nama", ('Terapis'), 'AND', '%like%', 0, 1);

        if(strlen($keyword)) {
            $this->db->where_as("$this->tbl_as.nama", $keyword, 'OR', 'like%%', 1, 0);
            $this->db->where_as("$this->tbl_as.username", $keyword, 'OR', 'like%%', 0, 0);
            $this->db->where_as("$this->tbl_as.email", $keyword, 'OR', 'like%%', 0, 1);
        }

        $this->db->order_by("$this->tbl_as.nama", 'asc');
        $this->db->order_by("$this->tbl2_as.nama", 'asc');
        return $this->db->get('', 0);
    }
}