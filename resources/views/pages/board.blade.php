@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    @if(session('pesan'))
        <div class="alert alert-{{ session('pesanType') }}">
            {{ session('pesan') }}
        </div>
    @endif

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Sistem Perpustakaan Online</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('sendMail')  }}" class="btn btn-danger">Tes kirim email</a>
                <a href="{{ route('sendTelegram')  }}" class="btn btn-info">Tes kirim telegram</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Jumlah User</p>
                                    <h4 class="card-title">{{ $totalUsers }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Stock Buku</p>
                                    <h4 class="card-title">{{ $totalStock }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Buku Terpinjam</p>
                                    <h4 class="card-title">{{ $bookPinjam }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Peminjam</p>
                                    <h4 class="card-title">{{ $totalPeminjam }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card card-round">
              <div class="card-body">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Peminjam terbaru</div>
                </div>
                <div class="card-list" style="padding-bottom: 0;">
                      @foreach($peminjamanTerbaru as $peminjaman)
                        <div class="item-list">
                            <div class="avatar">
                                @if(!empty($peminjaman->photo))
                                    <img src="{{ $peminjaman->photo }}" alt="..." class="avatar-img rounded-circle"/>
                                @else
                                    <img src="{{ Storage::disk('s3')->url('uploads/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle"/>
                                @endif
                            </div>
                            <div class="info-user ms-3">
                                <div class="username">{{ $peminjaman->nama}}</div>
                                <div class="status">{{ $peminjaman->tanggal_pinjam }}</div>
                                <div class="status">{{ $peminjaman->jumlah }}</div>
                            </div>
                            <a href="{{ route('detailPinjam', ['tanggal_pinjam' => $peminjaman->tanggal_pinjam, 'id' => $peminjaman->id]) }}" class="btn btn-icon btn-link op-8 me-1">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                      @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Data Buku Dipinjam</div>
                </div>
              </div>
              <div class="card-body pb-2">
                  <div id="container" style="width:100%; height:400px;">
                  </div>
                  <script>
                      $(document).ready(function () {
                          $.ajax({
                              url : '/peminjaman-perbulan',
                              method : 'GET',
                              dataType : 'json',
                              success : function (dataPeminjaman) {

                                  var tanggal = [];
                                  var peminjamanBuku = [];
                                  var pengembalianBuku = [];

                                  console.log(dataPeminjaman)
                                  if (dataPeminjaman.length > 0){
                                      dataPeminjaman.forEach(function (data){
                                          tanggal.push(data.tanggal);
                                          peminjamanBuku.push(parseInt(data.total_peminjaman));  // Default ke 0 jika undefined
                                          pengembalianBuku.push(parseInt(data.total_dikembalikan));

                                          console.log('Tanggal: ', data.tanggal, 'Peminjaman: ', data.total_peminjaman, 'Pengembalian: ', data.total_dikembalikan);

                                      })
                                  }

                                  // Rendering Highcharts
                                  Highcharts.chart('container', {
                                      chart: {
                                          type: 'line'
                                      },
                                      title: {
                                          text: 'Data peminjaman dan pengembalian buku bulan ini'
                                      },
                                      xAxis: {
                                          categories: tanggal
                                      },
                                      yAxis: {
                                          title: {
                                              text: 'Jumlah Buku'
                                          }
                                      },
                                      series: [
                                          {
                                              name: 'Peminjaman Buku',
                                              data: peminjamanBuku
                                          },
                                          {
                                              name: 'Pengembalian Buku',
                                              data: pengembalianBuku
                                          }
                                      ]
                                  });
                              },
                              error: function (response){
                                  return "Grafik tidak bisa ditampilkan";
                              }
                          })
                      })
                  </script>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">Users Geolocation</h4>
                        </div>
                        <p class="card-category">
                            Map of the distribution of users around the world
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('footer')

@endsection
