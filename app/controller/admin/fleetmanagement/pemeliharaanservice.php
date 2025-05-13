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
* @package FleetManagement\TujuanPengiriman\Admin
* @since 1.0.0
*/
class Pemeliharaanservice extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
		$this->lib('seme_purifier');
        $this->load('admin/d_pengiriman_model', 'dpm');
        $this->load('admin/c_muatan_model', 'cmm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_tujuanpengiriman';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Fleet Management: Muatan '.$this->config->semevar->admin_site_suffix);
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

        $data['barang_list'] = $this->cmm->get();

		$this->setTitle('Fleet Management: Muatan: Baru '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/baru_modal",$data);
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/baru",$data);
		$this->putJsContent("fleetmanagement/pemeliharaanservice/baru_bottom",$data);
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

		$dpm = $this->dpm->id($id);
		if(!isset($dpm->id)){
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}

		$pengguna = $data['sess']->admin;

        $data['barang_list'] = $this->cmm->get();

		$this->setTitle('Fleet Management: Muatan: Edit #'.$dpm->id.' '.$this->config->semevar->admin_site_suffix);

		$data['dpm'] = $dpm;
		unset($dpm);

		$this->putThemeContent("fleetmanagement/pemeliharaanservice/edit_modal",$data);
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/edit",$data);
		$this->putJsContent("fleetmanagement/pemeliharaanservice/edit_bottom",$data);
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
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}
		$dpm = $this->dpm->id($id);
		$cmm = $this->cmm->id($dpm->c_muatan_id);
	
		if (!isset($dpm->id) || !isset($cmm->id)) {
			redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
			die();
		}

		$data['dpm'] = $dpm;
		$data['cmm'] = $cmm;

		$this->setTitle('Detail '.$this->config->semevar->admin_site_suffix);
		$this->putThemeContent("fleetmanagement/pemeliharaanservice/detail",$data);
		$this->putJsContent("fleetmanagement/pemeliharaanservice/detail_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
    } 
}