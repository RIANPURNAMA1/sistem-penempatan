@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body, .form-label, .form-control, .form-select, .btn, div, span, th, td {
            font-family: 'Inter', sans-serif !important;
        }
    </style>

    <div class="space-y-4">
        <nav class="bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-3">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-700">Dashboard</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Edit Pendaftaran</span>
            </div>
        </nav>

        <form id="edit-cv-form" action="{{ route('pendaftaran.update.full', $kandidat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Data Pribadi</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" value="{{ old('nik', $kandidat->nik) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required pattern="\d{16}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama', $kandidat->nama) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $kandidat->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No WA <span class="text-red-500">*</span></label>
                            <input type="text" name="no_wa" value="{{ old('no_wa', $kandidat->no_wa) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $kandidat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                            <select name="agama" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Agama --</option>
                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', $kandidat->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Status --</option>
                                @foreach (['belum menikah', 'menikah', 'lajang'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $kandidat->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $kandidat->tempat_lahir) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir', $kandidat->tempat_tanggal_lahir) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>{{ old('alamat', $kandidat->alamat) }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                            <select name="pendidikan_terakhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="SD" {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>SMA / SMK</option>
                                <option value="D3" {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pendidikan_terakhir', $kandidat->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cabang <span class="text-red-500">*</span></label>
                            <select name="cabang_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                @foreach (\App\Models\Cabang::all() as $cabang)
                                    <option value="{{ $cabang->id }}" {{ old('cabang_id', $kandidat->cabang_id) == $cabang->id ? 'selected' : '' }}>{{ $cabang->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi <span class="text-red-500">*</span></label>
                            <select name="provinsi" id="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Provinsi --</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <select name="kab_kota" id="kab_kota" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                            <select name="kecamatan" id="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan <span class="text-red-500">*</span></label>
                            <select name="kelurahan" id="kelurahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Kelurahan --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-4">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Informasi Tambahan</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ID Prometric</label>
                            <input type="text" name="id_prometric" value="{{ old('id_prometric', $kandidat->id_prometric) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Prometric</label>
                            <input type="text" name="password_prometric" value="{{ old('password_prometric', $kandidat->password_prometric) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pernah ke Jepang? <span class="text-red-500">*</span></label>
                            <select name="pernah_ke_jepang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="Tidak" {{ old('pernah_ke_jepang', $kandidat->pernah_ke_jepang) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                <option value="Ya" {{ old('pernah_ke_jepang', $kandidat->pernah_ke_jepang) == 'Ya' ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-4">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Upload Dokumen</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php $docs = [
                            ['name' => 'foto', 'label' => 'Foto', 'file' => $kandidat->foto],
                            ['name' => 'kk', 'label' => 'Kartu Keluarga', 'file' => $kandidat->kk],
                            ['name' => 'ktp', 'label' => 'KTP', 'file' => $kandidat->ktp],
                            ['name' => 'paspor', 'label' => 'Paspor', 'file' => $kandidat->paspor],
                            ['name' => 'bukti_pelunasan', 'label' => 'Bukti Pelunasan', 'file' => $kandidat->bukti_pelunasan],
                            ['name' => 'akte', 'label' => 'Akte Kelahiran', 'file' => $kandidat->akte],
                            ['name' => 'ijasah', 'label' => 'Ijazah', 'file' => $kandidat->ijasah],
                        ]; @endphp
                        @foreach($docs as $doc)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $doc['label'] }}</label>
                            <input type="file" name="{{ $doc['name'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">
                            @if($doc['file'])
                            <div class="mt-2">
                                <span class="text-xs text-gray-500 block">File saat ini:</span>
                                @php $ext = strtolower(pathinfo($doc['file'], PATHINFO_EXTENSION)); @endphp
                                @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                    <img src="{{ asset($doc['file']) }}" class="h-20 mt-1 rounded border border-gray-200">
                                @else
                                    <a href="{{ asset($doc['file']) }}" target="_blank" class="text-blue-600 hover:underline text-sm">Lihat Dokumen</a>
                                @endif
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('siswa.index') }}" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Kembali
                </a>
                <button type="submit" id="btnSubmit" class="px-5 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Update Data
                </button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const oldProvinsi = "{{ old('provinsi', $kandidat->provinsi) }}";
            const oldKabupaten = "{{ old('kab_kota', $kandidat->kab_kota) }}";
            const oldKecamatan = "{{ old('kecamatan', $kandidat->kecamatan) }}";
            const oldKelurahan = "{{ old('kelurahan', $kandidat->kelurahan) }}";

            const provinsiSelect = document.getElementById("provinsi");
            const kabupatenSelect = document.getElementById("kab_kota");
            const kecamatanSelect = document.getElementById("kecamatan");
            const kelurahanSelect = document.getElementById("kelurahan");

            async function loadProvinces() {
                const res = await fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
                const data = await res.json();
                data.forEach(p => {
                    let opt = document.createElement("option");
                    opt.value = p.name;
                    opt.textContent = p.name;
                    if (p.name === oldProvinsi) opt.selected = true;
                    provinsiSelect.appendChild(opt);
                });
                if (oldProvinsi) loadKabupaten(oldProvinsi);
            }

            async function loadKabupaten(provName) {
                const prov = Array.from(provinsiSelect.options).find(o => o.value === provName);
                if (!prov) return;
                const idx = Array.from(provinsiSelect.options).indexOf(prov);
                const provId = data[idx]?.id;
                if (!provId) return;
                
                const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`);
                const data = await res.json();
                kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                data.forEach(k => {
                    let opt = document.createElement("option");
                    opt.value = k.name;
                    opt.textContent = k.name;
                    if (k.name === oldKabupaten) opt.selected = true;
                    kabupatenSelect.appendChild(opt);
                });
            }

            loadProvinces();

            provinsiSelect.addEventListener("change", function() {
                loadKabupaten(this.value);
            });

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
                                window.location.href = "/kandidat";
                            });
                        },
                        error: function(xhr) {
                            let msg = 'Terjadi kesalahan';
                            let errors = xhr.responseJSON?.errors;
                            if (errors) msg = Object.values(errors).flat().join("<br>");
                            Swal.fire({ icon: 'error', title: 'Gagal!', html: msg });
                        },
                        complete: function() {
                            btn.prop('disabled', false).html('Update Data');
                        }
                    });
                });
            });
        });
    </script>
@endsection
