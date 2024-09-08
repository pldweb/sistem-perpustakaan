<!-- resources/views/peminjaman/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman</title>
</head>
<body>

<h1>Bukti Peminjaman Buku</h1>
<p>Nama: {{ $peminjaman->nama }}</p>
<p>Judul Buku: {{ $peminjaman->judul_buku }}</p>
<p>Tanggal Pinjam: {{ $peminjaman->tanggal_pinjam }}</p>

<!-- Tambahkan informasi lainnya sesuai kebutuhan -->

</body>
</html>
