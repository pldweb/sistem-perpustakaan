<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\DetailPengembalian;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    public function detailPengembalian($id)
    {
        // Ambil Data Peminjaman berdasarkan ID
        $peminjaman = DB::table('peminjaman')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->where('peminjaman.id', $id)
            ->select('peminjaman.*', 'users.nama as nama_user')
            ->first();

        if (!$peminjaman) {
            return 'Data peminjaman tidak ditemukan';
        }

        // Ambil Data buku yang dipinjam
        $peminjamanBuku = DB::table('peminjaman_buku')
            ->join('books', 'books.id', '=', 'peminjaman_buku.buku_id')
            ->where('peminjaman_buku.peminjaman_id', $id)
            ->select('peminjaman_buku.*', 'books.judul_buku')
            ->get();

        if (!$peminjamanBuku) {
            return 'Data buku yang dipinjam tidak ditemukan';
        }

        // Hitung total buku yang dipinjam
        $totalBuku = $peminjamanBuku->sum('jumlah');


        $data = [

            'peminjaman' => $peminjaman,
            'peminjamanBuku' => $peminjamanBuku,
            'totalBuku' => $totalBuku,
            'title' => 'Data Peminjam',
            'subtitle' => 'List Data Peminjaman Buku',
            'slug' => 'Ini untuk slug',

        ];

        return view('pages.pinjam.detail-pengembalian', $data);

    }

    public function storePengembalian(Request $request, $id)
    {
        // Ambil data peminjaman
        $peminjaman = Peminjaman::findOrFail($id);

        if (!$peminjaman) {
            return 'data peminjaman tidak ditemukan';
        }

        // Ambil detail peminjaman buku
        $peminjamanBuku = PeminjamanBuku::where('peminjaman_id', $id)
            ->get();

        if ($peminjamanBuku->isEmpty()) {
            return 'data peminjaman buku tidak ditemukan';
        }

        $tanggalPengembalian = $request->input('tanggal_pengembalian');
        if (strlen(strval($tanggalPengembalian)) == 0) {
            return 'tanggal pengembalian tidak valid';
        }

        if (Carbon::parse($tanggalPengembalian)->isBefore(Carbon::today())) {
            Alert::error('Error', 'Tanggal Pengembalian Tidak Benar');
            return redirect()->back();
        }

        $catatanPengembalian = $request->input('catatan');
        if (strlen(strval($catatanPengembalian)) == 0) {
            return 'catatan pengembalian tidak valid';
        }

        $dendaPengembalian = $request->input('denda');
        if (strlen(strval($dendaPengembalian)) == 0) {
            return 'denda tidak valid';
        }

        // Memulai transaksi DB
        DB::beginTransaction();

        try {
            // Simpan data pengembalian
            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'denda' => $dendaPengembalian,
                'tanggal_pengembalian' => $tanggalPengembalian,
                'catatan' => $catatanPengembalian,
            ]);

            // Simpan data pengembalian buku dan update stok buku
            foreach ($request->input('books') as $bookData) {
                $detailPeminjamanBuku = $peminjamanBuku
                    ->where('buku_id', $bookData['book_id'])
                    ->first();

                if ($detailPeminjamanBuku) {
                    if ($bookData['jumlah'] > $detailPeminjamanBuku->jumlah) {
                        DB::rollBack();
                        return 'Jumlah buku yang dikembalikan melebihi jumlah yang dipinjam untuk buku ';
                    }

                    $book = Book::find($bookData['book_id']);
                    $book->stock += $bookData['jumlah'];
                    $book->save();

                    // Simpan detail pengembalian
                    DetailPengembalian::create([
                        'pengembalian_id' => $pengembalian->id,
                        'buku_id' => $bookData['book_id'],
                        'jumlah' => $bookData['jumlah'],
                        'catatan' => $catatanPengembalian,
                        'denda' => $dendaPengembalian,
                    ]);

//                    $peminjamanBukuAwal = PeminjamanBuku::where('peminjaman_id', $peminjaman->id)
//                        ->where('buku_id', $bookData['book_id'])
//                        ->first();
//
//                    $peminjamanBukuAwal->increment('jumlah_dikembalikan', $bookData['jumlah']);

                    // Kurangi jumlah buku yang dipinjam
                    $detailPeminjamanBuku->jumlah -= $bookData['jumlah'];
                    $detailPeminjamanBuku->save();
                }
            }

            // Periksa jika semua buku telah dikembalikan
            $allDone = $peminjamanBuku->every(function ($item) {
                return $item->jumlah <= 0;
            });

            // Perbarui status peminjaman jika semua buku telah dikembalikan
            if ($allDone) {
                $peminjaman->status = 'selesai';
                $peminjaman->save();
            }

            DB::commit();

            return redirect()->route('listPinjam');

        } catch (\Exception $exception) {
            DB::rollBack();
            return 'Ini Error: ' . $exception->getMessage();
        }
    }

    public function listPengembalian()
    {
        $pengembalianData = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('detail_pengembalian', 'pengembalian.id', '=', 'detail_pengembalian.pengembalian_id')
            ->select(
                'pengembalian.id as pengembalian_id',
                'users.nama as nama_peminjam',
                'pengembalian.tanggal_pengembalian',
                DB::raw('SUM(detail_pengembalian.jumlah) as total_buku')
            )
            ->groupBy('pengembalian.id', 'users.nama', 'pengembalian.tanggal_pengembalian')
            ->paginate(10);

        $dataPengembalian = [

            'pengembalianData' => $pengembalianData,
            'title' => "List Pengembalian Buku",
            'subtitle' => "Seluruh data pengembalian",
            'slug' => 'ini slug',
        ];

        return view('pages.pinjam.list-pengembalian', $dataPengembalian);
    }

    public function tableListPengembalian()
    {
        $pengembalianData = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('detail_pengembalian', 'pengembalian.id', '=', 'detail_pengembalian.pengembalian_id')
            ->select(
                'pengembalian.id as pengembalian_id',
                'users.nama as nama_peminjam',
                'pengembalian.tanggal_pengembalian',
                DB::raw('SUM(detail_pengembalian.jumlah) as total_buku')
            )
            ->groupBy('pengembalian.id', 'users.nama', 'pengembalian.tanggal_pengembalian')
            ->paginate(10);

        $dataPengembalian = [

            'pengembalianData' => $pengembalianData,
            'title' => "List Pengembalian Buku",
            'subtitle' => "Seluruh data pengembalian",
            'slug' => 'ini slug',
        ];

        return view('pages.pinjam.table.table-list-pengembalian', $dataPengembalian);
    }

    public function destroyPengembalian($id)
    {

    }

}
