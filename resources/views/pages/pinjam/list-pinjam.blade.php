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
                        <div class="table-responsive" id="table-responsive">
                            <!-- Projects table -->
                            @include('pages.pinjam.table.table-list-pinjam')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! App\Helpers\AjaxPaginationHelper::script('table-responsive', '/table-list-pinjam?page=') !!}

@endsection

@section('footer')

@endsection
