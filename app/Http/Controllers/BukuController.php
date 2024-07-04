<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function ListBuku() {
        return view('/pages/buku/list_buku', ['title' => 'List Buku']);
    }


    public function InputBuku() {
        return view('/pages/buku/input_buku', ['title' => 'Input Buku']);
    }
}
