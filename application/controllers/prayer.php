<?php
include APPPATH.'controllers/pages.php';

/*
 * A controller for events and calendar.
 */
class Prayer extends Pages {

    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('prayer_model', 'prayerData');
    }

    /**
      * Loads prayer page.
      */
    public function prayerList($lang = 'ch')
    {
        // TODO: make a helper function for login check
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in === FALSE)
        {
            // TODO: show authentication error.
            show_404();
        }
        if ( ! file_exists('application/views/'.$lang.'/request/prayerlist.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['scripture'] = $this->prayerData->get_latestScripture();
        $data['items'] = $this->prayerData->get_latestPrayerItems();        
        $this->loadHeader($lang);
        $this->load->view($lang.'/request/prayerlist', $data);
        $this->load->view('templates/footer');
    }
    
    /**
     * Loads prayer page.
     */
    public function addprayer($lang = 'ch')
    {
        $logged_in = $this->session->userdata('logged_in');
        // TODO: add check for updater 
        if (!isset($logged_in) || $logged_in === FALSE)
        {
            // TODO: show authentication error.
            show_404();
        }
        date_default_timezone_set('America/Los_Angeles');
        $this->load->library('form_validation');
        $data['lang'] = $lang;
       	$data['items'] = $this->prayerData->get_latestPrayerItems();
        $this->loadHeader($lang);
        $this->load->view($lang.'/request/addprayer', $data);
        $this->load->view('templates/footer');
        $this->form_validation->set_rules('prayItems[]', 'prayItemsArray', 'trim|required');
        $this->form_validation->set_rules('scripture', 'scripture', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {
            // Loads addPrayer page.
            if ( ! file_exists('application/views/'.$lang.'/request/addprayer.php'))
        	{
            	// Whoops, we don't have a page for that!
            	show_404();          	
        	}
        	
        }
        else
        {
            // Create prayer for this week
            $data = array();
            $data['date'] = date('Y-m-d', strtotime('next wednesday'));
            $data['scripture'] = $this->input->post('scripture');
            $data['lang'] = $lang;
            $data['items'] = $this->input->post('prayItems');
            $data['itemSections'] = $this->input->post('prayItemSections');
            $this->prayerData->add_prayer($data);

            // Redirect to event page.
            $url = site_url()."/prayer/prayerList";
            redirect($url, 'location', 302);          
        }
    }
    
    /**
      * Loads prayer history page.
      */
    public function prayerhistory($lang = 'ch')
    {
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in === FALSE)
        {
            // TODO: show authentication error.
            show_404();
        }
        if ( ! file_exists('application/views/'.$lang.'/request/requesthistory.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->model('request_model', 'request');
        $data['requests'] = $this->request->get_requests($lang);

        $this->loadHeader($lang);
        $this->load->view($lang.'/request/requesthistory', $data);
        $this->load->view('templates/footer');
    }
}
?>