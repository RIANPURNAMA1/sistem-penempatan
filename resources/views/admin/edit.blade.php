@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
<div class="">

    <!-- Breadcrumb -->
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

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $admin->role_id == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Catatan: Role kandidat tidak bisa diubah di sini.</small>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-square me-1"></i> Perbarui</button>
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
    $('#editAdminForm').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var formData = form.serialize();

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
                var errors = xhr.responseJSON.errors;
                var errorHtml = '';
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
        });
    });
});
</script>
@endsection
