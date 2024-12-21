<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan - @yield('title')</title>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styling -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Jquery -->
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>

    @stack('styles')
</head>
<body>

@include('sweetalert::alert')

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

<!-- Script -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
