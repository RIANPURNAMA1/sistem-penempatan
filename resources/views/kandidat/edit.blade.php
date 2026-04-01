@extends('layouts.app')

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
                <a href="{{ url('/') }}" class="hover:text-gray-700">Dashboard</a>
                <span>/</span>
                <a href="{{ route('kandidat.data') }}" class="hover:text-gray-700">Kandidat</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Edit</span>
            </div>
        </nav>

        <form id="updateKandidatForm" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Status & Penempatan</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Kandidat <span class="text-red-500">*</span></label>
                            <select name="status_kandidat" id="status_kandidat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Job Matching" {{ $kandidat->status_kandidat == 'Job Matching' ? 'selected' : '' }}>Job Matching</option>
                                <option value="Pending" {{ $kandidat->status_kandidat == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="lamar ke perusahaan" {{ $kandidat->status_kandidat == 'lamar ke perusahaan' ? 'selected' : '' }}>Lamar ke Perusahaan</option>
                                <option value="Interview" {{ $kandidat->status_kandidat == 'Interview' ? 'selected' : '' }}>Interview</option>
                                <option value="Jadwalkan Interview Ulang" {{ $kandidat->status_kandidat == 'Jadwalkan Interview Ulang' ? 'selected' : '' }}>Jadwalkan Interview Ulang</option>
                                <option value="Lulus interview" {{ $kandidat->status_kandidat == 'Lulus interview' ? 'selected' : '' }}>Lulus Interview</option>
                                <option value="Gagal Interview" {{ $kandidat->status_kandidat == 'Gagal Interview' ? 'selected' : '' }}>Gagal Interview</option>
                                <option value="Pemberkasan" {{ $kandidat->status_kandidat == 'Pemberkasan' ? 'selected' : '' }}>Pemberkasan</option>
                                <option value="Berangkat" {{ $kandidat->status_kandidat == 'Berangkat' ? 'selected' : '' }}>Berangkat</option>
                                <option value="Ditolak" {{ $kandidat->status_kandidat == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Perusahaan Penempatan</label>
                            <select name="institusi_id" id="institusi_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">
                                <option value="">-- Pilih Perusahaan --</option>
                                @foreach ($institusis as $institusi)
                                    <option value="{{ $institusi->id }}" {{ $kandidat->institusi_id == $institusi->id ? 'selected' : '' }}>{{ $institusi->perusahaan_penempatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bidang SSW</label>
                            @if ($kandidat->pendaftaran && $kandidat->pendaftaran->bidang_ssws->count() > 0)
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($kandidat->pendaftaran->bidang_ssws as $bidang)
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="bidang_ssw" value="{{ $bidang->id }}" class="form-radio text-gray-600" {{ old('bidang_ssw', optional($kandidat->bidang_ssws->first())->id) == $bidang->id ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">{{ $bidang->nama_bidang }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">- Tidak ada bidang SSW -</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('nama_perusahaan', $kandidat->nama_perusahaan) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Detail Pekerjaan</label>
                            <textarea name="detail_pekerjaan" id="detail_pekerjaan" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">{{ old('detail_pekerjaan', $kandidat->detail_pekerjaan) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Interview</label>
                            <input type="date" name="jadwal_interview" id="jadwal_interview" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('jadwal_interview', $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Interview</label>
                            <textarea name="catatan_interview" id="catatan_interview" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">{{ old('catatan_interview', $kandidat->catatan_interview) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-4">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Data Interview & Mensetsu</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">TGL Setsumeikai / Ichijimensetsu</label>
                            <input type="date" name="tgl_setsumeikai_ichijimensetsu" id="tgl_setsumeikai_ichijimensetsu" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('tgl_setsumeikai_ichijimensetsu', $kandidat->tgl_setsumeikai_ichijimensetsu ? \Carbon\Carbon::parse($kandidat->tgl_setsumeikai_ichijimensetsu)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">TGL Mensetsu 1</label>
                            <input type="date" name="tgl_mensetsu" id="tgl_mensetsu" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('tgl_mensetsu', $kandidat->tgl_mensetsu ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">TGL Mensetsu 2</label>
                            <input type="date" name="tgl_mensetsu2" id="tgl_mensetsu2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('tgl_mensetsu2', $kandidat->tgl_mensetsu2 ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu2)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Mensetsu</label>
                            <textarea name="catatan_mensetsu" id="catatan_mensetsu" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">{{ old('catatan_mensetsu', $kandidat->catatan_mensetsu) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-4">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Biaya & Administrasi</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Biaya Pemberkasan</label>
                            <input type="text" name="biaya_pemberkasan" id="biaya_pemberkasan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('biaya_pemberkasan', $kandidat->biaya_pemberkasan) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ADM Tahap 1</label>
                            <input type="text" name="adm_tahap1" id="adm_tahap1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('adm_tahap1', $kandidat->adm_tahap1) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ADM Tahap 2</label>
                            <input type="text" name="adm_tahap2" id="adm_tahap2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('adm_tahap2', $kandidat->adm_tahap2) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-4">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-semibold text-gray-800">Tracking Dokumen & Proses</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen Dikirim (Soft File)</label>
                            <input type="date" name="dokumen_dikirim_soft_file" id="dokumen_dikirim_soft_file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('dokumen_dikirim_soft_file', $kandidat->dokumen_dikirim_soft_file ? \Carbon\Carbon::parse($kandidat->dokumen_dikirim_soft_file)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Terbit Kontrak Kerja</label>
                            <input type="date" name="terbit_kontrak_kerja" id="terbit_kontrak_kerja" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('terbit_kontrak_kerja', $kandidat->terbit_kontrak_kerja ? \Carbon\Carbon::parse($kandidat->terbit_kontrak_kerja)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kontrak Dikirim ke TSK</label>
                            <input type="date" name="kontrak_dikirim_ke_tsk" id="kontrak_dikirim_ke_tsk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('kontrak_dikirim_ke_tsk', $kandidat->kontrak_dikirim_ke_tsk ? \Carbon\Carbon::parse($kandidat->kontrak_dikirim_ke_tsk)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Terbit Paspor</label>
                            <input type="date" name="terbit_paspor" id="terbit_paspor" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('terbit_paspor', $kandidat->terbit_paspor ? \Carbon\Carbon::parse($kandidat->terbit_paspor)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Masuk Imigrasi Jepang</label>
                            <input type="date" name="masuk_imigrasi_jepang" id="masuk_imigrasi_jepang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('masuk_imigrasi_jepang', $kandidat->masuk_imigrasi_jepang ? \Carbon\Carbon::parse($kandidat->masuk_imigrasi_jepang)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">COE Terbit</label>
                            <input type="date" name="coe_terbit" id="coe_terbit" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('coe_terbit', $kandidat->coe_terbit ? \Carbon\Carbon::parse($kandidat->coe_terbit)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pembuatan E-KTKLN</label>
                            <input type="date" name="pembuatan_ektkln" id="pembuatan_ektkln" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('pembuatan_ektkln', $kandidat->pembuatan_ektkln ? \Carbon\Carbon::parse($kandidat->pembuatan_ektkln)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen Dikirim</label>
                            <input type="date" name="dokumen_dikirim" id="dokumen_dikirim" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('dokumen_dikirim', $kandidat->dokumen_dikirim ? \Carbon\Carbon::parse($kandidat->dokumen_dikirim)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Visa</label>
                            <input type="date" name="visa" id="visa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('visa', $kandidat->visa ? \Carbon\Carbon::parse($kandidat->visa)->format('Y-m-d') : '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Penerbangan</label>
                            <input type="date" name="jadwal_penerbangan" id="jadwal_penerbangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none" value="{{ old('jadwal_penerbangan', $kandidat->jadwal_penerbangan ? \Carbon\Carbon::parse($kandidat->jadwal_penerbangan)->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('kandidat.data') }}" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Kembali
                </a>
                <button type="submit" id="updateBtn" class="px-5 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Update Data Kandidat
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $("#updateKandidatForm").on("submit", function(e) {
                e.preventDefault();

                const $btn = $("#updateBtn");
                const originalHtml = $btn.html();
                $btn.prop("disabled", true);
                $btn.html('<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span> Memproses...');

                $.ajax({
                    url: "{{ route('kandidat.update', $kandidat->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $btn.prop("disabled", false);
                        $btn.html(originalHtml);

                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: response.message ?? "Data kandidat berhasil diupdate.",
                                showConfirmButton: false,
                                timer: 2000
                            });

                            if (response.redirect) {
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 2000);
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: response.status || "Gagal",
                                html: response.message ?? "Terjadi kesalahan saat update data."
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop("disabled", false);
                        $btn.html(originalHtml);

                        let errorMsg = "Terjadi kesalahan server.";
                        if (xhr.status === 422) {
                            if (xhr.responseJSON?.errors) {
                                errorMsg = Object.values(xhr.responseJSON.errors).flat().join("<br>");
                            } else if (xhr.responseJSON?.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                        } else if (xhr.responseJSON?.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Validasi Gagal",
                            html: errorMsg,
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script>
@endsection
