<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Validation_rules {
    public static $eventRules = array(
           array(
                 'field'   => 'time', 
                 'label'   => 'time', 
                 'rules'   => 'trim|required|max_length[20]'
              ),
           array(
                 'field'   => 'title', 
                 'label'   => 'title', 
                 'rules'   => 'trim|required|max_length[20]'
              )
        );

    public static $album_rules = array(
           array(
                 'field'   => 'title', 
                 'label'   => 'title', 
                 'rules'   => 'trim|required|max_length[20]'
              )
        );
}
