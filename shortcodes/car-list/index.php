<div class="container">
    <div class="relative flex h-full gap-10 p-4">
        <!-- Filter Sidebar -->
        <div class="w-[320px]">
            <?php include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/sidebar-filter.php') ?>
        </div>

        <!-- Product Listings -->
        <div class="w-full space-y-4 desktop:space-y-[40px]">
            <?php include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/search-bar.php') ?>
            <div>
                <!-- Product Listings -->
                <div id="products" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <?php include(MOLADINPLUGIN_DIR_ROOT . 'shortcodes/car-list/components/products.php') ?>

                </div>
            </div>
            <div class="flex items-center justify-center min-h-screen bg-gray-100">
                <button id="load-more"
                    class="border border-orange-500 text-orange-500 font-medium py-2 px-4 rounded hover:bg-orange-100">
                    Muat Lebih Banyak
                </button>
            </div>
        </div>

    </div>
</div>


<script>
    var page = 1;
    window.addEventListener('DOMContentLoaded', function () {
        $('#load-more').on('click', function (event) {
            event.preventDefault();
            page++;
            var formData = $('#filter-form').serialize();
            const searchTerm = $('#search-bar').val();
            formData = formData + '&s=' + encodeURIComponent(searchTerm) + '&currentpage=' + page;
            var encodedData = btoa(formData);


            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'get_products',
                    data: encodedData,
                },
                success: function (response) {
                    if (response) {
                        $('#products').append(response);
                    } else {
                        $('#load-more').prop('disabled', true).text('Tidak ada produk lagi');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    page--;
                    console.error("AJAX request failed:", xhr.status, thrownError);
                    alert('An error occurred during the request. Please try again later.');
                }
            });
        });
    });
</script>