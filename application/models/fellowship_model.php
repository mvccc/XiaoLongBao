<?php
class Fellowship_model extends CI_Model {

    /* mw: This data should be in database. */
    private static $fellowships = array(
                'pine'      => '松柏團契',
                'sister'    => '姐妹團契',
                'truth'     => '真理團契',
                'well'      => '活泉團契',
                'alleluia'  => '哈利路亞團契',
                'spring'    => '甘泉團契',
                'life'      => '新生命團契',
                'song'      => '雅歌團契',
                'believe'   => '信望愛團契',
                'world'     => '新天地團契',
                'ark'       => '方舟團契',
                'friend'    => '良友團契',
                'qingCaoDi' => '青草地團契',
                'caleb'     => '迦勒團契',
                'joshua'    => '青年(約書亞)團契',
                'discuss'   => '信仰探討班',
                );

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /* Get all fellowships */
    function get_fellowships()
    {
        return self::$fellowships;
    }

    /* Get fellowship by name */
    function get_fellowship($name)
    {
        return self::$fellowships[$name];
    }

    function add_fellowship()
    {
        // TODO
    }

    function update_fellowship()
    {
        // TODO
    }

}
?>