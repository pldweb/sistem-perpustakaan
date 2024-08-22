<?php

namespace App\Services;

use GuzzleHttp\Client;

class HunterService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('HUNTER_API_KEY'); // Simpan API Key di .env
    }

    public function verifyEmail($email)
    {
        try {
            $response = $this->client->get('https://api.hunter.io/v2/email-verifier', [
                'query' => [
                    'email' => $email,
                    'api_key' => $this->apiKey,
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            return $body; // Mengembalikan hasil verifikasi
        } catch (\Exception $e) {
            // Tangani kesalahan jika perlu
            return null;
        }
    }
}
