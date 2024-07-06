<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    public function pinjam() {
        return $this->hasMany(Pinjam::class);
    }

    protected $table = "books";
    protected $primaryKey = "id";
    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stock',
    ];

}
