<li class="list-group-item" id="shubuh">Subuh: {{ $jadwal['shubuh'] }}</li>
<li class="list-group-item" id="dzuhur">Zuhur: {{ $jadwal['dzuhur'] }}</li>
<li class="list-group-item" id="ashar">Ashar: {{ $jadwal['ashar'] }}</li>
<li class="list-group-item" id="maghrib">Maghrib: {{ $jadwal['maghrib'] }}</li>
<li class="list-group-item" id="isya">Isya: {{ $jadwal['isya'] }}</li>

<script>
    $(document).ready(function() {
        $('#dropdownMenu').on('click', '.lokasiTerpilih', function(e) {
            e.preventDefault();

            const locationId = $(this).data('location-id');
            const locationName = $(this).data('location-name');

            $('#dropdownMenuButton').text('Lokasi saat ini: ' + locationName);

            // Update jadwal sholat via AJAX
            $.ajax({
                url: '{{ route("jadwalShalatAjax") }}',
                method: 'GET',
                data: { locationId: locationId },
                success: function(data) {
                    console.log(data); // Log data untuk memeriksa struktur data
                    if (data.jadwal) {
                        $('#shubuh').text('Subuh: ' + data.jadwal.shubuh);
                        $('#dzuhur').text('Dzuhur: ' + data.jadwal.dzuhur);
                        $('#ashar').text('Ashar: ' + data.jadwal.ashar);
                        $('#maghrib').text('Maghrib: ' + data.jadwal.maghrib);
                        $('#isya').text('Isya: ' + data.jadwal.isya);
                    } else {
                        console.error('Data jadwal tidak ditemukan.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
    });
</script>
