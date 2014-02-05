<?php
include APPPATH.'controllers/pages.php';

/*
 * A controller for events and calendar.
 */
class Events extends Pages {
    // Date time format in the US way.
    var $dateTimeFormat     = "m-d-Y";
    var $mysqlTimeFormat    = "Y-m-d";

    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
    * Loads event page.  
    */
    public function eventList($lang = 'ch', $year='', $month='')
    {
        if ( ! file_exists('application/views/events/eventList.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->loadResouces($lang);

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
        $data['events'] = $this->event->get_events($year, $month, $lang);
        $data['lang'] = $lang;

        $this->loadHeader($lang);
        $this->load->view('events/eventList', $data);
        $this->load->view('templates/footer');      
    }

    /*
     * Creates an event.
     */
    public function createEvent($lang = 'ch')
    {
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in === FALSE)
        {
            // TODO: show authentication error.
            show_404();
        }

        date_default_timezone_set('America/Los_Angeles');
        $this->load->library('form_validation');
        $this->load->library('validation_rules');
        $rules = $this->validation_rules;
        $this->form_validation->set_rules($rules::$eventRules);
        if ($this->form_validation->run() == FALSE)
        {
            // Loads event creation page.
            if ( ! file_exists('application/views/events/createEvent.php'))
            {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $this->loadResouces($lang);
            $data["today"] = date($this->dateTimeFormat, time());
            $data["dateTimeFormat"] = $this->dateTimeFormat;
            $data["lang"] = $lang;

            $this->loadHeader($lang);
            $this->load->view('events/createEvent', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            // Create an event.
            $dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->input->post('date'));

            $data = array();

            $year       = $dateTime->format('Y');
            $month      = $dateTime->format('m');
            $day        = $dateTime->format('d');
            $data['date'] = $dateTime->format('Y-m-d');
            $data['timestamp']  = $dateTime->getTimestamp();
            $data['start_time'] = $this->input->post('time');
            $data['title']      = $this->input->post('title');
            $data['content']    = $this->input->post('content');
            $data['category']   = $this->input->post('category');
            $data['lang']       = $lang;

            $this->load->model('event_model', 'event');
            $data['events'] = $this->event->add_event($data);

            // Redirect to event page.
            $url = sprintf("/events/eventList/%s/%s/%s/", $lang, $year, $month);
            redirect($url, 'location', 302);
        }
    }

    /*
     * Updates an event.
     */
    public function updateEvent($id, $lang='ch')
    {
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in === FALSE)
        {
            // TODO: show authentication error.
            show_404();
        }

        date_default_timezone_set('America/Los_Angeles');
        $this->load->library('form_validation');
        $this->load->library('validation_rules');
        $rules = $this->validation_rules;
        $this->form_validation->set_rules($rules::$eventRules);
        if ($this->form_validation->run() == FALSE)
        {
            $this->loadResouces($lang);
            $this->load->model('event_model', 'event');
            $data['event'] = $this->event->get_event($id);

            $dateTime = DateTime::createFromFormat($this->mysqlTimeFormat, $data['event']['date']);
            $data['date']   = $dateTime->format($this->dateTimeFormat);
            $data['year']   = $dateTime->format('Y');
            $data['month']  = $dateTime->format('m');
            $data['lang']   = $lang;

            $this->loadHeader($lang);
            $this->load->view('events/updateEvent', $data);
            $this->load->view('templates/footer'); 
        }
        else
        {
            $dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->input->post('date'));
            $data = array();
            $year               = $dateTime->format('Y');
            $month              = $dateTime->format('m');
            $data['date']       = $dateTime->format('Y-m-d');
            $data['timestamp']  = $dateTime->getTimestamp();
            $data['start_time'] = $this->input->post('time');
            $data['title']      = $this->input->post('title');
            $data['content']    = $this->input->post('content');
            $data['category']   = $this->input->post('category');

            $this->load->model('event_model', 'event');
            $data['events'] = $this->event->update_event($id, $data);

            // Redirect to event page.
            $url = sprintf("/events/eventList/%s/%s/%s/", $lang, $year, $month);
            redirect($url, 'location', 302);
        }
    }

    /*
     * Deletes an event.
     */
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

    /*
     * Loads calendar page.
     */
    public function calendar($lang = 'ch', $year='', $month='')
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
               'next_prev_url'   => site_url() . '/events/calendar'
             );

        #          <a href="{content}">{day}</a></div>;
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
           {cal_cell_start}<td class="calendarDay">{/cal_cell_start}

           {cal_cell_content}
           <div class="calDay"> {day} </div>
           {content}
           {/cal_cell_content}

           {cal_cell_content_today}
             <div class="calDay highlight"> {day} </div>
             {content}
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

        $this->load->model('event_model', 'event');
        $events = $this->event->get_events($year, $month, $lang);
        $data = array();
        foreach ($events as $key => $event) {

            date_default_timezone_set('America/Los_Angeles');
            $dateTime = DateTime::createFromFormat($this->mysqlTimeFormat, $event['date']);

            $eventsPerDay = array();
            $day = $dateTime->format('d');
            if (isset($data[$day]))
            {
                $eventsPerDay = $data[intval($day)];
            }
            $eventsPerDay[] = $event['title'];
            $data[intval($day)] = $eventsPerDay;
        }

        // Load CI calendar library.
        $this->load->library('calendar', $prefs);
        $data['calendar'] = $this->calendar->generate($year, $month, $data);

        $this->loadHeader($lang);
        $this->load->view('events/calendar', $data);
        $this->load->view('templates/footer');  
    }

    /**
      * Load resources bundle files.
      */
    private function loadResouces($lang = 'ch')
    {
        if ($lang == 'ch')
        {
            $this->lang->load('event', 'chinese');
        }
        else
        {
            $this->lang->load('event', 'english');
        }
    }
}
?>