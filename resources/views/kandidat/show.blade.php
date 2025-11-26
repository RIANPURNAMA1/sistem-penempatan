@extends('layouts.app')
@section('title', 'Detail Kandidat')
@section('content')
<div class="">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-people me-1"></i> Kandidat
                </a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold">
                <i class="bi bi-person-circle me-1"></i> {{ $kandidat->pendaftaran->nama ?? '-' }}
            </li>
        </ol>
    </nav>
    <h3 class="mb-4 fw-bold">Detail Kandidat</h3>

    <div class="row g-4">
        <!-- Kolom Kiri: Foto, Status, Kontak -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header  text-center">
                    <i class="bi bi-person-badge me-2"></i> Profil & Kontak
                </div>
                <div class="card-body text-center">
                   <img src="{{ asset($kandidat->pendaftaran->foto) }}" alt="Foto Kandidat" class="img-fluid rounded-md mb-3" style="width: 150px; height:auto; object-fit: cover; border-radius:10%">
                    <h5 class="fw-bold mb-1">{{ $kandidat->pendaftaran->nama ?? '-' }}</h5>
                    <p class="text-muted mb-3">{{ $kandidat->pendaftaran->email ?? '-' }}</p>

                    <hr>

                    <div class="mb-2 text-start">
                        <span class="fw-semibold">Status Kandidat:</span>
                        <span class="float-end badge bg-info">{{ $kandidat->status_kandidat ?? '-' }}</span>
                    </div>
                    <div class="mb-2 text-start">
                        <span class="fw-semibold">Verifikasi Admin:</span>
                        @php
                            $verif = $kandidat->pendaftaran->verifikasi ?? 'menunggu';
                            $badgeVerif = match($verif) {
                                'diterima' => 'success',
                                'ditolak' => 'danger',
                                'data belum lengkap' => 'warning',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="float-end badge bg-{{ $badgeVerif }}">{{ ucfirst($verif) }}</span>
                    </div>

                    <div class="mt-4">
                        @php
                            $no_wa_bersih = preg_replace('/^0/', '62', $kandidat->pendaftaran->no_wa ?? '');
                        @endphp
                        <a href="https://wa.me/{{ $no_wa_bersih }}" target="_blank" class="btn btn-success w-100 fw-bold">
                            <i class="bi bi-whatsapp me-1"></i> Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header ">
                    <i class="bi bi-chat-dots me-2"></i> Catatan Admin
                </div>
                <div class="card-body">
                    <p class="card-text fst-italic">{{ $kandidat->pendaftaran->catatan_admin ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Detail Data -->
        <div class="col-lg-8">
            <!-- Informasi Pendaftaran & Data Dasar -->
            <div class="card shadow-sm mb-4">
                <div class="card-header ">
                    <i class="bi bi-info-circle me-2"></i> Data Pendaftaran & Cabang
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Tanggal Daftar:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->tanggal_daftar ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Cabang Pendaftar:</div>
                        <div class="col-md-8">{{ $kandidat->cabang->nama_cabang ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Institusi Tujuan:</div>
                        <div class="col-md-8">{{ $kandidat->institusi->nama_perusahaan ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Jumlah Interview:</div>
                        <div class="col-md-8">{{ $kandidat->jumlah_interview ?? 0 }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Identitas Lengkap -->
            <div class="card shadow-sm mb-4">
                <div class="card-header ">
                    <i class="bi bi-person-vcard me-2"></i> Identitas Lengkap
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">NIK:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->nik ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Jenis Kelamin:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->jenis_kelamin ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Tempat/Tanggal Lahir:</div>
                        <div class="col-md-8">{{ ($kandidat->pendaftaran->tempat_lahir ?? '-') . ', ' . ($kandidat->pendaftaran->tempat_tanggal_lahir ?? '-') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Usia:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->usia ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Agama:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->agama ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Status Pernikahan:</div>
                        <div class="col-md-8">{{ ucfirst($kandidat->pendaftaran->status ?? '-') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Pernah ke Jepang:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->pernah_ke_jepang ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">ID Prometric:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->id_prometric ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Password Prometric:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->password_prometric ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Lokasi Tempat Tinggal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header ">
                    <i class="bi bi-geo-alt me-2"></i> Lokasi Tempat Tinggal
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Provinsi:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->provinsi ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Kabupaten/Kota:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->kab_kota ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Kecamatan:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->kecamatan ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Kelurahan:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->kelurahan ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Alamat Lengkap:</div>
                        <div class="col-md-8 text-break">{{ $kandidat->pendaftaran->alamat ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen Upload -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header ">
                    <i class="bi bi-folder2-open me-2"></i> Dokumen Wajib
                </div>
                <div class="card-body d-flex flex-wrap gap-3 ">
                    @php
                        // Daftar dokumen sesuai migrasi
                        $dokumenList = [
                            'kk' => 'Kartu Keluarga (KK)',
                            'ktp' => 'Kartu Tanda Penduduk (KTP)',
                            'akte' => 'Akta Kelahiran',
                            'ijasah' => 'Ijazah Terakhir',
                            'sertifikat_jft' => 'Sertifikat JFT',
                            'sertifikat_ssw' => 'Sertifikat SSW',
                            'paspor' => 'Paspor (Jika Ada)',
                            'bukti_pelunasan' => 'Bukti Pelunasan',
                        ];
                    @endphp

                    @foreach ($dokumenList as $key => $label)
                        @if ($kandidat->pendaftaran->$key)
                            <a href="{{ asset($kandidat->pendaftaran->$key)}}" target="_blank"
                               class="btn btn-outline-dark btn-sm fw-bold">
                                <i class="bi bi-file-earmark-arrow-up me-1"></i> {{ $label }}
                            </a>
                        @else
                            <button type="button" class="btn btn-outline-secondary btn-sm disabled">
                                <i class="bi bi-x-circle me-1"></i> {{ $label }} (Belum Ada)
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-12 mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection