<?php
if (isset($_GET['data'])) {
    parse_str(base64_decode($_GET['data']), $data);
    // var_dump($data);
}
?>

<!-- Product Listings -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <?php

    $min_price = (isset($data['min_price']) && $data['min_price'] !== "") ? $data['min_price'] : 0;
    $max_price = (isset($data['max_price']) && $data['max_price'] !== "") ? $data['max_price'] : PHP_INT_MAX;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'post_status' => 'publish',
        'order' => 'DESC',
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


    if (!empty($_GET['filter_category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => absint(sanitize_text_field($_GET['filter_category'])),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_id());
            ?>
            <a href="<?= get_permalink() ?>" class="border rounded-lg shadow-lg overflow-hidden">
                <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_the_title() ?>" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold"><?= get_the_title() ?></h3>
                    <p class="text-orange-600 text-xl font-bold"><?= wc_price($product->get_price()) ?></p>
                </div>
            </a>
            <?php
        }
    } else {
        echo '<p>No products found.</p>';
    }
    wp_reset_postdata();
    ?>
</div>