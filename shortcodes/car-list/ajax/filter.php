<?php
function car_list_filter_action()
{
    $data = isset($_POST['data']) ? sanitize_text_field($_POST['data']) : '';
    $result = process_data($data);
    wp_send_json_success(['result' => $result]);
    wp_die();
}

function process_data($data)
{
    return "Processed data: " . $data;
}