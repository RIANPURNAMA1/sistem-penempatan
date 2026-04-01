@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, .form-label, .form-control, .btn, div, span, th, td {
        font-family: 'Inter', sans-serif !important;
        font-size: 13px !important;
    }
</style>

<div class="py-3">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
            <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li class="text-gray-700 font-medium">Profil Saya</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-4 border-b border-gray-100">
            <h5 class="font-semibold text-gray-800"><i class="bi bi-person-circle me-2 text-blue-600"></i>Profil Saya</h5>
        </div>
        <div class="p-4">
            <form id="formUpdateProfile">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="my-4 border-t border-gray-200"></div>

                <!-- Password Lama -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                    <input type="password" name="current_password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Isi jika ingin mengganti password">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Isi jika ingin mengganti password</p>
                </div>

                <!-- Password Baru -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="new_password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Masukkan password baru">
                        @error('new_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Konfirmasi password baru">
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#formUpdateProfile').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin memperbarui profil?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, perbarui',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('profile.updatePassword') }}",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            confirmButtonColor: '#2563eb'
                        }).then(() => {
                            window.location.href = "/";
                        });
                    },
                    error: function(xhr) {
                        let errorMsg = "Terjadi kesalahan.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMsg,
                            confirmButtonColor: '#2563eb'
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
