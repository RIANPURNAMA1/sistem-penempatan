<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function sendMessage($target, $message)
    {
        $token = "nP3ttMoWtrqeYuUAL4cM"; // token kamu

        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('https://api.fonnte.com/send', [
            'target' => $target,
            'message' => $message,
        ]);

        return $response->json();
    }
}
