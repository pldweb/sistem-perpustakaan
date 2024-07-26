<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengembalian extends Model
{
    use HasFactory;

    protected $table = 'detail_pengembalian';

    protected $fillable = [

        'pengembalian_id',
        'buku_id',
        'jumlah',
        'catatan',
        'denda'

    ];


    public function Buku() {

        return $this->hasOne(Book::class, 'id', 'buku_id');

    }

    public function Pengembalian() {

        return $this->hasOne(Pengembalian::class, 'id', 'pengembalian_id');

    }

}
