@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<div class="">

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

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    {{-- Ganti name="role_id" menjadi name="role" --}}
                    <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="">-- Pilih Role --</option>
                        {{-- $roles kini adalah array asosiatif string dari AdminController --}}
                        @foreach($roles as $key => $value)
                            <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Catatan: Hanya role Cabang yang bisa ditambahkan. Super Admin dan Kandidat tidak tersedia.</small>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary" id="btnSimpanAdmin"><i class="bi bi-save me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    
    // Fungsi untuk membersihkan dan menampilkan error inline
    function handleValidationErrors(errors) {
        // Bersihkan error sebelumnya
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        let errorHtml = '';
        $.each(errors, function(key, value) {
            errorHtml += `• ${value[0]}<br>`;
            // Tampilkan error inline
            $(`#${key}`).addClass('is-invalid').after(`<div class="invalid-feedback">${value[0]}</div>`);
        });
        
        // Tampilkan error di SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            html: errorHtml,
            confirmButtonText: 'Tutup'
        });
    }

    // Hapus class is-invalid saat user mengetik
    $('input, select').on('input change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });

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
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    handleValidationErrors(xhr.responseJSON.errors);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Terjadi kesalahan pada server.',
                        confirmButtonText: 'Tutup'
                    });
                }
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