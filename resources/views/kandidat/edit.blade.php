@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md border-none">
            <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    Kandidat
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    Edit
                </li>
            </ol>
        </nav>


        <form id="updateKandidatForm" method="POST">
            @csrf
            @method('PUT')

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
                                    {{ $institusi->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bidang_ssw" class="form-label">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahan" class="form-control">
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

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="submit" id="updateBtn" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Update Status & Penempatan
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
