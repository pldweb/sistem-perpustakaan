@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ $title }}</h3>
                <h6 class="op-7 mb-2">{{ $slug }}</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0 d-flex column-gap-1">
                <button id="scrapeButton" class="btn btn-primary">Start Scraping</button>
                <a href="{{ route('export') }}" class="btn btn-success">Download Excel</a>
                <form action="{{ route('scrape-delete') }}" method="post" onsubmit="return confirm('yakin?')"
                      style="width:max-content;">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">

                        Delete Seluruh Data

                    </button>
                </form>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>
            $('#scrapeButton').on('click', function () {
                $.ajax({
                    url: '/scrape',
                    method: 'GET',
                    success: function (response) {
                        $('#result').html('<div class="alert alert-success">' + response.message + '</div>');
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.status + ': ' + xhr.statusText;
                        $('#result').html('<div class="alert alert-danger">An error occurred while scraping: ' + errorMessage + '</div>');
                    }
                });
            });
        </script>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div id="result" class="mt-3"></div>
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-start">No</th>
                                    <th scope="col">Nama Travel</th>
                                    <th scope="col">Nomor Telepon</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $index => $item)

                                    <tr>
                                        <td scope="text-start">{{ $data->firstItem() + $index }}</td>
                                        <th scope="row">
                                            {{ $item->nama}}
                                        </th>
                                        <td class="text-start">{{ $item->nomor }}</td>

                                @endforeach

                                </tbody>

                            </table>
                            <div class="py-2 px-3">

                                {{ $data->links() }}

                            </div>
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
