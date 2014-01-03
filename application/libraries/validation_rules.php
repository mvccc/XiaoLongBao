<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Validation_rules {
    public static $eventRules = array(
           array(
                 'field'   => 'time', 
                 'label'   => 'time', 
                 'rules'   => 'required'
              ),
           array(
                 'field'   => 'title', 
                 'label'   => 'title', 
                 'rules'   => 'required'
              )
        );

    
}
