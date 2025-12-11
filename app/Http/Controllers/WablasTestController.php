<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WablasTestController extends Controller
{
    /**
     * Tampilkan halaman test
     */
    public function index()
    {
        return view('wablas.test');
    }

    /**
     * Test Device Info - Cek status device Wablas
     */
    public function testDeviceInfo()
    {
        try {
            $domain = config('services.wablas.domain');
            $token = config('services.wablas.token');

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token Wablas belum dikonfigurasi di .env'
                ], 400);
            }

            // Request ke API Wablas
            $response = Http::get($domain . '/api/device/info', [
                'token' => $token
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] == true) {
                return response()->json([
                    'success' => true,
                    'message' => 'Device info berhasil diambil',
                    'data' => $result['data'],
                    'raw_response' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengambil device info',
                    'error' => $result['message'] ?? 'Unknown error',
                    'raw_response' => $result
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Wablas Test Device Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi API Wablas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test Send Message - Kirim pesan test ke nomor WhatsApp
     */
    public function testSendMessage(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string'
        ]);

        try {
            $domain = config('services.wablas.domain');
            $token = config('services.wablas.token');
            $secretKey = config('services.wablas.secret_key', '');

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token Wablas belum dikonfigurasi di .env'
                ], 400);
            }

            // Format nomor (hapus karakter non-numerik)
            $phone = preg_replace('/[^0-9]/', '', $request->phone);
            
            // Pastikan format nomor dimulai dengan 62
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            } elseif (substr($phone, 0, 2) !== '62') {
                $phone = '62' . $phone;
            }

            Log::info('Testing Wablas Send Message', [
                'phone' => $phone,
                'domain' => $domain,
                'has_secret_key' => !empty($secretKey)
            ]);

            // Kirim pesan menggunakan Wablas API
            if ($secretKey) {
                // Dengan Secret Key (Lebih Aman)
                $response = Http::withHeaders([
                    'Authorization' => $token . '.' . $secretKey,
                ])->asForm()->post($domain . '/api/send-message', [
                    'phone' => $phone,
                    'message' => $request->message,
                ]);
            } else {
                // Tanpa Secret Key
                $response = Http::asForm()->post($domain . '/api/send-message', [
                    'phone' => $phone,
                    'message' => $request->message,
                    'token' => $token
                ]);
            }

            $result = $response->json();

            Log::info('Wablas Response', [
                'status_code' => $response->status(),
                'result' => $result
            ]);

            if ($response->successful() && isset($result['status']) && $result['status'] == true) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesan berhasil dikirim ke ' . $phone,
                    'data' => $result['data'] ?? null,
                    'raw_response' => $result
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengirim pesan',
                    'error' => $result['message'] ?? 'Unknown error',
                    'raw_response' => $result
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Wablas Test Send Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Test dengan cURL (alternative method)
     */
    public function testWithCurl(Request $request)
    {
        $domain = config('services.wablas.domain');
        $token = config('services.wablas.token');
        $phone = $request->phone ?? '6281234567890';
        $message = $request->message ?? 'Test message';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $domain . '/api/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query([
                'phone' => $phone,
                'message' => $message,
                'token' => $token
            ]),
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
            return response()->json([
                'success' => false,
                'message' => 'cURL Error',
                'error' => $err
            ], 500);
        }

        return response()->json([
            'success' => true,
            'http_code' => $httpCode,
            'response' => json_decode($response, true)
        ]);
    }
}