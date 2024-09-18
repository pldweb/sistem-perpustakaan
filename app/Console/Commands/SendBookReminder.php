<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderH1;
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
    protected $signature = 'app:send-book-reminder-h1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

//    protected $hunterService;

//    protected $hunterService;

    public function __construct()
    {
        parent::__construct();
//        $this->hunterService = $hunterService;
    }

    /**
     * Execute the console command.
     */

    public function handle()
    {
        SendReminderH1::dispatch();
        Log::info('Job SendReminder H1 dispatched');
    }
}
