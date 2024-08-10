@extends('layouts.dashboard')
@section('title', 'List Buku')
@section('content')

    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="justify-content: flex-end">
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Konten modal akan diisi oleh AJAX -->
                    <div id="modalContent">
                        <!-- Form tambah buku akan dimuat di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" data-url="{{ route('inputBuku') }}" data-target="#modalContent" id="tambahBuku"
                   class="btn btn-primary btn-round">Tambah Data Buku</a>
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
                                        <td class="text-start">{{ $data->firstItem() + $index }}</td>
                                        <th scope="row">
                                            {{ $item->judul_buku}}
                                        </th>
                                        <td class="text-start">{{ $item->penulis }}</td>
                                        <td class="text-start">{{ $item->penerbit }}</td>
                                        <td class="text-start">{{ $item->tahun_terbit }}</td>
                                        <td class="text-start">{{ $item->stock }}</td>
                                        <td class="text-start d-flex column-gap-1">

                                            <a href="{{ route('historyBuku', $item->id) }}">
                                                <button class="btn btn-secondary w500">
                                                      <span class="btn-label">
                                                        <i class="fas fa-bars"></i>
                                                      </span>
                                                </button>
                                            </a>


                                            <button class="btn btn-info w500" id="book-history"
                                                    data-id="{{ $item->id }}" data-target="#modalContent">
                                                      <span class="btn-label">
                                                        <i class="fas fa-bars"></i>
                                                      </span>
                                            </button>

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

    <script>
        $(document).ready(function () {
            $('#tambahBuku').click(function (e) {
                e.preventDefault();

                var urlRoute = $(this).data('url');

                $.ajax({
                    url: urlRoute,
                    method: 'GET',
                    success: function (responses) {
                        $('#modalContent').html(responses);
                        $('#detailModal').modal('show');
                    },
                    error: function (response) {
                        return "Error";
                    }
                })
            })
        })

    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#book-history', function () {
                var idBuku = $(this).data('id');

                $.ajax({
                    url: '/history-buku/' + idBuku,
                    method: 'GET',
                    success: function (response) {
                        $('#modalContent').html(response);
                        $('#detailModal').modal('show');
                    },
                    error: function (response) {
                        return "Error";
                    }
                });
            });
        });
    </script>
    <script>
        $("#closeModal").click(function () {
            $('#detailModal').modal('hide');
        })
    </script>
@endsection

@section('footer')

@endsection
