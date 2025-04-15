<?php
namespace Model;

register_namespace(__NAMESPACE__);
/**
 * Define all general method(s) and constant(s) for a_pengguna table,
 *   can be inherited a Concern class also can be reffered as class constants
 *
 * @version 1.0.0
 *
 * @package Model\Concern
 * @since 1.0.0
 */
class A_Pengguna_Concern extends \JI_Model
{
    public $tbl = 'a_pengguna';
    public $tbl_as = 'ap';

    public function __construct()
    {
        parent::__construct();
        $this->db->from($this->tbl, $this->tbl_as);
    }

    public function username($username)
    {
        return $this->db
            ->from($this->tbl, $this->tbl_as)
            ->where("$this->tbl_as.username", $username, 'AND', 'LIKE')
            ->get_first('object', 0);
    }
}