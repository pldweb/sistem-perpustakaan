<!-- resources/views/peminjaman/preview.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Preview Peminjaman</title>
</head>
<body>

<h1>Preview Peminjaman Buku</h1>
<p>Nama: {{ $peminjaman->nama }}</p>
<p>Judul Buku: {{ $peminjaman->judul_buku }}</p>
<p>Tanggal Pinjam: {{ $peminjaman->tanggal_pinjam }}</p>

<!-- Tombol untuk Generate PDF -->
<a href="{{ url('/peminjaman/' . $peminjaman->id . '/generate-pdf') }}" class="btn btn-primary">Generate PDF</a>

</body>
</html>
