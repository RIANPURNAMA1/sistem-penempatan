@extends('layouts.app')

@section('title', 'History Kandidat')

{{-- Menghapus link CSS DataTables karena sudah menggunakan Card Grid --}}
@push('styles')
    {{-- Pastikan Anda memiliki Bootstrap Icons (bi) yang dimuat di layouts.app --}}
@endpush

@section('content')
@include('components.Headers')

    <div class="container-fluid mt-4">

        {{-- BAGIAN BREADCRUMB --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0 ">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('kandidat.data') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-people me-1"></i> Daftar Kandidat
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-clock-history me-1"></i> History Kandidat
                </li>
            </ol>
        </nav>

        {{-- BAGIAN PROFIL KANDIDAT --}}
        <div class="card shadow border-0 rounded-4 mb-5 p-4 ">
            <div class="d-flex align-items-center gap-4">
                @if ($kandidat->pendaftaran->foto ?? false)
                    <img src="{{ asset($kandidat->pendaftaran->foto) }}" alt="Foto Kandidat"
                        class="rounded-circle border border-5 border-primary shadow-lg" width="100" height="100" style="object-fit: cover;">
                @else
                    <div class="rounded-circle border border-5 border-primary shadow-lg d-flex justify-content-center align-items-center bg-light"
                        style="width:100px; height:100px;">
                        <i class="bi bi-person-fill fs-1 text-primary"></i>
                    </div>
                @endif
                <div>
                    <h1 class="mb-1 fw-bold text-primary">{{ $kandidat->pendaftaran->nama ?? 'Kandidat Tidak Ditemukan' }}</h1>
                    <p class="text-muted mb-0"><i class="bi bi-envelope me-1"></i> {{ $kandidat->pendaftaran->email ?? '-' }}</p>
                    <p class="text-muted mb-0"><i class="bi bi-person-badge me-1"></i> ID Kandidat: {{ $kandidat->id ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- ARRAY STATUS COLORS (Digunakan untuk badge warna) --}}
        @php
            $statusColors = [
                'Job Matching' => 'bg-secondary text-white',
                'Pending' => 'bg-warning text-dark',
                'Interview' => 'bg-info text-dark',
                'Gagal Interview' => 'bg-danger text-white',
                'Jadwalkan Interview Ulang' => 'bg-dark text-white',
                'Lulus interview' => 'bg-primary text-white',
                'Pemberkasan' => 'bg-info text-dark',
                'Berangkat' => 'bg-success text-white',
                'Diterima' => 'bg-success text-white',
                'Ditolak' => 'bg-danger text-white',
            ];
        @endphp

        {{-- ------------------------------------------------ --}}
        {{-- BAGIAN 1: SEMUA RIWAYAT (TIMELINE CARD GRID) --}}
        {{-- ------------------------------------------------ --}}
        <div class="mb-5">
            <h4 class="fw-bold mb-4 "><i class="bi bi-list-columns-reverse me-2 text-primary"></i> Semua Riwayat Perubahan Status (Total: {{ $histories->count() }})</h4>
            
            <div class="row g-4">
                @forelse ($histories as $index => $history)
                    {{-- Gunakan col-xl-4 atau col-lg-6 agar layout tetap responsif --}}
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card shadow-lg border-0 rounded-4 h-100 p-4  hover-shadow-primary"
                            style="border-left: 5px solid {{ $index === 0 ? '#0d6efd' : '#e9ecef' }}; transition: all 0.3s ease;">

                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="card-title fw-bold text-dark mb-0">
                                    #{{ $index + 1 }} - Status Perubahan
                                </h6>
                                <span class="badge {{ $statusColors[$history->status_kandidat] ?? 'bg-secondary text-white' }} px-3 py-2 rounded-pill text-capitalize shadow-sm">
                                    {{ $history->status_kandidat }}
                                </span>
                            </div>

                            <div class="card-body p-0">
                                <div class="mb-2">
                                    <i class="bi bi-building-fill me-2 text-muted"></i>
                                    <span class="fw-semibold text-primary d-block">{{ $history->institusi->nama_perusahaan ?? 'N/A' }}</span>
                                    <small class="text-muted">Nama Perusahaan</small>
                                </div>
                                
                                <div class="mb-3">
                                    <i class="bi bi-briefcase-fill me-2 text-muted"></i>
                                    <span class="d-block text-dark">{{ $history->institusi->bidang_pekerjaan ?? '-' }}</span>
                                    <small class="text-muted">Bidang Pekerjaan</small>
                                </div>

                                <hr class="my-3">

                                <small class="text-muted d-flex align-items-center">
                                    <i class="bi bi-calendar-check me-2"></i>
                                    Diperbarui pada: <span class="fw-semibold ms-1">{{ $history->created_at->format('d M Y H:i') }}</span>
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center shadow-sm" role="alert">
                            <i class="bi bi-info-circle me-1"></i> Belum ada riwayat perubahan status untuk kandidat ini.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>


        {{-- ------------------------------------------------ --}}
        {{-- BAGIAN 2: SUMMARY PERUSAHAAN (SUMMARY CARD) --}}
        {{-- ------------------------------------------------ --}}
        <div class="mb-5">
            <h4 class="fw-bold mb-4 "><i class="bi bi-pie-chart-fill me-2 text-secondary"></i> Summary Interview per Perusahaan</h4>
            
            <div class="row g-4">
                @forelse ($interviewPerPerusahaan as $data)
                    <div class="col-xl-6 col-lg-6">
                        <div class="card shadow-lg border-0 rounded-4 h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="icon-circle bg-secondary-subtle text-secondary me-3 p-3 rounded-circle">
                                        <i class="bi bi-building-gear fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0">{{ $data['institusi']->nama_perusahaan ?? 'N/A' }}</h5>
                                        <small class="text-muted">{{ $data['institusi']->bidang_pekerjaan ?? '-' }}</small>
                                    </div>
                                </div>

                                <div class="row text-center mt-4">
                                    <div class="col-4 border-end">
                                        <p class="text-muted mb-0 fw-semibold">Interview</p>
                                        <h4 class="fw-bold text-primary mt-1">{{ $data['jumlah_interview'] }}x</h4>
                                    </div>
                                    <div class="col-4 border-end">
                                        <p class="text-muted mb-0 fw-semibold">Status Terakhir</p>
                                        <span class="badge {{ $statusColors[$data['status_terakhir']] ?? 'bg-secondary text-white' }} px-3 py-2 mt-1 shadow-sm">
                                            {{ $data['status_terakhir'] }}
                                        </span>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted mb-0 fw-semibold">Tanggal Update</p>
                                        <small class="d-block text-dark mt-1">{{ $data['tanggal_terakhir']->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center shadow-sm" role="alert">
                            <i class="bi bi-info-circle me-1"></i> Belum ada riwayat interview yang diringkas.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- TOMBOL KEMBALI --}}
        <div class="mt-5 mb-5">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4 shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection

{{-- Menghapus semua script DataTables --}}
@push('scripts')
    {{-- Tambahkan script SweetAlert atau custom script lainnya jika diperlukan --}}
@endpush