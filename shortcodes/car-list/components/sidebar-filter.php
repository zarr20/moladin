<div class="border-[1px] rounded-[8px]">
    <div class="bg-[#F1F1F1DD] px-[16px] py-[8px]">
        <div class="text-[18px] font-bold">Filter</div>
    </div>
    <form id="filter-form">
        <div id="filter-accordion">

            <!-- Lokasi -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Lokasi</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <input type="text" name="location" placeholder="Kebayoran Baru"
                        class="w-full px-[8px] py-[11px] border rounded-[4px]" />
                </div>
            </div>

            <!-- Harga -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Harga</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <!-- Checkbox options -->
                    <div>
                        <input type="checkbox" name="harga[]" data-min="0" data-max="100000000" value="< Rp100 Juta"
                            class="price-checkbox" />
                        <label>&lt; Rp100 Juta</label>
                    </div>
                    <div>
                        <input type="checkbox" name="harga[]" data-min="100000000" data-max="200000000"
                            value="Rp100 - Rp200 Juta" class="price-checkbox" />
                        <label>Rp100 - Rp200 Juta</label>
                    </div>
                    <div>
                        <input type="checkbox" name="harga[]" data-min="200000000" data-max="300000000"
                            value="Rp200 - Rp300 Juta" class="price-checkbox" />
                        <label>Rp200 - Rp300 Juta</label>
                    </div>
                    <div>
                        <input type="checkbox" name="harga[]" data-min="300000000" data-max="500000000"
                            value="Rp300 - Rp500 Juta" class="price-checkbox" />
                        <label>Rp300 - Rp500 Juta</label>
                    </div>
                    <div>
                        <input type="checkbox" name="harga[]" data-min="500000000" data-max="" value="Rp500 Juta"
                            class="price-checkbox" />
                        <label>Rp500 Juta</label>
                    </div>

                    <!-- Range input -->
                    <div>
                        <label for="min_price">Minimal: </label>
                        <input type="number" id="min_price" name="min_price" min="0" max="99999999999"
                            class="w-full mt-2 px-[8px] py-[11px] border rounded-[4px]" />
                    </div>
                    <div>
                        <label for="max_price">Maksimal: </label>
                        <input type="number" id="max_price" name="max_price" min="0" max="99999999999"
                            class="w-full mt-2 px-[8px] py-[11px] border rounded-[4px]" />
                    </div>
                </div>
            </div>

            <!-- Tahun -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Tahun</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <!-- Checkbox options -->
                    <div>
                        <input type="checkbox" name="tahun[]" value="< 3 Tahun" /> <label>&lt; 3 Tahun</label>
                    </div>
                    <div>
                        <input type="checkbox" name="tahun[]" value="3 - 5 Tahun" /> <label>3 - 5 Tahun</label>
                    </div>
                    <div>
                        <input type="checkbox" name="tahun[]" value="5 - 7 Tahun" /> <label>5 - 7 Tahun</label>
                    </div>
                    <div>
                        <input type="checkbox" name="tahun[]" value="7 Tahun" /> <label>7 Tahun</label>
                    </div>
                </div>
            </div>

            <!-- Jarak Tempuh -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Jarak Tempuh</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <!-- Checkbox options -->
                    <div>
                        <input type="checkbox" name="jarak_tempuh[]" value="< 10,000 KM" /> <label>&lt; 10,000
                            KM</label>
                    </div>
                    <div>
                        <input type="checkbox" name="jarak_tempuh[]" value="10,000 - 50,000 KM" /> <label>10,000 -
                            50,000 KM</label>
                    </div>
                    <div>
                        <input type="checkbox" name="jarak_tempuh[]" value="50,000 - 70,000 KM" /> <label>50,000 -
                            70,000 KM</label>
                    </div>
                    <div>
                        <input type="checkbox" name="jarak_tempuh[]" value="70,000 KM" /> <label>70,000 KM</label>
                    </div>
                </div>
            </div>

            <!-- Merek dan Tipe -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Merek dan Tipe</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <input type="text" class="w-full px-[8px] py-[11px] border rounded-[4px] mb-2"
                        placeholder="Cari Merek dan Tipe..." />

                    <!-- Checkbox options -->
                    <div>
                        <input type="checkbox" name="merek[]" value="Honda" /> <label>Honda</label>
                        <div class="ml-4">
                            <input type="checkbox" name="merek[]" value="Honda Jazz" /> <label>Honda Jazz</label>
                            <input type="checkbox" name="merek[]" value="Honda CR-V" /> <label>Honda CR-V</label>
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="merek[]" value="Toyota" /> <label>Toyota</label>
                    </div>
                    <div>
                        <input type="checkbox" name="merek[]" value="Nissan" /> <label>Nissan</label>
                    </div>
                    <div>
                        <input type="checkbox" name="merek[]" value="Chery" /> <label>Chery</label>
                    </div>
                </div>
            </div>

            <!-- Jenis Bahan Bakar -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Jenis Bahan Bakar</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <div>
                        <input type="checkbox" name="bahan_bakar[]" value="Bensin" /> <label>Bensin</label>
                    </div>
                    <div>
                        <input type="checkbox" name="bahan_bakar[]" value="Diesel" /> <label>Diesel</label>
                    </div>
                    <div>
                        <input type="checkbox" name="bahan_bakar[]" value="Hybrid" /> <label>Hybrid</label>
                    </div>
                    <div>
                        <input type="checkbox" name="bahan_bakar[]" value="Listrik" /> <label>Listrik</label>
                    </div>
                </div>
            </div>

            <!-- Transmisi -->
            <div>
                <div class="px-[16px] py-[8px] border-b border-[#D1D5DB] font-bold">Transmisi</div>
                <div class="px-[16px] py-[16px] border-b border-[#D1D5DB]">
                    <div>
                        <input type="checkbox" name="transmisi[]" value="AT" /> <label>AT</label>
                    </div>
                    <div>
                        <input type="checkbox" name="transmisi[]" value="MT" /> <label>MT</label>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-2 gap-3 p-[16px] pb-[24px]">
            <button type="reset" class="h-[44px] bg-gray-200 rounded">Reset</button>
            <button type="submit" id="apply-filter" class="h-[44px] bg-[#EA5A00] text-white rounded">Terapkan</button>
        </div>
    </form>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {

        $('.price-checkbox').on('change', function () {
            if ($(this).is(':checked')) {
                $('.price-checkbox').not(this).prop('checked', false);
                const min = $(this).data('min') || '';
                const max = $(this).data('max') || '';
                $('#min_price').val(min);
                $('#max_price').val(max);
            } else {
                $('#min_price').val('');
                $('#max_price').val('');
            }
        });

        $('#min_price, #max_price').on('input', function () {
            $('.price-checkbox').prop('checked', false);
        });

        $('#filter-form').on('submit', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            const searchTerm = $('#search-bar').val();
            formData = formData + '&s=' + encodeURIComponent(searchTerm);
            var encodedData = btoa(formData);
            var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?query=' + encodedData;
            window.history.pushState({ path: newUrl }, '', newUrl);

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'get_products',
                    data: encodedData,
                },
                success: function (response) {
                    $('#products').html(response);
                    page = 0;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.error("AJAX request failed:", xhr.status, thrownError);
                    alert('An error occurred during the request. Please try again later.');
                }
            });
        });

        $('button[type="reset"]').on('click', function () {
            $('#filter-form')[0].reset();
        });
    });  
</script>