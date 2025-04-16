<?php
/**
 * Controller untuk Driver
 *
 * @version 1.0.0
 *
 * @package FleetManagement/Admin
 * @since 1.0.0
 */
class Driver extends \JI_Controller{
	public function __construct(){
    parent::__construct();
		$this->setTheme('admin');
		$this->current_parent = 'fleetmanagement';
		$this->current_page = 'fleetmanagement_driver';
	}
	public function index(){
    $data = $this->__init();
    if(!$this->admin_login){
      redir(base_url_admin('login'));
      die();
    }
		$this->setTitle("fleetmanagement: Driver ".$this->config->semevar->admin_site_suffix);

		$this->putThemeContent("fleetmanagement/driver/home_modal",$data);
		$this->putThemeContent("fleetmanagement/driver/home",$data);

		$this->putJsContent("fleetmanagement/driver/home_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
  }
}
