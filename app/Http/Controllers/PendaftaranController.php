<?php

namespace App\Http\Controllers;

use App\Exports\KandidatExport;
use App\Exports\PendaftaranExport;
use App\Imports\PendaftaranImport;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Cabang;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
        // Validasi
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

            'foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'bukti_pelunasan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'akte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
            'ijasah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:51200',
        ]);

        // Upload manual tanpa storage link
        $foto = $this->uploadFile($request->file('foto'), 'uploads/foto');
        $kk = $this->uploadFile($request->file('kk'), 'uploads/kk');
        $ktp = $this->uploadFile($request->file('ktp'), 'uploads/ktp');
        $bukti_pelunasan = $this->uploadFile($request->file('bukti_pelunasan'), 'uploads/bukti_pelunasan');
        $akte = $this->uploadFile($request->file('akte'), 'uploads/akte');
        $ijasah = $this->uploadFile($request->file('ijasah'), 'uploads/ijasah');

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

    /**
     * Upload file manual tanpa storage:link
     */
    private function uploadFile($file, $path)
    {
        // Pastikan folder ada
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Pindahkan file ke public/uploads/...
        $file->move(public_path($path), $filename);

        return $path . '/' . $filename;
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




    // Form edit lengkap
    public function editFull($id)
    {
        $kandidat = Pendaftaran::findOrFail($id);
        return view('siswa.edit_full', compact('kandidat'));
    }

    public function updateFull(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Validasi semua field wajib diisi (nik unik kecuali dirinya sendiri)
        $request->validate([
            'nik' => 'required|string|size:16|unique:pendaftarans,nik,' . $pendaftaran->id,
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
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bukti_pelunasan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijasah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Upload file jika ada, jika tidak tetap gunakan file lama
        $files = [
            'foto' => 'uploads/foto',
            'kk' => 'uploads/kk',
            'ktp' => 'uploads/ktp',
            'bukti_pelunasan' => 'uploads/bukti_pelunasan',
            'akte' => 'uploads/akte',
            'ijasah' => 'uploads/ijasah',
        ];

        foreach ($files as $field => $folder) {
            if ($request->hasFile($field)) {
                // Hapus file lama
                if ($pendaftaran->$field && Storage::disk('public')->exists($pendaftaran->$field)) {
                    Storage::disk('public')->delete($pendaftaran->$field);
                }
                $pendaftaran->$field = $request->file($field)->store($folder, 'public');
            }
        }

        // Update data
        $pendaftaran->update([
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
            'cabang_id' => $request->cabang_id,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Pendaftaran berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Hapus user terkait jika ada
        if ($pendaftaran->user_id) {
            $pendaftaran->user()->delete();
        }

        // Hapus data pendaftaran
        $pendaftaran->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }


    // Export Data ke Excel
    public function export()
    {
        return Excel::download(new PendaftaranExport, 'data_pendaftaran.xlsx');
    }
    // Import Data dari Excel (Versi AJAX)
    public function import(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv'
            ]);

            Excel::import(new PendaftaranImport, $request->file('file'));

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diimport!'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal mengimport data. Pastikan format file benar.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function cvCreate()
    {
        return view('pendaftaran.cv');
    }
}
