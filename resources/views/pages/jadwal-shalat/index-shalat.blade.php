@extends('layouts.dashboard')

@section('title', 'Jadwal Sholat')

@section('content')

    <style>
        .main-panel>.container {
            overflow: auto;
        }
    </style>

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
{{--                <h3 class="fw-bold mb-3">{{ $title }}</h3>--}}
{{--                <h6 class="op-7 mb-2">{{ $slug }}</h6>--}}
            </div>
            <div class="ms-md-auto py-2 py-md-0">

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
{{--                            <h4 class="card-title">{{ $subtitle }}</h4>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container mt-5">
                            <form action="" method="GET">
{{--                                <input type="hidden" name="locationId" id="locationId" value="{{ $locationId }}">--}}
                                <div class="input-group mb-3">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Lokasi saat ini: {{ $selectedLocationName }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end w-25 px-2" aria-labelledby="dropdownMenuButton" id="dropdownMenu">
                                        <div class="d-flex">
                                            <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Cari lokasi..." id="searchInput" onkeyup="filterLocations()">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        @foreach($locations as $id => $lokasi)
                                            <li>
                                                <a class="dropdown-item lokasiTerpilih" href="#" data-location-id="{{ $id }}" data-location-name="{{ $lokasi }}">
                                                    {{ $lokasi }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>

                            <ul class="list-group mt-3">
                                @include('pages.jadwal-shalat.data-shalat')
                                <br>
                                @include('pages.jadwal-shalat.waktu-shalat')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ini buat Search --}}
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                const filterText = $(this).val().toLowerCase();

                $('#dropdownMenu .dropdown-item').each(function() {
                    const locationText = $(this).text().toLowerCase();
                    if (locationText.includes(filterText) || filterText === '') {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
            });
        });
    </script>


@endsection

@section('footer')

@endsection
