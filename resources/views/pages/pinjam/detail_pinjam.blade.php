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
                                <div class="data-field">{{ $peminjaman->user->nama }}</div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pinjam</label>
                                <div class="data-field"><span class="badge badge-primary">{{ $peminjaman->tanggal_pinjam }}</span></div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pengembalian</label>
                                <div class="data-field"><span class="badge badge-danger">{{ $peminjaman->tanggal_pengembalian }}</span></div>

                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Total Buku</label>
                                <div class="data-field">
                                        {{ $peminjaman->peminjamanBuku->sum('jumlah') }}
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
                                    <table class="table table-bordered table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Judul Buku</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody> 

                                            @foreach ($peminjaman->peminjamanBuku as $item)                                            
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ $item->Buku->judul_buku }}</td>
                                                <td>{{ $item->jumlah}}</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>    
                                
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
