<?php

namespace App\Http\Controllers;

use App\Mail\StatusKandidatUpdated;
use App\Models\Cabang;
use App\Models\Institusi;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\KandidatHistory;
use Illuminate\Support\Facades\Mail;

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
        'status_kandidat' => 'required|in:Job Matching,Pending,Interview,Jadwalkan Interview Ulang,Lulus interview,Gagal Interview,Pemberkasan,Berangkat,Diterima,Ditolak',
        'institusi_id' => 'nullable|exists:institusis,id',
        'catatan_interview' => 'nullable|string',
        'jadwal_interview' => 'nullable|date',
    ]);

    /* ------------------------------------------------------------
    | Ambil data kandidat + pendaftaran
    ------------------------------------------------------------ */
    $kandidat = Kandidat::with('pendaftaran')->findOrFail($id);
    $status_lama = $kandidat->status_kandidat;

    /* ------------------------------------------------------------
    | Validasi interview wajib tanggal
    ------------------------------------------------------------ */
    if (
        in_array($request->status_kandidat, ['Interview', 'Jadwalkan Interview Ulang']) &&
        empty($request->jadwal_interview)
    ) {
        return back()
            ->withErrors(['jadwal_interview' => 'Tanggal interview wajib diisi.'])
            ->withInput();
    }

    /* ------------------------------------------------------------
    | Larangan setelah lulus
    ------------------------------------------------------------ */
    if ($status_lama === 'Lulus interview') {
        $dilarang = ['Interview', 'Jadwalkan Interview Ulang', 'Gagal Interview'];

        if (in_array($request->status_kandidat, $dilarang)) {
            return back()->with('error', 'Tidak boleh mengubah status setelah kandidat lulus.');
        }
    }
   
     /* ------------------------------------------------------------
    | Larangan update setelah Pemberkasan atau Berangkat
    ------------------------------------------------------------ */
    if (in_array($status_lama, ['Pemberkasan', 'Berangkat'])) {
        $dilarangSetelahAkhir = ['Interview', 'Jadwalkan Interview Ulang', 'Gagal Interview', 'Lulus interview', 'Job Matching', 'Pending', 'Ditolak', 'Ditolak'];
        if (in_array($request->status_kandidat, $dilarangSetelahAkhir)) {
            return back()->with('error', 'Tidak boleh mengubah status setelah kandidat masuk tahap Pemberkasan atau Berangkat.');
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
        'status_interview' => $statusInterview,
        'institusi_id' => $kandidat->institusi_id,
        'catatan_interview' => $kandidat->catatan_interview,
        'jadwal_interview' => $kandidat->jadwal_interview,
    ]);

    /* ------------------------------------------------------------
    | 🔔 Kirim WhatsApp
    ------------------------------------------------------------ */
    $noWa = $kandidat->pendaftaran->no_wa ?? null;
    $nama = $kandidat->pendaftaran->nama ?? $kandidat->nama;

    if (!empty($noWa)) {
        $noWa = preg_replace('/^08/', '628', $noWa);

        $pesan = "
Halo *{$nama}* 👋

Status Anda diperbarui.

📌 Status Baru: {$request->status_kandidat}
🕓 Tanggal Update: " . now()->format('d M Y H:i') . "

Silakan cek portal.
Terima kasih 🙏
        ";

        \App\Services\FonnteService::sendMessage($noWa, $pesan);
    }

    /* ------------------------------------------------------------
    | 📧 Kirim Email Notifikasi
    ------------------------------------------------------------ */
    $email = $kandidat->pendaftaran->email ?? null;

    if (!empty($email)) {
        Mail::to($email)->send(new StatusKandidatUpdated(
            $nama,
            $request->status_kandidat,
            now()->format('d M Y H:i'),
            $request->catatan_interview
        ));
    }

 /* ------------------------------------------------------------
| Redirect diubah menjadi JSON Response
------------------------------------------------------------ */
return response()->json([
    'success' => true,
    'message' => 'Status diperbarui, WA & email terkirim.',
    'redirect' => route('kandidat.data') // opsional, kalau mau diarahkan setelah AJAX
]);

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

                'status_terakhir' => $last->status_kandidat,
                'tanggal_terakhir' => $last->created_at,
            ];
        });

    return view('kandidat.history', compact('kandidat', 'histories', 'interviewPerPerusahaan'));
}





}
