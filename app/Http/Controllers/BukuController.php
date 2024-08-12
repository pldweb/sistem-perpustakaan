<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // Menampilkan halaman list buku yang ada di perpustakaan
    public function listBuku()
    {

        // Paginasi mencapai 10 data buku saja yang tampil
        $params = [
            'data' => Book::paginate(10),
            'title' => "List Data Master Buku",
            'subtitle' => "Seluruh data master buku",
            'slug' => 'ini slug',
        ];
        return view('pages.buku.list-buku', $params);
    }

    public function tableListBuku(request $request){

        $params = [
            'data' => Book::paginate(10),
            'title' => "List Data Master Buku",
            'subtitle' => "Seluruh data master buku",
            'slug' => 'ini slug',
        ];

        if($request->ajax()){
            return view('pages.table.table-list-buku', $params);
        }

        return view('pages.buku.list-buku', $params);
    }

    // Mengarahkan ke halaman input data buku baru
    public function inputBuku()
    {
        $params = [

            'title' => "Edit Data Master Buku",
            'subtitle' => "Form edit data buku",
            'slug' => 'ini slug'
        ];
        return view('pages.buku.input-buku', $params);
    }

    // Controller untuk menangani request data buku yang baru ditambah
    public function simpanBuku(Request $request)
    {
        $judulBuku = $request->input('judul_buku');
        if (strlen(strval($judulBuku)) == 0) {
            return 'Judul buku tidak valid';
        }

        $penulisBuku = $request->input('penulis');
        if (strlen(strval($penulisBuku)) == 0) {
            return 'Penulis buku tidak valid';
        }

        $penerbitBuku = $request->input('penerbit');
        if (strlen(strval($penerbitBuku)) == 0) {
            return 'Penerbit buku tidak valid';
        }

        $tahunTerbitBuku = $request->input('tahun_terbit');
        if (strlen(strval($tahunTerbitBuku)) == 0) {
            return 'Tahun Terbit buku tidak valid';
        }
        $stockBuku = $request->input('stock');
        if (strlen(strval($stockBuku)) == 0) {
            return 'Stock buku tidak valid';
        }

        DB::beginTransaction();
        try {

            $data = [
                'judul_buku' => $judulBuku,
                'penulis' => $penulisBuku,
                'penerbit' => $penerbitBuku,
                'tahun_terbit' => $tahunTerbitBuku,
                'stock' => $stockBuku,
                'stock_tersedia' => 0,
            ];

            Book::create($data);

            DB::commit();

            return redirect()->route('listBuku');

        } catch (\Exception $exception) {

            DB::rollBack();

            return $exception->getMessage();
        }
    }

    // Mengarahkan ke halaman edit buku dengan membawa data buku berdasarkan Id
    public function editBuku($id)
    {

        $data = [
            'book' => Book::findOrFail($id),
            'title' => 'Edit Buku',
            'subtitle' => 'Dashboard',
            'slug' => 'ini slug',
        ];
        return view('pages.buku.edit-buku', $data);
    }

    // Controller untuk menangani proses update data buku
    public function updateBuku(Request $request, $id)
    {
        $judulBuku = $request->input('judul_buku');
        if (strlen(strval($judulBuku)) == 0) {
            return 'Judul buku tidak valid';
        }

        $penulisBuku = $request->input('penulis');
        if (strlen(strval($penulisBuku)) == 0) {
            return 'Penulis buku tidak valid';
        }

        $penerbitBuku = $request->input('penerbit');
        if (strlen(strval($penerbitBuku)) == 0) {
            return 'Penerbit buku tidak valid';
        }

        $tahunTerbitBuku = $request->input('tahun_terbit');
        if (strlen(strval($tahunTerbitBuku)) == 0) {
            return 'Tahun Terbit buku tidak valid';
        }
        $stockBuku = $request->input('stock');
        if (strlen(strval($stockBuku)) == 0) {
            return 'Stock buku tidak valid';
        }

        DB::beginTransaction();
        try {
            $data = [
                'judul_buku' => $judulBuku,
                'penulis' => $penulisBuku,
                'penerbit' => $penerbitBuku,
                'tahun_terbit' => $tahunTerbitBuku,
                'stock' => $stockBuku,
            ];

            $book = Book::findOrFail($id);
            $book->update($data);

            DB::commit();

            return redirect()->route('listBuku');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    // Controller untuk menghapus data buku berdasarkan Id
    public function destroyBuku($id)
    {

        DB::beginTransaction();
        try {

            $book = Book::findOrFail($id);
            $book->delete();
            DB::commit();
            return redirect()->route('listBuku');

        } catch (\Exception $exception) {
            DB::rollBack();
            return 'buku gagal dihapus' . $exception->getMessage();
        }
    }


    public function history()
    {
        // Paginasi mencapai 10 data buku saja yang tampil
        $params = [
            'data' => Book::paginate(10),
            'title' => "List History Buku",
            'subtitle' => "Seluruh data history buku",
            'slug' => 'ini slug',
        ];
        return view('pages.buku.list-history-buku', $params);

    }

    public function historyBuku($id)
    {
        $data = ['book' => Book::findOrFail($id)];
        return view('pages.buku.tabel-laporan', $data);
    }
}
