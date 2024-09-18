<?php

namespace App\Helpers;

use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramHelper{

    public static function sendNotification($msg, $parseMode = 'Markdown')
    {
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID'), // Ambil dari .env
            'text' => $msg,
            'parse_mode' => $parseMode
        ]);

    }
}

