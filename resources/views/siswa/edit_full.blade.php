@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
    <div class="">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow-md">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Edit Pendaftaran
                </li>
            </ol>
        </nav>

        <div class="card shadow-md p-3 rounded-3">

            <form id="edit-cv-form" action="{{ route('pendaftaran.update.full', $kandidat->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <!-- NIK -->
                    <div class="col-md-6">
                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik', $kandidat->nik) }}" class="form-control"
                            required pattern="\d{16}">
                    </div>

                    <!-- Nama -->
                    <div class="col-md-6">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $kandidat->nama) }}" class="form-control"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $kandidat->email) }}"
                            class="form-control" required>
                    </div>

                    <!-- No WA -->
                    <div class="col-md-6">
                        <label class="form-label">No WA <span class="text-danger">*</span></label>
                        <input type="text" name="no_wa" value="{{ old('no_wa', $kandidat->no_wa) }}"
                            class="form-control" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div class="col-md-6">
                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class="form-control" required>
                            <option value="">-- Pilih Agama --</option>
                            @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'] as $agama)
                                <option value="{{ $agama }}"
                                    {{ old('agama', $kandidat->agama) == $agama ? 'selected' : '' }}>{{ $agama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status Kandidat <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach (['belum menikah', 'menikah', 'lajang'] as $status)
                                <option value="{{ $status }}"
                                    {{ old('status', $kandidat->status) == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Daftar -->
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_daftar"
                            value="{{ old('tanggal_daftar', $kandidat->tanggal_daftar) }}" class="form-control" required>
                    </div>

                    <!-- Tempat Tanggal Lahir -->
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir', $kandidat->tempat_lahir) }}" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="tempat_tanggal_lahir"
                            value="{{ old('tempat_tanggal_lahir', $kandidat->tempat_tanggal_lahir) }}" class="form-control"
                            required>
                    </div>

                    <!-- Alamat -->
                    <div class="col-md-12">
                        <label class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $kandidat->alamat) }}</textarea>
                    </div>

                    <!-- Cabang -->
                    <div class="col-md-12">
                        <label class="form-label">Cabang <span class="text-danger">*</span></label>
                        <select name="cabang_id" class="form-control" required>
                            @foreach (\App\Models\Cabang::all() as $cabang)
                                <option value="{{ $cabang->id }}"
                                    {{ old('cabang_id', $kandidat->cabang_id) == $cabang->id ? 'selected' : '' }}>
                                    {{ $cabang->nama_cabang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- FOTO -->
                    <div class="col-md-6">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">

                        @if ($kandidat->foto)
                            <div class="mt-2">

                     
                                    <img src="{{ asset($kandidat->foto) }}" alt="Foto"
                                        class="img-thumbnail" width="120">

                            </div>
                        @endif
                    </div>

                    <!-- KK -->
                    <div class="col-md-6">
                        <label class="form-label">KK</label>
                        <input type="file" name="kk" class="form-control">

                        @if ($kandidat->kk)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->kk, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->kk) }}" alt="KK"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset( $kandidat->kk) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- KTP -->
                    <div class="col-md-6">
                        <label class="form-label">KTP</label>
                        <input type="file" name="ktp" class="form-control">

                        @if ($kandidat->ktp)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->ktp, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->ktp) }}" alt="KTP"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset( $kandidat->ktp) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- BUkti Pelunasan -->
                    <div class="col-md-6">
                        <label class="form-label">Bukti Pelunasan</label>
                        <input type="file" name="bukti_pelunasan" class="form-control">

                        @if ($kandidat->bukti_pelunasan)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->bukti_pelunasan, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->bukti_pelunasan) }}"
                                        alt="Bukti Pelunasan" class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->bukti_pelunasan) }}"
                                        target="_blank" class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- AKTE -->
                    <div class="col-md-6">
                        <label class="form-label">Akte</label>
                        <input type="file" name="akte" class="form-control">

                        @if ($kandidat->akte)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->akte, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset( $kandidat->akte) }}" alt="Akte"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->akte) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- IJASAH -->
                    <div class="col-md-6">
                        <label class="form-label">Ijasah</label>
                        <input type="file" name="ijasah" class="form-control">

                        @if ($kandidat->ijasah)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->ijasah, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset( $kandidat->ijasah) }}" alt="Ijasah"
                                        class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->ijasah) }}" target="_blank"
                                        class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- JFT -->
                    <div class="col-md-6">
                        <label class="form-label">Sertifikat JFT</label>
                        <input type="file" name="sertifikat_jft" class="form-control">

                        @if ($kandidat->sertifikat_jft)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->sertifikat_jft, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->sertifikat_jft) }}"
                                        alt="Sertifikat JFT" class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->sertifikat_jft) }}"
                                        target="_blank" class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- SSW -->
                    <div class="col-md-6">
                        <label class="form-label">Sertifikat SSW</label>
                        <input type="file" name="sertifikat_ssw" class="form-control">

                        @if ($kandidat->sertifikat_ssw)
                            <div class="mt-2">
                                <small class="text-muted d-block">Preview Saat Ini:</small>

                                @if (in_array(pathinfo($kandidat->sertifikat_ssw, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                    <img src="{{ asset($kandidat->sertifikat_ssw) }}"
                                        alt="Sertifikat SSW" class="img-thumbnail" width="120">
                                @else
                                    <a href="{{ asset($kandidat->sertifikat_ssw) }}"
                                        target="_blank" class="btn btn-sm btn-warning mt-1">
                                        Lihat Dokumen
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" id="btnSubmit" class="btn btn-success py-2">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                        <a href="/siswa" class="btn btn-primary py-2">kembali</a>
                    </div>

                </div>
            </form>

        </div>

    </div>

    <!-- jQuery & SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            $('#btnSubmit').on('click', function(e) {
                e.preventDefault();
                let btn = $(this);
                let form = $('#edit-cv-form')[0];
                let formData = new FormData(form);

                btn.prop('disabled', true).html('Loading...');

                $.ajax({
                    url: "{{ route('pendaftaran.update.full', $kandidat->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                        }).then(() => {
                            window.location.href = "{{ route('siswa.index') }}";
                        });
                    },

                    error: function(xhr) {
                        let msg = 'Terjadi kesalahan';
                        let errors = xhr.responseJSON?.errors;
                        if (errors) msg = Object.values(errors).flat().join("<br>");

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: msg
                        });
                    },

                    complete: function() {
                        btn.prop('disabled', false).html('Update Data');
                    }
                });
            });

        });
    </script>
@endsection
