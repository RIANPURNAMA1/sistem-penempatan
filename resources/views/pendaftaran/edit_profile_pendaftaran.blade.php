@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
    <div class="">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow-md">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Edit Pendaftaran
                </li>
            </ol>
        </nav>

        <div class="card shadow-md p-3 rounded-3">

            <form id="edit-cv-form" action="{{ route('pendaftaran.update.profile', $kandidat->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="row g-3">

                    <!-- NIK -->
                    <div class="col-md-6">
                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik', $kandidat->nik) }}" class="form-control"
                            required pattern="\d{16}">
                    </div>

                    <!-- Nama -->
                    <div class="col-md-6">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $kandidat->nama) }}" class="form-control"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $kandidat->email) }}"
                            class="form-control" required>
                    </div>

                    <!-- No WA -->
                    <div class="col-md-6">
                        <label class="form-label">No WA <span class="text-danger">*</span></label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $kandidat->no_wa) }}"
                            class="form-control" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div class="col-md-6">
                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class="form-control" required>
                            <option value="">-- Pilih Agama --</option>
                            @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'] as $agama)
                                <option value="{{ $agama }}"
                                    {{ old('agama', $kandidat->agama) == $agama ? 'selected' : '' }}>{{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status Kandidat <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach (['belum menikah', 'menikah', 'lajang'] as $status)
                                <option value="{{ $status }}"
                                    {{ old('status', $kandidat->status) == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Tempat Tanggal Lahir -->
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $kandidat->tempat_lahir) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tempat_tanggal_lahir"
                            value="{{ old('tempat_tanggal_lahir', $kandidat->tempat_tanggal_lahir) }}" class="form-control"
                            required>
                    </div>

                    <!-- Alamat -->
                    <div class="col-md-12">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $kandidat->alamat) }}</textarea>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div class="col-md-6">
                        <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                        <select name="pendidikan_terakhir" class="form-select" required>
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD"
                                {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>
                                SD</option>
                            <option value="SMP"
                                {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>
                                SMP</option>
                            <option value="SMA/SMK"
                                {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>
                                SMA / SMK</option>
                            <option value="D3"
                                {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>
                                D3</option>
                            <option value="S1"
                                {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>
                                S1</option>
                            <option value="S2"
                                {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>
                                S2</option>
                        </select>
                    </div>

                    <!-- Bidang SSW -->
                    <!-- BIDANG SSW - FIXED (TANPA bidang_ssw_id) -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Bidang SSW <span class="text-danger">*</span></label>

                        <?php
                        $bidang_options = ['Pengolahan makanan', 'Restoran', 'Pertanian', 'Kaigo (perawat)', 'Building cleaning', 'Driver', 'Lainnya'];
                        $bidangSsws = $kandidat->bidang_ssws ?? collect();
                        ?>

                        <div id="bidang-wrapper">

                            {{-- Loop data yang sudah ada - TANPA hidden input bidang_ssw_id --}}
                            @foreach ($bidangSsws as $bidang)
                                <div class="row mb-2 bidang-item align-items-center">
                                    <div class="col-10">
                                        <select name="bidang_ssw[]" class="form-select" required>
                                            <option value="">-- Pilih Bidang --</option>
                                            @foreach ($bidang_options as $option)
                                                <option value="{{ $option }}"
                                                    {{ $bidang->nama_bidang == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger remove-bidang"
                                            title="Hapus Bidang Ini">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Jika data kosong, tampilkan 1 baris --}}
                            @if ($bidangSsws->isEmpty())
                                <div class="row mb-2 bidang-item align-items-center">
                                    <div class="col-10">
                                        <select name="bidang_ssw[]" class="form-select" required>
                                            <option value="">-- Pilih Bidang --</option>
                                            @foreach ($bidang_options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger remove-bidang" title="Hapus Baris">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <button type="button" id="add-bidang" class="btn btn-primary mt-2">+ Tambah Bidang</button>
                    </div>

                    <!-- Cabang -->
                    <div class="col-md-12">
                        <label class="form-label">Cabang <span class="text-danger">*</span></label>
                        <select name="cabang_id" class="form-control" required>
                            @foreach (\App\Models\Cabang::all() as $cabang)
                                <option value="{{ $cabang->id }}"
                                    {{ old('cabang_id', $kandidat->cabang_id) == $cabang->id ? 'selected' : '' }}>
                                    {{ $cabang->nama_cabang }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- PROVINSI -->
                    <div class="col-md-6">
                        <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                        <select name="provinsi" id="provinsi" class="form-select" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>

                    <!-- KABUPATEN/KOTA -->
                    <div class="col-md-6">
                        <label class="form-label">Kabupaten / Kota <span class="text-danger">*</span></label>
                        <select name="kab_kota" id="kab_kota" class="form-select" required>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                        </select>
                    </div>

                    <!-- KECAMATAN -->
                    <div class="col-md-6">
                        <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                        <select name="kecamatan" id="kecamatan" class="form-select" required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    <!-- KELURAHAN -->
                    <div class="col-md-6">
                        <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                        <select name="kelurahan" id="kelurahan" class="form-select" required>
                            <option value="">-- Pilih Kelurahan --</option>
                        </select>
                    </div>

                    {{-- tambahakn --}}
                    <div class="col-md-6">
                        <label class="form-label">ID Prometric</label>
                        <input type="text" name="id_prometric" class="form-control"
                            value="{{ old('id_prometric', $kandidat->id_prometric) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password Prometric</label>
                        <input type="text" name="password_prometric" class="form-control"
                            value="{{ old('password_prometric', $kandidat->password_prometric) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pernah ke Jepang? <span class="text-danger">*</span></label>
                        <select name="pernah_ke_jepang" class="form-select" required>
                            <option value="Tidak"
                                {{ old('pernah_ke_jepang', $kandidat->pernah_ke_jepang) == 'Tidak' ? 'selected' : '' }}>
                                Tidak</option>
                            <option value="Ya"
                                {{ old('pernah_ke_jepang', $kandidat->pernah_ke_jepang) == 'Ya' ? 'selected' : '' }}>Ya
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Paspor (Opsional)</label>
                        <input type="file" name="paspor" class="form-control">

                        @if ($kandidat->paspor)
                            <small class="text-success d-block mt-1">
                                File saat ini:
                                <a href="{{ asset($kandidat->paspor) }}" target="_blank">Lihat Paspor</a>
                            </small>
                        @endif
                    </div>




                    <!-- FOTO -->
                    <div class="col-md-6">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="input-foto" accept="image/*"
                            onchange="previewFile(this, 'preview-foto')">

                        <div id="preview-foto" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview Foto" class="img-thumbnail" width="120">
                        </div>

                        @if ($kandidat->foto)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                <img src="{{ asset($kandidat->foto) }}" alt="Foto" class="img-thumbnail"
                                    width="120">
                            </div>
                        @endif
                    </div>

                    <!-- KK -->
                    <div class="col-md-6">
                        <label class="form-label">KK</label>
                        <input type="file" name="kk" class="form-control" id="input-kk"
                            onchange="previewFile(this, 'preview-kk')">

                        <div id="preview-kk" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview KK" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->kk)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->kk, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->kk) }}" alt="KK" class="img-thumbnail"
                                        width="120">
                                @else
                                    <a href="{{ asset($kandidat->kk) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- KTP -->
                    <div class="col-md-6">
                        <label class="form-label">KTP</label>
                        <input type="file" name="ktp" class="form-control" id="input-ktp"
                            onchange="previewFile(this, 'preview-ktp')">

                        <div id="preview-ktp" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview KTP" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->ktp)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->ktp, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->ktp) }}" alt="KTP" class="img-thumbnail"
                                        width="120">
                                @else
                                    <a href="{{ asset($kandidat->ktp) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Bukti Pelunasan -->
                    <div class="col-md-6">
                        <label class="form-label">Bukti Pelunasan</label>
                        <input type="file" name="bukti_pelunasan" class="form-control" id="input-bukti-pelunasan"
                            onchange="previewFile(this, 'preview-bukti-pelunasan')">

                        <div id="preview-bukti-pelunasan" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview Bukti Pelunasan" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->bukti_pelunasan)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->bukti_pelunasan, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->bukti_pelunasan) }}" alt="Bukti Pelunasan"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->bukti_pelunasan) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- AKTE -->
                    <div class="col-md-6">
                        <label class="form-label">Akte</label>
                        <input type="file" name="akte" class="form-control" id="input-akte"
                            onchange="previewFile(this, 'preview-akte')">

                        <div id="preview-akte" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview Akte" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->akte)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->akte, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->akte) }}" alt="Akte" class="img-thumbnail"
                                        width="120">
                                @else
                                    <a href="{{ asset($kandidat->akte) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- IJASAH -->
                    <div class="col-md-6">
                        <label class="form-label">Ijasah</label>
                        <input type="file" name="ijasah" class="form-control" id="input-ijasah"
                            onchange="previewFile(this, 'preview-ijasah')">

                        <div id="preview-ijasah" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview Ijasah" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->ijasah)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->ijasah, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->ijasah) }}" alt="Ijasah" class="img-thumbnail"
                                        width="120">
                                @else
                                    <a href="{{ asset($kandidat->ijasah) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- JFT -->
                    <div class="col-md-6">
                        <label class="form-label">Sertifikat JFT</label>
                        <input type="file" name="sertifikat_jft" class="form-control" id="input-jft"
                            onchange="previewFile(this, 'preview-jft')">

                        <div id="preview-jft" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview Sertifikat JFT" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->sertifikat_jft)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->sertifikat_jft, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->sertifikat_jft) }}" alt="Sertifikat JFT"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->sertifikat_jft) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- SSW -->
                    <div class="col-md-6">
                        <label class="form-label">Sertifikat SSW</label>
                        <input type="file" name="sertifikat_ssw" class="form-control" id="input-ssw"
                            onchange="previewFile(this, 'preview-ssw')">

                        <div id="preview-ssw" class="mt-2" style="display: none;">
                            <small class="text-muted d-block">Preview Baru:</small>
                            <img src="" alt="Preview Sertifikat SSW" class="img-thumbnail" width="120">
                            <a href="" target="_blank" class="btn btn-sm btn-info mt-1"
                                style="display: none;">Lihat Dokumen</a>
                        </div>

                        @if ($kandidat->sertifikat_ssw)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>
                                @if (in_array(pathinfo($kandidat->sertifikat_ssw, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->sertifikat_ssw) }}" alt="Sertifikat SSW"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->sertifikat_ssw) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" id="btnSubmit" class="btn btn-success py-2">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                        <a href="/" class="btn btn-outline-dark py-2">kembali</a>
                    </div>

                </div>
            </form>

        </div>

    </div>

    <!-- jQuery & SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('add-bidang').addEventListener('click', function() {

            let wrapper = document.getElementById('bidang-wrapper');

            // HTML baris baru
            let row = document.createElement('div');
            row.classList.add('row', 'mb-2', 'bidang-item');

            row.innerHTML = `
        <div class="col-10">
            <select name="bidang_ssw[]" class="form-select" required>
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
        <div class="col-2">
            <button type="button" class="btn btn-danger remove-bidang"><i class="bi bi-trash-fill"></i></button>
        </div>
    `;

            wrapper.appendChild(row);
        });

        // EVENT HAPUS BARIS
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-bidang')) {
                e.target.closest('.bidang-item').remove();
            }
        });
        // preview
        function previewFile(input, previewId) {
            const preview = document.getElementById(previewId);
            const img = preview.querySelector('img');
            const link = preview.querySelector('a');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Cek apakah file adalah gambar
                    if (file.type.match('image.*')) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                        if (link) link.style.display = 'none';
                    } else {
                        // Untuk file non-gambar (PDF, dll)
                        img.style.display = 'none';
                        if (link) {
                            link.href = e.target.result;
                            link.style.display = 'inline-block';
                            link.textContent = 'Lihat ' + file.name;
                        }
                    }
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // api wilayah
        document.addEventListener("DOMContentLoaded", async function() {

            const provinsiSelect = document.getElementById("provinsi");
            const kabupatenSelect = document.getElementById("kab_kota");
            const kecamatanSelect = document.getElementById("kecamatan");
            const kelurahanSelect = document.getElementById("kelurahan");

            // DATA LAMA (untuk EDIT)
            const oldProvinsi = "{{ $kandidat->provinsi }}";
            const oldKabupaten = "{{ $kandidat->kab_kota }}";
            const oldKecamatan = "{{ $kandidat->kecamatan }}";
            const oldKelurahan = "{{ $kandidat->kelurahan }}";

            // =====================================================
            // 1. LOAD PROVINSI
            // =====================================================
            const provinsiRes = await fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
            const provinsiData = await provinsiRes.json();

            provinsiData.forEach(p => {
                let opt = document.createElement("option");
                opt.value = p.name;
                opt.textContent = p.name;
                if (p.name === oldProvinsi) opt.selected = true;
                provinsiSelect.appendChild(opt);
            });

            // Jika edit → langsung load kabupaten
            if (oldProvinsi) loadKabupaten(oldProvinsi);

            // =====================================================
            // 2. LOAD KABUPATEN BERDASARKAN PROVINSI
            // =====================================================
            provinsiSelect.addEventListener("change", function() {
                loadKabupaten(this.value);
            });

            async function loadKabupaten(provName) {
                kabupatenSelect.innerHTML = `<option value="">-- Pilih Kabupaten/Kota --</option>`;
                kecamatanSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
                kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

                const prov = provinsiData.find(p => p.name === provName);
                if (!prov) return;

                const kabRes = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${prov.id}.json`);
                const kabData = await kabRes.json();

                kabData.forEach(k => {
                    let opt = document.createElement("option");
                    opt.value = k.name;
                    opt.textContent = k.name;
                    if (k.name === oldKabupaten) opt.selected = true;
                    kabupatenSelect.appendChild(opt);
                });

                if (oldKabupaten) loadKecamatan(oldKabupaten, kabData);
                kabupatenSelect.addEventListener("change", function() {
                    loadKecamatan(this.value, kabData);
                });
            }

            // =====================================================
            // 3. LOAD KECAMATAN
            // =====================================================
            async function loadKecamatan(kabName, kabData) {
                kecamatanSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
                kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

                const kab = kabData.find(k => k.name === kabName);
                if (!kab) return;

                const kecRes = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kab.id}.json`);
                const kecData = await kecRes.json();

                kecData.forEach(kc => {
                    let opt = document.createElement("option");
                    opt.value = kc.name;
                    opt.textContent = kc.name;
                    if (kc.name === oldKecamatan) opt.selected = true;
                    kecamatanSelect.appendChild(opt);
                });

                if (oldKecamatan) loadKelurahan(oldKecamatan, kecData);

                kecamatanSelect.addEventListener("change", function() {
                    loadKelurahan(this.value, kecData);
                });
            }

            // =====================================================
            // 4. LOAD KELURAHAN
            // =====================================================
            async function loadKelurahan(kecName, kecData) {
                kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

                const kec = kecData.find(k => k.name === kecName);
                if (!kec) return;

                const kelRes = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kec.id}.json`);
                const kelData = await kelRes.json();

                kelData.forEach(kl => {
                    let opt = document.createElement("option");
                    opt.value = kl.name;
                    opt.textContent = kl.name;
                    if (kl.name === oldKelurahan) opt.selected = true;
                    kelurahanSelect.appendChild(opt);
                });
            }

        });

        $(document).ready(function() {

            $('#btnSubmit').on('click', function(e) {
                e.preventDefault();
                let btn = $(this);
                let form = $('#edit-cv-form')[0];
                let formData = new FormData(form);

                btn.prop('disabled', true).html('Loading...');

                $.ajax({
                    url: "{{ route('pendaftaran.update.profile', $kandidat->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                        }).then(() => {
                            window.location.href = "/";
                        });
                    },

                    error: function(xhr) {
                        let msg = 'Terjadi kesalahan';
                        let errors = xhr.responseJSON?.errors;
                        if (errors) msg = Object.values(errors).flat().join("<br>");

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: msg
                        });
                    },

                    complete: function() {
                        btn.prop('disabled', false).html('Update Data');
                    }
                });
            });

        });
    </script>
@endsection
