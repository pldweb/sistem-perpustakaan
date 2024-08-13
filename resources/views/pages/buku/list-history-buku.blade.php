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
                        <div class="table-responsive" id="table-responsive">
                            <!-- Projects table -->
                            @include('pages.buku.table.table-list-history-buku')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! App\Helpers\AjaxPaginationHelper::script('table-responsive', '/table-list-history-buku?page=') !!}

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

{{-- Script History Masing-Masing Buku --}}
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

@endsection

@section('footer')

@endsection
