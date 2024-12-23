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

                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col" class="text-start">Tanggal Peminjaman</th>
                                <th scope="col" class="text-start">Tanggal Pengembalian</th>
                                <th scope="col" class="text-start">Total Buku</th>
                                <th scope="col" class="text-start">Opsi</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pinjam as $index => $item)

                                <tr>
                                    <th scope="row">{{ $pinjam->firstItem() + $index }}</th>
                                    <th scope="row">
                                        {{ $item->user->nama}}
                                    </th>
                                    <td class="text-start"><span
                                            class="badge badge-primary">{{ $item->tanggal_pengembalian }}</span></td>
                                    <td class="text-start"><span
                                            class="badge badge-danger">{{ $item->tanggal_pengembalian }}</span></td>


                                    <td class="text-start">
                                        {{ $item->peminjamanBuku->sum('jumlah')}}
                                    </td>


                                    <td class="text-start d-flex column-gap-1">

                                        <a href="{{ route('DetailPinjam', ['tanggal_pinjam' => $item->tanggal_pinjam, 'id' => $item->id]) }}">
                                            <button class="btn btn-warning w500">
                                <span class="btn-label">
                                  <i class="fas fa-bars"></i>
                                </span>
                                            </button>
                                        </a>

                                        <form
                                            action="{{ route('destroyPinjam', ['tanggal_pinjam' => $item->tanggal_pinjam, 'id' => $item->id]) }}"
                                            method="post"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger w500">
                                  <span class="btn-label">
                                    <i class="fas fa-times"></i>
                                  </span>
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <div class="py-2 px-3">

                            {{ $pinjam->links() }}

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('footer')

@endsection
