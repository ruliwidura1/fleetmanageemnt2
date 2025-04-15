<?php
class Dashboard extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
  }
  public function index()
  {
    $data = array();
    $data['sess'] = $this->getKey();
    if(!isset($data['sess']->user->id)){
      redir(base_url('login'));
      return;
    }
    $this->setTitle('Dashboard '.$data['sess']->user->nama);
    $this->setDescription("Congratulation, you have done well.");
    $this->setKeyword('Seme Framework');
    $this->setAuthor('Seme Framework');

    $this->putThemeContent("dashboard/home",$data); //pass data to view

    $this->loadLayout("col-1",$data);
    $this->render();
  }
}