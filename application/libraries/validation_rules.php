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

  public static $worshipRules = array(
      array(
          'field'   => 'date',
          'label'   => 'date',
          'rules'   => 'regex_match[/^\d\d\d\d-\d\d-\d\d$/]'
      ),
      array(
          'field'   => 'title',
          'label'   => 'title',
          'rules'   => 'trim|required|max_length[40]'
      ),
      array(
          'field'   => 'speaker',
          'label'   => 'speaker',
          'rules'   => 'trim|required|max_length[40]'
      ),
      array(
          'field'   => 'video',
          'label'   => 'video',
          'rules'   => 'trim|required|regex_match[/^\d\d-\d\d-\d\d\d\d\.flv$/]'
      ),
      array(
          'field'   => 'audio',
          'label'   => 'audio',
          'rules'   => 'trim|required|regex_match[/^\d\d-\d\d-\d\d\d\d\.mp3$/]'
      ),
      array(
          'field'   => 'scripture',
          'label'   => 'scripture',
          'rules'   => 'trim|required'
      ),
  );
}
