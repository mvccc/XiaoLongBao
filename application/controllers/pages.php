<?php

/**
  * A controller for the public accessible pages.
  */
class Pages extends CI_Controller {


	/**
	  * Loads default home page.
	  */
	public function index()
	{
		if ( ! file_exists('application/views/index.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->view('templates/header');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}

	/**
	  * Loads pages in church general information menu.
	  */
	public function church($page = 'introduction')
	{
		if ( ! file_exists('application/views/churchInfo/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->view('templates/header');
		$this->load->view('churchInfo/'.$page);
		$this->load->view('templates/footer');
	}

	/**
	 * Loads pages in church worship menu
	 */
	public function sunday($page = 'worship')
	{
		if ( ! file_exists('application/views/sunday/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->view('templates/header');
		$this->load->view('sunday/'.$page);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads fellowship pages.
	  */
	public function fellowship($name = 'sister')
	{
		if ( ! file_exists('application/views/activities/fellowship.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('fellowship_model', 'fellowship');

		$data['fellowships'] = $this->fellowship->get_fellowships();
		$data['name'] = $this->fellowship->get_fellowship($name);

		$this->load->view('templates/header');
		$this->load->view('activities/fellowship', $data);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads pages in church activities menu.
	  */
	public function activities($page = 'sundaySchoolKids')
	{
		if ( ! file_exists('application/views/activities/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->view('templates/header');
		$this->load->view('activities/'.$page);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads mission pages
	  */
	public function missions()
	{
		if ( ! file_exists('application/views/missions.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->model('missionary_model','missionary');
		$data['missionaries'] = $this->missionary->get_missionaries();

		$this->load->view('templates/header');
		$this->load->view('missions', $data);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads member login page.
	  */
	public function login($page = 'loginpage')
	{
		if ( ! file_exists('application/views/loginPage/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->view('templates/header');
		$this->load->view('loginPage/'.$page);
		$this->load->view('templates/footer');
	}
}
?>
