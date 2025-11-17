<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;

class AdminKandidatController extends Controller
{
 public function index(Request $request)
    {
        $user = Auth::user();

        // Pastikan user memiliki role admin cabang
        $roleName = $user->role->name ?? null;

        if (!in_array($roleName, ['admin cianjur pamoyanan', 'admin cianjur selatan'])) {
            abort(403, 'Unauthorized: Anda bukan admin cabang.');
        }

        // Tentukan keyword cabang berdasarkan role
        switch ($roleName) {
            case 'admin cianjur selatan':
                $cabangKeyword = 'selatan';
                break;
            case 'admin cianjur pamoyanan':
                $cabangKeyword = 'pamoyanan';
                break;
            default:
                $cabangKeyword = null;
                break;
        }

        // Ambil ID cabang sesuai keyword
        $cabangIds = Cabang::when($cabangKeyword, function ($query) use ($cabangKeyword) {
            $query->where('nama_cabang', 'like', "%{$cabangKeyword}%");
        })->pluck('id');

        // Jika cabang tidak ditemukan, hentikan
        if ($cabangIds->isEmpty()) {
            abort(403, 'Cabang admin tidak ditemukan.');
        }

        // Ambil kandidat sesuai cabang admin
        $dataKandidat = Kandidat::whereIn('cabang_id', $cabangIds)
            ->with(['cabang', 'pendaftaran', 'institusi'])
            ->get();

        // Ambil semua cabang untuk filter di view
        $cabangs = Cabang::all();

        return view('admin.kandidat.index', compact('dataKandidat', 'cabangs'));
    }


}
