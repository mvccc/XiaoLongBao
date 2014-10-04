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
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('user_model');
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
	 * internal use only!!
	 */
	private function hashPassword($pwd)
	{
	  $salt = $this->createSalt();
	  print_r($salt.'<br>');
	  
	  $hash = hash('sha256', $salt.hash('sha256', $pwd) );
	  print_r($hash);
	}

	public function loginForm($lang = 'ch')
	{
	  $this->loadResouces($lang);
	  $data['lang'] = $lang;

	  // logout the old user first
	  if (Access::isLoggedIn())
	  {
	    $this->session->sess_destroy();
	  }

	  // setting validation rules
	  $this->load->library('form_validation');
	  $this->load->library('validation_rules');
	  $rules = $this->validation_rules;
	  $this->form_validation->set_rules($rules::$loginRules);
	  $dispatchUrl;


	  // form validation
	  $refer_url = $this->session->userdata('refer_url');
	  if ($this->form_validation->run() == FALSE)
	  {
	    if (isset($_SERVER['HTTP_REFERER']) && empty($refer_url))
	    {
	      $this->session->set_userdata(array('refer_url' => $_SERVER['HTTP_REFERER']));
	    }
	    $dispatchUrl = 'auth/loginpage';
	  }
	  // database check
	  else
	  {
	    $username = $this->input->post('username');
	    $password = $this->input->post('password');
	    $rows = $this->user_model->get_user($username);
	    
	    // no user
	    if (count($rows) == 0)
	    {
	      $login_error = $this->lang->line('auth_no_user_error');
	    }
	    // check pwd
	    else
	    {
	      $row = $rows[0];
	      $hash = hash('sha256', $row['salt'] . hash('sha256', $password) );
	      if ($hash != $row['password'])
	      {
	        $login_error = $this->lang->line('auth_wrong_password_error');
	      }
	    }

	    if (empty($login_error))
	    {
	      // save session data
	      $newdata = array(
	          'logged_in' => TRUE,
	          'username' => $username,
	          'firstname' => $row['first_name'],
	          'role' => $row['role']
	      );
	      $this->session->set_userdata($newdata);
	      
	      // referer url cannot be loginForm itself
	      if (!empty($refer_url))
	      {
	        if (strpos($refer_url, site_url().'/auth/loginForm') === 0)
	        {
	          $dispatchUrl = site_url();
	        }
	        else
	        {
	          $dispatchUrl = $refer_url;
	        }
	      }
	      else
	      {
	        $dispatchUrl = site_url();
	      }
	      
	      // redirect to previous page after login
	      redirect($dispatchUrl, 'refresh');
	      die();
	    }
	    else
	    {
	      $_REQUEST['login_error'] = $login_error;
	      $dispatchUrl = 'auth/loginpage';
	    }
	  }
	  
	  $this->load->view('templates/header_'.$lang, $data);
	  $this->load->view($dispatchUrl, $data);
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