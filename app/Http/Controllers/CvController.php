<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Cv;
use App\Models\Pengalaman;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::with(['pendidikans', 'pengalamans'])->get();
        $cabang = Cabang::all();

        return view('cv.index', compact('cvs','cabang'));
    }


    public function create()
    {
        $alreadyRegistered = Cv::where('user_id', Auth::id())->exists();
        $cabangs = \App\Models\Cabang::all();
        return view('pendaftaran.cv', compact('cabangs', 'alreadyRegistered'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Simpan sertifikat
            $sertifikatFile = $request->file('sertifikat_files')[0] ?? null;
            $sertifikatPath = $sertifikatFile ? $sertifikatFile->store('sertifikat', 'public') : null;

            // ================= UPLOAD PAS FOTO =================
            $pasFotoPath = null;

            if ($request->hasFile('pas_foto')) {
                $file = $request->file('pas_foto'); // langsung ambil file tunggal
                $fileName = time() . '_' . $file->getClientOriginalName();
                // simpan langsung ke public/uploads/foto
                $file->move(public_path('uploads/foto'), $fileName);
                $pasFotoPath = 'uploads/foto/' . $fileName; // path relatif untuk DB
            }



            // =============== SIMPAN DATA CV ===============
            $cv = Cv::create([
                'user_id'                      => Auth::id(),
                'email'                        => $request->email,
                'cabang_id'                    => $request->cabang_id,
                'batch'                        => $request->batch,
                'no_telepon'                   => $request->no_telepon,
                'no_orang_tua'                 => $request->no_orang_tua,
                'bidang_sertifikasi'           => $request->bidang_sertifikasi,
                'bidang_sertifikasi_lainnya'   => $request->bidang_sertifikasi_lainnya,
                'program_pertanian_kawakami'   => $request->program_pertanian_kawakami,
                'sertifikat_files'             => $sertifikatPath,

                // halaman 2
                'pas_foto'                     => $pasFotoPath,
                'nama_lengkap_romaji'          => $request->nama_lengkap_romaji,
                'nama_lengkap_katakana'        => $request->nama_lengkap_katakana,
                'nama_panggilan_romaji'        => $request->nama_panggilan_romaji,
                'nama_panggilan_katakana'      => $request->nama_panggilan_katakana,
                'jenis_kelamin'                => $request->jenis_kelamin,
                'agama'                        => $request->agama,
                'agama_lainnya'                => $request->agama_lainnya,
                'tempat_tanggal_lahir'         => $request->tempat_tanggal_lahir,
                'usia'                         => $request->usia,
                'alamat_lengkap'               => $request->alamat_lengkap,
                'email_aktif'                  => $request->email_aktif,
                'status_perkawinan'            => $request->status_perkawinan,
                'status_perkawinan_lainnya'    => $request->status_perkawinan_lainnya,
                'golongan_darah'               => $request->golongan_darah,
                'surat_izin_mengemudi'         => $request->surat_izin_mengemudi,
                'jenis_sim'                    => $request->jenis_sim,
                'merokok'                      => $request->merokok,
                'minum_alkohol'                => $request->minum_alkohol,
                'bertato'                      => $request->bertato,
                'tinggi_badan'                 => $request->tinggi_badan,
                'berat_badan'                  => $request->berat_badan,
                'ukuran_pinggang'              => $request->ukuran_pinggang,
                'ukuran_sepatu'                => $request->ukuran_sepatu,
                'ukuran_atasan_baju'           => $request->ukuran_atasan_baju,
                'ukuran_atasan_baju_lainnya'   => $request->ukuran_atasan_baju_lainnya,
                'ukuran_celana'                => $request->ukuran_celana,
                'tangan_dominan'               => $request->tangan_dominan,
                'kemampuan_penglihatan_mata'   => $request->kemampuan_penglihatan_mata,
                'kemampuan_penglihatan_mata_lainnya' => $request->kemampuan_penglihatan_mata_lainnya,
                'sudah_vaksin_berapa_kali'     => $request->sudah_vaksin_berapa_kali,
                'sudah_vaksin_berapa_kali_lainnya' => $request->sudah_vaksin_berapa_kali_lainnya,
                'kesehatan_badan'              => $request->kesehatan_badan,
                'penyakit_cedera_masa_lalu'    => $request->penyakit_cedera_masa_lalu,
                'hobi'                         => $request->hobi,
                'rencana_sumber_biaya_keberangkatan' => $request->rencana_sumber_biaya_keberangkatan,
                'perkiraan_biaya'              => $request->perkiraan_biaya,

                // halaman 3
                'lama_belajar_di_mendunia'     => $request->lama_belajar_di_mendunia,
                'kemampuan_bahasa_jepang'      => $request->kemampuan_bahasa_jepang,
                'kemampuan_pemahaman_ssw'      => $request->kemampuan_pemahaman_ssw,
                'kelincahan_dalam_bekerja'     => $request->kelincahan_dalam_bekerja,
                'kekuatan_tindakan'            => $request->kekuatan_tindakan,
                'kemampuan_berbahasa_inggris'  => $request->kemampuan_berbahasa_inggris,
                'kemampuan_berbahasa_inggris_lainnya' => $request->kemampuan_berbahasa_inggris_lainnya,
                'kebugaran_jasmani_seminggu'   => $request->kebugaran_jasmani_seminggu,
                'kebugaran_jasmani_seminggu_lainnya' => $request->kebugaran_jasmani_seminggu_lainnya,

                // halaman 5
                'ada_keluarga_di_jepang'       => $request->ada_keluarga_di_jepang,
                'hubungan_keluarga_di_jepang'  => $request->hubungan_keluarga_di_jepang,
                'status_kerabat_di_jepang'     => $request->status_kerabat_di_jepang,
                'status_kerabat_di_jepang_lainnya' => $request->status_kerabat_di_jepang_lainnya,
                'ingin_bekerja_berapa_tahun'   => $request->ingin_bekerja_berapa_tahun,
                'ingin_bekerja_berapa_tahun_lainnya' => $request->ingin_bekerja_berapa_tahun_lainnya,
                'ingin_pulang_berapa_kali'     => $request->ingin_pulang_berapa_kali,
                'kelebihan_diri'               => $request->kelebihan_diri,
                'komentar_guru_kelebihan_diri' => $request->komentar_guru_kelebihan_diri,
                'kekurangan_diri'              => $request->kekurangan_diri,
                'komentar_guru_kekurangan_diri' => $request->komentar_guru_kekurangan_diri,
                'ketertarikan_terhadap_jepang' => $request->ketertarikan_terhadap_jepang,
                'orang_yang_dihormati'         => $request->orang_yang_dihormati,
                'point_plus_diri'              => $request->point_plus_diri,
                'keahlian_khusus'              => $request->keahlian_khusus,

                // halaman 6
                'anggota_keluarga_istri'       => $request->anggota_keluarga_istri,
                'anggota_keluarga_suami'       => $request->anggota_keluarga_suami,
                'anggota_keluarga_anak'        => $request->anggota_keluarga_anak,
                'anggota_keluarga_ibu'         => $request->anggota_keluarga_ibu,
                'anggota_keluarga_ayah'        => $request->anggota_keluarga_ayah,
                'anggota_keluarga_kakak'       => $request->anggota_keluarga_kakak,
                'anggota_keluarga_adik'        => $request->anggota_keluarga_adik,
                'rata_rata_penghasilan_keluarga' => $request->rata_rata_penghasilan_keluarga,
            ]);

            // Pendidikan
            if ($request->pendidikan_nama) {
                foreach ($request->pendidikan_nama as $i => $nama) {
                    Pendidikan::create([
                        'cv_id'   => $cv->id,
                        'nama'    => $nama,
                        'jurusan' => $request->pendidikan_jurusan[$i] ?? null,
                        'tahun'   => $request->pendidikan_tahun[$i] ?? null,
                    ]);
                }
            }

            // Pengalaman
            if ($request->pengalaman_perusahaan) {
                foreach ($request->pengalaman_perusahaan as $i => $perusahaan) {
                    Pengalaman::create([
                        'cv_id'        => $cv->id,
                        'perusahaan'   => $perusahaan,
                        'jabatan'      => $request->pengalaman_jabatan[$i] ?? null,
                        'lama_bekerja' => $request->pengalaman_periode[$i] ?? null,
                        // 'gaji' bisa diisi jika ada field gaji
                    ]);
                }
            }


            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'CV berhasil disimpan.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("CV ERROR: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan CV.',
                'detail' => $e->getMessage(),
            ], 500);
        }
    }



    public function show($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.show', compact('cv'));
    }
    public function showPdf($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf2', compact('cv'));
    }
    public function showPdfVioleta($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_violeta', compact('cv'));
    }


    public function edit($id)
    {
        $cv = Cv::where('id', $id)
            ->where('user_id', Auth::id())
            ->with(['pendidikans', 'pengalamans'])
            ->firstOrFail();

        $cabangs = \App\Models\Cabang::all();

        return view('pendaftaran.edit_cv', compact('cv', 'cabangs'));
    }

    public function update(Request $request, $id)
    {
        // Implementasi update CV
        // Mirip dengan store, tapi menggunakan update
    }

    public function destroy($id)
    {
        try {
            $cv = Cv::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $cv->delete();

            return redirect()->route('pendaftaran.cv')
                ->with('success', 'CV berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus CV.');
        }
    }
}
