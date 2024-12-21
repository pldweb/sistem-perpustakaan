<?php

namespace App\Http\Controllers;

use App\Exports\TableBookExport;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Helpers\TelegramHelper;

class BukuController extends Controller
{
    public function listBuku()
    {
        $params = [
            'data' => Book::paginate(10),
            'title' => "List Data Master Buku",
            'subtitle' => "Seluruh data master buku",
            'slug' => 'ini slug',
        ];
        return view('pages.buku.list-buku', $params);
    }

    public function tableBookExport()
    {
        $data = DB::table('books')
            ->select('books.judul_buku', 'books.penulis', 'books.penerbit', 'books.tahun_terbit', 'books.tahun_terbit', 'books.stock')
            ->get()
            ->map(function ($item, $index) {
                return (object) array_merge((array) $item, ['index' => $index]);
            });

        return Excel::download(new TableBookExport($data), 'Data-buku.xlsx');
    }

    public function tableListBuku()
    {
        // Paginasi mencapai 10 data buku saja yang tampil
        $params = [
            'data' => Book::paginate(10),
        ];
        return view('pages.buku.table.table-list-buku', $params);
    }

    public function inputBuku()
    {
        $params = [

            'title' => "Edit Data Master Buku",
            'subtitle' => "Form edit data buku",
            'slug' => 'ini slug'
        ];
        return view('pages.buku.input-buku', $params);
    }

