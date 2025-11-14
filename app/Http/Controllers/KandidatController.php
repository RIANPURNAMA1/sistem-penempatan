<?php

namespace App\Http\Controllers;

use App\Models\Institusi;
use Illuminate\Http\Request;
use App\Models\Kandidat;

class KandidatController extends Controller
{
    // Tampilkan semua kandidat
    public function index()
    {
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])
            ->where('status_kandidat', '!=', 'Ditolak') // hanya yang diterima/Job Matching/Berangkat
            ->orderBy('created_at', 'desc')
            ->get();

        return view('kandidat.data', compact('kandidats'));
    }

    // Form edit status interview
   public function edit($id)
{
    $kandidat = Kandidat::findOrFail($id);
    $institusis = Institusi::all(); // ambil data institusi
    return view('kandidat.edit', compact('kandidat', 'institusis'));
}


  // Update status interview dan institusi
public function update(Request $request, $id)
{
    $request->validate([
        'status_interview' => 'required|in:Pending,Selesai,Gagal,Jadwalkan Interview Ulang',
        'catatan_interview' => 'nullable|string|max:500',
        'jadwal_interview' => 'nullable|date',
        'institusi_id' => 'nullable|exists:institusis,id', // validasi institusi
    ]);

    $kandidat = Kandidat::findOrFail($id);
    $kandidat->update([
        'status_interview' => $request->status_interview,
        'catatan_interview' => $request->catatan_interview,
        'jadwal_interview' => $request->jadwal_interview,
        'institusi_id' => $request->institusi_id, // update institusi / penempatan
        'jumlah_interview' => $kandidat->jumlah_interview + 1, // increment interview
    ]);

    return redirect()->route('kandidat.data')
        ->with('success', 'Status interview dan penempatan berhasil diperbarui!');
}

}
