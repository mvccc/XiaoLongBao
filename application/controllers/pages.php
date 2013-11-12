<?php

class Pages extends CI_Controller {


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

	public function fellowship($name = 'sister')
	{
		if ( ! file_exists('application/views/activities/fellowship.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('fellowship_model', 'fellowship');

		$data['fellowships'] = $this->fellowship->get_entries();
		$data['name'] = $this->fellowship->get_entry($name);

		$this->load->view('templates/header');
		$this->load->view('activities/fellowship', $data);
		$this->load->view('templates/footer');
	}

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
