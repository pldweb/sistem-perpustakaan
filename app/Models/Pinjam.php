<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $table = 'pinjam';

    protected $fillable = [
        'user_id',
        'book_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_pengembalian',

    ];

    public function user() {

        return $this->belongsTo(User::class);

    }

    public function book() {

        return $this->belongsTo(Book::class);

    }


}
