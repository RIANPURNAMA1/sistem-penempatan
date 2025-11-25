@extends('layouts.app')

@section('title', 'Detail Dokumen Pendaftaran')

@section('content')
<div class="">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">
                <i class="bi bi-person-lines-fill"></i> Data Diri Kandidat
            </li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <!-- Header -->
        <div class="card-header bg-gradient text-white text-center py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-file-earmark-text me-2"></i> Detail Dokumen Pendaftaran
            </h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">
            @if ($kandidat)
                <div class="row align-items-start mb-4">
                    <!-- Foto Kandidat -->
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <img src="{{ $kandidat->foto ? asset($kandidat->foto) : 'https://via.placeholder.com/150' }}"
                             alt="Foto Kandidat"
                             class="rounded-circle border border-3 border-warning shadow-sm"
                             width="150" height="150"
                             style="object-fit: cover;">
                    </div>

                    <!-- Info Kandidat (dua kolom) -->
                    <div class="col-md-9">
                        <h4 class="fw-bold mb-3">{{ $kandidat->nama }}</h4>
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <p class="mb-1"><i class="bi bi-envelope-fill me-2 text-primary"></i>Email:
                                    {{ $kandidat->email ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-whatsapp me-2 text-success"></i>No WA:
                                    {{ $kandidat->no_wa ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-gender-ambiguous me-2 text-warning"></i>Jenis Kelamin:
                                    {{ $kandidat->jenis_kelamin ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-building me-2 text-info"></i>Cabang:
                                    {{ $kandidat->cabang->nama_cabang ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-calendar-check me-2 text-secondary"></i>Terdaftar:
                                    {{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}
                                </p>
                                <p class="mb-1"><i class="bi bi-person-badge-fill me-2 text-primary"></i>Status Kandidat:
                                    {{ ucfirst($kandidat->status ?? '-') }}</p>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <p class="mb-1"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Alamat Lengkap:
                                    {{ $kandidat->alamat ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-map me-2 text-success"></i>Provinsi:
                                    {{ $kandidat->provinsi ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-map me-2 text-success"></i>Kab/Kota:
                                    {{ $kandidat->kab_kota ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-map me-2 text-success"></i>Kecamatan:
                                    {{ $kandidat->kecamatan ?? '-' }}</p>
                                <p class="mb-1"><i class="bi bi-map me-2 text-success"></i>Kelurahan:
                                    {{ $kandidat->kelurahan ?? '-' }}</p>

                                <p class="mb-1"><i class="bi bi-check-circle-fill me-2 text-warning"></i>Status Verifikasi:
                                    {{ ucfirst($kandidat->verifikasi ?? 'menunggu') }}</p>

                                @if ($kandidat->catatan_admin)
                                    <p class="mb-1"><i class="bi bi-chat-left-text-fill me-2 text-secondary"></i>Catatan Admin:
                                        {{ $kandidat->catatan_admin }}</p>
                                @endif

                                <!-- ============ Tambahan Field Baru ============ -->
                                <hr>

                                <p class="mb-1"><i class="bi bi-key me-2 text-primary"></i>ID Prometric:
                                    {{ $kandidat->id_prometric ?? '-' }}</p>

                                <p class="mb-1"><i class="bi bi-lock-fill me-2 text-danger"></i>Password Prometric:
                                    {{ $kandidat->password_prometric ?? '-' }}</p>

                                <p class="mb-1"><i class="bi bi-airplane-fill me-2 text-success"></i>Pernah ke Jepang:
                                    {{ $kandidat->pernah_ke_jepang ?? '-' }}</p>

                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Dokumen Terlampir -->
                <h5 class="fw-bold mb-3"><i class="bi bi-folder-fill me-2 text-warning"></i>Dokumen Terlampir</h5>
                <div class="row g-3">
                    @php
                        $dokumenList = [
                            ['label' => 'Foto', 'file' => $kandidat->foto, 'color' => 'primary', 'icon' => 'bi-person'],
                            ['label' => 'KTP', 'file' => $kandidat->ktp, 'color' => 'primary', 'icon' => 'bi-card-heading'],
                            ['label' => 'KK', 'file' => $kandidat->kk, 'color' => 'secondary', 'icon' => 'bi-people'],
                            ['label' => 'Ijazah', 'file' => $kandidat->ijasah, 'color' => 'success', 'icon' => 'bi-mortarboard'],
                            ['label' => 'Bukti Pelunasan', 'file' => $kandidat->bukti_pelunasan, 'color' => 'warning', 'icon' => 'bi-receipt'],
                            ['label' => 'Akte Kelahiran', 'file' => $kandidat->akte, 'color' => 'danger', 'icon' => 'bi-file-earmark-text'],
                            ['label' => 'Sertifikat JFT', 'file' => $kandidat->sertifikat_jft, 'color' => 'info', 'icon' => 'bi-award'],
                            ['label' => 'Sertifikat SSW', 'file' => $kandidat->sertifikat_ssw, 'color' => 'info', 'icon' => 'bi-award'],
                            ['label' => 'Paspor', 'file' => $kandidat->paspor, 'color' => 'dark', 'icon' => 'bi-passport'],
                        ];
                    @endphp

                    @foreach ($dokumenList as $dokumen)
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center p-3">
                                    <i class="{{ $dokumen['icon'] }} fs-1 text-{{ $dokumen['color'] }} mb-3"></i>
                                    <h6 class="fw-semibold mb-2">{{ $dokumen['label'] }}</h6>
                                    @if ($dokumen['file'])
                                        <a href="{{ asset($dokumen['file']) }}" target="_blank"
                                           class="btn btn-outline-{{ $dokumen['color'] }} btn-sm w-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-file-earmark-text me-1"></i> Lihat {{ $dokumen['label'] }}
                                        </a>
                                    @else
                                        <p class="text-muted small mb-0">Tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </div>
</div>
@endsection
