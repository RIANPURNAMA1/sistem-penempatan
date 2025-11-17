<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

  class FonnteService
{
    protected static $token = "jB9Bk1ANacyBXDHNwXiV";

    public static function sendMessage($noWa, $pesan)
    {
        if (!$noWa || !$pesan) {
            return false;
        }

        $noWa = preg_replace('/^0/', '62', $noWa);

        try {
            $response = Http::withHeaders([
                'Authorization' => self::$token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $noWa,
                'message' => $pesan,
            ]);

            return $response->json();

        } catch (\Exception $e) {
            dd("ERROR FONNTE:", $e->getMessage());
        }
    }
}
