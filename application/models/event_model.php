<?php
class Event_model extends CI_Model {

    var $dateTimeFormat = "m-d-Y";
    var $tableName  = 'events';
    var $colName    = 'date';
    // $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
    // $phpdate = strtotime( $mysqldate );

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function get_events($year='', $month='', $lang)
    {
        $this->db->from($this->tableName);        
        $this->db->where('YEAR(date) =', $year);
        $this->db->where('MONTH(date) =', $month); 
        $this->db->where('lang', $lang);
        $this->db->order_by("date", "ASC");
        $result = $this->db->get();
        return $result->result_array();
    }

    function add_event($data)
    {
        $this->db->insert($this->tableName, $data);
    }

    function delete_event($id)
    {
        $this->db->delete($this->tableName, array('id' => $id)); 
    }

    function get_event($id)
    {
        $event = $this->db->get_where($this->tableName, array('id' => $id));
        # TODO: check no event found.
        return $event->result_array()[0];
    }

    function update_event($id, $data)
    {
        return $this->db->update($this->tableName, $data, array('id' => $id));
    }

}
?>