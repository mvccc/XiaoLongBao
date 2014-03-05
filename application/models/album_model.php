<?php
class Album_model extends CI_Model {

    var $tableName  = 'albums';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function get_albums()
    {
        $this->db->from($this->tableName);        
        $this->db->order_by("date", "ASC");
        $result = $this->db->get();
        return $result->result_array();
    }

    function add_albums($data)
    {
        $this->db->insert($this->tableName, $data);
    }

    function delete_albums($id)
    {
        $this->db->delete($this->tableName, array('id' => $id)); 
    }

    function get_album($id)
    {
        $event = $this->db->get_where($this->tableName, array('id' => $id));
        # TODO: check no album found.
        return $event->result_array()[0];
    }

    function update_album($id, $data)
    {
        return $this->db->update($this->tableName, $data, array('id' => $id));
    }

}
?>