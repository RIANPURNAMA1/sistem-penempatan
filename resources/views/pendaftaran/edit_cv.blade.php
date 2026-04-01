@extends('layouts.app')

@section('title', 'Edit CV')

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Curriculum Vitae</h2>

        <form id="formUpdateCv" action="{{ route('pendaftaran.cv.update', $cv->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="bg-white px-6 py-3 rounded-t-xl">
                    <h5 class="text-black font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pas Foto CV
                    </h5>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="flex-shrink-0">
                            @if ($cv->pas_foto_cv)
                                <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto" id="preview-foto"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-100">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center border-4 border-gray-100">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 w-full">
                            <label for="pas_foto_cv" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru</label>
                            <input type="file" name="pas_foto_cv" id="pas_foto_cv" 
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer file:transition-colors"
                                accept="image/*">
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, PNG — Max: 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200 rounded-t-xl">
                    <h5 class="text-gray-800 font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Data Diri Lengkap
                    </h5>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap (Romaji)</label>
                            <input type="text" name="nama_lengkap_romaji" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('nama_lengkap_romaji', $cv->nama_lengkap_romaji) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap (Katakana)</label>
                            <input type="text" name="nama_lengkap_katakana" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('nama_lengkap_katakana', $cv->nama_lengkap_katakana) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan (Romaji)</label>
                            <input type="text" name="nama_panggilan_romaji" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('nama_panggilan_romaji', $cv->nama_panggilan_romaji) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan (Katakana)</label>
                            <input type="text" name="nama_panggilan_katakana" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('nama_panggilan_katakana', $cv->nama_panggilan_katakana) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                                <option value="男 (Laki-laki)" {{ $cv->jenis_kelamin == '男 (Laki-laki)' ? 'selected' : '' }}>男 (Laki-laki)</option>
                                <option value="女 (Perempuan)" {{ $cv->jenis_kelamin == '女 (Perempuan)' ? 'selected' : '' }}>女 (Perempuan)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <input type="text" name="agama" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('agama', $cv->agama) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama Lainnya (Opsional)</label>
                            <input type="text" name="agama_lainnya" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('agama_lainnya', $cv->agama_lainnya) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('tanggal_lahir', $cv->tanggal_lahir) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('tempat_lahir', $cv->tempat_lahir) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
                            <input type="number" name="usia" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('usia', $cv->usia) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Aktif</label>
                            <input type="email" name="email_aktif" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('email_aktif', $cv->email_aktif) }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                            <select name="status_perkawinan" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                                <option value="Sudah Menikah" {{ $cv->status_perkawinan == 'Sudah Menikah' ? 'selected' : '' }}>Sudah Menikah</option>
                                <option value="Belum Menikah" {{ $cv->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan Lainnya</label>
                            <input type="text" name="status_perkawinan_lainnya" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                value="{{ old('status_perkawinan_lainnya', $cv->status_perkawinan_lainnya) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                            <select name="golongan_darah" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                                @foreach (['A', 'B', 'AB', 'O'] as $gol)
                                    <option value="{{ $gol }}" {{ $cv->golongan_darah == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Memiliki SIM?</label>
                            <select name="surat_izin_mengemudi" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>
                                <option value="Ada" {{ $cv->surat_izin_mengemudi == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ $cv->surat_izin_mengérem == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis SIM</label>
                            <select name="jenis_sim" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Pilih Jenis SIM</option>
                                @foreach (['SIM A', 'SIM B', 'SIM C', 'SIM D'] as $sim)
                                    <option value="{{ $sim }}" {{ $cv->jenis_sim == $sim ? 'selected' : '' }}>{{ $sim }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" rows="3" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required>{{ old('alamat_lengkap', $cv->alamat_lengkap) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200 rounded-t-xl">
                    <h5 class="text-gray-800 font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                        Riwayat Pendidikan
                    </h5>
                    <p class="text-sm text-gray-500 mt-1">Isi dari yang terbaru terlebih dahulu.</p>
                </div>

                <div class="p-6">
                    <div id="pendidikan-wrapper" class="space-y-4">
                        @forelse ($cv->pendidikans as $pend)
                            <div class="flex flex-wrap gap-3 p-4 bg-gray-50 rounded-lg pendidikan-item">
                                <div class="flex-1 min-w-[200px]">
                                    <input type="text" name="nama[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $pend->nama }}" placeholder="Nama Sekolah / Tingkat Pendidikan" required>
                                </div>
                                <div class="flex-1 min-w-[200px]">
                                    <input type="text" name="jurusan[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $pend->jurusan }}" placeholder="Jurusan (opsional)">
                                </div>
                                <div class="w-24">
                                    <input type="number" name="tahun_masuk[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $pend->tahun_masuk }}" placeholder="Tahun Masuk" min="1950" max="2100">
                                </div>
                                <div class="w-24">
                                    <input type="number" name="tahun_lulus[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $pend->tahun_lulus }}" placeholder="Tahun Lulus" min="1950" max="2100">
                                </div>
                                <button type="button" class="remove-pendidikan p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @empty
                            <div class="flex flex-wrap gap-3 p-4 bg-gray-50 rounded-lg pendidikan-item">
                                <div class="flex-1 min-w-[200px]">
                                    <input type="text" name="nama[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="Nama Sekolah / Tingkat Pendidikan" required>
                                </div>
                                <div class="flex-1 min-w-[200px]">
                                    <input type="text" name="jurusan[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="Jurusan (opsional)">
                                </div>
                                <div class="w-24">
                                    <input type="number" name="tahun_masuk[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="Tahun Masuk" min="1950" max="2100">
                                </div>
                                <div class="w-24">
                                    <input type="number" name="tahun_lulus[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="Tahun Lulus" min="1950" max="2100">
                                </div>
                                <button type="button" class="remove-pendidikan p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforelse
                    </div>

                    <button type="button" id="add-pendidikan" class="mt-4 px-4 py-2 text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Pendidikan
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="bg-gray-50 px-6 py-3 border-b border-gray-200 rounded-t-xl">
                    <h5 class="text-gray-800 font-semibold">
                        <svg class="w-5 h-5 inline-block mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Pengalaman Kerja
                    </h5>
                </div>

                <div class="p-6">
                    <div id="kerja-wrapper" class="space-y-4">
                        @forelse ($cv->pengalamans as $kerja)
                            <div class="flex flex-wrap gap-3 p-4 bg-gray-50 rounded-lg kerja-item">
                                <div class="flex-1 min-w-[150px]">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Perusahaan</label>
                                    <input type="text" name="kerja_perusahaan[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $kerja->perusahaan }}" required>
                                </div>
                                <div class="flex-1 min-w-[150px]">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Jabatan</label>
                                    <input type="text" name="kerja_jabatan[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $kerja->jabatan }}">
                                </div>
                                <div class="w-32">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Masuk</label>
                                    <input type="month" name="kerja_tanggal_masuk[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $kerja->tanggal_masuk }}">
                                </div>
                                <div class="w-32">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Keluar</label>
                                    <input type="month" name="kerja_tanggal_keluar[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $kerja->tanggal_keluar }}">
                                </div>
                                <div class="w-28">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Gaji</label>
                                    <input type="text" name="kerja_gaji[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        value="{{ $kerja->gaji }}">
                                </div>
                                <button type="button" class="remove-kerja p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors self-end">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @empty
                            <div class="flex flex-wrap gap-3 p-4 bg-gray-50 rounded-lg kerja-item">
                                <div class="flex-1 min-w-[150px]">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Perusahaan</label>
                                    <input type="text" name="kerja_perusahaan[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        required>
                                </div>
                                <div class="flex-1 min-w-[150px]">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Jabatan</label>
                                    <input type="text" name="kerja_jabatan[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div class="w-32">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Masuk</label>
                                    <input type="month" name="kerja_tanggal_masuk[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div class="w-32">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Keluar</label>
                                    <input type="month" name="kerja_tanggal_keluar[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div class="w-28">
                                    <label class="block text-xs font-medium text-gray-500 mb-1">Gaji</label>
                                    <input type="text" name="kerja_gaji[]" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <button type="button" class="remove-kerja p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors self-end">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforelse
                    </div>

                    <button type="button" id="add-kerja" class="mt-4 px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Pengalaman
                    </button>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" id="btnUpdate" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-colors">
                    Update Data
                </button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#add-pendidikan").click(function() {
                let html = `
                <div class="flex flex-wrap gap-3 p-4 bg-gray-50 rounded-lg pendidikan-item">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="nama[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            placeholder="Nama Sekolah / Tingkat Pendidikan" required>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="jurusan[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            placeholder="Jurusan (opsional)">
                    </div>
                    <div class="w-24">
                        <input type="number" name="tahun_masuk[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            placeholder="Tahun Masuk" min="1950" max="2100">
                    </div>
                    <div class="w-24">
                        <input type="number" name="tahun_lulus[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            placeholder="Tahun Lulus" min="1950" max="2100">
                    </div>
                    <button type="button" class="remove-pendidikan p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>`;
                $("#pendidikan-wrapper").append(html);
            });

            $(document).on("click", ".remove-pendidikan", function() {
                $(this).closest(".pendidikan-item").remove();
            });

            $("#add-kerja").click(function() {
                let html = `
                <div class="flex flex-wrap gap-3 p-4 bg-gray-50 rounded-lg kerja-item">
                    <div class="flex-1 min-w-[150px]">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Nama Perusahaan</label>
                        <input type="text" name="kerja_perusahaan[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            required>
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Jabatan</label>
                        <input type="text" name="kerja_jabatan[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div class="w-32">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Masuk</label>
                        <input type="month" name="kerja_tanggal_masuk[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div class="w-32">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Keluar</label>
                        <input type="month" name="kerja_tanggal_keluar[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div class="w-28">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Gaji</label>
                        <input type="text" name="kerja_gaji[]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <button type="button" class="remove-kerja p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors self-end">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>`;
                $("#kerja-wrapper").append(html);
            });

            $(document).on("click", ".remove-kerja", function() {
                $(this).closest(".kerja-item").remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formUpdateCv").on("submit", function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $("#btnUpdate").prop("disabled", true).text("Memperbarui...");
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil!",
                                text: response.message,
                                timer: 2000
                            });
                            setTimeout(() => window.location.href = "/", 1800);
                        }
                    },
                    error: function(xhr) {
                        $("#btnUpdate").prop("disabled", false).text("Update Data");

                        if (xhr.status === 422) {
                            let msg = "";
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                msg += "• " + val[0] + "<br>";
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Validasi Gagal",
                                html: msg,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Memperbarui",
                                text: xhr.responseJSON?.detail ?? "Terjadi kesalahan",
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection