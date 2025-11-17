<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
     public function index()
    {
        // Ambil semua kandidat dengan status Lulus atau Gagal Interview
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])
            ->whereIn('status_kandidat', ['Lulus interview', 'Gagal Interview'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('interview.index', compact('kandidats'));
    }
}
