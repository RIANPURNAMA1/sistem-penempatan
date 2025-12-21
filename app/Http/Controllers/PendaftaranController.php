<?php

namespace App\Http\Controllers;

use App\Exports\KandidatExport;
use App\Exports\PendaftaranExport;
use App\Imports\PendaftaranImport;
use App\Models\BidangSsw;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Cabang;
use App\Models\Kandidat;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class PendaftaranController extends Controller
{
    // 🟢 Menampilkan form pendaftaran
    public function datacabang()
    {
        $cabangs = Cabang::all();
        // Cek apakah user sudah mendaftar
        $alreadyRegistered = Pendaftaran::where('user_id', Auth::id())->exists();
        return view('pendaftaran.index', compact('cabangs', 'alreadyRegistered'));
    }


    public function DataPendaftaran(Request $request)
    {
        // Ambil data cabang untuk dropdown
        $cabang = Cabang::all();

        // Query utama
        $query = Pendaftaran::with(['cabang', 'bidang_ssws'])
            ->orderBy('created_at', 'desc');

        // ===============================
        // FILTER CABANG
        // ===============================
        if ($request->filled('cabang_id')) {
            $query->where('cabang_id', $request->cabang_id);
        }

        // ===============================
        // FILTER STATUS JFT
        // ===============================
        if ($request->filled('status_jft')) {
            $query->where('status_jft', $request->status_jft);
        }

        // ===============================
        // FILTER STATUS SSW
        // ===============================
        if ($request->filled('status_ssw')) {
            $query->where('status_ssw', $request->status_ssw);
        }

        // Ambil data akhir
        $kandidats = $query->get();

        return view('siswa.index', compact('kandidats', 'cabang'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:pendaftarans,nik',
            'nama' => 'required|string|max:255',
            'usia' => 'nullable|string|max:255',
            'agama' => 'nullable|string|max:255',
            'status' => 'nullable|in:belum menikah,menikah,lajang',
            'email' => 'required|email|max:255|unique:pendaftarans,email',
            'no_wa' => ['required', 'string', 'max:15', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',

            'alamat' => 'nullable|string',
            'provinsi' => 'nullable|string|max:100',
            'kab_kota' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',

            'cabang_id' => 'required|exists:cabangs,id',

            'tempat_lahir' => 'nullable|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|date',

            'pendidikan_terakhir' => 'required|string|max:255',

            'bidang_ssw' => 'nullable|array',
            'bidang_ssw.*' => 'nullable|string|in:Pengolahan makanan,Restoran,Pertanian,Kaigo (perawat),Building cleaning,Driver,Lainnya',

            'id_prometric' => 'nullable|string|max:255',
            'password_prometric' => 'nullable|string|max:255',
            'pernah_ke_jepang' => 'required|in:Ya,Tidak',

            // FILE
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:3072',
            'kk' => 'nullable|file|mimes:pdf|max:5120',
            'ktp' => 'nullable|file|mimes:pdf|max:5120',
            'bukti_pelunasan' => 'nullable|file|mimes:pdf|max:5120',
            'akte' => 'nullable|file|mimes:pdf|max:5120',
            'ijasah' => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat_jft' => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat_ssw' => 'nullable|file|mimes:pdf|max:5120',
            'paspor' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {
            /* =======================
           UPLOAD FILE
        ======================= */
            $fileFields = [
                'foto',
                'kk',
                'ktp',
                'bukti_pelunasan',
                'akte',
                'ijasah',
                'sertifikat_jft',
                'sertifikat_ssw',
                'paspor',
            ];

            $uploadedPaths = [];

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $folder = public_path("dokumen/{$field}");

                    if (!is_dir($folder)) {
                        mkdir($folder, 0755, true);
                    }

                    $file->move($folder, $filename);
                    $uploadedPaths[$field] = "dokumen/{$field}/{$filename}";
                }
            }

            /* =======================
           TENTUKAN STATUS JFT & SSW
        ======================= */
            $statusJft = isset($uploadedPaths['sertifikat_jft'])
                ? 'sudah ujian jft'
                : 'belum ujian jft';

            $statusSsw = isset($uploadedPaths['sertifikat_ssw'])
                ? 'sudah ujian ssw'
                : 'belum ujian ssw';

            /* =======================
           SIMPAN PENDAFTARAN
        ======================= */
            $pendaftaran = Pendaftaran::create([
                'user_id' => Auth::id(),
                'cabang_id' => $request->cabang_id,

                'nik' => $request->nik,
                'nama' => $request->nama,
                'usia' => $request->usia,
                'agama' => $request->agama,
                'status' => $request->status,
                'email' => $request->email,
                'no_wa' => $request->no_wa,
                'jenis_kelamin' => $request->jenis_kelamin,

                'tempat_lahir' => $request->tempat_lahir,
                'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,

                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kab_kota' => $request->kab_kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,

                'pendidikan_terakhir' => $request->pendidikan_terakhir,

                // FILE
                'foto' => $uploadedPaths['foto'] ?? null,
                'kk' => $uploadedPaths['kk'] ?? null,
                'ktp' => $uploadedPaths['ktp'] ?? null,
                'bukti_pelunasan' => $uploadedPaths['bukti_pelunasan'] ?? null,
                'akte' => $uploadedPaths['akte'] ?? null,
                'ijasah' => $uploadedPaths['ijasah'] ?? null,
                'sertifikat_jft' => $uploadedPaths['sertifikat_jft'] ?? null,
                'sertifikat_ssw' => $uploadedPaths['sertifikat_ssw'] ?? null,
                'paspor' => $uploadedPaths['paspor'] ?? null,

                // STATUS SESUAI MIGRATION
                'status_jft' => $statusJft,
                'status_ssw' => $statusSsw,

                'id_prometric' => $request->id_prometric,
                'password_prometric' => $request->password_prometric,
                'pernah_ke_jepang' => $request->pernah_ke_jepang,
            ]);

            /* =======================
           SIMPAN BIDANG SSW
        ======================= */
            if ($request->filled('bidang_ssw')) {
                foreach ($request->bidang_ssw as $bidang) {
                    BidangSsw::create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'nama_bidang' => $bidang,
                    ]);
                }
            }

            $this->sendMessageToAdmin($pendaftaran);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Pendaftaran berhasil. Status JFT & SSW otomatis ditentukan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }




    private function sendMessageToAdmin($pendaftaran): bool
    {
        try {
            // ===== Token Fonnte =====
            $token = env('FONNTE_TOKEN');
            if (!$token) {
                Log::error('FONNTE_TOKEN belum diset');
                return false;
            }

            // ===== Nomor ADMIN =====
            $adminNumber = env('ADMIN_WA', '6282118364415');

            // ===== Format nomor WA pendaftar =====
            $noWa = preg_replace('/\D/', '', $pendaftaran->no_wa);
            if (str_starts_with($noWa, '0')) {
                $noWa = '62' . substr($noWa, 1);
            }

            // ===== Susun pesan =====
            $message =
                "📥 *PENDAFTARAN BARU MASUK*\n\n" .
                "👤 *Nama:* {$pendaftaran->nama}\n" .
                "📱 *Nomor WA:* {$pendaftaran->no_wa}\n" .
                "💬 *Chat langsung:* https://wa.me/{$noWa}\n" .
                "✉️ *Email:* {$pendaftaran->email}\n" .
                "📍 *Cabang:* {$pendaftaran->cabang->nama_cabang}\n\n" .
                "Silakan cek dan lakukan follow up.";

            // ===== Kirim via Fonnte =====
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target'  => $adminNumber,
                'message' => $message,
                'delay'   => 2,
            ]);

            if ($response->successful()) {
                Log::info("WA (Fonnte) ke Admin berhasil dikirim");
                return true;
            }

            Log::error("WA Fonnte ke Admin gagal", [
                'response' => $response->body()
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error("Error sendMessageToAdmin (Fonnte): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Upload file manual tanpa storage:link
     */
    private function uploadFile($file, $path)
    {
        // Pastikan folder ada
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Pindahkan file ke public/uploads/...
        $file->move(public_path($path), $filename);

        return $path . '/' . $filename;
    }


    public function DataKandidat()
    {
        $kandidats = Pendaftaran::with('cabang')
            ->latest('created_at') // ✅ urutkan berdasarkan waktu update
            ->paginate(10);

        $cabang = Cabang::all();

        return view('siswa.index', compact('kandidats', 'cabang'));
    }


    // 🟠 Form Edit (hanya verifikasi & catatan admin)
    public function edit($id)
    {
        $kandidat = Pendaftaran::findOrFail($id);
        return view('siswa.edit', compact('kandidat'));
    }



    public function update(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'verifikasi'    => 'required|string|in:menunggu,data belum lengkap,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        // 2. Ambil data pendaftaran
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Simpan status verifikasi lama sebelum diupdate
        $oldVerifikasiStatus = $pendaftaran->verifikasi;

        // 3. Update verifikasi + catatan admin
        $pendaftaran->update([
            'verifikasi'    => $request->verifikasi,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $message = 'Data verifikasi berhasil diperbarui!';
        $waSentToUser = false;

        // Status verifikasi baru
        $newVerifikasiStatus = $request->verifikasi;

        // 4. Jika status berubah menjadi 'diterima' → buat kandidat
        if ($newVerifikasiStatus === 'diterima') {
            // Logika firstOrCreate harus ditangani dengan benar, termasuk mengisi field yang NOT NULL
            // Asumsi: 'nama_perusahaan' di tabel 'kandidats' sudah diatasi (seperti yang dibahas sebelumnya)
            // Jika ada field NOT NULL lain, pastikan dimasukkan di sini, atau set nullable di migration.
            Kandidat::firstOrCreate(
                ['pendaftaran_id' => $pendaftaran->id],
                [
                    'cabang_id'       => $pendaftaran->cabang_id,
                    'status_kandidat' => 'Job Matching',
                    'institusi_id'    => null,
                    // Tambahkan field NOT NULL lain seperti 'nama_perusahaan' di sini jika diperlukan
                ]
            );

            $message = 'Kandidat berhasil diverifikasi dan dibuat.';
        }

        // 5. Kirim WA ke pendaftar HANYA JIKA status berubah
        // Pengecekan status lama vs status baru untuk menghindari pengiriman berulang jika data diupdate tanpa perubahan status.
        if ($oldVerifikasiStatus !== $newVerifikasiStatus) {
            $waSentToUser = $this->sendWhatsAppNotification(
                $pendaftaran,
                $newVerifikasiStatus,
                $request->catatan_admin ?? 'Tidak ada catatan khusus.'
            );
        }

        // 6. Kirim WA ke admin (Anda bisa menghapus ini jika tidak diperlukan, atau biarkan)
        // $this->sendWhatsAppToAdmin($pendaftaran); 

        // 7. Response
        if ($request->ajax()) {
            return response()->json([
                'status'          => 'success',
                'message'         => $message,
                'wa_sent_to_user' => $waSentToUser,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    private function sendWhatsAppNotification(
        Pendaftaran $pendaftaran,
        string $status,
        string $catatanAdmin
    ): bool {

        // Token Fonnte
        $token = env('FONNTE_TOKEN');

        if (!$token) {
            Log::error('FONNTE_TOKEN belum diset di .env');
            return false;
        }

        // Ambil nomor WA pendaftar
        $phoneNumber = $pendaftaran->no_wa;

        // Format nomor ke internasional (62)
        $formattedNumber = preg_replace('/\D/', '', $phoneNumber);
        if (str_starts_with($formattedNumber, '0')) {
            $formattedNumber = '62' . substr($formattedNumber, 1);
        }

        // Nama pendaftar
        $namaPendaftar = $pendaftaran->nama ?? 'Calon Kandidat';

        // Susun pesan berdasarkan status
        switch ($status) {
            case 'diterima':
                $pesan =
                    "Halo *{$namaPendaftar}* 👋\n\n" .
                    "Selamat! Pendaftaran Anda telah *DITERIMA* 🎉\n\n" .
                    "*Catatan Admin:*\n{$catatanAdmin}\n\n" .
                    "Tim Mendunia.id akan segera menghubungi Anda untuk proses selanjutnya.";
                break;

            case 'data belum lengkap':
                $pesan =
                    "Halo *{$namaPendaftar}* 👋\n\n" .
                    "Status pendaftaran Anda: *DATA BELUM LENGKAP*\n\n" .
                    "Mohon segera melengkapi data Anda.\n\n" .
                    "*Catatan Admin:*\n{$catatanAdmin}\n\n" .
                    "Jika membutuhkan bantuan, silakan hubungi tim Mendunia.id.";
                break;

            case 'ditolak':
                $pesan =
                    "Halo *{$namaPendaftar}* 👋\n\n" .
                    "Mohon maaf, pendaftaran Anda *DITOLAK* ❌\n\n" .
                    "*Catatan Admin:*\n{$catatanAdmin}\n\n" .
                    "Terima kasih atas ketertarikan Anda melalui Mendunia.id.";
                break;

            case 'menunggu':
            default:
                return true; // tidak kirim WA
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target'  => $formattedNumber,
                'message' => $pesan,
                'delay'   => 2, // optional (detik)
            ]);

            if ($response->successful()) {
                Log::info("WA (Fonnte) terkirim ke {$formattedNumber}");
                return true;
            }

            Log::error("WA Fonnte gagal: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("WA Fonnte EXCEPTION: " . $e->getMessage());
            return false;
        }
    }




    private function sendWhatsAppMessage($pendaftaran, $kandidat, $linkGrup)
    {
        try {
            // Format nomor WA (hapus karakter non-numerik)
            $noWa = preg_replace('/[^0-9]/', '', $pendaftaran->no_wa);

            // Pastikan format nomor dimulai dengan 62
            if (substr($noWa, 0, 1) === '0') {
                $noWa = '62' . substr($noWa, 1);
            } elseif (substr($noWa, 0, 2) !== '62') {
                $noWa = '62' . $noWa;
            }

            // Pesan yang akan dikirim
            $message = "🎉 *Selamat!*\n\n";
            $message .= "Halo *{$pendaftaran->nama}*,\n\n";
            $message .= "Kami dengan senang hati menginformasikan bahwa pendaftaran Anda telah *DITERIMA*! ✅\n\n";
            $message .= "Silakan bergabung dengan grup WhatsApp kami untuk informasi lebih lanjut:\n";
            $message .= "🔗 {$linkGrup}\n\n";
            $message .= "Terima kasih! 😊";

            // ===== PILIHAN 1: Menggunakan Fonnte (Recommended) =====
            /*
            $response = Http::withHeaders([
                'Authorization' => config('services.fonnte.token')
            ])->post('https://api.fonnte.com/send', [
                'target' => $noWa,
                'message' => $message,
                'countryCode' => '62'
            ]);

            if ($response->successful()) {
                Log::info("WhatsApp berhasil dikirim ke {$pendaftaran->nama} ({$noWa})");
                return true;
            }
            */

            // ===== PILIHAN 2: Menggunakan Wablas API V1 (AKTIF) =====
            $domain = config('services.wablas.domain', 'https://bdg.wablas.com');
            $token = config('services.wablas.token');

            // Metode 1: Menggunakan Authorization Header (Jika punya secret key)
            $secretKey = config('services.wablas.secret_key', '');

            if ($secretKey) {
                // Dengan Secret Key (Lebih Aman)
                $response = Http::withOptions([
                    'verify' => false  // Disable SSL verification (untuk development)
                ])->withHeaders([
                    'Authorization' => $token . '.' . $secretKey,
                ])->asForm()->post($domain . '/api/send-message', [
                    'phone' => $noWa,
                    'message' => $message,
                ]);
            } else {
                // Tanpa Secret Key (Token saja)
                $response = Http::withOptions([
                    'verify' => false  // Disable SSL verification (untuk development)
                ])->asForm()->post($domain . '/api/send-message', [
                    'phone' => $noWa,
                    'message' => $message,
                    'token' => $token
                ]);
            }

            if ($response->successful()) {
                $result = $response->json();

                // Cek response dari Wablas
                if (isset($result['status']) && $result['status'] == true) {
                    Log::info("WhatsApp berhasil dikirim ke {$pendaftaran->nama} ({$noWa})", ['response' => $result]);
                    return true;
                } else {
                    Log::error("Wablas Error Response", ['response' => $result]);
                    return false;
                }
            } else {
                Log::error("Wablas HTTP Error: " . $response->status() . " - " . $response->body());
                return false;
            }

            // ===== PILIHAN 3: Menggunakan Twilio =====
            /*
            $response = Http::withBasicAuth(
                config('services.twilio.sid'),
                config('services.twilio.token')
            )->asForm()->post("https://api.twilio.com/2010-04-01/Accounts/" . config('services.twilio.sid') . "/Messages.json", [
                'From' => 'whatsapp:+' . config('services.twilio.from'),
                'To' => 'whatsapp:+' . $noWa,
                'Body' => $message
            ]);
            
            if ($response->successful()) {
                Log::info("WhatsApp berhasil dikirim ke {$pendaftaran->nama} ({$noWa})");
                return true;
            }
            */

            // ===== PILIHAN 4: Manual Link WhatsApp (Tanpa API) =====
            /*
            $waUrl = "https://wa.me/{$noWa}?text=" . urlencode($message);
            Log::info("Link WA untuk kandidat {$pendaftaran->nama}: {$waUrl}");
            
            // Simpan link untuk dibuka manual oleh admin
            $kandidat->wa_link_manual = $waUrl;
            $kandidat->save();
            
            return true; // Dianggap berhasil karena link sudah tersimpan
            */

            return false;
        } catch (\Exception $e) {
            // Log error
            Log::error('WhatsApp Send Error: ' . $e->getMessage());
            Log::error('Kandidat: ' . $pendaftaran->nama . ' | No WA: ' . $pendaftaran->no_wa);
            return false;
        }
    }

    // Tampilkan halaman kandidat
    public function Kandidat()
    {
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])->latest('id');
        return view('kandidat.data', compact('kandidats'));
    }




    // Form edit lengkap
    public function editFull($id)
    {
        $kandidat = Pendaftaran::findOrFail($id);
        return view('siswa.edit_full', compact('kandidat'));
    }



    public function updateFull(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'sometimes|required|string|size:16|unique:pendaftarans,nik,' . $pendaftaran->id,
            'nama' => 'sometimes|required|string|max:255',
            'usia' => 'sometimes|required|string|max:255',
            'agama' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:belum menikah,menikah,lajang',
            'email' => 'sometimes|required|email|max:255|unique:pendaftarans,email,' . $pendaftaran->id,
            'no_wa' => ['sometimes', 'required', 'string', 'max:15', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'sometimes|required|in:Laki-laki,Perempuan',
            'alamat' => 'sometimes|required|string|max:500',
            'provinsi' => 'sometimes|required|string|max:100',
            'kab_kota' => 'sometimes|required|string|max:100',
            'kecamatan' => 'sometimes|required|string|max:100',
            'kelurahan' => 'sometimes|required|string|max:100',
            'cabang_id' => 'sometimes|required|exists:cabangs,id',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'tempat_tanggal_lahir' => 'sometimes|required|date',

            'id_prometric' => 'nullable|string|max:255',
            'password_prometric' => 'nullable|string|max:255',
            'pernah_ke_jepang' => 'sometimes|required|in:Ya,Tidak',

            // FIELD BARU
            'pendidikan_terakhir' => 'sometimes|string|max:255',

            // FILE OPSIONAL saat update
            'paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bukti_pelunasan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijasah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_jft' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_ssw' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            // Pesan error
            'file.max' => 'Ukuran file melebihi batas.',
            'foto.max' => 'Ukuran foto melebihi batas 3MB.',
            'kk.max' => 'Ukuran KK melebihi batas 5MB.',
            'ktp.max' => 'Ukuran KTP melebihi batas 5MB.',
            'bukti_pelunasan.max' => 'Ukuran bukti pelunasan melebihi batas 5MB.',
            'akte.max' => 'Ukuran akte melebihi batas 5MB.',
            'ijasah.max' => 'Ukuran ijazah melebihi batas 5MB.',
            'sertifikat_jft.max' => 'Ukuran sertifikat JFT melebihi batas 5MB.',
            'sertifikat_ssw.max' => 'Ukuran sertifikat SSW melebihi batas 5MB.',
            'paspor.max' => 'Ukuran paspor melebihi batas 5MB.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali 08 dan memiliki 10–13 digit.',
            'status.in' => 'Status harus: belum menikah, menikah, atau lajang.',
        ]);


        // STATUS JFT
        if ($request->hasFile('sertifikat_jft')) {
            $data['status_jft'] = 'sudah ujian jft';
        } else {
            // jika sebelumnya sudah ada, jangan diturunkan
            $data['status_jft'] = $pendaftaran->sertifikat_jft
                ? 'sudah ujian jft'
                : 'belum ujian jft';
        }

        // STATUS SSW
        if ($request->hasFile('sertifikat_ssw')) {
            $data['status_ssw'] = 'sudah ujian ssw';
        } else {
            $data['status_ssw'] = $pendaftaran->sertifikat_ssw
                ? 'sudah ujian ssw'
                : 'belum ujian ssw';
        }
        /*
    |--------------------------------------------------------------------------
    | 1. Siapkan data text (exclude file fields)
    |--------------------------------------------------------------------------
    */
        $data = $request->except([
            '_token',
            '_method',
            'foto',
            'kk',
            'ktp',
            'paspor',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw'
        ]);


        /*
    |--------------------------------------------------------------------------
    | 2. Daftar file yang perlu diproses
    |--------------------------------------------------------------------------
    */
        $files = [
            'foto',
            'kk',
            'ktp',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw',
            'paspor'
        ];


        /*
    |--------------------------------------------------------------------------
    | 3. Upload file baru & hapus file lama
    |--------------------------------------------------------------------------
    */
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {

                // HAPUS FILE LAMA jika ada
                if (!empty($pendaftaran->$fileKey)) {
                    $oldFilePath = public_path($pendaftaran->$fileKey);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // UPLOAD FILE BARU
                $file = $request->file($fileKey);
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path("dokumen/{$fileKey}");

                // Pastikan folder ada
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                // Pindahkan file
                $file->move($destination, $filename);

                // Simpan path baru ke array $data
                $data[$fileKey] = "dokumen/{$fileKey}/{$filename}";
            }
        }
        // =======================
        // AUTO UPDATE STATUS JFT & SSW
        // =======================

        // Jika upload sertifikat JFT
        if ($request->hasFile('sertifikat_jft')) {
            $data['status_jft'] = 'sudah ujian jft';
        }

        // Jika upload sertifikat SSW
        if ($request->hasFile('sertifikat_ssw')) {
            $data['status_ssw'] = 'sudah ujian ssw';
        }

        /*
    |--------------------------------------------------------------------------
    | 4. Update Database
    |--------------------------------------------------------------------------
    */
        $pendaftaran->update($data);


        return redirect()
            ->route('siswa.index')
            ->with('success', 'Pendaftaran berhasil diperbarui!');
    }


    /*
|--------------------------------------------------------------------------
|  FUNGSI UNTUK CEK ADA FILE UPLOAD ATAU TIDAK
|--------------------------------------------------------------------------
*/
    private function hasAnyFile($request)
    {
        $fileFields = [
            'foto',
            'kk',
            'ktp',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw',
            'paspor'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                return true;
            }
        }

        return false;
    }





    public function exportPDF()
    {
        $pendaftarans = Pendaftaran::all();
        $pdf = FacadePdf::loadView('pendaftaran.pdf', compact('pendaftarans'));
        return $pdf->download('pendaftaran.pdf');
    }


    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Hapus user terkait jika ada
        if ($pendaftaran->user_id) {
            $pendaftaran->user()->delete();
        }

        // Hapus kandidat berdasarkan relasi pendataran_id
        if ($pendaftaran->kandidat) {
            $pendaftaran->kandidat()->delete();
        }

        // Hapus data pendaftaran
        $pendaftaran->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }


    // Export Data ke Excel
    public function export()
    {
        return Excel::download(new PendaftaranExport, 'data_pendaftaran.xlsx');
    }


    public function import(Request $request)
    {
        try {
            // 🚨 SOLUSI: Menaikkan batas waktu eksekusi hanya untuk fungsi ini
            set_time_limit(300); // 300 detik = 5 menit. Harusnya cukup.

            $request->validate([
                'file' => 'required|mimetypes:text/plain,text/csv,application/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048'
            ]);

            // Disable heading validation
            config(['excel.import.heading_error_formatter' => null]);

            Excel::import(new PendaftaranImport, $request->file('file'));

            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil diimport!'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status'  => false,
                'message' => "Import Error: " . $e->getMessage()
            ], 500);
        }
    }



    public function cvCreate()
    {
        return view('pendaftaran.cv');
    }

    public function show($id)
    {
        $kandidat = Pendaftaran::with('cabang')->findOrFail($id);
        return view('pendaftaran.show', compact('kandidat'));
    }
    public function showPendaftar($id)
    {
        $kandidat = Pendaftaran::with('cabang')->findOrFail($id);
        return view('pendaftaran.show', compact('kandidat'));
    }
}
