<?php

namespace App\Http\Controllers;

use App\Exports\KandidatExport;
use App\Mail\StatusKandidatUpdated;
use App\Models\BidangSsw;
use App\Models\Cabang;
use App\Models\Institusi;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\KandidatHistory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class KandidatController extends Controller
{
 public function index(Request $request)
{
    // Query dasar
    $query = Kandidat::with(['pendaftaran.bidang_ssws', 'cabang', 'institusi'])
        ->where('status_kandidat', '!=', 'Ditolak')
        ->orderBy('created_at', 'desc');

    // Filter Cabang
    if ($request->has('f_cabang') && !empty($request->f_cabang)) {
        $query->whereHas('cabang', function($q) use ($request) {
            $q->whereIn('nama_cabang', $request->f_cabang);
        });
    }

    // Filter Bidang SSW
    if ($request->has('f_ssw') && !empty($request->f_ssw)) {
        $query->whereHas('pendaftaran.bidang_ssws', function($q) use ($request) {
            $q->whereIn('nama_bidang', $request->f_ssw);
        });
    }

    // Filter Status Kandidat
    if ($request->has('f_status') && !empty($request->f_status)) {
        $query->whereIn('status_kandidat', $request->f_status);
    }

    // Filter Pendidikan
    if ($request->has('f_edu') && !empty($request->f_edu)) {
        $query->whereHas('pendaftaran', function($q) use ($request) {
            $q->whereIn('pendidikan_terakhir', $request->f_edu);
        });
    }

    // Filter Jenis Kelamin
    if ($request->has('f_jk') && !empty($request->f_jk)) {
        $query->whereHas('pendaftaran', function($q) use ($request) {
            $q->whereIn('jenis_kelamin', $request->f_jk);
        });
    }

    // Filter Pengalaman (Eks-Jepang)
    if ($request->has('f_eks') && !empty($request->f_eks)) {
        $query->whereHas('pendaftaran', function($q) {
            $q->where('pernah_ke_jepang', 'Ya')
              ->orWhere('pernah_ke_jepang', 'like', '%ya%');
        });
    }

    // Filter Rentang Umur
    if ($request->has('age_min') && $request->age_min != '') {
        $query->whereHas('pendaftaran', function($q) use ($request) {
            $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= ?', [$request->age_min]);
        });
    }

    if ($request->has('age_max') && $request->age_max != '') {
        $query->whereHas('pendaftaran', function($q) use ($request) {
            $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= ?', [$request->age_max]);
        });
    }

    // Eksekusi query
    $kandidats = $query->get();

    // Data cabang untuk dropdown
    $cabangs = Cabang::all();

    // List bidang SSW
    $list_bidang = [
        'Pengolahan makanan',
        'Restoran',
        'Pertanian',
        'Kaigo (perawat)',
        'Building cleaning',
        'Driver'
    ];

    // Statistik SSW
    $statistik_ssw = [];
    foreach ($list_bidang as $bidang) {
        $filtered = $kandidats->filter(function ($kandidat) use ($bidang) {
            if (!$kandidat->pendaftaran) return false;
            return $kandidat->pendaftaran->bidang_ssws->contains('nama_bidang', $bidang);
        });

        $statistik_ssw[$bidang] = [
            'total' => $filtered->count(),
            'L' => $filtered->where('pendaftaran.jenis_kelamin', 'Laki-laki')->count(),
            'P' => $filtered->where('pendaftaran.jenis_kelamin', 'Perempuan')->count(),
        ];
    }

    return view('kandidat.data', compact('kandidats', 'cabangs', 'statistik_ssw'));
}

    // Form edit status interview
    public function edit($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        $institusis = Institusi::all();
        return view('kandidat.edit', compact('kandidat', 'institusis'));
    }


    // update kandidat di mendunia
    /**
     * Tampilkan form edit status_kandidat_di_mendunia
     */
    public function editKandidatMendunia(Kandidat $kandidat)
    {
        return view('kandidat.edit-mendunia', compact('kandidat'));
    }

    /**
     * Update status_kandidat_di_mendunia
     */
    public function updateKandidatMendunia(Request $request, Kandidat $kandidat)
    {
        $request->validate([
            'status_kandidat_di_mendunia' =>
            'required|in:Tetap di Mendunia,Keluar dari Mendunia,Sudah Terbang',
        ]);

        $kandidat->update([
            'status_kandidat_di_mendunia' => $request->status_kandidat_di_mendunia,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status kandidat di Mendunia berhasil diperbarui.');
    }

    public function update(Request $request, $id)
    {
        /* ------------------------------------------------------------
    | Validasi
    ------------------------------------------------------------ */
        $request->validate([
            'status_kandidat' => 'required|in:Job Matching,Pending,Interview,Jadwalkan Interview Ulang,Lulus interview,Gagal Interview,Pemberkasan,Berangkat,Ditolak,lamar ke perusahaan',
            'institusi_id' => 'nullable|exists:institusis,id',
            'catatan_interview' => 'nullable|string',
            'jadwal_interview' => 'nullable|date',
            'nama_perusahaan' => 'nullable|string',
            'bidang_ssw' => 'required',
            'tgl_setsumeikai_ichijimensetsu' => 'nullable|date',
            'tgl_mensetsu' => 'nullable|date',
            'tgl_mensetsu2' => 'nullable|date',
            'catatan_mensetsu' => 'nullable|string',
            'biaya_pemberkasan' => 'nullable|string',
            'adm_tahap1' => 'nullable|string',
            'adm_tahap2' => 'nullable|string',
            'dokumen_dikirim_soft_file' => 'nullable|date',
            'terbit_kontrak_kerja' => 'nullable|date',
            'kontrak_dikirim_ke_tsk' => 'nullable|date',
            'terbit_paspor' => 'nullable|date',
            'masuk_imigrasi_jepang' => 'nullable|date',
            'coe_terbit' => 'nullable|date',
            'pembuatan_ektkln' => 'nullable|date',
            'dokumen_dikirim' => 'nullable|date',
            'visa' => 'nullable|date',
            'jadwal_penerbangan' => 'nullable|date',
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
            'nama_perusahaan' => $request->nama_perusahaan,
            'jumlah_interview' => $kandidat->jumlah_interview,
            'tgl_setsumeikai_ichijimensetsu' => $request->tgl_setsumeikai_ichijimensetsu,
            'tgl_mensetsu' => $request->tgl_mensetsu,
            'tgl_mensetsu2' => $request->tgl_mensetsu2,
            'catatan_mensetsu' => $request->catatan_mensetsu,
            'biaya_pemberkasan' => $request->biaya_pemberkasan,
            'adm_tahap1' => $request->adm_tahap1,
            'adm_tahap2' => $request->adm_tahap2,
            'dokumen_dikirim_soft_file' => $request->dokumen_dikirim_soft_file,
            'terbit_kontrak_kerja' => $request->terbit_kontrak_kerja,
            'kontrak_dikirim_ke_tsk' => $request->kontrak_dikirim_ke_tsk,
            'terbit_paspor' => $request->terbit_paspor,
            'masuk_imigrasi_jepang' => $request->masuk_imigrasi_jepang,
            'coe_terbit' => $request->coe_terbit,
            'pembuatan_ektkln' => $request->pembuatan_ektkln,
            'dokumen_dikirim' => $request->dokumen_dikirim,
            'visa' => $request->visa,
            'jadwal_penerbangan' => $request->jadwal_penerbangan,
        ]);

        $bidang_id = $request->input('bidang_ssw');

        // Hapus bidang SSW lama untuk kandidat
        $kandidat->bidang_ssws()->delete();

        // Simpan bidang SSW yang dipilih
        $bidang = $kandidat->pendaftaran->bidang_ssws()->find($bidang_id);
        if ($bidang) {
            BidangSsw::create([
                'kandidat_id' => $kandidat->id,
                'pendaftaran_id' => $kandidat->pendaftaran_id,
                'nama_bidang' => $bidang->nama_bidang,
            ]);
        }

        /* ------------------------------------------------------------
    | Simpan History
    ------------------------------------------------------------ */
        $statusInterview = match ($request->status_kandidat) {
            'Lulus interview' => 'Selesai',
            'Gagal Interview' => 'Gagal',
            'Interview', 'Jadwalkan Interview Ulang' => 'Proses',
            default => 'Pending',
        };

        $bidangId = $request->bidang_ssw;
        $bidang = BidangSsw::find($bidangId);
        $bidangNama = $bidang ? $bidang->nama_bidang : null;

        KandidatHistory::create([
            'kandidat_id' => $kandidat->id,
            'status_kandidat' => $kandidat->status_kandidat,
            'nama_perusahaan' => $kandidat->nama_perusahaan,
            'status_interview' => $statusInterview,
            'institusi_id' => $kandidat->institusi_id,
            'catatan_interview' => $kandidat->catatan_interview,
            'jadwal_interview' => $kandidat->jadwal_interview,
            'bidang_ssw' => $bidangNama,
        ]);

        /* ------------------------------------------------------------
    | 📞 Persiapan Data Umum
    ------------------------------------------------------------ */
        $noWa = $kandidat->pendaftaran->no_wa ?? null;
        $nama = $kandidat->pendaftaran->nama ?? $kandidat->nama;
        $email = $kandidat->pendaftaran->email ?? null;

        /* ------------------------------------------------------------
    | ✅ CEK APAKAH STATUS KANDIDAT BERUBAH
    ------------------------------------------------------------ */
        $statusBerubah = ($status_lama !== $request->status_kandidat);

        // Hanya kirim notifikasi jika status benar-benar berubah
        if ($statusBerubah) {

            // Teks pesan WA
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
        | 🔔 Kirim WhatsApp via Fonnte (FIXED dengan HTTP Client)
        ------------------------------------------------------------ */
            if (!empty($noWa)) {
                try {
                    // ===== Token Fonnte =====
                    $token = env('FONNTE_TOKEN');
                    if (!$token) {
                        Log::error('FONNTE_TOKEN belum diset');
                        throw new \Exception('FONNTE_TOKEN tidak valid');
                    }

                    // ===== Format nomor WA kandidat =====
                    $noWaFormatted = preg_replace('/\D/', '', $noWa);
                    if (str_starts_with($noWaFormatted, '0')) {
                        $noWaFormatted = '62' . substr($noWaFormatted, 1);
                    }

                    Log::info("Mencoba mengirim WA ke kandidat: {$noWaFormatted}");

                    // ===== Kirim via Fonnte menggunakan Laravel HTTP Client =====
                    $response = Http::withHeaders([
                        'Authorization' => $token,
                    ])->asForm()->post('https://api.fonnte.com/send', [
                        'target'  => $noWaFormatted,
                        'message' => $pesanWa,
                        'delay'   => 2,
                    ]);

                    // ===== Cek response =====
                    if ($response->successful()) {
                        $responseData = $response->json();

                        if (isset($responseData['status']) && $responseData['status'] == true) {
                            Log::info("✅ WA ke kandidat {$noWaFormatted} berhasil dikirim");
                        } else {
                            $errorMsg = $responseData['reason'] ?? $responseData['message'] ?? 'Unknown error';
                            Log::error("❌ Fonnte Error: {$errorMsg}", [
                                'response' => $response->body()
                            ]);
                        }
                    } else {
                        Log::error("❌ WA ke kandidat {$noWaFormatted} gagal dikirim", [
                            'status' => $response->status(),
                            'response' => $response->body()
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error("❌ Exception kirim WA ke kandidat: " . $e->getMessage());
                    Log::error("Stack trace: " . $e->getTraceAsString());
                }
            }

            /* ------------------------------------------------------------
        | 📧 Kirim Email Notifikasi
        ------------------------------------------------------------ */
            if (!empty($email)) {
                try {
                    Mail::to($email)->send(new StatusKandidatUpdated(
                        $nama,
                        $request->status_kandidat,
                        now()->format('d M Y H:i'),
                        $request->catatan_interview
                    ));
                    Log::info("✅ Email notifikasi berhasil dikirim ke {$email}");
                } catch (\Exception $e) {
                    Log::error("❌ Gagal kirim email ke {$email}: " . $e->getMessage());
                }
            }

            /* ------------------------------------------------------------
        | JSON Response sukses dengan notifikasi
        ------------------------------------------------------------ */
            return response()->json([
                'success' => true,
                'message' => 'Status kandidat berhasil diperbarui. Notifikasi WA & Email telah dikirim ke kandidat.',
                'redirect' => route('kandidat.data')
            ]);
        } else {
            /* ------------------------------------------------------------
        | JSON Response sukses tanpa notifikasi
        ------------------------------------------------------------ */
            return response()->json([
                'success' => true,
                'message' => 'Data kandidat berhasil diperbarui (tanpa perubahan status, notifikasi tidak dikirim).',
                'redirect' => route('kandidat.data')
            ]);
        }
    }





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
                    'nama_perusahaan_history' => $last->nama_perusahaan,

                    'status_terakhir' => $last->status_kandidat,
                    'tanggal_terakhir' => $last->created_at,

                    'bidang_ssw' => $last->bidang_ssw, // <-- tambahkan ini
                ];
            });

        return view('kandidat.history', compact('kandidat', 'histories', 'interviewPerPerusahaan'));
    }



    // details
    public function show(Kandidat $kandidat)
    {
        // Load relasi yang diperlukan
        $kandidat->load(['pendaftaran', 'cabang', 'bidang_ssws', 'institusi']);

        return view('kandidat.showFull', compact('kandidat'));
    }


    public function export(Kandidat $kandidat)
    {
        // 1. Tentukan nama file
        // Menggunakan nama kandidat dari relasi pendaftaran untuk nama file
        $namaKandidat = $kandidat->pendaftaran->nama ?? 'Unknown';
        $fileName = 'Kandidat_' . $namaKandidat . '_' . now()->format('Ymd') . '.xlsx';

        // 2. Lakukan unduhan
        // Mengirimkan ID kandidat ke KandidatExport
        return Excel::download(new KandidatExport($kandidat->id), $fileName);
    }

    // Anda bisa menambahkan fungsi exportAll() jika diperlukan
    public function exportAll()
    {
        $fileName = 'Semua_Kandidat_' . now()->format('Ymd') . '.xlsx';
        return Excel::download(new KandidatExport(), $fileName);
    }
}
