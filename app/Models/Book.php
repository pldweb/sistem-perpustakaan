<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    use HasFactory;


    protected $table = "books";
    public $timestamps = false;

    protected $primaryKey = "id";
    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stock',
        'stock_tersedia'
    ];


    public function PeminjamanBuku()
    {
        return $this->hasMany(PeminjamanBuku::class, 'buku_id', 'id');
    }

    public function DetailPengembalian()
    {
        return $this->hasMany(DetailPengembalian::class, 'buku_id', 'id');
    }

    public function listPeminjamanBuku()
    {
        return $this->PeminjamanBuku()
            ->join('peminjaman', 'peminjaman.id', '=', 'peminjaman_id')
            ->orderBy('tanggal_pinjam')
            ->get();
    }


}
