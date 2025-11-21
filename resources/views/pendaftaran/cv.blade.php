@extends('layouts.app')

@section('title', 'Tambah CV')

@section('content')
    <div class="">

        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-person-lines-fill"></i> Form Data Diri
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="d-flex align-items-center mb-4">
            <div>

                <i class="bi bi-person-plus-fill me-2 text-primary fs-4"></i>
            </div>
            <div>
                <span class="fw-semibold fs-5">Isi Data Untuk CV</span>

            </div>
        </div>


        <form id="cvForm" enctype="multipart/form-data">
            @csrf

            <!-- Data Pribadi -->
            <div class="card mb-4">
                <div class="card-header">Data Pribadi</div>
                <div class="card-body">
                    <input type="text" name="nama_lengkap" class="form-control mb-2" placeholder="Nama Lengkap" required>
                    <input type="text" name="tempat_lahir" class="form-control mb-2" placeholder="Tempat Lahir" required>
                    <input type="date" name="tanggal_lahir" class="form-control mb-2" required>
                    <select name="jenis_kelamin" class="form-control mb-2" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <textarea name="alamat" class="form-control mb-2" placeholder="Alamat Lengkap" required></textarea>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="text" name="no_wa" class="form-control mb-2" placeholder="No WA" required>
                    <input type="number" name="tinggi_badan" class="form-control mb-2" placeholder="Tinggi Badan (cm)">
                    <input type="number" name="berat_badan" class="form-control mb-2" placeholder="Berat Badan (kg)">
                    <input type="file" name="foto" class="form-control mb-2">
                </div>
            </div>

            <!-- Pendidikan -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span>Pendidikan</span>
                    <button type="button" id="addPendidikan" class="btn btn-sm btn-success">Tambah</button>
                </div>
                <div class="card-body" id="pendidikanWrapper">
                    <div class="pendidikan-item mb-2">
                        <input type="text" name="pendidikan_nama[]" class="form-control mb-1"
                            placeholder="Nama Sekolah / Universitas" required>
                        <input type="text" name="pendidikan_tahun[]" class="form-control mb-1"
                            placeholder="Tahun Masuk - Lulus" required>
                        <input type="text" name="pendidikan_jurusan[]" class="form-control mb-1"
                            placeholder="Jurusan / Program Studi" required>
                    </div>
                </div>
            </div>

            <!-- Pengalaman -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span>Pengalaman Kerja</span>
                    <button type="button" id="addPengalaman" class="btn btn-sm btn-success">Tambah</button>
                </div>
                <div class="card-body" id="pengalamanWrapper">
                    <div class="pengalaman-item mb-2">
                        <input type="text" name="pengalaman_perusahaan[]" class="form-control mb-1"
                            placeholder="Nama Perusahaan / Instansi">
                        <input type="text" name="pengalaman_jabatan[]" class="form-control mb-1" placeholder="Jabatan">
                        <input type="text" name="pengalaman_periode[]" class="form-control mb-1" placeholder="Periode">
                    </div>
                </div>
            </div>

            <!-- Keahlian -->
            <div class="card mb-4">
                <div class="card-header">Keahlian</div>
                <div class="card-body">
                    <input type="text" name="keahlian" class="form-control" placeholder="Pisahkan dengan koma">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan CV</button>
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $('#addPendidikan').click(function() {
                let html = `<div class="pendidikan-item mb-2">
            <input type="text" name="pendidikan_nama[]" class="form-control mb-1" placeholder="Nama Sekolah / Universitas" required>
            <input type="text" name="pendidikan_tahun[]" class="form-control mb-1" placeholder="Tahun Masuk - Lulus" required>
            <input type="text" name="pendidikan_jurusan[]" class="form-control mb-1" placeholder="Jurusan / Program Studi" required>
        </div>`;
                $('#pendidikanWrapper').append(html);
            });

            $('#addPengalaman').click(function() {
                let html = `<div class="pengalaman-item mb-2">
            <input type="text" name="pengalaman_perusahaan[]" class="form-control mb-1" placeholder="Nama Perusahaan / Instansi">
            <input type="text" name="pengalaman_jabatan[]" class="form-control mb-1" placeholder="Jabatan">
            <input type="text" name="pengalaman_periode[]" class="form-control mb-1" placeholder="Periode">
        </div>`;
                $('#pengalamanWrapper').append(html);
            });

            $('#cvForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('pendaftaran.cv.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data CV berhasil disimpan.',
                        });
                        $('#cvForm')[0].reset();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let msg = '';
                        if (errors) {
                            $.each(errors, function(key, val) {
                                msg += val[0] + '\n';
                            });
                        } else {
                            msg = 'Terjadi kesalahan pada server.';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: msg,
                        });
                    }
                });
            });
        });
    </script>
@endsection
