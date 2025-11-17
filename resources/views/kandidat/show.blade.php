@extends('layouts.app')
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
        <!-- Foto Kandidat -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <i class="bi bi-person-circle me-2"></i> Foto Kandidat
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $kandidat->pendaftaran->foto) }}" 
                         class="img-fluid rounded mb-3" 
                         alt="Foto Kandidat">
                    <p class="text-muted">{{ $kandidat->pendaftaran->nama ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Pribadi -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-info-circle me-2"></i> Informasi Pribadi
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">NIK:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->nik ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Nama:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->nama ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Email:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->email ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">No WA:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->no_wa ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Jenis Kelamin:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->jenis_kelamin ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Tanggal Daftar:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->tanggal_daftar ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Cabang:</div>
                        <div class="col-md-8">{{ $kandidat->cabang->nama_cabang ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Institusi:</div>
                        <div class="col-md-8">{{ $kandidat->institusi->nama_perusahaan ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Status Kandidat:</div>
                        <div class="col-md-8">{{ $kandidat->status_kandidat ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Jumlah Interview:</div>
                        <div class="col-md-8">{{ $kandidat->jumlah_interview ?? 0 }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Catatan Admin:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->catatan_admin ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 fw-semibold">Verifikasi:</div>
                        <div class="col-md-8">{{ $kandidat->pendaftaran->verifikasi ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen Upload -->
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <i class="bi bi-folder2-open me-2"></i> Dokumen Upload
                </div>
                <div class="card-body d-flex flex-wrap gap-3 ">
                    @foreach (['kk', 'ktp', 'bukti_pelunasan', 'akte', 'ijasah'] as $dok)
                        @if ($kandidat->pendaftaran->$dok)
                            <a href="{{ asset('storage/' . $kandidat->pendaftaran->$dok) }}" target="_blank"
                               class="btn btn-outline-primary btn-sm">
                               {{ strtoupper($dok) }}
                            </a>
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
