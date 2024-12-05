<?php
function moladin_register_widget()
{
    try {
        if (!did_action('elementor/loaded')) {
            throw new Exception('Elementor is not loaded.');
        }
        require_once( MOLADINPLUGIN_DIR_ROOT . 'library/create-widget/widget.php' );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Moladin\Moladin_Widget());
    } catch (Exception $e) {
        error_log('Error in moladin_register_widget: ' . $e->getMessage());
    }
}

add_action('elementor/widgets/widgets_registered', 'moladin_register_widget');
