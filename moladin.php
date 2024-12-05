<?php
/**
 * Plugin Name: Moladin
 * Description: 
 * Version: 1.0
 * Author: Moladin
 */

if (!defined('ABSPATH'))
    exit;

define('MOLADINPLUGIN_DIR_ROOT', plugin_dir_path(__FILE__));
define('MOLADINPLUGIN_URL_ROOT', plugin_dir_url(__FILE__));

require_once 'api/autoload.php';
require_once 'library/autoload.php';

function moladin_enqueue_styles()
{
    wp_enqueue_style(
        'moladin-plugin-style',
        MOLADINPLUGIN_URL_ROOT . 'assets/dist/css/moladin-plugin-style.css',
        array(),
        '1.0',
        'all'
    );
}

add_action('wp_head', 'moladin_enqueue_styles');

function enqueue_my_scripts()
{
    wp_enqueue_script('my-filter-script', get_template_directory_uri() . '/js/my-script.js', array('jquery'), '1.0', true); // Path to your JS file  
    wp_localize_script('my-filter-script', 'moladin_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');