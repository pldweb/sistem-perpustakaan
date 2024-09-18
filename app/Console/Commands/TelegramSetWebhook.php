<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class TelegramSetWebhook extends Command
{
    protected $signature = 'telegram:setwebhook';
    protected $description = 'Set Telegram bot webhook';

    public function handle()
    {
        $telegram = new Api(config('services.telegram-bot-api.token'));
        $result = $telegram->setWebhook(['url' => 'http://sistem-perpustakaan.it/api/bot/webhook']);

        $this->info($result ? "Webhook set successfully" : "Failed to set webhook");
    }
}
