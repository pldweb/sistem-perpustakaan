@extends('layouts.dashboard')

@section('title', 'List Buku')

@section('content')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('pinjamBuku') }}" class="btn btn-primary btn-round">Tambah Pinjaman Buku</a>
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
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Peminjam</th>
                                    <th scope="col" class="text-start">Tanggal Peminjaman</th>
                                    <th scope="col" class="text-start">Tenggat Pengembalian</th>
                                    <th scope="col" class="text-start">Status</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-center">Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pinjam as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index+1 }}</th>
                                        <th scope="row">
                                            {{ $item->nama}}
                                        </th>
                                        <td class="text-start"><span
                                                class="badge badge-primary">{{ $item->tanggal_pinjam }}</span></td>
                                        <td class="text-start"><span
                                                class="badge badge-danger">{{ $item->tanggal_pengembalian }}</span></td>
                                        <td class="text-start">
                                            @if($item->status === 'selesai')
                                                <span class="badge badge-success">{{ $item->status}}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $item->status}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $item->total_buku }} buku
                                        </td>
                                        <td class="text-start d-flex column-gap-1">
                                            <a href="{{ route('detailPinjam', ['tanggal_pinjam' => $item->tanggal_pinjam, 'id' => $item->id]) }}">
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
    </div>

@endsection

@section('footer')

@endsection
