<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    // Menampilkan halaman list buku yang ada di perpustakaan
    public function ListBuku()
    {

        // Paginasi mencapai 10 data buku saja yang tampil
        $params = [
            'data' => Book::Paginate(10),
            'title' => "List Data Master Buku",
            'subtitle' => "Seluruh data master buku",
            'slug' => 'ini slug',
        ];
        return view('/pages/buku/list_buku', $params);

    }

    // Mengarahkan ke halaman input data buku baru
    public function InputBuku()
    {

        $params = [
            'title' => "Edit Data Master Buku",
            'subtitle' => "Form edit data buku",
            'slug' => 'ini slug'
        ];

        return view('/pages/buku/input_buku', $params);
    }

    // Controller untuk menangani request data buku yang baru ditambah
    public function SimpanBuku(Request $request)
    {

        $request->validate([
            'judul_buku' => ['required', 'string', 'max:100'],
            'penulis' => ['required', 'string', 'max:100'],
            'penerbit' => ['required', 'string', 'max:255',],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:2024'],
            'stock' => ['required', 'integer']

        ]);

        $data = [
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stock' => $request->stock,
            'stock_tersedia' => 0,
        ];

        Book::create($data);

        return redirect()->route('ListBuku')->with('success', 'Buku berhasil ditambahkan');

    }

    // Mengarahkan ke halaman edit buku dengan membawa data buku berdasarkan Id
    public function EditBuku($id)
    {

        $params = [
            'book' => Book::findOrFail($id),
            'title' => 'Edit Buku',
            'subtitle' => 'Dashboard',
            'slug' => 'ini slug',
        ];

        return view('/pages/buku/edit_buku', $params);

    }

    // Controller untuk menangani proses update data buku
    public function UpdateBuku(Request $request, $id)
    {

        $request->validate([
            'judul_buku' => ['required', 'string', 'max:100'],
            'penulis' => ['required', 'string', 'max:100'],
            'penerbit' => ['required', 'string', 'max:255',],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:2024'],
            'stock' => ['required', 'integer']

        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('ListBuku')->with('success', 'Buku berhasil diupdate');

    }

    // Controller untuk menghapus data buku berdasarkan Id
    public function destroyBuku($id)
    {

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('ListBuku')->with('success', 'Buku berhasil dihapus');

    }


    public function history($id)
    {

        $bookHistory = Book::with(['PeminjamanBuku.Peminjaman.user'])->findOrFail($id);

        return view('/pages/buku/history_buku', compact('bookHistory'));

    }


}
