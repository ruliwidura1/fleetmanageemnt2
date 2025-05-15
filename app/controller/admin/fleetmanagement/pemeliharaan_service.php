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
* @package FleetManagement\Pemliharaan Service\Admin
* @since 1.0.0
*/
class Pemeliharaan_service extends \JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('admin');
    $this->lib('seme_purifier');
    $this->load('admin/a_pemeliharaan_service_model', 'apsm');
    $this->load('admin/b_driver_model', 'bdm');
    $this->load('a_vehicle_concern');
    $this->load('admin/a_vehicle_model', 'avm');
    $this->current_parent = 'fleetanagement';
    $this->current_page = 'fleetanagement_pemeliharaan_service';
  }

  public function index()
  {
    $data = $this->__init();
    if (!$this->admin_login) {
      redir(base_url_admin('login'));
      die();
    }

    $this->setTitle('Fleet Management: Pemeliharaan Service '.$this->config->semevar->admin_site_suffix);
    $this->putThemeContent('fleetmanagement/pemeliharaan_service/home_modal', $data);
    $this->putThemeContent('fleetmanagement/pemeliharaan_service/home', $data);
    $this->putJsContent('fleetmanagement/pemeliharaan_service/home_bottom', $data);
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

    $this->setTitle('Fleet Management: Pemliharaan Service: Baru '.$this->config->semevar->admin_site_suffix);
    $this->putThemeContent("fleetmanagement/pemeliharaan_service/baru_modal",$data);
    $this->putThemeContent("fleetmanagement/pemeliharaan_service/baru",$data);
    $this->putJsContent("fleetmanagement/pemeliharaan_service/baru_bottom",$data);
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

    $apsm = $this->apsm->id($id);
    if(!isset($apsm->id)){
      redir(base_url_admin('fleetmanagement/pemeliharaanservice/'));
      die();
    }

    $pengguna = $data['sess']->admin;

    $data['driver_list'] = $this->bdm->get();
    $data['utype_list'] = $this->avm->get();
    $data['nopol_list'] = $this->avm->get();

    $this->setTitle('Fleet Management: Pemliharaan Service: Edit #'.$apsm->id.' '.$this->config->semevar->admin_site_suffix);

    $data['apsm'] = $apsm;
    unset($apsm);

    $this->putThemeContent("fleetmanagement/pemeliharaan_service/edit_modal",$data);
    $this->putThemeContent("fleetmanagement/pemeliharaan_service/edit",$data);
    $this->putJsContent("fleetmanagement/pemeliharaan_service/edit_bottom",$data);
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
      redir(base_url_admin('fleetmanagement/Pemliharaan Service/'));
      die();
    }
    $apsm = $this->apsm->id($id);
    $bdm = $this->bdm->id($apsm->b_driver_id);
    $avm = $this->avm->id($apsm->a_vehicle_id);

    if (!isset($apsm->id) || !isset($bdm->id) || !isset($avm->id)) {
      redir(base_url_admin('fleetmanagement/Pemeliharaan Service/'));
      die();
    }

    $data['apsm'] = $apsm;
    $data['bdm'] = $bdm;
    $data['avm'] = $avm;

    $this->setTitle('Detail '.$this->config->semevar->admin_site_suffix);
    $this->putThemeContent("fleetmanagement/pemeliharaan_service/detail",$data);
    $this->putJsContent("fleetmanagement/pemeliharaan_service/detail_bottom",$data);
    $this->loadLayout('col-2-left',$data);
    $this->render();
  }
}
