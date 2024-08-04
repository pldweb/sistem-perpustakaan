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
              <a href="{{ route('InputBuku') }}" class="btn btn-primary btn-round">Tambah User Baru</a>
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
                    <form action="{{ route('UpdateUser', $user->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required value="{{ old('nama', $user->nama) }}">
                            @error('nama')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required value="">
                            @error('password')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="role" class="form-label">Role</label>
                          <select name="role" class="form-select form-control" data-index="0" required>
                            @error('role')
                              <span>{{ $message }}</span>
                            @enderror
                              <option value="{{ $user->role }}">{{ $user->role }}</option>
                        </select>
                      </div>
                        <button type="submit" class="btn btn-primary w-100" onclick="return confirm('Apakah data yang dimasukkan sudah benar?')">Update Data User</button>
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
