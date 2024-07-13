@extends('layouts.dashboard')

@section('title', 'Input Buku')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">{{ $title }}</h3>
            <h6 class="op-7 mb-2">{{ $slug}}</h6>
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

                <div class="col-md-12">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('SimpanPinjamBuku') }}" method="post">
                            @csrf
                
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="user_id" class="form-label">Peminjam</label>
                                    <select name="user_id" class="form-select form-control" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div id="book-container">
                                <div class="row mb-3 book-row d-flex flex-wrap">
                                    <div class="col-6">
                                        <label for="books[0][book_id]" class="form-label">Buku</label>
                                        <select name="books[0][book_id]" class="form-select form-control book-select" data-index="0" required>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="books[0][jumlah]" class="form-label">Jumlah</label>
                                        <input type="number" name="books[0][jumlah]" class="form-control jumlah-buku" min="1" max="3" required>
                                        
                                    </div>
                                    <div class="book">

                                    </div>
                                    <div class="col-6">
                                    <button type="button" class="btn add-book btn-success mt-4">Tambah Buku</button>

                                    </div>
                                </div>
                            </div>
                
                
                            <div class="row mt-3">
                                <div class="mb-3 col-6">
                                    <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                    <input type="date" name="tanggal_pengembalian" class="form-control" required>
                                </div>
                            </div>
                
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data sudah benar?')">Simpan Data Buku</button>
                        </form>
                    </div>
                </div>
                <script>
                $(document).ready(function() {
                            let bookIndex = 0;
                            let books = @json($books);

                            function updateBookOptions() {
                                $('select[name^="books"][name$="[book_id]"]').each(function() {
                                    let selectedBooks = [];
                                    $('select[name^="books"][name$="[book_id]"]').each(function() {
                                        if ($(this).val()) {
                                            selectedBooks.push($(this).val());
                                        }
                                    });

                                    $(this).find('option').each(function() {
                                        if ($(this).val() && selectedBooks.includes($(this).val()) && $(this).parent().val() !== $(this).val()) {
                                            $(this).attr('disabled', true);
                                        } else {
                                            $(this).attr('disabled', false);
                                        }
                                    });
                                });
                            }

                            function updateBookIndices() {
                                $('.book-row').each(function(index) {
                                    $(this).find('select[name^="books"]').attr('name', `books[${index}][book_id]`);
                                    $(this).find('input[name^="books"]').attr('name', `books[${index}][jumlah]`);
                                });
                            }

                            $(document).on('change', 'select[name^="books"][name$="[book_id]"]', function() {
                                updateBookOptions();
                            });

                            $('.add-book').click(function() {
                                bookIndex++;
                                let newBookRow = `  
                                <div class="row mb-3 book-row mt-3">
                                    <div class="col-6">
                                        <label for="books[${bookIndex}][book_id]" class="form-label">Buku</label>
                                        <select name="books[${bookIndex}][book_id]" class="form-select form-control book-select" required>
                                            <option value="">Pilih buku</option>
                                            ${books.map(book => `<option value="${book.id}">${book.judul_buku}</option>`).join('')}
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="books[${bookIndex}][jumlah]" class="form-label">Jumlah</label>
                                        <div class="d-flex">
                                            <input type="number" name="books[${bookIndex}][jumlah]" class="form-control jumlah-buku" min="1" max="3" required>
                                            <button type="button" class="ml-3 btn-danger btn remove-book">X</button>
                                        </div>
                                    </div>
                                </div>
                                `;
                                $('.book').append(newBookRow);
                                updateBookOptions();
                            });

                            $(document).on('click', '.remove-book', function() {
                                $(this).closest('.book-row').remove();
                                updateBookIndices();
                                updateBookOptions();
                            });

                            $('form').on('submit', function(e) {
                                let isValid = true;
                                $(this).find('select[name^="books"][name$="[book_id]"]').each(function() {
                                    if (!$(this).val()) {
                                        isValid = false;
                                        return false;
                                    }
                                });
                                if (!isValid) {
                                    e.preventDefault();
                                    alert('Harap pilih buku untuk semua field.');
                                }
                            });

                            // Inisialisasi
                            updateBookOptions();
                        });
   
                </script>
                
                
                
                
                
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection
