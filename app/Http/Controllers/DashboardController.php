<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function dashboard()
    {

        $user = User::all();
        $totalUsers = $user->count();
        $book = Book::all();
        $totalBooks = $book->count();
        $totalPeminjam = Peminjaman::distinct('user_id')->count('user_id');
        $bookPinjam = PeminjamanBuku::sum('jumlah');
        $totalStock = Book::sum('stock');

        $data = [

            'title' => 'Dashboard',
            'subtitle' => 'Form Detail Peminjaman Buku',
            'slug' => 'Ini untuk slug',
            'totalUsers' => $totalUsers,
            'totalBooks' => $totalBooks,
            'totalPeminjam' => $totalPeminjam,
            'totalStock' => $totalStock,
            'bookPinjam' => $bookPinjam,
        ];

        return view('pages.board', $data);
    }

    public function getPeminjamanPerbulan()
    {
        $peminjamanAwalBulan = Carbon::now()->startOfMonth()->toDateString();
        $peminjamanAkhirBulan = Carbon::now()->endOfMonth()->toDateString();

        // Ambil data peminjaman
        $dataPeminjaman = DB::table('peminjaman')
            ->join('peminjaman_buku', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->whereBetween('tanggal_pinjam', [$peminjamanAwalBulan, $peminjamanAkhirBulan])
            ->selectRaw('DATE(tanggal_pinjam) as tanggal, SUM(peminjaman_buku.jumlah) as total_peminjaman')
            ->groupBy('tanggal')
            ->get();

        // Ambil data pengembalian
        $dataPengembalian = DB::table('pengembalian')
            ->join('detail_pengembalian', 'pengembalian.id', '=', 'detail_pengembalian.pengembalian_id')
            ->whereBetween('tanggal_pengembalian', [$peminjamanAwalBulan, $peminjamanAkhirBulan])
            ->selectRaw('DATE(tanggal_pengembalian) as tanggal, SUM(detail_pengembalian.jumlah) as total_dikembalikan')
            ->groupBy('tanggal')
            ->get();

    $tanggalPeminjaman = $dataPeminjaman->pluck('tanggal')->toArray();

    // Menyiapkan data final
    $dataFinal = [];

    foreach ($tanggalPeminjaman as $tanggal) {
        $peminjaman = $dataPeminjaman->firstWhere('tanggal', $tanggal);
        $pengembalian = $dataPengembalian->firstWhere('tanggal', $tanggal);

        $dataFinal[] = [
            'tanggal' => $tanggal,
            'total_peminjaman' => $peminjaman ? $peminjaman->total_peminjaman : '0',
            'total_dikembalikan' => $pengembalian ? $pengembalian->total_dikembalikan : '0',
        ];
    }

        return response()->json($dataFinal);

//        dd($finalData);
    }



}
