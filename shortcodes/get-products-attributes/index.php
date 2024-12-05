<?php

$newAtts = shortcode_atts(array(
    'attribute' => '',
    'attributes_show' => false,
), $atts, 'get-products-attributes');

$attribute_name = $newAtts['attribute'];
$attributesShow = filter_var($newAtts['attributes_show'], FILTER_VALIDATE_BOOLEAN);

echo $attributesShow;

$product_id = get_the_ID();

$product = wc_get_product($product_id);

if (!$product) {
    echo 'Product not found';
}

$attributes = $product->get_attributes();

if ($attributesShow) {
    echo "<pre>";
    print_r($attributes);
    echo "</pre>";
}

foreach ($attributes as $attribute) {
    if ($attribute->get_name() == $attribute_name) {
        echo implode(', ', $attribute->get_options());
    }
}

echo '';