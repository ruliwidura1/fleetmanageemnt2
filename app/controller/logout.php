<?php
class Logout extends SENE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = array();
        $sess = $this->getKey();
        if (!is_object($sess)) {
            $sess = new stdClass();
        }
        $sess->user = new stdClass();
        $this->setKey($sess);
        redir(base_url("login"), 0);
    }
}