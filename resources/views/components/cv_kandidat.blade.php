<div class="card border-0 shadow-sm rounded-4 ">
    <div class="card-header fw-bold py-3 rounded-top-4">
        <i class="bi bi-file-person me-2"></i> Ringkasan Data CV Anda
    </div>

    <div class="card-body">
        @foreach ($cvs as $cv)
            <div class="table-responsive mb-3" style="max-height: 500px; overflow-y:auto;">
                <table class="table table-bordered table-striped align-middle table-sm">
                    <tbody>
                        <!-- Ringkasan awal (tampil selalu) -->
                        <tr><th width="30%">Email</th><td>{{ $cv->email }}</td></tr>
                        <tr><th>Cabang</th><td>{{ $cv->cabang_Id }}</td></tr>
                        <tr><th>Batch</th><td>{{ $cv->batch }}</td></tr>
                        <tr><th>No Telepon</th><td>{{ $cv->no_telepon }}</td></tr>
                        <tr><th>Nama Lengkap (Romaji)</th><td>{{ $cv->nama_lengkap_romaji }}</td></tr>

                        <!-- Data lengkap tersembunyi -->
                        @php
                            $hiddenFields = [
                                ['Nama Lengkap (Katakana)', $cv->nama_lengkap_katakana],
                                ['Nama Panggilan (Romaji)', $cv->nama_panggilan_romaji],
                                ['Nama Panggilan (Katakana)', $cv->nama_panggilan_katakana],
                                ['Jenis Kelamin', $cv->jenis_kelamin],
                                ['Agama', $cv->agama . ($cv->agama_lainnya ? " ({$cv->agama_lainnya})" : '')],
                                ['Tempat & Tanggal Lahir', $cv->tempat_tanggal_lahir],
                                ['Usia', $cv->usia],
                                ['Alamat Lengkap', $cv->alamat_lengkap],
                                ['Email Aktif', $cv->email_aktif],
                                ['Status Perkawinan', $cv->status_perkawinan . ($cv->status_perkawinan_lainnya ? " ({$cv->status_perkawinan_lainnya})" : '')],
                                ['Golongan Darah', $cv->golongan_darah],
                                ['Surat Izin Mengemudi', $cv->surat_izin_mengemudi],
                                ['Jenis SIM', $cv->jenis_sim],
                                ['Merokok', $cv->merokok],
                                ['Minum Alkohol', $cv->minum_alkohol],
                                ['Bertato', $cv->bertato],
                                ['Tinggi Badan', $cv->tinggi_badan . ' cm'],
                                ['Berat Badan', $cv->berat_badan . ' kg'],
                                ['Ukuran Tubuh', "Pinggang: {$cv->ukuran_pinggang}, Sepatu: {$cv->ukuran_sepatu}, Atasan: {$cv->ukuran_atasan_baju} {$cv->ukuran_atasan_baju_lainnya}, Celana: {$cv->ukuran_celana}, Tangan Dominan: {$cv->tangan_dominan}"],
                                ['Kemampuan Penglihatan', $cv->kemampuan_penglihatan_mata . ' ' . $cv->kemampuan_penglihatan_mata_lainnya],
                                ['Vaksin', $cv->sudah_vaksin_berapa_kali . ' ' . $cv->sudah_vaksin_berapa_kali_lainnya],
                                ['Kesehatan Badan', $cv->kesehatan_badan],
                                ['Penyakit / Cedera Masa Lalu', $cv->penyakit_cedera_masa_lalu],
                                ['Hobi', $cv->hobi],
                                ['Rencana Sumber Biaya', $cv->rencana_sumber_biaya_keberangkatan],
                                ['Perkiraan Biaya', $cv->perkiraan_biaya],
                                ['Lama Belajar di Mendunia', $cv->lama_belajar_di_mendunia],
                                ['Kemampuan Bahasa Jepang', $cv->kemampuan_bahasa_jepang],
                                ['Kemampuan SSW', $cv->kemampuan_pemahaman_ssw],
                                ['Kelincahan & Kekuatan', $cv->kelincahan_dalam_bekerja . ' / ' . $cv->kekuatan_tindakan],
                                ['Kemampuan Bahasa Inggris', $cv->kemampuan_berbahasa_inggris . ' ' . $cv->kemampuan_berbahasa_inggris_lainnya],
                                ['Kebugaran Jasmani Seminggu', $cv->kebugaran_jasmani_seminggu . ' ' . $cv->kebugaran_jasmani_seminggu_lainnya],
                                ['Data Keluarga di Jepang', "Ada Keluarga: {$cv->ada_keluarga_di_jepang}, Hubungan: {$cv->hubungan_keluarga_di_jepang}, Status Kerabat: {$cv->status_kerabat_di_jepang}, Ingin Bekerja: {$cv->ingin_bekerja_berapa_tahun} {$cv->ingin_bekerja_berapa_tahun_lainnya}, Ingin Pulang: {$cv->ingin_pulang_berapa_kali}"],
                                ['Kelebihan / Kekurangan Diri', "Kelebihan: {$cv->kelebihan_diri}, Komentar Guru: {$cv->komentar_guru_kelebihan_diri}, Kekurangan: {$cv->kekurangan_diri}, Komentar Guru: {$cv->komentar_guru_kekurangan_diri}"],
                                ['Ketertarikan & Orang Dihormati', "Ketertarikan: {$cv->ketertarikan_terhadap_jepang}, Orang Dihormati: {$cv->orang_yang_dihormati}, Point Plus: {$cv->point_plus_diri}, Keahlian Khusus: {$cv->keahlian_khusus}"],
                                ['Data Anggota Keluarga', "Istri: {$cv->anggota_keluarga_istri}, Suami: {$cv->anggota_keluarga_suami}, Anak: {$cv->anggota_keluarga_anak}, Ibu: {$cv->anggota_keluarga_ibu}, Ayah: {$cv->anggota_keluarga_ayah}, Kakak: {$cv->anggota_keluarga_kakak}, Adik: {$cv->anggota_keluarga_adik}, Rata-rata Penghasilan: {$cv->rata_rata_penghasilan_keluarga}"]
                            ];
                        @endphp

                        @foreach ($hiddenFields as $field)
                            <tr class="cv-more" style="display: none;">
                                <th>{{ $field[0] }}</th>
                                <td>{{ $field[1] }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <button class="btn btn-info btn-sm mb-3 toggle-cv" type="button">
                <i class="bi bi-eye"></i> Lihat Semua
            </button>
            <a href="{{ route('pendaftaran.cv.edit', $cv->id) }}" class="btn btn-warning fw-semibold mb-3">
                <i class="bi bi-pencil-square me-1"></i> Edit CV
            </a>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
