<?php
function load_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'name' => '',
    ), $atts, 'shortcode');
    $shortcodeName = $atts['name'];
    $customShortcode = MOLADINPLUGIN_DIR_ROOT . "shortcodes/{$shortcodeName}/index.php";
    if (file_exists($customShortcode)) {
        ob_start();
        include($customShortcode);
        return ob_get_clean();
    }
    return;
}

add_shortcode('moladin_shortcode', 'load_shortcode');
