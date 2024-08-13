<div class="modal-body">
    <div>
        <h1>Input Data User Baru</h1>
    </div>
    <div class="card-body">
        <form id="simpanUser">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required
                       value="{{ old('nama') }}">
                @error('nama')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required
                       value="{{ old('email') }}">
                @error('email')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                       value="{{ old('password') }}">
                @error('name')
                <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>

{!! App\Helpers\CreateModalHelper::createModalHelper('simpanUser', 'modalKonfirmasi', 'detailModal', 'cancelSubmit', 'confirmSubmit', 'simpan-user') !!}
