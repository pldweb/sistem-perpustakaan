@extends('layouts.dashboard')

@section('title', 'Input Buku')

@section('content')

        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">{{ $title }}</h3>
              <h6 class="op-7 mb-2">List Buku Per Bulan</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <a href="{{ route('InputBuku') }}" class="btn btn-primary btn-round">Tambah Buku</a>
            </div>
          </div>
         
         
          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Buku Tersedia</h4>
                    
                  </div>
                  <p class="card-category">
                    
                  </p>
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
