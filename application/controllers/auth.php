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
	public function login($lang = 'ch')
	{
		if ( ! file_exists('application/views/auth/loginpage.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$data['logged_in'] = $this->session->userdata('logged_in');
		$data['lang'] = $lang;

		$this->load->view('templates/header_' . $lang, $data);
		$this->load->view('auth/loginpage');
		$this->load->view('templates/footer');
	}

	/**
	  * Do member login.
	  */
	public function doLogin()
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

		$data['logged_in'] = $this->session->userdata('logged_in');

		$this->load->view('templates/header_ch', $data);
		$this->load->view('auth/loginSuccess');
		$this->load->view('templates/footer');
	}

	/**
	  * Do member logout.
	  */
	public function doLogout()
	{
		$this->session->sess_destroy();
		$data['logged_in'] = FALSE;
		$this->load->view('templates/header_ch', $data);
		$this->load->view('ch/index');
		$this->load->view('templates/footer');		
	}
}
?>