<!DOCTYPE html>
<html>
<head>
    <title>My Laravel App - @yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    @stack('styles')

</head>
<body>
    <header>
        @yield('header')
    </header>

    <nav>
        <!-- Navigation links -->
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        @yield('footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="custom.js"></script>

    @yield('scripts')
</body>
</html>
