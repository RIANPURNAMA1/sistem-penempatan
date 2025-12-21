@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-u3eJv6TsgUsP62eFZlyDdc0AGJi/7luWGINuD/7++UZ5EONosFVJeFt3PcTJS3BM4tiTqcKoy0ucZZ+jJ7G8Aw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

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
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                title: 'Peringatan!',
                                text: 'Anda sudah melakukan pendaftaran sebelumnya dan tidak dapat mendaftar lagi.',
                                icon: 'warning',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                confirmButtonText: 'Kembali',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = '/';
                                }
                            });

                            const form = document.getElementById("cvForm");
                            if (form) {
                                [...form.elements].forEach(input => input.disabled = true);
                            }
                        });
                    </script>
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
                                {{-- <div class="col-md-6">
                                    <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_daftar" required>
                                    <div class="invalid-feedback">Tanggal daftar wajib dipilih.</div>
                                </div> --}}
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                    <div class="invalid-feedback">Alamat lengkap wajib diisi.</div>
                                </div>

                                <!-- Pendidikan Terakhir -->
                                <div class="col-md-6">
                                    <label class="form-label">Pendidikan Terakhir <span
                                            class="text-danger">*</span></label>
                                    <select name="pendidikan_terakhir" class="form-select" required>
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA/SMK">SMA / SMK / MA /Sederajat</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                    </select>
                                    <div class="invalid-feedback">Pendidikan terakhir wajib dipilih.</div>
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

                            <div class="alert alert-success py-2 small">
                                <i class="bi bi-info-circle me-1"></i>
                                Jika belum memiliki <strong> Sertifikat JFT & SSW </strong>, silakan dikosongkan.
                            </div>

                            <div class="row g-3">
                                @php
                                    $dokumenFields = [
                                        [
                                            'label' => 'Foto Diri',
                                            'name' => 'foto',
                                            'accept' => 'image/jpeg,image/png',
                                            'format' => 'JPG / PNG',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Kartu Keluarga (KK)',
                                            'name' => 'kk',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'KTP',
                                            'name' => 'ktp',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Bukti Pelunasan',
                                            'name' => 'bukti_pelunasan',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Akte Kelahiran',
                                            'name' => 'akte',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Ijazah Terakhir',
                                            'name' => 'ijasah',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Sertifikat JFT',
                                            'name' => 'sertifikat_jft',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => false,
                                            'note' => 'Opsional — boleh dikosongkan jika belum memiliki',
                                        ],
                                        [
                                            'label' => 'Sertifikat SSW',
                                            'name' => 'sertifikat_ssw',
                                            'id' => 'sertifikat_ssw',
                                            'accept' => 'application/pdf',
                                            'format' => 'PDF',
                                            'required' => false,
                                            'note' => 'Opsional — boleh dikosongkan jika belum memiliki',
                                        ],
                                    ];
                                @endphp

                                @foreach ($dokumenFields as $dok)
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            {{ $dok['label'] }}
                                            @if ($dok['required'])
                                                <span class="text-danger">*</span>
                                            @else
                                                <span class="badge bg-secondary ms-1">Opsional</span>
                                            @endif
                                        </label>

                                        <input type="file" class="form-control preview-input"
                                            name="{{ $dok['name'] }}" accept="{{ $dok['accept'] }}"
                                            id="{{ $dok['id'] ?? '' }}" data-preview="{{ $dok['name'] }}-preview"
                                            {{ $dok['required'] ? 'required' : '' }}>

                                        <div class="form-text">
                                            Format: {{ $dok['format'] }}
                                            @isset($dok['note'])
                                                <br>
                                                <small class="text-muted">
                                                    <i class="bi bi-info-circle"></i> {{ $dok['note'] }}
                                                </small>
                                            @endisset
                                        </div>

                                        <!-- Preview -->
                                        <div id="{{ $dok['name'] }}-preview" class="mt-2"></div>

                                        @if ($dok['required'])
                                            <div class="invalid-feedback">
                                                {{ $dok['label'] }} wajib diunggah.
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- ==================== Bidang SSW (Hidden by Default) ==================== -->
                        <div class="mb-4 d-none" id="bidang-ssw-container">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">
                                <i class="bi bi-bookmark-check me-2 text-success"></i> Bidang SSW
                                <span class="badge bg-secondary ms-2">Opsional</span>
                            </h5>

                            <div class="alert alert-success py-2 small">
                                <i class="bi bi-info-circle me-1"></i>
                                Pilih bidang SSW yang sesuai dengan sertifikat Anda. Anda dapat menambahkan lebih dari satu
                                bidang.
                                <strong>Field ini opsional</strong>, boleh dikosongkan.
                            </div>

                            <div id="bidang-wrapper">
                                <!-- Baris pertama -->
                                <div class="row mb-2 bidang-item align-items-center">
                                    <div class="col-md-10 col-9">
                                        <select name="bidang_ssw[]" class="form-select" disabled>
                                            <option value="">-- Pilih Bidang --</option>
                                            <option value="Pengolahan makanan">Pengolahan makanan</option>
                                            <option value="Restoran">Restoran</option>
                                            <option value="Pertanian">Pertanian</option>
                                            <option value="Kaigo (perawat)">Kaigo (perawat)</option>
                                            <option value="Building cleaning">Building cleaning</option>
                                            <option value="Driver">Driver</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <button type="button" class="btn btn-success w-100" id="add-bidang">
                                            <i class="bi bi-plus-lg"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-end mt-4">
                            <button type="reset" class="btn btn-secondary px-4 me-2 my-2">
                                <i class="bi bi-arrow-counterclockwise me-1 "></i> Reset
                            </button>
                            <button id="btnSubmit" type="submit" class="btn btn-success px-4 my-2">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sertifikatSSW = document.getElementById('sertifikat_ssw');
            const bidangSSWContainer = document.getElementById('bidang-ssw-container');
            const bidangWrapper = document.getElementById('bidang-wrapper');
            const addBidangBtn = document.getElementById('add-bidang');

            // ==================== TOGGLE BIDANG SSW SAAT UPLOAD/REMOVE SERTIFIKAT ====================
            if (sertifikatSSW && bidangSSWContainer) {
                sertifikatSSW.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        // Ada file - Tampilkan container bidang SSW
                        bidangSSWContainer.classList.remove('d-none');

                        // Enable semua select bidang
                        enableBidangInputs();

                        // Pastikan ada minimal 1 baris
                        ensureMinimumBidangRow();

                        console.log('Sertifikat SSW uploaded - Bidang SSW container shown');

                    } else {
                        // File dihapus - Sembunyikan container bidang SSW
                        bidangSSWContainer.classList.add('d-none');

                        // Disable semua select bidang (agar tidak terkirim ke backend)
                        disableBidangInputs();

                        // Reset semua nilai select
                        resetAllBidangSelects();

                        console.log('Sertifikat SSW removed - Bidang SSW container hidden');
                    }
                });
            }

            // ==================== TAMBAH BIDANG SSW ====================
            if (addBidangBtn) {
                addBidangBtn.addEventListener('click', function() {
                    const newRow = document.createElement('div');
                    newRow.classList.add('row', 'mb-2', 'bidang-item', 'align-items-center');

                    newRow.innerHTML = `
                <div class="col-md-10 col-9">
                    <select name="bidang_ssw[]" class="form-select">
                        <option value="">-- Pilih Bidang --</option>
                        <option value="Pengolahan makanan">Pengolahan makanan</option>
                        <option value="Restoran">Restoran</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Kaigo (perawat)">Kaigo (perawat)</option>
                        <option value="Building cleaning">Building cleaning</option>
                        <option value="Driver">Driver</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-2 col-3">
                    <button type="button" class="btn btn-danger w-100 remove-bidang">
                        <i class="bi bi-trash-fill"></i> Hapus
                    </button>
                </div>
            `;

                    bidangWrapper.appendChild(newRow);
                    console.log('New bidang row added');
                });
            }

            // ==================== HAPUS BIDANG SSW ====================
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-bidang') ||
                    e.target.closest('.remove-bidang')) {

                    const bidangItem = e.target.closest('.bidang-item');
                    const totalItems = bidangWrapper.querySelectorAll('.bidang-item').length;

                    // Boleh hapus jika lebih dari 1 baris
                    if (totalItems > 1) {
                        bidangItem.remove();
                        console.log('Bidang row removed');
                    } else {
                        // Jika hanya 1 baris tersisa, reset ke kosong
                        const select = bidangItem.querySelector('select[name="bidang_ssw[]"]');
                        if (select) {
                            select.value = '';
                        }

                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: 'Minimal harus ada 1 baris bidang. Baris telah direset ke kosong.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });

            // ==================== HELPER FUNCTIONS ====================

            // Enable semua input bidang (TANPA set required - karena nullable)
            function enableBidangInputs() {
                const selects = bidangWrapper.querySelectorAll('select[name="bidang_ssw[]"]');
                selects.forEach(select => {
                    select.removeAttribute('disabled');
                });
                console.log('Bidang inputs enabled');
            }

            // Disable semua input bidang (agar tidak terkirim)
            function disableBidangInputs() {
                const selects = bidangWrapper.querySelectorAll('select[name="bidang_ssw[]"]');
                selects.forEach(select => {
                    select.setAttribute('disabled', 'disabled');
                });
                console.log('Bidang inputs disabled');
            }

            // Pastikan minimal ada 1 baris bidang
            function ensureMinimumBidangRow() {
                const totalItems = bidangWrapper.querySelectorAll('.bidang-item').length;

                if (totalItems === 0) {
                    const newRow = document.createElement('div');
                    newRow.classList.add('row', 'mb-2', 'bidang-item', 'align-items-center');

                    newRow.innerHTML = `
                <div class="col-md-10 col-9">
                    <select name="bidang_ssw[]" class="form-select">
                        <option value="">-- Pilih Bidang --</option>
                        <option value="Pengolahan makanan">Pengolahan makanan</option>
                        <option value="Restoran">Restoran</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Kaigo (perawat)">Kaigo (perawat)</option>
                        <option value="Building cleaning">Building cleaning</option>
                        <option value="Driver">Driver</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-2 col-3">
                    <button type="button" class="btn btn-success w-100" id="add-bidang">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </button>
                </div>
            `;

                    bidangWrapper.appendChild(newRow);
                    console.log('Minimum bidang row ensured');
                }
            }

            // Reset semua select ke nilai kosong
            function resetAllBidangSelects() {
                const selects = bidangWrapper.querySelectorAll('select[name="bidang_ssw[]"]');
                selects.forEach(select => {
                    select.value = '';
                });
                console.log('All bidang selects reset');
            }

            // ==================== FILE PREVIEW ====================
            document.querySelectorAll(".preview-input").forEach(input => {
                input.addEventListener("change", function(e) {
                    const file = e.target.files[0];
                    const previewId = this.getAttribute("data-preview");
                    const previewBox = document.getElementById(previewId);

                    if (!previewBox) return;

                    previewBox.innerHTML = ""; // reset

                    if (!file) return;

                    const fileType = file.type;

                    if (fileType.startsWith("image/")) {
                        // Preview Gambar
                        const img = document.createElement("img");
                        img.src = URL.createObjectURL(file);
                        img.style.maxWidth = "120px";
                        img.style.maxHeight = "120px";
                        img.classList.add("rounded", "border");
                        img.onload = () => URL.revokeObjectURL(img.src);
                        previewBox.appendChild(img);

                    } else if (fileType === "application/pdf") {
                        // Preview PDF
                        const objectURL = URL.createObjectURL(file);
                        const pdfContainer = document.createElement("div");
                        pdfContainer.className = "d-flex align-items-center";
                        pdfContainer.innerHTML = `
                    <i class="bi bi-file-earmark-pdf-fill text-danger fs-2 me-2"></i>
                    <div>
                        <small class="d-block text-muted">${file.name}</small>
                        <a href="${objectURL}" target="_blank" class="btn btn-sm btn-primary mt-1">
                            <i class="bi bi-eye"></i> Lihat PDF
                        </a>
                    </div>
                `;
                        previewBox.appendChild(pdfContainer);
                    }
                });
            });
        });

        // preview
        document.addEventListener("DOMContentLoaded", function() {
            // Debug: cek apakah elemen ditemukan
            const previewInputs = document.querySelectorAll(".preview-input");
            console.log("Jumlah input preview:", previewInputs.length);

            if (previewInputs.length === 0) {
                console.error("Tidak ada elemen dengan class 'preview-input'!");
                return;
            }

            previewInputs.forEach((input, index) => {
                console.log(`Input ${index}:`, input.name, input.dataset.preview);

                input.addEventListener("change", function(e) {
                    const file = e.target.files[0];
                    const previewId = e.target.getAttribute("data-preview");
                    const previewBox = document.getElementById(previewId);

                    console.log("File selected:", file?.name, "Preview ID:", previewId);

                    if (!previewBox) {
                        console.error(`Preview box tidak ditemukan: ${previewId}`);
                        return;
                    }

                    previewBox.innerHTML = ""; // reset

                    if (!file) return;

                    const fileType = file.type;
                    console.log("File type:", fileType);

                    if (fileType.startsWith("image/")) {
                        // Preview Gambar
                        const img = document.createElement("img");
                        img.src = URL.createObjectURL(file);
                        img.style.maxWidth = "120px";
                        img.style.maxHeight = "120px";
                        img.classList.add("rounded", "border");
                        img.onload = function() {
                            URL.revokeObjectURL(this.src); // free memory
                        };
                        previewBox.appendChild(img);

                    } else if (fileType === "application/pdf") {
                        // Preview PDF
                        const pdfIcon = document.createElement("div");
                        pdfIcon.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-2 me-2"></i>
                        <a href="${URL.createObjectURL(file)}" target="_blank" class="btn btn-sm btn-primary">
                            Lihat PDF
                        </a>
                    </div>
                `;
                        previewBox.appendChild(pdfIcon);
                    } else {
                        console.warn("File type tidak didukung:", fileType);
                    }
                });
            });
        });

        // Pindahkan kode API wilayah ke DOMContentLoaded vanilla JS
        document.addEventListener('DOMContentLoaded', function() {
            // Kode sertifikat SSW (sudah ada)
            const sertifikatSSW = document.getElementById('sertifikat_ssw');
            const bidangSSWContainer = document.getElementById('bidang-ssw-container');

            if (sertifikatSSW) {
                sertifikatSSW.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        bidangSSWContainer.classList.remove('d-none');
                    } else {
                        bidangSSWContainer.classList.add('d-none');
                    }
                });
            }

            // API WILAYAH - Pindahkan ke sini
            const provinsiSelect = document.getElementById('provinsi');
            const kabKotaSelect = document.getElementById('kab_kota');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            // Pastikan semua elemen ada
            if (!provinsiSelect || !kabKotaSelect || !kecamatanSelect || !kelurahanSelect) {
                console.error('Elemen select tidak ditemukan!');
                return;
            }

            // Ambil provinsi dengan error handling
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(res => {
                    if (!res.ok) throw new Error('Gagal mengambil data provinsi');
                    return res.json();
                })
                .then(data => {
                    data.forEach(p => {
                        const option = document.createElement('option');
                        option.value = p.name;
                        option.dataset.id = p.id;
                        option.textContent = p.name;
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(err => console.error('Error loading provinces:', err));

            // Saat provinsi berubah
            provinsiSelect.addEventListener('change', function() {
                kabKotaSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
                kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

                const selectedOption = this.selectedOptions[0];
                const provId = selectedOption ? selectedOption.dataset.id : null;

                if (!provId) return;

                fetch(
                        `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(k => {
                            const option = document.createElement('option');
                            option.value = k.name;
                            option.dataset.id = k.id;
                            option.textContent = k.name;
                            kabKotaSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error loading regencies:', err));
            });

            // Saat kab/kota berubah
            kabKotaSelect.addEventListener('change', function() {
                kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

                const selectedOption = this.selectedOptions[0];
                const kabId = selectedOption ? selectedOption.dataset.id : null;

                if (!kabId) return;

                fetch(
                        `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(c => {
                            const option = document.createElement('option');
                            option.value = c.name;
                            option.dataset.id = c.id;
                            option.textContent = c.name;
                            kecamatanSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error loading districts:', err));
            });

            // Saat kecamatan berubah
            kecamatanSelect.addEventListener('change', function() {
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

                const selectedOption = this.selectedOptions[0];
                const kecId = selectedOption ? selectedOption.dataset.id : null;

                if (!kecId) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(v => {
                            const option = document.createElement('option');
                            option.value = v.name;
                            option.textContent = v.name;
                            kelurahanSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error loading villages:', err));
            });
        });
    </script>

@endsection
