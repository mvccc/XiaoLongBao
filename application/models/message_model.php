<?php
class Message_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /* Get all messages */
    function get_messages()
    {
        $messages = array();
        $this->load->helper('file');

        // mw: Read data from json data file.
        $rawData = read_file('./assets/data/ch/worship.json');
        if ($rawData)
        {
            $messages = json_decode($rawData, true);
        }

        // mw: Keep the current pastors only.
        foreach ($messages as $key => $message) {
            if($message['category'] != 'sundayMessage')
            {
                unset($messages[$key]);
            }
        }
        return $messages;
    }
}
?>