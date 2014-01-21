<?php
class Person_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_persons()
	{
	  // refer CI's Model and DB methods
	  $query = $this->db->get('Persons');
	  return $query->result_array();
	}
}