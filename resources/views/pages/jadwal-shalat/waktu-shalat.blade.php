<p>Waktu Saat Ini: <span id="currentTime">{{ $currentTime }}</span> </p>
<p id="nextPrayer">Waktu sholat berikutnya: {{ $nextPrayer }}</p>
@if($timeToNextPrayerFormatted !== null)
    <p>Menuju waktu sholat <span id="nextPrayerTime">{{ $nextPrayer }}</span> dalam <span id="timeToNextPrayer">-{{ $timeToNextPrayerFormatted }}</span></p>
@endif

<script>
    function updateJadwalShalat() {
        $.ajax({
            url: '{{ route("jadwalShalatAjax") }}',
            method: 'GET',
            success: function(data) {
                $('#currentTime').text(data.currentTime);
                $('#nextPrayer').text('Waktu sholat berikutnya: ' + data.nextPrayer);
                $('#timeToNextPrayer').text('-' + data.timeToNextPrayerFormatted);
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    }

    $(document).ready(function() {
        setInterval(updateJadwalShalat, 1000);
    });
</script>
