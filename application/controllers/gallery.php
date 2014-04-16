<?php
include APPPATH.'controllers/pages.php';

/*
 * A controller for events and calendar.
 */
class Gallery extends Pages {

    // Date time format in the US way.
    var $dateTimeFormat     = "m-d-Y";
    var $mysqlTimeFormat    = "Y-m-d";

    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();
    }

    /**
    * Loads gallery page.  
    */
    public function home($lang = 'ch')
    {
        if ( ! file_exists('application/views/gallery/home.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        // $this->loadResouces($lang);

        $this->load->library('javascript_plugins');
        $plugins = $this->javascript_plugins;
        $footer_data['js_plugins'] = $plugins->generate(array($plugins::Holder));

        $this->load->model('album_model', 'album');
        $data['albums'] = $this->album->get_albums($lang);

        $this->loadHeader($lang);
        $this->load->view('/gallery/home', $data);
        $this->load->view('templates/footer', $footer_data);     
    }

    /**
     * Loads album page
     */
    public function album($albumId = 1, $lang='ch')
    {
        if ( ! file_exists('application/views/gallery/album.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->library('javascript_plugins');
        $plugins = $this->javascript_plugins;
        $footer_data['js_plugins'] = $plugins->generate(array($plugins::FancyBox, $plugins::Masonry));

        $this->load->model('album_model', 'album');
        $data['album'] = $this->album->get_album($albumId);

        $this->loadHeader($lang);
        $this->load->view('/gallery/album', $data);
        $this->load->view('templates/footer', $footer_data);        
    }

    /*
     * Update an album.
     */
    public function updateAlbum($albumId = 1, $lang = 'ch')
    {
        /*
         $logged_in = $this->session->userdata('logged_in');
         if (!isset($logged_in) || $logged_in === FALSE)
         {
            // TODO: show authentication error.
            show_404();
        }
        */

        if ( ! file_exists('application/views/gallery/updateAlbum.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->model('album_model', 'album');
        $data['album'] = $this->album->get_album($albumId);

        $this->load->library('javascript_plugins');
        $plugins = $this->javascript_plugins;
        $footer_data['js_plugins'] = $plugins->generate(array($plugins::FileUpload));

        $this->loadHeader($lang);
        $this->load->view('gallery/updateAlbum', $data);
        $this->load->view('templates/footer', $footer_data);
    }

    /*
     * Upload image.
     */
    public function do_upload($albumName, $lang = 'ch') {
        $upload_path_url = base_url() . '/gallery/' . $albumName . '/';

        $config['upload_path'] = FCPATH . 'gallery/' . $albumName . '/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '30000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);

            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f=0;
            foreach ($existingFiles as $fileName => $info) {
              if($fileName!='thumbs'){//Skip over thumbs directory
                //set the data for the json array   
                $foundFiles[$f]['name'] = $fileName;
                $foundFiles[$f]['size'] = $info['size'];
                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                $foundFiles[$f]['deleteUrl'] = site_url() . '/gallery/deleteImage/' . $fileName . '/' . $albumName;
                $foundFiles[$f]['deleteType'] = 'POST';
                $foundFiles[$f]['error'] = null;

                $f++;
              }
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('files' => $foundFiles)));
        } else {
            $data = $this->upload->data();
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )
             */
            // to re-size for thumbnail images un-comment and set path here and in json array
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();


            //set the data for the json array
            $info = new StdClass;
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->deleteUrl = site_url() . '/gallery/deleteImage/' . $data['file_name'] . '/' . $albumName;
            $info->deleteType = 'POST';
            $info->error = null;

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX) {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } else {
                $file_data['upload_data'] = $this->upload->data();
                $this->load->view('upload/upload_success', $file_data);
            }
        }
    }

    public function deleteImage($file, $albumName) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . '/gallery/' . $albumName . '/' . $file);
        $success = unlink(FCPATH . '/gallery/' . $albumName . '/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'gallery/' . $albumName . '/' . $file;
        $info->file = is_file(FCPATH . 'gallery/' . $albumName . '/' . $file);

        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
            $file_data['delete_data'] = $file;
            $this->load->view('admin/delete_success', $file_data);
        }
    }


    /*
     * Creates an album. TODO
     */
    public function createAlbum($lang = 'ch')
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
        $this->form_validation->set_rules($rules::$albumRules);
        if ($this->form_validation->run() == FALSE)
        {
            // Loads event creation page.
            if ( ! file_exists('application/views/gallery/createAlbum.php'))
            {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $this->loadResouces($lang);
            $data["today"] = date($this->dateTimeFormat, time());
            $data["dateTimeFormat"] = $this->dateTimeFormat;
            $data["lang"] = $lang;

            $this->load->library('javascript_plugins');
            $plugins = $this->javascript_plugins;
            $footer_data['js_plugins'] = $plugins->generate(array($plugins::DatePicker, $plugins::Tinymce));

            $this->loadHeader($lang);
            $this->load->view('gallery/createAlbum', $data);
            $this->load->view('templates/footer', $footer_data);
        }
        else
        {
            // Create an album.
            $dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->input->post('date'));

            $data = array();

            $year       = $dateTime->format('Y');
            $month      = $dateTime->format('m');
            $day        = $dateTime->format('d');
            $data['date']           = $dateTime->format('Y-m-d');
            $data['title']          = $this->input->post('title');
            $data['description']    = $this->input->post('content');
            # $data['lang']           = $lang;
            $data['name'] = time();

            # Create album folder
            mkdir(FCPATH . '/gallery/' . $data['name']);
            # Create thumbs folder
            mkdir(FCPATH . '/gallery/' . $data['name'] . '/thumbs');

            $this->load->model('album_model', 'album');
            $this->album->add_album($data);

            // Redirect to event page.
            $url = sprintf("/gallery/home/%s", $lang);
            redirect($url, 'location', 302);
        }
    }

    /*
     * Update album. TODO
     */
    public function updateAlbumInfo($id, $lang='ch')
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
            # $this->load->model('event_model', 'event');
            # $data['event'] = $this->event->get_event($id);

            $dateTime = DateTime::createFromFormat($this->mysqlTimeFormat, $data['event']['date']);
            $data['date']   = $dateTime->format($this->dateTimeFormat);
            $data['year']   = $dateTime->format('Y');
            $data['month']  = $dateTime->format('m');
            $data['lang']   = $lang;

            $this->load->library('javascript_plugins');
            $plugins = $this->javascript_plugins;
            $footer_data['js_plugins'] = $plugins->generate(array($plugins::DatePicker, $plugins::Tinymce));

            $this->loadHeader($lang);
            $this->load->view('gallery/deleteAlbum', $data);
            $this->load->view('templates/footer', $footer_data); 
        }
        else
        {
            $dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->input->post('date'));
            $data = array();
            $year               = $dateTime->format('Y');
            $month              = $dateTime->format('m');
            $data['date']       = $dateTime->format('Y-m-d');
            $data['start_time'] = $this->input->post('time');
            $data['title']      = $this->input->post('title');
            $data['content']    = $this->input->post('content');
            $data['category']   = $this->input->post('category');

            # $this->load->model('event_model', 'event');
            # $data['events'] = $this->event->update_event($id, $data);

            // Redirect to event page.
            $url = sprintf("/gallery/home/%s/", $lang);
            redirect($url, 'location', 302);
        }
    }

    /*
     * Deletes an album.
     */
    public function deleteAlbum($id)
    {
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in === FALSE)
        {
            // TODO: show authentication error.
            show_404();
        }

        $this->load->model('album_model', 'album');
        $data['events'] = $this->album->delete_album($id);
    }

    /**
      * Load resources bundle files.
      */
    private function loadResouces($lang = 'ch')
    {
        if ($lang == 'ch')
        {
            $this->lang->load('gallery', 'chinese');
            $this->lang->load('button', 'chinese');
        }
        else
        {
            $this->lang->load('gallery', 'english');
            $this->lang->load('button', 'english');
        }
    }
}
?>