<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;


    protected $table = 'peminjaman';

    protected $fillable = [

        'user_id',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'catatan',

    ];

    public function User() {

        return $this->hasOne(User::class, 'id', 'user_id');

    }

    public function PeminjamanBuku() {

        return $this->hasMany(PeminjamanBuku::class, 'peminjaman_id', 'id');

    }

    public function Pengembalian() {

        return $this->hasOne(Pengembalian::class, 'peminjaman_id', 'id');

    }





}
