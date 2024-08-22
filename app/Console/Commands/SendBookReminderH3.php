<?php

namespace App\Console\Commands;

use App\Mail\BookReminder;
use App\Services\HunterService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookReminderH3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-book-reminder-h3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    protected  $hunterService;

    public function __construct(HunterService $hunterService)
    {
        parent::__construct();
        $this->hunterService = $hunterService;
    }

    public function handle()
    {
        $targetHari = Carbon::now()->addDays(3)->toDateString();

        $peminjaman = DB::table('peminjaman')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->select('peminjaman.*', 'users.email', 'users.nama')
            ->whereDate('peminjaman.tanggal_pengembalian', '=', $targetHari)
            ->get();

        foreach ($peminjaman as $peminjam) {
            try {

                $verificationResult = $this->hunterService->verifyEmail($peminjam->email);

                if ($verificationResult['data']['status'] === 'valid') {

                    Mail::to($peminjam->email)->queue(new BookReminder($peminjam));
                    $this->info('Reminder berhasil terkirim : ' . $peminjam->email);

                } else {
                    $this->warn('Email tidak valid: ' . $peminjam->email);
                }

            } catch (\Exception $e) {
                Log::error('Error kirim email ' . $e->getMessage());
            }
        }
    }
}
