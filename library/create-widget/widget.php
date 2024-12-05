<?php

namespace Moladin;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Moladin_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'moladin_widget';
    }

    public function get_title()
    {
        return 'Moladin Widget';
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'moladin'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $widget_folders = $this->get_widget_folders();

        $this->add_control(
            'folder_name',
            [
                'label' => __('Select Widget', 'moladin'),
                'type' => Controls_Manager::SELECT,
                'options' => $widget_folders,
                'default' => key($widget_folders),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $folder_name = $settings['folder_name'];

        if (!empty($folder_name)) {
            $shortcode_output = $this->load_folder_content($folder_name);
            echo '<div class="widget-container">';
            echo $shortcode_output;

            if (isset($settings['child_content']) && !empty($settings['child_content'])) {
                echo '<div class="widget-children">';
                echo $settings['child_content'];
                echo '</div>';
            }

            echo '</div>';
        } else {
            echo '<p>' . __('Please select a widget folder.', 'moladin') . '</p>';
        }
    }

    private function get_widget_folders()
    {
        $shortcodes_dir = MOLADINPLUGIN_DIR_ROOT . 'shortcodes/';
        $folders = [];

        if (is_dir($shortcodes_dir)) {
            foreach (scandir($shortcodes_dir) as $folder) {
                if ($folder !== '.' && $folder !== '..' && is_dir($shortcodes_dir . $folder)) {
                    $folders[$folder] = ucfirst($folder);
                }
            }
        }

        return $folders;
    }

    private function load_folder_content($folder_name)
    {
        $shortcode_path = MOLADINPLUGIN_DIR_ROOT . "shortcodes/{$folder_name}/index.php";

        if (file_exists($shortcode_path)) {
            ob_start();
            include($shortcode_path);
            return ob_get_clean();
        }

        return '<p>' . __('Content not found.', 'moladin') . '</p>';
    }

}