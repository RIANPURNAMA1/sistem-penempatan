<?php

namespace App\Http\Controllers;

use App\Mail\StatusKandidatUpdated;
use App\Models\Cabang;
use App\Models\Institusi;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\KandidatHistory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class KandidatController extends Controller
{
    // Tampilkan semua kandidat
    public function index()
    {
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])
            ->where('status_kandidat', '!=', 'Ditolak')
            ->orderBy('created_at', 'desc')
            ->get();
        $cabangs = Cabang::all(); // ambil semua cabang untuk filter

        return view('kandidat.data', compact('kandidats', 'cabangs'));
    }

    // Form edit status interview
    public function edit($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        $institusis = Institusi::all();
        return view('kandidat.edit', compact('kandidat', 'institusis'));
    }



    public function update(Request $request, $id)
    {
        /* ------------------------------------------------------------
    | Validasi
    ------------------------------------------------------------ */
        $request->validate([
            'status_kandidat' => 'required|in:Job Matching,Pending,Interview,Jadwalkan Interview Ulang,Lulus interview,Gagal Interview,Pemberkasan,Berangkat,Ditolak',
            'institusi_id' => 'nullable|exists:institusis,id',
            'catatan_interview' => 'nullable|string',
            'jadwal_interview' => 'nullable|date',
            // Validasi bidang SSW
            'bidang_ssw' => 'nullable|in:Pengolahan makanan,Restoran,Pertanian,Kaigo (perawat),Building cleaning,Driver,Lainnya',
        ]);

        /* ------------------------------------------------------------
    | Ambil data kandidat + pendaftaran
    ------------------------------------------------------------ */
        $kandidat = Kandidat::with('pendaftaran')->findOrFail($id);
        $status_lama = $kandidat->status_kandidat;

        /* ------------------------------------------------------------
    | Validasi interview wajib tanggal
    ------------------------------------------------------------ */
        if (in_array($request->status_kandidat, ['Interview', 'Jadwalkan Interview Ulang']) && empty($request->jadwal_interview)) {
            return response()->json([
                'success' => false,
                'status' => 'Validasi Gagal',
                'message' => 'Tanggal interview wajib diisi.'
            ], 422);
        }

        /* ------------------------------------------------------------
    | Larangan update tertentu
    ------------------------------------------------------------ */
        if ($status_lama === 'Lulus interview' && in_array($request->status_kandidat, ['Interview', 'Jadwalkan Interview Ulang', 'Gagal Interview'])) {
            return response()->json([
                'success' => false,
                'status' => 'Larangan Update',
                'message' => 'Tidak boleh mengubah status setelah kandidat lulus.'
            ], 422);
        }

        if (in_array($status_lama, ['Pemberkasan', 'Berangkat'])) {
            $dilarangSetelahAkhir = ['Interview', 'Jadwalkan Interview Ulang', 'Gagal Interview', 'Lulus interview', 'Job Matching', 'Pending', 'Ditolak'];
            if (in_array($request->status_kandidat, $dilarangSetelahAkhir)) {
                return response()->json([
                    'success' => false,
                    'status' => 'Larangan Update',
                    'message' => 'Tidak boleh mengubah status setelah kandidat masuk tahap Pemberkasan atau Berangkat.'
                ], 422);
            }
        }

        /* ------------------------------------------------------------
    | Hitung jumlah interview
    ------------------------------------------------------------ */
        if ($request->status_kandidat === 'Interview' && $status_lama !== 'Interview') {
            $kandidat->jumlah_interview += 1;
        }

        /* ------------------------------------------------------------
    | Update kandidat
    ------------------------------------------------------------ */
        $kandidat->update([
            'status_kandidat' => $request->status_kandidat,
            'institusi_id' => $request->institusi_id,
            'catatan_interview' => $request->catatan_interview,
            'jadwal_interview' => $request->jadwal_interview,
            'jumlah_interview' => $kandidat->jumlah_interview,
            'bidang_ssw'=>$kandidat->bidang_ssw,
        ]);

        /* ------------------------------------------------------------
    | Simpan History
    ------------------------------------------------------------ */
        $statusInterview = match ($request->status_kandidat) {
            'Lulus interview' => 'Selesai',
            'Gagal Interview' => 'Gagal',
            'Interview', 'Jadwalkan Interview Ulang' => 'Proses',
            default => 'Pending',
        };

        KandidatHistory::create([
            'kandidat_id' => $kandidat->id,
            'status_kandidat' => $kandidat->status_kandidat,
            'bidang_ssw' => $kandidat->bidang_ssw,
            'status_interview' => $statusInterview,
            'institusi_id' => $kandidat->institusi_id,
            'catatan_interview' => $kandidat->catatan_interview,
            'jadwal_interview' => $kandidat->jadwal_interview,
        ]);

        // Pastikan variabel $kandidat dan $request sudah didefinisikan sebelum blok ini.

        /* ------------------------------------------------------------
| 📞 Persiapan Data Umum
------------------------------------------------------------ */
        $noWa = $kandidat->pendaftaran->no_wa ?? null;
        $nama = $kandidat->pendaftaran->nama ?? $kandidat->nama;
        $email = $kandidat->pendaftaran->email ?? null;

        // Teks pesan yang akan digunakan untuk WA dan (opsional) Email
        $pesanWa =
            "Halo *{$nama}*,\n\n" .
            "Kami dari *Mendunia Jepang* ingin menginformasikan bahwa terdapat pembaruan terbaru terkait proses administrasi dan penempatan Anda. Kami terus berupaya memastikan setiap tahapan berjalan dengan transparan, akurat, dan sesuai prosedur yang berlaku.\n\n" .

            "📌 *Status Terbaru Anda*: {$request->status_kandidat}\n" .
            "🕒 *Tanggal Pembaruan*: " . now()->format('d M Y H:i') . "\n" .

            (!empty($request->catatan_interview)
                ? "📝 *Catatan Tambahan*:\n{$request->catatan_interview}\n\n"
                : "\n"
            ) .

            "Kami berharap informasi ini dapat membantu Anda mengikuti alur proses dengan lebih nyaman.\n\n" .
            "Apabila Anda membutuhkan penjelasan lebih lanjut atau memiliki pertanyaan seputar tahapan berikutnya, silakan menghubungi kami kapan saja. Tim kami siap membantu.\n\n" .
            "Terima kasih atas kepercayaan Anda kepada *Mendunia Jepang*. Semoga setiap langkah Anda menuju Jepang semakin lancar dan diberi kemudahan.\n\n" .
            "Salam hangat,\n" .
            "*Tim Sukses Mendunia*";


        /* ------------------------------------------------------------
| 🔔 Kirim WhatsApp langsung via API (Fonnte)
------------------------------------------------------------ */
        if (!empty($noWa)) {
            // Ubah nomor WA 08xx menjadi 628xx (Fonnte merekomendasikan format 62xxx)
            $noWaFormatted = preg_replace('/^08/', '628', $noWa);

            try {
                // PERHATIAN: Pastikan Anda menggunakan API Key yang valid dan telah mengaturnya di akun Fonnte Anda.
                $apiKey = "jB9Bk1ANacyBXDHNwXiV";
                $url = "https://api.fonnte.com/send"; // Endpoint yang benar untuk mengirim pesan

                // Payload yang disiapkan untuk form-data
                $payload = [
                    'target' => $noWaFormatted, // Fonnte menggunakan 'target', bukan 'to'
                    'message' => $pesanWa,
                ];

                $ch = curl_init();

                // Mengatur opsi cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10); // timeout 10 detik
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload)); // Kirim sebagai form-data
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: {$apiKey}", // API Key diletakkan di header Authorization
                    "Content-Type: application/x-www-form-urlencoded" // Jenis konten form-data
                ]);

                $response = curl_exec($ch);

                if ($response === false) {
                    $error = curl_error($ch);
                    // Anda perlu memastikan class Log tersedia (misalnya, di Laravel)
                    Log::error("Gagal mengirim WA ke {$noWaFormatted}: {$error}");
                } else {
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    Log::info("WA ke {$noWaFormatted} berhasil dikirim. HTTP Code: {$httpCode}, Response: {$response}");
                }

                curl_close($ch);
            } catch (\Exception $e) {
                Log::error("Exception saat mengirim WA ke {$noWaFormatted}: " . $e->getMessage());
            }
        }



        /* ------------------------------------------------------------
| 📧 Kirim Email Notifikasi
------------------------------------------------------------ */
        if (!empty($email)) {
            // Anda perlu memastikan class Mail tersedia (misalnya, di Laravel)
            Mail::to($email)->send(new StatusKandidatUpdated(
                $nama,
                $request->status_kandidat,
                now()->format('d M Y H:i'),
                $request->catatan_interview
            ));
            Log::info("Email notifikasi berhasil dikirim ke {$email}.");
        }
        /* ------------------------------------------------------------
    | JSON Response sukses
    ------------------------------------------------------------ */
        return response()->json([
            'success' => true,
            'message' => 'Status diperbarui, WA & email terkirim.',
            'redirect' => route('kandidat.data')
        ]);
    }


    // public function update(Request $request, $id)
    // {
    //     // --- Validasi & Update Kandidat seperti sebelumnya ---
    //     $request->validate([
    //         'status_kandidat' => 'required|in:Job Matching,Pending,Interview,Jadwalkan Interview Ulang,Lulus interview,Gagal Interview,Pemberkasan,Berangkat,Diterima,Ditolak',
    //         'institusi_id' => 'nullable|exists:institusis,id',
    //         'catatan_interview' => 'nullable|string',
    //         'jadwal_interview' => 'nullable|date',
    //     ]);

    //     $kandidat = Kandidat::with('pendaftaran')->findOrFail($id);
    //     $status_lama = $kandidat->status_kandidat;

    //     // Validasi interview wajib tanggal
    //     if (in_array($request->status_kandidat, ['Interview', 'Jadwalkan Interview Ulang']) && empty($request->jadwal_interview)) {
    //         return response()->json([
    //             'success' => false,
    //             'status' => 'Validasi Gagal',
    //             'message' => 'Tanggal interview wajib diisi.'
    //         ], 422);
    //     }

    //     // Larangan update setelah lulus
    //     if ($status_lama === 'Lulus interview' && in_array($request->status_kandidat, ['Interview', 'Jadwalkan Interview Ulang', 'Gagal Interview'])) {
    //         return response()->json([
    //             'success' => false,
    //             'status' => 'Larangan Update',
    //             'message' => 'Tidak boleh mengubah status setelah kandidat lulus.'
    //         ], 422);
    //     }

    //     // Larangan update setelah Pemberkasan / Berangkat
    //     if (in_array($status_lama, ['Pemberkasan', 'Berangkat']) && in_array($request->status_kandidat, ['Interview','Jadwalkan Interview Ulang','Gagal Interview','Lulus interview','Job Matching','Pending','Ditolak'])) {
    //         return response()->json([
    //             'success' => false,
    //             'status' => 'Larangan Update',
    //             'message' => 'Tidak boleh mengubah status setelah kandidat masuk tahap Pemberkasan atau Berangkat.'
    //         ], 422);
    //     }

    //     // Hitung jumlah interview
    //     if ($request->status_kandidat === 'Interview' && $status_lama !== 'Interview') {
    //         $kandidat->jumlah_interview += 1;
    //     }

    //     // Update kandidat
    //     $kandidat->update([
    //         'status_kandidat' => $request->status_kandidat,
    //         'institusi_id' => $request->institusi_id,
    //         'catatan_interview' => $request->catatan_interview,
    //         'jadwal_interview' => $request->jadwal_interview,
    //         'jumlah_interview' => $kandidat->jumlah_interview,
    //     ]);

    //     // Simpan history
    //     $statusInterview = match ($request->status_kandidat) {
    //         'Lulus interview' => 'Selesai',
    //         'Gagal Interview' => 'Gagal',
    //         'Interview', 'Jadwalkan Interview Ulang' => 'Proses',
    //         default => 'Pending',
    //     };

    //     KandidatHistory::create([
    //         'kandidat_id' => $kandidat->id,
    //         'status_kandidat' => $kandidat->status_kandidat,
    //         'status_interview' => $statusInterview,
    //         'institusi_id' => $kandidat->institusi_id,
    //         'catatan_interview' => $kandidat->catatan_interview,
    //         'jadwal_interview' => $kandidat->jadwal_interview,
    //     ]);

    //     // Kirim Email
    //     $email = $kandidat->pendaftaran->email ?? null;
    //     $nama = $kandidat->pendaftaran->nama ?? $kandidat->nama;

    //     if (!empty($email)) {
    //         Mail::to($email)->send(new StatusKandidatUpdated(
    //             $nama,
    //             $request->status_kandidat,
    //             now()->format('d M Y H:i'),
    //             $request->catatan_interview
    //         ));
    //     }

    //     // --- Kirim WA via Star Sender API ---
    //     $noWA = $kandidat->pendaftaran->no_WA ?? null;

    //     if (!empty($noWA)) {
    //         try {
    //             $apiKey = '4e9bd1e0-e21a-40ad-840f-66b6ba3ad6bb';
    //             $url = 'https://api.star-sender.com/sendMessage';
    //             $message = "Halo $nama, status kandidat Anda telah diperbarui menjadi *{$request->status_kandidat}*.";

    //             if (!empty($request->catatan_interview)) {
    //                 $message .= "\nCatatan: {$request->catatan_interview}";
    //             }
    //             if (!empty($request->jadwal_interview)) {
    //                 $message .= "\nJadwal Interview: {$request->jadwal_interview}";
    //             }

    //             $client = new Client();
    //             $client->post($url, [
    //                 'headers' => [
    //                     'Authorization' => "Bearer $apiKey",
    //                     'Accept' => 'application/json',
    //                     'Content-Type' => 'application/json',
    //                 ],
    //                 'json' => [
    //                     'phone' => $noWA,
    //                     'message' => $message,
    //                 ],
    //             ]);
    //         } catch (\Exception $e) {
    //             \Log::error("Gagal kirim WA ke {$noWA}: ".$e->getMessage());
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Status diperbarui, email dan WA terkirim.',
    //         'redirect' => route('kandidat.data')
    //     ]);
    // }




    public function history($id)
    {
        // Ambil kandidat beserta pendaftaran
        $kandidat = Kandidat::with('pendaftaran')->findOrFail($id);

        // Semua history kandidat
        $histories = $kandidat->histories()->with('institusi')->orderBy('created_at', 'desc')->get();

        // Summary interview per perusahaan
        $interviewPerPerusahaan = $histories
            ->groupBy('institusi_id')
            ->map(function ($items) {
                // Ambil history terakhir untuk status dan tanggal terakhir
                $last = $items->sortByDesc('created_at')->first();

                return [
                    'institusi' => $last->institusi,

                    // Hanya hitung status "Interview" sebagai jumlah interview
                    'jumlah_interview' => $items->where('status_kandidat', 'Interview')->count(),

                    'status_terakhir' => $last->status_kandidat,
                    'tanggal_terakhir' => $last->created_at,
                ];
            });

        return view('kandidat.history', compact('kandidat', 'histories', 'interviewPerPerusahaan'));
    }
}
