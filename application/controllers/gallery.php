<?php
/**
 * File: gallery.php
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Controllers
 * @author   Triassic <Triassic@mvccc.org>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://mvccc.org
 */

require APPPATH.'controllers/pages.php';

/**
 * A controller for gallery and album.
 *
 * @category Controller
 * @package  Controllers
 * @author   Triassic <Triassic@mvccc.org>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://mvccc.org
 */
class Gallery extends Pages {

    /** 
     * Date time format in the US way.
     *
     * @var string 
     */
    var $date_time_format = 'm-d-Y';

    /**
     * Time format in the MySQL way.
     *
     * @var string
     */
    var $mysql_time_format = 'Y-m-d';

    /** 
     * Constructor
     *
     * @return void
     */
    function construct()
    {
        // Call the Controller constructor
        parent::__construct();
    }

    /**
     * Loads gallery home page.
     *
     * @param string $lang Language flag.
     *
     * @return void  
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
        $albums = $this->album->get_albums($lang);

        // Constructing more information for each album that is required in the
        // view and put them into the album array.
        foreach($albums as $album_key => &$album)
        {
            $data_src = '';
            $cover_img = '';

            if ( ! is_null($album['cover_img_name']))
            {
                $img_path = 'gallery/' . $album['name'] . '/' . $album['cover_img_name'];
                $cover_img = base_url() . $img_path;
                
                // Display a dump image while the image file doesn't exist.
                if ( ! file_exists($img_path))
                {
                    $data_src = 'holder.js/250x250/auto/gray:#ffffff/text:Missing Photo';
                }
            }
            else 
            {
                // Display a dump image while the cover image doesn't set.
                $data_src = 'holder.js/250x250/auto/gray:#ffffff/text:Missing Photo';
            }
                
            $album_url = site_url() . '/gallery/album/' . $album['id'];

            // These are the information required in view.
            $album['coverImg'] = $cover_img;
            $album['dataSrc'] = $data_src;
            $album['albumUrl'] = $album_url;
        }

        $data['albums'] = $albums;

        $this->loadHeader($lang);
        $this->load->view('/gallery/home', $data);
        $this->load->view('templates/footer', $footer_data);     
    }

    /**
     * Loads view of an album.
     *
     * @param string $album_id Album ID
     * @param string $lang     Language flag
     *
     * @return void
     */
    public function album($album_id = 1, $lang='ch')
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
        $album = $this->album->get_album($album_id);
        $img_pathes = array();

        // Absolute path to the Album.
        $album_dir = FCPATH . 'gallery/' . $album['name'];

        // Building image URL pathes for each image in the album. Scan the file
        // system for image files. Skip any sub folders.
        if (file_exists($album_dir) && is_dir($album_dir))
        {
            $files = scandir($album_dir);
            foreach ($files as $file_key => $value)
            {
                $img_path = base_url() . 'gallery/' . $album['name'] . '/' . $value;
                $img_location = FCPATH . 'gallery/' . $album['name'] . '/' . $value;
                if (is_dir($img_location))
                {
                    continue;
                }
                $img_pathes[] = $img_path;
            }
        }
        clearstatcache();

