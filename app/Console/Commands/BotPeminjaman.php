<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BotPeminjaman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bot-peminjaman';

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
        $bukuIds = [];
        foreach (Book::query()->get() as $item) {
            $bukuIds[] = $item->id;
            shuffle($bukuIds);
        }

        $tanggalAwal = 10;
        $lamaPinjamPerBuku = 5;
        foreach (User::query()->get() as $user) {
            $jumlahPinjam = rand(1, 5);
            $this->info("proses peminjaman oleh $user->nama ($jumlahPinjam buku)");
            for ($pinjam = 1; $pinjam <= $jumlahPinjam; $pinjam++) {
                $jumlahBuku = rand(1, 5);

                $tanggalPinjam = Carbon::now()
                    ->subDays(rand(1, $tanggalAwal))
                    ->format('Y-m-d');

                $tanggalKembali = (new Carbon($tanggalPinjam))
                    ->addDays($jumlahBuku * $lamaPinjamPerBuku)
                    ->format('Y-m-d');

                $this->info("-- proses peminjaman buku ke-$pinjam, $tanggalPinjam-$tanggalKembali, $jumlahBuku buku");

                DB::beginTransaction();
                try {
                    $peminjaman = Peminjaman::query()->create([
                        'user_id' => $user->id,
                        'tanggal_pinjam' => $tanggalPinjam,
                        'tanggal_pengembalian' => $tanggalKembali,
                        'catatan' => '',
                    ]);

                    $jumlahDipinjam = 0;
                    foreach ($bukuIds as $bukuId) {
                        if ($jumlahDipinjam >= $jumlahBuku) {
                            break;
                        }

                        $peminjaman->PeminjamanBuku()->create([
                            'buku_id' => $bukuId,
                            'jumlah' => 1
                        ]);
                        $jumlahDipinjam++;
                    }
                    shuffle($bukuIds);

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    $this->error("-- gagal disimpan ges");
                }
            }
        }
    }
}
