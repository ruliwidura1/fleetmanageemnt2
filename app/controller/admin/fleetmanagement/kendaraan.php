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
* @package FleetManagement\Kendaraan\Admin
* @since 1.0.0
*/
class Kendaraan extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('a_vehicle_concern');
        $this->load('admin/a_vehicle_model', 'avm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_kendaraan';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: Kendaraan ');
        $this->putThemeContent('fleetmanagement/kendaraan/home_modal', $data);
        $this->putThemeContent('fleetmanagement/kendaraan/home', $data);
        $this->putJsContent('fleetmanagement/kendaraan/home_bottom', $data);
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

		$this->setTitle('Fleet Management: Kendaraan: Baru '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/kendaraan/tambah_modal",$data);
		$this->putThemeContent("fleetmanagement/kendaraan/tambah",$data);
		$this->putJsContent("fleetmanagement/kendaraan/tambah_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/kendaraan/'));
			die();
		}

		$avm = $this->avm->id($id);
		if(!isset($avm->id)){
			redir(base_url_admin('fleetmanagement/kendaraan/'));
			die();
		}

		$pengguna = $data['sess']->admin;

		$this->setTitle('Fleet Management: Kendaraan: Edit #'.$avm->id.' '.$this->config->semevar->admin_site_suffix);

		$data['avm'] = $avm;
		unset($avm);

		$this->putThemeContent("fleetmanagement/kendaraan/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/kendaraan/edit",$data);
		$this->putJsContent("fleetmanagement/kendaraan/edit_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/kendaraan/'));
			die();
		}
		$avm = $this->avm->id($id);
		if(!isset($avm->id)){
			redir(base_url_admin('fleetmanagement/kendaraan/'));
			die();
		}
		$this->setTitle('Fleet Management: Kendaraan: Detail #'.$avm->id.' '.$this->config->semevar->admin_site_suffix);

		$avm->nama = htmlentities($avm->nama);

		$data['avm'] = $avm;
		$data['avm']->parent = $this->avm->id($avm->id);
		// unset($acm);

		$this->putThemeContent("fleetmanagement/kendaraan/detail",$data);
		$this->putJsContent("fleetmanagement/kendaraan/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }
}
