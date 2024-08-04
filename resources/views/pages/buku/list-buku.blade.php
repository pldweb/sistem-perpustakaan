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
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-start">No</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col" class="text-start">Penulis</th>
                                    <th scope="col" class="text-start">Penerbit</th>
                                    <th scope="col" class="text-start">Tahun Terbit</th>
                                    <th scope="col" class="text-start">Stock Buku</th>
                                    <th scope="col" class="text-start">Opsi</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $index => $item)

                                    <tr>
                                        <td scope="text-start">{{ $data->firstItem() + $index }}</td>
                                        <th scope="row">
                                            {{ $item->judul_buku}}
                                        </th>
                                        <td class="text-start">{{ $item->penulis }}</td>
                                        <td class="text-start">{{ $item->penerbit }}</td>
                                        <td class="text-start">{{ $item->tahun_terbit }}</td>
                                        <td class="text-start">{{ $item->stock }}</td>
                                        <td class="text-start d-flex column-gap-1">

                                            <a href="{{ route('EditBuku', $item->id) }}">
                                                <button class="btn btn-warning w500">
                                                      <span class="btn-label">
                                                        <i class="fas fa-bars"></i>
                                                      </span>
                                                </button>
                                            </a>
                                            <form action="{{ route('destroyBuku', $item->id) }}" method="post"
                                                  onsubmit="return confirm('yakin?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger w500">
                                <span class="btn-label">
                                  <i class="fas fa-times"></i>
                                </span>
                                                </button>
                                            </form>

                                        </td>

                                @endforeach

                                </tbody>

                            </table>
                            <div class="py-2 px-3">

                                {{ $data->links() }}

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
