@extends('layouts.dashboard')

@section('title', 'Detail Peminjaman')

@section('content')

<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
        <h6 class="op-7 mb-2">{{ $slug }}</h6>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        {{-- <a href="{{ route('PinjamBuku') }}" class="btn btn-primary btn-round">Tambah Pinjaman Buku</a> --}}
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
                        <select name="user_id" class="form-select form-control disabled" required>
                           
                                <option>{{ $peminjaman->user->nama }}</option>
                            
                        </select>
                    </div>
                </div>
    
                <div id="book-container">
                    <div class="row mb-3 book-row d-flex flex-wrap">
                        <div class="col-6">
                            <label for="books[0][book_id]" class="form-label">Buku</label>
                            <select name="books[0][book_id]" class="form-select form-control book-select" data-index="0" required>
                                
                                    <option value=""> {{ $peminjaman->tanggal_pinjam }}
                                    </option>
                                
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="books[0][jumlah]" class="form-label">Jumlah</label>
                            <input type="number" name="books[0][jumlah]" class="form-control jumlah-buku" min="1" max="3" required>
                            
                        </div>
                        <div class="book">

                        </div>
                        <div class="col-6">
                        {{-- <button type="button" class="btn add-book btn-success mt-4 disabled">Tambah Buku</button> --}}

                        </div>
                    </div>
                </div>
    
    
                <div class="row mt-3">
                    <div class="mb-3 col-6">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" required>
                        {{ $peminjaman->tanggal_pinjam }}
                    </div>
                    <div class="mb-3 col-6">
                        <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" name="tanggal_pengembalian" class="form-control" required>
                        {{ $peminjaman->tanggal_pengembalian }}
                    </div>
                    <div class="mb-3 col-12">
                        <label for="catatan" class="">Catatan</label>
                        <textarea class="form-control" id="comment" name="catatan" cols="3" rows="5">
                            {{ $peminjaman->catatan }}
                        </textarea>
                    </div>
                </div>
    
                <button type="submit" class="btn btn-primary disabled" onclick="return confirm('Apakah data sudah benar?')">Simpan Data Buku</button>
            </form>
        </div>
    </div>

  </div>
</div>


@endsection

@section('footer')

@endsection
