<?php
if (isset($_POST['data'])) {
    parse_str(base64_decode($_POST['data']), $data);
    // var_dump($data);
}
?>

<?php

$min_price = (isset($data['min_price']) && $data['min_price'] !== "") ? $data['min_price'] : 0;
$max_price = (isset($data['max_price']) && $data['max_price'] !== "") ? $data['max_price'] : PHP_INT_MAX;

$paged = isset($data['currentpage']) ? $data['currentpage'] : 1;

$args = array(
    'post_type' => 'product',
    'posts_per_page' => 10,
    'post_status' => 'publish',
    'order' => 'DESC',
    'paged' => $paged,
);

if (!empty($data['s'])) {
    $args['s'] = sanitize_text_field($data['s']);
}

$price_meta_query = array(
    'relation' => 'OR',
    array(
        'key' => '_price',
        'value' => array($min_price, $max_price),
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC',
    ),
    array(
        'key' => '_sale_price',
        'value' => array($min_price, $max_price),
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC',
    ),
);

$args['meta_query'][] = $price_meta_query;


if (!empty($_POST['filter_category'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'product_cat',
        'field' => 'term_id',
        'terms' => absint(sanitize_text_field($_POST['filter_category'])),
    );
}

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $product = wc_get_product(get_the_id());
        ?>
        <a href="<?= get_permalink() ?>" class="rounded-lg border-2 overflow-hidden">
            <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_the_title() ?>" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold"><?= get_the_title() ?></h3>
                <p class="text-orange-600 text-xl font-bold"><?= wc_price($product->get_price()) ?></p>

                <div class='flex items-center gap-[8px] text-sm text-gray-600 mt-2'>
                    <span class='flex items-center gap-2 px-[5.5px] py-[7px] border-2 rounded-lg'>
                        <img src="<?php echo generate_image_url('assets/imgs/icon/solar_transmission-bold.svg', 't') ?>"
                            width="15" height="15" />
                        <div>
                            <?php echo do_shortcode('[moladin_shortcode name="get-products-attributes" attribute="Transmission" attributes_show="false"]'); ?>
                        </div>
                    </span>
                    <span class='flex items-center gap-2 px-[5.5px] py-[7px] border-2 rounded-lg'>
                        <img src="<?php echo generate_image_url('assets/imgs/icon/mdi_energy-outline.svg', 't') ?>" width="15"
                            height="15" />
                        <div>
                            <?php echo do_shortcode('[moladin_shortcode name="get-products-attributes" attribute="Mileage Range" attributes_show="false"]'); ?>
                        </div>
                    </span>
                </div>
                <div class='flex items-center gap-2 text-gray-600 text-sm mt-2'>
                    <img src="<?php echo generate_image_url('assets/imgs/icon/location-icon.svg', 't') ?>" width="15"
                        height="15" />
                    <div>
                        Jakarta Pusat
                    </div>
                </div>
            </div>
        </a>
        <?php
    }
} else {
    if ($paged >= 1) {
        header('Content-type: application/json');
        $response = array(
            'status' => 'error',
        );

        echo json_encode($response);
        die;
    }
    echo '<p>No products found.</p>';
}
wp_reset_postdata();
?>