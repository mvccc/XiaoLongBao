<?php
class Video_model extends CI_Model {

  const TABLE_VIDEO = 'videos';

	public function __construct()
	{
		$this->load->database();
	}
	
	public function add_video($data, $sunday = 'Y')
	{
	  $data['sunday_message'] = $sunday;
	  $this->db->insert('videos', $data);
	}

	public function update_video($id, $data)
	{
	  $this->db->update(self::TABLE_VIDEO, $data, array('id' => $id));
	}
	
	public function delete_video($id)
	{
	  $this->db->delete(self::TABLE_VIDEO, array('id' => $id));
	  exit;
	}

	public function get_video_count($sunday = TRUE)
	{
	  $this->db->from('videos');
	  if ($sunday == TRUE)
	  {
	    $this->db->where(array('sunday_message' => 'Y'));
	  }
	  return $this->db->count_all_results();
	}
	
	public function get_video($id)
	{
	  if (!isset($id))
	  {
	    return $this->get_last_video();
	  }
	  $query = $this->db->get_where('videos', array('id' => $id));
	  return $query->row_array();
	}
	
	public function get_last_video()
	{
	  $this->db->order_by('date desc');
	  $this->db->limit(1);
	  $query = $this->db->get('videos');
	  return $query->row_array();
	}
	
	/**
	 * get limit rows from video table
	 */
	public function get_sunday_videos($limit = 5, $start = 0)
	{
	  $this->db->order_by('date desc');
	  $query = $this->db->get_where('videos', array('sunday_message' => 'Y'), $limit, $start);
	  return $query->result_array();
	}
	
}