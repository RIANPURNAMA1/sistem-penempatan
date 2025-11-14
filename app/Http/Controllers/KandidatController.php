<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Institusi;
use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\KandidatHistory;

class KandidatController extends Controller
{
    // Tampilkan semua kandidat
    public function index()
    {
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])
            ->where('status_kandidat', '!=', 'Ditolak')
            ->orderBy('created_at', 'desc')
            ->get();
        $cabangs = Cabang::all(); // ambil semua cabang untuk filter

        return view('kandidat.data', compact('kandidats', 'cabangs'));
    }

    // Form edit status interview
    public function edit($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        $institusis = Institusi::all();
        return view('kandidat.edit', compact('kandidat', 'institusis'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'status_kandidat' => 'required|in:Job Matching,Pending,Interview,Jadwalkan Interview Ulang,Lulus interview,Gagal Interview,Pemberkasan,Berangkat,Diterima,Ditolak',
        'institusi_id' => 'nullable|exists:institusis,id',
        'catatan_interview' => 'nullable|string',
        'jadwal_interview' => 'nullable|date',
    ]);

    $kandidat = Kandidat::findOrFail($id);

    /* ------------------------------------------------------------
     | Cegah perubahan status setelah Lulus interview
     ------------------------------------------------------------ */
    if ($kandidat->status_kandidat === 'Lulus interview') {

        $tidak_boleh = [
            'Interview',
            'Jadwalkan Interview Ulang',
            'Gagal Interview'
        ];

        if (in_array($request->status_kandidat, $tidak_boleh)) {
            return back()->with('error', 'Status tersebut tidak boleh dipilih setelah kandidat lulus interview.');
        }
    }

    /* ------------------------------------------------------------
     | Tambah jumlah interview jika gagal interview
     ------------------------------------------------------------ */
    if (
        $request->status_kandidat === 'Gagal Interview' &&
        $kandidat->status_kandidat !== 'Gagal Interview'
    ) {
        $kandidat->jumlah_interview += 1;
    }

    /* ------------------------------------------------------------
     | Simpan perubahan data kandidat
     ------------------------------------------------------------ */
    $kandidat->update([
        'status_kandidat' => $request->status_kandidat,
        'institusi_id' => $request->institusi_id,
        'catatan_interview' => $request->catatan_interview,
        'jadwal_interview' => $request->jadwal_interview,
        'jumlah_interview' => $kandidat->jumlah_interview,
    ]);

    /* ------------------------------------------------------------
     | SETIAP PERUBAHAN DATA → MASUK HISTORY
     ------------------------------------------------------------ */

    $statusInterview = match ($request->status_kandidat) {
        'Lulus interview'             => 'Selesai',
        'Gagal Interview'             => 'Gagal',
        'Interview', 
        'Jadwalkan Interview Ulang'   => 'Proses',
        default                       => 'Pending',
    };

    KandidatHistory::create([
        'kandidat_id'        => $kandidat->id,
        'status_kandidat'    => $kandidat->status_kandidat,
        'status_interview'   => $statusInterview,
        'institusi_id'       => $kandidat->institusi_id,
        'catatan_interview'  => $kandidat->catatan_interview,
        'jadwal_interview'   => $kandidat->jadwal_interview,
    ]);

    return redirect()->route('kandidat.data')
        ->with('success', 'Data kandidat berhasil diperbarui & history tersimpan.');
}



    // Tampilkan history kandidat
    public function history($id)
    {
        $kandidat = Kandidat::with('pendaftaran')->findOrFail($id);
        $histories = $kandidat->histories()->with('institusi')->orderBy('created_at', 'desc')->get();

        return view('kandidat.history', compact('kandidat', 'histories'));
    }
}
