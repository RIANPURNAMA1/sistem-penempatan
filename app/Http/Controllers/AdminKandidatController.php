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
        $roleName = $user->role ?? null; // role sekarang string langsung dari enum

        // Daftar role admin cabang
        $adminCabangRoles = [
            'Cabang Cianjur Selatan Mendunia',
            'Cabang Cianjur Pamoyanan Mendunia',
            'Cabang Batam Mendunia',
            'Cabang Banyuwangi Mendunia',
            'Cabang Kendal Mendunia',
            'Cabang Pati Mendunia',
            'Cabang Tulung Agung Mendunia',
            'Cabang Bangkalan Mendunia',
            'Cabang Bojonegoro Mendunia',
            'Cabang Jember Mendunia',
            'Cabang Wonosobo Mendunia',
            'Cabang Eshan Mendunia'
        ];

        // Jika bukan admin cabang, hentikan
        if (!in_array($roleName, $adminCabangRoles)) {
            abort(403, 'Unauthorized: Anda bukan admin cabang.');
        }

        // Ambil ID cabang sesuai role admin (role = nama cabang)
        $cabang = Cabang::where('nama_cabang', $roleName)->first();

        if (!$cabang) {
            abort(403, 'Cabang admin tidak ditemukan.');
        }

        // Ambil kandidat sesuai cabang admin
        $dataKandidat = Kandidat::where('cabang_id', $cabang->id)
            ->with(['cabang', 'pendaftaran', 'institusi'])
            ->get();

        // Ambil semua cabang untuk filter di view
        $cabangs = Cabang::all();

        return view('admin.kandidat.index', compact('dataKandidat', 'cabangs'));
    }
}
