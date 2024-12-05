
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
    <div class="relative flex h-full gap-10 p-4">
        <!-- Filter Sidebar -->
        <div class="w-[320px]">
            <?php include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/sidebar-filter.php') ?>
        </div>

        <!-- Product Listings -->
        <div class="w-full space-y-4 desktop:space-y-[40px]">
            <?php include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/search-bar.php') ?>
            <div id="products">
                <?php include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/products.php') ?>
            </div>
        </div>
    </div>
</div>

