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
class Jenismerkkendaraan extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('a_vehicle_concern');
        $this->load('admin/a_jenis_merkkendaraan_model', 'ajmm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_jenismerkkendaraan';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: jenis merk kendaraan '.$this->config->semevar->admin_site_suffix);
        $this->putThemeContent('fleetmanagement/jenismerkkendaraan/home_modal', $data);
        $this->putThemeContent('fleetmanagement/jenismerkkendaraan/home', $data);
        $this->putJsContent('fleetmanagement/jenismerkkendaraan/home_bottom', $data);
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

		$this->setTitle('Fleet Management: jenis merk kendaraan: Baru '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/jenismerkkendaraan/tambah_modal",$data);
		$this->putThemeContent("fleetmanagement/jenismerkkendaraan/tambah",$data);
		$this->putJsContent("fleetmanagement/jenismerkkendaraan/tambah_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/jenismerkkendaraan/'));
			die();
		}

		$avm = $this->avm->id($id);
		if(!isset($avm->id)){
			redir(base_url_admin('fleetmanagement/jenismerkkendaraan/'));
			die();
		}

		$pengguna = $data['sess']->admin;

		$this->setTitle('Fleet Management: jenis merk kendaraan: Edit #'.$avm->id.' '.$this->config->semevar->admin_site_suffix);

		$data['avm'] = $avm;
		unset($avm);

		$this->putThemeContent("fleetmanagement/jenismerkkendaraan/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/jenismerkkendaraan/edit",$data);
		$this->putJsContent("fleetmanagement/jenismerkkendaraan/edit_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/jenismerkkendaraan/'));
			die();
		}
		$avm = $this->avm->id($id);
		if(!isset($avm->id)){
			redir(base_url_admin('fleetmanagement/jenismerkkendaraan/'));
			die();
		}
		$this->setTitle('Fleet Management: jenis merk kendaraan: Detail #'.$avm->id.' '.$this->config->semevar->admin_site_suffix);

		$avm->nama = htmlentities($avm->nama);

		$data['avm'] = $avm;
		$data['avm']->parent = $this->avm->id($avm->id);
		// unset($acm);

		$this->putThemeContent("fleetmanagement/jenismerkkendaraan/detail",$data);
		$this->putJsContent("fleetmanagement/jenismerkkendaraan/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }
}
