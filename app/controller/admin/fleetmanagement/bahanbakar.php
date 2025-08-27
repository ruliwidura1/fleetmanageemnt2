<?php

/**
 * Controller for Pembelian BBM Module on Admin point of view
 *   Mostly this controller will render html page then output as http response
 *
 * @version 1.0.0
 *
 * @package FleetManagement/Admin
 * @since 1.0.0
 */
class Bahanbakar extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_bahanbakar';
        $this->module_path = 'fleetmanagement/bahanbakar/';
        
        $this->load('a_vehicle_concern');
        $this->load("admin/a_vehicle_model","avm");

        $this->load('b_bensin_concern');
        $this->load("admin/b_bensin_model","bbm");
    }

    /**
     * Render module home page that contains list of data using data table
     *
     * @return void
     */
    public function index()
    {
        $data = $this->initialize();
        $this->admin_authentication();
        
        $this->setTitle("Fleet Management: Pembelian BBM " . $this->config_semevar('admin_site_suffix'));

        $this->putThemeContent("fleetmanagement/bahanbakar/home_modal", $data);
        $this->putThemeContent("fleetmanagement/bahanbakar/home", $data);
        $this->putJsContent("fleetmanagement/bahanbakar/home_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();

    }

    /**
     * Render "create new" page for current module that contains forms input
     *
     * @return void
     */
    public function baru()
    {
        $data = $this->initialize();
        $this->admin_authentication();
        
        $this->setTitle("Fleet Management: Pembelian BBM: Buat Baru " . $this->config_semevar('admin_site_suffix'));

        $this->putThemeContent("fleetmanagement/bahanbakar/baru_modal", $data);
        $this->putThemeContent("fleetmanagement/bahanbakar/baru", $data);
        $this->putJsContent("fleetmanagement/bahanbakar/baru_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();

    }

    /**
     * Process for refine detail data
     *
     * @param int       $id     Defined id that will be retrieved
     * @param array     $data   Defined data that will be fined
     * @return array
     */
    private function detail_data($id, $data)
    {
		$id = (int) $id;
		if ($id<=0) {
			redir(base_url_admin('fleetmanagement/bahanbakar/'));
			return;
		}

		$bbm = $this->bbm->id($id);
        if (!isset($bbm->id)) {
			redir(base_url_admin('fleetmanagement/bahanbakar/'));
			return;
        }

        // generate total pembelian for this case only, please remove on the other case
        $bbm->jumlah_beli = 0;
        if (!is_null($bbm->jumlah_beli)) {
            $bbm->jumlah_beli = number_format($bbm->jumlah_beli, 0, ',', '.').' liter';
        }
        if (!is_null($bbm->jumlah_beli)) {
            $bbm->jumlah_beli = 'Rp'.number_format($bbm->jumlah_beli, 0, ',', '.');
        }

		$data['id'] = $id;
		$data['current_data'] = $bbm;

        return $data;
    }

    /**
     * Render "Detail" page for current module
     *
     * @return void
     */
    public function detail($id){
		$data = $this->initialize();
        $this->admin_authentication();
        $data = $this->detail_data($id, $data);
		$this->setTitle('Fleet Management: Bahan Bakar: Detail #'.$id.''.$this->config_semevar('admin_site_suffix'));
		$this->putThemeContent("fleetmanagement/bahanbakar/detail",$data);
		$this->putJsContent("fleetmanagement/bahanbakar/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    } 

    /**
     * Render HTML form page for editing data in current module
     *
     * @return void
     */
    public function edit($id)
    {
        $data = $this->initialize();
        $this->admin_authentication();
        $data = $this->detail_data($id, $data);
        $this->setTitle('Fleet Management: Pembelian BBM: Edit #'.$id.' '. $this->config_semevar('admin_site_suffix'));
        $this->putThemeContent("fleetmanagement/bahanbakar/edit_modal", $data);
        $this->putThemeContent("fleetmanagement/bahanbakar/edit", $data);
        $this->putJsContent("fleetmanagement/bahanbakar/edit_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();
    }
}