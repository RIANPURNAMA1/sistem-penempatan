@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Form Pendaftaran Kandidat
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <h4 class="fw-bold mb-3">
            <i class="bi bi-person-plus-fill me-2 text-primary"></i> Formulir Pendaftaran Kandidat
        </h4>
        <p class="text-muted mb-4">Semua field bertanda <span class="text-danger">*</span> wajib diisi. Untuk dokumen,
            format yang diperbolehkan: <strong>PDF, JPG, PNG</strong>.</p>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                @if ($alreadyRegistered)
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Anda sudah melakukan pendaftaran sebelumnya. Form pendaftaran tidak dapat diakses lagi.
                    </div>
                @else
                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('POST')

                        <!-- ==================== Data Pribadi ==================== -->
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">
                                <i class="bi bi-person-lines-fill me-2 text-primary"></i> Data Pribadi
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK"
                                        required pattern="\d{16}">
                                    <div class="invalid-feedback">NIK wajib diisi dan harus 16 digit angka.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukkan nama lengkap" required>
                                    <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Usia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="usia" placeholder="Masukkan usia"
                                        required>
                                    <div class="invalid-feedback">Usia wajib diisi.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="contoh@email.com"
                                        required>
                                    <div class="invalid-feedback">Silakan masukkan email yang valid.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_wa" placeholder="08xxxxxxxxxx"
                                        required pattern="08\d{8,12}">
                                    <div class="invalid-feedback">Nomor WA wajib diisi dan format harus benar.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select class="form-select" name="agama" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <div class="invalid-feedback">Agama wajib diisi.</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="belum menikah">Belum Menikah</option>
                                        <option value="menikah">Menikah</option>
                                        <option value="lajang">Lajang</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih status.</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih jenis kelamin.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Cabang <span class="text-danger">*</span></label>
                                    <select class="form-select" name="cabang_id" required>
                                        <option value="">-- Pilih Cabang --</option>
                                        @foreach ($cabangs as $cabang)
                                            <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih cabang.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        placeholder="Maukan Tempat lahir" required>
                                    <div class="invalid-feedback">Tempat Lahir.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"> Tempat Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tempat_tanggal_lahir" required>
                                    <div class="invalid-feedback">Tempat Tanggal Lahir.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_daftar" required>
                                    <div class="invalid-feedback">Tanggal daftar wajib dipilih.</div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                    <div class="invalid-feedback">Alamat lengkap wajib diisi.</div>
                                </div>

                                <!-- ==================== Data Tambahan ==================== -->
                                <div class="mb-4">
                                    <h5 class="fw-bold border-bottom pb-2 mb-3">
                                        <i class="bi bi-list-check me-2 text-primary"></i> Data Tambahan
                                    </h5>

                                    <div class="row g-3">

                                        <!-- ID Prometric -->
                                        <div class="col-md-6">
                                            <label class="form-label">ID Prometric</label>
                                            <input type="text" name="id_prometric" class="form-control"
                                                placeholder="Masukkan ID Prometric">
                                            <div class="form-text">Opsional, jika memiliki ID Prometric.</div>
                                        </div>

                                        <!-- Password Prometric -->
                                        <div class="col-md-6">
                                            <label class="form-label">Password Prometric</label>
                                            <input type="text" name="password_prometric" class="form-control"
                                                placeholder="Masukkan Password Prometric">
                                            <div class="form-text">Opsional, digunakan jika ada akun Prometric.</div>
                                        </div>

                                        <!-- Pernah ke Jepang -->
                                        <div class="col-md-6">
                                            <label class="form-label">Pernah ke Jepang? <span
                                                    class="text-danger">*</span></label>
                                            <select name="pernah_ke_jepang" class="form-select" required>
                                                <option value="">-- Pilih Jawaban --</option>
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                            <div class="invalid-feedback">Silakan pilih apakah pernah ke Jepang.</div>
                                        </div>

                                        <!-- Upload Paspor -->
                                        <div class="col-md-6">
                                            <label class="form-label">Upload Paspor Jika Ada</label>
                                            <input type="file" name="paspor" class="form-control"
                                                accept="image/jpeg,image/png,application/pdf">
                                            <div class="form-text">PDF, JPG, PNG maks 10MB.</div>
                                        </div>

                                    </div>
                                </div>


                                <!-- Lokasi -->
                                <div class="col-md-6">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <select class="form-select" id="provinsi" name="provinsi" required>
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih provinsi.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kab/Kota <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kab_kota" name="kab_kota" required>
                                        <option value="">-- Pilih Kab/Kota --</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih Kab/Kota.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kecamatan" name="kecamatan" required>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih kecamatan.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kelurahan" name="kelurahan" required>
                                        <option value="">-- Pilih Kelurahan --</option>
                                    </select>
                                    <div class="invalid-feedback">Silakan pilih kelurahan.</div>
                                </div>
                            </div>
                        </div>



                        <!-- ==================== Upload Dokumen ==================== -->
                        <div class="mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">
                                <i class="bi bi-folder-symlink me-2 text-primary"></i> Upload Dokumen Persyaratan
                            </h5>
                            <div class="row g-3">
                                @php
                                    $dokumenFields = [
                                        [
                                            'label' => 'Foto Diri',
                                            'name' => 'foto',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'Kartu Keluarga (KK)',
                                            'name' => 'kk',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'KTP',
                                            'name' => 'ktp',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'Bukti Pelunasan',
                                            'name' => 'bukti_pelunasan',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'Akte Kelahiran',
                                            'name' => 'akte',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'Ijazah Terakhir',
                                            'name' => 'ijasah',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'Sertifikat JFT',
                                            'name' => 'sertifikat_jft',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                        [
                                            'label' => 'Sertifikat SSW',
                                            'name' => 'sertifikat_ssw',
                                            'accept' => 'image/jpeg,image/png,application/pdf',
                                        ],
                                    ];
                                @endphp
                                @foreach ($dokumenFields as $dok)
                                    <div class="col-md-4">
                                        <label class="form-label">{{ $dok['label'] }} <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="{{ $dok['name'] }}"
                                            accept="{{ $dok['accept'] }}" required>
                                        <div class="form-text">Format diperbolehkan: PDF, JPG, PNG.</div>
                                        <div class="invalid-feedback">{{ $dok['label'] }} wajib diunggah.</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-end mt-4">
                            <button type="reset" class="btn btn-secondary px-4 me-2 mb-2">
                                <i class="bi bi-arrow-counterclockwise me-1 "></i> Reset
                            </button>
                            <button id="btnSubmit" type="submit" class="btn btn-warning px-4">
                                <span class="btn-text"><i class="bi bi-send-check-fill me-1"></i> Daftar Sekarang</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>

                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // FORM SUBMIT AJAX
            $("form").on("submit", function(e) {
                e.preventDefault();

                let form = this;

                // Validasi Bootstrap
                if (!form.checkValidity()) {
                    form.classList.add("was-validated");
                    return;
                }

                let btn = $("#btnSubmit");

                // ANIMASI LOADING
                btn.prop("disabled", true);
                btn.find(".btn-text").addClass("d-none");
                btn.find(".spinner-border").removeClass("d-none");

                let formData = new FormData(form);

                $.ajax({
                    url: $(form).attr("action"),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Pendaftaran berhasil dikirim.",
                            timer: 3000,
                            showConfirmButton: false,


                        }).then(() => {
                            // Redirect ke route /
                            window.location.href = "/";
                        });

                        // Reset form
                        form.reset();
                        form.classList.remove("was-validated");
                    },

                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengirim",
                            text: xhr.responseJSON?.message ??
                                "Terjadi kesalahan, coba lagi."
                        });
                    },
                    complete: function() {
                        // KEMBALIKAN TOMBOL NORMAL
                        btn.prop("disabled", false);
                        btn.find(".btn-text").removeClass("d-none");
                        btn.find(".spinner-border").addClass("d-none");
                    }
                });

            });

            // Bootstrap validation
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // API WILAYAH
            const provinsiSelect = document.getElementById('provinsi');
            const kabKotaSelect = document.getElementById('kab_kota');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            // Ambil provinsi
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(res => res.json())
                .then(data => {
                    data.forEach(p => {
                        provinsiSelect.innerHTML +=
                            `<option value="${p.name}" data-id="${p.id}">${p.name}</option>`;
                    });
                });

            // Saat provinsi berubah
            provinsiSelect.addEventListener('change', function() {
                kabKotaSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
                kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

                const provId = this.selectedOptions[0].dataset.id;
                if (!provId) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(k => {
                            kabKotaSelect.innerHTML +=
                                `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`;
                        });
                    });
            });

            // Saat kab/kota berubah
            kabKotaSelect.addEventListener('change', function() {
                kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

                const kabId = this.selectedOptions[0].dataset.id;
                if (!kabId) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(c => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${c.name}" data-id="${c.id}">${c.name}</option>`;
                        });
                    });
            });

            // Saat kecamatan berubah
            kecamatanSelect.addEventListener('change', function() {
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

                const kecId = this.selectedOptions[0].dataset.id;
                if (!kecId) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(v => {
                            kelurahanSelect.innerHTML +=
                                `<option value="${v.name}">${v.name}</option>`;
                        });
                    });
            });

        });
    </script>
@endsection
