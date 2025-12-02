@extends('layouts.app')
@section('title', 'Edit Cabang')

@section('content')
<div class="py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/dashboard') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('cabang.index') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-building me-1"></i> Daftar Cabang
                </a>
            </li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page">
                <i class="bi bi-pencil-square me-1"></i> Edit Cabang
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-building text-warning me-2"></i> Edit Cabang
        </h2>
        <p class="text-muted fst-italic">Ubah data cabang sesuai kebutuhan pada form berikut.</p>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <form id="formEditCabang">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_cabang" class="form-label fw-semibold">Nama Cabang</label>
                    <input type="text" name="nama_cabang" class="form-control" id="nama_cabang"
                        value="{{ old('nama_cabang', $cabang->nama_cabang) }}"
                        placeholder="Masukkan nama cabang" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3"
                        placeholder="Masukkan alamat cabang" required>{{ old('alamat', $cabang->alamat) }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success" id="btnSubmit">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('cabang.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery & SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#formEditCabang').submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = $('#btnSubmit');

        // Tambah spinner loading
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...');

        $.ajax({
            url: "{{ route('cabang.update', $cabang->id) }}",
            method: "POST",
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data cabang berhasil diperbarui.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ route('cabang.index') }}";
                });
            },
            error: function(xhr) {
                let errors = '';
                if (xhr.responseJSON?.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errors += `- ${value[0]}\n`;
                    });
                } else {
                    errors = 'Terjadi kesalahan pada server.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    html: errors.replace(/\n/g, '<br>'),
                    confirmButtonText: 'Tutup'
                });
            },
            complete: function() {
                btn.prop('disabled', false);
                btn.html('<i class="bi bi-save me-1"></i> Simpan Perubahan');
            }
        });
    });
});
</script>
@endsection
