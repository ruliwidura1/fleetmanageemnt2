<?php

/**
 * Controller untuk Arrival
 *
 * @version 1.0.0
 *
 * @package FleetManagement/Admin
 * @since 1.0.0
 */
class Arrival extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
        $this->current_parent = 'fleetmanagement';
        $this->current_page = 'fleetmanagement_arrival';
        $this->load("admin/c_arrival_model","cam");
        $this->load('a_vehicle_concern');
        $this->load("admin/a_vehicle_model","avm");
        $this->load("admin/b_driver_model","bdm");
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }
        $data['driver_list'] = $this->bdm->get();
        $data['vehicle_list'] = $this->avm->get();
        
        $this->setTitle("Fleet Management: Arrival " . $this->config->semevar->admin_site_suffix);
        $this->putThemeContent("fleetmanagement/arrival/home_modal", $data);
        $this->putThemeContent("fleetmanagement/arrival/home", $data);
        $this->putJsContent("fleetmanagement/arrival/home_bottom", $data);
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
			redir(base_url_admin('fleetmanagement/arrival/'));
			die();
		}
		$cam = $this->cam->id($id);
		$bdm = $this->bdm->id($cam->b_driver_id);
		$avm = $this->avm->id($cam->a_vehicle_id);
	
		if (!isset($cam->id) || !isset($bdm->id) || !isset($avm->id)) {
			redir(base_url_admin('fleetmanagement/arrival/'));
			die();
		}

		$data['cam'] = $cam;
		$data['bdm'] = $bdm;
		$data['avm'] = $avm;

		$this->setTitle('Fleet Management: Arrival: Detail '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/arrival/detail",$data);
		$this->putJsContent("fleetmanagement/arrival/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    } 
}