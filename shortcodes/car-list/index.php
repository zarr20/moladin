<?php
if (taxonomy_exists('product_cat')) {
    $term = get_queried_object();
    // var_dump($term);
    // echo $term->name;
}

?>

<div class="container">
    <div class="">
        <div class="mb-[24px]">
            <div>Partner Moladin</div>
            <h1 class="text-2xl font-bold mb-2">Anugerah Dealer Terpercaya</h1>
        </div>
        <div class="flex justify-between text-gray-600 p-[24px] border border-[#BFBFBF] rounded-[8px]">
            <div>
                <span class="block">Jumlah transaksi</span>
                <span class="text-xl font-bold">121 transaksi di Molaidin</span>
            </div>
            <div>
                <span class="block">Bergabung sejak</span>
                <span class="text-gray-800">Desember 2022</span>
            </div>
        </div>
        <div>
            Semua Listing Anugerah Dealer Terpecaya
        </div>
    </div>
    <div class="relative flex h-full gap-10">
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
            <div class="flex items-center justify-center">
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
                        if (response.status === "error") {
                            $('#load-more').prop('disabled', true).text('Tidak ada produk lagi');
                        } else {
                            $('#products').append(response);
                        }
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