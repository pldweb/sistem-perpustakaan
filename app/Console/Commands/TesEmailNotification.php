<?php

namespace App\Console\Commands;

use App\Jobs\SendMailPersonal;
use App\Jobs\TestQueueJob;
use App\Mail\TesMail;
use App\Models\Peminjaman;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TesEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tes-email-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        SendMailPersonal::dispatch();
        Log::info('Queue SendMailPersonal dispatched');
    }

}
