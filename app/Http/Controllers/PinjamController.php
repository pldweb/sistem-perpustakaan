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

    public function tableListPinjam()
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
            )
            ->orderBy('peminjaman.id', 'DESC')
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

        return view('pages.pinjam.table.table-list-pinjam', $dataListPinjam);

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

    public function editPinjam($tanggal_pinjam, $id)
    {
        $pinjamBuku = DB::table('peminjaman_buku')
            ->join('peminjaman', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->select('peminjaman_buku.buku_id', 'peminjaman_buku.jumlah', 'peminjaman.tanggal_pinjam', 'peminjaman.tanggal_pengembalian', 'peminjaman.catatan', 'peminjaman.id')
            ->where('peminjaman_buku.peminjaman_id', $id)
            ->first();

        $data = [
            'pinjam' => $pinjamBuku,
            'books' => Book::where('stock', '>', 0)->get(),
            'users' => User::all(),
            'title' => 'Input Data Peminjaman',
            'subtitle' => 'Form Peminjaman Buku',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.pinjam.edit-pinjam', $data);
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

        $catatan = $request->input('catatan', '');

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
            // Update data peminjaman
            $updatePeminjaman = [
                'user_id' => $request->user_id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_pengembalian' => $tanggalPengembalian,
                'catatan' => $catatan,
            ];

            Peminjaman::where('id', $id)->update($updatePeminjaman);

            // Update stok buku dan data peminjaman buku
            foreach ($books as $bookData) {
                $book = Book::findOrFail($bookData['book_id']);
                $peminjamanBuku = PeminjamanBuku::where('peminjaman_id', $id)
                    ->where('buku_id', $bookData['book_id'])
                    ->first();

                // Hitung selisih jumlah buku
                $selisihJumlah = $peminjamanBuku->jumlah - $bookData['jumlah'];

                // Update stok buku sesuai selisih
                $book->stock += $selisihJumlah;
                $book->save();

                // Update data peminjaman buku
                $peminjamanBuku->update([
                    'jumlah' => $bookData['jumlah'],
                ]);
            }

            DB::commit();
            return redirect()->route('listPinjam');
        } catch (\Exception $exception) {
            DB::rollBack();
            return 'data gagal disimpan';
        }
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
            return redirect()->route('listPinjam');
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

            return redirect()->route('listPinjam');

        } catch (\Exception $exception) {
            DB::rollBack();
            return 'Data tidak tidak bisa dihapus';
        }
    }
}
