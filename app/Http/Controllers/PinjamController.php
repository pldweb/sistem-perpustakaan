<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function ListPinjam()
    {
        $title = 'Data Peminjam';
        $pinjam = Pinjam::with('book', 'user')->get();

        return view('pages.pinjam.list_pinjam', compact('title', 'pinjam'));
    }

    public function PinjamBuku()
    {
        $books = Book::where('stock', '>', 0)->get();
        $users = User::all();
        $title = 'Input Data Pinjaman';

        return view('pages.pinjam.input_pinjam', compact('books', 'users', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam'
        ]);

        $pinjam = new Pinjam();
        $pinjam->user_id = $request->user_id;
        $pinjam->book_id = $request->book_id;
        $pinjam->tanggal_pinjam = $request->tanggal_pinjam;
        $pinjam->tanggal_pengembalian = $request->tanggal_pengembalian;
        $pinjam->save();

        $book = Book::find($request->book_id);
        $book->stock -= 1;
        $book->save();

        return redirect()->route('ListPinjam')->with('success', 'Berhasil pinjam buku');
    }
}
