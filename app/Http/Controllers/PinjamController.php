<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Pinjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    // Menampilkan halaman seluruh data peminjaman
    public function ListPinjam() {

        $pinjam = Pinjam::with('book', 'user')
        ->select(DB::raw('user_id, tanggal_pinjam, MAX(tanggal_pengembalian) as tanggal_pengembalian, SUM(jumlah) as total_buku'))
        ->groupBy('user_id', 'tanggal_pinjam')
        ->orderBy('tanggal_pinjam', 'desc')
        ->get();


        $user = User::all();
        $title = 'Data Peminjam';
        $subtitle = 'Form Detail Peminjaman Buku';
        $slug = 'Ini untuk slug';
        
        return view('pages.pinjam.list_pinjam', compact('title', 'pinjam', 'slug', 'subtitle', 'user'));
    }

    public function DetailPinjam($tanggal_pinjam, $id) {

        $pinjam = Pinjam::with('user', 'book')
        ->where('tanggal_pinjam', $tanggal_pinjam)
        ->where('user_id', $id)
        ->get();

        return view('pages.pinjam.detail_pinjam', compact('pinjam','pinjam', 'slug', 'subtitle', 'id'));

    }

    // public function DetailPinjam($id) {


    //     $users = User::all();
    //     $books = Book::all();
    //     $pinjam = Pinjam::findOrFail($id);
    //     $title = 'Detail Peminjaman Buku';
    //     $subtitle = 'Form Detail Peminjaman Buku';
    //     $slug = 'Ini untuk slug';


    //     return view('pages.pinjam.detail_pinjam', compact('pinjam', 'title', 'users', 'books', 'subtitle', 'slug'));

    // }

    public function UpdatePinjam(Request $request, $id) {



    }


    // Mengarahkan ke halaman form pinjam buku
    public function PinjamBuku() {
        $books = Book::where('stock', '>', 0)->get();
        $users = User::all();
        $title = 'Input Data Peminjaman';
        $subtitle = 'Form Peminjaman Buku';
        $slug = 'Ini untuk slug';

        return view('pages.pinjam.input_pinjam', compact('books', 'users', 'title', 'slug', 'subtitle'));
    }

    // Controller menangani request input data peminjaman buku
    public function store(Request $request) {

        // Ini proses Validasi input
        $request->validate([
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
    
        // Jika masih ada stock, kurangi stok buku dan simpan data peminjaman
        foreach ($request->books as $bookData) {
            $book = Book::find($bookData['book_id']);
            $book->stock -= $bookData['jumlah'];
            $book->save();
    
        // Lakukan simpan data peminjaman
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

     // Hapus data peminjaman berdasarkan Id
     public function destroy($id) {

        $pinjam = Pinjam::findOrFail($id);

        $book = $pinjam->book;
        $book->stock += $pinjam->jumlah;
        $book->save();

        $pinjam->delete();

        return redirect()->route('ListPinjam');

    }




}
