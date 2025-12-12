@extends('layouts.app')

@section('title', 'Detail CV')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0 ">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill me-1"></i> Detail Cv Kandidat
                </li>
            </ol>
        </nav>
        <!-- Header Profil -->
        <div class="card shadow-lg border-0 rounded-4 p-4 mb-5 position-relative">

            <!-- Tombol Edit -->
            <a href="/edit/cv/kandidat/{{ $cv->id }}" class=" position-absolute top-0 end-0 m-3 ">
                <i class="bi bi-pencil-square p-2" style="width: 400px"></i>
            </a>

            <div class="d-flex flex-column flex-md-row align-items-center">

                {{-- Pas Foto --}}
                <div class="me-md-4 mb-3 mb-md-0">
                    <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto"
                        class="rounded-circle border border-5 border-white shadow-sm" width="150" height="150"
                        style="object-fit: cover">
                </div>

                {{-- Nama dan Data Utama --}}
                <div>
                    <h1 class="h3 fw-bold mb-1">
                        {{ $cv->nama_lengkap_romaji ?? $cv->nama_lengkap_katakana }}
                    </h1>
                    <p class="lead mb-1">{{ $cv->bidang_sertifikasi }}</p>
                    <p class="mb-0">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        Cabang: {{ $cv->cabang->nama_cabang ?? 'N/A' }} |

                        <i class="bi bi-phone-fill me-1"></i>
                        Telp: {{ $cv->no_telepon }}
                    </p>
                </div>

            </div>
        </div>


        <!-- Grid Cards untuk Detail CV -->
        <div class="row g-4">
            <!-- CARD 1: Data Awal & Kontak -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header  rounded-top-4">
                        <i class="bi bi-info-circle-fill me-2"></i> Data Awal
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Email:</strong> {{ $cv->email }}</li>
                            <li class="list-group-item"><strong>Batch:</strong> {{ $cv->batch }}</li>
                            <li class="list-group-item"><strong>No. Orang Tua:</strong> {{ $cv->no_orang_tua }}</li>
                            <li class="list-group-item"><strong>Bidang Sertifikasi:</strong>
                                {{ $cv->bidang_sertifikasi }}
                                @if ($cv->bidang_sertifikasi_lainnya)
                                    ({{ $cv->bidang_sertifikasi_lainnya }})
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Program Kawakami:</strong>
                                {{ $cv->program_pertanian_kawakami }}</li>
                        </ul>
                        <!-- Link Sertifikat Files bisa ditambahkan di sini -->
                    </div>
                </div>
            </div>

            <!-- CARD 2: Data Diri (Fisik & Status) -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header rounded-top-4">
                        <i class="bi bi-person-fill me-2"></i> Data Diri
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nama Panggilan:</strong>
                                {{ $cv->nama_panggilan_romaji ?? $cv->nama_panggilan_katakana }}</li>
                            <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $cv->jenis_kelamin }}</li>
                            <li class="list-group-item"><strong>TTL / Usia:</strong> {{ $cv->tanggal_lahir }} /
                                {{ $cv->tempat_lahir }}
                                {{ $cv->usia }}</li>
                            <li class="list-group-item"><strong>Status Kawin:</strong> {{ $cv->status_perkawinan }}
                                @if ($cv->status_perkawinan_lainnya)
                                    ({{ $cv->status_perkawinan_lainnya }})
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Alamat:</strong> {{ $cv->alamat_lengkap }}</li>
                            <li class="list-group-item"><strong>Hobi:</strong> {{ $cv->hobi }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CARD 3: Data Fisik & Kesehatan -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header  rounded-top-4">
                        <i class="bi bi-heart-pulse-fill me-2"></i> Fisik & Kesehatan
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>T/B/P/S:</strong> {{ $cv->tinggi_badan }} cm /
                                {{ $cv->berat_badan }} kg / {{ $cv->ukuran_pinggang }} /
                                {{ $cv->ukuran_sepatu }}</li>
                            <li class="list-group-item"><strong>SIM:</strong> {{ $cv->surat_izin_mengemudi }}
                                @if ($cv->jenis_sim)
                                    ({{ $cv->jenis_sim }})
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Kebiasaan:</strong> Merokok ({{ $cv->merokok }}), Alkohol
                                ({{ $cv->minum_alkohol }}), Tato ({{ $cv->bertato }})</li>
                            <li class="list-group-item"><strong>Vaksinasi:</strong> {{ $cv->sudah_vaksin_berapa_kali }}
                                @if ($cv->sudah_vaksin_berapa_kali_lainnya)
                                    ({{ $cv->sudah_vaksin_berapa_kali_lainnya }})
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Kesehatan Badan:</strong> {{ $cv->kesehatan_badan }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CARD 4: Pendidikan -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header rounded-top-4">
                        <i class="bi bi-mortarboard-fill me-2"></i> Riwayat Pendidikan
                    </div>
                    <div class="card-body">
                        @forelse($cv->pendidikans ?? [] as $p)
                            <div class="border-start border-4 border-info p-2 mb-2">
                                <h6 class="mb-0 fw-bold">{{ $p->nama }}
                                    <span class="badge bg-secondary float-end">
                                        {{ $p->tahun_masuk }} - {{ $p->tahun_lulus ?? 'Sekarang' }}
                                    </span>
                                </h6>
                                <small class="">{{ $p->jurusan ?? '-' }}</small>
                            </div>
                        @empty
                            <p class="text-muted fst-italic">Belum ada data pendidikan.</p>
                        @endforelse
                    </div>
                </div>
            </div>


            <!-- CARD 5: Pengalaman Kerja -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header rounded-top-4">
                        <i class="bi bi-briefcase-fill me-2"></i> Pengalaman Kerja
                    </div>
                    <div class="card-body">
                        @forelse($cv->pengalamans ?? [] as $p)
                            <div class="border-start border-4 border-secondary p-2 mb-2">
                                <h6 class="mb-0 fw-bold">{{ $p->perusahaan }}</h6>
                                <small class="">
                                    {{ $p->jabatan ?? '-' }} |
                                    {{ $p->tanggal_masuk ?? '-' }} - {{ $p->tanggal_keluar ?? 'Sekarang' }}
                                </small>
                            </div>
                        @empty
                            <p class="text-muted fst-italic">Belum ada pengalaman kerja.</p>
                        @endforelse
                    </div>
                </div>

            </div>


            <div class="col-lg-6">
                <div class="card shadow-sm border-0">

                    {{-- Card Header --}}
                    <div class="card-header  fw-bold">
                        Riwayat Magang (Jisshu)
                    </div>

                    <div class="card-body">

                        @forelse(($cv->magangJisshu ?? []) as $m)
                            <div class="card mb-3 border-0 shadow-md">
                                <div class="card-body border-start border-4 border-warning">

                                    {{-- Nama Perusahaan + Tahun --}}
                                    <h6 class="fw-bold mb-1">
                                        {{ $m->perusahaan ?? '-' }}

                                        <span class="badge bg-secondary float-end">
                                            {{ $m->tahun_mulai ?? '-' }} -
                                            {{ $m->tahun_selesai ?? 'Sekarang' }}
                                        </span>
                                    </h6>

                                    {{-- Kota & Prefektur --}}
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        {{ $m->kota_prefektur ?? '-' }}
                                    </p>

                                    {{-- Bidang --}}
                                    <p class="mb-0 small">
                                        <strong>Bidang:</strong>
                                        <span class="fw-semibold">{{ $m->bidang ?? '-' }}</span>
                                    </p>

                                </div>
                            </div>

                        @empty

                            <div class="card p-4 text-center border-0 shadow-sm">
                                <p class="text-muted fst-italic mb-0">
                                    Belum ada data magang (Jisshu).
                                </p>
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>


            <!-- CARD: Riwayat Pekerjaan Terakhir -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header rounded-top-4">
                        <i class="bi bi-building-fill-check me-2"></i> Riwayat Pekerjaan Terakhir
                    </div>

                    <div class="card-body">
                        @forelse ($cv->riwayatpekerjaanterakhir ?? [] as $r)
                            <div class="border-start border-4 border-primary p-2 mb-3">

                                {{-- Nama Perusahaan --}}
                                <h6 class="mb-0 fw-bold">
                                    {{ $r->nama_perusahaan }}
                                </h6>

                                {{-- Kota + Prefektur + Bidang --}}
                                <small class="text-muted d-block">
                                    {{ $r->kota ?? '-' }}, {{ $r->prefektur ?? '-' }} |
                                    Bidang: {{ $r->bidang_pekerjaan ?? '-' }}
                                </small>

                                {{-- Masa Pelatihan --}}
                                <small class="d-block">
                                    Masa Pelatihan:
                                    {{ $r->masa_pelatihan_mulai_bulan }}/{{ $r->masa_pelatihan_mulai_tahun }}
                                    -
                                    {{ $r->masa_pelatihan_selesai_bulan }}/{{ $r->masa_pelatihan_selesai_tahun }}
                                </small>

                                {{-- Karyawan --}}
                                <small class="d-block">
                                    Karyawan:
                                    {{ $r->total_karyawan ?? 0 }} (Asing: {{ $r->total_karyawan_asing ?? 0 }})
                                </small>

                                {{-- Jam Kerja --}}
                                <small class="d-block">
                                    Jam Kerja:
                                    {{ $r->jam_kerja_mulai_1 }} - {{ $r->jam_kerja_selesai_1 }}
                                    @if ($r->jam_kerja_mulai_2)
                                        | {{ $r->jam_kerja_mulai_2 }} - {{ $r->jam_kerja_selesai_2 }}
                                    @endif
                                    @if ($r->jam_kerja_mulai_3)
                                        | {{ $r->jam_kerja_mulai_3 }} - {{ $r->jam_kerja_selesai_3 }}
                                    @endif
                                </small>

                                {{-- Hari Libur --}}
                                <small class="d-block">
                                    Hari Libur: {{ $r->hari_libur ?? '-' }}
                                </small>

                                {{-- Detail Pekerjaan --}}
                                <small class="d-block">
                                    Detail: {{ $r->detail_pekerjaan ?? '-' }}
                                </small>

                            </div>
                        @empty
                            <p class="text-muted fst-italic">Belum ada riwayat pekerjaan terakhir.</p>
                        @endforelse
                    </div>
                </div>
            </div>


            <!-- CARD 6: Kemampuan & Pembelajaran -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header  rounded-top-4 ">
                        <i class="bi bi-book-fill me-2"></i> Pembelajaran di Mendunia
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <strong>Bahasa Jepang:</strong>
                                <span class="badge bg-primary">{{ $cv->kemampuan_bahasa_jepang }}</span>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Lama Belajar:</strong> {{ $cv->lama_belajar_di_mendunia }}</p>
                                <p class="mb-1"><strong>Pemahaman SSW:</strong> {{ $cv->kemampuan_pemahaman_ssw }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Kelincahan Kerja:</strong> {{ $cv->kelincahan_dalam_bekerja }}
                                </p>
                                <p class="mb-1"><strong>Kekuatan Tindakan:</strong> {{ $cv->kekuatan_tindakan }}</p>
                            </div>
                            <div class="col-12 mt-3">
                                <p class="mb-1"><strong>Bahasa Inggris:</strong> {{ $cv->kemampuan_berbahasa_inggris }}
                                    @if ($cv->kemampuan_berbahasa_inggris_lainnya)
                                        ({{ $cv->kemampuan_berbahasa_inggris_lainnya }})
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 7: Data Keluarga & Keuangan -->
            <div class="col-lg-6 col-md-6">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-header text-white rounded-top-4">
                        <i class="bi bi-people-fill me-2"></i> Keluarga & Keuangan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <strong>Orang Tua:</strong> Ayah ({{ $cv->ayah_nama ?? '-' }}, {{ $cv->ayah_usia ?? '-' }}
                                th, {{ $cv->ayah_pekerjaan ?? '-' }}) /
                                Ibu ({{ $cv->ibu_nama ?? '-' }}, {{ $cv->ibu_usia ?? '-' }} th,
                                {{ $cv->ibu_pekerjaan ?? '-' }})
                                <br>
                                <strong>Saudara:</strong>
                                Kakak ({{ $cv->kakak_nama ?? '-' }}, {{ $cv->kakak_usia ?? '-' }} th,
                                {{ $cv->kakak_pekerjaan ?? '-' }}, {{ $cv->kakak_status ?? '-' }}) /
                                Adik ({{ $cv->adik_nama ?? '-' }}, {{ $cv->adik_usia ?? '-' }} th,
                                {{ $cv->adik_pekerjaan ?? '-' }}, {{ $cv->adik_status ?? '-' }})
                            </div>

                            <div class="col-md-6">
                                <p class="mb-1"><strong>Rata-rata Penghasilan Keluarga:</strong>
                                    {{ $cv->rata_rata_penghasilan_keluarga ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Rencana Biaya:</strong>
                                    {{ $cv->rencana_sumber_biaya_keberangkatan ?? '-' }} /
                                    {{ $cv->perkiraan_biaya ?? '-' }}</p>
                            </div>
                        </div>

                        <hr>
                        <p class="mb-1"><strong>Keluarga di Jepang:</strong> {{ $cv->ada_keluarga_di_jepang ?? '-' }}
                        </p>
                        @if ($cv->ada_keluarga_di_jepang === 'Ya')
                            <small class="text-muted">Hubungan: {{ $cv->hubungan_keluarga_di_jepang ?? '-' }}, Status:
                                {{ $cv->status_kerabat_di_jepang ?? '-' }}</small>
                        @endif
                    </div>
                </div>
            </div>


            <!-- CARD 8: Daya Tarik (Komentar Diri/Guru) -->
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header  rounded-top-4">
                        <i class="bi bi-stars me-2"></i> Ringkasan Daya Tarik & Motivasi
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <h6><i class="bi bi-hand-thumbs-up-fill me-1 text-success"></i> Kelebihan Diri:</h6>
                                <p class="fst-italic border-start border-3 border-success ps-3">
                                    {{ $cv->kelebihan_diri }}</p>
                                <p class="mb-0"><small class="text-muted">Komentar Guru Kelebihan:
                                        {{ $cv->komentar_guru_kelebihan_diri }}</small></p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-hand-thumbs-down-fill me-1 text-danger"></i> Kekurangan Diri:</h6>
                                <p class="fst-italic border-start border-3 border-danger ps-3">
                                    {{ $cv->kekurangan_diri }}</p>
                                <p class="mb-0"><small class="text-muted">Komentar Guru Kekurangan:
                                        {{ $cv->komentar_guru_kekurangan_diri }}</small></p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-lightbulb-fill me-1 text-warning"></i> Keahlian Khusus:</h6>
                                <p class="mb-0">{{ $cv->keahlian_khusus }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-trophy-fill me-1 text-primary"></i> Point Plus Diri:</h6>
                                <p class="mb-0">{{ $cv->point_plus_diri }}</p>
                            </div>
                            <div class="col-12">
                                <h6><i class="bi bi-japan me-1 text-info"></i> Ketertarikan Jepang:</h6>
                                <p class="mb-0">{{ $cv->ketertarikan_terhadap_jepang }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- sertifikat --}}
                <div class="col-12 mt-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header ">
                            <h5 class="mb-0">📂 Fotolainnya</h5>
                        </div>
                        <div class="card-body">
                            <th>Fotolainnya</th>
                            <td>
                                @php
                                    $pasFotos = json_decode($cv->pas_foto, true) ?? [];
                                @endphp

                                @if (count($pasFotos) === 0)
                                    <span class="text-muted">Tidak ada file</span>
                                @else
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($pasFotos as $foto)
                                            @php
                                                $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                                                $url = asset($foto);
                                            @endphp

                                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                <a href="{{ $url }}" target="_blank">
                                                    <img src="{{ $url }}"
                                                        style="width:90px; height:90px; object-fit:cover; border-radius:8px; border:1px solid #ccc;">
                                                </a>
                                            @elseif ($ext === 'pdf')
                                                <a href="{{ $url }}" target="_blank"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="bi bi-file-earmark-pdf"></i> PDF
                                                </a>
                                            @else
                                                <a href="{{ $url }}" target="_blank"
                                                    class="btn btn-secondary btn-sm">
                                                    <i class="bi bi-file-earmark-text"></i> Dokumen
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </div>
                    </div>
                </div>
                {{-- sertifikat --}}
                <div class="col-12 mt-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header ">
                            <h5 class="mb-0">📂 Dokumen Sertifikasi dan File Pendukung</h5>
                        </div>
                        <div class="card-body">
                            {{-- SERTIFIKAT --}}
                            <tr>
                                <th>Sertifikat</th>
                                <td>
                                    @php
                                        $sertifikats = json_decode($cv->sertifikat_files, true) ?? [];
                                    @endphp

                                    @if (count($sertifikats) === 0)
                                        <span class="text-muted">Tidak ada file</span>
                                    @else
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($sertifikats as $file)
                                                @php
                                                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                    $url = asset($file);
                                                @endphp

                                                @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                    <a href="{{ $url }}" target="_blank">
                                                        <img src="{{ $url }}"
                                                            style="width:90px; height:90px; object-fit:cover; border-radius:8px; border:1px solid #ccc;">
                                                    </a>
                                                @elseif ($ext === 'pdf')
                                                    <a href="{{ $url }}" target="_blank"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="bi bi-file-earmark-pdf"></i> PDF Sertifikat
                                                    </a>
                                                @else
                                                    <a href="{{ $url }}" target="_blank"
                                                        class="btn btn-secondary btn-sm">
                                                        <i class="bi bi-file-earmark-text"></i> Lihat Dokumen
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </div>
                    </div>
                </div>
                <a href="/data/cv/kandidat" class="btn btn-primary">Kembali</a>
            </div>

        </div>
    </div>
@endsection
