<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Javascript_plugins {

    const FancyBox = 'fancyBox';
    const Masonry  = 'masonry';
    const Tinymce  = 'tinymce';
    const DatePicker = 'datePicker';
    const Holder = 'holder';

    private static $four_spaces = "    ";

    private $fancyBox = array(
        'name' => 'fancyBox',
        'src'  => array(
            'lib/jquery.mousewheel-3.0.6.pack.js',
            'source/jquery.fancybox.pack.js?v=2.1.5',
            'source/helpers/jquery.fancybox-buttons.js?v=1.0.5',
            'source/helpers/jquery.fancybox-media.js?v=1.0.6',
            'source/helpers/jquery.fancybox-thumbs.js?v=1.0.7'
            ),
        'css'  => array(
            'source/jquery.fancybox.css?v=2.1.5' => array('media' => 'screen'),
            'source/helpers/jquery.fancybox-buttons.css?v=1.0.5' => array('media' => 'screen'),
            'source/helpers/jquery.fancybox-thumbs.css?v=1.0.7' => array('media' => 'screen')
          ),
        'init_script' => 'init.js'
        );

    private $masonry = array(
        'name' => 'masonry',
        'src'  => array('masonry.pkgd.min.js'),
        'css'  => array(),
        'init_script' => 'init.js'
        );

    private $tinymce = array(
        'name' => 'tinymce',
        'src'  => array('tinymce.min.js'),
        'css'  => array(),
        'init_script' => 'init.js'
        );

    private $datePicker = array(
        'name' => 'datePicker',
        'src'  => array('bootstrap-datepicker.js'),
        'css'  => array('datepicker.css' => array()),
        'init_script' => 'init.js'       
        );

    private $holder = array(
        'name' => 'holder',
        'src'  => array('holder.js'),
        'css'  => array(),     
        );

    # Generate the lib path and css path of JavaScript plugins.
    # Param: $plugins - array of plugin name. E.g array(Javascript_plugins::FancyBox, Javascript_plugins::Masonry)
    public function generate($plugins)
    {
        $out = "";
        foreach ($plugins as $key => $plugin) 
        {
            # We use $this->$plugin intead of $this->plugin for loading different plugin information.
            $pluginInfo = $this->$plugin;
            $pluginName = $pluginInfo['name'];
            $pluginPath = base_url() . 'assets/plugin/' . $pluginName;

            # Generate HTML comment for JavaScript plugin.
            $out .= "\n\n";
            $out .= self::$four_spaces;
            $out .= sprintf('<!-- JavaScript Plugin: %s -->', $pluginName);
            $out .= "\n";

            # Generate JavaScirpt plugin CSS file links.
            foreach ($pluginInfo['css'] as $css => $properties) 
            {
                $cssFullPath = $pluginPath . '/' . $css;
                $out .= self::$four_spaces;
                $out .= sprintf('<link rel="stylesheet" href="%s" type="text/css"', $cssFullPath);

                # Generate properties for the CSS link tag.
                foreach ($properties as $key => $value) {
                    $out .= sprintf(' %s="%s"', $key, $value);
                }
                $out .= '/>';
                $out .= "\n";
            }

            # Generate JavaScript source paths.
            foreach ($pluginInfo['src'] as $key => $src) 
            {
                $pluginFullPath = $pluginPath . '/' . $src;
                $out .= self::$four_spaces;
                $out .= sprintf('<script type="text/javascript" src="%s"></script>', $pluginFullPath);
                $out .= "\n";
            }

            # Generate JavaScript initial file source path.
            if (isset($pluginInfo['init_script']))
            {
                $iniFilePath = $pluginPath . '/' . $pluginInfo['init_script'];
                $out .= self::$four_spaces;
                $out .= sprintf('<script type="text/javascript" src="%s"></script>', $iniFilePath);
                $out .= "\n";
            }
        }
        return $out;
    }
}
