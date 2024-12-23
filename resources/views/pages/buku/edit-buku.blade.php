@extends('layouts.dashboard')

@section('title', 'Input Buku')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
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
                    @if (session('success'))
                        <script>
                            $(document).ready(function () {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: '{{ session('success') }}',
                                });
                            });
                        </script>
                    @endif
                    <div class="col-md-12">
                        <div class="card-body">
                            <form action="{{ route('updateBuku', $book->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="judul_buku" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" required
                                        value="{{ old('judul_buku', $book->judul_buku) }}">
                                    @error('judul_buku')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="penulis" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis" required
                                        value="{{ old('penulis', $book->penulis) }}">
                                    @error('penulis')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" required
                                        value="{{ old('penerbit', $book->penerbit) }}">
                                    @error('penerbit')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-3">

                                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                        <input type="number" class="form-control" id="year" name="tahun_terbit"
                                            min="1900" max="{{ date('Y') + 1 }}" required
                                            value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
                                        @error('tahun_terbit')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" required
                                            value="{{ old('stock', $book->stock) }}">
<<<<<<< HEAD

=======
>>>>>>> 535710eb97a268fed07afe9f498f861ad67bb07f
                                        @error('stock')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-25%"
                                        onclick="return confirm('apakah data yang dimasukkan sudah sesuai?')">Update
                                    Data Buku
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
