@extends('layouts.app')
@section('content')
    <div class="">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 20000,
                    showConfirmButton: false
                });
            </script>
        @endif
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Form Pendaftaran Kandidat
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <h4 class="fw-bold mb-3">
            <i class="bi bi-person-plus-fill me-2 text-primary"></i> Formulir Pendaftaran Kandidat
        </h4>

        <p class="text-muted mb-4">
            Silakan lengkapi data diri dan dokumen pendukung dengan benar untuk melanjutkan proses pendaftaran.
        </p>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="p-3">
                    @csrf
                    @method('POST')
                    <!-- ==================== SECTION: DATA PRIBADI ==================== -->
                    <div class="mb-4">
                        <h5 class="fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i> Data Pribadi
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="nama"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="contoh@email.com" required>
                            </div>

                            <div class="col-md-6">
                                <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control" id="no_wa" name="no_wa"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>

                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="cabang_id" class="form-label">Cabang</label>
                                <select class="form-select" id="cabang_id" name="cabang_id" required>
                                    <option value="">-- Pilih Cabang --</option>
                                    @foreach ($cabangs as $cabang)
                                        <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-6">
                                <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                                <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar"
                                    required>
                            </div>

                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                                    required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== SECTION: UPLOAD DOKUMEN ==================== -->
                    <div class="mb-4">
                        <h5 class="fw-bold border-bottom pb-2 mb-3">
                            <i class="bi bi-folder-symlink me-2 text-primary"></i> Upload Dokumen Persyaratan
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Foto Diri</label>
                                <input type="file" class="form-control" name="foto" accept="image/*" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Kartu Keluarga (KK)</label>
                                <input type="file" class="form-control" name="kk" accept="image/*,application/pdf"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Kartu Tanda Penduduk (KTP)</label>
                                <input type="file" class="form-control" name="ktp" accept="image/*,application/pdf"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Bukti Pelunasan</label>
                                <input type="file" class="form-control" name="bukti_pelunasan"
                                    accept="image/*,application/pdf" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Akte Kelahiran</label>
                                <input type="file" class="form-control" name="akte"
                                    accept="image/*,application/pdf" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Ijazah Terakhir</label>
                                <input type="file" class="form-control" name="izasah"
                                    accept="image/*,application/pdf" required>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== SECTION: TOMBOL SUBMIT ==================== -->
                    <div class="text-end mt-4">
                        <button type="reset" class="btn btn-secondary px-4 me-2">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-send-check-fill me-1"></i> Daftar Sekarang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
