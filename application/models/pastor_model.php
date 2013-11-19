<?php
class Pastor_model extends CI_Model {

	function __construct()
	{
    	// Call the Model constructor
		parent::__construct();
	}

	/* Get current pastors */
	function get_current_pastors($lang)
	{
		$pastors = array();
		$this->load->helper('file');

		// mw: Read data from json data file.
		$rawData = read_file('./assets/data/'.$lang.'/pastor.json');
		if ($rawData)
		{
			$pastors = json_decode($rawData, true);
		}

		// mw: Keep the current pastors only.
		foreach ($pastors as $key => $value) {
			if($value['status'] != 'current')
			{
				unset($pastors[$key]);
			}
		}
		return $pastors;
	}
}
?>