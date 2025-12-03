@extends('layouts.app')

@section('title', 'Edit CV')

@section('content')

    <div class="">
        <h2 class="fw-bold mb-4 text-primary">Edit Curriculum Vitae</h2>
        <form id="formUpdateCv" action="{{ route('pendaftaran.cv.update', $cv->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ===============================
                 PAS FOTO CV
        ================================= --}}
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header bg-primary p-3">
                    <h5 class="mb-0 fw-bold text-white">
                        <i class="fas fa-camera me-2"></i>Pas Foto CV
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">

                        {{-- Preview Foto --}}
                        <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                            @if ($cv->pas_foto_cv)
                                <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto" id="preview-foto"
                                    class="img-thumbnail rounded-circle" style="width:150px;height:150px;object-fit:cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                    id="preview-foto" style="width:150px;height:150px;">
                                    <i class="bi bi-person-circle text-secondary" style="font-size:5rem;"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Upload Foto --}}
                        <div class="col-12 col-md-8">
                            <label for="pas_foto_cv" class="form-label fw-medium">Upload Foto Baru</label>
                            <input type="file" name="pas_foto_cv" id="pas_foto_cv" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG — Max: 2MB</small>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===============================
                 DATA DIRI
        ================================= --}}
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header  p-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-id-card me-2"></i>Data Diri Lengkap
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        {{-- Nama Romaji --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Nama Lengkap (Romaji)</label>
                            <input type="text" name="nama_lengkap_romaji" class="form-control"
                                value="{{ old('nama_lengkap_romaji', $cv->nama_lengkap_romaji) }}" required>
                        </div>

                        {{-- Nama Katakana --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Nama Lengkap (Katakana)</label>
                            <input type="text" name="nama_lengkap_katakana" class="form-control"
                                value="{{ old('nama_lengkap_katakana', $cv->nama_lengkap_katakana) }}" required>
                        </div>

                        {{-- Nama Panggilan Romaji --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Nama Panggilan (Romaji)</label>
                            <input type="text" name="nama_panggilan_romaji" class="form-control"
                                value="{{ old('nama_panggilan_romaji', $cv->nama_panggilan_romaji) }}" required>
                        </div>

                        {{-- Nama Panggilan Katakana --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Nama Panggilan (Katakana)</label>
                            <input type="text" name="nama_panggilan_katakana" class="form-control"
                                value="{{ old('nama_panggilan_katakana', $cv->nama_panggilan_katakana) }}" required>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="男 (Laki-laki)" {{ $cv->jenis_kelamin == '男 (Laki-laki)' ? 'selected' : '' }}>
                                    男 (Laki-laki)
                                </option>
                                <option value="女 (Perempuan)" {{ $cv->jenis_kelamin == '女 (Perempuan)' ? 'selected' : '' }}>
                                    女 (Perempuan)
                                </option>
                            </select>
                        </div>

                        {{-- Agama --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Agama</label>
                            <input type="text" name="agama" class="form-control" value="{{ old('agama', $cv->agama) }}"
                                required>
                        </div>

                        {{-- Agama lainnya --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Agama Lainnya (Opsional)</label>
                            <input type="text" name="agama_lainnya" class="form-control"
                                value="{{ old('agama_lainnya', $cv->agama_lainnya) }}">
                        </div>

                        {{-- Tempat/Tanggal Lahir --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Tempat/Tanggal Lahir</label>
                            <input type="text" name="tempat_tanggal_lahir" class="form-control"
                                placeholder="Contoh: Jakarta, 17 Agustus 1995"
                                value="{{ old('tempat_tanggal_lahir', $cv->tempat_tanggal_lahir) }}" required>
                        </div>

                        {{-- Usia --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Usia</label>
                            <input type="number" name="usia" class="form-control" value="{{ old('usia', $cv->usia) }}"
                                required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Email Aktif</label>
                            <input type="email" name="email_aktif" class="form-control"
                                value="{{ old('email_aktif', $cv->email_aktif) }}" required>
                        </div>

                        {{-- Status Perkawinan --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-select" required>
                                <option value="Sudah Menikah"
                                    {{ $cv->status_perkawinan == 'Sudah Menikah' ? 'selected' : '' }}>
                                    Sudah Menikah
                                </option>
                                <option value="Belum Menikah"
                                    {{ $cv->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>
                                    Belum Menikah
                                </option>
                            </select>
                        </div>

                        {{-- Status lainnya --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Status Perkawinan Lainnya</label>
                            <input type="text" name="status_perkawinan_lainnya" class="form-control"
                                value="{{ old('status_perkawinan_lainnya', $cv->status_perkawinan_lainnya) }}">
                        </div>

                        {{-- Golongan Darah --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select" required>
                                @foreach (['A', 'B', 'AB', 'O'] as $gol)
                                    <option value="{{ $gol }}"
                                        {{ $cv->golongan_darah == $gol ? 'selected' : '' }}>
                                        {{ $gol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SIM --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Memiliki SIM?</label>
                            <select name="surat_izin_mengemudi" class="form-select" required>
                                <option value="Ada" {{ $cv->surat_izin_mengemudi == 'Ada' ? 'selected' : '' }}>Ada
                                </option>
                                <option value="Tidak" {{ $cv->surat_izin_mengemudi == 'Tidak' ? 'selected' : '' }}>Tidak
                                </option>
                            </select>
                        </div>

                        {{-- Jenis SIM --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Jenis SIM</label>
                            <select name="jenis_sim" class="form-select">
                                <option value="">Pilih Jenis SIM</option>
                                @foreach (['SIM A', 'SIM B', 'SIM C', 'SIM D'] as $sim)
                                    <option value="{{ $sim }}" {{ $cv->jenis_sim == $sim ? 'selected' : '' }}>
                                        {{ $sim }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-12 mb-3">
                            <label class="form-label fw-medium">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="form-control" rows="3" required>{{ old('alamat_lengkap', $cv->alamat_lengkap) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ===============================
    RIWAYAT PENDIDIKAN
=============================== --}}
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header p-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan
                    </h5>
                    <small>Isi dari yang terbaru terlebih dahulu.</small>
                </div>

                <div class="card-body">
                    <div id="pendidikan-wrapper">

                        @forelse ($cv->pendidikans as $pend)
                            <div class="row mb-3 p-3 rounded pendidikan-item">
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="pendidikan_tingkat[]" class="form-control"
                                        value="{{ $pend->nama }}" placeholder="Tingkat (SMA/S1)">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <input type="text" name="pendidikan_institusi[]" class="form-control"
                                        value="{{ $pend->jurusan }}" placeholder="Institusi & Jurusan">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text" name="pendidikan_tahun_masuk[]" class="form-control"
                                        value="{{ $pend->tahun_masuk }}" placeholder="Tahun Masuk">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text" name="pendidikan_tahun_lulus[]" class="form-control"
                                        value="{{ $pend->tahun_lulus }}" placeholder="Tahun Lulus">
                                </div>

                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-circle remove-pendidikan">&times;</button>
                                </div>
                            </div>
                        @empty
                            <div class="row mb-3 p-3 rounded pendidikan-item">

                                <div class="col-md-4 mb-2">
                                    <input type="text" name="pendidikan_tingkat[]" class="form-control"
                                        placeholder="Tingkat Pendidikan">
                                </div>

                                <div class="col-md-4 mb-2">
                                    <input type="text" name="pendidikan_institusi[]" class="form-control"
                                        placeholder="Institusi & Jurusan">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text" name="pendidikan_tahun_masuk[]" class="form-control"
                                        placeholder="Tahun Masuk">
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text" name="pendidikan_tahun_lulus[]" class="form-control"
                                        placeholder="Tahun Lulus">
                                </div>

                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-circle remove-pendidikan">&times;</button>
                                </div>
                            </div>
                        @endforelse

                    </div>

                    <button type="button" id="add-pendidikan" class="btn btn-outline-success mt-3">
                        <i class="fas fa-plus me-1"></i>Tambah Pendidikan
                    </button>
                </div>
            </div>


            {{-- ===============================
    PENGALAMAN KERJA
=============================== --}}
            <div class="card shadow-lg mb-5 border-0">
                <div class="card-header p-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-briefcase me-2"></i>Pengalaman Kerja
                    </h5>
                </div>

                <div class="card-body">
                    <div id="kerja-wrapper">

                        @forelse ($cv->pengalamans as $kerja)
                            <div class="row mb-3 p-3 rounded kerja-item ">

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="kerja_perusahaan[]" class="form-control"
                                        value="{{ $kerja->perusahaan }}" placeholder="Nama Perusahaan" required>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="kerja_jabatan[]" class="form-control"
                                        value="{{ $kerja->jabatan }}" placeholder="Jabatan" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="month" name="kerja_tanggal_masuk[]" class="form-control"
                                        value="{{ $kerja->tanggal_masuk }}" placeholder="Tanggal Masuk" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="month" name="kerja_tanggal_keluar[]" class="form-control"
                                        value="{{ $kerja->tanggal_keluar }}" placeholder="Tanggal Keluar" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text" name="kerja_gaji[]" class="form-control"
                                        value="{{ $kerja->gaji }}" placeholder="Gaji">
                                </div>

                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-circle remove-kerja">&times;</button>
                                </div>

                            </div>
                        @empty
                            <div class="row mb-3 p-3 rounded kerja-item ">

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="kerja_perusahaan[]" class="form-control"
                                        placeholder="Nama Perusahaan" required>
                                </div>

                                <div class="col-md-3 mb-2">
                                    <input type="text" name="kerja_jabatan[]" class="form-control"
                                        placeholder="Jabatan" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="month" name="kerja_tanggal_masuk[]" class="form-control"
                                        placeholder="Tanggal Masuk" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="month" name="kerja_tanggal_keluar[]" class="form-control"
                                        placeholder="Tanggal Keluar" required>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <input type="text" name="kerja_gaji[]" class="form-control" placeholder="Gaji">
                                </div>

                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-circle remove-kerja">&times;</button>
                                </div>

                            </div>
                        @endforelse

                    </div>

                    <button type="button" id="add-kerja" class="btn btn-outline-warning mt-3">
                        <i class="fas fa-plus me-1"></i>Tambah Pengalaman
                    </button>

                </div>
            </div>


            <button type="submit" id="btnUpdate" class="btn btn-success">Update Data</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {

            // ================================
            // TAMBAH RIWAYAT PENDIDIKAN
            // ================================
            $("#add-pendidikan").click(function() {

                let html = `
    <div class="row mb-3 p-3 rounded pendidikan-item">
        <div class="col-md-4 mb-2">
            <input type="text" name="pendidikan_tingkat[]" class="form-control"
                   placeholder="Tingkat Pendidikan">
        </div>

        <div class="col-md-4 mb-2">
            <input type="text" name="pendidikan_institusi[]" class="form-control"
                   placeholder="Institusi & Jurusan">
        </div>

        <div class="col-md-2 mb-2">
            <input type="text" name="pendidikan_tahun_masuk[]" class="form-control"
                   placeholder="Tahun Masuk">
        </div>

        <div class="col-md-2 mb-2">
            <input type="text" name="pendidikan_tahun_lulus[]" class="form-control"
                   placeholder="Tahun Lulus">
        </div>

        <div class="col-md-1 d-flex align-items-center justify-content-center">
            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-pendidikan">&times;</button>
        </div>
    </div>`;

                $("#pendidikan-wrapper").append(html);
            });


            // HAPUS RIWAYAT PENDIDIKAN
            $(document).on("click", ".remove-pendidikan", function() {
                $(this).closest(".pendidikan-item").remove();
            });



            // ================================
            // TAMBAH PENGALAMAN KERJA
            // ================================
            $("#add-kerja").click(function() {

                let html = `
    <div class="row mb-3 p-3 rounded kerja-item">

        <div class="col-md-3 mb-2">
            <input type="text" name="kerja_perusahaan[]" class="form-control"
                   placeholder="Nama Perusahaan" required>
        </div>

        <div class="col-md-3 mb-2">
            <input type="text" name="kerja_jabatan[]" class="form-control"
                   placeholder="Jabatan" required>
        </div>

        <div class="col-md-2 mb-2">
            <input type="month" name="kerja_tanggal_masuk[]" class="form-control"
                   placeholder="Tanggal Masuk" required>
        </div>

        <div class="col-md-2 mb-2">
            <input type="month" name="kerja_tanggal_keluar[]" class="form-control"
                   placeholder="Tanggal Keluar" required>
        </div>

        <div class="col-md-2 mb-2">
            <input type="text" name="kerja_gaji[]" class="form-control"
                   placeholder="Gaji">
        </div>

        <div class="col-md-1 d-flex align-items-center justify-content-center">
            <button type="button" class="btn btn-danger btn-sm rounded-circle remove-kerja">&times;</button>
        </div>

    </div>`;

                $("#kerja-wrapper").append(html);
            });

            // HAPUS PENGALAMAN
            $(document).on("click", ".remove-kerja", function() {
                $(this).closest(".kerja-item").remove();
            });

        });
    </script>


    <script>
        $(document).ready(function() {


            $("#formUpdateCv").on("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $("#btnUpdate").prop("disabled", true).text("Memperbarui...");
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: response.message,
                                timer: 2000
                            });
                            setTimeout(() => window.location.href = "/", 1800);

                        }
                    },
                    error: function(xhr) {
                        $("#btnUpdate").prop("disabled", false).text("Update Data");

                        if (xhr.status === 422) {
                            let msg = "";
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                msg += "• " + val[0] + "<br>";
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Validasi Gagal",
                                html: msg,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Memperbarui",
                                text: xhr.responseJSON?.detail ?? "Terjadi kesalahan",
                            });
                        }
                    }
                });
            });

        });
    </script>


@endsection
