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
class Pemeliharaanservice extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('a_vehicle_concern');
        $this->load('admin/a_pemeliharaanservice_model', 'apm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_pemeliharaanservice';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: Pemeliharaan Dan Service '.$this->config->semevar->admin_site_suffix);
        $this->putThemeContent('fleetmanagement/pemeliharaanservice/home_modal', $data);
        $this->putThemeContent('fleetmanagement/pemeliharaanservice/home', $data);
        $this->putJsContent('fleetmanagement/pemeliharaanservice/home_bottom', $data);
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
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/tambah_modal",$data);
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/tambah",$data);
		$this->putJsContent("fleetmanagement/pemeliharaanservice/tambah_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}

		$apm = $this->apm->id($id);
		if(!isset($apm->id)){
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}

		$pengguna = $data['sess']->admin;

		$this->setTitle('Fleet Management: Pemeliharaan Dan Service: Edit #'.$apm->id.' '.$this->config->semevar->admin_site_suffix);

		$data['apm'] = $apm;
		unset($apm);

		$this->putThemeContent("fleetmanagement/pemeliharaanservice/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/edit",$data);
		$this->putJsContent("fleetmanagement/pemeliharaanservice/edit_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}
		$apm = $this->apm->id($id);
		if(!isset($apm->id)){
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}
		$this->setTitle('Fleet Management: Pemeliharaan Dan Service: Detail #'.$apm->id.' '.$this->config->semevar->admin_site_suffix);



		$data['apm'] = $apm;
		$data['apm']->parent = $this->apm->id($apm->id);
		// unset($acm);

		$this->putThemeContent("fleetmanagement/pemeliharaanservice/detail",$data);
		$this->putJsContent("fleetmanagement/pemeliharaanservice/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    }
}
