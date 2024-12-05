<?php

/**
 * Generate a URL for an image using the WordPress REST API.
 *
 * @param string $relative_path The relative path of the image.
 * @param string|null $type The type of the image. Possible values:
 *                          - 'plugin'
 *                          - null (default, no type specified)
 * @return string The generated URL.
 */
function generate_image_url($relative_path, $type = null)
{
    $encoded_path = urlencode($relative_path);
    $url = get_site_url() . "/wp-json/api/v1/image?path=" . $encoded_path;

    if ($type) {
        $url .= "&type=" . urlencode($type);
    }

    return $url;
}

function get_first_image_from_content($content)
{
    if (preg_match_all('/<img[^>]+>/i', $content, $matches)) {
        if (isset($matches[0][0])) {
            if (preg_match('/src="([^"]+)"/i', $matches[0][0], $src)) {
                return isset($src[1]) ? $src[1] : '';
            }
        }
    }
    return '';
}
