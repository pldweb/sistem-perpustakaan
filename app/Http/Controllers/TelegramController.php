<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(config('services.telegram-bot-api.token'));
    }

    public function handleWebhook()
    {
        $update = $this->telegram->getWebhookUpdate();

        if ($update->getMessage()) {
            $this->handleMessage($update->getMessage());
        }

        return response()->json(['status' => 'success']);
    }

    private function handleMessage($message)
    {
        $chatId = $message->getChat()->getId();
        $text = $message->getText();

        // Logika bot sederhana
        if (strtolower($text) == 'halo') {
            $response = "Halo! Apa kabar?";
        } else {
            $response = "Maaf, saya tidak mengerti pesan Anda.";
        }

        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $response,
        ]);
    }
}
