@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md border-none">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    Kandidat
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    Edit
                </li>
            </ol>
        </nav>

        <form id="updateKandidatForm" method="POST">
            @csrf
            @method('PUT')

            <!-- Card 1: Status & Penempatan -->
            <div class="card shadow shadow-md rounded-4 p-3 mb-4">
                <h5 class="mb-3 text-primary"><i class="bi bi-pencil-square me-2"></i>Update Status Kandidat</h5>

                <div class="row g-3">
                    <!-- Status Kandidat -->
                    <div class="col-md-6">
                        <label for="status_kandidat" class="form-label fw-bold">Status Kandidat <span
                                class="text-danger">*</span></label>
                        <select name="status_kandidat" id="status_kandidat" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Job Matching"
                                {{ $kandidat->status_kandidat == 'Job Matching' ? 'selected' : '' }}>Job Matching</option>
                            <option value="Pending" {{ $kandidat->status_kandidat == 'Pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="lamar ke perusahaan"
                                {{ $kandidat->status_kandidat == 'lamar ke perusahaan' ? 'selected' : '' }}>Lamar ke
                                Perusahaan</option>
                            <option value="Interview" {{ $kandidat->status_kandidat == 'Interview' ? 'selected' : '' }}>
                                Interview</option>
                            <option value="Jadwalkan Interview Ulang"
                                {{ $kandidat->status_kandidat == 'Jadwalkan Interview Ulang' ? 'selected' : '' }}>Jadwalkan
                                Interview Ulang</option>
                            <option value="Lulus interview"
                                {{ $kandidat->status_kandidat == 'Lulus interview' ? 'selected' : '' }}>Lulus Interview
                            </option>
                            <option value="Gagal Interview"
                                {{ $kandidat->status_kandidat == 'Gagal Interview' ? 'selected' : '' }}>Gagal Interview
                            </option>
                            <option value="Pemberkasan" {{ $kandidat->status_kandidat == 'Pemberkasan' ? 'selected' : '' }}>
                                Pemberkasan</option>
                            <option value="Berangkat" {{ $kandidat->status_kandidat == 'Berangkat' ? 'selected' : '' }}>
                                Berangkat</option>
                            <option value="Ditolak" {{ $kandidat->status_kandidat == 'Ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    <!-- Institusi / Penempatan -->
                    <div class="col-md-6">
                        <label for="institusi_id" class="form-label fw-bold">Perusahaan Penempatan</label>
                        <select name="institusi_id" id="institusi_id" class="form-select">
                            <option value="">-- Pilih Perusahaan Penempatan --</option>
                            @foreach ($institusis as $institusi)
                                <option value="{{ $institusi->id }}"
                                    {{ $kandidat->institusi_id == $institusi->id ? 'selected' : '' }}>
                                    {{ $institusi->perusahaan_penempatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bidang SSW -->
                    <div class="col-12">
                        <label class="form-label fw-bold">Bidang SSW</label>
                        @if ($kandidat->pendaftaran && $kandidat->pendaftaran->bidang_ssws->count() > 0)
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($kandidat->pendaftaran->bidang_ssws as $bidang)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bidang_ssw"
                                            value="{{ $bidang->id }}" id="bidang_{{ $bidang->id }}"
                                            {{ old('bidang_ssw', optional($kandidat->bidang_ssws->first())->id) == $bidang->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bidang_{{ $bidang->id }}">
                                            {{ $bidang->nama_bidang }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">- Tidak ada bidang SSW -</p>
                        @endif
                    </div>

                    <!-- Nama Perusahaan -->
                    <div class="col-md-6">
                        <label for="nama_perusahaan" class="form-label fw-bold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control"
                            value="{{ old('nama_perusahaan', $kandidat->nama_perusahaan) }}"
                            placeholder="Masukkan nama perusahaan">
                    </div>

                    <!-- Detail Pekerjaan -->
                    <div class="col-md-6">
                        <label for="detail_pekerjaan" class="form-label fw-bold">Detail Pekerjaan</label>
                        <textarea name="detail_pekerjaan" id="detail_pekerjaan" class="form-control" rows="3"
                            placeholder="Jelaskan detail pekerjaan, posisi, atau bidang SSW">{{ old('detail_pekerjaan', $kandidat->detail_pekerjaan) }}</textarea>
                    </div>

                    <!-- Jadwal Interview -->
                    <div class="col-md-6">
                        <label for="jadwal_interview" class="form-label fw-bold">Jadwal Interview</label>
                        <input type="date" name="jadwal_interview" id="jadwal_interview" class="form-control"
                            value="{{ old('jadwal_interview', $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Catatan Interview -->
                    <div class="col-md-6">
                        <label for="catatan_interview" class="form-label fw-bold">Catatan Interview</label>
                        <textarea name="catatan_interview" id="catatan_interview" class="form-control" rows="3"
                            placeholder="Masukkan catatan interview...">{{ old('catatan_interview', $kandidat->catatan_interview) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Card 2: Data Interview & Mensetsu -->
            <div class="card shadow shadow-md rounded-4 p-3 mb-4">
                <h5 class="mb-3 text-primary"><i class="bi bi-calendar-check me-2"></i>Data Interview & Mensetsu</h5>

                <div class="row g-3">
                    <!-- TGL Setsumeikai / Ichijimensetsu -->
                    <div class="col-md-6">
                        <label for="tgl_setsumeikai_ichijimensetsu" class="form-label fw-bold">TGL Setsumeikai /
                            Ichijimensetsu</label>
                        <input type="date" name="tgl_setsumeikai_ichijimensetsu" id="tgl_setsumeikai_ichijimensetsu"
                            class="form-control"
                            value="{{ old('tgl_setsumeikai_ichijimensetsu', $kandidat->tgl_setsumeikai_ichijimensetsu ? \Carbon\Carbon::parse($kandidat->tgl_setsumeikai_ichijimensetsu)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- TGL Mensetsu 1 -->
                    <div class="col-md-6">
                        <label for="tgl_mensetsu" class="form-label fw-bold">TGL Mensetsu 1</label>
                        <input type="date" name="tgl_mensetsu" id="tgl_mensetsu" class="form-control"
                            value="{{ old('tgl_mensetsu', $kandidat->tgl_mensetsu ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- TGL Mensetsu 2 -->
                    <div class="col-md-6">
                        <label for="tgl_mensetsu2" class="form-label fw-bold">TGL Mensetsu 2</label>
                        <input type="date" name="tgl_mensetsu2" id="tgl_mensetsu2" class="form-control"
                            value="{{ old('tgl_mensetsu2', $kandidat->tgl_mensetsu2 ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu2)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Catatan Mensetsu -->
                    <div class="col-md-6">
                        <label for="catatan_mensetsu" class="form-label fw-bold">Catatan Mensetsu</label>
                        <textarea name="catatan_mensetsu" id="catatan_mensetsu" class="form-control" rows="3"
                            placeholder="Masukkan catatan mensetsu...">{{ old('catatan_mensetsu', $kandidat->catatan_mensetsu) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Card 3: Biaya & Administrasi -->
            <div class="card shadow shadow-md rounded-4 p-3 mb-4">
                <h5 class="mb-3 text-primary"><i class="bi bi-cash-stack me-2"></i>Biaya & Administrasi</h5>

                <div class="row g-3">
                    <!-- Biaya Pemberkasan -->
                    <div class="col-md-4">
                        <label for="biaya_pemberkasan" class="form-label fw-bold">Biaya Pemberkasan</label>
                        <input type="text" name="biaya_pemberkasan" id="biaya_pemberkasan" class="form-control"
                            value="{{ old('biaya_pemberkasan', $kandidat->biaya_pemberkasan) }}" 
                            placeholder="Masukkan biaya pemberkasan">
                    </div>

                    <!-- ADM Tahap 1 -->
                    <div class="col-md-4">
                        <label for="adm_tahap1" class="form-label fw-bold">ADM Tahap 1</label>
                        <input type="text" name="adm_tahap1" id="adm_tahap1" class="form-control"
                            value="{{ old('adm_tahap1', $kandidat->adm_tahap1) }}" 
                            placeholder="Masukkan biaya adm tahap 1">
                    </div>

                    <!-- ADM Tahap 2 -->
                    <div class="col-md-4">
                        <label for="adm_tahap2" class="form-label fw-bold">ADM Tahap 2</label>
                        <input type="text" name="adm_tahap2" id="adm_tahap2" class="form-control"
                            value="{{ old('adm_tahap2', $kandidat->adm_tahap2) }}" 
                            placeholder="Masukkan biaya adm tahap 2">
                    </div>
                </div>
            </div>

            <!-- Card 4: Tracking Dokumen & Proses -->
            <div class="card shadow shadow-md rounded-4 p-3 mb-4">
                <h5 class="mb-3 text-primary"><i class="bi bi-file-earmark-text me-2"></i>Tracking Dokumen & Proses</h5>

                <div class="row g-3">
                    <!-- Dokumen Dikirim (Soft File) -->
                    <div class="col-md-6">
                        <label for="dokumen_dikirim_soft_file" class="form-label fw-bold">Dokumen Dikirim (Soft
                            File)</label>
                        <input type="date" name="dokumen_dikirim_soft_file" id="dokumen_dikirim_soft_file"
                            class="form-control"
                            value="{{ old('dokumen_dikirim_soft_file', $kandidat->dokumen_dikirim_soft_file ? \Carbon\Carbon::parse($kandidat->dokumen_dikirim_soft_file)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Terbit Kontrak Kerja -->
                    <div class="col-md-6">
                        <label for="terbit_kontrak_kerja" class="form-label fw-bold">Terbit Kontrak Kerja</label>
                        <input type="date" name="terbit_kontrak_kerja" id="terbit_kontrak_kerja" class="form-control"
                            value="{{ old('terbit_kontrak_kerja', $kandidat->terbit_kontrak_kerja ? \Carbon\Carbon::parse($kandidat->terbit_kontrak_kerja)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Kontrak Dikirim ke TSK -->
                    <div class="col-md-6">
                        <label for="kontrak_dikirim_ke_tsk" class="form-label fw-bold">Kontrak Dikirim ke TSK</label>
                        <input type="date" name="kontrak_dikirim_ke_tsk" id="kontrak_dikirim_ke_tsk" class="form-control"
                            value="{{ old('kontrak_dikirim_ke_tsk', $kandidat->kontrak_dikirim_ke_tsk ? \Carbon\Carbon::parse($kandidat->kontrak_dikirim_ke_tsk)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Terbit Paspor -->
                    <div class="col-md-6">
                        <label for="terbit_paspor" class="form-label fw-bold">Terbit Paspor</label>
                        <input type="date" name="terbit_paspor" id="terbit_paspor" class="form-control"
                            value="{{ old('terbit_paspor', $kandidat->terbit_paspor ? \Carbon\Carbon::parse($kandidat->terbit_paspor)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Masuk Imigrasi Jepang -->
                    <div class="col-md-6">
                        <label for="masuk_imigrasi_jepang" class="form-label fw-bold">Masuk Imigrasi Jepang</label>
                        <input type="date" name="masuk_imigrasi_jepang" id="masuk_imigrasi_jepang" class="form-control"
                            value="{{ old('masuk_imigrasi_jepang', $kandidat->masuk_imigrasi_jepang ? \Carbon\Carbon::parse($kandidat->masuk_imigrasi_jepang)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- COE Terbit -->
                    <div class="col-md-6">
                        <label for="coe_terbit" class="form-label fw-bold">COE Terbit</label>
                        <input type="date" name="coe_terbit" id="coe_terbit" class="form-control"
                            value="{{ old('coe_terbit', $kandidat->coe_terbit ? \Carbon\Carbon::parse($kandidat->coe_terbit)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Pembuatan E-KTKLN -->
                    <div class="col-md-6">
                        <label for="pembuatan_ektkln" class="form-label fw-bold">Pembuatan E-KTKLN</label>
                        <input type="date" name="pembuatan_ektkln" id="pembuatan_ektkln" class="form-control"
                            value="{{ old('pembuatan_ektkln', $kandidat->pembuatan_ektkln ? \Carbon\Carbon::parse($kandidat->pembuatan_ektkln)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Dokumen Dikirim -->
                    <div class="col-md-6">
                        <label for="dokumen_dikirim" class="form-label fw-bold">Dokumen Dikirim</label>
                        <input type="date" name="dokumen_dikirim" id="dokumen_dikirim" class="form-control"
                            value="{{ old('dokumen_dikirim', $kandidat->dokumen_dikirim ? \Carbon\Carbon::parse($kandidat->dokumen_dikirim)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Visa -->
                    <div class="col-md-6">
                        <label for="visa" class="form-label fw-bold">Visa</label>
                        <input type="date" name="visa" id="visa" class="form-control"
                            value="{{ old('visa', $kandidat->visa ? \Carbon\Carbon::parse($kandidat->visa)->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Jadwal Penerbangan -->
                    <div class="col-md-6">
                        <label for="jadwal_penerbangan" class="form-label fw-bold">Jadwal Penerbangan</label>
                        <input type="date" name="jadwal_penerbangan" id="jadwal_penerbangan" class="form-control"
                            value="{{ old('jadwal_penerbangan', $kandidat->jadwal_penerbangan ? \Carbon\Carbon::parse($kandidat->jadwal_penerbangan)->format('Y-m-d') : '') }}">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="card shadow shadow-md rounded-4 p-3 mb-4">
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" id="updateBtn" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Update Data Kandidat
                    </button>
                    <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#updateKandidatForm").on("submit", function(e) {
                e.preventDefault();

                const $btn = $("#updateBtn");
                const originalHtml = $btn.html();
                $btn.prop("disabled", true);
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memproses...'
                );

                $.ajax({
                    url: "{{ route('kandidat.update', $kandidat->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $btn.prop("disabled", false);
                        $btn.html(originalHtml);

                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: response.message ??
                                    "Data kandidat berhasil diupdate.",
                                showConfirmButton: false,
                                timer: 2000
                            });

                            if (response.redirect) {
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 2000);
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: response.status || "Gagal",
                                html: response.message ??
                                    "Terjadi kesalahan saat update data."
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop("disabled", false);
                        $btn.html(originalHtml);

                        let errorMsg = "Terjadi kesalahan server.";

                        // Tangkap validasi 422 dari Laravel
                        if (xhr.status === 422) {
                            if (xhr.responseJSON?.errors) {
                                errorMsg = Object.values(xhr.responseJSON.errors).flat().join(
                                    "<br>");
                            } else if (xhr.responseJSON?.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                        } else if (xhr.responseJSON?.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Validasi Gagal",
                            html: errorMsg,
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script>
@endsection