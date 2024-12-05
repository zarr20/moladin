<?php

function http_request($url, $method = 'GET', $data = [], $headers = ['Content-Type' => 'application/json'])
{
    $args = [
        'method' => strtoupper($method),
        'headers' => $headers,
    ];

    if (!empty($data)) {
        $args['body'] = json_encode($data);
    }

    if ($method === 'POST') {
        $response = wp_remote_post($url, $args);
    } else {
        $response = wp_remote_request($url, $args);
    }

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        return "Error fetching data: $error_message";
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        if (isset($data["code"]) && $data["code"] == "rest_no_route") {
            return false;
        }else{
            return $data;
        }
    }
}