        $data['album'] = $album;
        $data['img_pathes'] = $img_pathes;
        $this->loadHeader($lang);
        $this->load->view('/gallery/album', $data);
        $this->load->view('templates/footer', $footer_data);        
    }

    /**
     * Update an album. Use this function to load the view of upload image.
     *
     * @param string $album_id Album ID
     * @param string $lang     Language flag
     *
     * @return void
     */
    public function update_album($album_id = 1, $lang = 'ch')
    {
        if ( ! Access::hasPrivilege(Access::PRI_UPDATE_ALBUM))
        {
            // TODO: show authentication error.
            show_404();
        }

        if ( ! file_exists('application/views/gallery/updateAlbum.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->model('album_model', 'album');
        $data['album'] = $this->album->get_album($album_id);

        $this->load->library('javascript_plugins');
        $plugins = $this->javascript_plugins;
        $footer_data['js_plugins'] = $plugins->generate(array($plugins::FileUpload));

        $this->loadHeader($lang);
        $this->load->view('gallery/updateAlbum', $data);
        $this->load->view('templates/footer', $footer_data);
    }

    /**
     * Upload image.
     *
     * @param string $album_name Album name
     * @param string $lang       Language flag
     *
     * @return void
     */
    public function do_upload($album_name, $lang = 'ch')
    {

        if ( ! Access::hasPrivilege(Access::PRI_UPDATE_ALBUM))
        {
            // TODO: show authentication error.
            show_404();
        }

        $upload_path_url = base_url() . '/gallery/' . $album_name . '/';

        $config['upload_path'] = FCPATH . 'gallery/' . $album_name . '/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '30000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()) 
        {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);

            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f=0;
            foreach ($existingFiles as $fileName => $info) 
            {
              if($fileName!='thumbs')
              {//Skip over thumbs directory
                //set the data for the json array   
                $foundFiles[$f]['name'] = $fileName;
                $foundFiles[$f]['size'] = $info['size'];
                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                $foundFiles[$f]['deleteUrl'] = site_url() . '/gallery/deleteImage/' . $fileName . '/' . $album_name;
                $foundFiles[$f]['deleteType'] = 'POST';
                $foundFiles[$f]['error'] = NULL;

                $f++;
              }
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('files' => $foundFiles)));
        } 
        else 
        {
            $data = $this->upload->data();
            
            //  Array
            //  (
            //  [file_name] => png1.jpg
            //  [file_type] => image/jpeg
            //  [file_path] => /home/ipresupu/public_html/uploads/
            //  [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
            //  [raw_name] => png1
            //  [orig_name] => png.jpg
            //  [client_name] => png.jpg
            //  [file_ext] => .jpg
            //  [file_size] => 456.93
            //  [is_image] => 1
            //  [image_width] => 1198
            //  [image_height] => 1166
            //  [image_type] => jpeg
            //  [image_size_str] => width="1198" height="1166"
            //  )

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
            $info->deleteUrl = site_url() . '/gallery/deleteImage/' . $data['file_name'] . '/' . $album_name;
            $info->deleteType = 'POST';
            $info->error = NULL;

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX)
            {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } 
            else
            {
                $file_data['upload_data'] = $this->upload->data();
                $this->load->view('upload/upload_success', $file_data);
            }
        }
    }

    /**
     * Delete image file from album.
     *
     * @param string $file       file name
     * @param string $album_name album name
     *
     * @return void
     */
    public function deleteImage($file, $album_name) 
    {

        if ( ! Access::hasPrivilege(Access::PRI_UPDATE_ALBUM))
        {
            // TODO: show authentication error.
            show_404();
        }

        //gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . '/gallery/' . $album_name . '/' . $file);
        $success = unlink(FCPATH . '/gallery/' . $album_name . '/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'gallery/' . $album_name . '/' . $file;
        $info->file = is_file(FCPATH . 'gallery/' . $album_name . '/' . $file);

        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } 
        else 
        {
            //here you will need to decide what you want to show for a successful delete        
            $file_data['delete_data'] = $file;
            $this->load->view('admin/delete_success', $file_data);
        }
    }


    /**
     * Creates an album.
     *
     * @param string $lang language flag
     *
     * @return void
     */
    public function create_album($lang = 'ch')
    {
        if ( ! Access::hasPrivilege(Access::PRI_UPDATE_ALBUM))
        {
            // TODO: show authentication error.
            show_404();
        }

        date_default_timezone_set('America/Los_Angeles');
        $this->load->library('form_validation');
        $this->load->library('validation_rules');
        $rules = $this->validation_rules;
        $this->form_validation->set_rules($rules::$album_rules);
        if ($this->form_validation->run() === FALSE)
        {
            // Loads album creation page.
            if ( ! file_exists('application/views/gallery/createAlbum.php'))
            {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $this->_load_resources($lang);
            $data['today'] = date($this->date_time_format, time());
            $data['dateTimeFormat'] = $this->date_time_format;
            $data['lang'] = $lang;

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
            $date_time = DateTime::createFromFormat($this->date_time_format, $this->input->post('date'));

            $data = array();
            $data['date']           = $date_time->format('Y-m-d');
            $data['title']          = $this->input->post('title');
            $data['description']    = $this->input->post('content');
            // $data['lang']           = $lang;
            $data['name'] = time();

            // Create album folder
            mkdir(FCPATH . '/gallery/' . $data['name']);
            // Create thumbs folder
            mkdir(FCPATH . '/gallery/' . $data['name'] . '/thumbs');

            $this->load->model('album_model', 'album');
            $this->album->add_album($data);

            // Redirect to event page.
            $gallery_home_url = sprintf('/gallery/home/%s', $lang);
            redirect($gallery_home_url, 'location', 302);
        }
    }

    /**
     * Update album information, such as album description, album name.
     * This function is NOT for updating the photos in the album.
     *
     * @param string $album_id Album ID.
     * @param string $lang     language flag.
     *
     * @return void
     */
    public function update_album_info($album_id, $lang='ch')
    {
        if ( ! Access::hasPrivilege(Access::PRI_UPDATE_ALBUM))
        {
            // TODO: show authentication error.
            show_404();
        }

        date_default_timezone_set('America/Los_Angeles');
        $this->load->library('form_validation');
        $this->load->library('validation_rules');
        $rules = $this->validation_rules;
        $this->form_validation->set_rules($rules::$album_rules);
        if ($this->form_validation->run() === FALSE)
        {
            $this->_load_resources($lang);
            $this->load->model('album_model', 'album');
            $data['album'] = $this->album->get_album($album_id);

            $date_time = DateTime::createFromFormat($this->mysql_time_format, $data['album']['date']);
            $data['date']   = $date_time->format($this->date_time_format);
            $data['lang']   = $lang;

            $this->load->library('javascript_plugins');
            $plugins = $this->javascript_plugins;
            $footer_data['js_plugins'] = $plugins->generate(array($plugins::DatePicker, $plugins::Tinymce));

            $this->loadHeader($lang);
            $this->load->view('gallery/updateAlbumInfo', $data);
            $this->load->view('templates/footer', $footer_data); 
        }
        else
        {
            $date_time = DateTime::createFromFormat($this->date_time_format, $this->input->post('date'));
            $data = array();
            $data['date']       = $date_time->format('Y-m-d');
            $data['title']      = $this->input->post('title');
            $data['description']    = $this->input->post('content');

            $this->load->model('album_model', 'album');
            $this->album->update_album($album_id, $data);

            // Redirect to album page.
            $album_url = sprintf('/gallery/album/%s/%s', $album_id, $lang);
            redirect($album_url, 'location', 302);
        }
    }

    /**
     * Deletes an album.
     * 
     * @param string $album_id Album ID that used for deleting an album.
     *
     * @return void 
     */
    public function delete_album($album_id)
    {

        if ( ! Access::hasPrivilege(Access::PRI_UPDATE_ALBUM))
        {
            // TODO: show authentication error.
            show_404();
        }

        $this->load->model('album_model', 'album');
        $this->album->delete_album($album_id);
    }

    /**
     * Load resources bundle files.
     *  
     * @param string $lang language flag.
     *
     * @return void
     */
    private function _load_resources($lang = 'ch')
    {
        if ($lang === 'ch')
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

// End of file gallery.php
// Location: ./controllers/gallery.php