<?php
class Request_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /* Get all requests */
    function get_requests($lang)
    {
        $requests = array();
        $this->load->helper('file');
        $rawData = read_file('./assets/data/'.$lang.'/request.json');
        if ($rawData)
        {
            $requests = json_decode($rawData, true);
        }
        return $requests;
    }
}
?>