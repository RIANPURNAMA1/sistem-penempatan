<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function show($id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $kandidat = Pendaftaran::find($id);

        // Jika tidak ditemukan
        if (!$kandidat) {
            return view('dokumen.show', ['kandidat' => null]);
        }

        // Kirim ke view dokumen
        return view('dokumen.show', compact('kandidat'));
    }
}
