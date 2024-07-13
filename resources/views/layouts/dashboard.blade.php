<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Perpustakaan - @yield('title')</title>

    <link
      rel="icon"
      href={{ asset("img/kaiadmin/favicon.ico") }}
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }} "/>
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }} "/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }} "/>


    {{-- Jquery --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    @stack('styles')

</head>
<body>


        <div class="wrapper">

         <x-sidebar />

        <div class="main-panel">
            
          <x-navbar />

              <div class="container">
                @yield('content')


            </div>
            
        </div>

    </div>


    <!--   Core JS Files   -->
    <script src="{{ asset("js/core/jquery-3.7.1.min.js") }}"></script>
    <script src="{{ asset("js/core/popper.min.js") }}" ></script>
    <script src="{{ asset("js/core/bootstrap.min.js") }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset( "js/plugin/jquery-scrollbar/jquery.scrollbar.min.js") }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset( "js/plugin/chart.js/chart.min.js") }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset( 'js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset( 'js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset( 'js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset( 'js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset( 'js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset( 'js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset( 'js/kaiadmin.min.js') }}"></script>

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