<!DOCTYPE html>
<html>
<head>
    <title>My Laravel App - @yield('title')</title>
    @stack('styles')
</head>
<body>
    <header>
        <h1>My Laravel App</h1>
    </header>

    <nav>
        <!-- Navigation links -->
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2024 My Laravel App</p>
    </footer>

    @yield('scripts')
</body>
</html>
