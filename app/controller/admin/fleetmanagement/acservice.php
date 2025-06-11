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
class Acservice extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('a_vehicle_concern');
        $this->load('admin/c_acservice_model', 'cam');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_acservice';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: Pemeliharaan Dan Service '.$this->config->semevar->admin_site_suffix);
        $this->putThemeContent('fleetmanagement/acservice/home_modal', $data);
        $this->putThemeContent('fleetmanagement/acservice/home', $data);
        $this->putJsContent('fleetmanagement/acservice/home_bottom', $data);
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

		$this->setTitle('Fleet Management: Pemeliharaan Dan Service: Baru '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/acservice/tambah_modal",$data);
		$this->putThemeContent("fleetmanagement/acservice/tambah",$data);
		$this->putJsContent("fleetmanagement/acservice/tambah_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/acservice/'));
			die();
		}

		$cam = $this->cam->id($id);
		if(!isset($cam->id)){
			redir(base_url_admin('fleetmanagement/acservice/'));
			die();
		}

		$pengguna = $data['sess']->admin;

		$this->setTitle('Fleet Management: Pemeliharaan Dan Service: Edit #'.$cam->id.' '.$this->config->semevar->admin_site_suffix);

		$data['cam'] = $cam;
		unset($cam);

		$this->putThemeContent("fleetmanagement/acservice/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/acservice/edit",$data);
		$this->putJsContent("fleetmanagement/acservice/edit_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/acservice/'));
			die();
		}
		$cam = $this->cam->id($id);
		if(!isset($cam->id)){
			redir(base_url_admin('fleetmanagement/acservice/'));
			die();
		}
		$this->setTitle('Fleet Management: Pemeliharaan Dan Service: Detail #'.$cam->id.' '.$this->config->semevar->admin_site_suffix);



		$data['cam'] = $cam;
		$data['cam']->parent = $this->cam->id($cam->id);
		// unset($acm);

		$this->putThemeContent("fleetmanagement/acservice/detail",$data);
		$this->putJsContent("fleetmanagement/acservice/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }
}
