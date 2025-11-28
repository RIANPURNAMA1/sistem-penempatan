@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-secondary"><i class="bi bi-house-door me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admins.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-people-fill me-1"></i> Daftar Admin</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page"><i class="bi bi-pencil-square me-1"></i> Edit Admin</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header">
            <h5 class="mb-0 fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Form Edit Admin</h5>
        </div>
        <div class="card-body p-4">
            <form id="editAdminForm" action="{{ route('admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="">-- Pilih Role --</option>
                        {{-- $roles kini adalah array asosiatif string dari AdminController --}}
                        @foreach($roles as $key => $value)
                            {{-- $key dan $value sama-sama berisi string nama role (misal 'Cabang Cianjur Selatan Mendunia') --}}
                            <option value="{{ $key }}" {{ old('role', $admin->role) == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Catatan: Anda hanya dapat memilih role Cabang. Super Admin dan Kandidat tidak tersedia.</small>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i> Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Fungsi untuk menampilkan error dari validasi Laravel
    function displayErrors(errors) {
        let errorHtml = '';
        $.each(errors, function(key, value) {
            errorHtml += '• ' + value[0] + '<br>';
        });

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: errorHtml,
            confirmButtonColor: '#d33',
        });
    }
    
    // Hapus class is-invalid saat user mengetik
    $('input, select').on('input change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
    
    $('#editAdminForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

        // Bersihkan pesan error validasi sebelumnya dari form
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Admin berhasil diperbarui.',
                    confirmButtonColor: '#3085d6',
                }).then(() => {
                    window.location.href = "{{ route('admins.index') }}";
                });
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Unprocessable Entity (Validation Error)
                    var errors = xhr.responseJSON.errors;
                    
                    // Tampilkan error di SweetAlert2
                    displayErrors(errors);
                    
                    // Tampilkan error inline pada form (opsional)
                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid').after('<div class="invalid-feedback">' + value[0] + '</div>');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan server. Silakan coba lagi.',
                        confirmButtonColor: '#d33',
                    });
                }
            }
        });
    });
});
</script>
@endsection