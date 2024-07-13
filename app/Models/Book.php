<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";
    protected $primaryKey = "id";
    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stock',
    ];


    public function pinjam() {
        return $this->hasMany(Pinjam::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'pinjam')
        ->withPivot('tanggal_pinjam', 'tanggal_pengembalian')
        ->withTimestamps();
    }   

}
