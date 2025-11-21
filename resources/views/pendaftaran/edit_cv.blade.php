@extends('layouts.app')

@section('title', 'Edit CV')

@section('content')
    <div class="container mt-4">
        <h2>Edit CV: {{ $cv->nama_lengkap }}</h2>

        <form id="edit-cv-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Lengkap --}}
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                    value="{{ old('nama_lengkap', $cv->nama_lengkap) }}" required>
            </div>

            {{-- Tempat Lahir --}}
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                    value="{{ old('tempat_lahir', $cv->tempat_lahir) }}" required>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                    value="{{ old('tanggal_lahir', $cv->tanggal_lahir->format('Y-m-d')) }}" required>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" {{ $cv->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $cv->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat', $cv->alamat) }}</textarea>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $cv->email) }}" required>
            </div>

            {{-- No WA --}}
            <div class="mb-3">
                <label for="no_wa" class="form-label">No WA</label>
                <input type="text" name="no_wa" id="no_wa" class="form-control"
                    value="{{ old('no_wa', $cv->no_wa) }}" required>
            </div>

            {{-- Keahlian --}}
            <div class="mb-3">
                <label for="keahlian" class="form-label">Keahlian</label>
                <input type="text" name="keahlian" class="form-control" value="{{ old('keahlian', $cv->keahlian) }}">
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label for="foto" class="form-label">Foto (jpg/jpeg/png)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <hr>
            <h4>Pendidikan</h4>
            @foreach ($cv->pendidikan as $index => $p)
                <div class="mb-3 border p-2">
                    <label>Nama Sekolah / Universitas</label>
                    <input type="text" name="pendidikan_nama[]" class="form-control"
                        value="{{ old('pendidikan_nama.' . $index, $p->nama) }}" required>
                    <label>Tahun</label>
                    <input type="text" name="pendidikan_tahun[]" class="form-control"
                        value="{{ old('pendidikan_tahun.' . $index, $p->tahun) }}" required>
                    <label>Jurusan</label>
                    <input type="text" name="pendidikan_jurusan[]" class="form-control"
                        value="{{ old('pendidikan_jurusan.' . $index, $p->jurusan) }}" required>
                </div>
            @endforeach

            <hr>
            <h4>Pengalaman</h4>
            @foreach ($cv->pengalamans as $index => $pengalaman)
                <div class="mb-3 border p-2">
                    <label>Perusahaan</label>
                    <input type="text" name="pengalaman_perusahaan[]" class="form-control"
                        value="{{ old('pengalaman_perusahaan.' . $index, $pengalaman->perusahaan) }}">
                    <label>Jabatan</label>
                    <input type="text" name="pengalaman_jabatan[]" class="form-control"
                        value="{{ old('pengalaman_jabatan.' . $index, $pengalaman->jabatan) }}">
                    <label>Periode</label>
                    <input type="text" name="pengalaman_periode[]" class="form-control"
                        value="{{ old('pengalaman_periode.' . $index, $pengalaman->periode) }}">
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update CV</button>
            <a href="/" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    {{-- JQuery & SweetAlert2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#edit-cv-form').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData.append('_method', 'PUT');
                let $btn = $(this).find('button[type="submit"]');

                $.ajax({
                    url: "{{ route('pendaftaran.cv.update', $cv->id) }}",
                    type: 'POST', // POST + _method=PUT
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    beforeSend: function() {
                        $btn.prop('disabled', true);
                        $btn.html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                            );
                    },
                    success: function(response) {
                        $btn.prop('disabled', false).text('Update CV');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'CV berhasil diupdate!',
                            timer: 2000,
                            showConfirmButton: false,
                            didClose: () => {
                                // redirect ke route yang diinginkan
                                window.location.href =
                                    "/pendaftaran/cv";
                            }
                        });
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).text('Update CV');
                        let errors = xhr.responseJSON?.errors;
                        let message = '';
                        if (errors) {
                            $.each(errors, function(key, value) {
                                message += value[0] + '\n';
                            });
                        } else {
                            message = 'Terjadi kesalahan!';
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
