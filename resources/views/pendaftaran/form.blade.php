@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Form Pendaftaran</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- CEK JIKA SUDAH DAFTAR --}}
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

                {{-- ==================== ERROR VALIDATION ==================== --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ==================== ALERT SUCCESS ==================== --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- ==================== DATA PRIBADI ==================== --}}
                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">
                        <i class="bi bi-person-lines-fill me-2 text-primary"></i> Data Pribadi
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK"
                                value="{{ old('nik') }}" required pattern="\d{16}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_wa" placeholder="08xxxxxxxxxx"
                                value="{{ old('no_wa') }}" required pattern="08\d{8,12}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cabang <span class="text-danger">*</span></label>
                            <select class="form-select" name="cabang_id" required>
                                <option value="">-- Pilih Cabang --</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}"
                                        {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>
                                        {{ $cabang->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_daftar"
                                value="{{ old('tanggal_daftar') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        </div>

                        {{-- LOKASI --}}
                        <div class="col-md-6">
                            <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                            <select class="form-select" id="provinsi" name="provinsi" required></select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kab/Kota <span class="text-danger">*</span></label>
                            <select class="form-select" id="kab_kota" name="kab_kota" required></select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select class="form-select" id="kecamatan" name="kecamatan" required></select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <select class="form-select" id="kelurahan" name="kelurahan" required></select>
                        </div>
                    </div>
                </div>

                {{-- ==================== DOKUMEN ==================== --}}
                <div class="mb-4">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">
                        <i class="bi bi-folder-symlink me-2 text-primary"></i> Upload Dokumen Persyaratan
                    </h5>

                    <div class="row g-3">
                        @php
                            $dokumenFields = [
                                ['label' => 'Foto Diri', 'name' => 'foto'],
                                ['label' => 'Kartu Keluarga (KK)', 'name' => 'kk'],
                                ['label' => 'KTP', 'name' => 'ktp'],
                                ['label' => 'Bukti Pelunasan', 'name' => 'bukti_pelunasan'],
                                ['label' => 'Akte Kelahiran', 'name' => 'akte'],
                                ['label' => 'Ijazah Terakhir', 'name' => 'ijasah'],
                            ];
                        @endphp

                        @foreach ($dokumenFields as $dok)
                            <div class="col-md-4">
                                <label class="form-label">{{ $dok['label'] }} <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="{{ $dok['name'] }}" required>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="text-end mt-4">
                    <button type="reset" class="btn btn-secondary px-4 me-2">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button>
                    <button id="btnSubmit" type="submit" class="btn btn-warning px-4">
                        <i class="bi bi-send-check-fill me-1"></i> Daftar Sekarang
                    </button>
                </div>

            </form>
        @endif

    </div>
<script>
// =========================
// API WILAYAH INDONESIA
// =========================

document.addEventListener("DOMContentLoaded", function () {

    const provinsiSelect = document.getElementById("provinsi");
    const kabKotaSelect = document.getElementById("kab_kota");
    const kecamatanSelect = document.getElementById("kecamatan");
    const kelurahanSelect = document.getElementById("kelurahan");

    // Set placeholder awal
    provinsiSelect.innerHTML = `<option value="">-- Pilih Provinsi --</option>`;
    kabKotaSelect.innerHTML = `<option value="">-- Pilih Kab/Kota --</option>`;
    kecamatanSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
    kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

    // =========================
    // LOAD PROVINSI
    // =========================
    fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
        .then(res => res.json())
        .then(data => {
            data.forEach(p => {
                provinsiSelect.innerHTML += `<option value="${p.name}" data-id="${p.id}">${p.name}</option>`;
            });
        });


    // =========================
    // LOAD KABUPATEN / KOTA
    // =========================
    provinsiSelect.addEventListener("change", function () {

        kabKotaSelect.innerHTML = `<option value="">-- Pilih Kab/Kota --</option>`;
        kecamatanSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
        kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

        const provId = this.selectedOptions[0].dataset.id;
        if (!provId) return;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
            .then(res => res.json())
            .then(data => {
                data.forEach(k => {
                    kabKotaSelect.innerHTML += `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`;
                });
            });
    });


    // =========================
    // LOAD KECAMATAN
    // =========================
    kabKotaSelect.addEventListener("change", function () {

        kecamatanSelect.innerHTML = `<option value="">-- Pilih Kecamatan --</option>`;
        kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

        const kabId = this.selectedOptions[0].dataset.id;
        if (!kabId) return;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`)
            .then(res => res.json())
            .then(data => {
                data.forEach(c => {
                    kecamatanSelect.innerHTML += `<option value="${c.name}" data-id="${c.id}">${c.name}</option>`;
                });
            });
    });


    // =========================
    // LOAD KELURAHAN
    // =========================
    kecamatanSelect.addEventListener("change", function () {

        kelurahanSelect.innerHTML = `<option value="">-- Pilih Kelurahan --</option>`;

        const kecId = this.selectedOptions[0].dataset.id;
        if (!kecId) return;

        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
            .then(res => res.json())
            .then(data => {
                data.forEach(v => {
                    kelurahanSelect.innerHTML += `<option value="${v.name}">${v.name}</option>`;
                });
            });
    });

});
</script>
@endsection
