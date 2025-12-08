@extends('layouts.app')

@section('title', 'Tambah CV')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-u3eJv6TsgUsP62eFZlyDdc0AGJi/7luWGINuD/7++UZ5EONosFVJeFt3PcTJS3BM4tiTqcKoy0ucZZ+jJ7G8Aw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <style>
        /* Multi-Step Progress Bar */
        .progress-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .progress-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background: #e0e0e0;
            z-index: -1;
            transform: translateY(-50%);
        }

        .progress-line {
            position: absolute;
            top: 50%;
            left: 0;
            height: 3px;
            background: linear-gradient(to right, #4CAF50, #45a049);
            z-index: -1;
            transform: translateY(-50%);
            transition: width 0.3s ease;
        }

        .step {
            background: white;
            border: 3px solid #e0e0e0;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #999;
            transition: all 0.3s ease;
            position: relative;
        }

        .step.active {
            border-color: #4CAF50;
            color: #4CAF50;
            background: #e8f5e9;
        }

        .step.completed {
            border-color: #4CAF50;
            background: #4CAF50;
            color: white;
        }

        .step-label {
            position: absolute;
            top: 60px;
            white-space: nowrap;
            font-size: 12px;
            font-weight: 600;
            color: #666;
        }

        .step.active .step-label {
            color: #4CAF50;
        }

        /* Form Step Container */
        .form-step {
            display: none;
            animation: fadeIn 0.5s;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Navigation Buttons */
        .step-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .btn-step {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-prev {
            background: #6c757d;
            color: white;
        }

        .btn-prev:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-next {
            background: #4CAF50;
            color: white;
        }

        .btn-next:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }

        .btn-submit {
            background: #2196F3;
            color: white;
        }

        .btn-submit:hover {
            background: #0b7dda;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
        }

        /* Card Styling */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        /* Form Styling */
        .form-control:focus,
        .form-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .step {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }

            .step-label {
                font-size: 10px;
                top: 50px;
            }

            .step-buttons {
                flex-direction: column;
            }

            .btn-step {
                width: 100%;
            }
        }

        /* Section Title */
        .section-title {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #667eea;
        }
    </style>

    <div class="mt-5">
        {{-- @if ($alreadyRegistered)
            <script>
                document.addEventListener("DOMContentLoaded", function() {
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
                            window.location = '/';
                        }
                    });

                    const form = document.getElementById("cvForm");
                    if (form) {
                        [...form.elements].forEach(input => input.disabled = true);
                    }
                });
            </script>
        @endif --}}

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Form Edit CV
                </li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>Form Curriculum Vitae (CV)</h4>
                        <p class="mb-0 mt-2 opacity-75">Silakan lengkapi semua informasi dengan benar</p>
                    </div>
                    <div class="card-body p-4">

                        <!-- Progress Steps -->
                        <div class="progress-container mb-5" style="padding: 0 30px;">
                            <div class="progress-line" id="progressLine"></div>
                            <div class="step active" data-step="1">
                                <span>1</span>
                                <span class="step-label">Data Awal</span>
                            </div>
                            <div class="step" data-step="2">
                                <span>2</span>
                                <span class="step-label">Data Diri</span>
                            </div>
                            <div class="step" data-step="3">
                                <span>3</span>
                                <span class="step-label">Kemampuan</span>
                            </div>
                            <div class="step" data-step="4">
                                <span>4</span>
                                <span class="step-label">Pendidikan</span>
                            </div>
                            <div class="step" data-step="5">
                                <span>5</span>
                                <span class="step-label">Pengalaman</span>
                            </div>
                            <div class="step" data-step="6">
                                <span>6</span>
                                <span class="step-label">Info Tambahan</span>
                            </div>
                            <div class="step" data-step="7">
                                <span>7</span>
                                <span class="step-label">Keluarga</span>
                            </div>
                        </div>

                        <form id="" action="{{ route('cv.updatekandidat', $cv->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf


                            <div class="form-step active" data-step="1">
                                <h4 class="section-title"><i class="fas fa-info-circle me-2"></i>Data Awal</h4>
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            {{-- Email --}}
                                            <label class="form-label fw-semibold">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukkan Email" value="{{ old('email', $cv->email) }}"
                                                {{-- Menampilkan data $cv->email --}} required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- Cabang --}}
                                            <label class="form-label fw-semibold mt-3">Cabang</label>
                                            <select name="cabang_id"
                                                class="form-control @error('cabang_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Cabang --</option>
                                                @foreach ($cabangs as $cabang)
                                                    <option value="{{ $cabang->id }}" {{-- Memeriksa jika $cv->cabang_id sama dengan $cabang->id --}}
                                                        {{ old('cabang_id', $cv->cabang_id) == $cabang->id ? 'selected' : '' }}>
                                                        {{ $cabang->nama_cabang }} - {{ $cabang->alamat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cabang_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            {{-- Batch --}}
                                            <label class="form-label fw-semibold mt-3">Batch</label>
                                            <input type="text" name="batch"
                                                class="form-control @error('batch') is-invalid @enderror"
                                                placeholder="Masukkan Batch" value="{{ old('batch', $cv->batch) }}"
                                                {{-- Menampilkan data $cv->batch --}} required>
                                            @error('batch')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- No Telepon --}}
                                            <label class="form-label fw-semibold mt-3">No Telepon</label>
                                            <input type="text" name="no_telepon"
                                                class="form-control @error('no_telepon') is-invalid @enderror"
                                                placeholder="Masukkan No Telepon"
                                                value="{{ old('no_telepon', $cv->no_telepon) }}" {{-- Menampilkan data $cv->no_telepon --}}
                                                required>
                                            @error('no_telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- No Orang Tua --}}
                                            <label class="form-label fw-semibold mt-3">No Orang Tua (Opsional)</label>
                                            <input type="text" name="no_orang_tua" class="form-control"
                                                placeholder="Masukkan No Orang Tua"
                                                value="{{ old('no_orang_tua', $cv->no_orang_tua) }}">
                                            {{-- Menampilkan data $cv->no_orang_tua --}}
                                        </div>

                                        <div class="col-md-6">

                                            {{-- Bidang Sertifikasi --}}
                                            <label class="form-label fw-semibold">Bidang Sertifikasi</label>
                                            <select name="bidang_sertifikasi"
                                                class="form-control @error('bidang_sertifikasi') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Bidang Sertifikasi --</option>
                                                <option value="Pengolahan Makanan"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Pengolahan Makanan' ? 'selected' : '' }}>
                                                    {{-- Menampilkan data $cv->bidang_sertifikasi --}}
                                                    Pengolahan Makanan</option>
                                                <option value="Pertanian"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Pertanian' ? 'selected' : '' }}>
                                                    Pertanian</option>
                                                <option value="Kaigo (perawat)"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Kaigo (perawat)' ? 'selected' : '' }}>
                                                    Kaigo (perawat)</option>
                                                <option value="Building Cleaning"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Building Cleaning' ? 'selected' : '' }}>
                                                    Building Cleaning</option>
                                                <option value="Restoran"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Restoran' ? 'selected' : '' }}>
                                                    Restoran</option>
                                                <option value="Driver"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Driver' ? 'selected' : '' }}>
                                                    Driver
                                                </option>
                                                <option value="Hanya JFT"
                                                    {{ old('bidang_sertifikasi', $cv->bidang_sertifikasi) == 'Hanya JFT' ? 'selected' : '' }}>
                                                    Hanya
                                                    JFT</option>
                                            </select>
                                            @error('bidang_sertifikasi')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            {{-- Bidang Sertifikasi Lainnya --}}
                                            <label class="form-label fw-semibold mt-3">Bidang Sertifikasi Lainnya
                                                (Opsional)</label>
                                            <input type="text" name="bidang_sertifikasi_lainnya" class="form-control"
                                                placeholder="Isi jika ada bidang sertifikasi lain"
                                                value="{{ old('bidang_sertifikasi_lainnya', $cv->bidang_sertifikasi_lainnya) }}">
                                            {{-- Menampilkan data $cv->bidang_sertifikasi_lainnya --}}

                                            {{-- Program Kawakami --}}
                                            <label class="form-label fw-semibold mt-3">Apakah mengikuti program pertanian
                                                kawakami synshu cyle 2026</label>
                                            <select name="program_pertanian_kawakami"
                                                class="form-control @error('program_pertanian_kawakami') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih --</option>
                                                <option value="Ya"
                                                    {{ old('program_pertanian_kawakami', $cv->program_pertanian_kawakami) == 'Ya' ? 'selected' : '' }}>
                                                    {{-- Menampilkan data $cv->program_pertanian_kawakami --}}
                                                    Ya
                                                </option>
                                                <option value="Tidak"
                                                    {{ old('program_pertanian_kawakami', $cv->program_pertanian_kawakami) == 'Tidak' ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                            @error('program_pertanian_kawakami')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                            {{-- Upload Sertifikat --}}
                                            <label class="form-label fw-semibold mt-3">
                                                Silahkan upload sertifikat yang dimiliki JFT dan SSW (PDF/JPG/PNG, Max 10MB)
                                                <br>
                                                <small class="text-muted">Kosongkan jika tidak ingin mengubah file.</small>
                                            </label>

                                            <input type="file" name="sertifikat_files[]" id="sertifikatInput"
                                                class="form-control" multiple accept=".pdf,.jpg,.jpeg,.png">

                                            <div class="mt-2">
                                                <p class="mb-1 fw-bold">File Saat Ini:</p>

                                                <a href="{{ asset($cv->sertifikat_files) }}" target="_blank"
                                                    class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                </a>

                                            </div>

                                            <div id="previewSertifikat" class="mt-3 d-flex flex-wrap gap-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- STEP 2: DATA DIRI -->
                            <div class="form-step" data-step="2">
                                <h4 class="section-title"><i class="fas fa-user me-2"></i>Data Diri</h4>
                                <div class="row g-3">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">

                                                <label class="form-label fw-semibold mb-1">
                                                    Silahkan upload dokumen / foto tambahan 👇
                                                </label>
                                                <div class="small" style="line-height: 1.5;">
                                                    Berikut ketentuan upload dokumen/foto tambahan:
                                                    <ul class="mt-1 mb-1">
                                                        <li>Bisa berupa PDF, DOC, DOCX, atau gambar (.jpg/.jpeg/.png)</li>
                                                        <li>Maksimal upload 5 file</li>
                                                        <li>Bukan hasil editan</li>
                                                        <li>SSW Pertanian: Tambahkan foto full body</li>
                                                    </ul>
                                                </div>
                                                <input type="file" id="pasFotoInput" name="pas_foto[]"
                                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="form-control"
                                                    multiple>

                                                <div class="mt-2">
                                                    <p class="mb-1 fw-bold">File Tambahan Saat Ini:</p>
                                                    <img src="{{ asset($cv->pas_foto) }}" alt="Pas Foto"
                                                        class="rounded-circle border border-5 border-white shadow-sm"
                                                        width="150" height="150" style="object-fit: cover">
                                                </div>

                                                <div id="previewPasFoto" class="mt-3 d-flex flex-wrap gap-3"></div>


                                                <label class="form-label fw-semibold mb-1 mt-4">
                                                    Silahkan upload pas foto untuk CV Anda 👇
                                                </label>
                                                <div class="small" style="line-height: 1.5;">
                                                    Ketentuan pas foto CV:
                                                    <ul class="mt-1 mb-1">
                                                        <li>Ukuran: 4x3 cm (Tinggi x Lebar)</li>
                                                        <li>Background: 1 biru & 1 putih</li>
                                                        <li>Pakaian: Jas & dasi (formal)</li>
                                                        <li>Penampilan: Rambut rapi, tanpa kumis/janggut (laki-laki), tidak
                                                            memakai makeup berlebihan (perempuan)</li>
                                                    </ul>
                                                    <strong>Hanya 1 file, format gambar (.jpg/.jpeg/.png)</strong>
                                                </div>
                                                <input type="file" id="pasFotoInputCv" name="pas_foto_cv"
                                                    accept=".jpg,.jpeg,.png" class="form-control">

                                                <div class="mt-2">
                                                    @if ($cv->pas_foto_cv)
                                                        <p class="mb-1 fw-bold">Pas Foto CV Saat Ini:</p>
                                                        {{-- Ubah 'pas_foto_cv' sesuai dengan folder penyimpanan Anda --}}
                                                        <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto CV"
                                                            style="max-width: 150px; height: auto; border: 1px solid #ddd;">
                                                        <p class="text-muted small mt-1">{{ $cv->pas_foto_cv }}</p>
                                                    @else
                                                        <p class="text-muted">Belum ada pas foto CV yang tersimpan.</p>
                                                    @endif
                                                </div>

                                                <div id="previewPasFotoCv" class="mt-3 d-flex flex-wrap gap-3"></div>



                                                <label class="form-label fw-semibold mt-3">
                                                    Nama Lengkap <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Gunakan huruf Romaji<br>Contoh: Gita</small>
                                                </label>
                                                <input type="text" name="nama_lengkap_romaji"
                                                    class="form-control @error('nama_lengkap_romaji') is-invalid @enderror"
                                                    placeholder="Masukkan nama lengkap (Romaji)"
                                                    value="{{ old('nama_lengkap_romaji', $cv->nama_lengkap_romaji ?? '') }}"
                                                    required>
                                                @error('nama_lengkap_romaji')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Nama Lengkap <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Gunakan huruf Katakana<br>Contoh: ギタ</small>
                                                </label>
                                                <input type="text" name="nama_lengkap_katakana"
                                                    class="form-control @error('nama_lengkap_katakana') is-invalid @enderror"
                                                    placeholder="Masukkan nama lengkap (Katakana)"
                                                    value="{{ old('nama_lengkap_katakana', $cv->nama_lengkap_katakana ?? '') }}"
                                                    required>
                                                @error('nama_lengkap_katakana')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Nama Panggilan <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Gunakan huruf Romaji<br>Contoh: Gita</small>
                                                </label>
                                                <input type="text" name="nama_panggilan_romaji"
                                                    class="form-control @error('nama_panggilan_romaji') is-invalid @enderror"
                                                    placeholder="Masukkan nama panggilan (Romaji)"
                                                    value="{{ old('nama_panggilan_romaji', $cv->nama_panggilan_romaji ?? '') }}"
                                                    required>
                                                @error('nama_panggilan_romaji')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Nama Panggilan <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Gunakan huruf Katakana<br>Contoh: ギタ</small>
                                                </label>
                                                <input type="text" name="nama_panggilan_katakana"
                                                    class="form-control @error('nama_panggilan_katakana') is-invalid @enderror"
                                                    placeholder="Masukkan nama panggilan (Katakana)"
                                                    value="{{ old('nama_panggilan_katakana', $cv->nama_panggilan_katakana ?? '') }}"
                                                    required>
                                                @error('nama_panggilan_katakana')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-2">
                                                    Jenis Kelamin <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Pilih sesuai identitas resmi</small>
                                                </label>
                                                <select name="jenis_kelamin"
                                                    class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    @php
                                                        $jenisKelamin = $cv->jenis_kelamin ?? old('jenis_kelamin');
                                                    @endphp
                                                    <option value="男 (Laki-laki)"
                                                        {{ $jenisKelamin == '男 (Laki-laki)' ? 'selected' : '' }}>
                                                        男 (Laki-laki)
                                                    </option>
                                                    <option value="女 (Perempuan)"
                                                        {{ $jenisKelamin == '女 (Perempuan)' ? 'selected' : '' }}>
                                                        女 (Perempuan)
                                                    </option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Agama <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Isi sesuai KTP/KK</small>
                                                </label>
                                                <select name="agama"
                                                    class="form-select @error('agama') is-invalid @enderror" required>
                                                    <option value="">-- Pilih Agama --</option>
                                                    @php
                                                        $agama = $cv->agama ?? old('agama');
                                                    @endphp
                                                    <option value="Islam" {{ $agama == 'Islam' ? 'selected' : '' }}>Islam
                                                    </option>
                                                    <option value="Kristen" {{ $agama == 'Kristen' ? 'selected' : '' }}>
                                                        Kristen</option>
                                                    <option value="Katolik" {{ $agama == 'Katolik' ? 'selected' : '' }}>
                                                        Katolik</option>
                                                    <option value="Hindu" {{ $agama == 'Hindu' ? 'selected' : '' }}>Hindu
                                                    </option>
                                                    <option value="Buddha" {{ $agama == 'Buddha' ? 'selected' : '' }}>
                                                        Buddha</option>
                                                    <option value="Konghucu" {{ $agama == 'Konghucu' ? 'selected' : '' }}>
                                                        Konghucu</option>
                                                </select>
                                                @error('agama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-2">
                                                    Agama Lainnya (Opsional)
                                                </label>
                                                <input type="text" name="agama_lainnya" class="form-control"
                                                    placeholder="Agama Lainnya (Opsional)"
                                                    value="{{ old('agama_lainnya', $cv->agama_lainnya ?? '') }}">


                                                <label class="form-label fw-semibold mt-3">
                                                    Tanggal Lahir <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Contoh: 12-10-2004</small>
                                                </label>
                                                <input type="date" name="tanggal_lahir"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    placeholder="Tanggal Lahir"
                                                    value="{{ old('tanggal_lahir', $cv->tanggal_lahir ?? '') }}" required>
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Tempat Lahir <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Contoh: cianjur</small>
                                                </label>
                                                <input type="text" name="tempat_lahir"
                                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                    placeholder="Tempat Lahir"
                                                    value="{{ old('tempat_lahir', $cv->tempat_lahir ?? '') }}" required>
                                                @error('tempat_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Usia <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Isi dalam angka, contoh: 23</small>
                                                </label>
                                                <input type="text" name="usia"
                                                    class="form-control @error('usia') is-invalid @enderror"
                                                    placeholder="Usia" value="{{ old('usia', $cv->usia ?? '') }}"
                                                    required>
                                                @error('usia')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Alamat Lengkap <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Isi sesuai domisili saat ini</small>
                                                </label>
                                                <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                                    placeholder="Alamat Lengkap" required>{{ old('alamat_lengkap', $cv->alamat_lengkap ?? '') }}</textarea>
                                                @error('alamat_lengkap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <div class="mb-3">
                                                    <label class="form-label">Provinsi</label>
                                                    <select name="provinsi" id="provinsi"
                                                        class="form-control @error('provinsi') is-invalid @enderror">
                                                        <option value="{{ $cv->provinsi ?? old('provinsi') }}" selected>
                                                            {{ $cv->provinsi ?? old('provinsi', '-- Pilih Provinsi --') }}
                                                        </option>
                                                        {{-- Opsi lain akan diisi oleh JavaScript --}}
                                                    </select>
                                                    @error('provinsi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label">Kabupaten / Kota</label>
                                                    <select name="kabupaten" id="kabupaten"
                                                        class="form-control @error('kabupaten') is-invalid @enderror">
                                                        <option value="{{ $cv->kabupaten ?? old('kabupaten') }}" selected>
                                                            {{ $cv->kabupaten ?? old('kabupaten', '-- Pilih Kabupaten / Kota --') }}
                                                        </option>
                                                        {{-- Opsi lain akan diisi oleh JavaScript setelah provinsi dipilih --}}
                                                    </select>
                                                    @error('kabupaten')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label">Kecamatan</label>
                                                    <select name="kecamatan" id="kecamatan"
                                                        class="form-control @error('kecamatan') is-invalid @enderror">
                                                        <option value="{{ $cv->kecamatan ?? old('kecamatan') }}" selected>
                                                            {{ $cv->kecamatan ?? old('kecamatan', '-- Pilih Kecamatan --') }}
                                                        </option>
                                                        {{-- Opsi lain akan diisi oleh JavaScript setelah kabupaten dipilih --}}
                                                    </select>
                                                    @error('kecamatan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="mb-3">
                                                    <label class="form-label">Kelurahan</label>
                                                    <select name="kelurahan" id="kelurahan"
                                                        class="form-control @error('kelurahan') is-invalid @enderror">
                                                        <option value="{{ $cv->kelurahan ?? old('kelurahan') }}" selected>
                                                            {{ $cv->kelurahan ?? old('kelurahan', '-- Pilih Kelurahan --') }}
                                                        </option>
                                                        {{-- Opsi lain akan diisi oleh JavaScript setelah kecamatan dipilih --}}
                                                    </select>
                                                    @error('kelurahan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <label class="form-label fw-semibold mt-3">
                                                    Email Aktif <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Gunakan email yang masih bisa
                                                        dihubungi</small>
                                                </label>
                                                <input type="email" name="email_aktif"
                                                    class="form-control @error('email_aktif') is-invalid @enderror"
                                                    placeholder="Email Aktif"
                                                    value="{{ old('email_aktif', $cv->email_aktif ?? '') }}" required>
                                                @error('email_aktif')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Status Perkawinan <span class="text-danger">*</span><br>
                                                    <small class="text-muted">Pilih status terbaru</small>
                                                </label>
                                                <select name="status_perkawinan"
                                                    class="form-control @error('status_perkawinan') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Status Perkawinan --</option>
                                                    @php
                                                        $statusPerkawinan =
                                                            $cv->status_perkawinan ?? old('status_perkawinan');
                                                    @endphp
                                                    <option value="Sudah Menikah"
                                                        {{ $statusPerkawinan == 'Sudah Menikah' ? 'selected' : '' }}>
                                                        Sudah Menikah
                                                    </option>
                                                    <option value="Belum Menikah"
                                                        {{ $statusPerkawinan == 'Belum Menikah' ? 'selected' : '' }}>
                                                        Belum Menikah
                                                    </option>
                                                </select>
                                                @error('status_perkawinan')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror


                                                <label class="form-label fw-semibold mt-3">
                                                    Golongan Darah <span class="text-danger">*</span>
                                                </label>
                                                <select name="golongan_darah"
                                                    class="form-control @error('golongan_darah') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Golongan Darah --</option>
                                                    @php
                                                        $golonganDarah = $cv->golongan_darah ?? old('golongan_darah');
                                                    @endphp
                                                    @foreach (['A', 'B', 'AB', 'O'] as $gol)
                                                        <option value="{{ $gol }}"
                                                            {{ $golonganDarah == $gol ? 'selected' : '' }}>
                                                            {{ $gol }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('golongan_darah')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror


                                                <select name="surat_izin_mengemudi"
                                                    class="form-control mt-2 @error('surat_izin_mengemudi') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Surat Izin Mengemudi --</option>
                                                    @php
                                                        $punyaSim =
                                                            $cv->surat_izin_mengemudi ?? old('surat_izin_mengemudi');
                                                    @endphp
                                                    <option value="Ada" {{ $punyaSim == 'Ada' ? 'selected' : '' }}>Ada
                                                    </option>
                                                    <option value="Tidak" {{ $punyaSim == 'Tidak' ? 'selected' : '' }}>
                                                        Tidak</option>
                                                </select>
                                                @error('surat_izin_mengemudi')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror


                                                <select name="jenis_sim" class="form-control mt-2">
                                                    <option value="">-- Jenis SIM (Opsional) --</option>
                                                    @php
                                                        $jenisSim = $cv->jenis_sim ?? old('jenis_sim');
                                                    @endphp
                                                    @foreach (['SIM A', 'SIM B', 'SIM C', 'SIM D'] as $sim)
                                                        <option value="{{ $sim }}"
                                                            {{ $jenisSim == $sim ? 'selected' : '' }}>
                                                            {{ $sim }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">

                                                <label class="mt-2 fw-bold">Apakah Anda Merokok?</label>
                                                <select name="merokok"
                                                    class="form-control @error('merokok') is-invalid @enderror" required>
                                                    <option value="">-- Merokok --</option>
                                                    @php
                                                        // Menggunakan data dari $cv->merokok jika ada, jika tidak, gunakan old('merokok')
                                                        $merokokValue = old('merokok', $cv->merokok ?? '');
                                                    @endphp
                                                    <option value="Ya" {{ $merokokValue == 'Ya' ? 'selected' : '' }}>
                                                        Ya
                                                    </option>
                                                    <option value="Tidak"
                                                        {{ $merokokValue == 'Tidak' ? 'selected' : '' }}>
                                                        Tidak
                                                    </option>
                                                </select>
                                                @error('merokok')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Apakah Anda Minum Alkohol?</label>
                                                <select name="minum_alkohol"
                                                    class="form-control @error('minum_alkohol') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Minum Alkohol --</option>
                                                    @php
                                                        $minumAlkoholValue = old(
                                                            'minum_alkohol',
                                                            $cv->minum_alkohol ?? '',
                                                        );
                                                    @endphp
                                                    <option value="Ya"
                                                        {{ $minumAlkoholValue == 'Ya' ? 'selected' : '' }}>Ya</option>
                                                    <option value="Tidak"
                                                        {{ $minumAlkoholValue == 'Tidak' ? 'selected' : '' }}>Tidak
                                                    </option>
                                                </select>
                                                @error('minum_alkohol')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Apakah Anda Bertato?</label>
                                                <select name="bertato"
                                                    class="form-control @error('bertato') is-invalid @enderror" required>
                                                    <option value="">-- Bertato --</option>
                                                    @php
                                                        $bertatoValue = old('bertato', $cv->bertato ?? '');
                                                    @endphp
                                                    <option value="Ya" {{ $bertatoValue == 'Ya' ? 'selected' : '' }}>
                                                        Ya
                                                    </option>
                                                    <option value="Tidak"
                                                        {{ $bertatoValue == 'Tidak' ? 'selected' : '' }}>
                                                        Tidak
                                                    </option>
                                                </select>
                                                @error('bertato')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Tinggi Badan (cm)</label>
                                                <input type="text" name="tinggi_badan"
                                                    class="form-control @error('tinggi_badan') is-invalid @enderror"
                                                    placeholder="Tinggi Badan (cm)"
                                                    value="{{ old('tinggi_badan', $cv->tinggi_badan ?? '') }}" required>
                                                @error('tinggi_badan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Berat Badan (kg)</label>
                                                <input type="text" name="berat_badan"
                                                    class="form-control @error('berat_badan') is-invalid @enderror"
                                                    placeholder="Berat Badan (kg)"
                                                    value="{{ old('berat_badan', $cv->berat_badan ?? '') }}" required>
                                                @error('berat_badan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Ukuran Pinggang (cm)</label>
                                                <input type="text" name="ukuran_pinggang"
                                                    class="form-control @error('ukuran_pinggang') is-invalid @enderror"
                                                    placeholder="Ukuran Pinggang (cm)"
                                                    value="{{ old('ukuran_pinggang', $cv->ukuran_pinggang ?? '') }}"
                                                    required>
                                                @error('ukuran_pinggang')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Ukuran Sepatu</label>
                                                <input type="text" name="ukuran_sepatu"
                                                    class="form-control @error('ukuran_sepatu') is-invalid @enderror"
                                                    placeholder="Ukuran Sepatu"
                                                    value="{{ old('ukuran_sepatu', $cv->ukuran_sepatu ?? '') }}"
                                                    required>
                                                @error('ukuran_sepatu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Ukuran Atasan Baju</label>
                                                <select name="ukuran_atasan_baju"
                                                    class="form-control @error('ukuran_atasan_baju') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Ukuran Atasan Baju --</option>
                                                    @php
                                                        $ukuranAtasanValue = old(
                                                            'ukuran_atasan_baju',
                                                            $cv->ukuran_atasan_baju ?? '',
                                                        );
                                                    @endphp
                                                    @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                        <option value="{{ $size }}"
                                                            {{ $ukuranAtasanValue == $size ? 'selected' : '' }}>
                                                            {{ $size }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ukuran_atasan_baju')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <input type="text" name="ukuran_atasan_baju_lainnya"
                                                    class="form-control mt-2"
                                                    placeholder="Ukuran Atasan Lainnya (Opsional)"
                                                    value="{{ old('ukuran_atasan_baju_lainnya') }}">

                                                <label class="mt-3 fw-bold">Ukuran Celana</label>
                                                <select name="ukuran_celana"
                                                    class="form-control @error('ukuran_celana') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Ukuran Celana --</option>
                                                    @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                        <option value="{{ $size }}"
                                                            {{ old('ukuran_celana') == $size || (isset($cv) && $cv->ukuran_celana == $size) ? 'selected' : '' }}>
                                                            {{ $size }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ukuran_celana')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Tangan Dominan</label>
                                                <select name="tangan_dominan"
                                                    class="form-control @error('tangan_dominan') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Tangan Dominan --</option>
                                                    <option value="Kanan"
                                                        {{ old('tangan_dominan') == 'Kanan' || (isset($cv) && $cv->tangan_dominan == 'Kanan') ? 'selected' : '' }}>
                                                        Kanan
                                                    </option>
                                                    <option value="Kiri"
                                                        {{ old('tangan_dominan') == 'Kiri' || (isset($cv) && $cv->tangan_dominan == 'Kiri') ? 'selected' : '' }}>
                                                        Kiri
                                                    </option>
                                                </select>
                                                @error('tangan_dominan')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror

                                                <label class="mt-3 fw-bold">Kemampuan Penglihatan</label>
                                                <select name="kemampuan_penglihatan_mata"
                                                    class="form-control @error('kemampuan_penglihatan_mata') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Kemampuan Penglihatan Mata --</option>
                                                    <option value="Minus"
                                                        {{ old('kemampuan_penglihatan_mata') == 'Minus' || (isset($cv) && $cv->kemampuan_penglihatan_mata == 'Minus') ? 'selected' : '' }}>
                                                        Minus
                                                    </option>
                                                    <option value="Normal"
                                                        {{ old('kemampuan_penglihatan_mata') == 'Normal' || (isset($cv) && $cv->kemampuan_penglihatan_mata == 'Normal') ? 'selected' : '' }}>
                                                        Normal
                                                    </option>
                                                    <option value="Silinders"
                                                        {{ old('kemampuan_penglihatan_mata') == 'Silinders' || (isset($cv) && $cv->kemampuan_penglihatan_mata == 'Silinders') ? 'selected' : '' }}>
                                                        Silinders</option>
                                                </select>
                                                <input type="text" name="kemampuan_penglihatan_mata_lainnya"
                                                    class="form-control mt-2" placeholder="Informasi Tambahan"
                                                    value="{{ old('kemampuan_penglihatan_mata_lainnya', $cv->kemampuan_penglihatan_mata_lainnya ?? '') }}">


                                                <label class="mt-3 fw-bold">Kemampuan Pendengaran</label>
                                                <select name="kemampuan_pendengaran"
                                                    class="form-control @error('kemampuan_pendengaran') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Kemampuan Pendengaran --</option>

                                                    <option value="Normal"
                                                        {{ old('kemampuan_pendengaran') == 'Normal' || (isset($cv) && $cv->kemampuan_pendengaran == 'Normal') ? 'selected' : '' }}>
                                                        Normal
                                                    </option>

                                                    <option value="Sedang"
                                                        {{ old('kemampuan_pendengaran') == 'Sedang' || (isset($cv) && $cv->kemampuan_pendengaran == 'Sedang') ? 'selected' : '' }}>
                                                        Sedang (pendengaran berkurang ringan)
                                                    </option>

                                                    <option value="Kurang"
                                                        {{ old('kemampuan_pendengaran') == 'Kurang' || (isset($cv) && $cv->kemampuan_pendengaran == 'Kurang') ? 'selected' : '' }}>
                                                        Kurang (membutuhkan suara lebih keras)
                                                    </option>

                                                    <option value="Tuli Ringan"
                                                        {{ old('kemampuan_pendengaran') == 'Tuli Ringan' || (isset($cv) && $cv->kemampuan_pendengaran == 'Tuli Ringan') ? 'selected' : '' }}>
                                                        Tuli Ringan
                                                    </option>

                                                    <option value="Tuli Berat"
                                                        {{ old('kemampuan_pendengaran') == 'Tuli Berat' || (isset($cv) && $cv->kemampuan_pendengaran == 'Tuli Berat') ? 'selected' : '' }}>
                                                        Tuli Berat
                                                    </option>
                                                </select>

                                                @error('kemampuan_pendengaran')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror


                                                <label class="mt-3 fw-bold">Sudah Vaksin Berapa Kali?</label>
                                                <select name="sudah_vaksin_berapa_kali"
                                                    class="form-control @error('sudah_vaksin_berapa_kali') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Sudah Vaksin --</option>
                                                    <option value="1x Vaksin"
                                                        {{ old('sudah_vaksin_berapa_kali') == '1x Vaksin' || (isset($cv) && $cv->sudah_vaksin_berapa_kali == '1x Vaksin') ? 'selected' : '' }}>
                                                        1x Vaksin</option>
                                                    <option value="2x Vaksin"
                                                        {{ old('sudah_vaksin_berapa_kali') == '2x Vaksin' || (isset($cv) && $cv->sudah_vaksin_berapa_kali == '2x Vaksin') ? 'selected' : '' }}>
                                                        2x Vaksin</option>
                                                    <option value="3x Vaksin"
                                                        {{ old('sudah_vaksin_berapa_kali') == '3x Vaksin' || (isset($cv) && $cv->sudah_vaksin_berapa_kali == '3x Vaksin') ? 'selected' : '' }}>
                                                        3x Vaksin</option>
                                                </select>

                                                <input type="text" name="sudah_vaksin_berapa_kali_lainnya"
                                                    class="form-control mt-2" placeholder="Lainnya"
                                                    value="{{ old('sudah_vaksin_berapa_kali_lainnya', $cv->sudah_vaksin_berapa_kali_lainnya ?? '') }}">

                                                <label class="mt-3 fw-bold">Kondisi Kesehatan Badan</label>
                                                <textarea name="kesehatan_badan" class="form-control" placeholder="Kesehatan Badan">{{ old('kesehatan_badan', $cv->kesehatan_badan ?? '') }}</textarea>

                                                <label class="mt-3 fw-bold">Riwayat Penyakit / Cedera</label>
                                                <textarea name="penyakit_cedera_masa_lalu" class="form-control" placeholder="Riwayat Penyakit & Cedera">{{ old('penyakit_cedera_masa_lalu', $cv->penyakit_cedera_masa_lalu ?? '') }}</textarea>

                                                <label class="mt-3 fw-bold">Hobi</label>
                                                <textarea name="hobi" class="form-control" placeholder="Hobi">{{ old('hobi', $cv->hobi ?? '') }}</textarea>

                                                <label class="mt-3 fw-bold">Rencana Sumber Biaya Keberangkatan</label>
                                                <select name="rencana_sumber_biaya_keberangkatan"
                                                    class="form-control @error('rencana_sumber_biaya_keberangkatan') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Sumber Biaya Keberangkatan --</option>
                                                    @foreach (['Dana talang LPK', 'Dana Pribadi', 'Dana Ortu', 'Dana pinjaman pihak lain'] as $sumber)
                                                        <option value="{{ $sumber }}"
                                                            {{ old('rencana_sumber_biaya_keberangkatan') == $sumber || (isset($cv) && $cv->rencana_sumber_biaya_keberangkatan == $sumber) ? 'selected' : '' }}>
                                                            {{ $sumber }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <label class="mt-3 fw-bold">Perkiraan Biaya</label>
                                                <select name="perkiraan_biaya"
                                                    class="form-control @error('perkiraan_biaya') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Perkiraan Biaya --</option>
                                                    <option value="10.000.000 - 20.000.000"
                                                        {{ old('perkiraan_biaya') == '10.000.000 - 20.000.000' || (isset($cv) && $cv->perkiraan_biaya == '10.000.000 - 20.000.000') ? 'selected' : '' }}>
                                                        10.000.000 - 20.000.000
                                                    </option>
                                                    <option value="20.000.000 - 30.000.000"
                                                        {{ old('perkiraan_biaya') == '20.000.000 - 30.000.000' || (isset($cv) && $cv->perkiraan_biaya == '20.000.000 - 30.000.000') ? 'selected' : '' }}>
                                                        20.000.000 - 30.000.000
                                                    </option>
                                                    <option value="30.000.000 - 40.000.000"
                                                        {{ old('perkiraan_biaya') == '30.000.000 - 40.000.000' || (isset($cv) && $cv->perkiraan_biaya == '30.000.000 - 40.000.000') ? 'selected' : '' }}>
                                                        30.000.000 - 40.000.000
                                                    </option>
                                                </select>
                                                <div class="">
                                                    <label class="form-label fw-bold">Biaya Keberangkatan Sebelumnya
                                                        (Jisshu)
                                                        *</label>
                                                    <p class="text-muted small mb-1">

                                                        <br><b>Contoh: 25.000.000</b>
                                                        jika tidak ada kosongkan
                                                    </p>
                                                    <input type="text" name="Biaya_keberangkatan_sebelumnya_jisshu"
                                                        class="form-control" placeholder="Contoh: 25.000.000" required
                                                        value="{{ old('Biaya_keberangkatan_sebelumnya_jisshu', $cv->Biaya_keberangkatan_sebelumnya_jisshu ?? '') }}">
                                                </div>
                                                <div class="mt-4">
                                                    <label class="fw-bold">Apakah Bersedia Kerja Shift?</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('bersedia_kerja_shift') is-invalid @enderror"
                                                            type="radio" name="bersedia_kerja_shift" id="shiftYa"
                                                            value="Ya"
                                                            {{ old('bersedia_kerja_shift') == 'Ya' || (isset($cv) && $cv->bersedia_kerja_shift == 'Ya') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="shiftYa">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('bersedia_kerja_shift') is-invalid @enderror"
                                                            type="radio" name="bersedia_kerja_shift" id="shiftTidak"
                                                            value="Tidak"
                                                            {{ old('bersedia_kerja_shift') == 'Tidak' || (isset($cv) && $cv->bersedia_kerja_shift == 'Tidak') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="shiftTidak">Tidak</label>
                                                    </div>
                                                    @error('bersedia_kerja_shift')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label class="fw-bold">Apakah Bersedia Kerja Lembur?</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('bersedia_lembur') is-invalid @enderror"
                                                            type="radio" name="bersedia_lembur" id="lemburYa"
                                                            value="Ya"
                                                            {{ old('bersedia_lembur') == 'Ya' || (isset($cv) && $cv->bersedia_lembur == 'Ya') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="lemburYa">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('bersedia_lembur') is-invalid @enderror"
                                                            type="radio" name="bersedia_lembur" id="lemburTidak"
                                                            value="Tidak"
                                                            {{ old('bersedia_lembur') == 'Tidak' || (isset($cv) && $cv->bersedia_lembur == 'Tidak') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="lemburTidak">Tidak</label>
                                                    </div>
                                                    @error('bersedia_lembur')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label class="fw-bold">Apakah Bersedia Kerja di Hari Libur?</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('bersedia_hari_libur') is-invalid @enderror"
                                                            type="radio" name="bersedia_hari_libur" id="liburYa"
                                                            value="Ya"
                                                            {{ old('bersedia_hari_libur') == 'Ya' || (isset($cv) && $cv->bersedia_hari_libur == 'Ya') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="liburYa">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('bersedia_hari_libur') is-invalid @enderror"
                                                            type="radio" name="bersedia_hari_libur" id="liburTidak"
                                                            value="Tidak"
                                                            {{ old('bersedia_hari_libur') == 'Tidak' || (isset($cv) && $cv->bersedia_hari_libur == 'Tidak') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="liburTidak">Tidak</label>
                                                    </div>
                                                    @error('bersedia_hari_libur')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mt-3">
                                                    <label class="fw-bold">Apakah Menggunakan Kacamata?</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('menggunakan_kacamata') is-invalid @enderror"
                                                            type="radio" name="menggunakan_kacamata" id="kacamataYa"
                                                            value="Ya"
                                                            {{ old('menggunakan_kacamata') == 'Ya' || (isset($cv) && $cv->menggunakan_kacamata == 'Ya') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="kacamataYa">Ya</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('menggunakan_kacamata') is-invalid @enderror"
                                                            type="radio" name="menggunakan_kacamata" id="kacamataTidak"
                                                            value="Tidak"
                                                            {{ old('menggunakan_kacamata') == 'Tidak' || (isset($cv) && $cv->menggunakan_kacamata == 'Tidak') ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label" for="kacamataTidak">Tidak</label>
                                                    </div>
                                                    @error('menggunakan_kacamata')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                </div>


                                            </div>

                                        </div>
                                    </div>

                                    <!-- Tambahkan field lainnya dari Data Diri -->
                                </div>
                            </div>
                            <div class="form-step" data-step="3">
                                <h4 class="section-title"><i class="fas fa-brain me-2"></i>Kemampuan & Kebugaran</h4>
                                <div class="card-body">
                                    <div class="row g-3">

                                        {{-- KOLOM KIRI --}}
                                        <div class="col-md-6">

                                            {{-- LAMA BELAJAR DI MENDUNIA --}}
                                            <label class="form-label">Lama Belajar di Mendunia <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="lama_belajar_di_mendunia"
                                                class="form-control @error('lama_belajar_di_mendunia') is-invalid @enderror"
                                                placeholder="Contoh: 2024年／01月 ～ 2024年／04月"
                                                value="{{ $cv->lama_belajar_di_mendunia ?? old('lama_belajar_di_mendunia') }}"
                                                required>
                                            @error('lama_belajar_di_mendunia')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- KEMAMPUAN BAHASA JEPANG --}}
                                            <label class="form-label mt-2">Kemampuan Bahasa Jepang <span
                                                    class="text-danger">*</span></label>
                                            <select name="kemampuan_bahasa_jepang"
                                                class="form-select @error('kemampuan_bahasa_jepang') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Tingkat Kemampuan --</option>
                                                <option value="A"
                                                    {{ ($cv->kemampuan_bahasa_jepang ?? old('kemampuan_bahasa_jepang')) == 'A' ? 'selected' : '' }}>
                                                    A:
                                                    Sangat Baik
                                                    (±90%)</option>
                                                <option value="B"
                                                    {{ ($cv->kemampuan_bahasa_jepang ?? old('kemampuan_bahasa_jepang')) == 'B' ? 'selected' : '' }}>
                                                    B: Baik
                                                    (±75%)
                                                </option>
                                                <option value="C"
                                                    {{ ($cv->kemampuan_bahasa_jepang ?? old('kemampuan_bahasa_jepang')) == 'C' ? 'selected' : '' }}>
                                                    C: Belum
                                                    Cukup
                                                    Baik (±50%)</option>
                                                <option value="D"
                                                    {{ ($cv->kemampuan_bahasa_jepang ?? old('kemampuan_bahasa_jepang')) == 'D' ? 'selected' : '' }}>
                                                    D: Tidak
                                                    Mampu
                                                    (±49%)</option>
                                            </select>
                                            @error('kemampuan_bahasa_jepang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- KEMAMPUAN PEMAHAMAN SSW --}}
                                            <label class="form-label mt-2">Kemampuan Pemahaman SSW <span
                                                    class="text-danger">*</span></label>
                                            <select name="kemampuan_pemahaman_ssw"
                                                class="form-select @error('kemampuan_pemahaman_ssw') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Tingkat Pemahaman --</option>
                                                <option value="A"
                                                    {{ ($cv->kemampuan_pemahaman_ssw ?? old('kemampuan_pemahaman_ssw')) == 'A' ? 'selected' : '' }}>
                                                    A:
                                                    Sangat Baik
                                                    (±90%)</option>
                                                <option value="B"
                                                    {{ ($cv->kemampuan_pemahaman_ssw ?? old('kemampuan_pemahaman_ssw')) == 'B' ? 'selected' : '' }}>
                                                    B: Baik
                                                    (±75%)
                                                </option>
                                                <option value="C"
                                                    {{ ($cv->kemampuan_pemahaman_ssw ?? old('kemampuan_pemahaman_ssw')) == 'C' ? 'selected' : '' }}>
                                                    C: Belum
                                                    Cukup
                                                    Baik (±50%)</option>
                                                <option value="D"
                                                    {{ ($cv->kemampuan_pemahaman_ssw ?? old('kemampuan_pemahaman_ssw')) == 'D' ? 'selected' : '' }}>
                                                    D: Tidak
                                                    Mampu
                                                    (±49%)</option>
                                            </select>
                                            @error('kemampuan_pemahaman_ssw')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- KELINCAHAN DALAM BEKERJA --}}
                                            <label class="form-label mt-2">Kelincahan dalam Bekerja <span
                                                    class="text-danger">*</span></label>
                                            <select name="kelincahan_dalam_bekerja"
                                                class="form-select @error('kelincahan_dalam_bekerja') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Tingkat Kelincahan --</option>
                                                <option value="A"
                                                    {{ ($cv->kelincahan_dalam_bekerja ?? old('kelincahan_dalam_bekerja')) == 'A' ? 'selected' : '' }}>
                                                    A:
                                                    Sangat
                                                    Baik (±90%)</option>
                                                <option value="B"
                                                    {{ ($cv->kelincahan_dalam_bekerja ?? old('kelincahan_dalam_bekerja')) == 'B' ? 'selected' : '' }}>
                                                    B: Baik
                                                    (±75%)</option>
                                                <option value="C"
                                                    {{ ($cv->kelincahan_dalam_bekerja ?? old('kelincahan_dalam_bekerja')) == 'C' ? 'selected' : '' }}>
                                                    C:
                                                    Belum
                                                    Cukup Baik (±50%)</option>
                                                <option value="D"
                                                    {{ ($cv->kelincahan_dalam_bekerja ?? old('kelincahan_dalam_bekerja')) == 'D' ? 'selected' : '' }}>
                                                    D:
                                                    Tidak
                                                    Mampu (±49%)</option>
                                            </select>
                                            @error('kelincahan_dalam_bekerja')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        {{-- KOLOM KANAN --}}
                                        <div class="col-md-6">

                                            {{-- KEKUATAN TINDAKAN --}}
                                            <label class="form-label">Kekuatan Tindakan <span
                                                    class="text-danger">*</span></label>
                                            <select name="kekuatan_tindakan"
                                                class="form-select @error('kekuatan_tindakan') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Tingkat Kekuatan Tindakan --</option>
                                                <option value="A"
                                                    {{ ($cv->kekuatan_tindakan ?? old('kekuatan_tindakan')) == 'A' ? 'selected' : '' }}>
                                                    A: Sangat Baik (±90%)</option>
                                                <option value="B"
                                                    {{ ($cv->kekuatan_tindakan ?? old('kekuatan_tindakan')) == 'B' ? 'selected' : '' }}>
                                                    B: Baik (±75%)</option>
                                                <option value="C"
                                                    {{ ($cv->kekuatan_tindakan ?? old('kekuatan_tindakan')) == 'C' ? 'selected' : '' }}>
                                                    C: Belum Cukup Baik (±50%)</option>
                                                <option value="D"
                                                    {{ ($cv->kekuatan_tindakan ?? old('kekuatan_tindakan')) == 'D' ? 'selected' : '' }}>
                                                    D: Tidak Mampu (±49%)</option>
                                            </select>
                                            @error('kekuatan_tindakan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- KEMAMPUAN BAHASA INGGRIS --}}
                                            <label class="form-label mt-2">Kemampuan Berbahasa Inggris <span
                                                    class="text-danger">*</span></label>
                                            <select name="kemampuan_berbahasa_inggris"
                                                class="form-select @error('kemampuan_berbahasa_inggris') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Tingkat Kemampuan --</option>
                                                <option value="A"
                                                    {{ ($cv->kemampuan_berbahasa_inggris ?? old('kemampuan_berbahasa_inggris')) == 'A' ? 'selected' : '' }}>
                                                    A:
                                                    Sangat
                                                    Baik (±90%)</option>
                                                <option value="B"
                                                    {{ ($cv->kemampuan_berbahasa_inggris ?? old('kemampuan_berbahasa_inggris')) == 'B' ? 'selected' : '' }}>
                                                    B:
                                                    Baik
                                                    (±75%)</option>
                                                <option value="C"
                                                    {{ ($cv->kemampuan_berbahasa_inggris ?? old('kemampuan_berbahasa_inggris')) == 'C' ? 'selected' : '' }}>
                                                    C:
                                                    Belum
                                                    Cukup Baik (±50%)</option>
                                                <option value="D"
                                                    {{ ($cv->kemampuan_berbahasa_inggris ?? old('kemampuan_berbahasa_inggris')) == 'D' ? 'selected' : '' }}>
                                                    D:
                                                    Tidak
                                                    Mampu (±49%)</option>
                                            </select>
                                            @error('kemampuan_berbahasa_inggris')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <input type="text" name="kemampuan_berbahasa_inggris_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ $cv->kemampuan_berbahasa_inggris_lainnya ?? old('kemampuan_berbahasa_inggris_lainnya') }}">

                                            {{-- KEBUGARAN JASMANI --}}
                                            <label class="form-label mt-2">Kebugaran Jasmani (aktivitas per minggu) <span
                                                    class="text-danger">*</span></label>
                                            <select name="kebugaran_jasmani_seminggu"
                                                class="form-select @error('kebugaran_jasmani_seminggu') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Frekuensi Olahraga --</option>
                                                <option value="3 kali/1 minggu"
                                                    {{ ($cv->kebugaran_jasmani_seminggu ?? old('kebugaran_jasmani_seminggu')) == '3 kali/1 minggu' ? 'selected' : '' }}>
                                                    3 kali / 1 minggu</option>
                                                <option value="4 kali/1 minggu"
                                                    {{ ($cv->kebugaran_jasmani_seminggu ?? old('kebugaran_jasmani_seminggu')) == '4 kali/1 minggu' ? 'selected' : '' }}>
                                                    4 kali / 1 minggu</option>
                                                <option value="5 kali/1 minggu"
                                                    {{ ($cv->kebugaran_jasmani_seminggu ?? old('kebugaran_jasmani_seminggu')) == '5 kali/1 minggu' ? 'selected' : '' }}>
                                                    5 kali / 1 minggu</option>
                                                <option value="10 kali/1 minggu"
                                                    {{ ($cv->kebugaran_jasmani_seminggu ?? old('kebugaran_jasmani_seminggu')) == '10 kali/1 minggu' ? 'selected' : '' }}>
                                                    10 kali / 1 minggu</option>
                                            </select>

                                            <input type="text" name="kebugaran_jasmani_seminggu_lainnya"
                                                class="form-control mt-2" placeholder="Informasi Tambahan"
                                                value="{{ $cv->kebugaran_jasmani_seminggu_lainnya ?? old('kebugaran_jasmani_seminggu_lainnya') }}">

                                            @error('kebugaran_jasmani_seminggu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- STEP 4: PENDIDIKAN -->
                            <!-- STEP 4: PENDIDIKAN -->
                            <div class="form-step" data-step="4">
                                <h4 class="section-title">
                                    <i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan
                                </h4>

                                <div class="card-body">

                                    <div id="pendidikanContainer">

                                        @forelse ($cv->pendidikans as $p)
                                            <div class="row g-3 mb-4 pendidikan-item">

                                                <!-- Nama Sekolah -->
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Nama Sekolah *</label>
                                                    <p class="text-muted small mb-2">Cantumkan pendidikan terakhir Anda.
                                                    </p>
                                                    <input type="text" name="pendidikan_nama[]" class="form-control"
                                                        value="{{ $p->nama }}"
                                                        placeholder="Contoh: SMK Negeri 1 Bandung / Universitas Indonesia"
                                                        required>
                                                </div>

                                                <!-- Tahun Masuk -->
                                                <div class="col-md-2">
                                                    <label class="form-label fw-bold">Tahun Masuk *</label>
                                                    <input type="number" name="pendidikan_tahun_masuk[]"
                                                        class="form-control" value="{{ $p->tahun_masuk }}"
                                                        placeholder="2020" required>
                                                </div>

                                                <!-- Tahun Lulus -->
                                                <div class="col-md-2">
                                                    <label class="form-label fw-bold">Tahun Lulus *</label>
                                                    <input type="number" name="pendidikan_tahun_lulus[]"
                                                        class="form-control" value="{{ $p->tahun_lulus }}"
                                                        placeholder="2024" required>
                                                </div>

                                                <!-- Jurusan -->
                                                <div class="col-md-3">
                                                    <label class="form-label fw-bold">Jurusan Sekolah *</label>
                                                    <p class="text-muted small mb-1">Isi menggunakan bahasa
                                                        Jepang<br><b>Contoh: 技術</b></p>
                                                    <input type="text" name="pendidikan_jurusan[]"
                                                        class="form-control" value="{{ $p->jurusan }}"
                                                        placeholder="Contoh: 技術" required>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-row">X</button>
                                                </div>

                                            </div>
                                        @empty
                                            <!-- TAMPILAN SAAT BELUM ADA DATA -->
                                            <div class="row g-3 mb-4 pendidikan-item">

                                                <!-- Nama Sekolah -->
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Nama Sekolah *</label>
                                                    <p class="text-muted small mb-2">Cantumkan pendidikan terakhir Anda.
                                                    </p>
                                                    <input type="text" name="pendidikan_nama[]" class="form-control"
                                                        placeholder="Contoh: SMK Negeri 1 Bandung / Universitas Indonesia"
                                                        required>
                                                </div>

                                                <!-- Tahun Masuk -->
                                                <div class="col-md-2">
                                                    <label class="form-label fw-bold">Tahun Masuk *</label>
                                                    <input type="number" name="pendidikan_tahun_masuk[]"
                                                        class="form-control" placeholder="2020" required>
                                                </div>

                                                <!-- Tahun Lulus -->
                                                <div class="col-md-2">
                                                    <label class="form-label fw-bold">Tahun Lulus *</label>
                                                    <input type="number" name="pendidikan_tahun_lulus[]"
                                                        class="form-control" placeholder="2024" required>
                                                </div>

                                                <!-- Jurusan -->
                                                <div class="col-md-3">
                                                    <label class="form-label fw-bold">Jurusan Sekolah *</label>
                                                    <p class="text-muted small mb-1">Isi menggunakan bahasa
                                                        Jepang<br><b>Contoh: 技術</b></p>
                                                    <input type="text" name="pendidikan_jurusan[]"
                                                        class="form-control" placeholder="Contoh: 技術" required>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-row">X</button>
                                                </div>

                                            </div>
                                        @endforelse

                                    </div>

                                    <button type="button" class="btn btn-secondary mt-2" id="addPendidikan">
                                        + Tambah Pendidikan
                                    </button>

                                </div>
                            </div>


                            <!-- STEP 5: PENGALAMAN -->
                            <div class="form-step" data-step="5">
                                <h4 class="section-title"><i class="fas fa-briefcase me-2"></i>Pengalaman Kerja</h4>
                                <div id="pengalamanContainer">
                                    {{-- BARIS PENGALAMAN KERJA YANG SUDAH ADA (LOOP) --}}
                                    @if ($cv->pengalamans->count() > 0)
                                        @foreach ($cv->pengalamans as $p)
                                            {{-- Menggunakan card untuk membungkus setiap pengalaman yang ada --}}
                                            <div class="card mb-3 pengalaman-item">
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        {{-- Nama Perusahaan (col-md-3) --}}
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Nama Perusahaan *</label>
                                                            <input type="text" name="pengalaman_perusahaan[]"
                                                                class="form-control" value="{{ $p->perusahaan }}"
                                                                required>
                                                        </div>

                                                        {{-- Jabatan (col-md-3) --}}
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Jabatan *</label>
                                                            <input type="text" name="pengalaman_jabatan[]"
                                                                class="form-control" value="{{ $p->jabatan }}"
                                                                required>
                                                        </div>

                                                        {{-- Alamat Kota (col-md-2) --}}
                                                        <div class="col-md-2">
                                                            <label class="form-label fw-bold">Alamat Kota *</label>
                                                            <input type="text" name="pengalaman_kota[]"
                                                                class="form-control" value="{{ $p->kota }}"
                                                                required>
                                                        </div>

                                                        {{-- Tanggal Masuk (col-md-2) --}}
                                                        <div class="col-md-2">
                                                            <label class="form-label fw-bold">Tanggal Masuk *</label>
                                                            <input type="month" name="pengalaman_tanggal_masuk[]"
                                                                class="form-control" value="{{ $p->tanggal_masuk }}"
                                                                required>
                                                        </div>

                                                        {{-- Tanggal Keluar (col-md-2) --}}
                                                        <div class="col-md-2">
                                                            <label class="form-label fw-bold">Tanggal Keluar *</label>
                                                            <input type="month" name="pengalaman_tanggal_keluar[]"
                                                                class="form-control" value="{{ $p->tanggal_keluar }}"
                                                                required>
                                                        </div>

                                                        {{-- Gaji (col-md-2) --}}
                                                        <div class="col-md-2">
                                                            <label class="form-label fw-bold">Gaji</label>
                                                            <input type="text" name="pengalaman_gaji[]"
                                                                class="form-control" value="{{ $p->gaji }}">
                                                        </div>

                                                        {{-- Remove Button (col-md-1) --}}
                                                        <div class="col-md-1 d-flex align-items-end">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-row">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- Jika tidak ada data, tampilkan form kosong pertama --}}
                                        <div class="card mb-3 pengalaman-item">
                                            <div class="card-body">
                                                <div class="row g-3">
                                                    {{-- Nama Perusahaan (col-md-3) --}}
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Nama Perusahaan *</label>
                                                        <input type="text" name="pengalaman_perusahaan[]"
                                                            class="form-control" required>
                                                    </div>

                                                    {{-- Jabatan (col-md-3) --}}
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Jabatan *</label>
                                                        <input type="text" name="pengalaman_jabatan[]"
                                                            class="form-control" required>
                                                    </div>

                                                    {{-- Alamat Kota (col-md-2) --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">Alamat Kota *</label>
                                                        <input type="text" name="pengalaman_kota[]"
                                                            class="form-control" required>
                                                    </div>

                                                    {{-- Tanggal Masuk (col-md-2) --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">Tanggal Masuk *</label>
                                                        <input type="month" name="pengalaman_tanggal_masuk[]"
                                                            class="form-control" required>
                                                    </div>

                                                    {{-- Tanggal Keluar (col-md-2) --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">Tanggal Keluar *</label>
                                                        <input type="month" name="pengalaman_tanggal_keluar[]"
                                                            class="form-control" required>
                                                    </div>

                                                    {{-- Gaji (col-md-2) --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">Gaji</label>
                                                        <input type="text" name="pengalaman_gaji[]"
                                                            class="form-control">
                                                    </div>

                                                    {{-- Tombol Hapus (opsional untuk baris pertama jika wajib diisi) --}}
                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger btn-sm remove-row"
                                                            disabled>X</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- TOMBOL TAMBAH PENGALAMAN (Hanya muncul satu kali di luar container) --}}
                                    <button type="button" class="btn btn-secondary mt-3 mb-4" id="addPengalaman">
                                        <i class="fas fa-plus-circle me-1"></i> + Tambah Pengalaman
                                    </button>
                                </div>


                                {{-- HALAMAN 4: MAGANG (Eks Jisshu) --}}
                                <div class="card mb-4">
                                    <div class="card-header fw-bold">Magang (Eks Jisshu)</div>
                                    <div class="card-body">

                                        <div id="magangContainer">

                                            @if ($cv->magangjisshu->count() > 0)
                                                @foreach ($cv->magangjisshu as $m)
                                                    <div class="row g-3 mb-3 magang-item">

                                                        <!-- Nama Perusahaan -->
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Nama Perusahaan *</label>
                                                            <input type="text" name="magang_perusahaan[]"
                                                                class="form-control" value="{{ $m->perusahaan }}"
                                                                required>
                                                        </div>

                                                        <!-- Kota / Prefektur -->
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Kota / Prefektur *</label>
                                                            <input type="text" name="magang_kota_prefektur[]"
                                                                class="form-control" value="{{ $m->kota_prefektur }}"
                                                                required>
                                                        </div>

                                                        <!-- Bidang -->
                                                        <div class="col-md-3">
                                                            <label class="form-label fw-bold">Bidang *</label>
                                                            <input type="text" name="magang_bidang[]"
                                                                class="form-control" value="{{ $m->bidang }}"
                                                                required>
                                                        </div>

                                                        <!-- Tahun Mulai -->
                                                        <div class="col-md-2">
                                                            <label class="form-label fw-bold">Tahun Mulai *</label>
                                                            <input type="month" name="magang_tahun_mulai[]"
                                                                class="form-control" value="{{ $m->tahun_mulai }}"
                                                                required>
                                                        </div>

                                                        <!-- Tahun Selesai -->
                                                        <div class="col-md-2">
                                                            <label class="form-label fw-bold">Tahun Selesai *</label>
                                                            <input type="month" name="magang_tahun_selesai[]"
                                                                class="form-control" value="{{ $m->tahun_selesai }}"
                                                                required>
                                                        </div>

                                                        <!-- Hapus -->
                                                        <div class="col-md-1 d-flex align-items-end">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-row">X</button>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @else
                                                {{-- Jika Tidak Ada Data, Tampilkan Form Kosong --}}
                                                <div class="row g-3 mb-3 magang-item">

                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Nama Perusahaan *</label>
                                                        <input type="text" name="magang_perusahaan[]"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Kota / Prefektur *</label>
                                                        <input type="text" name="magang_kota_prefektur[]"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">Bidang *</label>
                                                        <input type="text" name="magang_bidang[]" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">Tahun Mulai *</label>
                                                        <input type="month" name="magang_tahun_mulai[]"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">Tahun Selesai *</label>
                                                        <input type="month" name="magang_tahun_selesai[]"
                                                            class="form-control" required>
                                                    </div>

                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-row">X</button>
                                                    </div>

                                                </div>
                                            @endif

                                        </div>


                                        <button type="button" class="btn btn-secondary mt-2" id="addMagang">
                                            + Tambah Data Magang
                                        </button>

                                    </div>

                                    <div class="">

                                        <!-- INFORMASI PENTING -->
                                        <div class="bg-info text-dark rounded-3 py-4 px-4 mx-4">
                                            <strong class="d-block mb-1">Perhatian:</strong>
                                            <ul class="mb-0 ps-3">

                                                <li>Jika tidak memiliki pengalaman pekerjaan terakhir (X Jisshu / TG /
                                                    Katsudo)
                                                    abaikan
                                                    saja / jika ada klik tombol riwayat pekerjaan terakhir (X Jisshu / TG /
                                                    Katsudo)
                                                </li>
                                            </ul>
                                        </div>

                                        <button type="button" class="btn btn-secondary mx-4 mt-3 mb-3 "
                                            id="btnRiwayatToggle">
                                            + Riwayat Pekerjaan Terakhir (X Jisshu / TG / Katsudo)
                                        </button>
                                    </div>

                                    <div id="riwayatContainer" class="border rounded p-3 mx-4 mb-4"
                                        style="display:none;">
                                        <h5 class="fw-bold mb-3">Riwayat Pekerjaan Terakhir</h5>

                                        <div id="riwayatList"></div>

                                        <button type="button" class="btn btn-success btn-sm" id="addRiwayat">
                                            + Tambah Riwayat Pekerjaan
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- STEP 6: INFORMASI TAMBAHAN -->
                            <div class="form-step" data-step="6">
                                <h4 class="section-title"><i class="fas fa-plus-circle me-2"></i>Informasi Tambahan</h4>
                                <div class="card-body">


                                    <!-- INFORMASI PENTING -->
                                    <div class="bg-info text-dark rounded-3 py-4 px-4">
                                        <strong class="d-block mb-1">Perhatian:</strong>
                                        <ul class="mb-0 ps-3">
                                            <li>Semua bagian yang berisi teks wajib ditulis dalam <strong>bahasa
                                                    Jepang</strong>.</li>
                                            <li>Gunakan kalimat singkat, sopan, dan mudah dipahami.</li>
                                            <li>Jika tidak memiliki keterangan, isi dengan 「なし」.</li>
                                        </ul>
                                    </div>

                                    <div class="row g-3">

                                        {{-- ====================== KOLOM KIRI ====================== --}}
                                        <div class="col-md-6">

                                            {{-- Ada keluarga di Jepang --}}
                                            <label class="form-label">
                                                Ada Keluarga di Jepang? <span class="text-danger">*</span>
                                            </label>
                                            <select name="ada_keluarga_di_jepang" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['Ya', 'Tidak'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('ada_keluarga_di_jepang', $cv->ada_keluarga_di_jepang) == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Hubungan keluarga --}}
                                            <label class="form-label mt-2">
                                                Hubungan dengan Keluarga di Jepang <span class="text-danger">*</span>
                                            </label>
                                            <select name="hubungan_keluarga_di_jepang" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['Ayah', 'Ibu', 'Paman', 'Kakak', 'Adik', 'Bibi', 'Kakek', 'Nenek', 'Tidak ada'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('hubungan_keluarga_di_jepang', $cv->hubungan_keluarga_di_jepang) == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Status kerabat --}}
                                            <label class="form-label mt-2">Status Kerabat di Jepang <span
                                                    class="text-danger">*</span></label>
                                            <select name="status_kerabat_di_jepang" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['TG 1', 'Jishusei 1', 'Jishusei 2', 'Jishusei 3', 'EIJU', 'Tokutei katsudou', 'Tidak ada'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('status_kerabat_di_jepang', $cv->status_kerabat_di_jepang) == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            {{-- Tambahan informasi --}}
                                            <input type="text" name="status_kerabat_di_jepang_lainnya"
                                                class="form-control mt-2"
                                                placeholder="Jika ada tambahan (contoh: 東京に住んでいます)"
                                                value="{{ old('status_kerabat_di_jepang_lainnya', $cv->status_kerabat_di_jepang_lainnya) }}">

                                            {{-- Lama bekerja --}}
                                            <label class="form-label mt-2">
                                                Ingin Bekerja Berapa Tahun? <span class="text-danger">*</span>
                                            </label>
                                            <select name="ingin_bekerja_berapa_tahun" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['2 Tahun', '3 Tahun', '4 Tahun', '5 Tahun'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('ingin_bekerja_berapa_tahun', $cv->ingin_bekerja_berapa_tahun) == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <input type="text" name="ingin_bekerja_berapa_tahun_lainnya"
                                                class="form-control mt-2"
                                                placeholder="Jika ada tambahan (contoh: できるだけ長く働きたいです)"
                                                value="{{ old('ingin_bekerja_berapa_tahun_lainnya', $cv->ingin_bekerja_berapa_tahun_lainnya) }}">

                                            {{-- Pulang ke Indonesia --}}
                                            <label class="form-label mt-2">
                                                Ingin Pulang Berapa Kali? <span class="text-danger">*</span>
                                            </label>
                                            <select name="ingin_pulang_berapa_kali" class="form-control" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['1-2 Kali', '2 - 3 Kali', '4-5 Kali'] as $opt)
                                                    <option value="{{ $opt }}"
                                                        {{ old('ingin_pulang_berapa_kali', $cv->ingin_pulang_berapa_kali) == $opt ? 'selected' : '' }}>
                                                        {{ $opt }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        {{-- ====================== KOLOM KANAN ====================== --}}
                                        <div class="col-md-6">

                                            {{-- Kelebihan diri --}}
                                            <label class="form-label">Kelebihan Diri <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="kelebihan_diri" class="form-control" placeholder="Contoh: 私の長所は責任感が強く、時間を守れることです。">{{ old('kelebihan_diri', $cv->kelebihan_diri) }}</textarea>

                                            {{-- Komentar guru ttg kelebihan --}}
                                            <label class="form-label mt-2">Komentar Guru tentang Kelebihan Anda</label>
                                            <textarea name="komentar_guru_kelebihan_diri" class="form-control">{{ old('komentar_guru_kelebihan_diri', $cv->komentar_guru_kelebihan_diri) }}</textarea>

                                            {{-- Kekurangan --}}
                                            <label class="form-label mt-2">Kekurangan Diri <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="kekurangan_diri" class="form-control">{{ old('kekurangan_diri', $cv->kekurangan_diri) }}</textarea>

                                            {{-- Komentar guru ttg kekurangan --}}
                                            <label class="form-label mt-2">Komentar Guru tentang Kekurangan Anda</label>
                                            <textarea name="komentar_guru_kekurangan_diri" class="form-control">{{ old('komentar_guru_kekurangan_diri', $cv->komentar_guru_kekurangan_diri) }}</textarea>

                                            {{-- Ketertarikan Jepang --}}
                                            <label class="form-label mt-2">Ketertarikan terhadap Jepang <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="ketertarikan_terhadap_jepang" class="form-control">{{ old('ketertarikan_terhadap_jepang', $cv->ketertarikan_terhadap_jepang) }}</textarea>

                                            {{-- Orang dihormati --}}
                                            <label class="form-label mt-2">Orang yang Dihormati dan Alasannya</label>
                                            <textarea name="orang_yang_dihormati" class="form-control">{{ old('orang_yang_dihormati', $cv->orang_yang_dihormati) }}</textarea>

                                            {{-- Point plus --}}
                                            <label class="form-label mt-2">Point Plus Diri</label>
                                            <textarea name="point_plus_diri" class="form-control">{{ old('point_plus_diri', $cv->point_plus_diri) }}</textarea>

                                            {{-- Keahlian khusus --}}
                                            <label class="form-label mt-2">Keahlian Khusus yang Menunjang Pekerjaan <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="keahlian_khusus" class="form-control">{{ old('keahlian_khusus', $cv->keahlian_khusus) }}</textarea>

                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- STEP 7: DATA KELUARGA -->
                            <div class="form-step" data-step="7">
                                <h4 class="section-title"><i class="fas fa-users me-2"></i>Data Keluarga</h4>
                                <div class="card-body">

                                    {{-- INFORMASI PENTING --}}
                                    <div class="bg-info text-dark rounded-3 py-3 px-4 mb-3">
                                        <strong class="d-block mb-1">Perhatian:</strong>
                                        <ul class="mb-0 ps-3">
                                            <li>Semua bagian harus diisi menggunakan <strong>bahasa Jepang</strong>.</li>
                                            <li>Tuliskan data sesuai kolom yang tersedia.</li>
                                            <li>Jika tidak ada, isi dengan 「なし」.</li>
                                        </ul>
                                    </div>

                                    <div class="row g-3">

                                        {{-- ==================== KOLOM KIRI ==================== --}}
                                        <div class="col-md-6">

                                            {{-- ISTRI / SUAMI --}}
                                            <label class="form-label fw-bold">Istri / Suami</label>
                                            <input type="text" name="istri_nama" class="form-control mb-2"
                                                placeholder="Nama Istri / Suami"
                                                value="{{ old('istri_nama', $cv->istri_nama) }}">

                                            <input type="text" name="istri_usia" class="form-control mb-2"
                                                placeholder="Usia" value="{{ old('istri_usia', $cv->istri_usia) }}">

                                            <input type="text" name="istri_pekerjaan" class="form-control mb-3"
                                                placeholder="Pekerjaan"
                                                value="{{ old('istri_pekerjaan', $cv->istri_pekerjaan) }}">


                                            {{-- ANAK --}}
                                            <label class="form-label fw-bold">Anak</label>
                                            <input type="text" name="anak_nama" class="form-control mb-2"
                                                placeholder="Nama Anak"
                                                value="{{ old('anak_nama', $cv->anak_nama) }}">

                                            <input type="text" name="anak_jenis_kelamin" class="form-control mb-2"
                                                placeholder="Jenis Kelamin (男/女)"
                                                value="{{ old('anak_jenis_kelamin', $cv->anak_jenis_kelamin) }}">

                                            <input type="text" name="anak_usia" class="form-control mb-2"
                                                placeholder="Usia" value="{{ old('anak_usia', $cv->anak_usia) }}">

                                            <input type="text" name="anak_pendidikan" class="form-control mb-3"
                                                placeholder="Pendidikan"
                                                value="{{ old('anak_pendidikan', $cv->anak_pendidikan) }}">


                                            {{-- IBU --}}
                                            <label class="form-label fw-bold">Ibu <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="ibu_nama" class="form-control mb-2"
                                                placeholder="Nama Ibu" required
                                                value="{{ old('ibu_nama', $cv->ibu_nama) }}">

                                            <input type="text" name="ibu_usia" class="form-control mb-2"
                                                placeholder="Usia" required
                                                value="{{ old('ibu_usia', $cv->ibu_usia) }}">

                                            <input type="text" name="ibu_pekerjaan" class="form-control mb-3"
                                                placeholder="Pekerjaan"
                                                value="{{ old('ibu_pekerjaan', $cv->ibu_pekerjaan) }}">

                                        </div>


                                        {{-- ==================== KOLOM KANAN ==================== --}}
                                        <div class="col-md-6">

                                            {{-- AYAH --}}
                                            <label class="form-label fw-bold">Ayah <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="ayah_nama" class="form-control mb-2"
                                                placeholder="Nama Ayah" required
                                                value="{{ old('ayah_nama', $cv->ayah_nama) }}">

                                            <input type="text" name="ayah_usia" class="form-control mb-2"
                                                placeholder="Usia" required
                                                value="{{ old('ayah_usia', $cv->ayah_usia) }}">

                                            <input type="text" name="ayah_pekerjaan" class="form-control mb-3"
                                                placeholder="Pekerjaan"
                                                value="{{ old('ayah_pekerjaan', $cv->ayah_pekerjaan) }}">


                                            {{-- KAKAK --}}
                                            <label class="form-label fw-bold">Kakak</label>
                                            <input type="text" name="kakak_nama" class="form-control mb-2"
                                                placeholder="Nama Kakak"
                                                value="{{ old('kakak_nama', $cv->kakak_nama) }}">

                                            <input type="text" name="kakak_usia" class="form-control mb-2"
                                                placeholder="Usia" value="{{ old('kakak_usia', $cv->kakak_usia) }}">

                                            <input type="text" name="kakak_jenis_kelamin" class="form-control mb-2"
                                                placeholder="Jenis Kelamin (男/女)"
                                                value="{{ old('kakak_jenis_kelamin', $cv->kakak_jenis_kelamin) }}">

                                            <input type="text" name="kakak_pekerjaan" class="form-control mb-2"
                                                placeholder="Pekerjaan"
                                                value="{{ old('kakak_pekerjaan', $cv->kakak_pekerjaan) }}">

                                            <input type="text" name="kakak_status" class="form-control mb-3"
                                                placeholder="Status (例：実兄 / 義兄 / なし)"
                                                value="{{ old('kakak_status', $cv->kakak_status) }}">


                                            {{-- ADIK --}}
                                            <label class="form-label fw-bold">Adik</label>
                                            <input type="text" name="adik_nama" class="form-control mb-2"
                                                placeholder="Nama Adik"
                                                value="{{ old('adik_nama', $cv->adik_nama) }}">

                                            <input type="text" name="adik_usia" class="form-control mb-2"
                                                placeholder="Usia" value="{{ old('adik_usia', $cv->adik_usia) }}">

                                            <input type="text" name="adik_jenis_kelamin" class="form-control mb-2"
                                                placeholder="Jenis Kelamin (男/女)"
                                                value="{{ old('adik_jenis_kelamin', $cv->adik_jenis_kelamin) }}">

                                            <input type="text" name="adik_pekerjaan" class="form-control mb-2"
                                                placeholder="Pekerjaan"
                                                value="{{ old('adik_pekerjaan', $cv->adik_pekerjaan) }}">

                                            <input type="text" name="adik_status" class="form-control mb-3"
                                                placeholder="Status (例：実弟 / 義弟 / なし)"
                                                value="{{ old('adik_status', $cv->adik_status) }}">


                                            {{-- PENGHASILAN KELUARGA --}}
                                            <label class="form-label fw-bold">
                                                Rata-rata Penghasilan Keluarga per Bulan (円)
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="text" name="rata_rata_penghasilan_keluarga"
                                                class="form-control @error('rata_rata_penghasilan_keluarga') is-invalid @enderror"
                                                placeholder="Contoh: 80000 円" required
                                                value="{{ old('rata_rata_penghasilan_keluarga', $cv->rata_rata_penghasilan_keluarga) }}">

                                            @error('rata_rata_penghasilan_keluarga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="step-buttons">
                                <button type="button" class="btn btn-step btn-prev" id="prevBtn"
                                    style="display: none;">
                                    <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                                </button>
                                <button type="button" class="btn btn-step btn-next ms-auto" id="nextBtn">
                                    Selanjutnya<i class="fas fa-arrow-right ms-2"></i>
                                </button>
                                <button type="submit" class="btn btn-step btn-submit ms-auto" id="submitBtn"
                                    style="display: none;">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim
                                </button>

                            </div>
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
            let currentStep = 1;
            const totalSteps = 7;

            // Update Progress
            function updateProgress() {
                const progressPercent = ((currentStep - 1) / (totalSteps - 1)) * 100;
                $('#progressLine').css('width', progressPercent + '%');

                $('.step').each(function() {
                    const stepNum = $(this).data('step');
                    if (stepNum < currentStep) {
                        $(this).addClass('completed').removeClass('active');
                        $(this).find('span:first').html('<i class="fas fa-check"></i>');
                    } else if (stepNum === currentStep) {
                        $(this).addClass('active').removeClass('completed');
                        $(this).find('span:first').text(stepNum);
                    } else {
                        $(this).removeClass('active completed');
                        $(this).find('span:first').text(stepNum);
                    }
                });
            }

            // Show Step
            function showStep(step) {
                $('.form-step').removeClass('active');
                $(`.form-step[data-step="${step}"]`).addClass('active');

                // Update buttons
                if (step === 1) {
                    $('#prevBtn').hide();
                } else {
                    $('#prevBtn').show();
                }

                if (step === totalSteps) {
                    $('#nextBtn').hide();
                    $('#submitBtn').show();
                } else {
                    $('#nextBtn').show();
                    $('#submitBtn').hide();
                }

                updateProgress();
                $('html, body').animate({
                    scrollTop: 0
                }, 400);
            }

            // Next Button
            $('#nextBtn').click(function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            // Previous Button
            $('#prevBtn').click(function() {
                currentStep--;
                showStep(currentStep);
            });

            // Validate Current Step
            function validateStep(step) {
                let isValid = true;
                const currentStepElement = $(`.form-step[data-step="${step}"]`);

                currentStepElement.find('input[required], select[required], textarea[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');

                        if (!$(this).next('.invalid-feedback').length) {
                            $(this).after('<div class="invalid-feedback">Field ini wajib diisi</div>');
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian!',
                        text: 'Mohon lengkapi semua field yang wajib diisi',
                    });
                }

                return isValid;
            }

            // Remove validation on input
            $(document).on('input change', '.is-invalid', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            // Form Submit
            $('#cvForm').on('submit', function(e) {
                e.preventDefault();

                let form = $('#cvForm')[0];
                let formData = new FormData(form);

                $.ajax({
                    url: $('#cvForm').attr('action'),
                    method: 'PUT',
                    data: formData,
                    processData: false,
                    contentType: false,

                    beforeSend: function() {
                        $('#submitBtn').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...');
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
                                window.location.href = '/';
                            }, 1500);
                        }
                    },

                    error: function(xhr) {
                        $('#submitBtn').prop('disabled', false).html(
                            '<i class="fas fa-paper-plane me-2"></i>Kirim');

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback d-block">' +
                                    messages[0] + '</div>');
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

            // Initialize
            showStep(1);

            // Preview Upload Sertifikat
            document.getElementById('sertifikatInput').addEventListener('change', function(e) {
                const preview = document.getElementById('previewSertifikat');
                preview.innerHTML = "";
                const files = Array.from(e.target.files);

                files.forEach((file) => {
                    const ext = file.name.split('.').pop().toLowerCase();
                    const fileURL = URL.createObjectURL(file);
                    const wrapper = document.createElement('div');
                    wrapper.style.width = "110px";
                    wrapper.style.textAlign = "center";

                    if (['jpg', 'jpeg', 'png'].includes(ext)) {
                        const img = document.createElement('img');
                        img.src = fileURL;
                        img.style.width = "100px";
                        img.style.height = "100px";
                        img.style.objectFit = "cover";
                        img.style.borderRadius = "8px";
                        img.style.border = "1px solid #ccc";
                        wrapper.appendChild(img);
                    } else if (ext === "pdf") {
                        const pdfDiv = document.createElement('div');
                        pdfDiv.innerHTML =
                            `<i class="bi bi-file-earmark-pdf text-danger" style="font-size:48px;"></i>`;
                        wrapper.appendChild(pdfDiv);
                    }

                    const fileName = document.createElement('div');
                    fileName.classList.add('small', 'mt-1');
                    fileName.innerText = file.name.length > 15 ? file.name.substring(0, 12) +
                        "..." : file.name;
                    wrapper.appendChild(fileName);
                    preview.appendChild(wrapper);
                });
            });

            // Copy semua script preview file dan dynamic form dari kode asli
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // wilayah api
        // ===============================//
        // API WILAYAH INDONESIA
        // Menggunakan Vanilla JavaScript (Fetch API)
        // ===============================//

        // Deklarasi Element Select
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        // ===============================//
        // 1. LOAD PROVINSI
        // ===============================//
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(res => res.json())
            .then(data => {
                data.forEach(p => {
                    provinsiSelect.innerHTML +=
                        `<option value="${p.name}" data-id="${p.id}">${p.name}</option>`;
                });
            })
            .catch(error => {
                console.error('Gagal memuat data provinsi:', error);
                provinsiSelect.innerHTML = '<option value="">Gagal memuat data provinsi</option>';
            });

        // ===============================//
        // 2. LOAD KABUPATEN
        // ===============================//
        provinsiSelect.addEventListener('change', function() {
            // Reset kabupaten, kecamatan, kelurahan
            kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';

            // Disable select
            kabupatenSelect.disabled = true;
            kecamatanSelect.disabled = true;
            kelurahanSelect.disabled = true;

            const provId = this.selectedOptions[0].dataset.id;
            if (!provId) return;

            // Loading state
            kabupatenSelect.innerHTML = '<option value="">Memuat data...</option>';

            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                .then(res => res.json())
                .then(data => {
                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                    data.forEach(k => {
                        kabupatenSelect.innerHTML +=
                            `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`;
                    });
                    kabupatenSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Gagal memuat data kabupaten:', error);
                    kabupatenSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        });

        // ===============================//
        // 3. LOAD KECAMATAN
        // ===============================//
        kabupatenSelect.addEventListener('change', function() {
            // Reset kecamatan & kelurahan
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';

            // Disable select
            kecamatanSelect.disabled = true;
            kelurahanSelect.disabled = true;

            const kabId = this.selectedOptions[0].dataset.id;
            if (!kabId) return;

            // Loading state
            kecamatanSelect.innerHTML = '<option value="">Memuat data...</option>';

            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                .then(res => res.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    data.forEach(c => {
                        kecamatanSelect.innerHTML +=
                            `<option value="${c.name}" data-id="${c.id}">${c.name}</option>`;
                    });
                    kecamatanSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Gagal memuat data kecamatan:', error);
                    kecamatanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        });

        // ===============================//
        // 4. LOAD KELURAHAN
        // ===============================//
        kecamatanSelect.addEventListener('change', function() {
            // Reset kelurahan
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';

            // Disable select
            kelurahanSelect.disabled = true;

            const kecId = this.selectedOptions[0].dataset.id;
            if (!kecId) return;

            // Loading state
            kelurahanSelect.innerHTML = '<option value="">Memuat data...</option>';

            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                .then(res => res.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    data.forEach(v => {
                        kelurahanSelect.innerHTML +=
                            `<option value="${v.name}">${v.name}</option>`;
                    });
                    kelurahanSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Gagal memuat data kelurahan:', error);
                    kelurahanSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        });




        document.getElementById('pasFotoInputCv').addEventListener('change', function(event) {
            const file = event.target.files[0]; // ambil hanya file pertama
            const preview = document.getElementById('previewPasFotoCv');

            preview.innerHTML = ""; // reset preview

            if (!file) return; // jika tidak ada file, keluar

            const fileType = file.type;
            const container = document.createElement('div');
            container.style.width = "120px";
            container.style.textAlign = "center";

            // Jika file adalah gambar
            if (fileType.includes("image")) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = "img-thumbnail";
                img.style.width = "100%";
                img.style.height = "140px";
                img.style.objectFit = "cover";

                container.appendChild(img);
            } else {
                // Untuk PDF / DOC / DOCX → tampilkan ikon
                const icon = document.createElement('div');
                icon.innerHTML = `
            <div style="
                width:100%; 
                height:140px; 
                display:flex;
                justify-content:center; 
                align-items:center;
                background:#f1f1f1;
                border-radius:6px;
                font-size:40px;">
                📄
            </div>
        `;
                container.appendChild(icon);
            }

            const label = document.createElement('p');
            label.className = "small mt-1";
            label.textContent = file.name.length > 12 ? file.name.substring(0, 12) + "..." : file.name;

            container.appendChild(label);
            preview.appendChild(container);
        });

        document.getElementById('pasFotoInput').addEventListener('change', function(event) {
            const files = event.target.files;
            const preview = document.getElementById('previewPasFoto');

            preview.innerHTML = ""; // reset

            if (files.length > 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Terlalu Banyak',
                    text: 'Maksimal upload 5 file!',
                    confirmButtonColor: '#d33'
                });

                event.target.value = "";
                return;
            }

            Array.from(files).forEach(file => {
                const fileType = file.type;
                const container = document.createElement('div');
                container.style.width = "120px";
                container.style.textAlign = "center";

                // Jika file adalah gambar
                if (fileType.includes("image")) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className = "img-thumbnail";
                    img.style.width = "100%";
                    img.style.height = "140px";
                    img.style.objectFit = "cover";

                    container.appendChild(img);
                } else {
                    // Untuk PDF / DOC / DOCX → tampilkan ikon
                    const icon = document.createElement('div');
                    icon.innerHTML = `
                <div style="
                    width:100%; 
                    height:140px; 
                    display:flex;
                    justify-content:center; 
                    align-items:center;
                    background:#f1f1f1;
                    border-radius:6px;
                    font-size:40px;">
                    📄
                </div>
            `;
                    container.appendChild(icon);
                }

                const label = document.createElement('p');
                label.className = "small mt-1";
                label.textContent = file.name.length > 12 ? file.name.substring(0, 12) + "..." : file.name;

                container.appendChild(label);
                preview.appendChild(container);
            });
        });



        // sertifikat
        document.getElementById('sertifikatInput').addEventListener('change', function(e) {
            const preview = document.getElementById('previewSertifikat');
            preview.innerHTML = ""; // reset preview

            const files = Array.from(e.target.files);

            files.forEach((file, index) => {
                const ext = file.name.split('.').pop().toLowerCase();
                const fileURL = URL.createObjectURL(file);

                // wrapper
                const wrapper = document.createElement('div');
                wrapper.style.width = "110px";
                wrapper.style.textAlign = "center";

                // Tipe Gambar
                if (['jpg', 'jpeg', 'png'].includes(ext)) {
                    const img = document.createElement('img');
                    img.src = fileURL;
                    img.style.width = "100px";
                    img.style.height = "100px";
                    img.style.objectFit = "cover";
                    img.style.borderRadius = "8px";
                    img.style.border = "1px solid #ccc";
                    wrapper.appendChild(img);

                    // Tipe PDF
                } else if (ext === "pdf") {
                    const pdfDiv = document.createElement('div');
                    pdfDiv.innerHTML = `
                <i class="bi bi-file-earmark-pdf text-danger" style="font-size:48px;"></i>
                <div class="small mt-1">${file.name.substring(0, 12)}...</div>
            `;
                    wrapper.appendChild(pdfDiv);
                }

                // Nama file
                const fileName = document.createElement('div');
                fileName.classList.add('small', 'mt-1');
                fileName.innerText = file.name.length > 15 ? file.name.substring(0, 12) + "..." : file.name;
                wrapper.appendChild(fileName);

                preview.appendChild(wrapper);
            });
        });


        $(document).ready(function() {

            // =============== ADD ROW PENDIDIKAN ===============
            $('#addPendidikan').click(function() {
                let row = `
<div class="row g-3 mb-3 pendidikan-item">
    <div class="col-md-4">
        <input type="text" name="pendidikan_nama[]" class="form-control" placeholder="Nama Sekolah/Universitas" required>
    </div>
    <div class="col-md-2">
        <input type="number" name="pendidikan_tahun_masuk[]" class="form-control" placeholder="Tahun Masuk (2020)" required>
    </div>
    <div class="col-md-2">
        <input type="number" name="pendidikan_tahun_lulus[]" class="form-control" placeholder="Tahun Lulus (2024)" required>
    </div>
    <div class="col-md-3">
        <input type="text" name="pendidikan_jurusan[]" class="form-control" placeholder="Jurusan" required>
    </div>
    <div class="col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
    </div>
</div>
`;
                $('#pendidikanContainer').append(row);
            });

            // =============== REMOVE ROW ===============
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.pendidikan-item').remove();
            });



            // ===========================
            // TAMBAH BARIS MAGANG / JISSHU
            // ===========================
            $("#addMagang").click(function() {

                let html = `
        <div class="row g-3 mb-3 magang-item">

            <!-- Nama Perusahaan -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Nama Perusahaan *</label>
                <p class="text-muted small mb-1">
                    Isi nama perusahaan tempat Anda menjalani program Magang (Jisshu).
                    <br><b>Contoh: ABC Seisakusho Co., Ltd</b>
                </p>
                <input type="text" name="magang_perusahaan[]" class="form-control"
                    placeholder="Contoh: ABC Seisakusho Co., Ltd" required>
            </div>

            <!-- Kota / Prefektur -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Kota / Prefektur *</label>
                <p class="text-muted small mb-1">
                    Masukkan lokasi magang berdasarkan kota dan prefektur.
                    <br><b>Contoh: Nagoya / Aichi</b>
                </p>
                <input type="text" name="magang_kota_prefektur[]" class="form-control"
                    placeholder="Contoh: Nagoya / Aichi" required>
            </div>

            <!-- Bidang -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Bidang *</label>
                <p class="text-muted small mb-1">
                    Tulis bidang pekerjaan selama Anda mengikuti magang.
                    <br><b>Contoh: Produksi Komponen, Pertanian, Perikanan</b>
                </p>
                <input type="text" name="magang_bidang[]" class="form-control"
                    placeholder="Contoh: Produksi Komponen" required>
            </div>

            <!-- Tahun Mulai -->
            <div class="col-md-2">
                <label class="form-label fw-bold">Tahun Mulai *</label>
                <p class="text-muted small mb-1">
                    Masukkan tahun dan bulan mulai magang.
                    <br><b>Contoh: 2020-04</b>
                </p>
                <input type="month" name="magang_tahun_mulai[]" class="form-control" required>
            </div>

            <!-- Tahun Selesai -->
            <div class="col-md-2">
                <label class="form-label fw-bold">Tahun Selesai *</label>
                <p class="text-muted small mb-1">
                    Masukkan tahun dan bulan selesai magang.
                    <br><b>Contoh: 2023-03</b>
                </p>
                <input type="month" name="magang_tahun_selesai[]" class="form-control" required>
            </div>

            <!-- Hapus -->
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>

        </div>
    `;

                $("#magangContainer").append(html);
            });


            // ===========================
            // HAPUS BARIS
            // ===========================
            $(document).on("click", ".remove-row", function() {
                $(this).closest(".magang-item").remove();
            });



            // pengalaman ex jitsu
            // SHOW / HIDE CONTAINER
            $("#btnRiwayatToggle").click(function() {
                $("#riwayatContainer").toggle();
            });

            // TAMBAH BARIS RIWAYAT
            $("#addRiwayat").click(function() {

                let html = `
<div class="riwayat-item border rounded p-3  mb-3">

    <h6 class="fw-bold text-primary mb-3">Data Riwayat</h6>

    <div class="row g-3">

        <!-- NAMA PERUSAHAAN -->
        <div class="col-md-4">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan[]" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Nama Kumiai</label>
            <input type="text" name="nama_kumiai[]" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Total Karyawan</label>
            <input type="number" name="total_karyawan[]" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Karyawan Asing</label>
            <input type="number" name="total_karyawan_asing[]" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Bidang Pekerjaan</label>
            <input type="text" name="bidang_pekerjaan[]" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Klasifikasi Pekerjaan</label>
            <input type="text" name="klasifikasi_pekerjaan[]" class="form-control">
        </div>

        <!-- MASA PELATIHAN -->
        <div class="col-md-6">
            <label class="form-label">Masa Pelatihan Mulai (Tahun - Bulan)</label>
            <div class="input-group">
                <input type="text" name="masa_pelatihan_mulai_tahun[]" class="form-control" placeholder="Tahun">
                <input type="text" name="masa_pelatihan_mulai_bulan[]" class="form-control" placeholder="Bulan">
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Masa Pelatihan Selesai (Tahun - Bulan)</label>
            <div class="input-group">
                <input type="text" name="masa_pelatihan_selesai_tahun[]" class="form-control" placeholder="Tahun">
                <input type="text" name="masa_pelatihan_selesai_bulan[]" class="form-control" placeholder="Bulan">
            </div>
        </div>

        <!-- PENANGGUNG JAWAB -->
        <div class="col-md-4">
            <label class="form-label">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab[]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Shift/Normal</label>
            <select name="shift_normal[]" class="form-control">
                <option value="">Pilih</option>
                <option>Shift</option>
                <option>Normal</option>
            </select>
        </div>

        <!-- JAM KERJA -->
        <div class="col-md-3">
            <label class="form-label">Jam Kerja Shift 1</label>
            <div class="input-group">
                <input type="text" name="jam_kerja_mulai_1[]" class="form-control" placeholder="Mulai">
                <input type="text" name="jam_kerja_selesai_1[]" class="form-control" placeholder="Selesai">
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Jam Kerja Shift 2</label>
            <div class="input-group">
                <input type="text" name="jam_kerja_mulai_2[]" class="form-control" placeholder="Mulai">
                <input type="text" name="jam_kerja_selesai_2[]" class="form-control" placeholder="Selesai">
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Jam Kerja Shift 3</label>
            <div class="input-group">
                <input type="text" name="jam_kerja_mulai_3[]" class="form-control" placeholder="Mulai">
                <input type="text" name="jam_kerja_selesai_3[]" class="form-control" placeholder="Selesai">
            </div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Hari Libur</label>
            <input type="text" name="hari_libur[]" class="form-control">
        </div>

        <!-- DETAIL PEKERJAAN -->
        <div class="col-md-12">
            <label class="form-label">Detail Pekerjaan</label>
            <textarea name="detail_pekerjaan[]" class="form-control"></textarea>
        </div>

        <div class="col-md-12">
            <label class="form-label">Jika Barang Cacat Apa yang Dilakukan?</label>
            <textarea name="barang_cacat_action[]" class="form-control"></textarea>
        </div>

        <!-- TEMPAT TINGGAL -->
        <div class="col-md-3">
            <label class="form-label">Prefektur</label>
            <input type="text" name="prefektur[]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Kota</label>
            <input type="text" name="kota[]" class="form-control">
        </div>

        <!-- STATUS VISA -->
        <div class="col-md-3">
            <label class="form-label">Status Visa</label>
            <select name="status_visa[]" class="form-control">
                <option value="">Pilih</option>
                <option>X Jisshu</option>
                <option>TG</option>
                <option>Katsudo</option>
            </select>
        </div>

        <!-- MASA TINGGAL -->
        <div class="col-md-6">
            <label class="form-label">Masa Tinggal Mulai (Tahun - Bulan)</label>
            <div class="input-group">
                <input type="text" name="masa_tinggal_mulai_tahun[]" class="form-control" placeholder="Tahun">
                <input type="text" name="masa_tinggal_mulai_bulan[]" class="form-control" placeholder="Bulan">
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Masa Tinggal Selesai (Tahun - Bulan)</label>
            <div class="input-group">
                <input type="text" name="masa_tinggal_selesai_tahun[]" class="form-control" placeholder="Tahun">
                <input type="text" name="masa_tinggal_selesai_bulan[]" class="form-control" placeholder="Bulan">
            </div>
        </div>

        <!-- GAJI -->
        <div class="col-md-4">
            <label class="form-label">Gaji Per Jam (¥)</label>
            <input type="number" name="gaji_per_jam[]" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Gaji Bersih</label>
            <input type="number" name="gaji_bersih[]" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Lembur Bulanan</label>
            <input type="text" name="lembur_bulanan[]" class="form-control">
        </div>

        <!-- ASRAMA -->
        <div class="col-md-3">
            <label class="form-label">Kamar Asrama</label>
            <input type="text" name="asrama_kamar[]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Jumlah Orang Per Kamar</label>
            <input type="text" name="asrama_jumlah_orang[]" class="form-control">
        </div>

        <!-- TRANSPORTASI -->
        <div class="col-md-3">
            <label class="form-label">Transportasi</label>
            <input type="text" name="transportasi[]" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Jarak Tempuh (menit)</label>
            <input type="number" name="jarak_tempuh_menit[]" class="form-control">
        </div>

        <!-- HANKO -->
        <div class="col-md-3">
            <label class="form-label">Punya Hanko?</label>
            <select name="punya_hanko[]" class="form-control">
                <option value="">Pilih</option>
                <option>Ada</option>
                <option>Tidak Ada</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">Nama Hanko Sama Dengan CV?</label>
            <select name="nama_hanko_sama_cv[]" class="form-control">
                <option value="">Pilih</option>
                <option>Ya</option>
                <option>Tidak</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Nama Katakana di Hanko</label>
            <input type="text" name="nama_katakana_hanko[]" class="form-control">
        </div>
    </div>

    <button type="button" class="btn btn-danger btn-sm mt-3 removeRiwayat">
        Hapus Riwayat Ini
    </button>
</div>
        `;

                $("#riwayatList").append(html);
            });

            // HAPUS BARIS
            $(document).on("click", ".removeRiwayat", function() {
                $(this).closest(".riwayat-item").remove();
            });



            // pengalaman kerja 

            $('#addPengalaman').click(function() {
                let row = `
    <div class="row g-3 mb-3 pengalaman-item">
        <div class="col-md-3">
            <label class="form-label fw-bold">Nama Perusahaan *</label>
            <input type="text" name="pengalaman_perusahaan[]" class="form-control" placeholder="Nama Perusahaan" required>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Jabatan *</label>
            <input type="text" name="pengalaman_jabatan[]" class="form-control" placeholder="Jabatan" required>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">alamat kota *</label>
            <input type="month" name="pengalaman_kota[]" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">Tanggal Masuk *</label>
            <input type="month" name="pengalaman_tanggal_masuk[]" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">Tanggal Keluar *</label>
            <input type="month" name="pengalaman_tanggal_keluar[]" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">Gaji</label>
            <input type="text" name="pengalaman_gaji[]" class="form-control" placeholder="Contoh: 5.000.000">
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
        </div>
    </div>
    `;
                $('#pengalamanContainer').append(row);
            });

            // Remove row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.pengalaman-item').remove();
            });



            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });


            // // =============== CLIENT-SIDE VALIDATION ===============
            // // SUBMIT FORM
            // $('#cvForm').on('submit', function(e) {
            //     e.preventDefault(); // Stop reload

            //     let form = $('#cvForm')[0];
            //     let formData = new FormData(form); // support file upload

            //     $.ajax({
            //         url: $('#cvForm').attr('action'),
            //         method: 'POST',
            //         data: formData,
            //         processData: false,
            //         contentType: false,

            //         beforeSend: function() {
            //             $('#btnSubmit')
            //                 .prop('disabled', true)
            //                 .text('Mengirim...');
            //             $('.invalid-feedback').remove();
            //             $('.is-invalid').removeClass('is-invalid');
            //         },

            //         success: function(response) {
            //             if (response.status === 'success') {
            //                 Swal.fire({
            //                     icon: 'success',
            //                     title: 'Berhasil!',
            //                     text: response.message,
            //                     timer: 1800,
            //                     showConfirmButton: false
            //                 });

            //                 setTimeout(function() {
            //                     // Redirect ke dashboard setelah Swal selesai
            //                     window.location.href = '/';
            //                 }, 1500);
            //             }
            //         },

            //         error: function(xhr) {
            //             $('#btnSubmit')
            //                 .prop('disabled', false)
            //                 .text('Simpan');

            //             if (xhr.status === 422) {
            //                 let errors = xhr.responseJSON.errors;

            //                 $.each(errors, function(field, messages) {
            //                     let input = $('[name="' + field + '"]');

            //                     input.addClass('is-invalid');

            //                     input.after(
            //                         '<div class="invalid-feedback d-block">' +
            //                         messages[0] + '</div>'
            //                     );
            //                 });

            //                 Swal.fire({
            //                     icon: 'error',
            //                     title: 'Validasi Gagal',
            //                     text: 'Silakan periksa kembali isian Anda.',
            //                 });

            //             } else {
            //                 Swal.fire({
            //                     icon: 'error',
            //                     title: 'Terjadi Kesalahan',
            //                     text: 'Gagal mengirim data ke server.',
            //                 });
            //             }
            //         }
            //     });

            // });

            // // =============== HELPER FUNCTION ===============
            // function validateEmail(email) {
            //     let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            //     return re.test(email);
            // }

            // // =============== AUTO DISMISS ALERT ===============
            // setTimeout(function() {
            //     $('.alert').fadeOut('slow');
            // }, 5000);

            // // =============== KONFIRMASI SEBELUM MENINGGALKAN HALAMAN ===============
            // let formChanged = false;

            // $('#cvForm input, #cvForm select, #cvForm textarea').on('change input', function() {
            //     formChanged = true;
            // });

            // $(window).on('beforeunload', function() {
            //     if (formChanged) {
            //         return 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
            //     }
            // });

            // $('#cvForm').on('submit', function() {
            //     formChanged = false;
            // });




        });
    </script>

@endsection
