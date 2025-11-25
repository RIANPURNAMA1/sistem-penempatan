@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
    <div class="container">
        <h3>Edit Pendaftaran</h3>

        <form id="form-pendaftaran" enctype="multipart/form-data"> @csrf @method('PUT')
            <!-- NIK -->
            <div class="mb-3">
                <label>NIK <span class="text-danger">*</span></label>
                <input type="text" name="nik" value="{{ old('nik', $kandidat->nik) }}" class="form-control" required
                    pattern="\d{16}">
            </div>

            <!-- Nama -->
            <div class="mb-3">
                <label>Nama <span class="text-danger">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $kandidat->nama) }}" class="form-control"
                    required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" name="email" value="{{ old('email', $kandidat->email) }}" class="form-control"
                    required>
            </div>

            <!-- No WA -->
            <div class="mb-3">
                <label>No WA <span class="text-danger">*</span></label>
                <input type="text" name="no_wa" value="{{ old('no_wa', $kandidat->no_wa) }}" class="form-control"
                    required pattern="08\d{8,12}">
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <!-- Agama -->
            <div class="mb-3">
                <label>Agama <span class="text-danger">*</span></label>
                <select name="agama" class="form-control" required>
                    <option value="">-- Pilih Agama --</option>
                    @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'] as $agama)
                        <option value="{{ $agama }}"
                            {{ old('agama', $kandidat->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label>Status Kandidat <span class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    @foreach (['belum menikah', 'menikah', 'lajang'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $kandidat->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Daftar -->
            <div class="mb-3">
                <label>Tanggal Daftar <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_daftar" value="{{ old('tanggal_daftar', $kandidat->tanggal_daftar) }}"
                    class="form-control" required>
            </div>

            <!-- Tempat & Tanggal Lahir -->
            <div class="mb-3">
                <label>Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $kandidat->tempat_lahir) }}"
                    class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tempat_tanggal_lahir"
                    value="{{ old('tempat_tanggal_lahir', $kandidat->tempat_tanggal_lahir) }}" class="form-control"
                    required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label>Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat', $kandidat->alamat) }}</textarea>
            </div>

            <!-- Wilayah Dropdown -->
            <div class="mb-3">
                <label>Provinsi <span class="text-danger">*</span></label>
                <select name="provinsi" id="provinsi" class="form-control" required></select>
            </div>
            <div class="mb-3">
                <label>Kab/Kota <span class="text-danger">*</span></label>
                <select name="kab_kota" id="kab_kota" class="form-control" required></select>
            </div>
            <div class="mb-3">
                <label>Kecamatan <span class="text-danger">*</span></label>
                <select name="kecamatan" id="kecamatan" class="form-control" required></select>
            </div>
            <div class="mb-3">
                <label>Kelurahan <span class="text-danger">*</span></label>
                <select name="kelurahan" id="kelurahan" class="form-control" required></select>
            </div>

            <!-- Cabang -->
            <div class="mb-3">
                <label>Cabang <span class="text-danger">*</span></label>
                <select name="cabang_id" class="form-control" required>
                    @foreach (\App\Models\Cabang::all() as $cabang)
                        <option value="{{ $cabang->id }}"
                            {{ old('cabang_id', $kandidat->cabang_id) == $cabang->id ? 'selected' : '' }}>
                            {{ $cabang->nama_cabang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Upload file -->
            <div class="mb-3">
                <label>Foto (kosongkan jika tidak diganti)</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="mb-3">
                <label>KK</label>
                <input type="file" name="kk" class="form-control">
            </div>
            <div class="mb-3">
                <label>KTP</label>
                <input type="file" name="ktp" class="form-control">
            </div>
            <div class="mb-3">
                <label>Bukti Pelunasan</label>
                <input type="file" name="bukti_pelunasan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Akte</label>
                <input type="file" name="akte" class="form-control">
            </div>
            <div class="mb-3">
                <label>Ijasah</label>
                <input type="file" name="ijasah" class="form-control">
            </div>
            <div class="mb-3">
                <label>Sertifikat JFT</label>
                <input type="file" name="sertifikat_jft" class="form-control">
            </div>
            <div class="mb-3">
                <label>Sertifikat SSW</label>
                <input type="file" name="sertifikat_ssw" class="form-control">
            </div>

            <button type="submit" id="btnSubmit" class="btn btn-primary">Update Data</button>
        </form>
    </div>

    <!-- jQuery & SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Wilayah API
            let provSelected = "{{ old('provinsi', $kandidat->provinsi) }}";
            let kabSelected = "{{ old('kab_kota', $kandidat->kab_kota) }}";
            let kecSelected = "{{ old('kecamatan', $kandidat->kecamatan) }}";
            let kelSelected = "{{ old('kelurahan', $kandidat->kelurahan) }}";

            function loadProvinces() {
                $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', function(provinces) {
                    $('#provinsi').append('<option value="">Pilih Provinsi</option>');
                    $.each(provinces, function(i, prov) {
                        let sel = prov.id == provSelected ? 'selected' : '';
                        $('#provinsi').append('<option value="' + prov.id + '" ' + sel + '>' + prov
                            .name + '</option>');
                    });
                    if (provSelected) $('#provinsi').trigger('change');
                });
            }

            function loadRegencies(provId) {
                $('#kab_kota').empty().append('<option value="">Pilih Kab/Kota</option>');
                $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                if (provId) {
                    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provId + '.json',
                        function(kabs) {
                            $.each(kabs, function(i, kab) {
                                let sel = kab.id == kabSelected ? 'selected' : '';
                                $('#kab_kota').append('<option value="' + kab.id + '" ' + sel + '>' +
                                    kab.name + '</option>');
                            });
                            if (kabSelected) $('#kab_kota').trigger('change');
                        });
                }
            }

            function loadDistricts(kabId) {
                $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                if (kabId) {
                    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + kabId + '.json',
                        function(kecs) {
                            $.each(kecs, function(i, kec) {
                                let sel = kec.id == kecSelected ? 'selected' : '';
                                $('#kecamatan').append('<option value="' + kec.id + '" ' + sel + '>' +
                                    kec.name + '</option>');
                            });
                            if (kecSelected) $('#kecamatan').trigger('change');
                        });
                }
            }

            function loadVillages(kecId) {
                $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                if (kecId) {
                    $.getJSON('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + kecId + '.json',
                        function(vills) {
                            $.each(vills, function(i, kel) {
                                let sel = kel.id == kelSelected ? 'selected' : '';
                                $('#kelurahan').append('<option value="' + kel.id + '" ' + sel + '>' +
                                    kel.name + '</option>');
                            });
                        });
                }
            }

            $('#provinsi').on('change', function() {
                loadRegencies($(this).val());
            });
            $('#kab_kota').on('change', function() {
                loadDistricts($(this).val());
            });
            $('#kecamatan').on('change', function() {
                loadVillages($(this).val());
            });

            loadProvinces();

            $('#btnSubmit').on('click', function(e) {
                e.preventDefault();
                let btn = $(this);
                let form = $(this).closest('form');
                let formData = new FormData(form[0]);
                btn.prop('disabled', true).html('Loading...');

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message || 'Data berhasil diupdate',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('siswa.index') }}";
                            }
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let msg = 'Terjadi kesalahan';
                        if (errors) {
                            msg = Object.values(errors).flat().join('<br>');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: msg,
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
