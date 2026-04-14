{{-- Tampilkan CV jika sudah ada --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h5 class="font-semibold text-gray-800">
            <svg class="w-5 h-5 inline-block mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Ringkasan Data CV Anda
        </h5>
    </div>

    <div class="p-6">
        @foreach ($cvs as $cv)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border">
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50 w-48">Email</th>
                            <td class="px-4 py-3 text-gray-800">{{ $cv->email }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Cabang</th>
                            <td class="px-4 py-3 text-gray-800">{{ $cv->cabang->nama_cabang ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Batch</th>
                            <td class="px-4 py-3 text-gray-800">{{ $cv->batch }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">No Telepon</th>
                            <td class="px-4 py-3 text-gray-800">{{ $cv->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">No Telepon Orang Tua</th>
                            <td class="px-4 py-3 text-gray-800">{{ $cv->no_orang_tua }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Nama Lengkap (Romaji)</th>
                            <td class="px-4 py-3 text-gray-800">{{ $cv->nama_lengkap_romaji }}</td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Foto CV</th>
                            <td class="px-4 py-3">
                                @if ($cv->pas_foto_cv)
                                    <img src="{{ asset($cv->pas_foto_cv) }}" class="w-40 h-48 object-cover rounded-lg border border-gray-200">
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50 align-top">Foto Lainnya</th>
                            <td class="px-4 py-3">
                                @php
                                    $pasFotos = json_decode($cv->pas_foto, true) ?? [];
                                @endphp
                                @if (count($pasFotos) === 0)
                                    <span class="text-gray-400">Tidak ada file</span>
                                @else
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($pasFotos as $foto)
                                            @php
                                                $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                                                $url = asset($foto);
                                            @endphp
                                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                <a href="{{ $url }}" target="_blank">
                                                    <img src="{{ $url }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200 hover:opacity-80">
                                                </a>
                                            @else
                                                <a href="{{ $url }}" target="_blank" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-lg hover:bg-gray-200 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                                    File
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50 align-top">Sertifikat</th>
                            <td class="px-4 py-3">
                                @php
                                    $sertifikats = json_decode($cv->sertifikat_files, true) ?? [];
                                @endphp
                                @if (count($sertifikats) === 0)
                                    <span class="text-gray-400">Tidak ada file</span>
                                @else
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($sertifikats as $file)
                                            @php
                                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                $url = asset($file);
                                            @endphp
                                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                                <a href="{{ $url }}" target="_blank">
                                                    <img src="{{ $url }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200 hover:opacity-80">
                                                </a>
                                            @else
                                                <a href="{{ $url }}" target="_blank" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs rounded-lg hover:bg-red-100 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                                    PDF
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>

                        @php
                            $hiddenFields = [
                                ['Bidang Sertifikasi', $cv->bidang_sertifikasi . ($cv->bidang_sertifikasi_lainnya ? " ({$cv->bidang_sertifikasi_lainnya})" : '')],
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
                                ['Status Perkawinan', $cv->status_perkawinan . ($cv->status_perkawinan_lainnya ? " ({$cv->status_perkawinan_lainnya})" : '')],
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
                                ['Ukuran Atasan', $cv->ukuran_atasan_baju . ($cv->ukuran_atasan_baju_lainnya ? " ({$cv->ukuran_atasan_baju_lainnya})" : '')],
                                ['Ukuran Celana', $cv->ukuran_celana],
                                ['Tangan Dominan', $cv->tangan_dominan],
                                ['Kemampuan Penglihatan', $cv->kemampuan_penglihatan_mata . ($cv->kemampuan_penglihatan_mata_lainnya ? " ({$cv->kemampuan_penglihatan_mata_lainnya})" : '')],
                                ['Kemampuan Pendengaran', $cv->kemampuan_pendengaran],
                                ['Vaksin', $cv->sudah_vaksin_berapa_kali . ($cv->sudah_vaksin_berapa_kali_lainnya ? " ({$cv->sudah_vaksin_berapa_kali_lainnya})" : '')],
                                ['Kesehatan Badan', $cv->kesehatan_badan],
                                ['Penyakit/Cedera Masa Lalu', $cv->penyakit_cedera_masa_lalu],
                                ['Hobi', $cv->hobi],
                                ['Rencana Sumber Biaya', $cv->rencana_sumber_biaya_keberangkatan],
                                ['Perkiraan Biaya', $cv->perkiraan_biaya],
                                ['Biaya Keberangkatan Jisshu', $cv->Biaya_keberangkatan_sebelumnya_jisshu ?? '-'],
                                ['Lama Belajar di Mendunia', $cv->lama_belajar_di_mendunia],
                                ['Kemampuan Bahasa Jepang', $cv->kemampuan_bahasa_jepang ?? '-'],
                                ['Kemampuan Pemahaman SSW', $cv->kemampuan_pemahaman_ssw ?? '-'],
                                ['Kelincahan Dalam Bekerja', $cv->kelincahan_dalam_bekerja ?? '-'],
                                ['Kekuatan Tindakan', $cv->kekuatan_tindakan ?? '-'],
                                ['Kemampuan Bahasa Inggris', ($cv->kemampuan_berbahasa_inggris ?? '-') . ($cv->kemampuan_berbahasa_inggris_lainnya ? " ({$cv->kemampuan_berbahasa_inggris_lainnya})" : '')],
                                ['Kebugaran Jasmani Seminggu', $cv->kebugaran_jasmani_seminggu . ($cv->kebugaran_jasmani_seminggu_lainnya ? " ({$cv->kebugaran_jasmani_seminggu_lainnya})" : '')],
                                ['Bersedia Kerja Shift', $cv->bersedia_kerja_shift],
                                ['Bersedia Lembur', $cv->bersedia_lembur],
                                ['Bersedia Kerja Hari Libur', $cv->bersedia_hari_libur],
                                ['Menggunakan Kacamata', $cv->menggunakan_kacamata],
                                ['Ada Keluarga di Jepang', $cv->ada_keluarga_di_jepang],
                                ['Hubungan Keluarga di Jepang', $cv->hubungan_keluarga_di_jepang ?? '-'],
                                ['Status Kerabat di Jepang', ($cv->status_kerabat_di_jepang ?? '-') . ($cv->status_kerabat_di_jepang_lainnya ? " ({$cv->status_kerabat_di_jepang_lainnya})" : '')],
                                ['Ingin Bekerja Berapa Tahun', $cv->ingin_bekerja_berapa_tahun . ($cv->ingin_bekerja_berapa_tahun_lainnya ? " ({$cv->ingin_bekerja_berapa_tahun_lainnya})" : '')],
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
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">{{ $field[0] }}</th>
                                <td class="px-4 py-3 text-gray-800">{{ $field[1] }}</td>
                            </tr>
                        @endforeach

                        @if ($cv->istri_nama)
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Data Istri</th>
                                <td class="px-4 py-3 text-gray-800">
                                    <div class="text-sm">
                                        <div><span class="font-medium">Nama:</span> {{ $cv->istri_nama }}</div>
                                        <div><span class="font-medium">Usia:</span> {{ $cv->istri_usia ?? '-' }}</div>
                                        <div><span class="font-medium">Pekerjaan:</span> {{ $cv->istri_pekerjaan ?? '-' }}</div>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        @if ($cv->anak_nama)
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Data Anak</th>
                                <td class="px-4 py-3 text-gray-800">
                                    <div class="text-sm">
                                        <div><span class="font-medium">Nama:</span> {{ $cv->anak_nama }}</div>
                                        <div><span class="font-medium">Jenis Kelamin:</span> {{ $cv->anak_jenis_kelamin ?? '-' }}</div>
                                        <div><span class="font-medium">Usia:</span> {{ $cv->anak_usia ?? '-' }}</div>
                                        <div><span class="font-medium">Pendidikan:</span> {{ $cv->anak_pendidikan ?? '-' }}</div>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        <tr class="cv-more hidden">
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Data Ibu</th>
                            <td class="px-4 py-3 text-gray-800">
                                <div class="text-sm">
                                    <div><span class="font-medium">Nama:</span> {{ $cv->ibu_nama }}</div>
                                    <div><span class="font-medium">Usia:</span> {{ $cv->ibu_usia }}</div>
                                    <div><span class="font-medium">Pekerjaan:</span> {{ $cv->ibu_pekerjaan }}</div>
                                </div>
                            </td>
                        </tr>

                        <tr class="cv-more hidden">
                            <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Data Ayah</th>
                            <td class="px-4 py-3 text-gray-800">
                                <div class="text-sm">
                                    <div><span class="font-medium">Nama:</span> {{ $cv->ayah_nama }}</div>
                                    <div><span class="font-medium">Usia:</span> {{ $cv->ayah_usia }}</div>
                                    <div><span class="font-medium">Pekerjaan:</span> {{ $cv->ayah_pekerjaan }}</div>
                                </div>
                            </td>
                        </tr>

                        @if ($cv->kakak_nama)
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Data Kakak</th>
                                <td class="px-4 py-3 text-gray-800">
                                    <div class="text-sm">
                                        <div><span class="font-medium">Nama:</span> {{ $cv->kakak_nama }}</div>
                                        <div><span class="font-medium">Usia:</span> {{ $cv->kakak_usia ?? '-' }}</div>
                                        <div><span class="font-medium">Jenis Kelamin:</span> {{ $cv->kakak_jenis_kelamin ?? '-' }}</div>
                                        <div><span class="font-medium">Pekerjaan:</span> {{ $cv->kakak_pekerjaan ?? '-' }}</div>
                                        <div><span class="font-medium">Status:</span> {{ $cv->kakak_status ?? '-' }}</div>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        @if ($cv->adik_nama)
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Data Adik</th>
                                <td class="px-4 py-3 text-gray-800">
                                    <div class="text-sm">
                                        <div><span class="font-medium">Nama:</span> {{ $cv->adik_nama }}</div>
                                        <div><span class="font-medium">Usia:</span> {{ $cv->adik_usia ?? '-' }}</div>
                                        <div><span class="font-medium">Jenis Kelamin:</span> {{ $cv->adik_jenis_kelamin ?? '-' }}</div>
                                        <div><span class="font-medium">Pekerjaan:</span> {{ $cv->adik_pekerjaan ?? '-' }}</div>
                                        <div><span class="font-medium">Status:</span> {{ $cv->adik_status ?? '-' }}</div>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        @if ($cv->pendidikans && $cv->pendidikans->count() > 0)
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50 align-top">Riwayat Pendidikan</th>
                                <td class="px-4 py-3">
                                    @foreach ($cv->pendidikans as $index => $pendidikan)
                                        <div class="mb-3 p-3 bg-gray-50 rounded-lg text-sm">
                                            <div class="font-medium text-gray-800">Pendidikan {{ $index + 1 }}</div>
                                            <div><span class="text-gray-500">Nama:</span> {{ $pendidikan->nama }}</div>
                                            @if ($pendidikan->jurusan)<div><span class="text-gray-500">Jurusan:</span> {{ $pendidikan->jurusan }}</div>@endif
                                            @if ($pendidikan->tahun_masuk || $pendidikan->tahun_lulus)<div><span class="text-gray-500">Periode:</span> {{ $pendidikan->tahun_masuk ?? '-' }} - {{ $pendidikan->tahun_lulus ?? '-' }}</div>@endif
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @else
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Riwayat Pendidikan</th>
                                <td class="px-4 py-3 text-gray-400">Belum ada data</td>
                            </tr>
                        @endif

                        @if ($cv->pengalamans && $cv->pengalamans->count() > 0)
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50 align-top">Riwayat Kerja</th>
                                <td class="px-4 py-3">
                                    @foreach ($cv->pengalamans as $index => $pengalaman)
                                        <div class="mb-3 p-3 bg-gray-50 rounded-lg text-sm">
                                            <div class="font-medium text-gray-800">Pengalaman {{ $index + 1 }}</div>
                                            <div><span class="text-gray-500">Perusahaan:</span> {{ $pengalaman->perusahaan }}</div>
                                            <div><span class="text-gray-500">Jabatan:</span> {{ $pengalaman->jabatan }}</div>
                                            @if ($pengalaman->tanggal_masuk)
                                                <div><span class="text-gray-500">Periode:</span> {{ \Carbon\Carbon::parse($pengalaman->tanggal_masuk)->format('d M Y') }} - {{ $pengalaman->tanggal_keluar ? \Carbon\Carbon::parse($pengalaman->tanggal_keluar)->format('d M Y') : 'Sekarang' }}</div>
                                            @endif
                                            @if ($pengalaman->gaji)<div><span class="text-gray-500">Gaji:</span> Rp {{ $pengalaman->gaji }}</div>@endif
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @else
                            <tr class="cv-more hidden">
                                <th class="px-4 py-3 font-medium text-gray-600 bg-gray-50">Riwayat Kerja</th>
                                <td class="px-4 py-3 text-gray-400">Belum ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex gap-2">
                <button type="button" class="toggle-cv px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900 transition">
                    Lihat Semua
                </button>
                <a href="{{ route('pendaftaran.cv.edit', $cv->id) }}" class="px-4 py-2 bg-amber-100 text-amber-700 text-sm font-medium rounded-lg hover:bg-amber-200 transition">
                    Edit
                </a>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-cv').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var rows = document.querySelectorAll('.cv-more');
                var isHidden = rows.length > 0 && rows[0].classList.contains('hidden');
                
                rows.forEach(function(tr) {
                    if (isHidden) {
                        tr.classList.remove('hidden');
                    } else {
                        tr.classList.add('hidden');
                    }
                });
                
                if (isHidden) {
                    btn.innerHTML = 'Sembunyikan';
                } else {
                    btn.innerHTML = 'Lihat Semua';
                }
            });
        });
    });
</script>