<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PendaftaranKandidatResource;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'cabang', 'kandidat', 'kandidat.institusi', 'kandidat.bidang_ssws']);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_pendaftaran', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pendaftaran = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => PendaftaranKandidatResource::collection($pendaftaran),
        ]);
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'cabang', 'kandidat', 'kandidat.institusi', 'kandidat.bidang_ssws'])->find($id);

        if (! $pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PendaftaranKandidatResource($pendaftaran),
        ]);
    }
}
