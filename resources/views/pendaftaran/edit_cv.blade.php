@extends('layouts.app')

@section('title', 'Edit CV')

@section('content')

    <div class="">
        <h2 class="fw-bold mb-4 text-primary">Formulir Edit Curriculum Vitae</h2>

        <form id="edit-cv-form" action="{{route('pendaftaran.cv.update', $cv->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ================================
                                HALAMAN 1 — DATA AWAL
                ================================== -->
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header  p-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-user-circle me-2"></i>Halaman 1 — Data Awal & Minat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        {{-- Email --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $cv->email) }}" required>
                        </div>

                        {{-- Cabang --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="cabang_Id" class="form-label fw-medium">Cabang <span class="text-danger">*</span></label>
                            <select name="cabang_Id" id="cabang_Id" class="form-select" required>
                                @foreach ($cabangs as $c)
                                    <option value="{{ $c->id }}" {{ $cv->cabang_Id == $c->id ? 'selected' : '' }}>
                                        {{ $c->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Batch --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="batch" class="form-label fw-medium">Batch <span class="text-danger">*</span></label>
                            <input type="text" name="batch" id="batch" class="form-control" value="{{ old('batch', $cv->batch) }}" required>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="no_telepon" class="form-label fw-medium">No Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                                value="{{ old('no_telepon', $cv->no_telepon) }}" required>
                        </div>

                        {{-- Nomor Orang Tua --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="no_orang_tua" class="form-label fw-medium">No Orang Tua <span class="text-danger">*</span></label>
                            <input type="text" name="no_orang_tua" id="no_orang_tua" class="form-control"
                                value="{{ old('no_orang_tua', $cv->no_orang_tua) }}" required>
                        </div>

                        {{-- Bidang Sertifikasi --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="bidang_sertifikasi" class="form-label fw-medium">Bidang Sertifikasi</label>
                            <select name="bidang_sertifikasi" id="bidang_sertifikasi" class="form-select">
                                @foreach (['Pengolahan Makanan', 'Pertanian', 'Kaigo (perawat)', 'Building Cleaning', 'Restoran', 'Driver', 'Hanya JFT'] as $item)
                                    <option value="{{ $item }}"
                                        {{ $cv->bidang_sertifikasi == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Bidang Sertifikasi Lainnya --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="bidang_sertifikasi_lainnya" class="form-label fw-medium">Bidang Sertifikasi Lainnya</label>
                            <input type="text" name="bidang_sertifikasi_lainnya" id="bidang_sertifikasi_lainnya" class="form-control"
                                value="{{ old('bidang_sertifikasi_lainnya', $cv->bidang_sertifikasi_lainnya) }}">
                        </div>

                        {{-- Program Pertanian Kawakami --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="program_pertanian_kawakami" class="form-label fw-medium">Program Pertanian Kawakami</label>
                            <select name="program_pertanian_kawakami" id="program_pertanian_kawakami" class="form-select">
                                <option value="Ya" {{ $cv->program_pertanian_kawakami == 'Ya' ? 'selected' : '' }}>Ya
                                </option>
                                <option value="Tidak" {{ $cv->program_pertanian_kawakami == 'Tidak' ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                        </div>
                        
                        {{-- Upload Sertifikat --}}
                        <div class="col-12 mb-3">
                            <label for="sertifikat_files" class="form-label fw-medium">Upload Sertifikat</label>
                            <input type="file" name="sertifikat_files[]" id="sertifikat_files" multiple class="form-control">
                            <small class="text-muted">Pilih beberapa file jika ada.</small>
                        </div>

                    </div>
                </div>
            </div>


            <!-- ================================
                                HALAMAN 2 — DATA DIRI
                ================================== -->
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header  text-white p-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-id-card me-2"></i>Halaman 2 — Data Diri Lengkap</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        {{-- Nama Romaji --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="nama_lengkap_romaji" class="form-label fw-medium">Nama Lengkap (Romaji) <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap_romaji" id="nama_lengkap_romaji" class="form-control"
                                value="{{ $cv->nama_lengkap_romaji }}" required>
                        </div>

                        {{-- Nama Katakana --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="nama_lengkap_katakana" class="form-label fw-medium">Nama Lengkap (Katakana) <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap_katakana" id="nama_lengkap_katakana" class="form-control"
                                value="{{ $cv->nama_lengkap_katakana }}" required>
                        </div>

                        {{-- Nama Panggilan Romaji --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="nama_panggilan_romaji" class="form-label fw-medium">Nama Panggilan (Romaji) <span class="text-danger">*</span></label>
                            <input type="text" name="nama_panggilan_romaji" id="nama_panggilan_romaji" class="form-control"
                                value="{{ $cv->nama_panggilan_romaji }}" required>
                        </div>

                        {{-- Nama Panggilan Katakana --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="nama_panggilan_katakana" class="form-label fw-medium">Nama Panggilan (Katakana) <span class="text-danger">*</span></label>
                            <input type="text" name="nama_panggilan_katakana" id="nama_panggilan_katakana" class="form-control"
                                value="{{ $cv->nama_panggilan_katakana }}" required>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label fw-medium">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                <option value="男 (Laki-laki)" {{ $cv->jenis_kelamin == '男 (Laki-laki)' ? 'selected' : '' }}>男 (Laki-laki)</option>
                                <option value="女 (Perempuan)" {{ $cv->jenis_kelamin == '女 (Perempuan)' ? 'selected' : '' }}>女 (Perempuan)</option>
                            </select>
                        </div>

                        {{-- Agama --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="agama" class="form-label fw-medium">Agama</label>
                            <input type="text" name="agama" id="agama" class="form-control" value="{{ $cv->agama }}">
                        </div>

                        {{-- Agama lainnya --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="agama_lainnya" class="form-label fw-medium">Agama Lainnya (Jika ada)</label>
                            <input type="text" name="agama_lainnya" id="agama_lainnya" class="form-control"
                                value="{{ $cv->agama_lainnya }}">
                        </div>

                        {{-- Tempat/Tanggal Lahir --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="tempat_tanggal_lahir" class="form-label fw-medium">Tempat/Tanggal Lahir</label>
                            <input type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" class="form-control"
                                value="{{ $cv->tempat_tanggal_lahir }}">
                        </div>

                        {{-- Usia --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="usia" class="form-label fw-medium">Usia</label>
                            <input type="text" name="usia" id="usia" class="form-control" value="{{ $cv->usia }}">
                        </div>
                        
                        {{-- Email Aktif --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="email_aktif" class="form-label fw-medium">Email Aktif</label>
                            <input type="email" name="email_aktif" id="email_aktif" class="form-control" value="{{ $cv->email_aktif }}">
                        </div>
                        
                        {{-- Status Perkawinan --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="status_perkawinan" class="form-label fw-medium">Status Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan" class="form-select">
                                @foreach (['Sudah Menikah', 'Belum Menikah'] as $item)
                                    <option value="{{ $item }}"
                                        {{ $cv->status_perkawinan == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status Perkawinan Lainnya --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="status_perkawinan_lainnya" class="form-label fw-medium">Status Perkawinan Lainnya</label>
                            <input type="text" name="status_perkawinan_lainnya" id="status_perkawinan_lainnya" class="form-control"
                                value="{{ $cv->status_perkawinan_lainnya }}">
                        </div>
                        
                        {{-- Alamat --}}
                        <div class="col-12 mb-3">
                            <label for="alamat_lengkap" class="form-label fw-medium">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3">{{ $cv->alamat_lengkap }}</textarea>
                        </div>

                    </div>
                </div>
            </div>



            <!-- ================================
                                HALAMAN 3 — PEMBELAJARAN
                ================================== -->
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header p-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-book me-2"></i>Halaman 3 — Pembelajaran di Mendunia</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        {{-- Lama Belajar --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="lama_belajar_di_mendunia" class="form-label fw-medium">Lama Belajar di Mendunia</label>
                            <input type="text" name="lama_belajar_di_mendunia" id="lama_belajar_di_mendunia" class="form-control"
                                value="{{ $cv->lama_belajar_di_mendunia }}">
                        </div>

                        {{-- Kemampuan Bahasa Jepang --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="kemampuan_bahasa_jepang" class="form-label fw-medium">Kemampuan Bahasa Jepang</label>
                            <input type="text" name="kemampuan_bahasa_jepang" id="kemampuan_bahasa_jepang" class="form-control"
                                value="{{ $cv->kemampuan_bahasa_jepang }}">
                        </div>

                        {{-- Kemampuan Pemahaman SSW --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="kemampuan_pemahaman_ssw" class="form-label fw-medium">Kemampuan Pemahaman SSW</label>
                            <input type="text" name="kemampuan_pemahaman_ssw" id="kemampuan_pemahaman_ssw" class="form-control"
                                value="{{ $cv->kemampuan_pemahaman_ssw }}">
                        </div>

                        {{-- Kelincahan Dalam Bekerja --}}
                        <div class="col-12 col-md-6 mb-3">
                            <label for="kelincahan_dalam_bekerja" class="form-label fw-medium">Kelincahan Dalam Bekerja</label>
                            <input type="text" name="kelincahan_dalam_bekerja" id="kelincahan_dalam_bekerja" class="form-control"
                                value="{{ $cv->kelincahan_dalam_bekerja }}">
                        </div>

                    </div>
                </div>
            </div>


            <!-- ================================
                HALAMAN 4 — RIWAYAT PENDIDIKAN
            =================================== -->
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header  p-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-graduation-cap me-2"></i>Halaman 4 — Riwayat Pendidikan</h5>
                    <small>Tambahkan riwayat pendidikan mulai dari yang terbaru.</small>
                </div>
                <div class="card-body">

                    <div id="pendidikan-wrapper">
                        @if ($cv->pendidikans && count($cv->pendidikans) > 0)
                            @foreach ($cv->pendidikans as $index => $pend)
                                <div class="row mb-3 p-2  rounded pendidikan-item">
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <input type="text" name="pendidikan_tingkat[]" class="form-control"
                                            placeholder="Tingkat Pendidikan (e.g., S1/SMA)" value="{{ $pend->nama }}">
                                    </div>
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <input type="text" name="pendidikan_institusi[]" class="form-control"
                                            placeholder="Nama Institusi & Jurusan" value="{{ $pend->jurusan }}">
                                    </div>
                                    <div class="col-md-3 mb-2 mb-md-0">
                                        <input type="text" name="pendidikan_tahun[]" class="form-control"
                                            placeholder="Tahun Lulus" value="{{ $pend->tahun }}">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                        <button type="button"
                                            class="btn btn-danger btn-sm rounded-circle remove-pendidikan" title="Hapus">&times;</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row mb-3 p-2 border rounded pendidikan-item">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <input type="text" name="pendidikan_tingkat[]" class="form-control"
                                        placeholder="Tingkat Pendidikan">
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <input type="text" name="pendidikan_institusi[]" class="form-control"
                                        placeholder="Nama Institusi & Jurusan">
                                </div>
                                <div class="col-md-3 mb-2 mb-md-0">
                                    <input type="text" name="pendidikan_tahun[]" class="form-control"
                                        placeholder="Tahun Lulus">
                                </div>
                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-circle remove-pendidikan" title="Hapus">&times;</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="button" id="add-pendidikan" class="btn btn-outline-info mt-3"><i class="fas fa-plus me-1"></i> Tambah Pendidikan</button>

                </div>
            </div>

            <!-- ================================
                HALAMAN 5 — PENGALAMAN KERJA
            =================================== -->
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header  p-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-briefcase me-2"></i>Halaman 5 — Pengalaman Kerja</h5>
                    <small>Cantumkan pengalaman kerja Anda (terbaru dulu).</small>
                </div>
                <div class="card-body">

                    <div id="kerja-wrapper">
                        @if ($cv->pengalamans && count($cv->pengalamans) > 0)
                            @foreach ($cv->pengalamans as $index => $kerja)
                                <div class="row mb-3 p-2 rounded kerja-item">
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <input type="text" name="kerja_perusahaan[]" class="form-control"
                                            placeholder="Nama Perusahaan" value="{{ $kerja->perusahaan }}">
                                    </div>
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <input type="text" name="kerja_jabatan[]" class="form-control"
                                            placeholder="Jabatan" value="{{ $kerja->jabatan }}">
                                    </div>
                                    <div class="col-md-3 mb-2 mb-md-0">
                                        <input type="text" name="kerja_tahun[]" class="form-control"
                                            placeholder="Lama Bekerja (Tahun)" value="{{ $kerja->lama_bekerja }}">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-kerja" title="Hapus">&times;</button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row mb-3 p-2 border rounded kerja-item">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <input type="text" name="kerja_perusahaan[]" class="form-control"
                                        placeholder="Nama Perusahaan">
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <input type="text" name="kerja_jabatan[]" class="form-control"
                                        placeholder="Jabatan">
                                </div>
                                <div class="col-md-3 mb-2 mb-md-0">
                                    <input type="text" name="kerja_tahun[]" class="form-control" placeholder="Lama Bekerja (Tahun)">
                                </div>
                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm rounded-circle remove-kerja" title="Hapus">&times;</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="button" id="add-kerja" class="btn btn-outline-secondary mt-3"><i class="fas fa-plus me-1"></i> Tambah Pengalaman</button>

                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary px-4">Kembali</a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                    <i class="fas fa-save me-1"></i> Update CV
                </button>
            </div>

        </form>
    </div>


    {{-- JQuery + SweetAlert --}}
    {{-- Pastikan Anda sudah memuat Font Awesome dan Bootstrap CSS di layout utama Anda untuk ikon dan styling yang optimal --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // Template untuk Item Pendidikan
            const pendidikanTemplate = `
                <div class="row mb-3 p-2 border rounded pendidikan-item">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <input type="text" name="pendidikan_tingkat[]" class="form-control" placeholder="Tingkat Pendidikan">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <input type="text" name="pendidikan_institusi[]" class="form-control" placeholder="Nama Institusi & Jurusan">
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <input type="text" name="pendidikan_tahun[]" class="form-control" placeholder="Tahun Lulus">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-pendidikan" title="Hapus">&times;</button>
                    </div>
                </div>`;

            // Tambah Pendidikan
            $('#add-pendidikan').click(function() {
                $('#pendidikan-wrapper').append(pendidikanTemplate);
            });

            // Hapus Pendidikan
            $(document).on('click', '.remove-pendidikan', function() {
                // Jangan hapus jika hanya tersisa satu item kosong
                if ($('#pendidikan-wrapper').children('.pendidikan-item').length > 1 || !$(this).closest('.pendidikan-item').find('input').filter(function() { return this.value; }).length) {
                     $(this).closest('.pendidikan-item').remove();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Bisa Dihapus',
                        text: 'Minimal harus ada satu riwayat pendidikan yang terisi atau kosong.'
                    });
                }
            });

            // Template untuk Item Pengalaman Kerja
            const kerjaTemplate = `
                <div class="row mb-3 p-2 border rounded kerja-item">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <input type="text" name="kerja_perusahaan[]" class="form-control" placeholder="Nama Perusahaan">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <input type="text" name="kerja_jabatan[]" class="form-control" placeholder="Jabatan">
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <input type="text" name="kerja_tahun[]" class="form-control" placeholder="Lama Bekerja (Tahun)">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-danger btn-sm rounded-circle remove-kerja" title="Hapus">&times;</button>
                    </div>
                </div>`;

            // Tambah Pengalaman Kerja
            $('#add-kerja').click(function() {
                $('#kerja-wrapper').append(kerjaTemplate);
            });

            // Hapus Pengalaman Kerja
            $(document).on('click', '.remove-kerja', function() {
                // Jangan hapus jika hanya tersisa satu item kosong
                if ($('#kerja-wrapper').children('.kerja-item').length > 1 || !$(this).closest('.kerja-item').find('input').filter(function() { return this.value; }).length) {
                    $(this).closest('.kerja-item').remove();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Bisa Dihapus',
                        text: 'Minimal harus ada satu pengalaman kerja yang terisi atau kosong.'
                    });
                }
            });

        });


        // Submit Form AJAX dengan SweetAlert
        $('#edit-cv-form').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            // Tampilkan loading state
            Swal.fire({
                title: 'Memperbarui CV...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Mengganti route URL di sini, sesuaikan dengan URL yang benar di aplikasi Laravel Anda.
            // Asumsi: route('pendaftaran.cv.update', $cv->id) sudah didefinisikan di Laravel
            $.ajax({
                url: "{{ route('pendaftaran.cv.update', $cv->id) }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'CV berhasil diupdate!',
                        timer: 2500,
                        showConfirmButton: false,
                        didClose: () => window.location.href = "{{ route('dashboard') }}" // Arahkan kembali ke dashboard setelah berhasil
                    });
                },

                error: function(xhr) {
                    Swal.close();
                    let message = "Terjadi kesalahan yang tidak diketahui.";

                    if (xhr.responseJSON?.errors) {
                        // Menggabungkan semua pesan error validasi
                        message = Object.values(xhr.responseJSON.errors)
                            .map(err => `<li>${err[0]}</li>`).join("");
                        message = `<ul class="text-start ps-4 mb-0">${message}</ul>`;
                    } else if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memperbarui',
                        html: message
                    });
                }
            });
        });
    </script>

    <style>
        /* Gaya Kustom untuk tampilan yang lebih menarik */
        .card-header {
            border-bottom: 0;
            border-radius: .5rem .5rem 0 0 !important;
            /* Melembutkan sudut atas */
        }

        .card-header h5 {
            color: white !important;
        }

        .card {
            border-radius: .5rem !important;
        }

        .form-label.fw-medium {
            font-weight: 500 !important;
        }

        .btn-primary, .btn-secondary {
            border-radius: .3rem;
            transition: all 0.2s;
        }

        /* Hover effect for buttons */
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        
        .kerja-item {
            border-left-color: var(--bs-secondary) !important;
        }
    </style>

@endsection