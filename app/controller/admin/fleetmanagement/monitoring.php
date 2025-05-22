<?php

namespace Controller\Admin;

register_namespace(__NAMESPACE__);

/**
* Admin scoped controller for jabatan item kpi
*
* Mostly for this controller will resulting HTTP Body Content in HTML format
*
* @version 1.0.0
*
* @package FleetManagement\jenismerkkendaraan\Admin
* @since 1.0.0
*/
class Monitoring extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('a_vehicle_concern');
        $this->load('admin/c_monitoring_model', 'cmm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_monitoring';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: Monitoring dan Pelacakan '.$this->config->semevar->admin_site_suffix);
        $this->putThemeContent('fleetmanagement/monitoring/home_modal', $data);
        $this->putThemeContent('fleetmanagement/monitoring/home', $data);
        $this->putJsContent('fleetmanagement/monitoring/home_bottom', $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();
    }

	public function baru()
	{
        $data = $this->__init();
		if(!$this->admin_login){
			redir(base_url_admin('login'));
			die();
		}
		$pengguna = $data['sess']->admin;

		$this->setTitle('Fleet Management: Monitoring dan Pelacakan: Baru '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/monitoring/tambah_modal",$data);
		$this->putThemeContent("fleetmanagement/monitoring/tambah",$data);
		$this->putJsContent("fleetmanagement/monitoring/tambah_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }

    public function edit($id)
    {
        $data = $this->__init();
		if(!$this->admin_login){
			redir(base_url_admin('login'));
			die();
		}

		$id = intval($id);
		if($id<=0){
			redir(base_url_admin('fleetmanagement/monitoring/'));
			die();
		}

		$cmm = $this->cmm->id($id);
		if(!isset($cmm->id)){
			redir(base_url_admin('fleetmanagement/monitoring/'));
			die();
		}

		$pengguna = $data['sess']->admin;

		$this->setTitle('Fleet Management: monitoring dan Pelacakan: Edit #'.$cmm->id.' '.$this->config->semevar->admin_site_suffix);

		$data['cmm'] = $cmm;
		unset($cmm);

		$this->putThemeContent("fleetmanagement/monitoring/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/monitoring/edit",$data);
		$this->putJsContent("fleetmanagement/monitoring/edit_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }

    public function detail($id)
    {
        $data = $this->__init();
		if(!$this->admin_login){
			redir(base_url_admin('login'));
			die();
		}
		$id = (int) $id;
		if($id<=0){
			redir(base_url_admin('fleetmanagement/monitoring/'));
			die();
		}
		$cmm = $this->cmm->id($id);
		if(!isset($cmm->id)){
			redir(base_url_admin('fleetmanagement/monitoring/'));
			die();
		}
		$this->setTitle('Fleet Management: Monitoring dan Pelacakan: Detail #'.$cmm->id.' '.$this->config->semevar->admin_site_suffix);



		$data['cmm'] = $cmm;
		$data['cmm']->parent = $this->cmm->id($cmm->id);
		// unset($acm);

		$this->putThemeContent("fleetmanagement/monitoring/detail",$data);
		$this->putJsContent("fleetmanagement/monitoring/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }
}
