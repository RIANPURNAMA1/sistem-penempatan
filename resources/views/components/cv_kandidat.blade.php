<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header fw-bold py-3 rounded-top-4">
        <i class="bi bi-file-person me-2"></i> Ringkasan Data CV Anda
    </div>

    <div class="card-body">
        @foreach ($cvs as $cv)
            <div class="table-responsive mb-3" style="max-height: 500px; overflow-y:auto;">
                <table class="table table-bordered table-striped align-middle table-sm">
                    <tbody>
                        <!-- Ringkasan awal (tampil selalu) -->
                        <tr>
                            <th width="30%">Email</th>
                            <td>{{ $cv->email }}</td>
                        </tr>
                        <tr>
                            <th>Cabang</th>
                            <td>{{ $cv->cabang->nama_cabang ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $cv->batch }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $cv->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon Orang Tua</th>
                            <td>{{ $cv->no_orang_tua }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap (Romaji)</th>
                            <td>{{ $cv->nama_lengkap_romaji }}</td>
                        </tr>
                        <tr>
                            <th>Foto CV</th>
                            <td>
                                @if ($cv->pas_foto_cv)
                                    <img src="{{ asset($cv->pas_foto_cv) }}" width="200" alt="Foto CV">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>

                        {{-- PAS FOTO --}}
                        <tr>
                            <th>Foto Lainnya</th>
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
                        </tr>

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

                        {{-- Data lengkap tersembunyi --}}
                        @php
                            $hiddenFields = [
                                [
                                    'Bidang Sertifikasi',
                                    $cv->bidang_sertifikasi .
                                    ($cv->bidang_sertifikasi_lainnya ? " ({$cv->bidang_sertifikasi_lainnya})" : ''),
                                ],
                                ['Program Pertanian Kawakami', $cv->program_pertanian_kawakami],
                                ['Nama Lengkap (Katakana)', $cv->nama_lengkap_katakana],
                                ['Nama Panggilan (Romaji)', $cv->nama_panggilan_romaji],
                                ['Nama Panggilan (Katakana)', $cv->nama_panggilan_katakana],
                                ['Jenis Kelamin', $cv->jenis_kelamin],
                                ['Agama', $cv->agama . ($cv->agama_lainnya ? " ({$cv->agama_lainnya})" : '')],
                                ['Tempat Lahir', $cv->tempat_lahir],
                                ['Tanggal Lahir', $cv->tanggal_lahir],
                                ['Usia', $cv->usia . ' tahun'],
                                ['Alamat Lengkap', $cv->alamat_lengkap],
                                ['Provinsi', $cv->provinsi ?? '-'],
                                ['Kabupaten', $cv->kabupaten ?? '-'],
                                ['Kecamatan', $cv->kecamatan ?? '-'],
                                ['Kelurahan', $cv->kelurahan ?? '-'],
                                ['Email Aktif', $cv->email_aktif],
                                [
                                    'Status Perkawinan',
                                    $cv->status_perkawinan .
                                    ($cv->status_perkawinan_lainnya ? " ({$cv->status_perkawinan_lainnya})" : ''),
                                ],
                                ['Golongan Darah', $cv->golongan_darah],
                                ['Surat Izin Mengemudi', $cv->surat_izin_mengemudi],
                                ['Jenis SIM', $cv->jenis_sim ?? '-'],
                                ['Merokok', $cv->merokok],
                                ['Minum Alkohol', $cv->minum_alkohol],
                                ['Bertato', $cv->bertato],
                                ['Tinggi Badan', $cv->tinggi_badan . ' cm'],
                                ['Berat Badan', $cv->berat_badan . ' kg'],
                                ['Ukuran Pinggang', $cv->ukuran_pinggang],
                                ['Ukuran Sepatu', $cv->ukuran_sepatu],
                                [
                                    'Ukuran Atasan',
                                    $cv->ukuran_atasan_baju .
                                    ($cv->ukuran_atasan_baju_lainnya ? " ({$cv->ukuran_atasan_baju_lainnya})" : ''),
                                ],
                                ['Ukuran Celana', $cv->ukuran_celana],
                                ['Tangan Dominan', $cv->tangan_dominan],
                                [
                                    'Kemampuan Penglihatan',
                                    $cv->kemampuan_penglihatan_mata .
                                    ($cv->kemampuan_penglihatan_mata_lainnya
                                        ? " ({$cv->kemampuan_penglihatan_mata_lainnya})"
                                        : ''),
                                ],
                                ['Kemampuan Pendengaran', $cv->kemampuan_pendengaran],
                                [
                                    'Vaksin',
                                    $cv->sudah_vaksin_berapa_kali .
                                    ($cv->sudah_vaksin_berapa_kali_lainnya
                                        ? " ({$cv->sudah_vaksin_berapa_kali_lainnya})"
                                        : ''),
                                ],
                                ['Kesehatan Badan', $cv->kesehatan_badan],
                                ['Penyakit / Cedera Masa Lalu', $cv->penyakit_cedera_masa_lalu],
                                ['Hobi', $cv->hobi],
                                ['Rencana Sumber Biaya', $cv->rencana_sumber_biaya_keberangkatan],
                                ['Perkiraan Biaya', $cv->perkiraan_biaya],
                                ['Biaya Keberangkatan Jisshu', $cv->Biaya_keberangkatan_sebelumnya_jisshu ?? '-'],
                                ['Lama Belajar di Mendunia', $cv->lama_belajar_di_mendunia],
                                ['Kemampuan Bahasa Jepang', $cv->kemampuan_bahasa_jepang ?? '-'],
                                ['Kemampuan Pemahaman SSW', $cv->kemampuan_pemahaman_ssw ?? '-'],
                                ['Kelincahan Dalam Bekerja', $cv->kelincahan_dalam_bekerja ?? '-'],
                                ['Kekuatan Tindakan', $cv->kekuatan_tindakan ?? '-'],
                                [
                                    'Kemampuan Bahasa Inggris',
                                    ($cv->kemampuan_berbahasa_inggris ?? '-') .
                                    ($cv->kemampuan_berbahasa_inggris_lainnya
                                        ? " ({$cv->kemampuan_berbahasa_inggris_lainnya})"
                                        : ''),
                                ],
                                [
                                    'Kebugaran Jasmani Seminggu',
                                    $cv->kebugaran_jasmani_seminggu .
                                    ($cv->kebugaran_jasmani_seminggu_lainnya
                                        ? " ({$cv->kebugaran_jasmani_seminggu_lainnya})"
                                        : ''),
                                ],
                                ['Bersedia Kerja Shift', $cv->bersedia_kerja_shift],
                                ['Bersedia Lembur', $cv->bersedia_lembur],
                                ['Bersedia Kerja Hari Libur', $cv->bersedia_hari_libur],
                                ['Menggunakan Kacamata', $cv->menggunakan_kacamata],
                                ['Ada Keluarga di Jepang', $cv->ada_keluarga_di_jepang],
                                ['Hubungan Keluarga di Jepang', $cv->hubungan_keluarga_di_jepang ?? '-'],
                                [
                                    'Status Kerabat di Jepang',
                                    ($cv->status_kerabat_di_jepang ?? '-') .
                                    ($cv->status_kerabat_di_jepang_lainnya
                                        ? " ({$cv->status_kerabat_di_jepang_lainnya})"
                                        : ''),
                                ],
                                [
                                    'Ingin Bekerja Berapa Tahun',
                                    $cv->ingin_bekerja_berapa_tahun .
                                    ($cv->ingin_bekerja_berapa_tahun_lainnya
                                        ? " ({$cv->ingin_bekerja_berapa_tahun_lainnya})"
                                        : ''),
                                ],
                                ['Ingin Pulang Berapa Kali', $cv->ingin_pulang_berapa_kali],
                                ['Kelebihan Diri', $cv->kelebihan_diri],
                                ['Komentar Guru (Kelebihan)', $cv->komentar_guru_kelebihan_diri],
                                ['Kekurangan Diri', $cv->kekurangan_diri],
                                ['Komentar Guru (Kekurangan)', $cv->komentar_guru_kekurangan_diri],
                                ['Ketertarikan Terhadap Jepang', $cv->ketertarikan_terhadap_jepang],
                                ['Orang Yang Dihormati', $cv->orang_yang_dihormati],
                                ['Point Plus Diri', $cv->point_plus_diri],
                                ['Keahlian Khusus', $cv->keahlian_khusus],
                                ['Rata-rata Penghasilan Keluarga', $cv->rata_rata_penghasilan_keluarga],
                            ];
                        @endphp

                        @foreach ($hiddenFields as $field)
                            <tr class="cv-more" style="display: none;">
                                <th>{{ $field[0] }}</th>
                                <td>{{ $field[1] }}</td>
                            </tr>
                        @endforeach

                        {{-- Data Keluarga: Istri --}}
                        @if ($cv->istri_nama)
                            <tr class="cv-more" style="display: none;">
                                <th>Data Istri</th>
                                <td>
                                    <strong>Nama:</strong> {{ $cv->istri_nama }}<br>
                                    <strong>Usia:</strong> {{ $cv->istri_usia ?? '-' }}<br>
                                    <strong>Pekerjaan:</strong> {{ $cv->istri_pekerjaan ?? '-' }}
                                </td>
                            </tr>
                        @endif

                        {{-- Data Keluarga: Anak --}}
                        @if ($cv->anak_nama)
                            <tr class="cv-more" style="display: none;">
                                <th>Data Anak</th>
                                <td>
                                    <strong>Nama:</strong> {{ $cv->anak_nama }}<br>
                                    <strong>Jenis Kelamin:</strong> {{ $cv->anak_jenis_kelamin ?? '-' }}<br>
                                    <strong>Usia:</strong> {{ $cv->anak_usia ?? '-' }}<br>
                                    <strong>Pendidikan:</strong> {{ $cv->anak_pendidikan ?? '-' }}
                                </td>
                            </tr>
                        @endif

                        {{-- Data Keluarga: Ibu --}}
                        <tr class="cv-more" style="display: none;">
                            <th>Data Ibu</th>
                            <td>
                                <strong>Nama:</strong> {{ $cv->ibu_nama }}<br>
                                <strong>Usia:</strong> {{ $cv->ibu_usia }}<br>
                                <strong>Pekerjaan:</strong> {{ $cv->ibu_pekerjaan }}
                            </td>
                        </tr>

                        {{-- Data Keluarga: Ayah --}}
                        <tr class="cv-more" style="display: none;">
                            <th>Data Ayah</th>
                            <td>
                                <strong>Nama:</strong> {{ $cv->ayah_nama }}<br>
                                <strong>Usia:</strong> {{ $cv->ayah_usia }}<br>
                                <strong>Pekerjaan:</strong> {{ $cv->ayah_pekerjaan }}
                            </td>
                        </tr>

                        {{-- Data Keluarga: Kakak --}}
                        @if ($cv->kakak_nama)
                            <tr class="cv-more" style="display: none;">
                                <th>Data Kakak</th>
                                <td>
                                    <strong>Nama:</strong> {{ $cv->kakak_nama }}<br>
                                    <strong>Usia:</strong> {{ $cv->kakak_usia ?? '-' }}<br>
                                    <strong>Jenis Kelamin:</strong> {{ $cv->kakak_jenis_kelamin ?? '-' }}<br>
                                    <strong>Pekerjaan:</strong> {{ $cv->kakak_pekerjaan ?? '-' }}<br>
                                    <strong>Status:</strong> {{ $cv->kakak_status ?? '-' }}
                                </td>
                            </tr>
                        @endif

                        {{-- Data Keluarga: Adik --}}
                        @if ($cv->adik_nama)
                            <tr class="cv-more" style="display: none;">
                                <th>Data Adik</th>
                                <td>
                                    <strong>Nama:</strong> {{ $cv->adik_nama }}<br>
                                    <strong>Usia:</strong> {{ $cv->adik_usia ?? '-' }}<br>
                                    <strong>Jenis Kelamin:</strong> {{ $cv->adik_jenis_kelamin ?? '-' }}<br>
                                    <strong>Pekerjaan:</strong> {{ $cv->adik_pekerjaan ?? '-' }}<br>
                                    <strong>Status:</strong> {{ $cv->adik_status ?? '-' }}
                                </td>
                            </tr>
                        @endif

                        {{-- Tambahkan di dalam card-body, setelah data keluarga dan sebelum button toggle --}}

                        {{-- Data Pendidikan --}}
                        @if ($cv->pendidikans && $cv->pendidikans->count() > 0)
                            <tr class="cv-more" style="display: none;">
                                <th>Riwayat Pendidikan</th>
                                <td>
                                    @foreach ($cv->pendidikans as $index => $pendidikan)
                                        <div class="mb-3 p-3 border rounded">
                                            <h6 class="fw-bold mb-2">Pendidikan {{ $index + 1 }}</h6>
                                            <strong>Nama Sekolah/Universitas:</strong> {{ $pendidikan->nama }}<br>

                                            @if ($pendidikan->jurusan)
                                                <strong>Jurusan:</strong> {{ $pendidikan->jurusan }}<br>
                                            @endif

                                            @if ($pendidikan->tahun_masuk)
                                                <strong>Tahun Masuk:</strong> {{ $pendidikan->tahun_masuk }}<br>
                                            @endif

                                            @if ($pendidikan->tahun_lulus)
                                                <strong>Tahun Lulus:</strong> {{ $pendidikan->tahun_lulus }}<br>
                                            @endif

                                            @if ($pendidikan->tahun_masuk && $pendidikan->tahun_lulus)
                                                <strong>Periode:</strong> {{ $pendidikan->tahun_masuk }} -
                                                {{ $pendidikan->tahun_lulus }}
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @else
                            <tr class="cv-more" style="display: none;">
                                <th>Riwayat Pendidikan</th>
                                <td><span class="text-muted">Belum ada data pendidikan</span></td>
                            </tr>
                        @endif

                        {{-- Tambahkan di dalam card-body, setelah data pendidikan --}}

                        {{-- Data Pengalaman Kerja --}}
                        @if ($cv->pengalamans && $cv->pengalamans->count() > 0)
                            <tr class="cv-more" style="display: none;">
                                <th>Riwayat Pengalaman Kerja</th>
                                <td>
                                    @foreach ($cv->pengalamans as $index => $pengalaman)
                                        <div class="mb-3 p-3 border rounded bg-light">
                                            <h6 class="fw-bold mb-2 text-primary">
                                                <i class="bi bi-briefcase-fill me-1"></i>
                                                Pengalaman {{ $index + 1 }}
                                            </h6>

                                            <strong>Perusahaan:</strong> {{ $pengalaman->perusahaan }}<br>

                                            <strong>Jabatan:</strong> {{ $pengalaman->jabatan }}<br>

                                            @if ($pengalaman->tanggal_masuk)
                                                <strong>Tanggal Masuk:</strong>
                                                {{ \Carbon\Carbon::parse($pengalaman->tanggal_masuk)->format('d M Y') }}<br>
                                            @endif

                                            @if ($pengalaman->tanggal_keluar)
                                                <strong>Tanggal Keluar:</strong>
                                                {{ \Carbon\Carbon::parse($pengalaman->tanggal_keluar)->format('d M Y') }}<br>
                                            @else
                                                <strong>Status:</strong> <span class="badge bg-success">Masih
                                                    Bekerja</span><br>
                                            @endif

                                            @if ($pengalaman->tanggal_masuk && $pengalaman->tanggal_keluar)
                                                @php
                                                    $masuk = \Carbon\Carbon::parse($pengalaman->tanggal_masuk);
                                                    $keluar = \Carbon\Carbon::parse($pengalaman->tanggal_keluar);
                                                    $durasi = $masuk->diffInMonths($keluar);
                                                    $tahun = floor($durasi / 12);
                                                    $bulan = $durasi % 12;
                                                @endphp
                                                <strong>Lama Bekerja:</strong>
                                                @if ($tahun > 0)
                                                    {{ $tahun }} tahun
                                                @endif
                                                @if ($bulan > 0)
                                                    {{ $bulan }} bulan
                                                @endif
                                                <br>
                                            @elseif($pengalaman->tanggal_masuk)
                                                @php
                                                    $masuk = \Carbon\Carbon::parse($pengalaman->tanggal_masuk);
                                                    $durasi = $masuk->diffInMonths(now());
                                                    $tahun = floor($durasi / 12);
                                                    $bulan = $durasi % 12;
                                                @endphp
                                                <strong>Lama Bekerja:</strong>
                                                @if ($tahun > 0)
                                                    {{ $tahun }} tahun
                                                @endif
                                                @if ($bulan > 0)
                                                    {{ $bulan }} bulan
                                                @endif
                                                (hingga sekarang)
                                                <br>
                                            @endif

                                            @if ($pengalaman->gaji)
                                                <strong>Gaji:</strong>
                                                <span class="text-success fw-bold">
                                                    Rp {{ $pengalaman->gaji }}
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @else
                            <tr class="cv-more" style="display: none;">
                                <th>Riwayat Pengalaman Kerja</th>
                                <td>
                                    <span class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Belum ada data pengalaman kerja
                                    </span>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            <!-- Tombol Lihat -->
            <button class="btn btn-sm mb-3 toggle-cv text-white" type="button"
                style="background-color: #01040e; border-color: #01040e;">
                <i class="bi bi-eye"></i> Lihat
            </button>

            <!-- Tombol Edit -->
            <a href="{{ route('pendaftaran.cv.edit', $cv->id) }}" class="btn btn-sm fw-semibold mb-3 text-white"
                style="background-color: #01040e; border-color: #01040e;">
                <i class="bi bi-pencil-square me-1 py-3"></i>Edit
            </a>

        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.toggle-cv');
        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                const table = btn.closest('.card-body').querySelectorAll('.cv-more');
                table.forEach(tr => {
                    if (tr.style.display === 'none') {
                        tr.style.display = '';
                        btn.innerHTML = '<i class="bi bi-eye-slash"></i> Sembunyikan';
                    } else {
                        tr.style.display = 'none';
                        btn.innerHTML = '<i class="bi bi-eye"></i> Lihat Semua';
                    }
                });
            });
        });
    });
</script>
