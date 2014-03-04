<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_user($user)
	{
	  $query = $this->db->get_where('users', array('username' => $user));
	  return $query->result_array();
	}
	
	
}