    public function simpanBuku(Request $request)
    {
        $judulBuku = $request->input('judul_buku');
        if (strlen(strval($judulBuku)) == 0) {
            return response()->json(['success' => false, 'message' => 'Judul buku tidak valid']);
        }

        $penulisBuku = $request->input('penulis');
        if (strlen(strval($penulisBuku)) == 0) {
            return response()->json(['success' => false, 'message' => 'Penulis buku tidak valid']);
        }

        $penerbitBuku = $request->input('penerbit');
        if (strlen(strval($penerbitBuku)) == 0) {
            return response()->json(['success' => false, 'message' => 'Penerbit buku tidak valid']);
        }

        $tahunTerbitBuku = $request->input('tahun_terbit');
        if (strlen(strval($tahunTerbitBuku)) == 0) {
            return response()->json(['success' => false, 'message' => 'Tahun terbit buku tidak valid']);
        }

        $stockBuku = $request->input('stock');
        if (strlen(strval($stockBuku)) == 0) {
            return response()->json(['success' => false, 'message' => 'Stock buku tidak valid']);
        }

        if ($request->hasFile('photo')) {

            $filePhoto = $request->file('photo');

            $originalName = $filePhoto->getClientOriginalName();

            $filename = time() . '-' . $originalName;

            $filePath = $filePhoto->storeAs('uploads/buku/images', $filename, [
                'disk' => 's3',
                'visibility' => 'public'
            ]);

            $urlPhoto = Storage::disk('s3')->url($filePath);

            $data['photo'] = $urlPhoto;

        } else {

            $data['photo'] = 'A';

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
                'photo' => $urlPhoto,
            ];

            Book::create($data);

            $pesanTelegram = "📕📕 *Buku Baru Sudah Ditambahkan* 📕📕\n\n";
            $pesanTelegram .= "Judul Buku: *{$judulBuku}*\n";
            $pesanTelegram .= "Penulis: _{$penulisBuku}_\n";
            $pesanTelegram .= "Stock: _{$stockBuku}_";

            $msg = $pesanTelegram;

            TelegramHelper::sendNotification($msg, 'Markdown');

            DB::commit();

            // Hanya mengambil data buku yang baru saja ditambahkan atau halaman terakhir
            $items = Book::orderBy('id', 'desc')->paginate(10); // Misalnya 10 item per halaman

            $newItem = view('pages.table.table-list-buku', ['items' => $items])->render();

            return response()->json([
                'success' => true,
                'newItem' => $newItem,
                'text' => $msg
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

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

            $pesanTelegram = "📕📕 *Buku Sudah Diupdate* 📕📕\n\n";
            $pesanTelegram .= "Judul Buku: *{$judulBuku}*\n";
            $pesanTelegram .= "Penulis: _{$penulisBuku}_\n";
            $pesanTelegram .= "Stock: _{$stockBuku}_";

            $msg = $pesanTelegram;

            TelegramHelper::sendNotification($msg, 'Markdown');

            DB::commit();

            return redirect()->route('listBuku');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

    }

    public function destroyBuku($id)
    {

        DB::beginTransaction();
        try {
            $book = Book::findOrFail($id);

            $fullUrl = $book->photo;
            $idBuku = $book->id;
            $judulBuku = $book->judul_buku;

            // Ekstrak path dari URL
            $urlParts = parse_url($fullUrl);
            $bucket = 'md37f25580cb73608'; // Sesuaikan dengan nama bucket Anda
            $filePath = ltrim(str_replace("/{$bucket}", '', $urlParts['path']), '/');
            $filePath = urldecode($filePath);

            // Debug path file
            Log::info('File Path: ' . $filePath);

            // Cek dan hapus file dari Object Storage
            if (Storage::disk('s3')->exists($filePath)) {
                if (!Storage::disk('s3')->delete($filePath)) {
                    Log::error('Failed to delete file: ' . $filePath);

                    $pesanTelegram = "📕📕 *Buku Gagal Dihapus* 📕📕\n\n";
                    $pesanTelegram .= "ID Buku: *{$idBuku}*\n";
                    $pesanTelegram .= "Judul Buku: *{$judulBuku}*\n";

                } else {
                    Storage::disk('s3')->delete($filePath);
                    // Kirim notifikasi Telegram
                    $pesanTelegram = "📕📕 *Buku Berhasil Dihapus* 📕📕\n\n";
                    $pesanTelegram .= "ID Buku: *{$idBuku}*\n";
                    $pesanTelegram .= "Judul Buku: *{$judulBuku}*\n";

                    Log::error('Berhasil hapus: ' . $filePath);

                }
            } else {
                Log::error('File does not exist: ' . $filePath);
                // Kirim notifikasi Telegram
                $pesanTelegram = "📕📕 *Buku Gagal Dihapus* 📕📕\n\n";
                $pesanTelegram .= "ID Buku: *{$idBuku}*\n";
                $pesanTelegram .= "Judul Buku: *{$judulBuku}*\n";
            }

            $msg = $pesanTelegram;

            TelegramHelper::sendNotification($msg, 'Markdown');

            $book->delete();

            DB::commit();
            return redirect()->route('listBuku');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Exception: ' . $exception->getMessage());
            return 'Buku gagal dihapus: ' . $exception->getMessage();
        }

    }

    public function historyBuku()
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

    public function tableListHistoryBuku()
    {
        $params = [
            'data' => Book::paginate(10),
            'title' => "List History Buku",
            'subtitle' => "Seluruh data history buku",
            'slug' => 'ini slug',
        ];

        return view('pages.buku.table.table-list-history-buku', $params);
    }

    public function showTableLaporanBuku($id, Request $request)
    {

        $data = DB::table('peminjaman_buku')
            ->join('peminjaman', 'peminjaman_buku.peminjaman_id', '=', 'peminjaman.id')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->where('peminjaman_buku.buku_id', '=', $id)
            ->select('peminjaman_buku.jumlah', 'peminjaman.tanggal_pinjam', 'users.nama')
            ->orderBy('peminjaman.tanggal_pinjam', 'desc')
            ->get();

        $params = [
            'data' => $data,
            'title' => 'List History Buku',
            'slug' => 'ini slug',
            'subtitle' => 'Ini sub title'
        ];

        if ($request->ajax()) {
            return view('pages.buku.table.table-laporan', $params);
        }

        return 'error';
    }

}
