<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;

class BotBuku extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bot-buku';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for ($i = 1; $i <= 100; $i++) {
            $buku = Book::query()->where(['judul_buku' => "Buku $i"])->first();
            if (is_null($buku)) {
                $this->info("create buku : Buku $i");
                $stok = rand(2, 10);
                Book::query()->create([
                    'judul_buku' => "Buku $i",
                    'penulis' => "Penulis $i",
                    'penerbit' => "Penerbit $i",
                    'tahun_terbit' => rand(1990, 2023),
                    'stock' => $stok,
                    'stock_tersedia' => $stok
                ]);
            }
        }
    }
}
