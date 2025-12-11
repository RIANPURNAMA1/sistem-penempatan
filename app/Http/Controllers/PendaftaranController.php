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
use Illuminate\Support\Facades\Log;
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

            // Ditambahkan
            'tempat_lahir' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|date',
            'tanggal_daftar' => 'required|date',

            // FIELD BARU
            'pendidikan_terakhir' => 'required|string|max:255',
            'bidang_ssw' => 'required|in:Pengolahan makanan,Restoran,Pertanian,Kaigo (perawat),Building cleaning,Driver,Lainnya',

            'id_prometric' => 'required|string|max:255',
            'password_prometric' => 'required|string|max:255',
            'pernah_ke_jepang' => 'required|in:Ya,Tidak',

            // Paspor opsional — maksimal 5MB
            'paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

            // FILE WAJIB — ukuran lebih kecil
            'foto' => 'required|file|mimes:jpg,jpeg,png|max:3072', // 3MB
            'kk'                => 'nullable|file|mimes:pdf|max:5120',
            'ktp'               => 'nullable|file|mimes:pdf|max:5120',
            'bukti_pelunasan'   => 'nullable|file|mimes:pdf|max:5120',
            'akte'              => 'nullable|file|mimes:pdf|max:5120',
            'ijasah'            => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat_jft'    => 'nullable|file|mimes:pdf|max:5120',
            'sertifikat_ssw'    => 'nullable|file|mimes:pdf|max:5120',
            'paspor'            => 'nullable|file|mimes:pdf|max:5120',

        ], [

            // Pesan error khusus
            'file.max' => 'Ukuran file melebihi batas 5MB.',
            'file.mimes' => 'File harus berformat PDF.',

            // Pesan setiap field
            'foto.mimes' => 'Foto harus berupa JPG atau PNG.',
            'kk.mimes' => 'KK harus berupa file PDF.',
            'ktp.mimes' => 'KTP harus berupa file PDF.',
            'bukti_pelunasan.mimes' => 'Bukti pelunasan harus berupa file PDF.',
            'akte.mimes' => 'Akte harus berupa file PDF.',
            'ijasah.mimes' => 'Ijazah harus berupa file PDF.',
            'sertifikat_jft.mimes' => 'Sertifikat JFT harus berupa file PDF.',
            'sertifikat_ssw.mimes' => 'Sertifikat SSW harus berupa file PDF.',
            'paspor.mimes' => 'Paspor harus berupa file PDF.',

            // Error lainnya
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali 08 dan memiliki 10–13 digit.',
            'status.in' => 'Status harus: belum menikah, menikah, atau lajang.',

            // Field baru
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih.',
            'bidang_ssw.required' => 'Bidang SSW wajib dipilih.',
        ]);



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

                // Nama file baru
                $filename = time() . '_' . $file->getClientOriginalName();

                // Tujuan folder (public/dokumen/{field})
                $destination = public_path("dokumen/{$fileKey}");

                // Pastikan folder ada
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                // Pindahkan file ke folder public
                $file->move($destination, $filename);

                // Simpan path untuk database → ditampilkan pakai asset()
                $uploadedPaths[$fileKey] = "dokumen/{$fileKey}/{$filename}";
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

            // Field baru
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'bidang_ssw' => $request->bidang_ssw,

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

            // Field tambahan lainnya
            'id_prometric' => $request->id_prometric,
            'password_prometric' => $request->password_prometric,
            'pernah_ke_jepang' => $request->pernah_ke_jepang,
        ]);

        // Controller Response untuk create pendaftaran biasa
        return redirect()->back()->with('success', 'Berhasil mendaftar dan akun kandidat otomatis dibuat.');
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


    public function DataKandidat()
    {
        $kandidats = Pendaftaran::with('cabang')
            ->latest('created_at') // ✅ urutkan berdasarkan waktu update
            ->paginate(10);

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

        if ($request->verifikasi === 'diterima') {
            $kandidat = Kandidat::firstOrCreate(
                ['pendaftaran_id' => $pendaftaran->id],
                [
                    'cabang_id'       => $pendaftaran->cabang_id,
                    'status_kandidat' => 'Job Matching',
                    'institusi_id'    => null,
                ]
            );

            $message = 'Data verifikasi berhasil diperbarui dan kandidat dibuat!';

            // -------------------------
            // Buat link grup WA
            // -------------------------
            if ($pendaftaran->no_wa) {
                $groupLink = "https://chat.whatsapp.com/FBHNnGiAnme32o9wvPyC8P?mode=hqrt1";
                $phone = preg_replace('/\D/', '', $pendaftaran->no_wa); // bersihkan nomor

                $waMessage = "Selamat! Anda telah diterima. Klik link berikut untuk bergabung ke grup WhatsApp: $groupLink";
                $waUrl = "https://wa.me/$phone?text=" . urlencode($waMessage);

                // Set field masuk_grup_wa jadi true
                $kandidat->masuk_grup_wa = true;
                $kandidat->save();

                // Log atau kirim ke frontend
                Log::info("Link WA untuk kandidat {$pendaftaran->nama}: $waUrl");
            }
        }



        // Jika AJAX request, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ]);
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

        $validated = $request->validate([
            'nik' => 'sometimes|required|string|size:16|unique:pendaftarans,nik,' . $pendaftaran->id,
            'nama' => 'sometimes|required|string|max:255',
            'usia' => 'sometimes|required|string|max:255',
            'agama' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:belum menikah,menikah,lajang',
            'email' => 'sometimes|required|email|max:255|unique:pendaftarans,email,' . $pendaftaran->id,
            'no_wa' => ['sometimes', 'required', 'string', 'max:15', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'sometimes|required|in:Laki-laki,Perempuan',
            'alamat' => 'sometimes|required|string|max:500',
            'provinsi' => 'sometimes|required|string|max:100',
            'kab_kota' => 'sometimes|required|string|max:100',
            'kecamatan' => 'sometimes|required|string|max:100',
            'kelurahan' => 'sometimes|required|string|max:100',
            'cabang_id' => 'sometimes|required|exists:cabangs,id',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'tempat_tanggal_lahir' => 'sometimes|required|date',
            'tanggal_daftar' => 'sometimes|required|date',

            'id_prometric' => 'nullable|string|max:255',
            'password_prometric' => 'nullable|string|max:255',
            'pernah_ke_jepang' => 'sometimes|required|in:Ya,Tidak',

            // FIELD BARU
            'pendidikan_terakhir' => 'sometimes|string|max:255',
            'bidang_ssw' => 'sometimes|in:Pengolahan makanan,Restoran,Pertanian,Kaigo (perawat),Building cleaning,Driver,Lainnya',

            // FILE OPSIONAL saat update
            'paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bukti_pelunasan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijasah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_jft' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_ssw' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            // Pesan error
            'file.max' => 'Ukuran file melebihi batas.',
            'foto.max' => 'Ukuran foto melebihi batas 3MB.',
            'kk.max' => 'Ukuran KK melebihi batas 5MB.',
            'ktp.max' => 'Ukuran KTP melebihi batas 5MB.',
            'bukti_pelunasan.max' => 'Ukuran bukti pelunasan melebihi batas 5MB.',
            'akte.max' => 'Ukuran akte melebihi batas 5MB.',
            'ijasah.max' => 'Ukuran ijazah melebihi batas 5MB.',
            'sertifikat_jft.max' => 'Ukuran sertifikat JFT melebihi batas 5MB.',
            'sertifikat_ssw.max' => 'Ukuran sertifikat SSW melebihi batas 5MB.',
            'paspor.max' => 'Ukuran paspor melebihi batas 5MB.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali 08 dan memiliki 10–13 digit.',
            'status.in' => 'Status harus: belum menikah, menikah, atau lajang.',
        ]);


        /*
    |--------------------------------------------------------------------------
    | 1. Siapkan data text (exclude file fields)
    |--------------------------------------------------------------------------
    */
        $data = $request->except([
            '_token',
            '_method',
            'foto',
            'kk',
            'ktp',
            'paspor',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw'
        ]);


        /*
    |--------------------------------------------------------------------------
    | 2. Daftar file yang perlu diproses
    |--------------------------------------------------------------------------
    */
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


        /*
    |--------------------------------------------------------------------------
    | 3. Upload file baru & hapus file lama
    |--------------------------------------------------------------------------
    */
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {

                // HAPUS FILE LAMA jika ada
                if (!empty($pendaftaran->$fileKey)) {
                    $oldFilePath = public_path($pendaftaran->$fileKey);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // UPLOAD FILE BARU
                $file = $request->file($fileKey);
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path("dokumen/{$fileKey}");

                // Pastikan folder ada
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                // Pindahkan file
                $file->move($destination, $filename);

                // Simpan path baru ke array $data
                $data[$fileKey] = "dokumen/{$fileKey}/{$filename}";
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 4. Update Database
    |--------------------------------------------------------------------------
    */
        $pendaftaran->update($data);


        return redirect()
            ->route('siswa.index')
            ->with('success', 'Pendaftaran berhasil diperbarui!');
    }


    /*
|--------------------------------------------------------------------------
|  FUNGSI UNTUK CEK ADA FILE UPLOAD ATAU TIDAK
|--------------------------------------------------------------------------
*/
    private function hasAnyFile($request)
    {
        $fileFields = [
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

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                return true;
            }
        }

        return false;
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

        // Hapus kandidat berdasarkan relasi pendataran_id
        if ($pendaftaran->kandidat) {
            $pendaftaran->kandidat()->delete();
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


    public function import(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|mimetypes:text/plain,text/csv,application/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048'
            ]);

            // Disable heading validation
            config(['excel.import.heading_error_formatter' => null]);

            Excel::import(new PendaftaranImport, $request->file('file'));

            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil diimport!'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status'  => false,
                'message' => "Import Error: " . $e->getMessage()
            ], 500);
        }
    }



    public function cvCreate()
    {
        return view('pendaftaran.cv');
    }

    public function show($id)
    {
        $kandidat = Pendaftaran::with('cabang')->findOrFail($id);
        return view('pendaftaran.show', compact('kandidat'));
    }
    public function showPendaftar($id)
    {
        $kandidat = Pendaftaran::with('cabang')->findOrFail($id);
        return view('pendaftaran.show', compact('kandidat'));
    }
}
