<?php
add_action('rest_api_init', function () {
    register_rest_route('api/v1', '/image/', [
        'methods' => 'GET',
        'callback' => 'handle_image_request',
        'permission_callback' => '__return_true',
    ]);
});

function handle_image_request(WP_REST_Request $request)
{

    $method = $request->get_method();
    $type = $request->get_param('type');

    if ($method === "GET") {
        $path = $request->get_param('path');

        if ($path) {
            if ($type === 't') {
                $path = ltrim($path, '/');
                $image_base_dir = MOLADINPLUGIN_DIR_ROOT;
                $image_path = realpath($image_base_dir . DIRECTORY_SEPARATOR . $path);

                $normalized_image_path = str_replace('\\', '/', $image_path);
                $normalized_image_base_dir = str_replace('\\', '/', $image_base_dir);

                if ($normalized_image_path && strpos($normalized_image_path, $normalized_image_base_dir) === 0) {
                    if (file_exists($image_path)) {
                        $image_info = getimagesize($image_path);
                        if ($image_info !== false) {
                            header('Content-Type: ' . $image_info['mime']);
                            readfile($image_path);
                            exit;
                        }
                    }

                    if (pathinfo($path, PATHINFO_EXTENSION) === 'svg') {
                        header('Content-Type: image/svg+xml');
                        readfile($image_path);
                        exit;
                    }

                    header('Content-Type: application/json', true, 404);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Image not found or cannot be processed.'
                    ]);
                    exit;
                }

                header('Content-Type: application/json', true, 400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid image path.'
                ]);
                exit;
            } else {
                $image_url = $path;
                $response = wp_remote_get($image_url);

                if (is_wp_error($response)) {
                    header('Content-Type: application/json', true, 404);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Failed to retrieve the image from the URL.'
                    ]);
                    exit;
                }

                $image_data = wp_remote_retrieve_body($response);
                $image_info = getimagesizefromstring($image_data);

                if ($image_info !== false) {
                    header('Content-Type: ' . $image_info['mime']);
                    echo $image_data;
                    exit;
                }

                header('Content-Type: application/json', true, 404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Image not found or cannot be processed.'
                ]);
                exit;
            }
        }

        header('Content-Type: application/json', true, 400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Path parameter is missing.'
        ]);
        exit;
    }

    header('Content-Type: application/json', true, 405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit;

}
