<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

            return redirect()->route('ListBuku');

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

            return redirect()->route('ListBuku');

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
            return redirect()->route('ListBuku');

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
        $history = DB::table('books')
            ->join('peminjaman_buku', 'books.id', '=', 'peminjaman_buku.buku_id')
            ->join('peminjaman', 'peminjaman_buku.peminjaman_id', '=', 'peminjaman.id')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->leftJoin('pengembalian', 'peminjaman.id', '=', 'pengembalian.peminjaman_id')
            ->leftJoin('detail_pengembalian', 'pengembalian.id', '=', 'detail_pengembalian.pengembalian_id')
            ->select(
                'books.judul_buku as judul_buku',
                'peminjaman.tanggal_pinjam',
                'peminjaman.tanggal_pengembalian as tanggal_pengembalian_peminjaman',
                'peminjaman.catatan as catatan_peminjaman',
                'peminjaman.status as status_peminjaman',
                'users.nama as nama_peminjam',
                'pengembalian.tanggal_pengembalian as tanggal_pengembalian_pengembalian',
                DB::raw('COALESCE(detail_pengembalian.jumlah, 0) as jumlah_pengembalian'),
                'detail_pengembalian.catatan as catatan_pengembalian',
                'detail_pengembalian.denda'
            )
            ->where('books.id', $id)
            ->orderBy('peminjaman.tanggal_pinjam', 'asc')
            ->get();


        $data = [
            'data' => $history,
            'title' => 'History Buku',
            'subtitle' => 'History Buku',
            'slug' => 'slug',
            'judulBuku' => $history->isEmpty() ? '' : $history->first()->judul_buku,
        ];

        return view('pages.buku.history-buku', $data);
    }
}
