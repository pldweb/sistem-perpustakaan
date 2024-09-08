<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramHelper;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
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

    public function sendNotification(){
        try {

            $pesanTelegram = "📕📕 *Buku Baru Sudah Ditambahkan* 📕📕\n\n";
            $pesanTelegram .= "Judul Buku: *Malam Pertama di Alam Kubur*\n";
            $pesanTelegram .= "Penulis: _Dani Nugraha_";

            $msg = $pesanTelegram;

            TelegramHelper::sendNotification($msg, 'Markdown');

            return redirect()->route('dashboard', $msg);

        } catch (TelegramSDKException $e) {
            Log::error("Error sending Telegram message: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send message.'], 500);
        }
    }
}
