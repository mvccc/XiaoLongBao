<?php
class Person_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_persons($name = FALSE)
	{
	  $this->db->order_by('id', "asc");

	  if ($name === FALSE)
	  {
	    // refer CI's Model and DB methods
	    $query = $this->db->get('persons');
/*	    
	    var_dump($query->result());
	    echo "<br>";
	    var_dump($query->result_array());
	    echo "<br>";
	    var_dump($query->row());
	    echo "<br>";
	    var_dump($query->row_array());
*/
	    // We use result_array() which ensure return something (empty array if no result). 
	    return $query->result_array();
	  }
	  
	  $query = $this->db->get_where('persons', array('name' => $name));
	  return $query->result_array();
	}
	
	public function add_person()
	{
	  $data = array('name' => $this->input->post('pname'));
	  return $this->db->insert('persons', $data);
	}
	
}