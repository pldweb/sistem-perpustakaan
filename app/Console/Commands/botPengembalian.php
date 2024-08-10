<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\DetailPengembalian;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class botPengembalian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bot-pengembalian';

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

        $today = Carbon::now()->format('Y-m-d');

        $peminjamanIds = DB::table('peminjaman')->pluck('id');

        foreach ($peminjamanIds as $data) {

            $peminjaman = Peminjaman::find($data);

            if (!$peminjaman) {
                $this->error("Peminjaman ID {$data} tidak ditemukan.");
                continue;
            }

            DB::beginTransaction();
            try {
                // Buat data pengembalian baru
                $pengembalian = Pengembalian::create([
                    'peminjaman_id' => $peminjaman->id,
                    'tanggal_pengembalian' => $today,
                ]);

                // Ambil semua buku yang dipinjam
                $peminjamanBuku = DB::table('peminjaman_buku')
                    ->where('peminjaman_id', $peminjaman->id)
                    ->get();

                foreach ($peminjamanBuku as $item) {
                    $buku = Book::find($item->buku_id);

                    if ($buku) {
                        // Tambahkan stok buku
                        $buku->stock += $item->jumlah;
                        $buku->save();

                        // Simpan detail pengembalian untuk buku ini
                        DetailPengembalian::create([
                            'pengembalian_id' => $pengembalian->id,
                            'buku_id' => $item->buku_id,
                            'jumlah' => $item->jumlah,
                            'catatan' => 'Pengembalian otomatis',
                            'denda' => 0 // Sesuaikan jika ada denda
                        ]);
                    }
                }

                // Tandai peminjaman sebagai selesai
                $peminjaman->status = 'selesai';
                $peminjaman->save();

                DB::commit();

                $this->info("Pengembalian untuk peminjaman ID {$peminjaman->id} diproses.");

            } catch (\Exception $exception) {
                DB::rollBack();

                $this->error("Gagal memproses pengembalian untuk peminjaman ID {$peminjaman->id}. Error: {$exception->getMessage()}");
            }
        }
        $this->info('Proses pengembalian buku selesai.');
    }
}
