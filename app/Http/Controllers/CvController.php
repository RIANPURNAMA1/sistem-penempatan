<?php

namespace App\Http\Controllers;

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

        return view('cv.index', compact('cvs'));
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

            // =============== UPLOAD FILE SERTIFIKAT ===============
            $sertifikatPaths = [];
            if ($request->hasFile('sertifikat_files')) {
                foreach ($request->file('sertifikat_files') as $file) {
                    $path = $file->store('uploads/sertifikat', 'public');
                    $sertifikatPaths[] = $path;
                }
            }

            // =============== UPLOAD FOTO ===============
            $fotoPaths = [];
            if ($request->hasFile('pas_foto')) {
                foreach ($request->file('pas_foto') as $file) {
                    $path = $file->store('uploads/pasfoto', 'public');
                    $fotoPaths[] = $path;
                }
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
                'sertifikat_files'             => json_encode($sertifikatPaths),

                // halaman 2
                'pas_foto'                     => json_encode($fotoPaths),
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

            // =============== SIMPAN PENDIDIKAN ===============
            if ($request->nama_pendidikan) {
                foreach ($request->nama_pendidikan as $i => $nama) {
                    Pendidikan::create([
                        'cv_id'   => $cv->id,
                        'nama'    => $nama,
                        'jurusan' => $request->jurusan_pendidikan[$i] ?? null,
                        'tahun'   => $request->tahun_pendidikan[$i] ?? null,
                    ]);
                }
            }

            // =============== SIMPAN PENGALAMAN KERJA ===============
            if ($request->perusahaan) {
                foreach ($request->perusahaan as $i => $perusahaan) {
                    Pengalaman::create([
                        'cv_id'        => $cv->id,
                        'perusahaan'   => $perusahaan,
                        'jabatan'      => $request->jabatan[$i] ?? null,
                        'lama_bekerja' => $request->lama_bekerja[$i] ?? null,
                        'gaji'         => $request->gaji[$i] ?? null,
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
