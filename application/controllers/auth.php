<?php

/**
  * A controller for the page authentication.
  */
class Auth extends CI_Controller 
{
	function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->library('session');
    }

	/**
	  * Loads member login page.
	  */
	public function login($page = 'loginpage' , $lang = 'ch')
	{
		if ( ! file_exists('application/views/auth/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadResouces($lang);
		$data['logged_in'] = $this->session->userdata('logged_in');
		$data['lang'] = $lang;

		$this->load->view('templates/header_'.$lang, $data);
		$this->load->view('auth/'.$page);
		$this->load->view('templates/footer');
	}

	/**
	  * Do member login.
	  */
	public function doLogin($lang = 'ch')
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: Form validation
			// TODO: User login
			$username = $this->input->post('username');
			$newdata = array(
            	       'username'  => $username,
                	   'logged_in' => TRUE
               	);
			$this->session->set_userdata($newdata);
		}

		if ( ! file_exists('application/views/auth/loginSuccess.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadResouces($lang);
		$data['logged_in'] = $this->session->userdata('logged_in');

		$this->load->view('templates/header_'.$lang, $data);
		$this->load->view('auth/loginSuccess');
		$this->load->view('templates/footer');
	}

	/**
	  * Do member logout.
	  */
	public function doLogout($lang = 'ch')
	{
		$this->session->sess_destroy();
		$data['logged_in'] = FALSE;
		$this->load->view('templates/header_'.$lang, $data);
		$this->load->view($lang.'/index');
		$this->load->view('templates/footer');		
	}

	/**
	  * Load resources bundle files.
	  */
	private function loadResouces($lang = 'ch')
	{
		if ($lang == 'ch')
		{
			$this->lang->load('res', 'chinese');
		}
		else
		{
			$this->lang->load('res', 'english');
		}
	}
}
?>