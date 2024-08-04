@extends('layouts.dashboard')

@section('title', 'Input Buku')

@section('content')

        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">{{ $title }}</h3>
              <h6 class="op-7 mb-2">{{ $slug }}</h6>
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
                                <h4 class="card-title">Detail History Buku</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Pengembalian (Pengembalian)</th>
                                    <th>Denda</th>
                                    <th>Catatan Pengembalian</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($history as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->judul_buku }}</td>
                                        <td>{{ $item->tanggal_pinjam }}</td>
                                        <td>{{ $item->tanggal_pengembalian }}</td>
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ $item->tanggal_pengembalian_pengembalian }}</td>
                                        <td>{{ $item->denda }}</td>
                                        <td>{{ $item->catatan_pengembalian }}</td>
                                    </tr>
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

@endsection

@section('footer')

<script>
  $(document).ready(function(){
      $('#year').datepicker({
          changeYear: true,
          showButtonPanel: true,
          dateFormat: 'yy',
          onClose: function(dateText, inst) {
              var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
              $(this).val(year);
          }
      });

      $("#year").focus(function () {
          $(".ui-datepicker-month").hide();
          $(".ui-datepicker-calendar").hide();
      });
  });
</script>

@endsection
