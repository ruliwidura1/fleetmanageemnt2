<?php
	class Home extends JI_Controller{

	public function __construct(){
    parent::__construct();
		$this->setIcon(base_url("favicon.png"));
		$this->setShortcutIcon(base_url("favicon.png"));
		$this->setTheme('admin');
		$this->lib('tgl');
		$this->load('a_pengguna_concern');
		$this->load("admin/a_pengguna_model","apm");
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';
	}
	public function index(){
		$data = $this->initialize();
		if(!$this->admin_login){
			redir(base_url_admin('login'),0);
			die();
		}

		$this->setTitle("Dashboard ".$this->config->semevar->admin_site_suffix);

		$this->putThemeContent("home/home",$data);
		$this->putJsContent("home/home_bottom",$data);
		$this->loadLayout('col-2-left',$data);
		$this->render();
  }
}
