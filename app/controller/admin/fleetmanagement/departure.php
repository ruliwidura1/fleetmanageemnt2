<?php

/**
 * Controller untuk Departure
 *
 * @version 1.0.0
 *
 * @package FleetManagement/Admin
 * @since 1.0.0
 */
class Departure extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_departure';
        $this->load("admin/c_departure_model","crm");
        $this->load('a_vehicle_concern');
        $this->load("admin/a_vehicle_model","avm");
        $this->load("admin/b_driver_model","bdm");
    }

    public function index()
    {
        $data = $this->initialize();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }
        $data['driver_list'] = $this->bdm->get();
        $data['vehicle_list'] = $this->avm->get();
        
        $this->setTitle("Fleet Management: Departure " . $this->config->semevar->admin_site_suffix);
        $this->putThemeContent("fleetmanagement/departure/home_modal", $data);
        $this->putThemeContent("fleetmanagement/departure/home", $data);
        $this->putJsContent("fleetmanagement/departure/home_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();
    }

    public function detail($id){
		$data = $this->initialize();
		if(!$this->admin_login){
			redir(base_url_admin('login'));
			die();
		}
		$id = (int) $id;
		if($id<=0){
			redir(base_url_admin('fleetmanagement/departure/'));
			die();
		}
		$crm = $this->crm->id($id);
		$bdm = $this->bdm->id($crm->b_driver_id);
		$avm = $this->avm->id($crm->a_vehicle_id);
	
		if (!isset($crm->id) || !isset($bdm->id) || !isset($avm->id)) {
			redir(base_url_admin('fleetmanagement/departure/'));
			die();
		}

		$data['crm'] = $crm;
		$data['bdm'] = $bdm;
		$data['avm'] = $avm;

		$this->setTitle('Fleet Management: Departure: Detail '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/departure/detail",$data);
		$this->putJsContent("fleetmanagement/departure/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    } 
}