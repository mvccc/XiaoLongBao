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
}
?>