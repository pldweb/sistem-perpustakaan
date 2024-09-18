<?php

namespace App\Jobs;

use App\Mail\BookReminder;
use App\Services\HunterService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendReminderH3 implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */


    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        $hunterService = app(HunterService::class);

        $targetHari = Carbon::now()->addDays(3)->toDateString();

        $peminjaman = DB::table('peminjaman')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->select('peminjaman.*', 'users.email', 'users.nama')
            ->whereDate('peminjaman.tanggal_pengembalian', '=', $targetHari)
            ->get();

        foreach ($peminjaman as $peminjam) {

//            $verificationResult = $hunterService->verifyEmail($peminjam->email);
//            Log::info('Verification result: ' . print_r($verificationResult, true));
            try {



                if (!empty($peminjam->email)) {

                    Log::info('Reminder email akan dikirim ke: ' . $peminjam->email);
                    Mail::to($peminjam->email)->queue(new BookReminder($peminjam));
                    Log::info('Reminder berhasil terkirim : ' . $peminjam->email);

                } else {
                    Log::warning('Email tidak valid: ' . $peminjam->email);
                }

            } catch (\Exception $e) {
                Log::error('Error kirim email ' . $e->getMessage());
            }
        }
    }
}
