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
	
	public function create()
	{
	  $this->load->helper('form');
	  $this->load->library('form_validation');
	
	  $this->form_validation->set_rules('pname', 'Person name', 'required');
	
	  if ($this->form_validation->run() === FALSE)
	  {
	    $this->load->view('person/create');
	  }
	  else
	  {
	    $persons = $this->person_model->get_persons($this->input->post('pname'));
	    if (count($persons) == 0)
	    {
	      $this->person_model->add_person();
	      //$this->load->view('person/success');
	      echo "".$this->input->post('pname')." added in DB";
	      $this->index();
	    }
	    else
	    {
	      echo "".$this->input->post('pname')." exists in DB!";
	      $this->load->view('person/create');
	    }
	  }
	}
	


}