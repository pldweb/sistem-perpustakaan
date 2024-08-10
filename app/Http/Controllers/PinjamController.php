<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    // Menampilkan halaman seluruh data peminjaman
    public function listPinjam()
    {

        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('peminjaman_buku', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->select(
                'peminjaman.*', // Mengambil semua kolom dari tabel peminjaman
                'users.nama', // Mengambil nama user
                DB::raw('SUM(peminjaman_buku.jumlah) as total_buku') // Menghitung total buku yang dipinjam
            )
            ->groupBy(
                'peminjaman.id',
                'users.nama',
                'peminjaman.user_id',
                'peminjaman.tanggal_pinjam',
                'peminjaman.tanggal_pengembalian',
                'peminjaman.catatan',
                'peminjaman.status'
            ) // Pastikan semua kolom dari peminjaman berada di dalam GROUP BY
            ->paginate(10);

        $totalBuku = $data->sum('jumlah');

        if (!$data) {
            return 'data tidak ditemukan';
        }

        $dataListPinjam = [
            'pinjam' => $data,
            'totalBuku' => $totalBuku,
            'title' => 'Data Peminjaman Buku',
            'subtitle' => 'List Data Peminjaman Buku',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.pinjam.list-pinjam', $dataListPinjam);
    }

    // Menampilkan halaman Detail Peminjaman Buku
    public function detailPinjam($tanggal_pinjam, $id)
    {
        // Ambil data peminjaman berdasarkan ID, beserta relasinya
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('peminjaman_buku', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->join('books', 'peminjaman_buku.buku_id', '=', 'books.id')
            ->select(
                'peminjaman.id',
                'peminjaman.tanggal_pinjam',
                'peminjaman.tanggal_pengembalian',
                'peminjaman.catatan',
                'peminjaman.status',
                'users.nama',
                'books.judul_buku',
                DB::raw('SUM(peminjaman_buku.jumlah) as total_buku')
            )
            ->where('peminjaman.id', $id)
            ->groupBy(
                'peminjaman.id',
                'peminjaman.tanggal_pinjam',
                'peminjaman.tanggal_pengembalian',
                'peminjaman.catatan',
                'peminjaman.status',
                'users.nama',
                'books.judul_buku'
            )
            ->first();

        if (!$data) {
            return 'Data tidak ditemukan';
        }

        // Ambil detail buku yang dipinjam
        $detailBuku = DB::table('peminjaman_buku')
            ->join('books', 'peminjaman_buku.buku_id', '=', 'books.id')
            ->select('books.judul_buku', 'peminjaman_buku.jumlah')
            ->where('peminjaman_buku.peminjaman_id', $id)
            ->get(); // Dapatkan daftar buku yang dipinjam

        if (!$detailBuku) {
            return 'Data tidak ditemukan';
        }

        // Hitung total buku yang dipinjam
        $totalBuku = $detailBuku->sum('jumlah');

        // Ambil detail pengembalian buku dengan judul buku dan jumlah
        $pengembalian = DB::table('detail_pengembalian')
            ->join('pengembalian', 'detail_pengembalian.pengembalian_id', '=', 'pengembalian.id')
            ->join('books', 'detail_pengembalian.buku_id', '=', 'books.id')
            ->where('pengembalian.peminjaman_id', $id)
            ->select('books.judul_buku', 'pengembalian.tanggal_pengembalian', 'detail_pengembalian.jumlah')
            ->get();

        $dataDetailPinjam = [
            'dataPinjam' => $data,
            'detailBuku' => $detailBuku,
            'totalBuku' => $totalBuku,
            'pengembalian' => $pengembalian,
            'title' => 'Data Peminjaman Buku',
            'slug' => 'Form Data Peminjaman Buku',
            'subtitle' => 'Detail Data Peminjaman Buku',
        ];

        return view('pages.pinjam.detail-pinjam', $dataDetailPinjam);

    }

    // Update Detail Peminjaman Buku
    public function updatePinjam(Request $request, $tanggal_pinjam, $id)
    {

        $tanggalPinjam = $request->input('tanggal_pinjam');
        if (strlen(strval($tanggalPinjam)) == 0) {
            return 'tanggal pinjam tidak valid';
        }

        $tanggalPengembalian = $request->input('tanggal_pengembalian');
        if (strlen(strval($tanggalPengembalian)) == 0) {
            return 'tanggal pengembalian tidak valid';
        }

        if (strtotime($tanggalPinjam) > strtotime($tanggalPengembalian)) {
            return 'tanggal pinjam harus lebih awal daripada tanggal kembali';
        }

        $books = $request->input('books', []);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id.*' => 'required|exists:books,id',
            'jumlah.*' => 'required|integer|min:1|max:3',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam',
        ]);

        $pinjam = Peminjaman::find($id);

        if (!$pinjam) {
            return redirect()->route('ListPinjam');
        }

        // Update peminjaman utama
        $pinjam->user_id = $validated['user_id'];
        $pinjam->tanggal_pinjam = $validated['tanggal_pinjam'];
        $pinjam->tanggal_pengembalian = $validated['tanggal_pengembalian'];
        $pinjam->save();

        // Update atau tambahkan buku peminjaman
        foreach ($request->book_id as $index => $bookId) {
            $jumlah = $request->jumlah[$index];

            // Update atau buat peminjaman buku
            $existingPinjam = Peminjaman::where('user_id', $validated['user_id'])
                ->where('book_id', $bookId)
                ->first();

            if ($existingPinjam) {
                // Update jumlah buku
                $existingPinjam->jumlah = $jumlah;
                $existingPinjam->save();
            } else {
                // Buat peminjaman buku baru
                Peminjaman::create([
                    'user_id' => $validated['user_id'],
                    'book_id' => $bookId,
                    'jumlah' => $jumlah,
                    'tanggal_pinjam' => $validated['tanggal_pinjam'],
                    'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
                ]);
            }
        }

        return redirect()->route('ListPinjam');
    }


    // Mengarahkan ke halaman form Pinjam Buku
    public function pinjamBuku()
    {

        $data = [
            'books' => Book::where('stock', '>', 0)->get(),
            'users' => User::all(),
            'title' => 'Input Data Peminjaman',
            'subtitle' => 'Form Peminjaman Buku',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.pinjam.input-pinjam', $data);
    }


    // Controller menangani request input data peminjaman buku
    public function store(Request $request)
    {
        $tanggalPinjam = $request->input('tanggal_pinjam');
        if (strlen(strval($tanggalPinjam)) == 0) {
            return 'tanggal pinjam tidak valid';
        }

        $tanggalPengembalian = $request->input('tanggal_pengembalian');
        if (strlen(strval($tanggalPengembalian)) == 0) {
            return 'tanggal pengembalian tidak valid';
        }

        if (strtotime($tanggalPinjam) > strtotime($tanggalPengembalian)) {
            return 'tanggal pinjam harus lebih awal daripada tanggal kembali';
        }

        $catatan = $request->input('catatan');
        if (strlen(strval($catatan)) < 1) {
            $catatan = '';
        }

        $books = $request->input('books', []);

        // Periksa ketersediaan stok buku
        foreach ($books as $bookData) {
            $book = Book::find($bookData['book_id']);
            if ($book->stock < $bookData['jumlah']) {
                return 'Stock buku tidak cukup';
            }
        }

        DB::beginTransaction();
        try {
            // Buat data peminjaman terlebih dahulu
            $peminjaman = Peminjaman::create([
                'user_id' => $request->user_id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_pengembalian' => $tanggalPengembalian,
                'catatan' => $catatan,
            ]);

            // Jika masih ada stock, kurangi stok buku dan simpan data peminjaman buku
            foreach ($books as $bookData) {
                $book = Book::find($bookData['book_id']);
                $book->stock -= $bookData['jumlah'];
                $book->save();

                // Simpan data peminjaman buku
                PeminjamanBuku::create([
                    'peminjaman_id' => $peminjaman->id, // Menggunakan ID dari peminjaman yang baru dibuat
                    'buku_id' => $bookData['book_id'],
                    'jumlah' => $bookData['jumlah'],
                ]);
            }

            DB::commit();
            return redirect()->route('ListPinjam');
        } catch (\Exception $exception) {
            DB::rollBack();
            return 'data gagal disimpan';
        }
    }

    // Hapus data peminjaman berdasarkan tanggal pinjam dan Id
    public function destroy($tanggal_pinjam, $id)
    {

        $pinjam = Peminjaman::where('id', $id)
            ->where('tanggal_pinjam', $tanggal_pinjam)
            ->firstOrFail();

        if (!$pinjam) {
            return 'Data tidak ditemukan jadi tidak bisa dihapus';
        }

        DB::beginTransaction();
        try {

            // Mengembalikan stok buku yang dipinjam
            foreach ($pinjam->peminjamanBuku as $peminjamanBuku) {
                $book = $peminjamanBuku->buku;
                $book->stock += $peminjamanBuku->jumlah;
                $book->save();
            }

            // Hapus data peminjaman buku terkait
            $pinjam->peminjamanBuku()->delete();

            // Hapus data peminjaman
            $pinjam->delete();

            DB::commit();

//            Alert::success('Success', 'Pengembalian berhasil diproses');

            return redirect()->route('ListPinjam');

        } catch (\Exception $exception) {
            DB::rollBack();
            return 'Data tidak tidak bisa dihapus';
        }
    }
}
