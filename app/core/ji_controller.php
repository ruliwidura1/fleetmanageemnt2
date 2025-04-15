<?php
/**
 * Core class for all controller
 *   contains general purpose methods that nice to have in all controllers
 *
 * @version 1.0.0
 *
 * @package Core\Controller
 * @since 1.0.0
 */
class JI_Controller extends \SENE_Controller
{
    protected $user_login = false;
    protected $admin_login = false;
    private $session_current = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->session_current_check();
    }

    public function session_current_check()
    {
        $session = $this->session_current;
        if (!is_null($session) && isset($session->user->id) && isset($session->admin->id)) {
            return  $session;
        }

        $session = $this->getKey();
        if (!is_object($session)) {
            $session = new stdClass();
            $session->user = new stdClass();
            $session->admin = new stdClass();
        }
        if (!isset($session->user)) {
            $session->user = new stdClass();
        }
        if (isset($session->user->id)) {
            $this->user_login = true;
        }

        
        if (isset($session->admin->id)) {
            $this->admin_login = true;
        }
        $this->session_current = $session;

        return $this;
    }

    protected function config_semevar($key, $default='')
    {
        if (isset($this->config->semevar->{$key})) {
            return $this->config->semevar->{$key};
        } else {
            return $default;
        }
    }

    public function __init()
    {
        $data = array();
        $data['sess'] = $this->session_current;

        return $data;
    }

    public function index() { }
}