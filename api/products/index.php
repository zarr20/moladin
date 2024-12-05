<?php
add_action('wp_ajax_get_products', 'get_products'); // For logged-in users
add_action('wp_ajax_nopriv_get_products', 'get_products'); // For non-logged-in users (if needed)

function get_products()
{
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Content-Type: text/html');

    if (file_exists(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/products.php')) {
        include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/products.php');
    } else {
        echo 'Products file not found.';
    }
    exit;
}