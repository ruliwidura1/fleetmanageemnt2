<?php
class Register extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
    $this->load('b_user_model','bum');
  }
  public function index()
  {
    $data = array();
    $data['sess'] = $this->getKey();
    if(isset($data['sess']->user->id)){
      redir(base_url('dashboard'));
      return;
    }
    $data = array();
    $data['sess'] = $this->__flash();
    $this->setTitle('Register');
    $this->setDescription("Please register before you can login.");
    $this->setKeyword('Seme Framework');
    $this->setAuthor('Seme Framework');

    $this->putThemeContent("register/home",$data); //pass data to view
    $this->loadLayout("col-1",$data);
    $this->__flashClear();
    $this->render();
  }
  public function proses(){
    $nama = $this->input->post('nama');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $password_konfirmasi = $this->input->post('password_konfirmasi');

    if(strlen($nama)<=1){
      $this->__flash('Invalid name');
      $this->index();
      return;
    }

    if(strlen($email)<=4){
      $this->__flash('Invalid email');
      $this->index();
      return;
    }
    $bum = $this->bum->getByEmail($email);
    if(isset($bum->id)){
      $this->__flash('email has been used');
      $this->index();
      return;
    }

    if(strlen($password)<=4){
      $this->__flash('Invalid password');
      $this->index();
      return;
    }

    if($password != $password_konfirmasi){
      $this->__flash('Password confirmation doesn\'t match');
      $this->index();
      return;
    }

    $di = array();
    $di['nama'] = $nama;
    $di['email'] = $email;
    $di['password'] = password_hash($password, PASSWORD_BCRYPT);
    $di['alamat'] = '';
    $di['cdate'] = 'NOW()';
    $di['is_active'] = 1;

    $res = $this->bum->set($di);
    if($res){
      $sess = $this->getKey();
      if(!is_object($sess)) $sess = new stdClass();
      if(!isset($sess->user)) $sess->user = new stdClass();
      $sess->user->id = 1;
      $sess->user->nama = $nama;
      $sess->user->email = $email;
      $this->setKey($sess);

      $this->__flash('Welcome '.$nama.'....');
      redir(base_url('dashboard'),1);
      return;
    }else{
      $this->__flash('Password confirmation doesn\'t match');
      $this->index();
      return;
    }
  }
}