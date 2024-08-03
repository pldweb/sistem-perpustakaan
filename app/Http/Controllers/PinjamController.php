<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\PeminjamanBuku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    // Menampilkan halaman seluruh data peminjaman
    public function ListPinjam()
    {

        $pinjam = Peminjaman::with(['user', 'PeminjamanBuku'])->paginate(10);

        $title = 'Data Peminjam';
        $subtitle = 'List Data Peminjaman Buku';
        $slug = 'Ini untuk slug';

        return view('pages.pinjam.list_pinjam', compact('title', 'slug', 'subtitle', 'pinjam'));
    }

    // Menampilkan halaman Detail Peminjaman Buku
    public function DetailPinjam($tanggal_pinjam, $id)
    {

        $title = 'Data Peminjaman Buku';
        $slug = 'Form Data Peminjaman Buku';
        $subtitle = 'Detail Data Peminjaman Buku';

        // Ambil data peminjaman berdasarkan ID, beserta relasi peminjaman buku dan buku
        $peminjaman = Peminjaman::with('PeminjamanBuku.buku')->findOrFail($id);

        return view('pages.pinjam.detail_pinjam', compact('tanggal_pinjam', 'peminjaman', 'slug', 'subtitle', 'id', 'title',));

    }

    // Update Detail Peminjaman Buku
    public function UpdatePinjam(Request $request, $tanggal_pinjam, $id)
    {

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id.*' => 'required|exists:books,id',
            'jumlah.*' => 'required|integer|min:1|max:3',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam',
        ]);

        $pinjam = Peminjaman::find($id);

        if (!$pinjam) {
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
            $existingPinjam = Peminjaman::where('user_id', $validated['user_id'])
                ->where('book_id', $bookId)
                ->first();

            if ($existingPinjam) {
                // Update jumlah buku
                $existingPinjam->jumlah = $jumlah;
                $existingPinjam->save();
            } else {
                // Buat peminjaman buku baru
                Peminjaman::create([
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


    // Mengarahkan ke halaman form Pinjam Buku
    public function PinjamBuku()
    {
        $books = Book::where('stock', '>', 0)->get();
        $users = User::all();
        $title = 'Input Data Peminjaman';
        $subtitle = 'Form Peminjaman Buku';
        $slug = 'Ini untuk slug';

        return view('pages.pinjam.input_pinjam', compact('books', 'users', 'title', 'slug', 'subtitle'));
    }


    // Controller menangani request input data peminjaman buku
    public function store(Request $request)
    {
        $tanggalPinjam = $request->input('tanggal_pinjam');
        if (strlen(strval($tanggalPinjam)) == 0) {
            return 'tanggal pinjam tidak valid';
        }

        $tanggalPengembalian = $request->input('tanggal_pengembalian');
        if (strlen(strval($tanggalPengembalian)) == 0) {
            return 'tanggal pengembalian tidak valid';
        }

        if (strtotime($tanggalPinjam) > strtotime($tanggalPengembalian)) {
            return 'tanggal pinjam harus lebih awal daripada tanggal kembali';
        }

        // Ini proses Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'books.*.book_id' => 'required|exists:books,id',
            'books.*.jumlah' => 'required|integer|max:3',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam',
            'catatan' => '',
        ]);

        // Periksa ketersediaan stok buku
        foreach ($request->books as $bookData) {
            $book = Book::find($bookData['book_id']);
            if ($book->stock < $bookData['jumlah']) {
                return redirect()->back()->withErrors(['books' => 'Stock tidak cukup untuk buku ' . $book->judul_buku]);
            }
        }

        DB::beginTransaction();
        try {
            // Buat data peminjaman terlebih dahulu
            $peminjaman = Peminjaman::create([
                'user_id' => $request->user_id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_pengembalian' => $tanggalPengembalian,
                'catatan' => $request->catatan,
            ]);

            // Jika masih ada stock, kurangi stok buku dan simpan data peminjaman buku
            foreach ($request->books as $bookData) {
                $book = Book::find($bookData['book_id']);
                $book->stock -= $bookData['jumlah'];
                $book->save();

                // Simpan data peminjaman buku
                PeminjamanBuku::create([
                    'peminjaman_id' => $peminjaman->id, // Menggunakan ID dari peminjaman yang baru dibuat
                    'buku_id' => $bookData['book_id'],
                    'jumlah' => $bookData['jumlah'],
                ]);
            }

            DB::commit();
            return redirect()->route('ListPinjam');
        } catch (\Exception $exception) {
            DB::rollBack();
            return 'data gagal disimpan';
        }
    }

    // Hapus data peminjaman berdasarkan tanggal pinjam dan Id
    public function destroy($tanggal_pinjam, $id)
    {

        $pinjam = Peminjaman::where('id', $id)->where('tanggal_pinjam', $tanggal_pinjam)->firstOrFail();

        // Mengembalikan stok buku yang dipinjam
        foreach ($pinjam->peminjamanBuku as $peminjamanBuku) {
            $book = $peminjamanBuku->buku;
            $book->stock += $peminjamanBuku->jumlah;
            $book->save();
        }

        // Hapus data peminjaman buku terkait
        $pinjam->peminjamanBuku()->delete();

        // Hapus data peminjaman
        $pinjam->delete();

        return redirect()->route('ListPinjam');

    }


    // Untuk search belum jadi
    public function searchResult(Request $request)
    {

        $request->validate([
            'tanggal' => 'required|date'
        ]);

        $tanggal = $request->input('tanggal');

        $peminjaman = Peminjaman::with('PeminjamanBuku.Buku')
            ->whereDate('tanggal_pinjam', $tanggal)
            ->orWhereDate('tanggal_pengembalian', $tanggal)
            ->get();

        return redirect('searchPage', compact('peminjaman', 'tanggal'));

    }


}
