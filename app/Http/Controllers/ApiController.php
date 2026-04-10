<?php

namespace App\Http\Controllers;

use App\Http\Resources\PendaftaranResource;
use App\Models\Kandidat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPendaftaranDanKandidat(Request $request)
    {
        $query = Pendaftaran::with(['user', 'cabang', 'kandidat']);

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

        $pendaftaran = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => PendaftaranResource::collection($pendaftaran),
            'meta' => [
                'current_page' => $pendaftaran->currentPage(),
                'last_page' => $pendaftaran->lastPage(),
                'per_page' => $pendaftaran->perPage(),
                'total' => $pendaftaran->total(),
            ],
        ]);
    }

    public function getPendaftaranById($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'cabang', 'kandidat'])->find($id);

        if (! $pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PendaftaranResource($pendaftaran),
        ]);
    }

    public function getKandidat(Request $request)
    {
        $query = Kandidat::with(['pendaftaran', 'cabang', 'institusi']);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_kandidat', 'like', "%{$search}%")
                    ->orWhereHas('pendaftaran', function ($q) use ($search) {
                        $q->where('no_pendaftaran', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $kandidat = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $kandidat->items(),
            'meta' => [
                'current_page' => $kandidat->currentPage(),
                'last_page' => $kandidat->lastPage(),
                'per_page' => $kandidat->perPage(),
                'total' => $kandidat->total(),
            ],
        ]);
    }

    public function getKandidatById($id)
    {
        $kandidat = Kandidat::with(['pendaftaran', 'cabang', 'institusi', 'histories'])->find($id);

        if (! $kandidat) {
            return response()->json([
                'success' => false,
                'message' => 'Kandidat tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kandidat,
        ]);
    }
}
