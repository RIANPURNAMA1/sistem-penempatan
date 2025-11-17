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

    // Pastikan yang akses adalah admin cabang
    if (!in_array($user->role->name, ['admin cianjur', 'admin cianjur selatan'])) {
        abort(403, 'Unauthorized');
    }

    // Tentukan keyword cabang berdasarkan role
    if ($user->role->name === 'admin cianjur selatan') {
        $cabangKeyword = 'selatan';
    } elseif ($user->role->name === 'admin cianjur') {
        $cabangKeyword = 'pamoyanan';
    } else {
        $cabangKeyword = null;
    }

    // Ambil ID cabang sesuai keyword
    $cabangIds = Cabang::when($cabangKeyword, function($query) use ($cabangKeyword) {
        $query->where('nama_cabang', 'like', "%{$cabangKeyword}%");
    })->pluck('id');

    // Ambil kandidat sesuai cabang
    $dataKandidat = Kandidat::whereIn('cabang_id', $cabangIds)
                            ->with(['cabang', 'pendaftaran', 'institusi'])
                            ->get();

    // Ambil semua cabang untuk filter di view
    $cabangs = Cabang::all();

    return view('admin.kandidat.index', compact('dataKandidat', 'cabangs'));
}

}
