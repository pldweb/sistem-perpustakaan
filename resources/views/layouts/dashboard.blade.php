<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sistem Perpustakaan - @yield('title')</title>

{{--    <link rel="icon" href={{ Storage::disk('s3')->url("uploads/img/Fav.png") }} type="image/x-icon"/>--}}

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Styling -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/kaiadmin.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Jquery -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
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

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('js/chart.min.js')}}"></script>
<script src="{{asset('js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('js/circles.min.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('js/jsvectormap.min.js')}}"></script>
<script src="{{asset('js/world.min.js')}}"></script>
<script src="{{asset('js/kaiadmin.min.js')}}"></script>

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

<!--   Core JS Files   -->
<script>
    $("#closeModal").click(function () {
        $('#detailModal').modal('hide');
        $('#modalKonfirmasi').modal('hide');
    })
</script>

</body>
</html>
