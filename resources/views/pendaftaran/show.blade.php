@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- Pastikan blok ini ditempatkan di atas form, atau di lokasi yang strategis di halaman Anda --}}

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0 bg-white">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Detail Kandidat {{ $kandidat->nama }}
                </li>
            </ol>
        </nav>

        <div class="row">

            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm rounded-4 h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-4">
                            <img src="{{ asset($kandidat->foto) }}" alt="Foto Kandidat"
                                class="rounded-circle border border-4 border-primary" width="150" height="150"
                                style="object-fit: cover;">
                            <h4 class="mt-3 mb-1">{{ $kandidat->nama }}</h4>
                            <p class="text-muted small">{{ $kandidat->nik }}</p>
                        </div>

                        <div class="mb-4">
                            <span
                                class="badge {{ $kandidat->verifikasi == 'Terverifikasi' ? 'bg-success' : ($kandidat->verifikasi == 'Pending' ? 'bg-warning text-dark' : 'bg-danger') }} p-2">
                                Verifikasi: {{ $kandidat->verifikasi }}
                            </span>
                            <p class="text-muted mt-2 mb-0">Cabang: **{{ $kandidat->cabang->nama_cabang ?? '-' }}**</p>
                        </div>

                        <div class="text-start">
                            <h6><i class="bi bi-journal-text me-1"></i> Catatan Admin:</h6>
                            <p class="border-top pt-2 ps-2 small text-muted  p-2 rounded">
                                {{ $kandidat->catatan_admin ?? 'Tidak ada catatan.' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-header ">
                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i> Identitas Dasar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Nama Lengkap</dt>
                                    <dd class="col-sm-7 fw-semibold">{{ $kandidat->nama }}</dd>
                                    <dt class="col-sm-5">NIK</dt>
                                    <dd class="col-sm-7">{{ $kandidat->nik }}</dd>
                                    <dt class="col-sm-5">TTL</dt>
                                    <dd class="col-sm-7">{{ $kandidat->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($kandidat->tempat_tanggal_lahir)->translatedFormat('d F Y') }}
                                    </dd>
                                    <dt class="col-sm-5">Usia</dt>
                                    <dd class="col-sm-7">{{ $kandidat->usia }} tahun</dd>
                                    <dt class="col-sm-5">Jenis Kelamin</dt>
                                    <dd class="col-sm-7">{{ $kandidat->jenis_kelamin }}</dd>

                                    <dt class="col-sm-5">Pendidikan Terakhir</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendidikan_terakhir }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row mb-0">

                                    <dt class="col-sm-5">Agama</dt>
                                    <dd class="col-sm-7">{{ $kandidat->agama }}</dd>

                                    <dt class="col-sm-5">Status Pernikahan</dt>
                                    <dd class="col-sm-7">{{ $kandidat->status }}</dd>

                                    <dt class="col-sm-5">Email</dt>
                                    <dd class="col-sm-7">{{ $kandidat->email }}</dd>

                                    <dt class="col-sm-5">No WA</dt>
                                    <dd class="col-sm-7">{{ $kandidat->no_wa }}</dd>

                                    <dt class="col-sm-5">Tanggal Daftar</dt>
                                    <dd class="col-sm-7">
                                        {{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}
                                    </dd>

                                    <dt class="col-sm-5">Bidang SSW</dt>
                                    <dd class="col-sm-7">{{ $kandidat->bidang_ssw }}</dd>

                                </dl>
                            </div>

                            <div class="col-12 mt-3 pt-3 border-top">
                                <dl class="row mb-0">
                                    <dt class="col-sm-3">Alamat Lengkap</dt>
                                    <dd class="col-sm-9 text-wrap">{{ $kandidat->alamat }}, Kel.
                                        {{ $kandidat->kelurahan }}, Kec. {{ $kandidat->kecamatan }},
                                        {{ $kandidat->kab_kota }}, Prov. {{ $kandidat->provinsi }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-header ">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Informasi Tambahan</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">

                            <dt class="col-sm-4">ID Prometric</dt>
                            <dd class="col-sm-8">{{ $kandidat->id_prometric ?? '-' }}</dd>

                            <dt class="col-sm-4">Password Prometric</dt>
                            <dd class="col-sm-8">{{ $kandidat->password_prometric ?? '-' }}</dd>

                            <dt class="col-sm-4">Pernah ke Jepang</dt>
                            <dd class="col-sm-8">
                                <span
                                    class="badge {{ $kandidat->pernah_ke_jepang === 'Ya' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $kandidat->pernah_ke_jepang }}
                                </span>
                            </dd>

                            <dt class="col-sm-4">Paspor</dt>
                            <dd class="col-sm-8">
                                @if ($kandidat->paspor)
                                    <a href="{{ asset($kandidat->paspor) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-file-earmark-text me-1"></i> Lihat Paspor
                                    </a>
                                @else
                                    <span class="text-muted">Belum ada</span>
                                @endif
                            </dd>

                            {{-- ================= JFT ================= --}}
                            <dt class="col-sm-4">Sertifikat JFT</dt>
                            <dd class="col-sm-8">
                                @if ($kandidat->sertifikat_jft)
                                    <a href="{{ asset($kandidat->sertifikat_jft) }}" target="_blank"
                                        class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-patch-check me-1"></i> Lihat Sertifikat
                                    </a>
                                    <span class="badge bg-success ms-2">Sudah ujian</span>
                                @else
                                    <span class="badge bg-secondary">Belum ujian</span>
                                    <small class="text-muted d-block">
                                        Sertifikat JFT bersifat opsional dan boleh dikosongkan
                                    </small>
                                @endif
                            </dd>

                            {{-- ================= SSW ================= --}}
                            <dt class="col-sm-4">Sertifikat SSW</dt>
                            <dd class="col-sm-8">
                                @if ($kandidat->sertifikat_ssw)
                                    @php
                                        // Decode JSON jika multiple files
                                        $sertifikatFiles = is_string($kandidat->sertifikat_ssw)
                                            ? json_decode($kandidat->sertifikat_ssw, true)
                                            : $kandidat->sertifikat_ssw;

                                        // Jika bukan array, jadikan array
                                        if (!is_array($sertifikatFiles)) {
                                            $sertifikatFiles = [$sertifikatFiles];
                                        }
                                    @endphp

                                    @foreach ($sertifikatFiles as $index => $file)
                                        <a href="{{ asset($file) }}" target="_blank"
                                            class="btn btn-sm btn-outline-success mb-1">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>
                                            Sertifikat {{ count($sertifikatFiles) > 1 ? $index + 1 : '' }}
                                        </a>
                                    @endforeach

                                    <span class="badge bg-success ms-2">Sudah ujian</span>
                                @else
                                    <span class="badge bg-secondary">Belum ujian</span>
                                @endif
                            </dd>

                            {{-- ================= BIDANG SSW ================= --}}
                            <dt class="col-sm-4">Bidang SSW</dt>
                            <dd class="col-sm-8">
                                @if ($kandidat->bidang_ssws && $kandidat->bidang_ssws->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($kandidat->bidang_ssws as $bidang)
                                            <span class="badge bg-primary">
                                                <i class="bi bi-briefcase me-1"></i>
                                                {{ $bidang->nama_bidang }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted fst-italic">Belum memilih bidang</span>
                                @endif
                            </dd>


                        </dl>
                    </div>

                </div>

                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-folder-fill me-2"></i> Dokumen Upload</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                // Mengelompokkan dokumen ke dalam array untuk loop
                                $dokumen = [
                                    'Foto' => $kandidat->foto,
                                    'Sertifikat JFT' => $kandidat->sertifikat_jft,
                                    'Kartu Keluarga (KK)' => $kandidat->kk,
                                    'KTP' => $kandidat->ktp,
                                    'Bukti Pelunasan' => $kandidat->bukti_pelunasan,
                                    'Akte Kelahiran' => $kandidat->akte,
                                    'Ijazah' => $kandidat->ijasah,
                                ];
                            @endphp

                            @foreach ($dokumen as $nama => $path)
                                <div class="col-lg-4 col-md-6 mb-2">
                                    <div class="d-grid">
                                        @if ($path)
                                            <a href="{{ asset($path) }}" target="_blank"
                                                class="btn btn-sm btn-outline-success text-start">
                                                <i class="bi bi-file-earmark-check me-2"></i> {{ $nama }}
                                            </a>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary disabled text-start">
                                                <i class="bi bi-file-earmark-excel me-2"></i> {{ $nama }} (Belum
                                                Ada)
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="/kandidat" class="btn btn-secondary px-4"><i class="bi bi-arrow-left me-2"></i> Kembali ke
                        Daftar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
