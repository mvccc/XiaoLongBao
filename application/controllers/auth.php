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
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model');
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

		$this->loadResouces($lang);

		// mw: we will need the lang for constructing the action URL in the form.
		$data['lang'] = $lang;

		$this->load->view('templates/header_'.$lang, $data);
		$this->load->view('auth/loginpage', $data);
		$this->load->view('templates/footer');
	}
	
	public function signup($lang = 'ch')
	{
	  if ( ! file_exists('application/views/auth/signuppage.php'))
	  {
	    // Whoops, we don't have a page for that!
	    show_404();
	  }
	  
	  $this->loadResouces($lang);
	  
	  // mw: we will need the lang for constructing the action URL in the form.
	  $data['lang'] = $lang;
	  
	  $this->load->view('templates/header_'.$lang, $data);
	  $this->load->view('auth/signuppage', $data);
	  $this->load->view('templates/footer');
	}

	/**
	 * Generates salt
	 */
	private function createSalt()
	{
	  $string = md5(uniqid(rand(), true));
	  print_r($string.'<br>');
	  return substr($string, 0, 3);
	}
	
	/**
	  * Do member login.
	  */
	public function doLogin($lang = 'ch')
	{
	  $this->loadResouces($lang);

		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in == FALSE)
		{
			// TODO: Form validation
			// TODO: User login
			$username = $this->input->post('username'); 
			$password = $this->input->post('password');
			$rows = $this->user_model->get_user($username);
			
			if (count($rows) == 0)
			{
			  $this->session->set_flashdata('dologin_error', $this->lang->line('auth_no_user_error'));
			  redirect('/auth/login/'.$lang);
			  die();
			}
			$row = $rows[0];
			$hash = hash('sha256', $row['salt'] . hash('sha256', $password) );
			if ($hash != $row['password'])
			{
			  $this->session->set_flashdata('dologin_error', $this->lang->line('auth_wrong_password_error'));
			  redirect('/auth/login/'.$lang);
			  die();
			}

			// correct username/password
			$newdata = array(
			      'logged_in' => TRUE,
						'username' => $username,
			      'firstname' => $row['first_name'],
						'role' => $row['role']
			);

			$this->session->set_userdata($newdata);
		}

		if ( ! file_exists('application/views/auth/loginSuccess.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->view('templates/header_'.$lang);
		$this->load->view('auth/loginSuccess');
		$this->load->view('templates/footer');
	}

	/**
	  * Do member logout.
	  */
	public function doLogout($lang = 'ch')
	{
		$this->session->sess_destroy();
		redirect('/pages/index/'.$lang);
		die();
	}

	/**
	  * Load resources bundle files.
	  */
	private function loadResouces($lang = 'ch')
	{
		if ($lang == 'ch')
		{
			$this->lang->load('auth', 'chinese');
		}
		else
		{
			$this->lang->load('auth', 'english');
		}
	}
}
?>