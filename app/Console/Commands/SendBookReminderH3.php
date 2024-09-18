<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderH3;
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

    protected $hunterService;

    public function __construct(HunterService $hunterService)
    {
        parent::__construct();
        $this->hunterService = $hunterService;
    }

    public function handle()
    {
        SendReminderH3::dispatch($this->hunterService);
        Log::info('Job SendReminder H3 dispatched');
    }
}
