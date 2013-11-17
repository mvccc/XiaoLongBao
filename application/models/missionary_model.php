<?php
class Missionary_model extends CI_Model {

	function __construct()
	{
    	// Call the Model constructor
		parent::__construct();
	}

	/* Get all missionaries */
	function get_missionaries()
	{
		$missionaries = array();
		$this->load->helper('file');
		$rawData = read_file('./assets/data/missionary.json');
		if ($rawData)
		{
			$missionaries = json_decode($rawData, true);
		}
		return $missionaries;
	}

	/* Get missionary by id */
	function get_missionary($id)
	{
		// TODO
	}

	function add_missionary()
	{
    	// TODO
	}

	function update_missionary()
	{
    	// TODO
	}
}
?>