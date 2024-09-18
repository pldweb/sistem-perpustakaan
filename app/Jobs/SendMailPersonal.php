<?php

namespace App\Jobs;

use App\Mail\TesMail;
use App\Models\Peminjaman;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailPersonal implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emailReceiver = 'muhammadrivaldifnni01@gmail.com';
        $peminjaman = Peminjaman::first();
        if ($peminjaman) {
            Log::info('Enqueuing email for: ' . $emailReceiver);
            Mail::to($emailReceiver)->queue(new TesMail($peminjaman));
            Log::info('Berhasil kirim email');
        } else {
            Log::error('Gagal kirim email');
        }
    }
}
