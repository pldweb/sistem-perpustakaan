<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function ListBuku() {

        $data = Book::Paginate(10);
        // $allBook = DB::table('books')->simplePaginate(8);
        $title = "List Buku";
        return view('/pages/buku/list_buku', compact('data', 'title'));

    }

    public function InputBuku() {
        return view('/pages/buku/input_buku', ['title' => 'Input Buku']);
    }

    public function SimpanBuku(Request $request) {

        $request->validate([
            'judul_buku' => ['required', 'string', 'max:100'],
            'penulis' => ['required', 'string', 'max:100'],
            'penerbit' => ['required', 'string', 'max:255',],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:2024'],
            'stock' => ['required','integer']
            
        ]);

        $data = [
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stock' => $request->stock,
        ];

        Book::create($data);

        return redirect()->route('ListBuku')->with('success', 'Buku berhasil ditambahkan');
        
    }

    public function EditBuku($id){

        $book = Book::findOrFail($id);
        $title = 'Edit Buku';

        return view('/pages/buku/edit_buku', compact('book', 'title'));

    }

    public function UpdateBuku(Request $request, $id){

            $request->validate([
                'judul_buku' => ['required', 'string', 'max:100'],
                'penulis' => ['required', 'string', 'max:100'],
                'penerbit' => ['required', 'string', 'max:255',],
                'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:2024'],
                'stock' => ['required','integer']
                
            ]);
    
            // $data = [
            //     'judul_buku' => $request->judul_buku,
            //     'penulis' => $request->penulis,
            //     'penerbit' => $request->penerbit,
            //     'tahun_terbit' => $request->tahun_terbit,
            //     'stock' => $request->stock,
            // ];
    
            // Book::where('id', $id)->update($data);

            $book = Book::findOrFail($id);
            $book->update($request->all());
    
            return redirect()->route('ListBuku')->with('success', 'Buku berhasil diupdate');


        }   

    public function destroyBuku($id) {

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('ListBuku')->with('success', 'Buku berhasil dihapus');



    }



}
