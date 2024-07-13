@extends('layouts.dashboard')

@section('title', 'List User')

@section('content')

        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">{{ $title }}</h3>
              <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
              <a href="{{ route('InputUser') }}" class="btn btn-primary btn-round">Tambah User Baru</a>
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
                          <th scope="col" class="text-end">No</th>
                          <th scope="col" class="text-end">Nama User</th>
                          <th scope="col" class="text-end">Email</th>
                          <th scope="col" class="text-end">Kelas</th>
                          <th scope="col" class="text-end">Role</th>
                          <th scope="col" class="text-end">Opsi</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $detail)
                            
                        <tr>
                          <td class="text-end">{{ $loop->iteration }}</td>
                          <td class="text-end">
                            {{ $detail->nama}}
                          </td>
                          <td class="text-end">{{ $detail->email }}</td>
                          <td class="text-end">{{ $detail->kelas }}</td>
                          <td class="text-end" style="text-transform: uppercase">{{ $detail->role }}</td>
                          <td class="text-end">

                          <a href="{{ route('EditUser', $detail->id) }}">
                            
                            <button class="btn btn-warning">
                              <span class="btn-label">
                                <i class="fas fa-bars"></i>
                              </span>
                              Edit
                            </button>

                          </a>
                            
                            <form action="{{ route('DestroyUser', $detail->id)}}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                              @csrf
                              @method('delete')
                            <button type="submit" class="btn btn-danger">
                              <span class="btn-label">
                                <i class="fas fa-times"></i>
                              </span>
                              Hapus User
                            </button>
                            </form>

                        </td>

                        
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('footer')
    
@endsection
