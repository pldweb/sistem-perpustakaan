@extends('layouts.dashboard')

@section('title', 'List Buku')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }} <span style="text-decoration: underline">{{ $judulBuku }}</span>
                </h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-  0">
                <a href="{{ route('InputBuku') }}" class="btn btn-primary btn-round">Tambah Data Buku</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title"> {{ $subtitle }} </h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table table align-items-center mb-0 table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tenggat Pengembalian</th>
                                    <th>Tanggal Dikembalikan</th>
                                    <th>Jumlah Buku Dikembalikan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_peminjam  }}</td>
                                        <td><span class="badge badge-warning">{{ $item->tanggal_pinjam }}</span></td>
                                        <td><span
                                                class="badge badge-secondary">{{ $item->tanggal_pengembalian_peminjaman }}</span>
                                        </td>
                                        <td>
                                            @if($item->tanggal_pengembalian_pengembalian === null)
                                                <span class="badge badge-danger">Belum Dikembalikan</span>
                                            @else
                                                <span
                                                    class="badge badge-info">{{ $item->tanggal_pengembalian_pengembalian }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->jumlah_pengembalian === null)
                                                <span class="badge badge-danger">Belum Dikembalikan</span>
                                            @else
                                                {{ $item->jumlah_pengembalian }} buku
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="py-2 px-3">

                                {{--                      {{ $data->links() }}--}}

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
