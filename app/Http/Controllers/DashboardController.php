<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;


class DashboardController extends Controller
{


    public function Dashboard()
    {

        $user = User::all();
        $totalUsers = $user->count();

        $book = Book::all();
        $totalBooks = $book->count();


        $title = 'Dashboard';
        return view('/pages/board', compact('title', 'totalUsers', 'totalBooks'));
    }

}
