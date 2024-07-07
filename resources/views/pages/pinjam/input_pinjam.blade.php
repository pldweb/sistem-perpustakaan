@extends('layouts.dashboard')

@section('title', 'Input Buku')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">{{ $title }}</h3>
            <h6 class="op-7 mb-2">List Buku Per Bulan</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">Buku Tersedia</h4>
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
                                  <select name="user_id" class="form-select form-control">
                                      @foreach ($users as $user)
                                          <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      
                          <div id="book-container">
                              <div class="row mb-3 book-row">
                                  <div class="col-6">
                                      <label for="books[0][book_id]" class="form-label">Buku</label>
                                      <select name="books[0][book_id]" class="form-select form-control book-select" data-index="0">
                                          @foreach ($books as $book)
                                              <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="col-6">
                                      <label for="books[0][jumlah]" class="form-label">Jumlah</label>
                                      <input type="number" name="books[0][jumlah]" class="form-control" min="1" max="3" required>
                                  </div>
                              </div>
                          </div>
                      
                          <button type="button" id="add-book" class="btn btn-secondary">Tambah Buku</button>
                      
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
                      
                          <button type="submit" class="btn btn-primary">Simpan Data Buku</button>
                      </form>
                      
                      <script>
                          let bookIndex = 1;
                          const bookData = @json($books);
                      
                          document.getElementById('add-book').addEventListener('click', function() {
                              addBookFields();
                              updateBookSelectOptions();
                              checkIfAllBooksSelected();
                          });
                      
                          document.addEventListener('change', function(event) {
                              if (event.target.classList.contains('book-select')) {
                                  updateBookSelectOptions();
                                  checkIfAllBooksSelected();
                              }
                          });
                      
                          function addBookFields() {
                              const container = document.getElementById('book-container');
                              
                              let options = '';
                              bookData.forEach(book => {
                                  options += `
                                  @foreach ($books as $book)
                                        <option value="{{$book->id}}">{{ $book->judul_buku}}</option>
                                  @endforeach`;
                                  
                              });
                      
                              const bookFields = `
                                  <div class="row mb-3 book-row">
                                      <div class="col-6">
                                          <label for="books[${bookIndex}][book_id]" class="form-label">Buku</label>
                                          <select name="books[${bookIndex}][book_id]" class="form-select form-control book-select" data-index="${bookIndex}">
                                              ${options}
                                          </select>
                                      </div>
                                      <div class="col-6">
                                          <label for="books[${bookIndex}][jumlah]" class="form-label">Jumlah</label>
                                          <input type="number" name="books[${bookIndex}][jumlah]" class="form-control" min="1" max="3" required>
                                      </div>
                                  </div>
                              `;
                      
                              container.insertAdjacentHTML('beforeend', bookFields);
                              bookIndex++;
                          }
                      
                          function updateBookSelectOptions() {
                              const selectedBooks = [];
                              document.querySelectorAll('.book-select').forEach(select => {
                                  const value = select.value;
                                  if (value) {
                                      selectedBooks.push(value);
                                  }
                              });
                      
                              document.querySelectorAll('.book-select').forEach(select => {
                                  const currentValue = select.value;
                                  select.innerHTML = '';
                                  bookData.forEach(book => {
                                      const option = document.createElement('option');
                                      option.value = book.id;
                                      option.textContent = book.judul_buku;
                                      if (selectedBooks.includes(book.id.toString()) && book.id.toString() !== currentValue) {
                                          option.disabled = true;
                                      }
                                      select.appendChild(option);
                                  });
                                  select.value = currentValue;
                              });
                          }
                      
                          function checkIfAllBooksSelected() {
                              const totalBooks = bookData.length;
                              const selectedBooks = document.querySelectorAll('.book-select').length;
                              const addButton = document.getElementById('add-book');
                      
                              if (selectedBooks >= totalBooks) {
                                  addButton.disabled = true;
                              } else {
                                  addButton.disabled = false;
                              }
                          }
                      
                          // Initial check
                          checkIfAllBooksSelected();
                      </script>
                      
                      
                      
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection
