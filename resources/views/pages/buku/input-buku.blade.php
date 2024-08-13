<div class="modal-body">
    <div>
        <h1>Input Buku Baru</h1>
    </div>
    <form id="simpanBuku">
        @csrf
        <div class="mb-3">
            <label for="judul_buku" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" required
                   value="{{ old('judul_buku') }}">
            @error('judul_buku')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" required value="{{ old('penulis') }}">
            @error('penulis')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" required
                   value="{{ old('penerbit') }}">
            @error('penerbit')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="year" name="tahun_terbit" min="1900"
                       max="{{ date('Y') + 1 }}" required value="{{ old('tahun_terbit') }}">
                @error('tahun_terbit')
                <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required value="{{ old('stock') }}">
                @error('stock')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-25%">Simpan Data Buku</button>
    </form>
</div>

{!! App\Helpers\CreateModalHelper::createModalHelper('simpanBuku', 'modalKonfirmasi', 'detailModal', 'cancelSubmit', 'confirmSubmit', 'simpan-buku') !!}
