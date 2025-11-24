@extends('layouts.app')

@section('title', 'Tambah CV')

@section('content')
    <div class="container mt-5">
       @if ($alreadyRegistered)
<script>
    document.addEventListener("DOMContentLoaded", function () {

        Swal.fire({
            title: 'Peringatan!',
            text: 'Anda sudah melakukan pendaftaran sebelumnya dan tidak dapat mendaftar lagi.',
            icon: 'warning',
            showCancelButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: 'Kembali',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '/'; // kembali ke halaman sebelumnya
            }
        });

        // Disable semua elemen form
        const form = document.getElementById("cvForm");
        if (form) {
            [...form.elements].forEach(input => input.disabled = true);
        }
    });
</script>
@endif



        {{-- ALERT dari session error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            {{-- Disable form --}}
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const form = document.getElementById("cvForm");

                    if (form) {
                        [...form.elements].forEach(input => input.disabled = true);
                    }
                });
            </script>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Form Curriculum Vitae (CV)</h4>
                    </div>
                    <div class="card-body">

                        {{-- Alert untuk Success/Error --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Berhasil!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Gagal!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terdapat kesalahan validasi:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form id="cvForm" action="{{ route('pendaftaran.cv.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- HALAMAN 1: DATA AWAL --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Data Awal</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <select name="cabang_id"
                                                class="form-control mt-2 @error('cabang_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Cabang --</option>
                                                @foreach ($cabangs as $cabang)
                                                    <option value="{{ $cabang->id }}"
                                                        {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>
                                                        {{ $cabang->nama_cabang }} - {{ $cabang->alamat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cabang_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="batch"
                                                class="form-control mt-2 @error('batch') is-invalid @enderror"
                                                placeholder="Batch" value="{{ old('batch') }}" required>
                                            @error('batch')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="no_telepon"
                                                class="form-control mt-2 @error('no_telepon') is-invalid @enderror"
                                                placeholder="No Telepon" value="{{ old('no_telepon') }}" required>
                                            @error('no_telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="no_orang_tua" class="form-control mt-2"
                                                placeholder="No Orang Tua" value="{{ old('no_orang_tua') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <select name="bidang_sertifikasi"
                                                class="form-control @error('bidang_sertifikasi') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Bidang Sertifikasi --</option>
                                                <option value="Pengolahan Makanan"
                                                    {{ old('bidang_sertifikasi') == 'Pengolahan Makanan' ? 'selected' : '' }}>
                                                    Pengolahan Makanan</option>
                                                <option value="Pertanian"
                                                    {{ old('bidang_sertifikasi') == 'Pertanian' ? 'selected' : '' }}>
                                                    Pertanian</option>
                                                <option value="Kaigo (perawat)"
                                                    {{ old('bidang_sertifikasi') == 'Kaigo (perawat)' ? 'selected' : '' }}>
                                                    Kaigo (perawat)</option>
                                                <option value="Building Cleaning"
                                                    {{ old('bidang_sertifikasi') == 'Building Cleaning' ? 'selected' : '' }}>
                                                    Building Cleaning</option>
                                                <option value="Restoran"
                                                    {{ old('bidang_sertifikasi') == 'Restoran' ? 'selected' : '' }}>
                                                    Restoran</option>
                                                <option value="Driver"
                                                    {{ old('bidang_sertifikasi') == 'Driver' ? 'selected' : '' }}>Driver
                                                </option>
                                                <option value="Hanya JFT"
                                                    {{ old('bidang_sertifikasi') == 'Hanya JFT' ? 'selected' : '' }}>Hanya
                                                    JFT</option>
                                            </select>
                                            @error('bidang_sertifikasi')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="bidang_sertifikasi_lainnya"
                                                class="form-control mt-2"
                                                placeholder="Bidang Sertifikasi Lainnya (Opsional)"
                                                value="{{ old('bidang_sertifikasi_lainnya') }}">

                                            <select name="program_pertanian_kawakami"
                                                class="form-control mt-2 @error('program_pertanian_kawakami') is-invalid @enderror"
                                                required>
                                                <option value="">-- Program Pertanian Kawakami --</option>
                                                <option value="Ya"
                                                    {{ old('program_pertanian_kawakami') == 'Ya' ? 'selected' : '' }}>Ya
                                                </option>
                                                <option value="Tidak"
                                                    {{ old('program_pertanian_kawakami') == 'Tidak' ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                            @error('program_pertanian_kawakami')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <label class="mt-2">Upload Sertifikat (PDF/JPG/PNG, Max 10MB)</label>
                                            <input type="file" name="sertifikat_files[]" class="form-control mt-1"
                                                multiple accept=".pdf,.jpg,.jpeg,.png">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- HALAMAN 2: DATA DIRI --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Data Diri</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>Upload Pas Foto (JPG/PNG, Max 2MB)</label>
                                            <input type="file" name="pas_foto[]" class="form-control mt-1" multiple
                                                accept=".jpg,.jpeg,.png">

                                            <input type="text" name="nama_lengkap_romaji"
                                                class="form-control mt-2 @error('nama_lengkap_romaji') is-invalid @enderror"
                                                placeholder="Nama Lengkap Romaji"
                                                value="{{ old('nama_lengkap_romaji') }}" required>
                                            @error('nama_lengkap_romaji')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="nama_lengkap_katakana"
                                                class="form-control mt-2 @error('nama_lengkap_katakana') is-invalid @enderror"
                                                placeholder="Nama Lengkap Katakana"
                                                value="{{ old('nama_lengkap_katakana') }}" required>
                                            @error('nama_lengkap_katakana')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="nama_panggilan_romaji"
                                                class="form-control mt-2 @error('nama_panggilan_romaji') is-invalid @enderror"
                                                placeholder="Nama Panggilan Romaji"
                                                value="{{ old('nama_panggilan_romaji') }}" required>
                                            @error('nama_panggilan_romaji')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="nama_panggilan_katakana"
                                                class="form-control mt-2 @error('nama_panggilan_katakana') is-invalid @enderror"
                                                placeholder="Nama Panggilan Katakana"
                                                value="{{ old('nama_panggilan_katakana') }}" required>
                                            @error('nama_panggilan_katakana')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <select name="jenis_kelamin"
                                                class="form-control mt-2 @error('jenis_kelamin') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="男 (Laki-laki)"
                                                    {{ old('jenis_kelamin') == '男 (Laki-laki)' ? 'selected' : '' }}>男
                                                    (Laki-laki)</option>
                                                <option value="女 (Perempuan)"
                                                    {{ old('jenis_kelamin') == '女 (Perempuan)' ? 'selected' : '' }}>女
                                                    (Perempuan)</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="agama"
                                                class="form-control mt-2 @error('agama') is-invalid @enderror"
                                                placeholder="Agama" value="{{ old('agama') }}" required>
                                            @error('agama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="agama_lainnya" class="form-control mt-2"
                                                placeholder="Agama Lainnya (Opsional)"
                                                value="{{ old('agama_lainnya') }}">

                                            <input type="text" name="tempat_tanggal_lahir"
                                                class="form-control mt-2 @error('tempat_tanggal_lahir') is-invalid @enderror"
                                                placeholder="Tempat / Tanggal Lahir"
                                                value="{{ old('tempat_tanggal_lahir') }}" required>
                                            @error('tempat_tanggal_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="usia"
                                                class="form-control mt-2 @error('usia') is-invalid @enderror"
                                                placeholder="Usia" value="{{ old('usia') }}" required>
                                            @error('usia')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <textarea name="alamat_lengkap" class="form-control mt-2 @error('alamat_lengkap') is-invalid @enderror"
                                                placeholder="Alamat Lengkap" required>{{ old('alamat_lengkap') }}</textarea>
                                            @error('alamat_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="email" name="email_aktif"
                                                class="form-control mt-2 @error('email_aktif') is-invalid @enderror"
                                                placeholder="Email Aktif" value="{{ old('email_aktif') }}" required>
                                            @error('email_aktif')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <select name="status_perkawinan"
                                                class="form-control mt-2 @error('status_perkawinan') is-invalid @enderror"
                                                required>
                                                <option value="">-- Status Perkawinan --</option>
                                                <option value="Sudah Menikah"
                                                    {{ old('status_perkawinan') == 'Sudah Menikah' ? 'selected' : '' }}>
                                                    Sudah Menikah</option>
                                                <option value="Belum Menikah"
                                                    {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>
                                                    Belum Menikah</option>
                                            </select>
                                            @error('status_perkawinan')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="status_perkawinan_lainnya"
                                                class="form-control mt-2"
                                                placeholder="Status Perkawinan Lainnya (Opsional)"
                                                value="{{ old('status_perkawinan_lainnya') }}">

                                            <select name="golongan_darah"
                                                class="form-control mt-2 @error('golongan_darah') is-invalid @enderror"
                                                required>
                                                <option value="">-- Golongan Darah --</option>
                                                @foreach (['A', 'B', 'AB', 'O'] as $gol)
                                                    <option value="{{ $gol }}"
                                                        {{ old('golongan_darah') == $gol ? 'selected' : '' }}>
                                                        {{ $gol }}</option>
                                                @endforeach
                                            </select>
                                            @error('golongan_darah')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="surat_izin_mengemudi"
                                                class="form-control mt-2 @error('surat_izin_mengemudi') is-invalid @enderror"
                                                required>
                                                <option value="">-- Surat Izin Mengemudi --</option>
                                                <option value="Ada"
                                                    {{ old('surat_izin_mengemudi') == 'Ada' ? 'selected' : '' }}>Ada
                                                </option>
                                                <option value="Tidak"
                                                    {{ old('surat_izin_mengemudi') == 'Tidak' ? 'selected' : '' }}>Tidak
                                                </option>
                                            </select>
                                            @error('surat_izin_mengemudi')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="jenis_sim" class="form-control mt-2">
                                                <option value="">-- Jenis SIM (Opsional) --</option>
                                                @foreach (['SIM A', 'SIM B', 'SIM C', 'SIM D'] as $sim)
                                                    <option value="{{ $sim }}"
                                                        {{ old('jenis_sim') == $sim ? 'selected' : '' }}>
                                                        {{ $sim }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <select name="merokok"
                                                class="form-control @error('merokok') is-invalid @enderror" required>
                                                <option value="">-- Merokok --</option>
                                                <option value="Ya" {{ old('merokok') == 'Ya' ? 'selected' : '' }}>Ya
                                                </option>
                                                <option value="Tidak" {{ old('merokok') == 'Tidak' ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                            @error('merokok')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="minum_alkohol"
                                                class="form-control mt-2 @error('minum_alkohol') is-invalid @enderror"
                                                required>
                                                <option value="">-- Minum Alkohol --</option>
                                                <option value="Ya"
                                                    {{ old('minum_alkohol') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="Tidak"
                                                    {{ old('minum_alkohol') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('minum_alkohol')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="bertato"
                                                class="form-control mt-2 @error('bertato') is-invalid @enderror" required>
                                                <option value="">-- Bertato --</option>
                                                <option value="Ya" {{ old('bertato') == 'Ya' ? 'selected' : '' }}>Ya
                                                </option>
                                                <option value="Tidak" {{ old('bertato') == 'Tidak' ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                            @error('bertato')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="tinggi_badan"
                                                class="form-control mt-2 @error('tinggi_badan') is-invalid @enderror"
                                                placeholder="Tinggi Badan (cm)" value="{{ old('tinggi_badan') }}"
                                                required>
                                            @error('tinggi_badan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="berat_badan"
                                                class="form-control mt-2 @error('berat_badan') is-invalid @enderror"
                                                placeholder="Berat Badan (kg)" value="{{ old('berat_badan') }}" required>
                                            @error('berat_badan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="ukuran_pinggang"
                                                class="form-control mt-2 @error('ukuran_pinggang') is-invalid @enderror"
                                                placeholder="Ukuran Pinggang (cm)" value="{{ old('ukuran_pinggang') }}"
                                                required>
                                            @error('ukuran_pinggang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="ukuran_sepatu"
                                                class="form-control mt-2 @error('ukuran_sepatu') is-invalid @enderror"
                                                placeholder="Ukuran Sepatu" value="{{ old('ukuran_sepatu') }}" required>
                                            @error('ukuran_sepatu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <select name="ukuran_atasan_baju"
                                                class="form-control mt-2 @error('ukuran_atasan_baju') is-invalid @enderror"
                                                required>
                                                <option value="">-- Ukuran Atasan Baju --</option>
                                                @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                    <option value="{{ $size }}"
                                                        {{ old('ukuran_atasan_baju') == $size ? 'selected' : '' }}>
                                                        {{ $size }}</option>
                                                @endforeach
                                            </select>
                                            @error('ukuran_atasan_baju')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="ukuran_atasan_baju_lainnya"
                                                class="form-control mt-2" placeholder="Ukuran Atasan Lainnya"
                                                value="{{ old('ukuran_atasan_baju_lainnya') }}">

                                            <select name="ukuran_celana"
                                                class="form-control mt-2 @error('ukuran_celana') is-invalid @enderror"
                                                required>
                                                <option value="">-- Ukuran Celana --</option>
                                                @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                    <option value="{{ $size }}"
                                                        {{ old('ukuran_celana') == $size ? 'selected' : '' }}>
                                                        {{ $size }}</option>
                                                @endforeach
                                            </select>
                                            @error('ukuran_celana')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="tangan_dominan"
                                                class="form-control mt-2 @error('tangan_dominan') is-invalid @enderror"
                                                required>
                                                <option value="">-- Tangan Dominan --</option>
                                                <option value="Kanan"
                                                    {{ old('tangan_dominan') == 'Kanan' ? 'selected' : '' }}>Kanan</option>
                                                <option value="Kiri"
                                                    {{ old('tangan_dominan') == 'Kiri' ? 'selected' : '' }}>Kiri</option>
                                            </select>
                                            @error('tangan_dominan')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="kemampuan_penglihatan_mata"
                                                class="form-control mt-2 @error('kemampuan_penglihatan_mata') is-invalid @enderror"
                                                required>
                                                <option value="">-- Kemampuan Penglihatan Mata --</option>
                                                <option value="Minus"
                                                    {{ old('kemampuan_penglihatan_mata') == 'Minus' ? 'selected' : '' }}>
                                                    Minus</option>
                                                <option value="Normal"
                                                    {{ old('kemampuan_penglihatan_mata') == 'Normal' ? 'selected' : '' }}>
                                                    Normal</option>
                                                <option value="Silinders"
                                                    {{ old('kemampuan_penglihatan_mata') == 'Silinders' ? 'selected' : '' }}>
                                                    Silinders</option>
                                            </select>
                                            @error('kemampuan_penglihatan_mata')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="kemampuan_penglihatan_mata_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ old('kemampuan_penglihatan_mata_lainnya') }}">

                                            <select name="sudah_vaksin_berapa_kali"
                                                class="form-control mt-2 @error('sudah_vaksin_berapa_kali') is-invalid @enderror"
                                                required>
                                                <option value="">-- Sudah Vaksin Berapa Kali --</option>
                                                <option value="1x Vaksin"
                                                    {{ old('sudah_vaksin_berapa_kali') == '1x Vaksin' ? 'selected' : '' }}>
                                                    1x Vaksin</option>
                                                <option value="2x Vaksin"
                                                    {{ old('sudah_vaksin_berapa_kali') == '2x Vaksin' ? 'selected' : '' }}>
                                                    2x Vaksin</option>
                                                <option value="3x Vaksin"
                                                    {{ old('sudah_vaksin_berapa_kali') == '3x Vaksin' ? 'selected' : '' }}>
                                                    3x Vaksin</option>
                                            </select>
                                            @error('sudah_vaksin_berapa_kali')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="sudah_vaksin_berapa_kali_lainnya"
                                                class="form-control mt-2" placeholder="Lainnya"
                                                value="{{ old('sudah_vaksin_berapa_kali_lainnya') }}">

                                            <textarea name="kesehatan_badan" class="form-control mt-2" placeholder="Kesehatan Badan">{{ old('kesehatan_badan') }}</textarea>

                                            <textarea name="penyakit_cedera_masa_lalu" class="form-control mt-2" placeholder="Riwayat Penyakit/Cedera">{{ old('penyakit_cedera_masa_lalu') }}</textarea>

                                            <textarea name="hobi" class="form-control mt-2" placeholder="Hobi">{{ old('hobi') }}</textarea>

                                            <select name="rencana_sumber_biaya_keberangkatan"
                                                class="form-control mt-2 @error('rencana_sumber_biaya_keberangkatan') is-invalid @enderror"
                                                required>
                                                <option value="">-- Sumber Biaya Keberangkatan --</option>
                                                @foreach (['Dana talang LPK', 'Dana Pribadi', 'Dana Ortu', 'Dana pinjaman pihak lain'] as $sumber)
                                                    <option value="{{ $sumber }}"
                                                        {{ old('rencana_sumber_biaya_keberangkatan') == $sumber ? 'selected' : '' }}>
                                                        {{ $sumber }}</option>
                                                @endforeach
                                            </select>
                                            @error('rencana_sumber_biaya_keberangkatan')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            <select name="perkiraan_biaya"
                                                class="form-control mt-2 @error('perkiraan_biaya') is-invalid @enderror"
                                                required>
                                                <option value="">-- Perkiraan Biaya --</option>
                                                <option value="10.000.000 - 20.000.000"
                                                    {{ old('perkiraan_biaya') == '10.000.000 - 20.000.000' ? 'selected' : '' }}>
                                                    10.000.000 - 20.000.000</option>
                                                <option value="20.000.000 - 30.000.000"
                                                    {{ old('perkiraan_biaya') == '20.000.000 - 30.000.000' ? 'selected' : '' }}>
                                                    20.000.000 - 30.000.000</option>
                                                <option value="30.000.000 - 40.000.000"
                                                    {{ old('perkiraan_biaya') == '30.000.000 - 40.000.000' ? 'selected' : '' }}>
                                                    30.000.000 - 40.000.000</option>
                                            </select>
                                            @error('perkiraan_biaya')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- HALAMAN 3: KEMAMPUAN & KEBUGARAN --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Kemampuan & Kebugaran</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Lama Belajar di Mendunia</label>
                                            <input type="text" name="lama_belajar_di_mendunia"
                                                class="form-control @error('lama_belajar_di_mendunia') is-invalid @enderror"
                                                placeholder="Contoh: 6 bulan"
                                                value="{{ old('lama_belajar_di_mendunia') }}" required>
                                            @error('lama_belajar_di_mendunia')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <label class="form-label mt-2">Kemampuan Bahasa Jepang</label>
                                            <textarea name="kemampuan_bahasa_jepang" class="form-control @error('kemampuan_bahasa_jepang') is-invalid @enderror"
                                                placeholder="Jelaskan kemampuan bahasa Jepang Anda" required>{{ old('kemampuan_bahasa_jepang') }}</textarea>
                                            @error('kemampuan_bahasa_jepang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <label class="form-label mt-2">Kemampuan Pemahaman SSW</label>
                                            <textarea name="kemampuan_pemahaman_ssw" class="form-control @error('kemampuan_pemahaman_ssw') is-invalid @enderror"
                                                placeholder="Jelaskan pemahaman Anda tentang SSW" required>{{ old('kemampuan_pemahaman_ssw') }}</textarea>
                                            @error('kemampuan_pemahaman_ssw')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <label class="form-label mt-2">Kelincahan dalam Bekerja</label>
                                            <textarea name="kelincahan_dalam_bekerja"
                                                class="form-control @error('kelincahan_dalam_bekerja') is-invalid @enderror"
                                                placeholder="Jelaskan kelincahan Anda" required>{{ old('kelincahan_dalam_bekerja') }}</textarea>
                                            @error('kelincahan_dalam_bekerja')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Kekuatan Tindakan</label>
                                            <textarea name="kekuatan_tindakan" class="form-control @error('kekuatan_tindakan') is-invalid @enderror"
                                                placeholder="Jelaskan kekuatan tindakan Anda" required>{{ old('kekuatan_tindakan') }}</textarea>
                                            @error('kekuatan_tindakan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <label class="form-label mt-2">Kemampuan Berbahasa Inggris</label>
                                            <textarea name="kemampuan_berbahasa_inggris"
                                                class="form-control @error('kemampuan_berbahasa_inggris') is-invalid @enderror"
                                                placeholder="Jelaskan kemampuan bahasa Inggris Anda" required>{{ old('kemampuan_berbahasa_inggris') }}</textarea>
                                            @error('kemampuan_berbahasa_inggris')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="kemampuan_berbahasa_inggris_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ old('kemampuan_berbahasa_inggris_lainnya') }}">

                                            <label class="form-label mt-2">Kebugaran Jasmani (aktivitas per minggu)</label>
                                            <select name="kebugaran_jasmani_seminggu"
                                                class="form-select @error('kebugaran_jasmani_seminggu') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Frekuensi Olahraga --</option>
                                                <option value="3 kali/1 minggu"
                                                    {{ old('kebugaran_jasmani_seminggu') == '3 kali/1 minggu' ? 'selected' : '' }}>
                                                    3 kali / 1 minggu
                                                </option>
                                                <option value="4 Kali/1 minggu"
                                                    {{ old('kebugaran_jasmani_seminggu') == '4 Kali/1 minggu' ? 'selected' : '' }}>
                                                    4 kali / 1 minggu
                                                </option>
                                                <option value="5 Kali/1 minggu"
                                                    {{ old('kebugaran_jasmani_seminggu') == '5 Kali/1 minggu' ? 'selected' : '' }}>
                                                    5 kali / 1 minggu
                                                </option>
                                                <option value="10 Kali/1 minggu"
                                                    {{ old('kebugaran_jasmani_seminggu') == '10 Kali/1 minggu' ? 'selected' : '' }}>
                                                    10 kali / 1 minggu
                                                </option>
                                            </select>

                                            @error('kebugaran_jasmani_seminggu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="kebugaran_jasmani_seminggu_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ old('kebugaran_jasmani_seminggu_lainnya') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- HALAMAN 4: PENDIDIKAN --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Riwayat Pendidikan</div>
                                <div class="card-body">
                                    <div id="pendidikanContainer">
                                        <div class="row g-3 mb-2 pendidikan-item">
                                            <div class="col-md-4">
                                                <input type="text" name="pendidikan_nama[]" class="form-control"
                                                    placeholder="Nama Sekolah/Universitas">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="pendidikan_jurusan[]" class="form-control"
                                                    placeholder="Jurusan">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="pendidikan_tahun[]" class="form-control"
                                                    placeholder="Tahun (2015-2018)">
                                            </div>
                                            <div class="col-md-1 d-flex">
                                                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" id="addPendidikan">+ Tambah
                                        Pendidikan</button>
                                </div>
                            </div>

                            {{-- HALAMAN 4: PENGALAMAN KERJA --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Pengalaman Kerja</div>
                                <div class="card-body">
                                    <div id="pengalamanContainer">
                                        <div class="row g-3 mb-3 pengalaman-item">
                                            <div class="col-md-4">
                                                <label class="form-label">Nama Perusahaan</label>
                                                <input type="text" name="pengalaman_perusahaan[]" class="form-control"
                                                    placeholder="Nama Perusahaan">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Jabatan</label>
                                                <input type="text" name="pengalaman_jabatan[]" class="form-control"
                                                    placeholder="Jabatan">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Periode/Lama Bekerja</label>
                                                <input type="text" name="pengalaman_periode[]" class="form-control"
                                                    placeholder="2019-2021 (2 tahun)">
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" id="addPengalaman">+ Tambah
                                        Pengalaman</button>
                                </div>
                            </div>
                            {{-- HALAMAN 5: INFORMASI TAMBAHAN --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Informasi Tambahan</div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        {{-- KOLOM KIRI --}}
                                        <div class="col-md-6">

                                            {{-- Ada keluarga di Jepang --}}
                                            <label class="form-label">Ada Keluarga di Jepang?</label>
                                            <select name="ada_keluarga_di_jepang"
                                                class="form-control @error('ada_keluarga_di_jepang') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Ya"
                                                    {{ old('ada_keluarga_di_jepang') == 'Ya' ? 'selected' : '' }}>Ya
                                                </option>
                                                <option value="Tidak"
                                                    {{ old('ada_keluarga_di_jepang') == 'Tidak' ? 'selected' : '' }}>Tidak
                                                </option>
                                            </select>
                                            @error('ada_keluarga_di_jepang')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            {{-- Hubungan keluarga di Jepang --}}
                                            <label class="form-label mt-2">Hubungan Keluarga di Jepang</label>
                                            <select name="hubungan_keluarga_di_jepang" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                @foreach (['Ayah', 'Ibu', 'Paman', 'Kakak', 'Adik', 'Bibi', 'Kakek', 'Nenek', 'Tidak ada'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('hubungan_keluarga_di_jepang') == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Status Kerabat di Jepang --}}
                                            <label class="form-label mt-2">Status Kerabat di Jepang</label>
                                            <select name="status_kerabat_di_jepang" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                @foreach (['TG 1', 'Jishusei 1', 'Jishusei 2', 'Jishusei 3', 'EIJU', 'Tokutei katsudou', 'Tidak ada'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('status_kerabat_di_jepang') == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Tambahan status kerabat --}}
                                            <input type="text" name="status_kerabat_di_jepang_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ old('status_kerabat_di_jepang_lainnya') }}">

                                            {{-- Ingin bekerja berapa tahun --}}
                                            <label class="form-label mt-2">Ingin Bekerja Berapa Tahun?</label>
                                            <select name="ingin_bekerja_berapa_tahun"
                                                class="form-control @error('ingin_bekerja_berapa_tahun') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['2 Tahun', '3 Tahun', '4 Tahun', '5 Tahun'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('ingin_bekerja_berapa_tahun') == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ingin_bekerja_berapa_tahun')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="ingin_bekerja_berapa_tahun_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ old('ingin_bekerja_berapa_tahun_lainnya') }}">

                                            {{-- Ingin pulang berapa kali --}}
                                            <label class="form-label mt-2">Ingin Pulang Berapa Kali?</label>
                                            <select name="ingin_pulang_berapa_kali"
                                                class="form-control @error('ingin_pulang_berapa_kali') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['1-2 Kali', '2 - 3 Kali', '4-5 Kali'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('ingin_pulang_berapa_kali') == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ingin_pulang_berapa_kali')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- KOLOM KANAN --}}
                                        <div class="col-md-6">

                                            <label class="form-label">Kelebihan Diri</label>
                                            <textarea name="kelebihan_diri" class="form-control">{{ old('kelebihan_diri') }}</textarea>

                                            <label class="form-label mt-2">Komentar Guru tentang Kelebihan Diri</label>
                                            <textarea name="komentar_guru_kelebihan_diri" class="form-control">{{ old('komentar_guru_kelebihan_diri') }}</textarea>

                                            <label class="form-label mt-2">Kekurangan Diri</label>
                                            <textarea name="kekurangan_diri" class="form-control">{{ old('kekurangan_diri') }}</textarea>

                                            <label class="form-label mt-2">Komentar Guru tentang Kekurangan Diri</label>
                                            <textarea name="komentar_guru_kekurangan_diri" class="form-control">{{ old('komentar_guru_kekurangan_diri') }}</textarea>

                                            <label class="form-label mt-2">Ketertarikan terhadap Jepang</label>
                                            <textarea name="ketertarikan_terhadap_jepang" class="form-control">{{ old('ketertarikan_terhadap_jepang') }}</textarea>

                                            <label class="form-label mt-2">Orang yang Dihormati</label>
                                            <textarea name="orang_yang_dihormati" class="form-control">{{ old('orang_yang_dihormati') }}</textarea>

                                            <label class="form-label mt-2">Point Plus Diri</label>
                                            <textarea name="point_plus_diri" class="form-control">{{ old('point_plus_diri') }}</textarea>

                                            <label class="form-label mt-2">Keahlian Khusus</label>
                                            <textarea name="keahlian_khusus" class="form-control">{{ old('keahlian_khusus') }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            {{-- HALAMAN 6: DATA KELUARGA --}}
                            <div class="card mb-4">
                                <div class="card-header fw-bold">Data Keluarga</div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Ayah (Nama, Usia, Pekerjaan)</label>
                                            <input type="text" name="anggota_keluarga_ayah"
                                                class="form-control @error('anggota_keluarga_ayah') is-invalid @enderror"
                                                placeholder="Contoh: Ahmad, 50 tahun, Petani"
                                                value="{{ old('anggota_keluarga_ayah') }}" required>
                                            @error('anggota_keluarga_ayah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <label class="form-label mt-2">Ibu (Nama, Usia, Pekerjaan)</label>
                                            <input type="text" name="anggota_keluarga_ibu"
                                                class="form-control @error('anggota_keluarga_ibu') is-invalid @enderror"
                                                placeholder="Contoh: Siti, 48 tahun, Ibu Rumah Tangga"
                                                value="{{ old('anggota_keluarga_ibu') }}" required>
                                            @error('anggota_keluarga_ibu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <label class="form-label mt-2">Istri (Opsional)</label>
                                            <input type="text" name="anggota_keluarga_istri" class="form-control"
                                                placeholder="Nama, Usia, Pekerjaan"
                                                value="{{ old('anggota_keluarga_istri') }}">

                                            <label class="form-label mt-2">Suami (Opsional)</label>
                                            <input type="text" name="anggota_keluarga_suami" class="form-control"
                                                placeholder="Nama, Usia, Pekerjaan"
                                                value="{{ old('anggota_keluarga_suami') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Anak (Opsional)</label>
                                            <input type="text" name="anggota_keluarga_anak" class="form-control"
                                                placeholder="Nama, Usia (jika ada)"
                                                value="{{ old('anggota_keluarga_anak') }}">

                                            <label class="form-label mt-2">Kakak (Opsional)</label>
                                            <input type="text" name="anggota_keluarga_kakak" class="form-control"
                                                placeholder="Nama, Usia, Pekerjaan (pisahkan dengan koma)"
                                                value="{{ old('anggota_keluarga_kakak') }}">

                                            <label class="form-label mt-2">Adik (Opsional)</label>
                                            <input type="text" name="anggota_keluarga_adik" class="form-control"
                                                placeholder="Nama, Usia, Pekerjaan (pisahkan dengan koma)"
                                                value="{{ old('anggota_keluarga_adik') }}">

                                            <label class="form-label mt-2">Rata-rata Penghasilan Keluarga</label>
                                            <input type="text" name="rata_rata_penghasilan_keluarga"
                                                class="form-control @error('rata_rata_penghasilan_keluarga') is-invalid @enderror"
                                                placeholder="Contoh: Rp 5.000.000/bulan"
                                                value="{{ old('rata_rata_penghasilan_keluarga') }}" required>
                                            @error('rata_rata_penghasilan_keluarga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg mb-5" id="btnSubmit">
                                <i class="fas fa-save me-2"></i>Simpan CV
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // =============== ADD ROW PENDIDIKAN ===============
            $('#addPendidikan').click(function() {
                let row = `
                <div class="row g-3 mb-2 pendidikan-item">
                    <div class="col-md-4">
                        <input type="text" name="pendidikan_nama[]" class="form-control" placeholder="Nama Sekolah/Universitas">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="pendidikan_jurusan[]" class="form-control" placeholder="Jurusan">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="pendidikan_tahun[]" class="form-control" placeholder="Tahun (2015-2018)">
                    </div>
                    <div class="col-md-1 d-flex">
                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                    </div>
                </div>
            `;
                $('#pendidikanContainer').append(row);
            });

            // =============== ADD ROW PENGALAMAN KERJA ===============
            $('#addPengalaman').click(function() {
                let row = `
                <div class="row g-3 mb-3 pengalaman-item">
                    <div class="col-md-4">
                        <label class="form-label">Nama Perusahaan</label>
                        <input type="text" name="pengalaman_perusahaan[]" class="form-control" placeholder="Nama Perusahaan">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="pengalaman_jabatan[]" class="form-control" placeholder="Jabatan">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Periode/Lama Bekerja</label>
                        <input type="text" name="pengalaman_periode[]" class="form-control" placeholder="2019-2021 (2 tahun)">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                    </div>
                </div>
            `;
                $('#pengalamanContainer').append(row);
            });

            // =============== REMOVE ROW ===============
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.row').remove();
            });

            // =============== CLIENT-SIDE VALIDATION ===============
            // SUBMIT FORM
            $('#cvForm').on('submit', function(e) {
                e.preventDefault(); // Stop reload

                let form = $('#cvForm')[0];
                let formData = new FormData(form); // support file upload

                $.ajax({
                    url: $('#cvForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function() {
                        $('#btnSubmit')
                            .prop('disabled', true)
                            .text('Mengirim...');
                        $('.invalid-feedback').remove();
                        $('.is-invalid').removeClass('is-invalid');
                    },

                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 1800,
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                window.location.href = response.redirect ?? window
                                    .location.href;
                            }, 1500);
                        }
                    },

                    error: function(xhr) {
                        $('#btnSubmit')
                            .prop('disabled', false)
                            .text('Simpan');

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(field, messages) {
                                let input = $('[name="' + field + '"]');

                                input.addClass('is-invalid');

                                input.after(
                                    '<div class="invalid-feedback d-block">' +
                                    messages[0] + '</div>'
                                );
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: 'Silakan periksa kembali isian Anda.',
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal mengirim data ke server.',
                            });
                        }
                    }
                });

            });

            // =============== HELPER FUNCTION ===============
            function validateEmail(email) {
                let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // =============== AUTO DISMISS ALERT ===============
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // =============== KONFIRMASI SEBELUM MENINGGALKAN HALAMAN ===============
            let formChanged = false;

            $('#cvForm input, #cvForm select, #cvForm textarea').on('change input', function() {
                formChanged = true;
            });

            $(window).on('beforeunload', function() {
                if (formChanged) {
                    return 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
                }
            });

            $('#cvForm').on('submit', function() {
                formChanged = false;
            });

        });
    </script>

    <style>
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .alert {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>

@endsection
