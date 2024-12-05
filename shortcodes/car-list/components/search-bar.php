<div class="relative w-full">
    <input id="search-bar" type="text" placeholder="Car model, condition: Honda CR-V 2019"
        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
</div>


<script>
    $(document).ready(function () {
        let debounceTimer;

        function debounce(func, wait) {
            return function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(func, wait);
            };
        }

        const search = debounce(function () {
            var formData = $('#filter-form').serialize();
            const searchTerm = $('#search-bar').val();
            const newFormData = formData + '&s=' + encodeURIComponent(searchTerm);

            var encodedData = btoa(newFormData);
            var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?query=' + encodedData;
            window.history.pushState({ path: newUrl }, '', newUrl);

            $('#products').html('');

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'get_products',
                    data: encodedData,
                },
                success: function (response) {
                    $('#products').html(response);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.error("AJAX request failed:", xhr.status, thrownError);
                    alert('An error occurred during the request. Please try again later.');
                }
            });
        }, 300);

        $('#search-bar').on('input', search);
    });  
</script>