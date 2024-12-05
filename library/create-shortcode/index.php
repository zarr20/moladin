<?php
class Moladin_Shortcode_Loader
{

    public function __construct()
    {
        add_shortcode('moladin_shortcode', array($this, 'load_shortcode'));
    }

    public function load_shortcode($atts)
    {
        $newAtts = shortcode_atts(array(
            'name' => '',
        ), $atts, 'moladin_shortcode');

        $shortcodeName = $newAtts['name'];

        $customShortcode = MOLADINPLUGIN_DIR_ROOT . "shortcodes/{$shortcodeName}/index.php";

        if (file_exists($customShortcode)) {
            ob_start();  
            include($customShortcode);  
            return ob_get_clean(); 
        }

        return "Shortcode not found!";
    }
}

new Moladin_Shortcode_Loader();
