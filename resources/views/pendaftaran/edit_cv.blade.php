@extends('layouts.app')

@section('title', 'Edit CV')

@section('content')

<div class=" mt-4">
    <h2 class="fw-bold mb-4">Edit CV</h2>

    <form id="edit-cv-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- ================================
                HALAMAN 1 — DATA AWAL
        ================================== -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                Halaman 1 — Data Awal
            </div>
            <div class="card-body">

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $cv->email) }}" required>
                </div>

                {{-- Cabang --}}
                <div class="mb-3">
                    <label class="form-label">Cabang</label>
                    <select name="cabang_Id" class="form-control" required>
                        @foreach ($cabangs as $c)
                            <option value="{{ $c->id }}"
                                {{ $cv->cabang_Id == $c->id ? 'selected' : '' }}>
                                {{ $c->nama_cabang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Batch --}}
                <div class="mb-3">
                    <label class="form-label">Batch</label>
                    <input type="text" name="batch" class="form-control"
                        value="{{ old('batch', $cv->batch) }}" required>
                </div>

                {{-- Nomor Telepon --}}
                <div class="mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="text" name="no_telepon" class="form-control"
                        value="{{ old('no_telepon', $cv->no_telepon) }}" required>
                </div>

                {{-- Nomor Orang Tua --}}
                <div class="mb-3">
                    <label class="form-label">No Orang Tua</label>
                    <input type="text" name="no_orang_tua" class="form-control"
                        value="{{ old('no_orang_tua', $cv->no_orang_tua) }}" required>
                </div>

                {{-- Bidang Sertifikasi --}}
                <div class="mb-3">
                    <label class="form-label">Bidang Sertifikasi</label>
                    <select name="bidang_sertifikasi" class="form-control">
                        @foreach ([
                            'Pengolahan Makanan',
                            'Pertanian',
                            'Kaigo (perawat)',
                            'Building Cleaning',
                            'Restoran',
                            'Driver',
                            'Hanya JFT'
                        ] as $item)
                            <option value="{{ $item }}"
                                {{ $cv->bidang_sertifikasi == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Bidang Sertifikasi Lainnya --}}
                <div class="mb-3">
                    <label class="form-label">Bidang Sertifikasi Lainnya</label>
                    <input type="text" name="bidang_sertifikasi_lainnya" class="form-control"
                        value="{{ old('bidang_sertifikasi_lainnya', $cv->bidang_sertifikasi_lainnya) }}">
                </div>

                {{-- Program Pertanian Kawakami --}}
                <div class="mb-3">
                    <label class="form-label">Program Pertanian Kawakami</label>
                    <select name="program_pertanian_kawakami" class="form-control">
                        <option value="Ya" {{ $cv->program_pertanian_kawakami == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ $cv->program_pertanian_kawakami == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                {{-- Upload Sertifikat --}}
                <div class="mb-3">
                    <label class="form-label">Upload Sertifikat</label>
                    <input type="file" name="sertifikat_files[]" multiple class="form-control">
                </div>

            </div>
        </div>





        <!-- ================================
                HALAMAN 2 — DATA DIRI
        ================================== -->
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white fw-bold">
                Halaman 2 — Data Diri
            </div>
            <div class="card-body">

                {{-- Nama Romaji --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap (Romaji)</label>
                    <input type="text" name="nama_lengkap_romaji" class="form-control"
                        value="{{ $cv->nama_lengkap_romaji }}" required>
                </div>

                {{-- Nama Katakana --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap (Katakana)</label>
                    <input type="text" name="nama_lengkap_katakana" class="form-control"
                        value="{{ $cv->nama_lengkap_katakana }}" required>
                </div>

                {{-- Nama Panggilan Romaji --}}
                <div class="mb-3">
                    <label class="form-label">Nama Panggilan (Romaji)</label>
                    <input type="text" name="nama_panggilan_romaji" class="form-control"
                        value="{{ $cv->nama_panggilan_romaji }}" required>
                </div>

                {{-- Nama Panggilan Katakana --}}
                <div class="mb-3">
                    <label class="form-label">Nama Panggilan (Katakana)</label>
                    <input type="text" name="nama_panggilan_katakana" class="form-control"
                        value="{{ $cv->nama_panggilan_katakana }}" required>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="男 (Laki-laki)" {{ $cv->jenis_kelamin == '男 (Laki-laki)' ? 'selected' : '' }}>男 (Laki-laki)</option>
                        <option value="女 (Perempuan)" {{ $cv->jenis_kelamin == '女 (Perempuan)' ? 'selected' : '' }}>女 (Perempuan)</option>
                    </select>
                </div>

                {{-- Agama --}}
                <div class="mb-3">
                    <label class="form-label">Agama</label>
                    <input type="text" name="agama" class="form-control" value="{{ $cv->agama }}">
                </div>

                {{-- Agama lainnya --}}
                <div class="mb-3">
                    <label class="form-label">Agama Lainnya</label>
                    <input type="text" name="agama_lainnya" class="form-control"
                        value="{{ $cv->agama_lainnya }}">
                </div>

                {{-- Tempat/Tanggal Lahir --}}
                <div class="mb-3">
                    <label class="form-label">Tempat/Tanggal Lahir</label>
                    <input type="text" name="tempat_tanggal_lahir" class="form-control"
                        value="{{ $cv->tempat_tanggal_lahir }}">
                </div>

                {{-- Usia --}}
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <input type="text" name="usia" class="form-control" value="{{ $cv->usia }}">
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" class="form-control">{{ $cv->alamat_lengkap }}</textarea>
                </div>

                {{-- Email Aktif --}}
                <div class="mb-3">
                    <label class="form-label">Email Aktif</label>
                    <input type="email" name="email_aktif" class="form-control" value="{{ $cv->email_aktif }}">
                </div>

                {{-- Status Perkawinan --}}
                <div class="mb-3">
                    <label class="form-label">Status Perkawinan</label>
                    <select name="status_perkawinan" class="form-control">
                        @foreach (['Sudah Menikah','Belum Menikah'] as $item)
                            <option value="{{ $item }}" {{ $cv->status_perkawinan == $item ? 'selected':'' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status Perkawinan Lainnya --}}
                <div class="mb-3">
                    <label class="form-label">Status Perkawinan Lainnya</label>
                    <input type="text" name="status_perkawinan_lainnya" class="form-control"
                        value="{{ $cv->status_perkawinan_lainnya }}">
                </div>

            </div>
        </div>



        <!-- ================================
                HALAMAN 3 — PEMBELAJARAN
        ================================== -->
        <div class="card shadow mb-4">
            <div class="card-header bg-warning fw-bold">
                Halaman 3 — Pembelajaran di Mendunia
            </div>
            <div class="card-body">

                {{-- Lama Belajar --}}
                <div class="mb-3">
                    <label class="form-label">Lama Belajar di Mendunia</label>
                    <input type="text" name="lama_belajar_di_mendunia" class="form-control"
                        value="{{ $cv->lama_belajar_di_mendunia }}">
                </div>

                {{-- Kemampuan Bahasa Jepang --}}
                <div class="mb-3">
                    <label class="form-label">Kemampuan Bahasa Jepang</label>
                    <input type="text" name="kemampuan_bahasa_jepang" class="form-control"
                        value="{{ $cv->kemampuan_bahasa_jepang }}">
                </div>

                {{-- Kemampuan Pemahaman SSW --}}
                <div class="mb-3">
                    <label class="form-label">Kemampuan Pemahaman SSW</label>
                    <input type="text" name="kemampuan_pemahaman_ssw" class="form-control"
                        value="{{ $cv->kemampuan_pemahaman_ssw }}">
                </div>

                {{-- Kelincahan Dalam Bekerja --}}
                <div class="mb-3">
                    <label class="form-label">Kelincahan Dalam Bekerja</label>
                    <input type="text" name="kelincahan_dalam_bekerja" class="form-control"
                        value="{{ $cv->kelincahan_dalam_bekerja }}">
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update CV</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>




{{-- JQuery + SweetAlert --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    $('#edit-cv-form').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: "{{ route('pendaftaran.cv.update', $cv->id) }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'CV berhasil diupdate!',
                    timer: 2000,
                    showConfirmButton: false,
                    didClose: () => window.location.href = "/dashboard"
                });
            },

            error: function (xhr) {
                let message = "Terjadi kesalahan!";

                if (xhr.responseJSON?.errors) {
                    message = Object.values(xhr.responseJSON.errors)
                        .map(err => err[0]).join("\n");
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: message
                });
            }
        });
    });

});
</script>

@endsection
