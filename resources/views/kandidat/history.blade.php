@extends('layouts.app')

@section('title', 'History Kandidat')

@section('content')
    <div class="">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
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
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-clock-history me-1"></i> History Kandidat
                </li>
            </ol>
        </nav>

        <!-- Profil Kandidat -->
        <div class="d-flex align-items-center mb-4 gap-3">
            @if ($kandidat->pendaftaran->foto ?? false)
                <img src="{{ asset('storage/' . $kandidat->pendaftaran->foto) }}" alt="Foto Kandidat"
                    class="rounded-circle border shadow-sm" width="80" height="80">
            @else
                <div class="rounded-circle border shadow-sm d-flex justify-content-center align-items-center"
                    style="width:80px; height:80px; background-color:#f0f0f0;">
                    <i class="bi bi-person-fill fs-3 text-muted"></i>
                </div>
            @endif
            <div>
                <h3 class="mb-0">{{ $kandidat->pendaftaran->nama ?? 'Kandidat' }}</h3>
                <small class="text-muted">{{ $kandidat->pendaftaran->email ?? '-' }}</small>
            </div>
        </div>

        <!-- Table History -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered p-2 w-100">

                    <!-- Header -->
                    <thead style="">
                        <tr>
                            <th class="py-3 text-center">No</th>
                            <th class="py-3">Status Kandidat</th>
                            <th class="py-3">Nama Perusahaan</th>
                            <th class="py-3">Bidang Pekerjaan</th>
                            <th class="py-3 text-center">Jumlah Interview</th>
                            <th class="py-3 text-center">Tanggal</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="text-dark">
                        @forelse ($histories as $index => $history)
                            <tr>
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>

                                <!-- Badge Status Kandidat -->
                                <td>
                                    <span
                                        class=" px-3 py-2 
                                @class([
                                    'bg-secondary' => $history->status_kandidat === 'Job Matching',
                                    'bg-primary' => $history->status_kandidat === 'Berangkat',
                                    'bg-success' => $history->status_kandidat === 'Diterima',
                                    'bg-danger' => $history->status_kandidat === 'Ditolak',
                                    'bg-warning text-dark' => $history->status_kandidat === 'Gagal Interview',
                                ])
                            ">
                                        {{ $history->status_kandidat }}
                                    </span>
                                </td>

                                <!-- Nama Perusahaan -->
                                <td class="fw-semibold">
                                    {{ $history->institusi->nama_perusahaan ?? '-' }}
                                </td>

                                <!-- Bidang -->
                                <td>{{ $history->institusi->bidang_pekerjaan ?? '-' }}</td>

                                <!-- Jumlah Interview -->
                                <td class="text-center fw-semibold">
                                    {{ $history->kandidat->jumlah_interview }}
                                </td>
                                <!-- Timestamp -->
                                <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Belum ada history untuk kandidat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Back Button -->
        <div class="mt-3">
            <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Kandidat
            </a>
        </div>

    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endsection
