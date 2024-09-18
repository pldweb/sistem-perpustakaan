@extends('layouts.app')

@section('title', 'Login')

@section('styles')

@endsection

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <div id="result-login"></div>
                        <form id="form-login" onsubmit="return false;">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    @ name="email" required value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">Jika belum punya akun bisa <a href="{{ route('formRegistrasi')}}"
                                                                            rel="noopener noreferrer">Daftar</a></div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#form-login').submit(function () {
                $.ajax({
                    url: '{{route('login')}}',
                    type: 'POST',
                    data: {
                        email: $('input[name=email]').val(),
                        password: $('input[name=password]').val(),
                    },
                    success: function (response) {
                        $('#result-login').html(response);
                    },
                    error: function (response) {
                        alert('hahaha');
                    }
                });
            });
        });
    </script>

@endsection

@push('scripts')

@endpush

