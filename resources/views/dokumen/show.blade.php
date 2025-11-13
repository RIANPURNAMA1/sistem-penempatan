@extends('layouts.app')

@section('title', 'Detail Dokumen Pendaftaran')

@section('content')
    <div class="">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Data Diri Kandidat
                </li>
            </ol>
        </nav>
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <!-- Header -->
            <div class="card-header bg-gradient bg-warning text-white text-center py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-file-earmark-text me-2"></i> Detail Dokumen Pendaftaran
                </h5>
            </div>

            <!-- Body -->
            <div class="card-body p-4">
                @if ($kandidat)
                    <div class="row align-items-center mb-4">
                        <!-- Foto Kandidat -->
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <img src="{{ $kandidat->foto ? asset('storage/' . $kandidat->foto) : 'https://via.placeholder.com/150' }}"
                                alt="Foto Kandidat" class="rounded-circle border border-3 border-warning shadow-sm"
                                width="150" height="150">
                        </div>

                        <!-- Info Utama -->
                        <div class="col-md-9">
                            <h4 class="fw-bold mb-1">{{ $kandidat->nama }}</h4>
                            <p class="text-muted mb-2"><i
                                    class="bi bi-envelope me-2 text-primary"></i>{{ $kandidat->email ?? '-' }}</p>

                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-1"><i class="bi bi-telephone me-2 text-success"></i>No WA:
                                        {{ $kandidat->no_wa ?? '-' }}</p>
                                    <p class="mb-1"><i class="bi bi-gender-ambiguous me-2 text-warning"></i>Jenis Kelamin:
                                        {{ $kandidat->jenis_kelamin ?? '-' }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-1"><i class="bi bi-building me-2 text-info"></i>Cabang:
                                        {{ $kandidat->cabang->nama_cabang ?? '-' }}</p>
                                    <p class="mb-1"><i class="bi bi-calendar3 me-2 text-secondary"></i>
                                        Terdaftar:
                                        {{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Dokumen Terlampir -->
                    <h5 class="fw-bold mb-3"><i class="bi bi-folder2-open me-2 text-warning"></i>Dokumen Terlampir</h5>

                    <div class="row g-3">
                        <!-- KTP -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-card-heading fs-1 text-primary mb-2"></i>
                                    <h6 class="fw-semibold mb-2">KTP</h6>
                                    @if ($kandidat->ktp)
                                        <a href="{{ asset('storage/' . $kandidat->ktp) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm w-100">
                                            <i class="bi bi-eye me-1"></i> Lihat KTP
                                        </a>
                                    @else
                                        <p class="text-muted small mb-0">Tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Ijazah -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-mortarboard fs-1 text-success mb-2"></i>
                                    <h6 class="fw-semibold mb-2">Ijazah</h6>
                                    @if ($kandidat->izasah)
                                        <a href="{{ asset('storage/' . $kandidat->izasah) }}" target="_blank"
                                            class="btn btn-outline-success btn-sm w-100">
                                            <i class="bi bi-eye me-1"></i> Lihat Ijazah
                                        </a>
                                    @else
                                        <p class="text-muted small mb-0">Tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Bukti Pelunasan -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-receipt fs-1 text-warning mb-2"></i>
                                    <h6 class="fw-semibold mb-2">Bukti Pelunasan</h6>
                                    @if ($kandidat->bukti_pelunasan)
                                        <a href="{{ asset('storage/' . $kandidat->bukti_pelunasan) }}" target="_blank"
                                            class="btn btn-outline-warning btn-sm w-100">
                                            <i class="bi bi-eye me-1"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <p class="text-muted small mb-0">Tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Akte -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-body text-center p-3">
                                    <i class="bi bi-file-earmark-text fs-1 text-danger mb-2"></i>
                                    <h6 class="fw-semibold mb-2">Akte Kelahiran</h6>
                                    @if ($kandidat->akte)
                                        <a href="{{ asset('storage/' . $kandidat->akte) }}" target="_blank"
                                            class="btn btn-outline-danger btn-sm w-100">
                                            <i class="bi bi-eye me-1"></i> Lihat Akte
                                        </a>
                                    @else
                                        <p class="text-muted small mb-0">Tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-center mb-0">
                        Data pendaftaran tidak ditemukan.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
