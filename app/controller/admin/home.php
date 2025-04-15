<?php
/**
* Main Controller Class
*   for Admin
* Mostly for this controller will resulting HTTP Body Content in HTML format
*
* @version 1.0.0
*
* @package Controller\Admin
* @since 1.0.0
*/
class Home extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
    }
    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));

            return false;
        }
        
        $this->setTitle("Home Admin");
        
        $this->putJsContent("home/home_bottom", $data);
        $this->putThemeContent("home/home", $data);

        $this->loadLayout('col-2-left', $data);
        $this->render();
    }
}