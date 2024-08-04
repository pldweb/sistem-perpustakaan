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


    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <h4 class="card-title">{{ $subtitle }}</h4>
                    </div>
                </div>
                <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Nama Peminjam</label>
                                <div class="data-field">{{ $peminjaman->nama_user }}</div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pinjam</label>
                                <div class="data-field"><span class="badge badge-primary">{{ $peminjaman->tanggal_pinjam }}</span></div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Tenggat Pengembalian</label>
                                <div class="data-field"><span class="badge badge-danger">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d-m-Y') }}</span></div>

                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pengembalian</label>
                                <div class="data-field"><span class="badge badge-secondary">{{ $peminjaman->status }}</span></div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Total Buku</label>
                                <div class="data-field">
                                        {{ $totalBuku }}
                                </div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Catatan</label>
                                <div class="data-field">
                                        {{ $peminjaman->catatan }}
                                </div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Buku Dipinjam</label>
                                <div class="data-field w-75">

                                    <form action="{{ route('storePengembalian', $peminjaman->id) }}" method="post">
                                        @csrf

                                        <div id="book-container">
                                            <div class="row mb-3 book-row d-flex flex-wrap row-gap-3">
                                                @foreach($peminjamanBuku as $index => $item)
                                                    <div class="col-6">
                                                        <label for="books[{{ $index }}][book_id]" class="form-label">Buku</label>
                                                        <select name="books[{{ $index }}][book_id]" class="form-select form-control book-select" data-index="{{ $index }}" required>
                                                            <option value="{{ $item->buku_id }}" selected>{{ $item->judul_buku }}</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="books[{{ $index }}][jumlah]" class="form-label">Jumlah</label>
                                                        <input type="number" name="books[{{ $index }}][jumlah]" class="form-control jumlah-buku" min="0" max="3" value="{{ $item->jumlah }}" required>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap">
                                            <div class="form-group col-6" style="padding-left: 0;">
                                                <label for="denda">Denda</label>
                                                <input type="string" name="denda" class="form-control" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                                <input type="date" name="tanggal_pengembalian" class="form-control" required>
                                            </div>
                                            <div class="form-group col-12" style="padding-left: 0;">
                                                <label for="catatan">Catatan</label>
                                                <textarea name="catatan" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data sudah benar?')">Kembalikan Buku</button>
                                    </form>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>


  </div>
</div>


@endsection

@section('footer')

@endsection
