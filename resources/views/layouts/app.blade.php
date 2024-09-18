<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan - @yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ Storage::disk('s3')->url('uploads/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href='{{ asset('./css/style.css') }}'>
    <script src="{{ Storage::disk('s3')->url('uploads/js/core/jquery-3.7.1.min.js') }}"></script>

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

<div class="container" style="background-image : url({{ Storage::disk('s3')->url("uploads/img/bg-login.jpg")}});
    max-width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center">
    @yield('content')
</div>

<footer>
    @yield('footer')
</footer>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="custom.js"></script>--}}

@yield('scripts')
</body>
</html>
