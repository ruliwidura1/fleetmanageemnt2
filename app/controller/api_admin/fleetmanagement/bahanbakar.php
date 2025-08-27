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

        $this->load('d_pembelianbbm_concern');
        $this->load("api_admin/d_pembelianbbm_model", "dpbbmm");
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

        $table_alias = $this->dpbbmm->table_alias;
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
        $datatable_count = $this->dpbbmm->datatable_count($keyword);
        $datatable_list = $this->dpbbmm->datatable_list($page, $pagesize, $sortCol, $sortDir, $keyword);

        foreach ($datatable_list as &$dt) {
            $dt->total_pembelian = '-';
            // optional, reformating before the output
            if (!is_null($dt->total_pembelian_per_liter)) {
                $dt->total_pembelian = 'Rp'.number_format($dt->total_pembelian_per_liter, 0, ',', '.');
            }
            if (!is_null($dt->total_pembelian_harga)) {
                $dt->total_pembelian = number_format($dt->total_pembelian_harga, 0, ',', '.');
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
        
        
        $this->dpbbmm->transaction_start();
        $res = $this->dpbbmm->insert($data_to_insert);
        if ($res) {
            $this->status = 200;
            $this->message = 'New data was inserted successfully';
            $this->dpbbmm->transaction_commit();
        } else {
            $this->status = 900;
            $this->message = 'Failed inseting new data to table';
            $this->dpbbmm->transaction_rollback();
        }
        $this->dpbbmm->transaction_end();
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
        $data = $this->dpbbmm->id($id);
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
        

        $this->dpbbmm->transaction_start();
        $res = $this->dpbbmm->update($id, $data_to_update);
        if ($res) {
            $this->status = 200;
            $this->message = 'Success';
            $this->dpbbmm->transaction_commit();
        } else {
            $this->status = 901;
            $this->message = 'Cannot update the data with supplied ID right now';
            $this->dpbbmm->transaction_rollback();
        }
        $this->dpbbmm->transaction_end();
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

        $dppbbmm = $this->dppbbmm->id($id);
        if (!isset($dppbbmm->id)) {
            $this->status = 520;
            $this->message = 'Data with supplied ID was not exists';
            $this->__json_out($data);
            return;
        }
        
        $this->dppbbmm->transaction_start();
        $res = $this->dppbbmm->delete($id);
        if ($res) {
            $this->status = 200;
            $this->message = 'successs';
            $this->dppbbmm->transaction_commit();
        }else{
            $this->status = 902;
            $this->message = 'Cannot delete data using current ID';
            $this->dppbbmm->transaction_rollback();
        }
        $this->dppbbmm->transaction_end();
        $this->__json_out($data);
    }

    public function cari()
    {
        $keyword = $this->input->request("keyword");
        if (empty($keyword)) $keyword = "";
        $p = new stdClass();
        $p->id = 'NULL';
        $p->text = '-';
        $data = $this->dpbbmm->cari($keyword);
        array_unshift($data, $p);
        $this->__json_select2($data);
    }
}