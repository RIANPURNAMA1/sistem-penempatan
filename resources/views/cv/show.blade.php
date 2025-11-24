@extends('layouts.app')

@section('title', 'Detail CV')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail CV: {{ $cv->nama_lengkap_romaji ?? $cv->nama_lengkap_katakana }}</h2>

    <div class="card shadow-sm border-0 rounded-4 p-3">

        {{-- PAS FOTO --}}
        <h5 class="mb-3">Pas Foto</h5>
        @if($cv->pas_foto)
            @foreach(json_decode($cv->pas_foto) as $foto)
                <img src="{{ asset('uploads/pasfoto/'.$foto) }}" alt="Pas Foto" class="img-thumbnail mb-2" style="max-width: 150px;">
            @endforeach
        @else
            <p>-</p>
        @endif

        <hr>

        {{-- HALAMAN 1 - Data Awal --}}
        <h5 class="mb-3">Data Awal</h5>
        <p><strong>Email:</strong> {{ $cv->email }}</p>
        <p><strong>Cabang ID:</strong> {{ $cv->cabang->nama_cabang }}</p>
        <p><strong>Batch:</strong> {{ $cv->batch }}</p>
        <p><strong>No Telepon:</strong> {{ $cv->no_telepon }}</p>
        <p><strong>No Orang Tua:</strong> {{ $cv->no_orang_tua }}</p>
        <p><strong>Bidang Sertifikasi:</strong> {{ $cv->bidang_sertifikasi }} {{ $cv->bidang_sertifikasi_lainnya ? '('.$cv->bidang_sertifikasi_lainnya.')' : '' }}</p>
        <p><strong>Program Pertanian Kawakami:</strong> {{ $cv->program_pertanian_kawakami }}</p>
        <p><strong>Sertifikat Files:</strong> 
            @if($cv->sertifikat_files)
                @foreach(json_decode($cv->sertifikat_files) as $file)
                    <a href="{{ asset('uploads/'.$file) }}" target="_blank">{{ $file }}</a><br>
                @endforeach
            @else
                -
            @endif
        </p>

        <hr>

        {{-- HALAMAN 2 - Data Diri --}}
        <h5 class="mb-3">Data Diri</h5>
        <p><strong>Nama Lengkap:</strong> {{ $cv->nama_lengkap_romaji ?? $cv->nama_lengkap_katakana }}</p>
        <p><strong>Nama Panggilan:</strong> {{ $cv->nama_panggilan_romaji ?? $cv->nama_panggilan_katakana }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $cv->jenis_kelamin }}</p>
        <p><strong>Agama:</strong> {{ $cv->agama }} {{ $cv->agama_lainnya ? '('.$cv->agama_lainnya.')' : '' }}</p>
        <p><strong>Tempat & Tanggal Lahir:</strong> {{ $cv->tempat_tanggal_lahir }}</p>
        <p><strong>Usia:</strong> {{ $cv->usia }}</p>
        <p><strong>Alamat:</strong> {{ $cv->alamat_lengkap }}</p>
        <p><strong>Email Aktif:</strong> {{ $cv->email_aktif ?? '-' }}</p>
        <p><strong>Status Perkawinan:</strong> {{ $cv->status_perkawinan }} {{ $cv->status_perkawinan_lainnya ? '('.$cv->status_perkawinan_lainnya.')' : '' }}</p>
        <p><strong>Golongan Darah:</strong> {{ $cv->golongan_darah }}</p>
        <p><strong>Surat Izin Mengemudi:</strong> {{ $cv->surat_izin_mengemudi }} {{ $cv->jenis_sim ? '('.$cv->jenis_sim.')' : '' }}</p>
        <p><strong>Merokok:</strong> {{ $cv->merokok }}</p>
        <p><strong>Minum Alkohol:</strong> {{ $cv->minum_alkohol }}</p>
        <p><strong>Bertato:</strong> {{ $cv->bertato }}</p>
        <p><strong>Tinggi / Berat / Ukuran Pinggang / Sepatu:</strong> {{ $cv->tinggi_badan }} cm / {{ $cv->berat_badan }} kg / {{ $cv->ukuran_pinggang }} / {{ $cv->ukuran_sepatu }}</p>
        <p><strong>Ukuran Baju / Celana:</strong> {{ $cv->ukuran_atasan_baju }} {{ $cv->ukuran_atasan_baju_lainnya ? '('.$cv->ukuran_atasan_baju_lainnya.')' : '' }} / {{ $cv->ukuran_celana }}</p>
        <p><strong>Tangan Dominan:</strong> {{ $cv->tangan_dominan }}</p>
        <p><strong>Kemampuan Penglihatan Mata:</strong> {{ $cv->kemampuan_penglihatan_mata }} {{ $cv->kemampuan_penglihatan_mata_lainnya ? '('.$cv->kemampuan_penglihatan_mata_lainnya.')' : '' }}</p>
        <p><strong>Vaksinasi:</strong> {{ $cv->sudah_vaksin_berapa_kali }} {{ $cv->sudah_vaksin_berapa_kali_lainnya ? '('.$cv->sudah_vaksin_berapa_kali_lainnya.')' : '' }}</p>
        <p><strong>Kesehatan Badan:</strong> {{ $cv->kesehatan_badan }}</p>
        <p><strong>Penyakit / Cedera Masa Lalu:</strong> {{ $cv->penyakit_cedera_masa_lalu }}</p>
        <p><strong>Hobi:</strong> {{ $cv->hobi }}</p>
        <p><strong>Rencana Sumber Biaya Keberangkatan:</strong> {{ $cv->rencana_sumber_biaya_keberangkatan }}</p>
        <p><strong>Perkiraan Biaya:</strong> {{ $cv->perkiraan_biaya }}</p>

        <hr>

        {{-- HALAMAN 3 - Pembelajaran di Mendunia --}}
        <h5 class="mb-3">Pembelajaran di Mendunia</h5>
        <p><strong>Lama Belajar di Mendunia:</strong> {{ $cv->lama_belajar_di_mendunia }}</p>
        <p><strong>Kemampuan Bahasa Jepang:</strong> {{ $cv->kemampuan_bahasa_jepang }}</p>
        <p><strong>Kemampuan Pemahaman SSW:</strong> {{ $cv->kemampuan_pemahaman_ssw }}</p>
        <p><strong>Kelincahan dalam Bekerja:</strong> {{ $cv->kelincahan_dalam_bekerja }}</p>
        <p><strong>Kekuatan Tindakan:</strong> {{ $cv->kekuatan_tindakan }}</p>
        <p><strong>Kemampuan Bahasa Inggris:</strong> {{ $cv->kemampuan_berbahasa_inggris }} {{ $cv->kemampuan_berbahasa_inggris_lainnya ? '('.$cv->kemampuan_berbahasa_inggris_lainnya.')' : '' }}</p>
        <p><strong>Kebugaran Jasmani / Minggu:</strong> {{ $cv->kebugaran_jasmani_seminggu }} {{ $cv->kebugaran_jasmani_seminggu_lainnya ? '('.$cv->kebugaran_jasmani_seminggu_lainnya.')' : '' }}</p>

        <hr>

        {{-- HALAMAN 5 - Daya Tarik Perusahaan --}}
        <h5 class="mb-3">Daya Tarik Perusahaan</h5>
        <p><strong>Ada Keluarga di Jepang:</strong> {{ $cv->ada_keluarga_di_jepang }}</p>
        <p><strong>Hubungan Keluarga:</strong> {{ $cv->hubungan_keluarga_di_jepang }}</p>
        <p><strong>Status Kerabat di Jepang:</strong> {{ $cv->status_kerabat_di_jepang }} {{ $cv->status_kerabat_di_jepang_lainnya ? '('.$cv->status_kerabat_di_jepang_lainnya.')' : '' }}</p>
        <p><strong>Ingin Bekerja Berapa Tahun:</strong> {{ $cv->ingin_bekerja_berapa_tahun }} {{ $cv->ingin_bekerja_berapa_tahun_lainnya ? '('.$cv->ingin_bekerja_berapa_tahun_lainnya.')' : '' }}</p>
        <p><strong>Ingin Pulang Berapa Kali:</strong> {{ $cv->ingin_pulang_berapa_kali }}</p>
        <p><strong>Kelebihan Diri:</strong> {{ $cv->kelebihan_diri }}</p>
        <p><strong>Komentar Guru Kelebihan Diri:</strong> {{ $cv->komentar_guru_kelebihan_diri }}</p>
        <p><strong>Kekurangan Diri:</strong> {{ $cv->kekurangan_diri }}</p>
        <p><strong>Komentar Guru Kekurangan Diri:</strong> {{ $cv->komentar_guru_kekurangan_diri }}</p>
        <p><strong>Ketertarikan terhadap Jepang:</strong> {{ $cv->ketertarikan_terhadap_jepang }}</p>
        <p><strong>Orang yang Dihormati:</strong> {{ $cv->orang_yang_dihormati }}</p>
        <p><strong>Point Plus Diri:</strong> {{ $cv->point_plus_diri }}</p>
        <p><strong>Keahlian Khusus:</strong> {{ $cv->keahlian_khusus }}</p>

        <hr>

        {{-- HALAMAN 6 - Data Anggota Keluarga --}}
        <h5 class="mb-3">Data Anggota Keluarga</h5>
        <p><strong>Istri:</strong> {{ $cv->anggota_keluarga_istri ?? '-' }}</p>
        <p><strong>Suami:</strong> {{ $cv->anggota_keluarga_suami ?? '-' }}</p>
        <p><strong>Anak:</strong> {{ $cv->anggota_keluarga_anak ?? '-' }}</p>
        <p><strong>Ibu:</strong> {{ $cv->anggota_keluarga_ibu }}</p>
        <p><strong>Ayah:</strong> {{ $cv->anggota_keluarga_ayah }}</p>
        <p><strong>Kakak:</strong> {{ $cv->anggota_keluarga_kakak ?? '-' }}</p>
        <p><strong>Adik:</strong> {{ $cv->anggota_keluarga_adik ?? '-' }}</p>
        <p><strong>Rata-rata Penghasilan Keluarga:</strong> {{ $cv->rata_rata_penghasilan_keluarga }}</p>

        <hr>

        {{-- Pendidikan & Pengalaman --}}
        <h5 class="mb-3">Pendidikan</h5>
        @forelse($cv->pendidikans ?? [] as $p)
            <p>• {{ $p->nama }} ({{ $p->tahun }}) - {{ $p->jurusan }}</p>
        @empty
            <p>-</p>
        @endforelse

        <h5 class="mb-3">Pengalaman Kerja</h5>
        @forelse($cv->pengalamans ?? [] as $p)
            <p>• {{ $p->perusahaan }} - {{ $p->jabatan }} ({{ $p->periode }})</p>
        @empty
            <p>-</p>
        @endforelse

    </div>
</div>
@endsection
