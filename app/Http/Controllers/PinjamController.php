<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function ListPinjam() {
        $title = 'Data Peminjam';
        $pinjam = Pinjam::with('book', 'user')->get();
        
        return view('pages.pinjam.list_pinjam', compact('title', 'pinjam'));
    }

    public function PinjamBuku() {
        $books = Book::where('stock', '>', 0)->get();
        $users = User::all();
        $title = 'Input Data Pinjaman';

        return view('pages.pinjam.input_pinjam', compact('books', 'users', 'title'));
    }

    public function store(Request $request) {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.jumlah' => 'required|integer|max:3',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam',
        ]);
    
        // Periksa ketersediaan stok buku
        foreach ($request->books as $bookData) {
            $book = Book::find($bookData['book_id']);
            if ($book->stock < $bookData['jumlah']) {
                return redirect()->back()->withErrors(['books' => 'Stock tidak cukup untuk buku ' . $book->judul_buku]);
            }
        }
    
        // Kurangi stok buku dan simpan data peminjaman
        foreach ($request->books as $bookData) {
            $book = Book::find($bookData['book_id']);
            $book->stock -= $bookData['jumlah'];
            $book->save();
    
            // Simpan data peminjaman
            Pinjam::create([
                'user_id' => $request->user_id,
                'book_id' => $bookData['book_id'],
                'jumlah' => $bookData['jumlah'],
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
            ]);
        }
    
        return redirect()->route('ListPinjam');
    }
    
    


    public function destroy($id) {

        $pinjam = Pinjam::findOrFail($id);

        $book = $pinjam->book;
        $book->stock += $pinjam->jumlah;
        $book->save();

        $pinjam->delete();

        return redirect()->route('ListPinjam');

    }


    // public function detailPeminjaman() {

    //     // Validasi input
    // $validated = $request->validate([
    //     'user_id' => 'required|exists:users,id',
    //     'book_id' => 'required|exists:books,id',
    //     'jumlah' => 'required|integer|max:3',
    //     'tanggal_pinjam' => 'required|date',
    //     'tanggal_pengembalian' => 'required|date',
    // ]);

    // // Periksa ketersediaan stok buku
    // $book = Book::find($validated['book_id']);
    // if ($book->stock < $validated['jumlah']) {
    //     return redirect()->back()->withErrors(['jumlah' => 'Stock tidak cukup']);
    // }

    // // Kurangi stok buku
    // $book->stock -= $validated['jumlah'];
    // $book->save();

    // // Simpan data peminjaman
    // Pinjam::create($validated);

    // return redirect()->route('ListPinjam');

    // }



}
