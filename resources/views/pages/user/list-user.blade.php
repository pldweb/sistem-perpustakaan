@extends('layouts.dashboard')

@section('title', 'List User')

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

    @include('pages.modal.modal-konfirmasi')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" data-url="{{ route('inputUser') }}" data-target="#modalContent" id="tambahUser" class="btn btn-primary btn-round">Tambah Data User</a>
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
                        <div class="table-responsive" id="table-responsive">
                            <!-- Projects table -->
                            @include('pages.user.table.table-list-user')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! App\Helpers\ShowModalHelper::showModal('tambahUser', 'modalContent', 'detailModal') !!}

    {!! App\Helpers\AjaxPaginationHelper::script('table-responsive', 'table-list-user?page=') !!}

@endsection

@section('footer')

@endsection
