@extends('layouts.dashboard')

@section('title', 'Input Data User')

@section('content')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('inputUser') }}" class="btn btn-primary btn-round">Tambah User Baru</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{ $subtitle }}</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">

                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">

                                <thead class="thead-light">

                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('simpanUser') }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required
                                           value="{{ old('nama') }}">
                                    @error('nama')
                                    <span>{{ $message }}</span>
                                     @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required
                                           value="{{ old('password') }}">
                                    @error('name')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100"
                                        onclick="return confirm('Apakah data yang dimasukkan sudah benar?')">Register
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

@endsection
