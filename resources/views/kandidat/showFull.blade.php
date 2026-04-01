@extends('layouts.app')

@section('title', 'Detail Kandidat')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="space-y-6">
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
                    Detail Kandidat
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-6 flex flex-col md:flex-row items-center gap-6">
                <div class="flex-shrink-0">
                    @php
                        $foto = $kandidat->pendaftaran->foto ?? null;
                        $nama = $kandidat->pendaftaran->nama ?? 'User';
                    @endphp

                    @if ($foto)
                        <img src="{{ asset($foto) }}" alt="Foto Kandidat"
                            class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 shadow-lg cursor-pointer"
                            data-bs-toggle="modal" data-bs-target="#modalFotoKandidat">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($nama) }}&background=0D8ABC&color=fff&size=150"
                            alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 shadow-lg">
                    @endif
                </div>

                @if ($foto)
                    <div class="modal fade" id="modalFotoKandidat" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-semibold">Preview Foto Kandidat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset($foto) }}" alt="Preview Foto" class="img-fluid rounded border" style="max-height: 70vh;">
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ asset($foto) }}" download class="btn btn-success">
                                        <i class="fas fa-download me-1"></i> Download Foto
                                    </a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex-grow text-center md:text-left">
                    <h3 class="text-xl font-bold text-gray-900">{{ $kandidat->pendaftaran->nama ?? 'Nama Kandidat' }}</h3>
                    <p class="text-gray-500 mt-1">{{ $kandidat->pendaftaran->nik ?? 'NIK Tidak Tersedia' }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-3">
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">{{ $kandidat->status_kandidat }}</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-cyan-100 text-cyan-800">{{ $kandidat->status_kandidat_di_mendunia }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mt-3">
                        Daftar Sejak: {{ $kandidat->pendaftaran->created_at ? \Carbon\Carbon::parse($kandidat->pendaftaran->created_at)->format('d F Y') : '-' }}
                    </p>
                </div>

                <div class="flex-shrink-0 flex gap-2">
                    <a href="{{ route('kandidat.history', $kandidat->id) }}" class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-600 transition-colors" title="Riwayat Perubahan Data">
                        <i class="fas fa-history"></i>
                    </a>
                    <a href="{{ route('kandidat.edit', $kandidat->id) }}" class="p-2 bg-amber-100 hover:bg-amber-200 rounded-lg text-amber-600 transition-colors" title="Edit Data Lengkap">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('kandidat.export', $kandidat->id) }}" class="p-2 bg-green-100 hover:bg-green-200 rounded-lg text-green-600 transition-colors" title="Export ke Excel">
                        <i class="fas fa-file-excel"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Data Pribadi & Alamat
                    </h5>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h6 class="text-sm font-semibold text-indigo-600 mb-3">Detail Pribadi</h6>
                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">NIK</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->nik ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Email</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->email ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">No WA</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->no_wa ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Jenis Kelamin</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->jenis_kelamin ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Tgl Daftar</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->created_at ? \Carbon\Carbon::parse($kandidat->pendaftaran->created_at)->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Agama</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->agama ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Status Nikah</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->status ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Pendidikan Akhir</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->pendidikan_terakhir ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Tempat Lahir</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->tempat_lahir ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Tanggal Lahir</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->tempat_tanggal_lahir ? \Carbon\Carbon::parse($kandidat->pendaftaran->tempat_tanggal_lahir)->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Usia</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->usia ?? '-' }} tahun</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Pernah ke Jepang</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->pernah_ke_jepang ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-sm font-semibold text-indigo-600 mb-3">Detail Lokasi & Prometric</h6>
                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Provinsi</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->provinsi ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Kab/Kota</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->kab_kota ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Kecamatan</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->kecamatan ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Kelurahan</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->kelurahan ?? '-' }}</span>
                                </div>
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block mb-1">Alamat Lengkap</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->alamat ?? '-' }}</span>
                                </div>
                            </div>

                            <h6 class="text-sm font-semibold text-gray-600 mt-6 mb-3">Informasi Akun</h6>
                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">ID Prometric</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->id_prometric ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Password Prometric</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->password_prometric ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Paspor</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->paspor ? 'Ada' : '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pt-6 border-t border-gray-100">
                        <div>
                            <h6 class="text-sm font-semibold text-indigo-600 mb-3">Status Verifikasi Pendaftaran</h6>
                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500">Verifikasi Admin</span>
                                    <span class="text-sm font-semibold">
                                        @php
                                            $status = $kandidat->pendaftaran->verifikasi ?? 'menunggu';
                                            $class = match ($status) {
                                                'diterima' => 'bg-green-100 text-green-800',
                                                'ditolak' => 'bg-red-100 text-red-800',
                                                'data belum lengkap' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $class }}">{{ ucfirst($status) }}</span>
                                    </span>
                                </div>
                                <div class="py-2">
                                    <span class="text-sm text-gray-500 block mb-1">Catatan Admin</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pendaftaran->catatan_admin ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="text-sm font-semibold text-indigo-600 mb-3">Status Dokumen Upload</h6>
                            <div class="grid grid-cols-2 gap-2">
                                @php
                                    $dokumen = [
                                        'Foto' => 'foto',
                                        'Sertifikat JFT' => 'sertifikat_jft',
                                        'Sertifikat SSW' => 'sertifikat_ssw',
                                        'Kartu Keluarga (KK)' => 'kk',
                                        'KTP' => 'ktp',
                                        'Akte Kelahiran' => 'akte',
                                        'Ijasah' => 'ijasah',
                                        'Bukti Pelunasan' => 'bukti_pelunasan',
                                    ];
                                @endphp

                                @foreach ($dokumen as $label => $field)
                                    <div class="flex items-center justify-between py-1">
                                        <span class="text-xs text-gray-500">{{ $label }}</span>
                                        @if ($field === 'sertifikat_ssw')
                                            @php
                                                $raw = $kandidat->pendaftaran->sertifikat_ssw ?? null;
                                                if (is_string($raw)) {
                                                    $decoded = json_decode($raw, true);
                                                    $files = is_array($decoded) ? $decoded : [$raw];
                                                } elseif (is_array($raw)) {
                                                    $files = $raw;
                                                } else {
                                                    $files = [];
                                                }
                                            @endphp
                                            @if (!empty($files))
                                                <i class="fas fa-check-circle text-green-500"></i>
                                            @else
                                                <i class="fas fa-times-circle text-red-400"></i>
                                            @endif
                                        @else
                                            @if (!empty($kandidat->pendaftaran->$field))
                                                <i class="fas fa-check-circle text-green-500"></i>
                                            @else
                                                <i class="fas fa-times-circle text-red-400"></i>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Data Penempatan & Pekerjaan
                        </h5>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-500">Perusahaan Penempatan</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $kandidat->institusi->perusahaan_penempatan ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-500">Nama Perusahaan Jepang</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $kandidat->nama_perusahaan ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-500">Detail Pekerjaan</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $kandidat->detail_pekerjaan ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-500">Bidang Pekerjaan SSW</span>
                            <span class="text-sm font-semibold text-gray-900">
                                @if ($kandidat->bidang_ssws && $kandidat->bidang_ssws->count())
                                    {{ $kandidat->bidang_ssws->pluck('nama_bidang')->join(', ') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Proses Interview
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">Tgl Setsumeikai / Ichiji</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->tgl_setsumeikai_ichijimensetsu ? \Carbon\Carbon::parse($kandidat->tgl_setsumeikai_ichijimensetsu)->format('d F Y') : '-' }}</span>
                            </div>
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">Tgl Mensetsu 1</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->tgl_mensetsu ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu)->format('d F Y') : '-' }}</span>
                            </div>
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">Tgl Mensetsu 2</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->tgl_mensetsu2 ? \Carbon\Carbon::parse($kandidat->tgl_mensetsu2)->format('d F Y') : '-' }}</span>
                            </div>
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">Jadwal Interview Berikutnya</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('d F Y') : '-' }}</span>
                            </div>
                        </div>
                        <div class="mt-4 py-2">
                            <span class="text-sm text-gray-500 block">Catatan Interview</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $kandidat->catatan_interview ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h5 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Administrasi & Tracking Dokumen
                        </h5>
                    </div>
                    <div class="p-6">
                        <h6 class="text-sm font-semibold text-indigo-600 mb-3">Biaya Administrasi</h6>
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">Pemberkasan</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->biaya_pemberkasan ? $kandidat->biaya_pemberkasan : '-' }}</span>
                            </div>
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">ADM Tahap 1</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->adm_tahap1 ? $kandidat->adm_tahap1 : '-' }}</span>
                            </div>
                            <div class="py-2 border-b border-gray-100">
                                <span class="text-sm text-gray-500 block">ADM Tahap 2</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $kandidat->adm_tahap2 ? $kandidat->adm_tahap2 : '-' }}</span>
                            </div>
                        </div>

                        <h6 class="text-sm font-semibold text-indigo-600 mb-3 pt-4 border-t border-gray-100">Tracking Dokumen & Visa</h6>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block">Kontrak Kerja Terbit</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->terbit_kontrak_kerja ? \Carbon\Carbon::parse($kandidat->terbit_kontrak_kerja)->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block">Masuk Imigrasi Jepang</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->masuk_imigrasi_jepang ? \Carbon\Carbon::parse($kandidat->masuk_imigrasi_jepang)->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block">COE Terbit</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->coe_terbit ? \Carbon\Carbon::parse($kandidat->coe_terbit)->format('d F Y') : '-' }}</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block">Pembuatan E-KTKLN</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->pembuatan_ektkln ? \Carbon\Carbon::parse($kandidat->pembuatan_ektkln)->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block">Visa Terbit</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $kandidat->visa ? \Carbon\Carbon::parse($kandidat->visa)->format('d F Y') : '-' }}</span>
                                </div>
                                <div class="py-2 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 block">Jadwal Penerbangan</span>
                                    <span class="text-sm font-bold text-indigo-600">{{ $kandidat->jadwal_penerbangan ? \Carbon\Carbon::parse($kandidat->jadwal_penerbangan)->format('d F Y') : '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-start">
            <a href="/kandidat/data" class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Kandidat
            </a>
        </div>
    </div>
@endsection
