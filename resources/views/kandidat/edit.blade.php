@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Status Kandidat & Interview: {{ $kandidat->pendaftaran->nama ?? 'Kandidat' }}</h3>

    <form id="updateKandidatForm" method="POST">
        @csrf
        @method('PUT')

        <!-- Status Kandidat -->
        <div class="mb-3">
            <label for="status_kandidat" class="form-label">Status Kandidat</label>
            <select name="status_kandidat" id="status_kandidat" class="form-select" required>
                <option value="Job Matching" {{ $kandidat->status_kandidat == 'Job Matching' ? 'selected' : '' }}>Job Matching</option>
                <option value="Pending" {{ $kandidat->status_kandidat == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Interview" {{ $kandidat->status_kandidat == 'Interview' ? 'selected' : '' }}>Interview</option>
                <option value="Jadwalkan Interview Ulang" {{ $kandidat->status_kandidat == 'Jadwalkan Interview Ulang' ? 'selected' : '' }}>Jadwalkan Interview Ulang</option>
                <option value="Lulus interview" {{ $kandidat->status_kandidat == 'Lulus interview' ? 'selected' : '' }}>Lulus Interview</option>
                <option value="Gagal Interview" {{ $kandidat->status_kandidat == 'Gagal Interview' ? 'selected' : '' }}>Gagal Interview</option>
                <option value="Pemberkasan" {{ $kandidat->status_kandidat == 'Pemberkasan' ? 'selected' : '' }}>Pemberkasan</option>
                <option value="Berangkat" {{ $kandidat->status_kandidat == 'Berangkat' ? 'selected' : '' }}>Berangkat</option>
            </select>
        </div>

        <!-- Institusi / Penempatan -->
        <div class="mb-3">
            <label for="institusi_id" class="form-label">Penempatan / Institusi</label>
            <select name="institusi_id" id="institusi_id" class="form-select">
                <option value="">- Pilih Institusi -</option>
                @foreach ($institusis as $institusi)
                    <option value="{{ $institusi->id }}" {{ $kandidat->institusi_id == $institusi->id ? 'selected' : '' }}>
                        {{ $institusi->nama_perusahaan }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Catatan Interview -->
        <div class="mb-3">
            <label for="catatan_interview" class="form-label">Catatan Interview</label>
            <textarea name="catatan_interview" id="catatan_interview" class="form-control" rows="3">{{ old('catatan_interview', $kandidat->catatan_interview) }}</textarea>
        </div>

        <!-- Jadwal Interview -->
        <div class="mb-3">
            <label for="jadwal_interview" class="form-label">Jadwal Interview</label>
            <input type="date" name="jadwal_interview" id="jadwal_interview" class="form-control"
                value="{{ old('jadwal_interview', $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('Y-m-d') : '') }}">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" id="updateBtn" class="btn btn-primary">
                Update Status & Penempatan
            </button>
            <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">Kembali</a>
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
        $btn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memproses...');

        $.ajax({
            url: "{{ route('kandidat.update', $kandidat->id) }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $btn.prop("disabled", false);
                $btn.html(originalHtml);

                if(response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.message ?? "Data kandidat berhasil diupdate.",
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Redirect otomatis setelah 2 detik
                    if(response.redirect) {
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 2000);
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.status || "Gagal",
                        html: response.message ?? "Terjadi kesalahan saat update data."
                    });
                }
            },
            error: function(xhr) {
                $btn.prop("disabled", false);
                $btn.html(originalHtml);

                let errorMsg = "Terjadi kesalahan server.";
                if(xhr.responseJSON?.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join("<br>");
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
