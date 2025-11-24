@extends('layouts.app')

@section('title', 'Detail CV')

@section('content')
    <div class="">
                <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                    <li class="breadcrumb-item">
                        <a href="/" class="text-decoration-none text-secondary">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                        <i class="bi bi-people me-1"></i> Detail Cv Kandidat
                    </li>
                </ol>
            </nav>

        <div class="card shadow-sm border-0 rounded-4 p-4">

            {{-- Pas Foto --}}
            <div class="text-center mb-4">
                <img src="{{ asset($cv->pas_foto) }}" alt="Pas Foto" class="rounded-circle border" width="150" height="150">
            </div>

            {{-- Accordion --}}
            <div class="accordion" id="cvAccordion">

                {{-- HALAMAN 1 - Data Awal --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            Data Awal
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body row">
                            <div class="col-md-6"><strong>Email:</strong> {{ $cv->email }}</div>
                            <div class="col-md-6"><strong>Cabang:</strong> {{ $cv->cabang->nama_cabang }}</div>
                            <div class="col-md-6"><strong>Batch:</strong> {{ $cv->batch }}</div>
                            <div class="col-md-6"><strong>No Telepon:</strong> {{ $cv->no_telepon }}</div>
                            <div class="col-md-6"><strong>No Orang Tua:</strong> {{ $cv->no_orang_tua }}</div>
                            <div class="col-md-6"><strong>Bidang Sertifikasi:</strong> {{ $cv->bidang_sertifikasi }}
                                {{ $cv->bidang_sertifikasi_lainnya ? '(' . $cv->bidang_sertifikasi_lainnya . ')' : '' }}
                            </div>
                            <div class="col-md-6"><strong>Program Pertanian Kawakami:</strong>
                                {{ $cv->program_pertanian_kawakami }}</div>
                            <div class="col-md-6"><strong>Sertifikat Files:</strong>

                                

                            </div>
                        </div>
                    </div>
                </div>

                {{-- HALAMAN 2 - Data Diri --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            Data Diri
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body row">
                            <div class="col-md-6"><strong>Nama Lengkap:</strong>
                                {{ $cv->nama_lengkap_romaji ?? $cv->nama_lengkap_katakana }}</div>
                            <div class="col-md-6"><strong>Nama Panggilan:</strong>
                                {{ $cv->nama_panggilan_romaji ?? $cv->nama_panggilan_katakana }}</div>
                            <div class="col-md-6"><strong>Jenis Kelamin:</strong> {{ $cv->jenis_kelamin }}</div>
                            <div class="col-md-6"><strong>Agama:</strong> {{ $cv->agama }}
                                {{ $cv->agama_lainnya ? '(' . $cv->agama_lainnya . ')' : '' }}</div>
                            <div class="col-md-6"><strong>TTL:</strong> {{ $cv->tempat_tanggal_lahir }}</div>
                            <div class="col-md-6"><strong>Usia:</strong> {{ $cv->usia }}</div>
                            <div class="col-12"><strong>Alamat:</strong> {{ $cv->alamat_lengkap }}</div>
                            <div class="col-md-6"><strong>Email Aktif:</strong> {{ $cv->email_aktif }}</div>
                            <div class="col-md-6"><strong>Status Perkawinan:</strong> {{ $cv->status_perkawinan }}
                                {{ $cv->status_perkawinan_lainnya ? '(' . $cv->status_perkawinan_lainnya . ')' : '' }}
                            </div>
                            <div class="col-md-6"><strong>Golongan Darah:</strong> {{ $cv->golongan_darah }}</div>
                            <div class="col-md-6"><strong>SIM:</strong> {{ $cv->surat_izin_mengemudi }}
                                {{ $cv->jenis_sim ? '(' . $cv->jenis_sim . ')' : '' }}</div>
                            <div class="col-md-6"><strong>Merokok:</strong> {{ $cv->merokok }}</div>
                            <div class="col-md-6"><strong>Minum Alkohol:</strong> {{ $cv->minum_alkohol }}</div>
                            <div class="col-md-6"><strong>Bertato:</strong> {{ $cv->bertato }}</div>
                            <div class="col-md-6"><strong>Tinggi / Berat / Pinggang / Sepatu:</strong>
                                {{ $cv->tinggi_badan }} cm / {{ $cv->berat_badan }} kg / {{ $cv->ukuran_pinggang }} /
                                {{ $cv->ukuran_sepatu }}</div>
                            <div class="col-md-6"><strong>Ukuran Baju / Celana:</strong> {{ $cv->ukuran_atasan_baju }}
                                {{ $cv->ukuran_atasan_baju_lainnya ? '(' . $cv->ukuran_atasan_baju_lainnya . ')' : '' }} /
                                {{ $cv->ukuran_celana }}</div>
                            <div class="col-md-6"><strong>Tangan Dominan:</strong> {{ $cv->tangan_dominan }}</div>
                            <div class="col-md-6"><strong>Kemampuan Mata:</strong> {{ $cv->kemampuan_penglihatan_mata }}
                                {{ $cv->kemampuan_penglihatan_mata_lainnya ? '(' . $cv->kemampuan_penglihatan_mata_lainnya . ')' : '' }}
                            </div>
                            <div class="col-md-6"><strong>Vaksinasi:</strong> {{ $cv->sudah_vaksin_berapa_kali }}
                                {{ $cv->sudah_vaksin_berapa_kali_lainnya ? '(' . $cv->sudah_vaksin_berapa_kali_lainnya . ')' : '' }}
                            </div>
                            <div class="col-12"><strong>Kesehatan Badan:</strong> {{ $cv->kesehatan_badan }}</div>
                            <div class="col-12"><strong>Penyakit / Cedera:</strong> {{ $cv->penyakit_cedera_masa_lalu }}
                            </div>
                            <div class="col-md-6"><strong>Hobi:</strong> {{ $cv->hobi }}</div>
                            <div class="col-md-6"><strong>Rencana Biaya:</strong>
                                {{ $cv->rencana_sumber_biaya_keberangkatan }} / {{ $cv->perkiraan_biaya }}</div>
                        </div>
                    </div>
                </div>

                {{-- HALAMAN 3 - Pembelajaran di Mendunia --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            Pembelajaran di Mendunia
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body row">
                            <div class="col-md-6"><strong>Lama Belajar:</strong> {{ $cv->lama_belajar_di_mendunia }}</div>
                            <div class="col-md-6"><strong>Bahasa Jepang:</strong> {{ $cv->kemampuan_bahasa_jepang }}</div>
                            <div class="col-md-6"><strong>Pemahaman SSW:</strong> {{ $cv->kemampuan_pemahaman_ssw }}</div>
                            <div class="col-md-6"><strong>Kelincahan Kerja:</strong> {{ $cv->kelincahan_dalam_bekerja }}
                            </div>
                            <div class="col-md-6"><strong>Kekuatan Tindakan:</strong> {{ $cv->kekuatan_tindakan }}</div>
                            <div class="col-md-6"><strong>Bahasa Inggris:</strong> {{ $cv->kemampuan_berbahasa_inggris }}
                                {{ $cv->kemampuan_berbahasa_inggris_lainnya ? '(' . $cv->kemampuan_berbahasa_inggris_lainnya . ')' : '' }}
                            </div>
                            <div class="col-md-6"><strong>Kebugaran Jasmani:</strong> {{ $cv->kebugaran_jasmani_seminggu }}
                                {{ $cv->kebugaran_jasmani_seminggu_lainnya ? '(' . $cv->kebugaran_jasmani_seminggu_lainnya . ')' : '' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HALAMAN 5 - Daya Tarik Perusahaan --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            Daya Tarik Perusahaan
                        </button>
                    </h2>
                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body row">
                            <div class="col-md-6"><strong>Ada Keluarga di Jepang:</strong>
                                {{ $cv->ada_keluarga_di_jepang }}</div>
                            <div class="col-md-6"><strong>Hubungan Keluarga:</strong>
                                {{ $cv->hubungan_keluarga_di_jepang }}</div>
                            <div class="col-md-6"><strong>Status Kerabat:</strong> {{ $cv->status_kerabat_di_jepang }}
                                {{ $cv->status_kerabat_di_jepang_lainnya ? '(' . $cv->status_kerabat_di_jepang_lainnya . ')' : '' }}
                            </div>
                            <div class="col-md-6"><strong>Ingin Bekerja (tahun):</strong>
                                {{ $cv->ingin_bekerja_berapa_tahun }}
                                {{ $cv->ingin_bekerja_berapa_tahun_lainnya ? '(' . $cv->ingin_bekerja_berapa_tahun_lainnya . ')' : '' }}
                            </div>
                            <div class="col-md-6"><strong>Ingin Pulang:</strong> {{ $cv->ingin_pulang_berapa_kali }}</div>
                            <div class="col-12"><strong>Kelebihan Diri:</strong> {{ $cv->kelebihan_diri }}</div>
                            <div class="col-12"><strong>Komentar Guru Kelebihan:</strong>
                                {{ $cv->komentar_guru_kelebihan_diri }}</div>
                            <div class="col-12"><strong>Kekurangan Diri:</strong> {{ $cv->kekurangan_diri }}</div>
                            <div class="col-12"><strong>Komentar Guru Kekurangan:</strong>
                                {{ $cv->komentar_guru_kekurangan_diri }}</div>
                            <div class="col-12"><strong>Ketertarikan Jepang:</strong>
                                {{ $cv->ketertarikan_terhadap_jepang }}</div>
                            <div class="col-12"><strong>Orang Dihormati:</strong> {{ $cv->orang_yang_dihormati }}</div>
                            <div class="col-12"><strong>Point Plus Diri:</strong> {{ $cv->point_plus_diri }}</div>
                            <div class="col-12"><strong>Keahlian Khusus:</strong> {{ $cv->keahlian_khusus }}</div>
                        </div>
                    </div>
                </div>

                {{-- HALAMAN 6 - Anggota Keluarga --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            Data Anggota Keluarga
                        </button>
                    </h2>
                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body row">
                            <div class="col-md-6"><strong>Istri:</strong> {{ $cv->anggota_keluarga_istri ?? '-' }}</div>
                            <div class="col-md-6"><strong>Suami:</strong> {{ $cv->anggota_keluarga_suami ?? '-' }}</div>
                            <div class="col-md-6"><strong>Anak:</strong> {{ $cv->anggota_keluarga_anak ?? '-' }}</div>
                            <div class="col-md-6"><strong>Ibu:</strong> {{ $cv->anggota_keluarga_ibu }}</div>
                            <div class="col-md-6"><strong>Ayah:</strong> {{ $cv->anggota_keluarga_ayah }}</div>
                            <div class="col-md-6"><strong>Kakak:</strong> {{ $cv->anggota_keluarga_kakak ?? '-' }}</div>
                            <div class="col-md-6"><strong>Adik:</strong> {{ $cv->anggota_keluarga_adik ?? '-' }}</div>
                            <div class="col-12"><strong>Rata-rata Penghasilan Keluarga:</strong>
                                {{ $cv->rata_rata_penghasilan_keluarga }}</div>
                        </div>
                    </div>
                </div>

                {{-- Pendidikan --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingPendidikan">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePendidikan" aria-expanded="false"
                            aria-controls="collapsePendidikan">
                            Pendidikan
                        </button>
                    </h2>
                    <div id="collapsePendidikan" class="accordion-collapse collapse" aria-labelledby="headingPendidikan"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body">
                            @forelse($cv->pendidikans ?? [] as $p)
                                <div class="mb-2 p-2 border rounded">
                                    <strong>{{ $p->nama }}</strong> ({{ $p->tahun }}) -
                                    <em>{{ $p->jurusan }}</em>
                                </div>
                            @empty
                                <p class="text-muted">Belum ada data pendidikan</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Pengalaman Kerja --}}
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="headingPengalaman">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsePengalaman" aria-expanded="false"
                            aria-controls="collapsePengalaman">
                            Pengalaman Kerja
                        </button>
                    </h2>
                    <div id="collapsePengalaman" class="accordion-collapse collapse" aria-labelledby="headingPengalaman"
                        data-bs-parent="#cvAccordion">
                        <div class="accordion-body">
                            @forelse($cv->pengalamans ?? [] as $p)
                                <div class="mb-2 p-2 border rounded d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $p->perusahaan }}</strong> - {{ $p->jabatan }} <br>
                                        <small class="text-muted">{{ $p->periode }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Belum ada pengalaman kerja</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
