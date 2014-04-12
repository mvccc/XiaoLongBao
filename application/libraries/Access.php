<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Access {
  const ROLE_ADMIN = 'A';
  const ROLE_ITWORKER = 'I';
  const ROLE_EDITOR = 'E';
  const ROLE_MEMBER = 'M';
  
  const PRI_UPDATE_CALENDER = 0;
  const PRI_UPDATE_ALBUM = 1;
  const PRI_READ_PRAYER = 2;
  const PRI_UPDATE_PRAYER = 3;
  const PRI_UPDATE_WORSHIP = 4;
  
  /** @const */ 
  private static $p_matrix = array (
      'A' => array (1, 1, 1, 1, 1),
      'I' => array (0, 1, 1, 0, 1),
      'E' => array (1, 1, 1, 1, 0),
      'M' => array (0, 0, 1, 0, 0)
  );
  
  static function isLoggedIn()
  {
    $CI =& get_instance();
    $CI->load->library('session');
    
    $logged_in = $CI->session->userdata('logged_in');
    return (bool)$logged_in;
  }
  
  static function isRole($role)
  {
    $CI =& get_instance();
    $CI->load->library('session');
    
    $user_role = $CI->session->userdata('role');
    return ($role == $user_role);
  }
  
  static function hasPrivilege($privilege)
  {
    $CI =& get_instance();
    $CI->load->library('session');

    $role = $CI->session->userdata('role');
    if ($role && self::$p_matrix[$role][$privilege])
    {
      return TRUE;
    }
    return FALSE;
  }

}