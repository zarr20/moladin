<?php
add_action('rest_api_init', function () {
    register_rest_route('ajax', '/products', [
        'methods' => 'GET',
        'callback' => 'get_products',
        'permission_callback' => '__return_true',
    ]);
});


function get_products($request)
{
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    header('Content-Type: text/html');
    include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/products.php');
    exit;
    // return new WP_REST_Response($html, 200, $headers);
}