<?php
class Login extends \JI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->load('a_pengguna_concern');
		$this->load('admin/a_pengguna_model', 'apm');
	}

    private function validate_input($key, $min_length=3)
    {
        $value = $this->input->request($key, '');
		if (strlen($value) <= $min_length) {
			$value = false;
		}

        return $value;
    }

    private function validate_admin_session()
    {
        if (isset($this->admin_login) && $this->admin_login == true) {
            return true;
        }

        return false;
    }

    private function validate_username()
    {
        return $this->validate_input('username');
    }

    private function validate_password()
    {
        return $this->validate_input('password');
    }

    private function validate_password_md5($apm, $password)
    {
        if (md5($password) == $apm->password) {
            return true;
        } else {
            return false;
        }
    }

    private function session_current_update($data_initial, $apm)
    {
        $session_current = new stdClass();
        if (!isset($data_initial['sess']->admin)) {
            $this->session_current_check();
        }

        $data_initial['sess']->admin = $apm;
        $this->setKey($data_initial['sess']);

        return $data_initial;
    }

	public function index()
	{
		$data = $this->initialize();
        if ($this->validate_admin_session()) {
            redir(base_url_admin('login/authorization/'));

            return true;
        }

		$this->setTitle('Login ');

        $failed_flag = intval($this->input->request('failed', 0));
        if ($failed_flag > 0) {
            $data['login_message'] = 'Invalid username or password';
        }

		$this->putThemeContent("login/home", $data);
		$this->putJsContent('login/home_bottom', $data);
		$this->loadLayout('login', $data);
		$this->render();
	}

	public function authentication()
	{
		//init
		$data = array();
		$initial_data = $this->initialize();
		if ($this->validate_admin_session() == true)
        {
            redir(base_url_admin('login/authorization/'));

            return false;
        }

		$username = $this->validate_username();
		if (!$username)
        {
            redir(base_url_admin('login/?failed=1'));
            return false;
        }

		$password = $this->validate_password();
		if (!$password)
        {
            redir(base_url_admin('login/?failed=2'));
            return false;
        }

        $apm = $this->apm->username($username);
        if (!isset($apm->id))
        {
            redir(base_url_admin('login/?failed=3'));
            return false;
        }

        if (!$this->validate_password_md5($apm, $password))
        {
            redir(base_url_admin('login/?failed=4'));
            return false;
        }

        $this->session_current_update($initial_data, $apm);

        redir(base_url_admin('login/authorization/'));
        return true;
	}

	public function authorization()
	{
		$data = $this->initialize();
        if ($this->validate_admin_session()) {
            redir(base_url_admin());

            return true;
        } else {
            redir(base_url_admin('login'));

            return false;
        }
	}
}
