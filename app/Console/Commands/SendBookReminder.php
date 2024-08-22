<?php

namespace App\Console\Commands;

use App\Mail\BookReminder;
use App\Services\HunterService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-book-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $hunterService;

    /**
     * Execute the console command.
     */

    public function __construct(HunterService $hunterService)
    {
        parent::__construct();
        $this->hunterService = $hunterService;
    }


    public function handle()
    {
        $hariBesok = Carbon::tomorrow()->toDateString();

        $peminjaman = DB::table('peminjaman')
            ->join('users', 'users.id', '=', 'peminjaman.user_id')
            ->select('peminjaman.*', 'users.email', 'users.nama')
            ->whereDate('peminjaman.tanggal_pengembalian', '=', $hariBesok)
            ->get();

        foreach ($peminjaman as $peminjam) {
            try {
                $verificationResult = $this->hunterService->verifyEmail($peminjam->email);

                if ($verificationResult['data']['status'] === 'valid') {

                    Mail::to($peminjam->email)->send(new BookReminder($peminjam));
                    $this->info('Reminder email berhasil dikirim: ' . $peminjam->email);

                } else {
                    $this->warn('Email tidak valid: ' . $peminjam->email);
                }
            } catch (\Exception $e) {
                Log::error('Error in sending email: ' . $e->getMessage());
            }
        }

    }



}
