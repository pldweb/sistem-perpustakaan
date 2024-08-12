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
                <a href="{{ route('inputUser') }}" class="btn btn-primary btn-round">Tambah Data User</a>
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
                                    <th scope="col" class="text-start">No</th>
                                    <th scope="col" class="text-start">Nama User</th>
                                    <th scope="col" class="text-start">Email</th>
                                    <th scope="col" class="text-start">Role</th>
                                    <th scope="col" class="text-start">Opsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $index => $detail)
                                    <tr>
                                        <td class="text-start">{{ $users->firstItem() + $index }}</td>
                                        <td class="text-start">
                                            {{ $detail->nama}}
                                        </td>
                                        <td class="text-start">{{ $detail->email }}</td>
                                        <td class="text-start"
                                            style="text-transform: uppercase">{{ $detail->role }}</td>
                                        <td class="text-start d-flex column-gap-1">
                                            <a href="{{ route('editUser', $detail->id) }}">
                                                <button class="btn btn-warning">
                                                  <span class="btn-label">
                                                    <i class="fas fa-bars"></i>
                                                  </span>
                                                </button>
                                            </a>
                                            <form action="{{ route('destroyUser', $detail->id)}}" method="post"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
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
                                {{ $users->links() }}
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
