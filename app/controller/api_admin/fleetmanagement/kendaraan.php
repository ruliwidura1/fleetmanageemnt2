<?php

/**
 * Controller for Vehicle module on API Admin point of view
 *   Mostly this controller will produce JSON to support data manipulation for current module
 *
 * @version 1.0.0
 *
 * @package FleetManagement\Api_Admin
 * @since 1.0.0
 */
class Kendaraan extends \JI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lib("seme_purifier");
        $this->load('a_vehicle_concern');
        $this->load("api_admin/a_vehicle_model", 'avm');
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_kendaraan';
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

        $draw = $this->input->post("draw");
        $sSearch = $this->input->post("sSearch");
        $page = $this->input->post("iDisplayStart");
        $pagesize = $this->input->post("iDisplayLength");

        $iSortCol_0 = $this->input->post("iSortCol_0");
        $sSortDir_0 = $this->input->post("sSortDir_0");

        $sortCol = "date";
        $sortDir = strtoupper($sSortDir_0);
        if (empty($sortDir)) $sortDir = "DESC";
        if (strtolower($sortDir) != "desc") {
            $sortDir = "ASC";
        }

        $table_alias = $this->avm->table_alias;

        switch ($iSortCol_0) {
            case 0:
                $sortCol = "$table_alias.id";
                break;
            case 1:
                $sortCol = "$table_alias.nama";
                break;
            case 2:
                $sortCol = "$table_alias.utype";
                break;
            case 3:
                $sortCol = "$table_alias.plat_nomor";
                break;
            case 4:
                $sortCol = "$table_alias.merk";
                break;
            case 5:
                $sortCol = "$table_alias.warna";
                break;
            case 6:
                $sortCol = "$table_alias.kapasitas_mesin";
                break;
            case 7:
                $sortCol = "$table_alias.kapasitas_angkutan";
                break;
            case 8:
                $sortCol = "$table_alias.availability";
                break;
            case 9:
                $sortCol = "$table_alias.created_at";
                break;
            case 10:
                $sortCol = "$table_alias.is_active";
                break;
            default:
                $sortCol = "$table_alias.id";
        }

        if (empty($draw)) $draw = 0;
        if (empty($pagesize)) $pagesize = 10;
        if (empty($page)) $page = 0;


        $kendaraan_tipe = $this->input->request('kendaraan_tipe', '');
        $created_at_from = $this->input->request('created_at_from', '');
        $created_at_to = $this->input->request('created_at_to', '');
        $is_active = $this->input->request('is_active', '');

        $keyword = $sSearch;

        $this->status = 200;
        $this->message = 'Berhasil';
        $datatable_count = $this->avm->datatable_count($keyword, $kendaraan_tipe, $created_at_from, $created_at_to, $is_active);
        $datatable_list = $this->avm->datatable_list($page, $pagesize, $sortCol, $sortDir, $keyword, $kendaraan_tipe, $created_at_from, $created_at_to, $is_active);
        foreach ($datatable_list as &$dt) {
            if (isset($dt->nama)) {
                $dt->nama = htmlentities(rtrim($dt->nama, ' - '));
            }
            if (isset($dt->created_at)) {
                $dt->created_at = $this->__dateIndonesia($dt->created_at, 'hari_tanggal_jam');
            }
            if (isset($dt->is_active)) {
                if (!empty($dt->is_active)) {
                    $dt->is_active = '<label class="label label-success">Aktif</label>';
                } else {
                    $dt->is_active = '<label class="label label-default">Tidak Aktif</label>';
                }
            }
        }

        $this->__jsonDataTable($datatable_list, $datatable_count);
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
        $data_to_insert['created_at'] = 'NOW()';
        $data_to_insert['updated_at'] = 'NULL';
        
        
        $this->avm->transaction_start();
        $res = $this->avm->set($data_to_insert);
        if ($res) {
            $this->status = 200;
            $this->message = 'New data was inserted successfully';
            $this->avm->transaction_commit();
        } else {
            $this->status = 900;
            $this->message = 'Failed inseting new data to table';
            $this->avm->transaction_rollback();
        }
        $this->avm->transaction_end();
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
        $data = $this->avm->id($id);
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

        $this->avm->transaction_start();
        $res = $this->avm->update($id, $data_to_update);
        if ($res) {
            $this->status = 200;
            $this->message = 'Success';
            $this->avm->transaction_commit();
        } else {
            $this->status = 901;
            $this->message = 'Tidak dapat menambahkan data kendaraan';
            $this->avm->transaction_rollback();
        }
        $this->avm->transaction_end();
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

        $avm = $this->avm->id($id);
        if (!isset($avm->id)) {
            $this->status = 520;
            $this->message = 'Data with supplied ID was not exists';
            $this->__json_out($data);
            return;
        }

        $this->avm->transaction_start();
        $res = $this->avm->delete($id);
        if ($res) {
            $this->status = 200;
            $this->message = 'successs';
            $this->avm->transaction_commit();
        } else {
            $this->status = 902;
            $this->message = 'Cannot delete data using current ID';
            $this->avm->transaction_rollback();
        }
        $this->avm->transaction_end();
        $this->__json_out($data);
    }

    public function statistik()
    {
        $d = $this->initialize();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Harus login';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $utype = $this->input->post('utype');
        $statistik = array();
        $statistik['tersedia'] = $this->avm->countByStatus('Tersedia', $utype);
        $statistik['digunakan'] = $this->avm->countByStatus('Digunakan', $utype);
        $statistik['diperbaiki'] = $this->avm->countByStatus('Diperbaiki', $utype);

        $this->status = 200;
        $this->message = 'Berhasil';
        $data = $statistik;
        $this->__json_out($data);
    }

    public function cari()
    {
        $keyword = $this->input->request("keyword");
        if (empty($keyword)) $keyword = "";
        $data = $this->avm->getSearch($keyword);
        $this->__json_select2($data);
    }
}
