<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderH7;
use App\Mail\BookReminder;
use App\Services\HunterService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookReminderH7 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-book-reminder-h7';

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
        SendReminderH7::dispatch();
        Log::info('Queue SendeRimnderH7 Dispathed');
    }
}
