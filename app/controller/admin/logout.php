<?php
/**
* Controller Class
*   for Admin
* Main objective of this class is to clear session for admin
*
* @version 1.0.0
*
* @package Controller\Admin
* @since 1.0.0
*/
class Logout extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
    }

    public function index()
    {
        $initial_data = $this->__init();
        if (!isset($initial_data['sess']->user->admin)) {
            $this->session_current_check();
            $initial_data = $this->__init();
        }
        $initial_data['sess']->admin = new stdClass();
        $this->login_admin = false;
        $this->setKey($initial_data['sess']);

        flush();
        redir(base_url_admin("login"), 0, 1);
    }
}