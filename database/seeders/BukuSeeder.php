<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \DB::table('books')->insert([
        //     'judul_buku' => 'Harry Potter',
        //     'penulis' => 'J.K Rowling',
        //     'penerbit' => 'Gramedia',
        //     'tahun_terbit' => 2007,
        //     'stock' => 12,
        // ]);

        // Buat 10 Seeder dari Model Book
        \App\Models\Book::factory(10)->create();

        // Lalu jalankan perintah php artisan make:factory BookFactory --model=book , ini  untuk membuat file factory
        // Jalankan php artisan db:seed --class=BukuSeeder
    }
}
