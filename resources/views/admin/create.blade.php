@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<div class="">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-secondary"><i class="bi bi-house-door me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admins.index') }}" class="text-decoration-none text-secondary"><i class="bi bi-people-fill me-1"></i> Daftar Admin</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page"><i class="bi bi-plus-circle me-1"></i> Tambah Admin</li>
        </ol>
    </nav>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header">
            <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus-fill me-2"></i> Form Tambah Admin</h5>
        </div>
        <div class="card-body p-4">
            <form id="formTambahAdmin">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Catatan: Role kandidat atau super admin tidak bisa ditambahkan di sini.</small>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary" id="btnSimpanAdmin"><i class="bi bi-save me-1"></i> Simpan</button>
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
    $('#formTambahAdmin').submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let btn = $('#btnSimpanAdmin');

        // Spinner loading
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...');

        $.ajax({
            url: "{{ route('admins.store') }}",
            method: "POST",
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Admin baru berhasil ditambahkan.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ route('admins.index') }}";
                });
            },
            error: function(xhr) {
                let errors = '';
                if (xhr.responseJSON?.errors) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errors += `• ${value[0]}<br>`;
                    });
                } else {
                    errors = 'Terjadi kesalahan pada server.';
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    html: errors,
                    confirmButtonText: 'Tutup'
                });
            },
            complete: function() {
                btn.prop('disabled', false);
                btn.html('<i class="bi bi-save me-1"></i> Simpan');
            }
        });
    });
});
</script>
@endsection
