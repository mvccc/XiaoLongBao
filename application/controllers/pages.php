<?php

/**
  * A controller for the public accessible pages.
  */
class Pages extends CI_Controller {

	private function loadHeader($lang)
 	{
 		$data['logged_in'] = $this->session->userdata('logged_in');
 		$this->load->view('templates/header_'.$lang, $data);
	}

	function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->library('session');
    }
  
	/**
	  * Loads default home page.
	  */
	public function index($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/index.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/index');
		$this->load->view('templates/footer');
	}

	/**
	  * Loads pages in church general information menu.
	  */
	public function church($page = 'introduction', $lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/churchInfo/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/churchInfo/'.$page);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads pastor page.
	  */
	public function pastors($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/churchInfo/pastors.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('pastor_model', 'pastor');

		$data['pastors'] = $this->pastor->get_current_pastors($lang);

		$this->loadHeader($lang);
		$this->load->view($lang.'/churchInfo/pastors', $data);
		$this->load->view('templates/footer');
	}

	/**
	 * Loads pages in church worship menu
	 */
	public function worship($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/worship.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('message_model', 'message');

		$data['messages'] = $this->message->get_messages();

		$this->loadHeader($lang);
		$this->load->view($lang.'/worship', $data);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads fellowship pages.
	  */
	public function fellowship($name = 'sister', $lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/activities/fellowship.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('fellowship_model', 'fellowship');

		$data['fellowships'] = $this->fellowship->get_fellowships();
		$data['name'] = $this->fellowship->get_fellowship($name);

		$this->loadHeader($lang);
		$this->load->view($lang.'/activities/fellowship', $data);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads pages in church activities menu.
	  */
	public function activities($page = 'sundaySchoolAdults', $lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/activities/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/activities/'.$page);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads prayer page.
	  */
	public function prayer($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/prayer.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/prayer');
		$this->load->view('templates/footer');
	}

	/**
	  * Loads mission pages
	  */
	public function missions($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/missions.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->model('missionary_model','missionary');
		$data['missionaries'] = $this->missionary->get_missionaries($lang);

		$this->loadHeader($lang);
		$this->load->view($lang.'/missions', $data);
		$this->load->view('templates/footer');
	}
}
?>
