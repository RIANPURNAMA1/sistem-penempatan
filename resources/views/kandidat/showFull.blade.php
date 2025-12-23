@extends('layouts.app')

@section('title', 'Detail Kandidat')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <div class="">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md">
            <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Detail Kandidat
                </li>
            </ol>
        </nav>

        <h2 class="mb-5 text-primary">Detail Kandidat: {{ $kandidat->pendaftaran->nama ?? '-' }}</h2>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-body d-flex flex-column flex-md-row align-items-center p-4">

                <div class="me-md-4 mb-3 mb-md-0 text-center">
                    @php
                        $foto = $kandidat->pendaftaran->foto ?? null;
                    @endphp
                    @if ($foto)
                        <img src="{{ asset($foto) }}" alt="Foto Kandidat"
                            class="rounded-circle border border-primary border-3" width="150" height="150"
                            style="object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($kandidat->pendaftaran->nama ?? 'User') }}&background=0D8ABC&color=fff&size=150"
                            class="rounded-circle border border-primary border-3" width="150" height="150"
                            style="object-fit: cover;">
                    @endif
                </div>

                <div class="text-center text-md-start">
                    <h3 class="mt-2 mt-md-0 text-dark">{{ $kandidat->pendaftaran->nama ?? 'Nama Kandidat' }}</h3>
                    <h5 class="text-muted">{{ $kandidat->pendaftaran->nik ?? 'NIK Tidak Tersedia' }}</h5>
                    <p class="mb-1">
                        <span class="badge bg-primary fs-6">{{ $kandidat->status_kandidat }}</span>
                        <span class="badge bg-info text-dark fs-6">{{ $kandidat->status_kandidat_di_mendunia }}</span>
                    </p>
                    <p class="text-sm-start text-secondary">
                        <small>Daftar Sejak:
                            {{ $kandidat->pendaftaran->created_at ? \Carbon\Carbon::parse($kandidat->pendaftaran->created_at)->format('d F Y') : '-' }}</small>
                    </p>
                </div>

                <div class="ms-md-auto mt-3 mt-md-0 d-grid gap-2 d-md-block">
                    <a href="{{ route('kandidat.history', $kandidat->id) }}" class="btn btn-secondary"
                        title="Riwayat Perubahan Data">
                        <i class="fas fa-history"></i>
                    </a>
                    <a href="{{ route('kandidat.edit', $kandidat->id) }}" class="btn btn-warning" title="Edit Data Lengkap">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('kandidat.export', $kandidat->id) }}" class="btn btn-success"
                        title="Export ke Excel">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header ">
                        <h5 class="mb-0">👤 Data Pribadi & Alamat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 border-end">
                                <h6 class="text-primary mb-3">Detail Pribadi</h6>
                                <dl class="row mb-0 small">
                                    <dt class="col-sm-5 text-sm-end">NIK:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->nik ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Email:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->email ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">No WA:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->no_wa ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Jenis Kelamin:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->jenis_kelamin ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Tgl Daftar:</dt>
                                    <dd class="col-sm-7">
                                        {{ $kandidat->pendaftaran->created_at ? \Carbon\Carbon::parse($kandidat->pendaftaran->created_at)->format('d F Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-5 text-sm-end">Agama:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->agama ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Status Nikah:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->status ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Pendidikan Akhir:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->pendidikan_terakhir ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Tempat Lahir:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->tempat_lahir ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Tanggal Lahir:</dt>
                                    <dd class="col-sm-7">
                                        {{ $kandidat->pendaftaran->tempat_tanggal_lahir ? \Carbon\Carbon::parse($kandidat->pendaftaran->tempat_tanggal_lahir)->format('d F Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-5 text-sm-end">Usia:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->usia ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Pernah ke Jepang:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->pernah_ke_jepang ?? '-' }}</dd>
                                </dl>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Detail Lokasi & Prometric</h6>
                                <dl class="row mb-0 small">
                                    <dt class="col-sm-5 text-sm-end">Provinsi:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->provinsi ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Kab/Kota:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->kab_kota ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Kecamatan:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->kecamatan ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Kelurahan:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->kelurahan ?? '-' }}</dd>

                                    <dt class="col-sm-12 mt-2">Alamat Lengkap:</dt>
                                    <dd class="col-sm-12">{{ $kandidat->pendaftaran->alamat ?? '-' }}</dd>

                                    <h6 class="text-secondary mt-3 mb-2">Informasi Akun</h6>

                                    <dt class="col-sm-5 text-sm-end">ID Prometric:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->id_prometric ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Password Prometric:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->password_prometric ?? '-' }}</dd>

                                    <dt class="col-sm-5 text-sm-end">Paspor:</dt>
                                    <dd class="col-sm-7">{{ $kandidat->pendaftaran->paspor ?? '-' }}</dd>

                                </dl>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="row">
                            <div class="col-md-6 border-end">
                                <h6 class="text-primary mb-3">Status Verifikasi Pendaftaran</h6>
                                <dl class="row mb-0 small">
                                    <dt class="col-sm-5 text-sm-end">Verifikasi Admin:</dt>
                                    <dd class="col-sm-7">
                                        @php
                                            $status = $kandidat->pendaftaran->verifikasi ?? 'menunggu';
                                            $class = match ($status) {
                                                'diterima' => 'success',
                                                'ditolak' => 'danger',
                                                'data belum lengkap' => 'warning',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $class }}">{{ ucfirst($status) }}</span>
                                    </dd>
                                    <dt class="col-sm-5 text-sm-end mt-2">Catatan Admin:</dt>
                                    <dd class="col-sm-7 mt-2">{{ $kandidat->pendaftaran->catatan_admin ?? '-' }}</dd>
                                </dl>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Status Dokumen Upload</h6>

                                <div class="row small">
                                    @php
                                        $dokumen = [
                                            'Foto' => 'foto',
                                            'Sertifikat JFT' => 'sertifikat_jft',
                                            'Sertifikat SSW' => 'sertifikat_ssw', // ARRAY / STRING / JSON
                                            'Kartu Keluarga (KK)' => 'kk',
                                            'KTP' => 'ktp',
                                            'Akte Kelahiran' => 'akte',
                                            'Ijasah' => 'ijasah',
                                            'Bukti Pelunasan' => 'bukti_pelunasan',
                                        ];
                                    @endphp

                                    @foreach ($dokumen as $label => $field)
                                        <div class="col-md-6">
                                            <dl class="row mb-1">
                                                <dt class="col-sm-7">{{ $label }}:</dt>

                                                <dd class="col-sm-5 text-end">

                                                    {{-- ================= SERTIFIKAT SSW ================= --}}
                                                    @if ($field === 'sertifikat_ssw')
                                                        @php
                                                            $raw = $kandidat->pendaftaran->sertifikat_ssw ?? null;

                                                            // NORMALISASI DATA → PASTI ARRAY
                                                            if (is_string($raw)) {
                                                                $decoded = json_decode($raw, true);
                                                                $files = is_array($decoded) ? $decoded : [$raw];
                                                            } elseif (is_array($raw)) {
                                                                $files = $raw;
                                                            } else {
                                                                $files = [];
                                                            }
                                                        @endphp

                                                        @if (!empty($files))
                                                            @foreach ($files as $index => $file)
                                                                @if (!empty($file))
                                                                    <a href="{{ asset($file) }}" target="_blank"
                                                                        class="text-success me-1"
                                                                        title="Lihat Sertifikat {{ $index + 1 }}">
                                                                        <i class="fas fa-check-circle"></i>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <i class="fas fa-times-circle text-danger"></i>
                                                        @endif

                                                        {{-- ================= DOKUMEN SINGLE FILE ================= --}}
                                                    @else
                                                        @if (!empty($kandidat->pendaftaran->$field))
                                                            <a href="{{ asset($kandidat->pendaftaran->$field) }}"
                                                                target="_blank" class="text-success"
                                                                title="Lihat Dokumen">
                                                                <i class="fas fa-check-circle"></i>
                                                            </a>
                                                        @else
                                                            <i class="fas fa-times-circle text-danger"></i>
                                                        @endif
                                                    @endif

                                                </dd>
                                            </dl>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header ">
                        <h5 class="mb-0">💼 Data Penempatan & Pekerjaan</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-5 text-sm-end">Perusahaan Penempatan:</dt>
                            <dd class="col-sm-7">{{ $kandidat->institusi->perusahaan_penempatan ?? '-' }}</dd>

                            <dt class="col-sm-5 text-sm-end">Nama Perusahaan Jepang:</dt>
                            <dd class="col-sm-7">{{ $kandidat->nama_perusahaan ?? '-' }}</dd>

                            <dt class="col-sm-5 text-sm-end">Detail Pekerjaan:</dt>
                            <dd class="col-sm-7">{{ $kandidat->detail_pekerjaan ?? '-' }}</dd>

                            <dt class="col-sm-5 text-sm-end">Bidang Pekerjaan SSW:</dt>
                            <dd class="col-sm-7">
                                @if ($kandidat->bidang_ssws && $kandidat->bidang_ssws->count())
                                    {{ $kandidat->bidang_ssws->pluck('nama_bidang')->join(', ') }}
                                @else
                                    -
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header ">
                        <h5 class="mb-0">🗣️ Proses Interview</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-end">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Tgl Setsumeikai / Ichiji:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->tgl_setsumeikai_ichijimensetsu ? \Carbon\Carbon::parse($kandidat->tgl_setsumeikai_ichijimensetsu)->format('d F Y') : '-' }}
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Tgl Mensetsu 1:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->tgl_mensetsu ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu)->format('d F Y') : '-' }}
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-6 mt-3 border-end">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Tgl Mensetsu 2:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->tgl_mensetsu2 ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu2)->format('d F Y') : '-' }}
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-6 mt-3">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Jadwal Interview Berikutnya:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('d F Y') : '-' }}
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-12 mt-3">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Catatan Interview:</dt>
                                    <dd class="col-sm-12">{{ $kandidat->catatan_interview ?? '-' }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header ">
                        <h5 class="mb-0">💰 Administrasi & Tracking Dokumen</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary mb-2">Biaya Administrasi</h6>
                        <div class="row small mb-3">
                            <div class="col-md-4">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Pemberkasan:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->biaya_pemberkasan ? $kandidat->biaya_pemberkasan : '-' }}

                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-4">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">ADM Tahap 1:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->adm_tahap1 ? $kandidat->adm_tahap1 : '-' }}
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-md-4">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">ADM Tahap 2:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->adm_tahap2 ? $kandidat->adm_tahap2 : '-' }}
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <hr class="mt-0 mb-3">

                        <h6 class="text-primary mb-2">Tracking Dokumen & Visa</h6>
                        <div class="row small">
                            <div class="col-md-6 border-end">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Kontrak Kerja Terbit:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->terbit_kontrak_kerja ? \Carbon\Carbon::parse($kandidat->terbit_kontrak_kerja)->format('d F Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-12 mt-2">Masuk Imigrasi Jepang:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->masuk_imigrasi_jepang ? \Carbon\Carbon::parse($kandidat->masuk_imigrasi_jepang)->format('d F Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-12 mt-2">COE Terbit:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->coe_terbit ? \Carbon\Carbon::parse($kandidat->coe_terbit)->format('d F Y') : '-' }}
                                    </dd>
                                </dl>
                            </div>

                            <div class="col-md-6">
                                <dl class="row mb-0">
                                    <dt class="col-sm-12">Pembuatan E-KTKLN:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->pembuatan_ektkln ? \Carbon\Carbon::parse($kandidat->pembuatan_ektkln)->format('d F Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-12 mt-2">Visa Terbit:</dt>
                                    <dd class="col-sm-12">
                                        {{ $kandidat->visa ? \Carbon\Carbon::parse($kandidat->visa)->format('d F Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-12 mt-2">Jadwal Penerbangan:</dt>
                                    <dd class="col-sm-12">
                                        <strong>{{ $kandidat->jadwal_penerbangan ? \Carbon\Carbon::parse($kandidat->jadwal_penerbangan)->format('d F Y') : '-' }}</strong>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <a href="/kandidat/data" class="btn btn-secondary mt-3">⬅️ Kembali ke Daftar Kandidat</a>

    </div>
@endsection
