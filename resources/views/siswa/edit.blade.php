@extends('layouts.app')

@section('content')
    <div class="mt-4">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Verifikasi Kandidat
                </li>
            </ol>
        </nav>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header  text-dark fw-bold">
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

                <form action="{{ route('siswa.update', $kandidat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="verifikasi" class="form-label fw-semibold">Status Verifikasi</label>
                        <select name="verifikasi" id="verifikasi" class="form-select">
                            <option value="menunggu" {{ $kandidat->verifikasi == 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="data belum lengkap"
                                {{ $kandidat->verifikasi == 'data belum lengkap' ? 'selected' : '' }}>Data Belum Lengkap
                            </option>
                            <option value="diterima" {{ $kandidat->verifikasi == 'diterima' ? 'selected' : '' }}>Diterima
                            </option>
                            <option value="ditolak" {{ $kandidat->verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="catatan_admin" class="form-label fw-semibold">Catatan Admin</label>
                        <textarea name="catatan_admin" id="catatan_admin" class="form-control rounded-3 shadow-sm" rows="4">{{ old('catatan_admin', $kandidat->catatan_admin) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#198754'
            });
        </script>
    @endif
@endsection
