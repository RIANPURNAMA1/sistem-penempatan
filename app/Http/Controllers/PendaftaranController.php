<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Cabang;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // 🟢 Menampilkan form pendaftaran
    public function datacabang()
    {
        $cabangs = Cabang::all();
        return view('pendaftaran.index', compact('cabangs'));
    }

    // 🟢 Simpan data pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_wa' => 'required|string|max:20',
            'jenis_kelamin' => 'required|string',
            'cabang_id' => 'required|exists:cabangs,id',
            'tanggal_daftar' => 'required|date',
            'alamat' => 'required|string',
            'foto' => 'required|file|mimes:jpg,jpeg,png',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'bukti_pelunasan' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'akte' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'izasah' => 'required|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Upload file
        $foto = $request->file('foto')->store('uploads/foto', 'public');
        $kk = $request->file('kk')->store('uploads/kk', 'public');
        $ktp = $request->file('ktp')->store('uploads/ktp', 'public');
        $bukti_pelunasan = $request->file('bukti_pelunasan')->store('uploads/bukti_pelunasan', 'public');
        $akte = $request->file('akte')->store('uploads/akte', 'public');
        $izasah = $request->file('izasah')->store('uploads/izasah', 'public');

        // Simpan data
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'cabang_id' => $request->cabang_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_daftar' => $request->tanggal_daftar,
            'alamat' => $request->alamat,
            'foto' => $foto,
            'kk' => $kk,
            'ktp' => $ktp,
            'bukti_pelunasan' => $bukti_pelunasan,
            'akte' => $akte,
            'izasah' => $izasah,
            
        ]);

        return redirect()->route('pendaftaran.create')
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    // 🟡 Tampilkan semua data kandidat
    public function DataKandidat()
    {
        $kandidats = Pendaftaran::with('cabang')->get();
        $cabang = Cabang::all();
        return view('siswa.index', compact('kandidats', 'cabang'));
    }

    // 🟠 Form Edit (hanya verifikasi & catatan admin)
    public function edit($id)
    {
        $kandidat = Pendaftaran::findOrFail($id);
        return view('siswa.edit', compact('kandidat'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'verifikasi' => 'required|string|in:menunggu,data belum lengkap,diterima,ditolak',
        'catatan_admin' => 'nullable|string|max:500',
    ]);

    $pendaftaran = Pendaftaran::findOrFail($id);
    $pendaftaran->update([
        'verifikasi' => $request->verifikasi,
        'catatan_admin' => $request->catatan_admin,
    ]);

    // Jika diterima, otomatis buat entry di kandidat
    if ($request->verifikasi === 'diterima') {
        if (!Kandidat::where('pendaftaran_id', $pendaftaran->id)->exists()) {
            Kandidat::create([
                'pendaftaran_id' => $pendaftaran->id,
                'cabang_id' => $pendaftaran->cabang_id,
                'status_kandidat' => 'Job Matching',
                'status_interview' => 'Pending',
                'institusi_id' => null,
                'interview_id' => 0,
            ]);
        }
    }

    return redirect()->route('kandidat.data')->with('success', 'Data verifikasi berhasil diperbarui!');
}

// Tampilkan halaman kandidat
public function Kandidat()
{
    $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])->get();
    return view('kandidat.data', compact('kandidats'));
}
}
