@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        @endif

        <nav class="bg-white rounded-xl shadow-sm border border-gray-100 px-4 py-3">
            <ol class="flex items-center gap-2 text-sm">
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </li>
                <li class="text-gray-400">/</li>
                <li class="text-gray-900 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Detail Kandidat {{ $kandidat->nama }}
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <img src="{{ asset($kandidat->foto) }}" alt="Foto Kandidat"
                                class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-indigo-500 shadow-lg">
                            <h2 class="mt-4 text-xl font-bold text-gray-900">{{ $kandidat->nama }}</h2>
                            <p class="text-gray-500 text-sm mt-1">{{ $kandidat->nik }}</p>
                        </div>

                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $kandidat->verifikasi == 'Terverifikasi' ? 'bg-green-100 text-green-800' : ($kandidat->verifikasi == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $kandidat->verifikasi }}
                            </span>
                            <p class="text-gray-600 mt-3 text-sm">Cabang: <span class="font-semibold text-gray-900">{{ $kandidat->cabang->nama_cabang ?? '-' }}</span></p>
                        </div>

                        <div class="text-left border-t border-gray-100 pt-4">
                            <h6 class="text-sm font-semibold text-gray-900 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Catatan Admin:
                            </h6>
                            <p class="text-sm text-gray-500 bg-gray-50 p-3 rounded-lg">
                                {{ $kandidat->catatan_admin ?? 'Tidak ada catatan.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Identitas Dasar
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Nama Lengkap</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->nama }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">NIK</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->nik }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">TTL</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->tempat_lahir }}, {{ \Carbon\Carbon::parse($kandidat->tempat_tanggal_lahir)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Usia</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->usia }} tahun</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Jenis Kelamin</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->jenis_kelamin }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Pendidikan Terakhir</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendidikan_terakhir }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Agama</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->agama }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Status Pernikahan</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->status }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Email</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->email }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">No WA</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->no_wa }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Tanggal Daftar</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Bidang SSW</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->bidang_ssw }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex items-start">
                                <span class="text-sm font-medium text-gray-500 w-40">Alamat Lengkap</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->alamat }}, Kel. {{ $kandidat->kelurahan }}, Kec. {{ $kandidat->kecamatan }}, {{ $kandidat->kab_kota }}, Prov. {{ $kandidat->provinsi }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Informasi Tambahan
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">ID Prometric</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->id_prometric ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Password Prometric</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->password_prometric ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Pernah ke Jepang</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kandidat->pernah_ke_jepang === 'Ya' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $kandidat->pernah_ke_jepang }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Paspor</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        @if ($kandidat->paspor)
                                            <a href="{{ asset($kandidat->paspor) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Lihat Paspor
                                            </a>
                                        @else
                                            <span class="text-gray-400">Belum ada</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Sertifikat JFT</span>
                                    <span class="text-sm font-semibold">
                                        @if ($kandidat->sertifikat_jft)
                                            <a href="{{ asset($kandidat->sertifikat_jft) }}" target="_blank" class="text-green-600 hover:text-green-800 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Lihat Sertifikat
                                            </a>
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Sudah</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Belum</span>
                                            <p class="text-xs text-gray-400 mt-1">Opsional</p>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500">Sertifikat SSW</span>
                                    <span class="text-sm font-semibold">
                                        @if ($kandidat->sertifikat_ssw)
                                            @php
                                                $sertifikatFiles = is_string($kandidat->sertifikat_ssw)
                                                    ? json_decode($kandidat->sertifikat_ssw, true)
                                                    : $kandidat->sertifikat_ssw;
                                                if (!is_array($sertifikatFiles)) {
                                                    $sertifikatFiles = [$sertifikatFiles];
                                                }
                                            @endphp
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($sertifikatFiles as $index => $file)
                                                    <a href="{{ asset($file) }}" target="_blank" class="text-green-600 hover:text-green-800 text-xs">
                                                        Sertifikat {{ count($sertifikatFiles) > 1 ? $index + 1 : '' }}
                                                    </a>
                                                @endforeach
                                            </div>
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Sudah</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Belum</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-500 block mb-2">Bidang SSW</span>
                                    @if ($kandidat->bidang_ssws && $kandidat->bidang_ssws->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($kandidat->bidang_ssws as $bidang)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                    {{ $bidang->nama_bidang }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic text-sm">Belum memilih bidang</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Dokumen Upload
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @php
                                $dokumen = [
                                    'Foto' => $kandidat->foto,
                                    'Sertifikat JFT' => $kandidat->sertifikat_jft,
                                    'Kartu Keluarga (KK)' => $kandidat->kk,
                                    'KTP' => $kandidat->ktp,
                                    'Bukti Pelunasan' => $kandidat->bukti_pelunasan,
                                    'Akte Kelahiran' => $kandidat->akte,
                                    'Ijazah' => $kandidat->ijasah,
                                ];
                            @endphp

                            @foreach ($dokumen as $nama => $path)
                                @if ($path)
                                    <a href="{{ asset($path) }}" target="_blank" class="flex flex-col items-center justify-center p-4 rounded-xl border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 transition-all duration-200 group">
                                        <svg class="w-8 h-8 text-green-500 mb-2 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-700 text-center">{{ $nama }}</span>
                                    </a>
                                @else
                                    <div class="flex flex-col items-center justify-center p-4 rounded-xl border border-gray-200 bg-gray-50">
                                        <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="text-sm font-medium text-gray-400 text-center">{{ $nama }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="/kandidat" class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
