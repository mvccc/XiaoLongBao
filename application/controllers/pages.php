<?php

/**
  * A controller for the public accessible pages.
  */
class Pages extends CI_Controller {

	// Date time format in the US way.
	var $dateTimeFormat = "m-d-Y";

	private function loadHeader($lang)
	{
		$this->load->view('templates/header_'.$lang);
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
	* Loads calendar page.	
	*/
	public function calendar($year='', $month='', $lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/events/calendar.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		// Set the default year and month to the current date.
		date_default_timezone_set('America/Los_Angeles');
		$currentTime = time();
		if ($year == '')
			$year  = date("Y", $currentTime);

		if ($month == '')
			$month = date("m", $currentTime);

		// Load CI calendar library.
		$this->load->library('calendar');
		$current = array();
		$current['year']  = $year;
		$current['month'] = $this->calendar->get_month_name($month);

		$data['current']  = $current;
		$data['previous'] = $this->calendar->adjust_date($month - 1, $year);
		$data['next'] = $this->calendar->adjust_date($month + 1, $year);

		$this->load->model('event_model', 'event');
		$data['events'] = $this->event->get_events($year, $month);

		$this->loadHeader($lang);
		$this->load->view($lang.'/events/calendar', $data);
		$this->load->view('templates/footer');		
	}

	public function calendarCell($year='', $month='', $lang = 'ch')
	{
		// Set the default year and month to the current date.
		date_default_timezone_set('America/Los_Angeles');
		$currentTime = time();
		if ($year == '')
			$year  = date("Y", $currentTime);

		if ($month == '')
			$month = date("m", $currentTime);

		$prefs = array (
               'start_day'    => 'sunday',
               'month_type'   => 'long',
               'day_type'     => 'short',
               'show_next_prev'  => TRUE,
               'next_prev_url'   => site_url() . '/pages/calendarCell'
             );

		# 		   <a href="{content}">{day}</a></div>;
		$prefs['template'] = '

		   {table_open}<table class="calendar">{/table_open}

		   {heading_row_start}<tr>{/heading_row_start}

		   {heading_previous_cell}<th class="text-left"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
		   {heading_title_cell}<th class="text-center heading-title-cell" colspan="{colspan}">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th class="text-right"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

		   {heading_row_end}</tr>{/heading_row_end}

		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}

		   {cal_row_start}<tr class="dateRow">{/cal_row_start}
		   {cal_cell_start}<td>{/cal_cell_start}

		   {cal_cell_content}
		   <div class="calDay"> {day} </div>
		   {content}
		   {/cal_cell_content}

		   {cal_cell_content_today}
		   <div class="highlight">
		     <div class="calDay"> {day} </div>
		     <div class="calContent"> {content} </div>
		   </div>
		   {/cal_cell_content_today}

		   {cal_cell_no_content}
			<div class="calDay"> {day} </div>
		   {/cal_cell_no_content}

		   {cal_event}
		     <div class="calContent"> {content} </div>
		   {/cal_event}

		   {cal_cell_no_content_today}<div class="calDay highlight">{day}</div>{/cal_cell_no_content_today}

		   {cal_cell_blank}&nbsp;{/cal_cell_blank}

		   {cal_cell_end}</td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}

		   {table_close}</table>{/table_close}
		';

		$data = array(
					   1  => 'foo',
		               # 3  => 'http://example.com/news/article/2006/03/',
		               7  => array('aaa', 'bbb'),
		               13 => '联合团契暂停',
		               26 => 'ddd'
		             );

		// Load CI calendar library.
		$this->load->library('calendar', $prefs);
		$data['calendar'] = $this->calendar->generate($year, $month, $data);

