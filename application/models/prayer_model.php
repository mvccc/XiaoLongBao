<?php
class Prayer_model extends CI_Model {

    var $dateTimeFormat = "m-d-Y";
    var $prayerTable  = 'prayer';
    var $sectionTable  = 'prayer_sections';
    var $itemTable  = 'prayer_items';
    var $colName    = 'date';
    // $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
    // $phpdate = strtotime( $mysqldate );

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * get_prayerItems
     *
     * Get the prayer items for given date.
     *
     * @param   string
     */
    function get_prayerItems($date)
    {
        $this->db->select($this->prayerTable.'.*', FALSE);
        $this->db->select('prayer_sections.name AS section_name', FALSE);
        $this->db->select('prayer_items.description AS item_name', FALSE);
        $this->db->where('date', $date);
        $this->db->from($this->prayerTable);
        $this->db->join($this->sectionTable, 'section_id = prayer_sections.id');
        $this->db->join($this->itemTable, 'item_id = prayer_items.id');
        $this->db->order_by('section_id asc, ordinal asc'); 
        $query = $this->db->get();
        $results = $query->result_array();
        return $results;
    }
    
    /**
     * get_prayerItems
     *
     * Return the latest prayer items in database if any.
     *
     */
    function get_latestPrayerItems()
    {
        $this->db->select_max('date');
        $maxDateQuery = $this->db->get($this->prayerTable);
        if ($maxDateQuery->num_rows() > 0)
        {
            $maxDateResult = $maxDateQuery->result_array();
            $maxDate = $maxDateResult[0]['date'];
            return $this->get_prayerItems($maxDate);
        }       
        return null;
    }
}
?>