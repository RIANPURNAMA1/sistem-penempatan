<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KandidatHistoryController extends Controller
{
    public function showHistory()
    {
        $user = Auth::user();

        // Ambil kandidat yang terkait user
        $kandidat = $user->kandidat;

        if (!$kandidat) {
            return view('kandidat.history.index', [
                'histories' => collect(),
                'interviewPerPerusahaan' => collect()
            ]);
        }

        // Ambil semua history kandidat terbaru dulu
        $histories = $kandidat->histories()->latest()->get();

        // Summary interview per perusahaan
        $interviewPerPerusahaan = $histories
            ->groupBy('institusi_id') // group berdasarkan institusi
            ->map(function ($items, $institusi_id) {
                $latest = $items->sortByDesc('created_at')->first(); // data terakhir

                // Ambil bidang SSW dari history terakhir (bisa berupa array atau string)
                $bidangSsw = $latest->bidang_ssw ?? [];

                // Jika sebelumnya disimpan sebagai string, ubah jadi array agar konsisten
                if (!is_array($bidangSsw) && !empty($bidangSsw)) {
                    $bidangSsw = explode(', ', $bidangSsw);
                }

                return [
                    'institusi' => $latest->institusi,
                    'nama_perusahaan_history' => $latest->kandidat->nama_perusahaan ?? null,
                    'bidang_ssw' => $bidangSsw, // Tambahkan bidang SSW
                    // Hanya hitung status "Interview" sebagai jumlah interview
                    'jumlah_interview' => $items->where('status_kandidat', 'Interview')->count(),
                    'status_terakhir' => $latest->status_kandidat,
                    'tanggal_terakhir' => $latest->created_at,
                ];
            })->values(); // reset index

        return view('kandidat.history.index', compact('histories', 'interviewPerPerusahaan', 'kandidat'));
    }
}
