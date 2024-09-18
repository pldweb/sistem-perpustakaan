<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use TCPDF;

class PdfController extends Controller
{

    public function showPreview($id)
    {
        $peminjaman = DB::table('peminjaman')
            ->join('peminjaman_buku', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->join('books', 'books.id', '=', 'peminjaman_buku.buku_id')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->select('users.nama', 'books.judul_buku', 'peminjaman.tanggal_pinjam', 'peminjaman.id')
            ->where('peminjaman.id', $id)
            ->first();

        $params = [
            'peminjaman' => $peminjaman,
        ];

        return view('pages.pinjam.preview', $params);
    }

    public function generatePdf($id)
    {
        $peminjaman = DB::table('peminjaman')
            ->join('peminjaman_buku', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->join('books', 'books.id', '=', 'peminjaman_buku.buku_id')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->select('users.nama', 'books.judul_buku', 'peminjaman.tanggal_pinjam')
            ->where('peminjaman.id', $id)
            ->first();

            $pdf = PDF::loadView('pinjam.pdf', $peminjaman);
            return $pdf->download('bukti-peminjaman' . $id . '.pdf');
    }

    public function generatePd($id)
    {
        // Ambil data peminjaman dari database

        $peminjaman = DB::table('peminjaman')
            ->join('peminjaman_buku', 'peminjaman.id', '=', 'peminjaman_buku.peminjaman_id')
            ->join('books', 'books.id', '=', 'peminjaman_buku.buku_id')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->select('users.nama', 'books.judul_buku', 'peminjaman.tanggal_pinjam')
            ->where('peminjaman.id', $id)
            ->first();

        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set metadata
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Bukti Peminjaman Buku');
        $pdf->SetSubject('Bukti Peminjaman Buku');

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Tambah halaman
        $pdf->AddPage();

        // Tambah konten
        $html = '<h1>Bukti Peminjaman Buku</h1>';
        $html .= '<p>Nama: ' . $peminjaman->nama . '</p>';
        $html .= '<p>Judul Buku: ' . $peminjaman->judul_buku . '</p>';
        $html .= '<p>Tanggal Pinjam: ' . $peminjaman->tanggal_pinjam . '</p>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF ke browser
        $pdf->Output('bukti_peminjaman.pdf', 'I');
    }
}
