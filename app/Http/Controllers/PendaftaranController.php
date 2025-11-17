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
         // Cek apakah user sudah mendaftar
    $alreadyRegistered = Pendaftaran::where('user_id', Auth::id())->exists();
        return view('pendaftaran.index', compact('cabangs', 'alreadyRegistered'));
    }

    public function store(Request $request)
    {
        // Cek apakah user sudah mendaftar sebelumnya
        $existing = Pendaftaran::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda sudah melakukan pendaftaran sebelumnya.');
        }

        // Validasi semua field wajib
        $request->validate([
            'nik' => 'required|string|size:16|unique:pendaftarans,nik',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => ['required', 'string', 'max:20', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:500',
            'provinsi' => 'required|string|max:100',
            'kab_kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'cabang_id' => 'required|exists:cabangs,id',
            'tanggal_daftar' => 'required|date',
            'foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bukti_pelunasan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijasah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Upload file
        $foto = $request->file('foto')->store('uploads/foto', 'public');
        $kk = $request->file('kk')->store('uploads/kk', 'public');
        $ktp = $request->file('ktp')->store('uploads/ktp', 'public');
        $bukti_pelunasan = $request->file('bukti_pelunasan')->store('uploads/bukti_pelunasan', 'public');
        $akte = $request->file('akte')->store('uploads/akte', 'public');
        $ijasah = $request->file('ijasah')->store('uploads/ijasah', 'public');

        // Simpan data
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'cabang_id' => $request->cabang_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_daftar' => $request->tanggal_daftar,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kab_kota' => $request->kab_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'foto' => $foto,
            'kk' => $kk,
            'ktp' => $ktp,
            'bukti_pelunasan' => $bukti_pelunasan,
            'akte' => $akte,
            'ijasah' => $ijasah,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }



    // 🟡 Tampilkan semua data kandidat
    public function DataKandidat()
    {
        $kandidats = Pendaftaran::with('cabang')
            ->orderBy('created_at', 'desc') // data terbaru di atas
            ->paginate(10); // <- paginate, bukan get

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
        // Validasi input
        $request->validate([
            'verifikasi' => 'required|string|in:menunggu,data belum lengkap,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        // Ambil data pendaftaran
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update verifikasi dan catatan admin
        $pendaftaran->update([
            'verifikasi' => $request->verifikasi,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $message = 'Data verifikasi berhasil diperbarui!';

        // Jika status diterima, buat kandidat jika belum ada
        if ($request->verifikasi === 'diterima') {
            Kandidat::firstOrCreate(
                ['pendaftaran_id' => $pendaftaran->id],
                [
                    'cabang_id'       => $pendaftaran->cabang_id,
                    'status_kandidat' => 'Job Matching',
                    'institusi_id'    => null,
                ]
            );

            $message = 'Data verifikasi berhasil diperbarui dan kandidat dibuat!';
        }

        // Jika AJAX request, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ]);
        }

        // Jika request biasa, redirect
        if ($request->verifikasi === 'diterima') {
            return redirect()->route('kandidat.data')->with('success', $message);
        }

        return redirect()->back()->with('success', $message);
    }




    // Tampilkan halaman kandidat
    public function Kandidat()
    {
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])->latest('id');
        return view('kandidat.data', compact('kandidats'));
    }
}
