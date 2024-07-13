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

        $title = 'Data Peminjaman Buku';
        $slug = 'Form Data Peminjaman Buku';
        $subtitle = 'Detail Data Peminjaman Buku';
        
        $user = User::all();
        $books = Book::where('stock', '>', 0)->get();


        $pinjam = Pinjam::with('book', 'user')
        ->where('tanggal_pinjam', $tanggal_pinjam)
        ->where('user_id', $id)
        ->get();

        return view('pages.pinjam.detail_pinjam', compact('tanggal_pinjam','pinjam', 'slug', 'subtitle', 'id','title', 'user', 'books'));

    }


    public function UpdatePinjam(Request $request, $tanggal_pinjam, $id) {

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id.*' => 'required|exists:books,id',
            'jumlah.*' => 'required|integer|min:1|max:3',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam',
        ]);
    
        $pinjam = Pinjam::find($id);
    
        if(!$pinjam){
            return redirect()->route('ListPinjam')->withErrors(['Errors', 'Data tidak ditemukan']);
        }
    
        // Update peminjaman utama
        $pinjam->user_id = $validated['user_id'];
        $pinjam->tanggal_pinjam = $validated['tanggal_pinjam'];
        $pinjam->tanggal_pengembalian = $validated['tanggal_pengembalian'];
        $pinjam->save(); 
    
        // Update atau tambahkan buku peminjaman
        foreach ($request->book_id as $index => $bookId) {
            $jumlah = $request->jumlah[$index];
    
            // Update atau buat peminjaman buku
            $existingPinjam = Pinjam::where('user_id', $validated['user_id'])
                ->where('book_id', $bookId)
                ->first();
    
            if ($existingPinjam) {
                // Update jumlah buku
                $existingPinjam->jumlah = $jumlah;
                $existingPinjam->save();
            } else {
                // Buat peminjaman buku baru
                Pinjam::create([
                    'user_id' => $validated['user_id'],
                    'book_id' => $bookId,
                    'jumlah' => $jumlah,
                    'tanggal_pinjam' => $validated['tanggal_pinjam'],
                    'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
                ]);
            }
        }
    
        return redirect()->route('ListPinjam')->with('success', 'Data peminjaman berhasil diperbarui.');
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
