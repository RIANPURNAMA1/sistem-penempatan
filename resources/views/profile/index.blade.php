@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-secondary"><i
                        class="bi bi-house-door me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item active fw-semibold" aria-current="page"><i class="bi bi-person-circle me-1"></i> Profil
                Saya</li>
        </ol>
    </nav>
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i> Profil Saya</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf

                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>

                            <hr>

                            <!-- Password Lama -->
                            <div class="mb-3">
                                <label class="form-label">Password Lama</label>
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror" required>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
