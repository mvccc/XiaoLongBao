<?php
class Event_model extends CI_Model {

    var $tableName  = 'events';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function get_events($year='', $month='')
    {
        $data = array();
        $data["year"]    = $year;
        $data["month"]   = $month;
        $result = $this->db->get_where($this->tableName, $data);
        return $result;
    }

    function add_event($data)
    {
        $this->db->insert($this->tableName, $data);
    }

    function delete_event($id)
    {
        $this->db->delete($this->tableName, array('_id' => $id)); 
    }

    function update_event()
    {
        // TODO
    }

}
?>