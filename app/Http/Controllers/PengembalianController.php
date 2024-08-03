<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index($id) {

        // Ambil Data Peminjaman berdasarkan ID, dengan relasi Peminjaman Buku dan Buku
        $peminjaman = Peminjaman::with('PeminjamanBuku.Buku')->findOrFail($id);

        return view('pages.');

    }

    public function store(Request $request) {

        // Validasi Input Pengembalian
        $request->validate([
            'peminjaman_id' => 'required|exist:peminjaman_id',
            'tanggal_pengembalian' => 'required|date',
        ]);


        // Ambil Data Peminjaman
        $peminjaman = Peminjaman::with('PeminjamanBuku.Buku')->findOrFail($request->peminjaman_id);

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_pengembalian' => $request->tanggal_pengembalian
        ]);


    }
}
