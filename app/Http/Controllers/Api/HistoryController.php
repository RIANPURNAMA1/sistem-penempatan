<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KandidatHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = KandidatHistory::with(['kandidat', 'institusi']);

        if ($request->has('kandidat_id') && $request->kandidat_id) {
            $query->where('kandidat_id', $request->kandidat_id);
        }

        $history = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $history->map(fn ($h) => [
                'id' => $h->id,
                'kandidat_id' => $h->kandidat_id,
                'status_kandidat' => $h->status_kandidat,
                'status_interview' => $h->status_interview,
                'institusi_id' => $h->institusi_id,
                'catatan_interview' => $h->catatan_interview,
                'jadwal_interview' => $h->jadwal_interview,
                'bidang_ssw' => $h->bidang_ssw,
                'nama_perusahaan' => $h->nama_perusahaan,
                'detail_pekerjaan' => $h->detail_pekerjaan,
                'created_at' => $h->created_at,
                'updated_at' => $h->updated_at,
                'kandidat' => $h->kandidat ? [
                    'id' => $h->kandidat->id,
                    'no_kandidat' => $h->kandidat->no_kandidat,
                    'nama' => $h->kandidat->nama,
                ] : null,
                'institusi' => $h->institusi ? [
                    'id' => $h->institusi->id,
                    'nama' => $h->institusi->nama,
                ] : null,
            ]),
        ]);
    }

    public function show($id)
    {
        $history = KandidatHistory::with(['kandidat', 'institusi'])->find($id);

        if (! $history) {
            return response()->json([
                'success' => false,
                'message' => 'History tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $history->id,
                'kandidat_id' => $history->kandidat_id,
                'status_kandidat' => $history->status_kandidat,
                'status_interview' => $history->status_interview,
                'institusi_id' => $history->institusi_id,
                'catatan_interview' => $history->catatan_interview,
                'jadwal_interview' => $history->jadwal_interview,
                'bidang_ssw' => $history->bidang_ssw,
                'nama_perusahaan' => $history->nama_perusahaan,
                'detail_pekerjaan' => $history->detail_pekerjaan,
                'created_at' => $history->created_at,
                'updated_at' => $history->updated_at,
                'kandidat' => $history->kandidat ? [
                    'id' => $history->kandidat->id,
                    'no_kandidat' => $history->kandidat->no_kandidat,
                    'nama' => $history->kandidat->nama,
                ] : null,
                'institusi' => $history->institusi ? [
                    'id' => $history->institusi->id,
                    'nama' => $history->institusi->nama,
                ] : null,
            ],
        ]);
    }
}
