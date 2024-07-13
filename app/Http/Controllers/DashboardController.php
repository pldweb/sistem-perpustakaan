<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Pinjam;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
   

    public function Dashboard() {

        $user = User::all();
        $totalUsers = $user->count();

        $book = Book::all();
        $totalBooks = $book->count();

        $totalPeminjam = Pinjam::distinct('user_id')->count('user_id');

        $bookPinjam = Pinjam::sum('jumlah');
        
        $totalStock = Book::sum('stock');

        $title = 'Dashboard';
        $subtitle = 'Form Detail Peminjaman Buku';
        $slug = 'Ini untuk slug';

        return view('/pages/board', compact('title', 'totalUsers', 'totalBooks', 'bookPinjam', 'totalStock', 'totalPeminjam', 'subtitle', 'slug'));
    }

}
