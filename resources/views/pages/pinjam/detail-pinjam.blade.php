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
                                <div class="data-field">{{ $dataPinjam->nama }}</div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pinjam</label>
                                <div class="data-field"><span
                                        class="badge badge-primary">{{ $dataPinjam->tanggal_pinjam }}</span></div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pengembalian</label>
                                <div class="data-field"><span
                                        class="badge badge-danger">{{ $dataPinjam->tanggal_pengembalian }}</span></div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Tanggal Pengembalian</label>
                                <div class="data-field">
                                    @if($dataPinjam->status === 'selesai')
                                        <span class="badge badge-success">{{ $dataPinjam->status }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $dataPinjam->status }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Total Buku</label>
                                <div class="data-field">{{ $totalBuku }}</div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Catatan</label>
                                <div class="data-field">{{ $dataPinjam->catatan }}</div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <label for="" class="form-label" style="width: 250px;">Buku Dipinjam</label>
                                <div class="data-field w-75">
                                    <table
                                        class="table table-bordered table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul Buku</th>
                                            <th>Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($detailBuku as $index => $item)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $item->judul_buku }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <a href="{{ route('editPinjam', [$dataPinjam->tanggal_pinjam, $dataPinjam->id] )}}" class="btn btn-warning">Edit
                                    Peminjaman</a>
                                <a href="{{ route('showPengembalian', $dataPinjam->id) }}" class="btn btn-primary"
                                   style="margin-left: 5px;">Pengembalian Buku</a>
                            </div>
                            <div class="mb-3 col-12 d-flex">
                                <table
                                    class="table table-bordered table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Buku dikembalikan</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pengembalian as $index => $item)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $item->judul_buku}}</td>
                                            <td>{{ $item->tanggal_pengembalian }}</td>
                                            <td>{{ $item->jumlah }}</td>
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

@endsection
