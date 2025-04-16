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
* @package FleetManagement\Muatan\Admin
* @since 1.0.0
*/
class Muatan extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('admin/c_muatan_model', 'cmm');
        $this->load('admin/b_driver_model', 'bdm');
		$this->load('a_vehicle_concern');
        $this->load('admin/a_vehicle_model', 'avm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_muatan';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: Muatan '.$this->config->semevar->admin_site_suffix);
        $this->putThemeContent('fleetmanagement/muatan/home_modal', $data);
        $this->putThemeContent('fleetmanagement/muatan/home', $data);
        $this->putJsContent('fleetmanagement/muatan/home_bottom', $data);
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

        $data['driver_list'] = $this->bdm->get();
        $data['utype_list'] = $this->avm->get();
        $data['nopol_list'] = $this->avm->get();

		$this->setTitle('Fleet Management: Muatan: Baru '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/muatan/baru_modal",$data);
		$this->putThemeContent("fleetmanagement/muatan/baru",$data);
		$this->putJsContent("fleetmanagement/muatan/baru_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/muatan/'));
			die();
		}

		$cmm = $this->cmm->id($id);
		if(!isset($cmm->id)){
			redir(base_url_admin('fleetmanagement/muatan/'));
			die();
		}

		$pengguna = $data['sess']->admin;

        $data['driver_list'] = $this->bdm->get();
        $data['utype_list'] = $this->avm->get();
        $data['nopol_list'] = $this->avm->get();

		$this->setTitle('Fleet Management: Muatan: Edit #'.$cmm->id.' '.$this->config->semevar->admin_site_suffix);

		$data['cmm'] = $cmm;
		unset($cmm);

		$this->putThemeContent("fleetmanagement/muatan/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/muatan/edit",$data);
		$this->putJsContent("fleetmanagement/muatan/edit_bottom",$data);
		$this->loadLayout('col-2-left',$data);
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
			redir(base_url_admin('fleetmanagement/muatan/'));
			die();
		}
		$cmm = $this->cmm->id($id);
		$bdm = $this->bdm->id($cmm->b_driver_id);
		$avm = $this->avm->id($cmm->a_vehicle_id);

		if (!isset($cmm->id) || !isset($bdm->id) || !isset($avm->id)) {
			redir(base_url_admin('fleetmanagement/muatan/'));
			die();
		}

		$data['cmm'] = $cmm;
		$data['bdm'] = $bdm;
		$data['avm'] = $avm;

		$this->setTitle('Detail '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/muatan/detail",$data);
		$this->putJsContent("fleetmanagement/muatan/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }
}
