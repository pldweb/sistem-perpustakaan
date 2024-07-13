@extends('layouts.dashboard')

@section('title', 'List Buku')

@section('content')

        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">{{ $title }}</h3>
              <h6 class="op-7 mb-2">List Buku Per Bulan</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <a href="{{ route('PinjamBuku') }}" class="btn btn-primary btn-round">Tambah Pinjaman Buku</a>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">Data Pinjaman Buku</h4>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Nama Peminjam</th>
                          <th scope="col" class="text-end">Buku Terpinjam</th>
                          <th scope="col" class="text-end">Tanggal Terpinjam</th>
                          <th scope="col" class="text-end">Tanggal Pengembalian</th>
                          <th scope="col" class="text-end">Jumlah Buku</th>
                          <th scope="col" class="text-end">Opsi</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($pinjam as $item)
                            
                        <tr>
                          <th scope="row">
                            {{ $item->user->nama}}
                          </th>
                          <td class="text-end">{{ $item->book->judul_buku}}</td>
                          <td class="text-end">{{ $item->tanggal_pinjam }}</td>
                          <td class="text-end">{{ $item->tanggal_pengembalian}}</td>
                          <td class="text-end">{{ $item->jumlah}}</td>

                          <td class="text-end">

                            <button class="btn btn-warning w500">
                              <span class="btn-label">
                                <i class="fas fa-bars"></i>
                              </span>
                             
                            </button>
                            
                            <form action="{{ route('destroyPinjam', ['id' => $item->id]) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger w500">
                                <span class="btn-label">
                                  <i class="fas fa-times"></i>
                                </span>
                              </button>
                            </form>
                           

                          </button></td>

                        
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

    </div>


  </div>

@endsection

@section('footer')
    
@endsection
