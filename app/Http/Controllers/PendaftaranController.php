<?php

namespace App\Http\Controllers;

use App\Exports\KandidatExport;
use App\Exports\PendaftaranExport;
use App\Imports\PendaftaranImport;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Cabang;
use App\Models\Kandidat;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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
        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:pendaftarans,nik',
            'nama' => 'required|string|max:255',
            'usia' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'status' => 'required|in:belum menikah,menikah,lajang',
            'email' => 'required|email|max:255|unique:pendaftarans,email',
            'no_wa' => ['required', 'string', 'max:15', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:500',
            'provinsi' => 'required|string|max:100',
            'kab_kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'cabang_id' => 'required|exists:cabangs,id',
            'tempat_lahir' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|date',
            'tanggal_daftar' => 'required|date',

            // Tambahan field baru:
            'id_prometric' => 'required|string|max:255',
            'password_prometric' => 'required|string|max:255',
            'pernah_ke_jepang' => 'required|in:Ya,Tidak',

            // Paspor file upload
            'paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',

            // File upload wajib
            'foto' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'bukti_pelunasan' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'akte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'ijasah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'sertifikat_jft' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'sertifikat_ssw' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ], [
            'nik.size' => 'NIK harus 16 digit',
            'nik.unique' => 'NIK sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali 08 dan 10-13 digit',
            'status.in' => 'Status harus: belum menikah, menikah, atau lajang',
            'max' => 'File terlalu besar, maksimal 10MB'
        ]);

        // Upload file wajib + paspor
        $files = [
            'foto',
            'kk',
            'ktp',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw',
            'paspor'
        ];

        $uploadedPaths = [];

        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path("uploads/{$fileKey}");

                if (!file_exists($destination)) {
                    mkdir($destination, 0775, true);
                }

                $file->move($destination, $filename);
                $uploadedPaths[$fileKey] = "uploads/{$fileKey}/" . $filename;
            }
        }

        // Simpan data
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'cabang_id' => $request->cabang_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'usia' => $request->usia,
            'agama' => $request->agama,
            'status' => $request->status,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_daftar' => $request->tanggal_daftar,
            'tempat_lahir' => $request->tempat_lahir,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kab_kota' => $request->kab_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,

            // File upload
            'foto' => $uploadedPaths['foto'] ?? null,
            'kk' => $uploadedPaths['kk'] ?? null,
            'ktp' => $uploadedPaths['ktp'] ?? null,
            'bukti_pelunasan' => $uploadedPaths['bukti_pelunasan'] ?? null,
            'akte' => $uploadedPaths['akte'] ?? null,
            'ijasah' => $uploadedPaths['ijasah'] ?? null,
            'sertifikat_jft' => $uploadedPaths['sertifikat_jft'] ?? null,
            'sertifikat_ssw' => $uploadedPaths['sertifikat_ssw'] ?? null,
            'paspor' => $uploadedPaths['paspor'] ?? null,

            // Field tambahan
            'id_prometric' => $request->id_prometric,
            'password_prometric' => $request->password_prometric,
            'pernah_ke_jepang' => $request->pernah_ke_jepang,
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

        // Validasi semua field
        $request->validate([
            'nik' => 'required|string|size:16|unique:pendaftarans,nik,' . $pendaftaran->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => ['required', 'string', 'max:20', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'status' => 'required|in:belum menikah,menikah,lajang',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'provinsi' => 'required|string|max:100',
            'kab_kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'cabang_id' => 'required|exists:cabangs,id',
            'tanggal_daftar' => 'required|date',

            // FIELD TAMBAHAN
            'id_prometric' => 'nullable|string|max:255',
            'password_prometric' => 'nullable|string|max:255',
            'pernah_ke_jepang' => 'required|in:Ya,Tidak',

            'paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            // File upload
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bukti_pelunasan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijasah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_jft' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_ssw' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Upload file jika ada
        $files = [
            'foto' => 'uploads/foto',
            'kk' => 'uploads/kk',
            'ktp' => 'uploads/ktp',
            'bukti_pelunasan' => 'uploads/bukti_pelunasan',
            'akte' => 'uploads/akte',
            'ijasah' => 'uploads/ijasah',
            'sertifikat_jft' => 'uploads/sertifikat_jft',
            'sertifikat_ssw' => 'uploads/sertifikat_ssw',
            'paspor' => 'uploads/paspor', // DITAMBAHKAN
        ];

        foreach ($files as $field => $folder) {
            if ($request->hasFile($field)) {

                // Hapus file lama jika ada
                if ($pendaftaran->$field && Storage::disk('public')->exists($pendaftaran->$field)) {
                    Storage::disk('public')->delete($pendaftaran->$field);
                }

                // Simpan file baru
                $pendaftaran->$field = $request->file($field)->store($folder, 'public');
            }
        }

        // Update seluruh data
        $pendaftaran->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status' => $request->status,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_daftar' => $request->tanggal_daftar,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kab_kota' => $request->kab_kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'cabang_id' => $request->cabang_id,

            // FIELD BARU
            'id_prometric' => $request->id_prometric,
            'password_prometric' => $request->password_prometric,
            'pernah_ke_jepang' => $request->pernah_ke_jepang,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Pendaftaran berhasil diperbarui!');
    }



    public function exportPDF()
    {
        $pendaftarans = Pendaftaran::all();
        $pdf = FacadePdf::loadView('pendaftaran.pdf', compact('pendaftarans'));
        return $pdf->download('pendaftaran.pdf');
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
