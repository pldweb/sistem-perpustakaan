<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\User;


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

}
