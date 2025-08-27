<?php

/**
 * Controller for "Pembelian BBM" module on API Admin point of view
 *   Mostly this controller will produce JSON to support data manipulation for current module
 *
 * @version 1.0.0
 *
 * @package FleetManagement\Api_Admin
 * @since 1.0.0
 */
class Bahanbakar extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load('a_vehicle_concern');
        $this->load("api_admin/a_vehicle_model", "avm");

        $this->load('b_bensin_concern');
        $this->load("api_admin/b_bensin_model", "bbm");
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_bahanbakar';
    }

    /**
     * Render http response in json format with it's http header to supporting data table data
     *
     * @return void
     */
    public function index()
    {
        $d = $this->initialize();
        $data = array();
        $this->api_admin_authentication($data);
        
        $keyword = $this->input->post("sSearch");
        $page = $this->input->post("iDisplayStart");
        $pagesize = $this->input->post("iDisplayLength");
        $iSortCol_0 = $this->input->post("iSortCol_0");
        $sSortDir_0 = $this->input->post("sSortDir_0");

        // advanced filtering
        $sdate = $this->input->request("sdate");
        $edate = $this->input->request("edate");

        if (strlen($sdate) == 10 && strlen($edate) == 10) {
            $sdate = date("Y-m-d", strtotime($sdate));
            $edate = date("Y-m-d", strtotime($edate));
        } else if (strlen($sdate) == 10 && strlen($edate) != 10) {
            $sdate = date("Y-m-d", strtotime($sdate));
            $edate = $sdate;
        } else if (strlen($sdate) != 10 && strlen($edate) == 10) {
            $edate = date("Y-m-d", strtotime($edate));
            $sdate = $edate;
        }

        $sortCol = "id";
        $sortDir = strtoupper($sSortDir_0);
        if (empty($sortDir)) $sortDir = "DESC";
        if (strtolower($sortDir) != "desc") {
            $sortDir = "ASC";
        }

        $table_alias = $this->bbm->table_alias;
        switch ($iSortCol_0) {
            case 1:
                $sortCol = "$table_alias.created_at";
                break;
            case 2:
                $sortCol = "$table_alias.kendaraan";
                break;
            case 3:
                $sortCol = "$table_alias.jenis";
                break;
            default:
                $sortCol = "$table_alias.id";
        }
        if (empty($pagesize)) $pagesize = 10;
        if (empty($page)) $page = 0;

        $this->status = 200;
        $this->message = 'Success';
        $datatable_count = $this->bbm->datatable_count($keyword);
        $datatable_list = $this->bbm->datatable_list($page, $pagesize, $sortCol, $sortDir, $keyword);

        foreach ($datatable_list as &$dt) {
            $dt->total_pembelian = '-';
            // optional, reformating before the output
            if (!is_null($dt->total_harga)) {
                $dt->total_pembelian = 'Rp'.number_format($dt->total_harga, 0, ',', '.');
            }
            if (!is_null($dt->total_harga)) {
                $dt->total_pembelian = number_format($dt->total_harga, 0, ',', '.');
            }
        }

        $this->__jsonDataTable($datatable_list, $datatable_count);
    }

    /**
     * Process helper for determine value when the value has null
     *
     * @param [type] $data_to_insert
     * @return void
     */
    private function adjust_total_pembelian($data_to_insert)
    {
        if (isset($data_to_insert['total_pembelian_per_liter']) && empty($data_to_insert['total_pembelian_per_liter'])) {
            $data_to_insert['total_pembelian_per_liter'] = 'NULL';
        }
        if (isset($data_to_insert['total_pembelian_harga']) && empty($data_to_insert['total_pembelian_harga'])) {
            $data_to_insert['total_pembelian_harga'] = 'NULL';
        }

        return $data_to_insert;
    }


    /**
     * Render http response in json format for accomodating insert data
     *
     * @return void
     */
    public function baru()
    {
        $d = $this->initialize();
        $data = array();
        $this->api_admin_authentication($data);

        $data_to_insert = $_POST;
        foreach ($data_to_insert as $k => $v) {
            $data_to_insert[$k] = strip_tags($v);
        }

        // default value fo created_at, please adjust this on the other cases\
        $data_to_insert['a_vehicle_id'] = 'NOW()';
        $data_to_insert['c_driver_id'] = 'NOW()';
        $data_to_insert['created_at'] = 'NOW()';
        $data_to_insert['updated_at'] = 'NULL';

        // remove or change this validation on other case
        $data_to_insert = $this->adjust_total_pembelian($data_to_insert);
        
        
        $this->bbm->transaction_start();
        $res = $this->bbm->insert($data_to_insert);
        if ($res) {
            $this->status = 200;
            $this->message = 'New data was inserted successfully';
            $this->bbm->transaction_commit();
        } else {
            $this->status = 900;
            $this->message = 'Failed inseting new data to table';
            $this->bbm->transaction_rollback();
        }
        $this->bbm->transaction_end();
        $this->__json_out($data);
    }
    
    /**
     * Render http response in json format for showing detail of data
     *
     * @return void
     */
    public function detail($id)
    {
        $id = (int) $id;
        $d = $this->initialize();
        $data = array();
        $this->api_admin_authentication($data);
        $this->status = 200;
        $this->message = 'Success';
        $data = $this->bbm->id($id);
        if (!isset($data->id)) {
            $data = new \stdClass();
            $this->status = 441;
            $this->message = 'No Data';
        }
        $this->__json_out($data);
    }
    
    /**
     * Render http response in json format for edit of data
     *
     * @return void
     */
    public function edit($id)
    {
        $d = $this->initialize();
        $data = array();
        $this->api_admin_authentication($data);

        $id = (int) $id;
        if ($id <= 0) {
            $this->status = 444;
            $this->message = 'Invalid Supplied ID';
            $this->__json_out($data);
            return;
        }

        $data_to_update = $_POST;
        if (isset($data_to_update['id'])) {
            unset($data_to_update['id']);
        }

        // add updated_at value
        $data_to_update['updated_at'] = 'NOW()';

        // remove or change this validation on other case
        $data_to_update = $this->adjust_total_pembelian($data_to_update);
        

        $this->bbm->transaction_start();
        $res = $this->bbm->update($id, $data_to_update);
        if ($res) {
            $this->status = 200;
            $this->message = 'Success';
            $this->bbm->transaction_commit();
        } else {
            $this->status = 901;
            $this->message = 'Cannot update the data with supplied ID right now';
            $this->bbm->transaction_rollback();
        }
        $this->bbm->transaction_end();
        $this->__json_out($data);
    }

    
    /**
     * Render http response in json format for deleting data using supplied ID
     *
     * @return void
     */
    public function hapus($id)
    {
        $id = (int) $id;
        $d = $this->initialize();
        $data = array();
        $this->api_admin_authentication($data);

        $id = (int) $id;
        if ($id <= 0) {
            $this->status = 444;
            $this->message = 'Invalid Supplied ID';
            $this->__json_out($data);
            return;
        }

        $dppbbbm = $this->dppbbbm->id($id);
        if (!isset($dppbbbm->id)) {
            $this->status = 520;
            $this->message = 'Data with supplied ID was not exists';
            $this->__json_out($data);
            return;
        }
        
        $this->dppbbbm->transaction_start();
        $res = $this->dppbbbm->delete($id);
        if ($res) {
            $this->status = 200;
            $this->message = 'successs';
            $this->dppbbbm->transaction_commit();
        }else{
            $this->status = 902;
            $this->message = 'Cannot delete data using current ID';
            $this->dppbbbm->transaction_rollback();
        }
        $this->dppbbbm->transaction_end();
        $this->__json_out($data);
    }

    public function cari()
    {
        $keyword = $this->input->request("keyword");
        if (empty($keyword)) $keyword = "";
        $p = new stdClass();
        $p->id = 'NULL';
        $p->text = '-';
        $data = $this->bbm->cari($keyword);
        array_unshift($data, $p);
        $this->__json_select2($data);
    }
}