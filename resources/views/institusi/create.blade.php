@extends('layouts.app')

@section('content')
<div class="mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                <i class="bi bi-person-lines-fill"></i> Create Perusahaan
            </li>
        </ol>
    </nav>

    <div class="card shadow-sm rounded-4">
        <div class="card-header text-white">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-plus-circle me-2"></i> Tambah Perusahaan Baru
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('institusi.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_perusahaan" class="form-label fw-semibold">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control"
                            placeholder="Contoh: PT Sakura Jepang" required>
                    </div>

                    <div class="col-md-6">
                        <label for="bidang_pekerjaan" class="form-label fw-semibold">Bidang Pekerjaan</label>
                        <input type="text" name="bidang_pekerjaan" id="bidang_pekerjaan" class="form-control"
                            placeholder="Contoh: IT, Produksi, Administrasi">
                    </div>

                    <div class="col-md-6">
                        <label for="perusahaan_penempatan" class="form-label fw-semibold">Perusahaan Penempatan</label>
                        <input type="text" name="perusahaan_penempatan" id="perusahaan_penempatan" class="form-control"
                            placeholder="Nama perusahaan penempatan">
                    </div>

                    <div class="col-md-3">
                        <label for="kuota" class="form-label fw-semibold">Kuota</label>
                        <input type="number" name="kuota" id="kuota" class="form-control"
                            placeholder="Jumlah kuota" min="1">
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('institusi.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save2 me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
<script>
    let errorMessages = '';
    @foreach ($errors->all() as $error)
        errorMessages += '• {{ $error }}<br>';
    @endforeach

    Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal',
        html: errorMessages,
        confirmButtonColor: '#3085d6'
    });
</script>
@endif
@endsection
