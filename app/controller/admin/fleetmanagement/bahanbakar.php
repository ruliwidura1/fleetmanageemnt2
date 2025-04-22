<?php

/**
 * Controller untuk Bahanbakar
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
        $this->load('a_vehicle_concern');
        $this->load("admin/a_vehicle_model","avm");
        $this->load("admin/b_bensin_model","bbm");
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $data['vehicle_list'] = $this->avm->get();
        $this->setTitle("fleetmanagement: Bahanbakar " . $this->config->semevar->admin_site_suffix);

        $this->putThemeContent("fleetmanagement/bahanbakar/home_modal", $data);
        $this->putThemeContent("fleetmanagement/bahanbakar/home", $data);
        $this->putJsContent("fleetmanagement/bahanbakar/home_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();

    }

    public function detail($id){
		$data = $this->__init();
		if(!$this->admin_login){
			redir(base_url_admin('login'));
			die();
		}
		$id = (int) $id;
		if($id<=0){
			redir(base_url_admin('fleetmanagement/bahanbakar/'));
			die();
		}
		$bbm = $this->bbm->id($id);
		$avm = $this->avm->id($bbm->a_vehicle_id);
	
		if (!isset($bbm->id) || !isset($avm->id)) {
			redir(base_url_admin('fleetmanagement/bahanbakar/'));
			die();
		}

		$data['bbm'] = $bbm;
		$data['avm'] = $avm;

		$this->setTitle('Fleet Management: Bahan Bakar: Detail '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/bahanbakar/detail",$data);
		$this->putJsContent("fleetmanagement/bahanbakar/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    } 
}