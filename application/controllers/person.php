<?php
class Person extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('person_model');
	}

	public function index()
	{
	  if ( ! file_exists('application/views/person/index.php'))
	  {
	    // Whoops, we don't have a page for that!
	    show_404();
	  }

		$data['persons'] = $this->person_model->get_persons();
		
		$this->load->view('person/index', $data);

	}


}