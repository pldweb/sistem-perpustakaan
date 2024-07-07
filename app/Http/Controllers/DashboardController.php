<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
   

    public function Dashboard() {

        $user = User::all();
        $totalUsers = $user->count();

        $book = Book::all();
        $totalBooks = $book->count();



        $title = 'Dashboard';
        return view('/pages/board', compact('title', 'totalUsers', 'totalBooks'));
    }

}
