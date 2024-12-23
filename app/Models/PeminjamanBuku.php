<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBuku extends Model
{
    use HasFactory;


    protected $table = 'peminjaman_buku';

    public $timestamps = false;

    protected $fillable = [

        'peminjaman_id',
        'buku_id',
        'jumlah',
        'jumlah_dikembalikan'

    ];

    public function Peminjaman()
    {

        return $this->hasOne(Peminjaman::class, 'id', 'peminjaman_id');

    }

    public function Buku()
    {

        return $this->hasOne(Book::class, 'id', 'buku_id');

    }

}
