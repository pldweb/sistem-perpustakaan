@extends('layouts.app')

@section('title', 'Daftar')

@section('styles')

    
@endsection

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Registration</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('daftar') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required value="{{ old('nama') }}">
                            @error('nama')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" required value="{{ old('kelas') }}" >
                            @error('kelas')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                            @error('email')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required value="{{ old('password') }}">
                            @error('name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">Jika sudah punya akun bisa <a href="{{ route('halamanLogin')}}" rel="noopener noreferrer">Login</a></div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush




   
