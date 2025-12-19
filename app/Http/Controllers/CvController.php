<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Cv;
use App\Models\MagangJisshu;
use App\Models\Pengalaman;
use App\Models\Pendidikan;
use App\Models\RiwayatPekerjaanTerakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class CvController extends Controller
{
    public function index(Request $request)
    {
        $query = Cv::with(['pendidikans', 'pengalamans']);

        // Filter berdasarkan cabang jika ada
        if ($request->has('cabang_id') && $request->cabang_id != '') {
            $query->where('cabang_id', $request->cabang_id);
        }

        // Pagination - 12 data per halaman dengan query string
        $cvs = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $cabang = Cabang::all();

        return view('cv.index', compact('cvs', 'cabang'));
    }


    public function create()
    {
        $alreadyRegistered = Cv::where('user_id', Auth::id())->exists();
        $cabangs = \App\Models\Cabang::all();
        return view('pendaftaran.cv', compact('cabangs', 'alreadyRegistered'));
    }
    public function cvCreate()
    {
        return view('pendaftaran.cv');
    }





    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            /* ============================================================
           1. VALIDASI
        ============================================================ */
            $request->validate([
                "sertifikat_files.*" => "nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240",
                "pas_foto.*"         => "required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240",
            ]);


            /* ============================================================
           2. UPLOAD MULTI SERTIFIKAT → JSON
        ============================================================ */
            $sertifikatPaths = [];

            if ($request->hasFile("sertifikat_files")) {
                foreach ($request->file("sertifikat_files") as $file) {

                    $fileName = time() . "_" . uniqid() . "_" . $file->getClientOriginalName();

                    // Simpan manual ke public/uploads/sertifikat
                    $file->move(public_path("uploads/sertifikat"), $fileName);

                    $sertifikatPaths[] = "uploads/sertifikat/" . $fileName;
                }
            }


            /* ============================================================
           3. UPLOAD MULTI PAS FOTO → JSON
        ============================================================ */
            $pasFotoPaths = [];

            if ($request->hasFile("pas_foto")) {
                foreach ($request->file("pas_foto") as $file) {

                    $fileName = time() . "_" . uniqid() . "_" . $file->getClientOriginalName();

                    // Simpan manual ke public/uploads/pas_foto
                    $file->move(public_path("uploads/pas_foto"), $fileName);

                    $pasFotoPaths[] = "uploads/pas_foto/" . $fileName;
                }
            }


            // ============================================================
            // UPLOAD PAS FOTO → SIMPAN DI PUBLIC & DAPAT PATH UNTUK ASSET
            // ============================================================
            $pasFotoPathCv = null;

            if ($request->hasFile('pas_foto_cv')) {
                $file = $request->file('pas_foto_cv');
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                // Pindahkan file ke public/uploads/pas_foto_cv
                $file->move(public_path('uploads/pas_foto_cv'), $fileName);

                // Simpan path relatif agar bisa dipanggil via asset()
                $pasFotoPathCv = 'uploads/pas_foto_cv/' . $fileName;
            }


            /* ============================================================
           4. SIMPAN DATA CV (SESUAI MIGRATION)
        ============================================================ */
            $cv = Cv::create([

                // ========= HALAMAN 1 =========
                "user_id"                     => Auth::id(),
                "email"                       => $request->email,
                "cabang_id"                   => $request->cabang_id,
                "batch"                       => $request->batch,
                "no_telepon"                  => $request->no_telepon,
                "no_orang_tua"                => $request->no_orang_tua,
                "bidang_sertifikasi"          => $request->bidang_sertifikasi,
                "bidang_sertifikasi_lainnya"  => $request->bidang_sertifikasi_lainnya,
                "program_pertanian_kawakami"  => $request->program_pertanian_kawakami,

                "sertifikat_files"            => json_encode($sertifikatPaths),

                // ========= HALAMAN 2 =========
                "pas_foto"                    => json_encode($pasFotoPaths),
                "pas_foto_cv"                 => $pasFotoPathCv,
                "nama_lengkap_romaji"         => $request->nama_lengkap_romaji,
                "nama_lengkap_katakana"       => $request->nama_lengkap_katakana,
                "nama_panggilan_romaji"       => $request->nama_panggilan_romaji,
                "nama_panggilan_katakana"     => $request->nama_panggilan_katakana,
                "jenis_kelamin"               => $request->jenis_kelamin,
                "agama"                       => $request->agama,
                "agama_lainnya"               => $request->agama_lainnya,
                "tanggal_lahir"        => $request->tanggal_lahir,
                "tempat_lahir"        => $request->tempat_lahir,
                "usia"                        => $request->usia,
                "alamat_lengkap"              => $request->alamat_lengkap,


                // WILAYAH (API)
                "provinsi"   => $request->provinsi,
                "kabupaten"  => $request->kabupaten,
                "kecamatan"  => $request->kecamatan,
                "kelurahan"  => $request->kelurahan,

                "email_aktif"                 => $request->email_aktif,
                "status_perkawinan"           => $request->status_perkawinan,
                "status_perkawinan_lainnya"   => $request->status_perkawinan_lainnya,
                "golongan_darah"              => $request->golongan_darah,
                "surat_izin_mengemudi"        => $request->surat_izin_mengemudi,
                "jenis_sim"                   => $request->jenis_sim,
                "merokok"                     => $request->merokok,
                "minum_alkohol"               => $request->minum_alkohol,
                "bertato"                     => $request->bertato,
                "tinggi_badan"                => $request->tinggi_badan,
                "berat_badan"                 => $request->berat_badan,
                "ukuran_pinggang"             => $request->ukuran_pinggang,
                "ukuran_sepatu"               => $request->ukuran_sepatu,
                "ukuran_atasan_baju"          => $request->ukuran_atasan_baju,
                "ukuran_atasan_baju_lainnya"  => $request->ukuran_atasan_baju_lainnya,
                "ukuran_celana"               => $request->ukuran_celana,
                "tangan_dominan"              => $request->tangan_dominan,
                "kemampuan_penglihatan_mata"  => $request->kemampuan_penglihatan_mata,
                "kemampuan_penglihatan_mata_lainnya" => $request->kemampuan_penglihatan_mata_lainnya,
                "sudah_vaksin_berapa_kali"    => $request->sudah_vaksin_berapa_kali,
                "sudah_vaksin_berapa_kali_lainnya" => $request->sudah_vaksin_berapa_kali_lainnya,
                "kesehatan_badan"             => $request->kesehatan_badan,
                "penyakit_cedera_masa_lalu"   => $request->penyakit_cedera_masa_lalu,
                "hobi"                        => $request->hobi,
                "rencana_sumber_biaya_keberangkatan" => $request->rencana_sumber_biaya_keberangkatan,
                "perkiraan_biaya"             => $request->perkiraan_biaya,
                "Biaya_keberangkatan_sebelumnya_jisshu" => $request->Biaya_keberangkatan_sebelumnya_jisshu,

                // ========= HALAMAN 3 =========
                "lama_belajar_di_mendunia"    => $request->lama_belajar_di_mendunia,
                "kemampuan_bahasa_jepang"     => $request->kemampuan_bahasa_jepang,
                "kemampuan_pemahaman_ssw"     => $request->kemampuan_pemahaman_ssw,
                "kelincahan_dalam_bekerja"    => $request->kelincahan_dalam_bekerja,
                "kekuatan_tindakan"           => $request->kekuatan_tindakan,
                "kemampuan_berbahasa_inggris" => $request->kemampuan_berbahasa_inggris,
                "kemampuan_berbahasa_inggris_lainnya" => $request->kemampuan_berbahasa_inggris_lainnya,
                "kebugaran_jasmani_seminggu"  => $request->kebugaran_jasmani_seminggu,
                "kebugaran_jasmani_seminggu_lainnya" => $request->kebugaran_jasmani_seminggu_lainnya,

                // ========= HALAMAN 3 — Pertanyaan Tambahan =========
                "bersedia_kerja_shift"   => $request->bersedia_kerja_shift,
                "bersedia_lembur"        => $request->bersedia_lembur,
                "bersedia_hari_libur"    => $request->bersedia_hari_libur,
                "menggunakan_kacamata"   => $request->menggunakan_kacamata,


                // ========= HALAMAN 5 =========
                "ada_keluarga_di_jepang"      => $request->ada_keluarga_di_jepang,
                "hubungan_keluarga_di_jepang" => $request->hubungan_keluarga_di_jepang,
                "status_kerabat_di_jepang"    => $request->status_kerabat_di_jepang,
                "status_kerabat_di_jepang_lainnya" => $request->status_kerabat_di_jepang_lainnya,
                "ingin_bekerja_berapa_tahun"  => $request->ingin_bekerja_berapa_tahun,
                "ingin_bekerja_berapa_tahun_lainnya" => $request->ingin_bekerja_berapa_tahun_lainnya,
                "ingin_pulang_berapa_kali"    => $request->ingin_pulang_berapa_kali,
                "kelebihan_diri"              => $request->kelebihan_diri,
                "komentar_guru_kelebihan_diri" => $request->komentar_guru_kelebihan_diri,
                "kekurangan_diri"             => $request->kekurangan_diri,
                "komentar_guru_kekurangan_diri" => $request->komentar_guru_kekurangan_diri,
                "ketertarikan_terhadap_jepang" => $request->ketertarikan_terhadap_jepang,
                "orang_yang_dihormati"        => $request->orang_yang_dihormati,
                "point_plus_diri"             => $request->point_plus_diri,
                "keahlian_khusus"             => $request->keahlian_khusus,


                // ====== ISTRI ======
                "istri_nama"       => $request->istri_nama,
                "istri_usia"       => $request->istri_usia,
                "istri_pekerjaan"  => $request->istri_pekerjaan,

                // ====== ANAK ======
                "anak_nama"            => $request->anak_nama,
                "anak_jenis_kelamin"   => $request->anak_jenis_kelamin,
                "anak_usia"            => $request->anak_usia,
                "anak_pendidikan"      => $request->anak_pendidikan,

                // ====== IBU ======
                "ibu_nama"       => $request->ibu_nama,
                "ibu_usia"       => $request->ibu_usia,
                "ibu_pekerjaan"  => $request->ibu_pekerjaan,

                // ====== AYAH ======
                "ayah_nama"       => $request->ayah_nama,
                "ayah_usia"       => $request->ayah_usia,
                "ayah_pekerjaan"  => $request->ayah_pekerjaan,

                // ====== KAKAK ======
                "kakak_nama"            => $request->kakak_nama,
                "kakak_usia"            => $request->kakak_usia,
                "kakak_jenis_kelamin"   => $request->kakak_jenis_kelamin,
                "kakak_pekerjaan"       => $request->kakak_pekerjaan,
                "kakak_status"          => $request->kakak_status,

                // ====== ADIK ======
                "adik_nama"            => $request->adik_nama,
                "adik_usia"            => $request->adik_usia,
                "adik_jenis_kelamin"   => $request->adik_jenis_kelamin,
                "adik_pekerjaan"       => $request->adik_pekerjaan,
                "adik_status"          => $request->adik_status,

                // ====== PENGHASILAN ======
                "rata_rata_penghasilan_keluarga" => $request->rata_rata_penghasilan_keluarga,
            ]);


            // Pendidikan
            if ($request->pendidikan_nama) {
                foreach ($request->pendidikan_nama as $i => $nama) {
                    Pendidikan::create([
                        'cv_id'       => $cv->id,
                        'nama'        => $nama,
                        'jurusan'     => $request->pendidikan_jurusan[$i] ?? null,
                        'tahun_masuk' => $request->pendidikan_tahun_masuk[$i] ?? null,
                        'tahun_lulus' => $request->pendidikan_tahun_lulus[$i] ?? null,
                    ]);
                }
            }

            // Pengalaman
            if ($request->pengalaman_perusahaan) {
                foreach ($request->pengalaman_perusahaan as $i => $perusahaan) {
                    Pengalaman::create([
                        'cv_id'          => $cv->id,
                        'perusahaan'     => $perusahaan,
                        'jabatan'        => $request->pengalaman_jabatan[$i] ?? null,
                        'tanggal_masuk'  => $request->pengalaman_tanggal_masuk[$i] ?? null,
                        'tanggal_keluar' => $request->pengalaman_tanggal_keluar[$i] ?? null,
                        'gaji'           => $request->pengalaman_gaji[$i] ?? null,
                        'kota'           => $request->pengalaman_kota[$i] ?? null,
                    ]);
                }
            }

            if ($request->magang_perusahaan) {
                foreach ($request->magang_perusahaan as $i => $perusahaan) {

                    MagangJisshu::create([
                        'cv_id'          => $cv->id,
                        'perusahaan'     => $perusahaan,
                        'kota_prefektur' => $request->magang_kota_prefektur[$i] ?? null,
                        'bidang'         => $request->magang_bidang[$i] ?? null,
                        'tahun_mulai'    => $request->magang_tahun_mulai[$i] ?? null,
                        'tahun_selesai'  => $request->magang_tahun_selesai[$i] ?? null,
                    ]);
                }
            }


            if ($request->nama_perusahaan) {

                foreach ($request->nama_perusahaan as $i => $perusahaan) {

                    \App\Models\RiwayatPekerjaanTerakhir::create([
                        'cv_id' => $cv->id,

                        'nama_perusahaan'              => $perusahaan,
                        'nama_kumiai'                  => $request->nama_kumiai[$i] ?? null,
                        'total_karyawan'               => $request->total_karyawan[$i] ?? null,
                        'total_karyawan_asing'         => $request->total_karyawan_asing[$i] ?? null,
                        'bidang_pekerjaan'             => $request->bidang_pekerjaan[$i] ?? null,
                        'klasifikasi_pekerjaan'        => $request->klasifikasi_pekerjaan[$i] ?? null,

                        'masa_pelatihan_mulai_tahun'   => $request->masa_pelatihan_mulai_tahun[$i] ?? null,
                        'masa_pelatihan_mulai_bulan'   => $request->masa_pelatihan_mulai_bulan[$i] ?? null,
                        'masa_pelatihan_selesai_tahun' => $request->masa_pelatihan_selesai_tahun[$i] ?? null,
                        'masa_pelatihan_selesai_bulan' => $request->masa_pelatihan_selesai_bulan[$i] ?? null,

                        'penanggung_jawab'             => $request->penanggung_jawab[$i] ?? null,
                        'shift_normal'                 => $request->shift_normal[$i] ?? null,

                        'jam_kerja_mulai_1'            => $request->jam_kerja_mulai_1[$i] ?? null,
                        'jam_kerja_selesai_1'          => $request->jam_kerja_selesai_1[$i] ?? null,
                        'jam_kerja_mulai_2'            => $request->jam_kerja_mulai_2[$i] ?? null,
                        'jam_kerja_selesai_2'          => $request->jam_kerja_selesai_2[$i] ?? null,
                        'jam_kerja_mulai_3'            => $request->jam_kerja_mulai_3[$i] ?? null,
                        'jam_kerja_selesai_3'          => $request->jam_kerja_selesai_3[$i] ?? null,

                        'hari_libur'                   => $request->hari_libur[$i] ?? null,
                        'detail_pekerjaan'             => $request->detail_pekerjaan[$i] ?? null,
                        'barang_cacat_action'          => $request->barang_cacat_action[$i] ?? null,

                        'prefektur'                    => $request->prefektur[$i] ?? null,
                        'kota'                         => $request->kota[$i] ?? null,

                        'status_visa'                  => $request->status_visa[$i] ?? null,

                        'masa_tinggal_mulai_tahun'     => $request->masa_tinggal_mulai_tahun[$i] ?? null,
                        'masa_tinggal_mulai_bulan'     => $request->masa_tinggal_mulai_bulan[$i] ?? null,
                        'masa_tinggal_selesai_tahun'   => $request->masa_tinggal_selesai_tahun[$i] ?? null,
                        'masa_tinggal_selesai_bulan'   => $request->masa_tinggal_selesai_bulan[$i] ?? null,

                        'gaji_per_jam'                 => $request->gaji_per_jam[$i] ?? null,
                        'gaji_bersih'                  => $request->gaji_bersih[$i] ?? null,
                        'lembur_bulanan'               => $request->lembur_bulanan[$i] ?? null,

                        'asrama_kamar'                 => $request->asrama_kamar[$i] ?? null,
                        'asrama_jumlah_orang'          => $request->asrama_jumlah_orang[$i] ?? null,

                        'transportasi'                 => $request->transportasi[$i] ?? null,
                        'jarak_tempuh_menit'           => $request->jarak_tempuh_menit[$i] ?? null,

                        'punya_hanko'                  => $request->punya_hanko[$i] ?? null,
                        'nama_hanko_sama_cv'           => $request->nama_hanko_sama_cv[$i] ?? null,
                        'nama_katakana_hanko'          => $request->nama_katakana_hanko[$i] ?? null,
                    ]);
                }
            }




            DB::commit();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Data CV berhasil disimpan!');
        } catch (\Exception $e) {

            DB::rollBack();

            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Gagal menyimpan CV. Detail: ' . $e->getMessage());
        }
    }

    public function updatecvkandidat(Request $request, $id)
    {

        DB::beginTransaction();

        try {

            $cv = Cv::findOrFail($id);

            /* ============================================================
           1. UPLOAD MULTI SERTIFIKAT → JSON
        ============================================================ */
            $sertifikatPaths = json_decode($cv->sertifikat_files, true) ?? [];

            if ($request->hasFile("sertifikat_files")) {
                $sertifikatPaths = []; // replace data lama

                foreach ($request->file("sertifikat_files") as $file) {
                    $fileName = time() . "_" . uniqid() . "_" . $file->getClientOriginalName();
                    $file->move(public_path("uploads/sertifikat"), $fileName);
                    $sertifikatPaths[] = "uploads/sertifikat/" . $fileName;
                }
            }


            /* ============================================================
           2. UPLOAD MULTI PAS FOTO → JSON
        ============================================================ */
            $pasFotoPaths = json_decode($cv->pas_foto, true) ?? [];

            if ($request->hasFile("pas_foto")) {
                $pasFotoPaths = []; // replace data lama

                foreach ($request->file("pas_foto") as $file) {
                    $fileName = time() . "_" . uniqid() . "_" . $file->getClientOriginalName();
                    $file->move(public_path("uploads/pas_foto"), $fileName);
                    $pasFotoPaths[] = "uploads/pas_foto/" . $fileName;
                }
            }


            /* ============================================================
           3. PAS FOTO CV (single file)
        ============================================================ */
            $pasFotoPathCv = $cv->pas_foto_cv;

            if ($request->hasFile('pas_foto_cv')) {
                $file = $request->file('pas_foto_cv');
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/pas_foto_cv'), $fileName);
                $pasFotoPathCv = 'uploads/pas_foto_cv/' . $fileName;
            }


            /* ============================================================
           4. UPDATE DATA UTAMA CV
        ============================================================ */
            $cv->update([

                // HALAMAN 1
                "email"                       => $request->email,
                "cabang_id"                   => $request->cabang_id,
                "batch"                       => $request->batch,
                "no_telepon"                  => $request->no_telepon,
                "no_orang_tua"                => $request->no_orang_tua,
                "bidang_sertifikasi"          => $request->bidang_sertifikasi,
                "bidang_sertifikasi_lainnya"  => $request->bidang_sertifikasi_lainnya,
                "program_pertanian_kawakami"  => $request->program_pertanian_kawakami,
                "sertifikat_files"            => json_encode($sertifikatPaths),

                // HALAMAN 2
                "pas_foto"                    => json_encode($pasFotoPaths),
                "pas_foto_cv"                 => $pasFotoPathCv,
                "nama_lengkap_romaji"         => $request->nama_lengkap_romaji,
                "nama_lengkap_katakana"       => $request->nama_lengkap_katakana,
                "nama_panggilan_romaji"       => $request->nama_panggilan_romaji,
                "nama_panggilan_katakana"     => $request->nama_panggilan_katakana,
                "jenis_kelamin"               => $request->jenis_kelamin,
                "agama"                       => $request->agama,
                "agama_lainnya"               => $request->agama_lainnya,
                "tanggal_lahir"               => $request->tanggal_lahir,
                "tempat_lahir"                => $request->tempat_lahir,
                "usia"                        => $request->usia,
                "alamat_lengkap"              => $request->alamat_lengkap,

                "provinsi"                    => $request->provinsi,
                "kabupaten"                   => $request->kabupaten,
                "kecamatan"                   => $request->kecamatan,
                "kelurahan"                   => $request->kelurahan,

                "email_aktif"                 => $request->email_aktif,
                "status_perkawinan"           => $request->status_perkawinan,
                "status_perkawinan_lainnya"   => $request->status_perkawinan_lainnya,
                "golongan_darah"              => $request->golongan_darah,
                "surat_izin_mengemudi"        => $request->surat_izin_mengemudi,
                "jenis_sim"                   => $request->jenis_sim,
                "merokok"                     => $request->merokok,
                "minum_alkohol"               => $request->minum_alkohol,
                "bertato"                     => $request->bertato,
                "tinggi_badan"                => $request->tinggi_badan,
                "berat_badan"                 => $request->berat_badan,
                "ukuran_pinggang"             => $request->ukuran_pinggang,
                "ukuran_sepatu"               => $request->ukuran_sepatu,
                "ukuran_atasan_baju"          => $request->ukuran_atasan_baju,
                "ukuran_atasan_baju_lainnya"  => $request->ukuran_atasan_baju_lainnya,
                "ukuran_celana"               => $request->ukuran_celana,
                "tangan_dominan"              => $request->tangan_dominan,
                "kemampuan_penglihatan_mata"  => $request->kemampuan_penglihatan_mata,
                "kemampuan_penglihatan_mata_lainnya" => $request->kemampuan_penglihatan_mata_lainnya,
                "sudah_vaksin_berapa_kali"    => $request->sudah_vaksin_berapa_kali,
                "sudah_vaksin_berapa_kali_lainnya" => $request->sudah_vaksin_berapa_kali_lainnya,
                "kesehatan_badan"             => $request->kesehatan_badan,
                "penyakit_cedera_masa_lalu"   => $request->penyakit_cedera_masa_lalu,
                "hobi"                        => $request->hobi,
                "rencana_sumber_biaya_keberangkatan" => $request->rencana_sumber_biaya_keberangkatan,
                "perkiraan_biaya"             => $request->perkiraan_biaya,
                "Biaya_keberangkatan_sebelumnya_jisshu" => $request->Biaya_keberangkatan_sebelumnya_jisshu,

                // HALAMAN 3
                "lama_belajar_di_mendunia"    => $request->lama_belajar_di_mendunia,
                "kemampuan_bahasa_jepang"     => $request->kemampuan_bahasa_jepang,
                "kemampuan_pemahaman_ssw"     => $request->kemampuan_pemahaman_ssw,
                "kelincahan_dalam_bekerja"    => $request->kelincahan_dalam_bekerja,
                "kekuatan_tindakan"           => $request->kekuatan_tindakan,
                "kemampuan_berbahasa_inggris" => $request->kemampuan_berbahasa_inggris,
                "kemampuan_berbahasa_inggris_lainnya" => $request->kemampuan_berbahasa_inggris_lainnya,
                "kebugaran_jasmani_seminggu"  => $request->kebugaran_jasmani_seminggu,
                "kebugaran_jasmani_seminggu_lainnya" => $request->kebugaran_jasmani_seminggu_lainnya,

                "bersedia_kerja_shift"   => $request->bersedia_kerja_shift,
                "bersedia_lembur"        => $request->bersedia_lembur,
                "bersedia_hari_libur"    => $request->bersedia_hari_libur,
                "menggunakan_kacamata"   => $request->menggunakan_kacamata,

                // HALAMAN 5


                // ========= HALAMAN 5 =========
                "ada_keluarga_di_jepang"      => $request->ada_keluarga_di_jepang,
                "hubungan_keluarga_di_jepang" => $request->hubungan_keluarga_di_jepang,
                "status_kerabat_di_jepang"    => $request->status_kerabat_di_jepang,
                "status_kerabat_di_jepang_lainnya" => $request->status_kerabat_di_jepang_lainnya,
                "ingin_bekerja_berapa_tahun"  => $request->ingin_bekerja_berapa_tahun,
                "ingin_bekerja_berapa_tahun_lainnya" => $request->ingin_bekerja_berapa_tahun_lainnya,
                "ingin_pulang_berapa_kali"    => $request->ingin_pulang_berapa_kali,
                "kelebihan_diri"              => $request->kelebihan_diri,
                "komentar_guru_kelebihan_diri" => $request->komentar_guru_kelebihan_diri,
                "kekurangan_diri"             => $request->kekurangan_diri,
                "komentar_guru_kekurangan_diri" => $request->komentar_guru_kekurangan_diri,
                "ketertarikan_terhadap_jepang" => $request->ketertarikan_terhadap_jepang,
                "orang_yang_dihormati"        => $request->orang_yang_dihormati,
                "point_plus_diri"             => $request->point_plus_diri,
                "keahlian_khusus"             => $request->keahlian_khusus,


                // ====== ISTRI ======
                "istri_nama"       => $request->istri_nama,
                "istri_usia"       => $request->istri_usia,
                "istri_pekerjaan"  => $request->istri_pekerjaan,

                // ====== ANAK ======
                "anak_nama"            => $request->anak_nama,
                "anak_jenis_kelamin"   => $request->anak_jenis_kelamin,
                "anak_usia"            => $request->anak_usia,
                "anak_pendidikan"      => $request->anak_pendidikan,

                // ====== IBU ======
                "ibu_nama"       => $request->ibu_nama,
                "ibu_usia"       => $request->ibu_usia,
                "ibu_pekerjaan"  => $request->ibu_pekerjaan,

                // ====== AYAH ======
                "ayah_nama"       => $request->ayah_nama,
                "ayah_usia"       => $request->ayah_usia,
                "ayah_pekerjaan"  => $request->ayah_pekerjaan,

                // ====== KAKAK ======
                "kakak_nama"            => $request->kakak_nama,
                "kakak_usia"            => $request->kakak_usia,
                "kakak_jenis_kelamin"   => $request->kakak_jenis_kelamin,
                "kakak_pekerjaan"       => $request->kakak_pekerjaan,
                "kakak_status"          => $request->kakak_status,

                // ====== ADIK ======
                "adik_nama"            => $request->adik_nama,
                "adik_usia"            => $request->adik_usia,
                "adik_jenis_kelamin"   => $request->adik_jenis_kelamin,
                "adik_pekerjaan"       => $request->adik_pekerjaan,
                "adik_status"          => $request->adik_status,

                // ====== PENGHASILAN ======
                "rata_rata_penghasilan_keluarga" => $request->rata_rata_penghasilan_keluarga,
            ]);

            // ===================================================================================
            // 2. RELASI: HAPUS DATA LAMA → TAMBAH DATA BARU (SIMPLE TANPA VALIDASI)
            // ===================================================================================

            // Hapus semua relasi lama
            Pendidikan::where('cv_id', $cv->id)->delete();
            Pengalaman::where('cv_id', $cv->id)->delete();
            MagangJisshu::where('cv_id', $cv->id)->delete();
            RiwayatPekerjaanTerakhir::where('cv_id', $cv->id)->delete();

            // ========================
            // PENDIDIKAN BARU
            // ========================
            if ($request->pendidikan_nama) {
                foreach ($request->pendidikan_nama as $i => $nama) {
                    Pendidikan::create([
                        'cv_id'       => $cv->id,
                        'nama'        => $nama,
                        'jurusan'     => $request->pendidikan_jurusan[$i] ?? null,
                        'tahun_masuk' => $request->pendidikan_tahun_masuk[$i] ?? null,
                        'tahun_lulus' => $request->pendidikan_tahun_lulus[$i] ?? null,
                    ]);
                }
            }

            // ========================
            // PENGALAMAN BARU
            // ========================
            if ($request->pengalaman_perusahaan) {
                foreach ($request->pengalaman_perusahaan as $i => $perusahaan) {
                    Pengalaman::create([
                        'cv_id'          => $cv->id,
                        'perusahaan'     => $perusahaan,
                        'jabatan'        => $request->pengalaman_jabatan[$i] ?? null,
                        'tanggal_masuk'  => $request->pengalaman_tanggal_masuk[$i] ?? null,
                        'tanggal_keluar' => $request->pengalaman_tanggal_keluar[$i] ?? null,
                        'gaji'           => $request->pengalaman_gaji[$i] ?? null,
                        'kota'           => $request->pengalaman_kota[$i] ?? null,
                    ]);
                }
            }

            // ========================
            // MAGANG / JISSHU BARU
            // ========================
            if ($request->magang_perusahaan) {
                foreach ($request->magang_perusahaan as $i => $perusahaan) {
                    MagangJisshu::create([
                        'cv_id'          => $cv->id,
                        'perusahaan'     => $perusahaan,
                        'kota_prefektur' => $request->magang_kota_prefektur[$i] ?? null,
                        'bidang'         => $request->magang_bidang[$i] ?? null,
                        'tahun_mulai'    => $request->magang_tahun_mulai[$i] ?? null,
                        'tahun_selesai'  => $request->magang_tahun_selesai[$i] ?? null,
                    ]);
                }
            }

            // ===============================
            // RIWAYAT PEKERJAAN TERAKHIR BARU
            // ===============================
            if ($request->nama_perusahaan) {
                foreach ($request->nama_perusahaan as $i => $perusahaan) {
                    RiwayatPekerjaanTerakhir::create([
                        'cv_id'                       => $cv->id,

                        'nama_perusahaan'             => $perusahaan,
                        'nama_kumiai'                 => $request->nama_kumiai[$i] ?? null,
                        'total_karyawan'              => $request->total_karyawan[$i] ?? null,
                        'total_karyawan_asing'        => $request->total_karyawan_asing[$i] ?? null,
                        'bidang_pekerjaan'            => $request->bidang_pekerjaan[$i] ?? null,
                        'klasifikasi_pekerjaan'       => $request->klasifikasi_pekerjaan[$i] ?? null,

                        'masa_pelatihan_mulai_tahun'  => $request->masa_pelatihan_mulai_tahun[$i] ?? null,
                        'masa_pelatihan_mulai_bulan'  => $request->masa_pelatihan_mulai_bulan[$i] ?? null,
                        'masa_pelatihan_selesai_tahun' => $request->masa_pelatihan_selesai_tahun[$i] ?? null,
                        'masa_pelatihan_selesai_bulan' => $request->masa_pelatihan_selesai_bulan[$i] ?? null,

                        'penanggung_jawab'            => $request->penanggung_jawab[$i] ?? null,
                        'shift_normal'                => $request->shift_normal[$i] ?? null,

                        'jam_kerja_mulai_1'           => $request->jam_kerja_mulai_1[$i] ?? null,
                        'jam_kerja_selesai_1'         => $request->jam_kerja_selesai_1[$i] ?? null,
                        'jam_kerja_mulai_2'           => $request->jam_kerja_mulai_2[$i] ?? null,
                        'jam_kerja_selesai_2'         => $request->jam_kerja_selesai_2[$i] ?? null,
                        'jam_kerja_mulai_3'           => $request->jam_kerja_mulai_3[$i] ?? null,
                        'jam_kerja_selesai_3'         => $request->jam_kerja_selesai_3[$i] ?? null,

                        'hari_libur'                  => $request->hari_libur[$i] ?? null,
                        'detail_pekerjaan'            => $request->detail_pekerjaan[$i] ?? null,
                        'barang_cacat_action'         => $request->barang_cacat_action[$i] ?? null,

                        'prefektur'                   => $request->prefektur[$i] ?? null,
                        'kota'                        => $request->kota[$i] ?? null,

                        'status_visa'                 => $request->status_visa[$i] ?? null,

                        'masa_tinggal_mulai_tahun'    => $request->masa_tinggal_mulai_tahun[$i] ?? null,
                        'masa_tinggal_mulai_bulan'    => $request->masa_tinggal_mulai_bulan[$i] ?? null,
                        'masa_tinggal_selesai_tahun'  => $request->masa_tinggal_selesai_tahun[$i] ?? null,
                        'masa_tinggal_selesai_bulan'  => $request->masa_tinggal_selesai_bulan[$i] ?? null,

                        'gaji_per_jam'                => $request->gaji_per_jam[$i] ?? null,
                        'gaji_bersih'                 => $request->gaji_bersih[$i] ?? null,
                        'lembur_bulanan'              => $request->lembur_bulanan[$i] ?? null,

                        'asrama_kamar'                => $request->asrama_kamar[$i] ?? null,
                        'asrama_jumlah_orang'         => $request->asrama_jumlah_orang[$i] ?? null,

                        'transportasi'                => $request->transportasi[$i] ?? null,
                        'jarak_tempuh_menit'          => $request->jarak_tempuh_menit[$i] ?? null,

                        'punya_hanko'                 => $request->punya_hanko[$i] ?? null,
                        'nama_hanko_sama_cv'          => $request->nama_hanko_sama_cv[$i] ?? null,
                        'nama_katakana_hanko'         => $request->nama_katakana_hanko[$i] ?? null,
                    ]);
                }
            }

            DB::commit();

            // Bagian ini adalah respons sukses yang diubah dari JSON
            // Menambahkan pesan sukses ke session ('success') dan mengarahkan kembali ke halaman sebelumnya
            return redirect()->back()->with('success', 'Data CV berhasil diperbarui!');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memperbarui data CV. Pesan Kesalahan: ' . $e->getMessage());
        }
    }

    public function editcvkandidat($id)
    {
        $cv = Cv::with([
            'cabang',
            'pendidikans',
            'magangjisshu',
            'pengalamans',    // <— Tambahkan relasi ini
        ])->findOrFail($id);

        $cabangs = Cabang::all();

        return view('cv.edit_all_cv', compact('cv', 'cabangs'));
    }




    public function show($id)
    {
        $cv = Cv::with([
            'pendidikans',
            'pengalamans',
            'magangjisshu',
            'riwayatpekerjaanterakhir' // sesuai relasi
        ])->findOrFail($id);

        return view('cv.show', compact('cv'));
    }

    public function showPdf($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_kaigo', compact('cv'));
    }
    public function showPdfVioleta($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_violeta', compact('cv'));
    }
    public function showPdfNawasena($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_nawasena', compact('cv'));
    }
    public function showPdfYambo($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_yambo', compact('cv'));
    }
    public function showPdfMadoka($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_madoka', compact('cv'));
    }
    public function showPdfMendunia($id)
    {
        $cv = Cv::with(['pendidikans', 'pengalamans'])->findOrFail($id);
        return view('cv.pdf_mendunia', compact('cv'));
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
        // 1. Cari data CV yang akan diupdate
        $cv = Cv::find($id);

        if (!$cv) {
            return response()->json([
                "status" => "error",
                "message" => "Data CV tidak ditemukan."
            ], 404);
        }

        DB::beginTransaction();

        try {

            /* ============================================================
        1. VALIDASI
        ============================================================ */
            $request->validate([
                // Pas Foto CV
                "pas_foto_cv" => "nullable|file|mimes:jpg,jpeg,png|max:2048",

                // Data Diri
                "nama_lengkap_romaji" => "required|string|max:255",
                "nama_lengkap_katakana" => "required|string|max:255",
                "nama_panggilan_romaji" => "required|string|max:255",
                "nama_panggilan_katakana" => "required|string|max:255",
                "jenis_kelamin" => "required|in:男 (Laki-laki),女 (Perempuan)",
                "agama" => "required|string|max:100",
                "agama_lainnya" => "nullable|string|max:100",
                "tempat_lahir" => "required|string|max:255",
                "tanggal_lahir" => "required|date",
                "usia" => "required|numeric",
                "alamat_lengkap" => "required|string",
                "email_aktif" => "required|email|max:255",
                "status_perkawinan" => "required|in:Sudah Menikah,Belum Menikah",
                "status_perkawinan_lainnya" => "nullable|string|max:100",
                "golongan_darah" => "required|in:A,B,AB,O",
                "surat_izin_mengemudi" => "required|in:Ada,Tidak",
                "jenis_sim" => "nullable|in:SIM A,SIM B,SIM C,SIM D",


                // Pendidikan & Pengalaman (Array)
                "nama.*" => "nullable|string|max:255",
                "jurusan.*" => "nullable|string|max:255",
                "tahun_masuk.*" => "nullable|numeric|min:1950|max:2100",
                "tahun_lulus.*" => "nullable|numeric|min:1950|max:2100",

                "kerja_perusahaan.*" => "nullable|string|max:255",
                "kerja_jabatan.*" => "nullable|string|max:255",
                "kerja_tanggal_masuk.*" => "nullable|date_format:Y-m",
                "kerja_tanggal_keluar.*" => "nullable|date_format:Y-m",
                "kerja_gaji.*" => "nullable|string|max:50",
            ]);


            // Data file lama
            $oldPasFotoCvPath = $cv->pas_foto_cv;
            $pasFotoPathCv = $oldPasFotoCvPath;


            /* ============================================================
        2. UPLOAD PAS FOTO CV (SINGLE) → HAPUS FILE LAMA JIKA DIUBAH
        ============================================================ */
            if ($request->hasFile('pas_foto_cv')) {
                // Hapus pas foto CV lama (jika ada)
                if ($oldPasFotoCvPath && File::exists(storage_path('app/public/' . $oldPasFotoCvPath))) {
                    File::delete(storage_path('app/public/' . $oldPasFotoCvPath));
                }

                // Upload pas foto CV baru
                $file = $request->file('pas_foto_cv');
                $pasFotoPathCv = $file->store('uploads/pas_foto_cv', 'public');
            }


            /* ============================================================
        3. PERBARUI DATA CV (HANYA DATA DIRI)
        ============================================================ */
            $cv->update([
                // Pas Foto CV
                "pas_foto_cv" => $pasFotoPathCv,

                // Data Diri
                "nama_lengkap_romaji" => $request->nama_lengkap_romaji,
                "nama_lengkap_katakana" => $request->nama_lengkap_katakana,
                "nama_panggilan_romaji" => $request->nama_panggilan_romaji,
                "nama_panggilan_katakana" => $request->nama_panggilan_katakana,
                "jenis_kelamin" => $request->jenis_kelamin,
                "agama" => $request->agama,
                "agama_lainnya" => $request->agama_lainnya,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "usia" => $request->usia,
                "alamat_lengkap" => $request->alamat_lengkap,
                "email_aktif" => $request->email_aktif,
                "status_perkawinan" => $request->status_perkawinan,
                "status_perkawinan_lainnya" => $request->status_perkawinan_lainnya,
                "golongan_darah" => $request->golongan_darah,
                "surat_izin_mengemudi" => $request->surat_izin_mengemudi,
                "jenis_sim" => $request->jenis_sim,
            ]);


            // Hapus data pendidikan lama
            Pendidikan::where('cv_id', $cv->id)->delete();

            // Simpan data pendidikan baru
            if ($request->has('nama')) {
                foreach ($request->nama as $i => $nama) {
                    if (!empty($nama)) {
                        Pendidikan::create([
                            'cv_id' => $cv->id,
                            'nama' => $nama,
                            'jurusan' => $request->jurusan[$i] ?? null,
                            'tahun_masuk' => $request->tahun_masuk[$i] ?? null,
                            'tahun_lulus' => $request->tahun_lulus[$i] ?? null,
                        ]);
                    }
                }
            }



            // Hapus data pengalaman lama
            Pengalaman::where('cv_id', $cv->id)->delete();

            // Simpan data pengalaman baru
            if ($request->has('kerja_perusahaan')) {
                foreach ($request->kerja_perusahaan as $i => $perusahaan) {
                    if (!empty($perusahaan)) {
                        Pengalaman::create([
                            'cv_id' => $cv->id,
                            'perusahaan' => $perusahaan,
                            'jabatan' => $request->kerja_jabatan[$i] ?? null,
                            'tanggal_masuk' => $request->kerja_tanggal_masuk[$i] ?? null,
                            'tanggal_keluar' => $request->kerja_tanggal_keluar[$i] ?? null,
                            'gaji' => $request->kerja_gaji[$i] ?? null,
                        ]);
                    }
                }
            }


            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Data CV berhasil diperbarui!"
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            // Log error
            Log::error("Gagal memperbarui CV ID: $id. Error: " . $e->getMessage());

            return response()->json([
                "status" => "error",
                "message" => "Gagal memperbarui CV.",
                "detail" => $e->getMessage(),
            ], 500);
        }
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
