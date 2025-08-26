<?php
/**
* Define all general method for all tables
*   For class models
*
* @package Core\Model
* @since 1.0
*/
class JI_Model extends \SENE_Model
{
    /** @var string  */
    public $tbl;

    /** @var string  */
    public $tbl_as;

        public $table_alias;

    public function __construct()
    {
        parent::__construct();
    }
    protected function set_table($table, $table_alias)
    {
        $this->table = $table;
        $this->table_alias = $table_alias;
    }

    /**
     * Insert a row data
     *
     * @param  array   $d   Contain associative array that represent the pair of column and value
     * @return int          Return last ID if succeed, otherwise will return 0
     */
    public function set($d)
    {
        $this->db->insert($this->tbl, $d, 0, 0);
        return $this->db->last_id;
    }

    /**
     * Update a row data by supplied ID
     *
     * @param  int      $id    Positive integer
     * @return boolean         True if succeed, otherwise false
     */
    public function update($id, $d)
    {
        $this->db->where("id", $id);
        return $this->db->update($this->tbl, $d, 0);
    }

    /**
     * Delete row data by ID
     *
     * @param  int      $id    Positive integer
     * @return boolean         True if succeed, otherwise false
     */
    public function del($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete($this->tbl);
    }

    /**
     * Get single row data by ID
     *
     * @param  int      $id     Positive integer
     * @return stdClass         Will return single row object, otherwise will return empty object
     */
    public function id($id)
    {
        $this->db->where("id", $id);
        return $this->db->from($this->tbl, $this->tbl_as)->get_first('', 0);
    }

    /**
     * Open the database transaction session
     * @return boolean True if succeed, otherwise false
     */
    public function trans_start()
    {
        $r = $this->db->autocommit(0);
        if ($r) {
            return $this->db->begin();
        }
        return false;
    }

    /**
     * Execute `commit` SQL command
     * @return boolean True if succeed, otherwise false
     */
    public function trans_commit()
    {
        return $this->db->commit();
    }

    /**
     * Rollback the database transaction session
     * @return boolean True if succeed, otherwise false
     */
    public function trans_rollback()
    {
        return $this->db->rollback();
    }

    /**
     * Finalize the database transaction session
     * @return boolean True if succeed, otherwise false
     */
    public function trans_end()
    {
        return $this->db->autocommit(1);
    }
}