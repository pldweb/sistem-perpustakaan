@extends('layouts.dashboard')

@section('title', 'Detail Peminjaman')

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

                <div class="col-md-12">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('SimpanPinjamBuku') }}" method="post">
                            @csrf
                
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="user_id" class="form-label">Peminjam</label>
                                    <select name="user_id" class="form-select form-control" required>
                                            <option>{{ $user->nama }}</option>
                                    </select>
                                </div>
                            </div>
                
                            <div id="book-container">

                                @foreach ($pinjam as $book)
                                    
                                <div class="row mb-3 book-row">
                                    <div class="col-6">
                                        <label for="book_id" class="form-label">Buku</label>
                                        <select name="book_id" class="form-select form-control book-select" data-index="0" required>
                                                <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control jumlah-buku" value="{{ $pinjam->jumlah }}" min="1" max="3" required>
                                    </div>
                                </div>

                                @endforeach


                            </div>
                
                
                            <div class="row mt-3">
                                <div class="mb-3 col-6">
                                    <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $pinjam->tanggal_pinjam }}" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                    <input type="date" name="tanggal_pengembalian" class="form-control" value="{{ $pinjam->tanggal_pengembalian }}" required>
                                </div>
                            </div>
                
                            <button type="submit" class="btn btn-primary">Update Data Peminjaman Buku</button>
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