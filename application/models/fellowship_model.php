<?php
class Fellowship_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /* Get all fellowships */
    function get_fellowships($lang)
    {
        $fellowships = $this->readData($lang);
        return $fellowships;
    }

    /* Get fellowship by key */
    function get_fellowship($key, $lang)
    {
        $fellowships = $this->readData($lang);
        if (array_key_exists($key, $fellowships))
        {
            return $fellowships[$key];
        }
        return False;
    }

    function add_fellowship()
    {
        // TODO
    }

    function update_fellowship()
    {
        // TODO
    }

    /* Read data from file */
    private function readData($lang)
    {
        $fellowships = array();
        $this->load->helper('file');
        $rawData = read_file('./assets/data/'.$lang.'/fellowship.json');
        if ($rawData)
        {
            $fellowships = json_decode($rawData, true);
        }
        return $fellowships;
    }

}
?>