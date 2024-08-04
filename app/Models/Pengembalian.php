<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $table = 'pengembalian';

    protected $fillable = [

        'peminjaman_id',
        'tanggal_pengembalian',

    ];

    public function DetailPengembalian()
    {

        return $this->hasMany(DetailPengembalian::class, 'pengembalian_id', 'id');

    }

    public function Peminjaman()
    {

        return $this->hasOne(Peminjaman::class, 'id', 'peminjaman_id');

    }


}
