@extends('layouts.app')

@section('content')
    <div class=" mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Create Institusi
                </li>
            </ol>
        </nav>
        <div class="card shadow-sm rounded-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Institusi Baru
                </h5>
            </div>
            <div class="card-body">
                <!-- Tampilkan error validasi jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('institusi.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_institusi" class="form-label fw-semibold">Nama Institusi</label>
                            <input type="text" name="nama_institusi" id="nama_institusi" class="form-control"
                                placeholder="Contoh: LPK Sakura Jepang" required>
                        </div>

                        <div class="col-md-6">
                            <label for="penanggung_jawab" class="form-label fw-semibold">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control"
                                placeholder="Nama penanggung jawab" required>
                        </div>

                        <div class="col-md-6">
                            <label for="no_wa" class="form-label fw-semibold">Nomor WhatsApp</label>
                            <input type="text" name="no_wa" id="no_wa" class="form-control"
                                placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="col-md-3">
                            <label for="kuota" class="form-label fw-semibold">Kuota</label>
                            <input type="number" name="kuota" id="kuota" class="form-control"
                                placeholder="Jumlah kuota" required min="1">
                        </div>

                        <div class="col-md-12">
                            <label for="alamat" class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Alamat lengkap institusi"
                                required></textarea>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="/institusi" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2 me-1"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
