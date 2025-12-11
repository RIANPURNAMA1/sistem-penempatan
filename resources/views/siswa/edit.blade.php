@extends('layouts.app')

@section('content')
<div class="mt-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">
                <i class="bi bi-person-lines-fill"></i> Verifikasi Kandidat
            </li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header fw-bold">
            <i class="bi bi-pencil-square me-2"></i> Edit Verifikasi & Catatan
        </div>
        <div class="card-body">

            <!-- SweetAlert Error -->
            @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal!',
                        html: `{!! implode('<br>', $errors->all()) !!}`,
                        confirmButtonColor: '#dc3545'
                    });
                </script>
            @endif

            <form id="verifikasiForm" action="{{ route('siswa.update', $kandidat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Info Kandidat -->
                <div class="alert alert-info mb-3">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nomor WA Kandidat:</strong> {{ $kandidat->no_wa ?? 'Tidak tersedia' }}
                </div>

                <div class="mb-3">
                    <label for="verifikasi" class="form-label fw-semibold">Status Verifikasi</label>
                    <select name="verifikasi" id="verifikasi" class="form-select">
                        <option value="menunggu" {{ $kandidat->verifikasi == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="data belum lengkap" {{ $kandidat->verifikasi == 'data belum lengkap' ? 'selected' : '' }}>Data Belum Lengkap</option>
                        <option value="diterima" {{ $kandidat->verifikasi == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $kandidat->verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="catatan_admin" class="form-label fw-semibold">Catatan Admin</label>
                    <textarea name="catatan_admin" id="catatan_admin" class="form-control rounded-3 shadow-sm" rows="4">{{ old('catatan_admin', $kandidat->catatan_admin) }}</textarea>
                </div>

                <!-- Input Link Grup WhatsApp -->
                <div class="mb-3" id="linkWaContainer" style="display: none;">
                    <label for="link_grup_wa" class="form-label fw-semibold">
                        <i class="bi bi-whatsapp text-success me-1"></i> Link Grup WhatsApp
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white">
                            <i class="bi bi-link-45deg"></i>
                        </span>
                        <input type="url" name="link_grup_wa" id="link_grup_wa" class="form-control" 
                               placeholder="https://chat.whatsapp.com/xxxxx">
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i> Link akan dikirim otomatis ke nomor WA kandidat
                    </small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" id="btnSubmit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Tambahkan CDN jQuery & SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Toggle tampilan input link WA ketika status verifikasi berubah
    $('#verifikasi').on('change', function() {
        if ($(this).val() === 'diterima') {
            $('#linkWaContainer').slideDown();
            $('#link_grup_wa').attr('required', true);
        } else {
            $('#linkWaContainer').slideUp();
            $('#link_grup_wa').attr('required', false);
            $('#link_grup_wa').val('');
        }
    });

    // Trigger saat halaman load jika status sudah diterima
    if ($('#verifikasi').val() === 'diterima') {
        $('#linkWaContainer').show();
        $('#link_grup_wa').attr('required', true);
    }

    $('#verifikasiForm').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = $('#btnSubmit');
        let linkWa = $('#link_grup_wa').val();
        let statusVerifikasi = $('#verifikasi').val();

        // Validasi link WA jika status diterima
        if (statusVerifikasi === 'diterima' && !linkWa) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Link Grup WhatsApp harus diisi untuk kandidat yang diterima!',
                confirmButtonColor: '#ffc107'
            });
            return;
        }

        // Tampilkan loading
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                let successMsg = response.message ?? 'Data verifikasi berhasil diperbarui!';
                
                // Tambahkan info pengiriman WA jika ada
                if (response.wa_sent) {
                    successMsg += '<br><small class="text-success"><i class="bi bi-check-circle"></i> Link grup telah dikirim ke WhatsApp kandidat!</small>';
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    html: successMsg,
                    confirmButtonColor: '#198754'
                }).then(() => {
                    if (statusVerifikasi === 'diterima') {
                        window.location.href = "{{ route('kandidat.data') }}";
                    } else {
                        location.reload();
                    }
                });
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let errorMsg = errors ? Object.values(errors).flat().join('<br>') : 'Terjadi kesalahan!';
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: errorMsg,
                    confirmButtonColor: '#dc3545'
                });
            },
            complete: function() {
                btn.prop('disabled', false);
                btn.html('<i class="bi bi-save"></i> Simpan Perubahan');
            }
        });
    });
});
</script>
@endsection