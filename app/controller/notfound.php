<?php
/**
 * Controller class for throw 404 response code
 *
 * @package SemeFramework
 * @since SemeFramework 1.0
 *
 * @codeCoverageIgnore
 */
class NotFound extends SENE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = array();
        header("HTTP/1.0 404 Not Found");
        $this->setTheme('front');
        $this->setTitle('Notfound - Error 404');
        $this->loadLayout("notfound",$data);
        $this->render();
    }
}