<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use Illuminate\Http\Request; // ⬅️ Tambahkan ini!

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data pendaftaran berdasarkan user login
        $dataKandidat = Pendaftaran::with('cabang')
            ->where('user_id', Auth::id())
            ->get();

        // Kirim ke view
        return view('dashboard', compact('dataKandidat'));
    }

    public function DataKandidat(Request $request)
    {
        $cabang = Cabang::all();

        $query = Pendaftaran::with('cabang');

        if ($request->has('cabang_id') && $request->cabang_id != '') {
            $query->where('cabang_id', $request->cabang_id);
        }

        $kandidats = $query->get();

        return view('siswa.index', compact('kandidats', 'cabang'));
    }

}
