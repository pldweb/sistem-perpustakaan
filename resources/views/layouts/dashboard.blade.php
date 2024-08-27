<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sistem Perpustakaan - @yield('title')</title>

    <link rel="icon" href={{ Storage::disk('s3')->url("uploads/img/Fav.png") }} type="image/x-icon"/>

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ Storage::disk('s3')->url('uploads/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ Storage::disk('s3')->url('uploads/css/plugins.min.css') }} "/>
    <link rel="stylesheet" href="{{ Storage::disk('s3')->url('uploads/css/kaiadmin.min.css') }} "/>
{{--    <link rel="stylesheet" href="{{ Storage::disk('s3')->url('uploads/css/style.css') }} "/>--}}

    <link rel="stylesheet" href="{{ Storage::disk('s3')->url('uploads/css/style.css')  }}">
    {{-- Jquery --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    @stack('styles')

</head>
<body>


<div class="wrapper">

    <x-sidebar/>

    <div class="main-panel">

        <x-navbar/>

        <div class="container">
            @yield('content')


        </div>

    </div>

</div>

<!--   Core JS Files   -->
<script>
    $("#closeModal").click(function () {
        $('#detailModal').modal('hide');
        $('#modalKonfirmasi').modal('hide');
    })
</script>

<script src="{{ Storage::disk('s3')->url("uploads/js/core/jquery-3.7.1.min.js") }}"></script>
<script src="{{ Storage::disk('s3')->url("uploads/js/core/popper.min.js") }}"></script>
<script src="{{ Storage::disk('s3')->url("uploads/js/core/bootstrap.min.js") }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ Storage::disk('s3')->url("uploads/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js") }}"></script>

<!-- Chart JS -->
<script src="{{ Storage::disk('s3')->url("uploads/js/plugin/chart.js/chart.min.js") }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ Storage::disk('s3')->url('uploads/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ Storage::disk('s3')->url("uploads/js/plugin/chart-circle/circles.min.js") }}"></script>

<!-- Datatables -->
<script src="{{ Storage::disk('s3')->url("uploads/js/plugin/datatables/datatables.min.js") }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ Storage::disk('s3')->url("uploads/js/plugin/bootstrap-notify/bootstrap-notify.min.js") }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ Storage::disk('s3')->url('uploads/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ Storage::disk('s3')->url('uploads/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ Storage::disk('s3')->url('uploads/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ Storage::disk('s3')->url('uploads/js/kaiadmin.min.js') }}"></script>

<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>


</body>
</html>
