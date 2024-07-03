<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function ListBuku() {
        return view('/pages/buku/list_buku', ['title' => 'List Buku']);
    }

    public function Dashboard() {
        return view('/pages/board', ['title' => 'Dashboard']);
    }

}