		$this->loadHeader($lang);
		$this->load->view($lang.'/events/calendar2', $data);
		$this->load->view('templates/footer');	
	}


	/**
	  * Loads page for adding Sunday message.
	  */
	public function createEvent($lang = 'ch')
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: show authentication error.
			show_404();
		}

		if ( ! file_exists('application/views/'.$lang.'/events/createEvent.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->library('form_validation');

		date_default_timezone_set('America/Los_Angeles');
		$data["today"] = date($this->dateTimeFormat, time());
		$data["dateTimeFormat"] = $this->dateTimeFormat;

		$this->loadHeader($lang);
		$this->load->view($lang.'/events/createEvent', $data);
		$this->load->view('templates/footer');
	}

	public function doCreateEvent($lang = 'ch')
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: show authentication error.
			show_404();
		}

		$this->load->library('form_validation');
		$this->load->library('validation_rules');
		$rules = $this->validation_rules;
		$this->form_validation->set_rules($rules::$eventRules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->createEvent();
		}
		else
		{
			date_default_timezone_set('America/Los_Angeles');
			$dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->input->post('date'));

			$data = array();

			$data['year'] 		= $dateTime->format('Y');
			$data['month']		= $dateTime->format('m');
			$data['day']		= $dateTime->format('d');
			$data['timestamp']	= $dateTime->getTimestamp();
			$data['time'] 		= $this->input->post('time');
			$data['title'] 		= $this->input->post('title');
			$data['content'] 	= $this->input->post('content');
			$data['category'] 	= $this->input->post('category');

			$this->load->model('event_model', 'event');
			$data['events'] = $this->event->add_event($data);

			// Redirect to calendar page.
			$this->calendar($data['year'], $data['month']);
		}
	}

	public function updateEvent($id, $lang='ch')
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: show authentication error.
			show_404();
		}
		$this->load->library('form_validation');
		$this->load->model('event_model', 'event');
		$data['event'] = $this->event->get_event($id);

		date_default_timezone_set('America/Los_Angeles');
		$data['date'] = date($this->dateTimeFormat, $data['event']['timestamp']);

		$this->loadHeader($lang);
		$this->load->view($lang.'/events/updateEvent', $data);
		$this->load->view('templates/footer');	
	}

	public function doUpdateEvent($id, $lang='ch')
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: show authentication error.
			show_404();
		}

		$this->load->library('form_validation');
		$this->load->library('validation_rules');
		$rules = $this->validation_rules;
		$this->form_validation->set_rules($rules::$eventRules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->updateEvent($id);
		}
		else
		{
			date_default_timezone_set('America/Los_Angeles');
			$dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->input->post('date'));

			$data = array();

			$data['year'] 		= $dateTime->format('Y');
			$data['month']		= $dateTime->format('m');
			$data['day']		= $dateTime->format('d');
			$data['timestamp']	= $dateTime->getTimestamp();
			$data['time'] 		= $this->input->post('time');
			$data['title'] 		= $this->input->post('title');
			$data['content'] 	= $this->input->post('content');
			$data['category'] 	= $this->input->post('category');

			$this->load->model('event_model', 'event');
			$data['events'] = $this->event->update_event($id, $data);

			// Redirect to calendar page.
			$this->calendar();
		}
	}

	public function doDeleteEvent($id)
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: show authentication error.
			show_404();
		}

		$this->load->model('event_model', 'event');
		$data['events'] = $this->event->delete_event($id);
	}

	/**
	 * Loads contact page.
	 */
	public function contact($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/churchInfo/contact.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/churchInfo/contact');
		$this->load->view('templates/footer');
	}
			
	/**
	 * Loads pages in church worship menu.
	 */
	public function worship($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/worship/worship.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('message_model', 'message');

		$data['messages'] = $this->message->get_messages();

		$this->loadHeader($lang);
		$this->load->view($lang.'/worship/worship', $data);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads page for adding Sunday message.
	  */
	public function add_sunday_message($lang = 'ch')
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in === FALSE)
		{
			// TODO: show authentication error.
			show_404();
		}

		if ( ! file_exists('application/views/'.$lang.'/worship/addSundayMessage.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/worship/addSundayMessage');
		$this->load->view('templates/footer');
	}

	/**
	  * Loads fellowships page.
	  */
	public function fellowships($lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/activities/fellowships.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->model('fellowship_model', 'fellowship');

		$data['fellowships'] = $this->fellowship->get_fellowships($lang);

		$this->loadHeader($lang);
		$this->load->view($lang.'/activities/fellowships', $data);
		$this->load->view('templates/footer');
	}

	/**
	  * Loads fellowship pages.
	  */
	public function fellowship($fellowshipKey = '0', $lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/activities/fellowship.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->load->model('fellowship_model', 'fellowship');
		$data['fellowship'] = $this->fellowship->get_fellowship($fellowshipKey, $lang);

		if($data['fellowship'] == False)
		{
			// mw: Couldn't find the fellowship.
			show_404();
		}

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
		if ( ! file_exists('application/views/'.$lang.'/request/prayer.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/request/prayer');
		$this->load->view('templates/footer');
	}

	/**
	  *	Loads prayer history page.
	  */
	public function prayerhistory($lang = 'ch')
	{
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

	/**
	  * Loads resources pages
	  */
	public function resources($page='links', $lang = 'ch')
	{
		if ( ! file_exists('application/views/'.$lang.'/resources/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		$this->loadHeader($lang);
		$this->load->view($lang.'/resources/'.$page);
		$this->load->view('templates/footer');
	}

}
?>
