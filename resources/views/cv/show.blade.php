@extends('layouts.app')

@section('title', 'Detail CV')

@section('content')
    <div class="space-y-4">
        <nav class="bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <a href="/" class="hover:text-gray-700 transition-colors">Dashboard</a>
                    <span>/</span>
                    <span class="text-gray-900 font-medium">Detail CV</span>
                </div>
                <a href="/edit/cv/kandidat/{{ $cv->id }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </a>
            </div>
        </nav>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto" class="w-20 h-20 rounded-lg object-cover border border-gray-200">
                <div class="flex-grow text-center md:text-left">
                    <h1 class="text-xl font-bold text-gray-900">{{ $cv->nama_lengkap_romaji ?? $cv->nama_lengkap_katakana }}</h1>
                    <p class="text-gray-500 text-sm">{{ $cv->bidang_sertifikasi }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-2 text-sm text-gray-500">
                        <span>{{ $cv->cabang->nama_cabang ?? 'N/A' }}</span>
                        <span>{{ $cv->no_telepon }}</span>
                        <span>Batch {{ $cv->batch }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3">
                <div class="text-xs text-gray-500 uppercase">Email</div>
                <div class="font-medium text-gray-900 text-sm truncate">{{ $cv->email }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3">
                <div class="text-xs text-gray-500 uppercase">No. Orang Tua</div>
                <div class="font-medium text-gray-900 text-sm">{{ $cv->no_orang_tua }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3">
                <div class="text-xs text-gray-500 uppercase">Bidang</div>
                <div class="font-medium text-gray-900 text-sm">{{ $cv->bidang_sertifikasi }}</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3">
                <div class="text-xs text-gray-500 uppercase">Program</div>
                <div class="font-medium text-gray-900 text-sm">{{ $cv->program_pertanian_kawakami }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Data Pribadi</h3>
                </div>
                <div class="p-4 space-y-2 text-sm">
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Nama Panggilan</span>
                        <span class="font-medium text-gray-900">{{ $cv->nama_panggilan_romaji ?? $cv->nama_panggilan_katakana }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Jenis Kelamin</span>
                        <span class="font-medium text-gray-900">{{ $cv->jenis_kelamin }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">TTL / Usia</span>
                        <span class="font-medium text-gray-900">{{ $cv->tanggal_lahir }} / {{ $cv->usia }} th</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Status</span>
                        <span class="font-medium text-gray-900">{{ $cv->status_perkawinan }}</span>
                    </div>
                    <div class="py-1">
                        <span class="text-gray-500 block text-xs">Alamat</span>
                        <span class="font-medium text-gray-900 text-xs">{{ $cv->alamat_lengkap }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Fisik & Kesehatan</h3>
                </div>
                <div class="p-4 space-y-2 text-sm">
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Tinggi/Berat</span>
                        <span class="font-medium text-gray-900">{{ $cv->tinggi_badan }}cm / {{ $cv->berat_badan }}kg</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Ukuran</span>
                        <span class="font-medium text-gray-900 text-xs">P:{{ $cv->ukuran_pinggang }} | S:{{ $cv->ukuran_sepatu }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">SIM</span>
                        <span class="font-medium text-gray-900">{{ $cv->surat_izin_mengemudi }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Merokok</span>
                        <span class="font-medium text-gray-900">{{ $cv->merokok }}</span>
                    </div>
                    <div class="py-1">
                        <span class="text-gray-500 block text-xs">Kesehatan</span>
                        <span class="font-medium text-gray-900 text-xs">{{ $cv->kesehatan_badan }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Pendidikan</h3>
                </div>
                <div class="p-4">
                    @forelse($cv->pendidikans ?? [] as $p)
                        <div class="mb-2 pb-2 border-b border-gray-50 last:border-0">
                            <div class="font-medium text-gray-900 text-sm">{{ $p->nama }}</div>
                            <div class="text-xs text-gray-500">{{ $p->jurusan ?? '-' }}</div>
                            <span class="text-xs text-gray-400">{{ $p->tahun_masuk }} - {{ $p->tahun_lulus ?? 'Sekarang' }}</span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Pengalaman Kerja</h3>
                </div>
                <div class="p-4">
                    @forelse($cv->pengalamans ?? [] as $p)
                        <div class="mb-2 pb-2 border-b border-gray-50 last:border-0">
                            <div class="font-medium text-gray-900 text-sm">{{ $p->perusahaan }}</div>
                            <div class="text-xs text-gray-500">{{ $p->jabatan ?? '-' }}</div>
                            <div class="text-xs text-gray-400">{{ $p->tanggal_masuk ?? '-' }} - {{ $p->tanggal_keluar ?? 'Sekarang' }}</div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Belum ada pengalaman</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Magang Jisshu</h3>
                </div>
                <div class="p-4">
                    @forelse($cv->magangJisshu ?? [] as $m)
                        <div class="mb-2 pb-2 border-b border-gray-50 last:border-0">
                            <div class="font-medium text-gray-900 text-sm">{{ $m->perusahaan ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $m->kota_prefektur ?? '-' }}</div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Pembelajaran</h3>
                </div>
                <div class="p-4 space-y-2 text-sm">
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Bahasa Jepang</span>
                        <span class="font-medium text-gray-900">{{ $cv->kemampuan_bahasa_jepang }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Lama Belajar</span>
                        <span class="font-medium text-gray-900">{{ $cv->lama_belajar_di_mendunia }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-gray-50">
                        <span class="text-gray-500">Pemahaman SSW</span>
                        <span class="font-medium text-gray-900">{{ $cv->kemampuan_pemahaman_ssw }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-gray-500">Bahasa Inggris</span>
                        <span class="font-medium text-gray-900">{{ $cv->kemampuan_berbahasa_inggris }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Keluarga</h3>
                </div>
                <div class="p-4 space-y-2 text-sm">
                    <div class="py-1 border-b border-gray-50">
                        <span class="text-gray-500 text-xs">Orang Tua</span>
                        <div class="font-medium text-gray-900">A: {{ $cv->ayah_nama ?? '-' }} | I: {{ $cv->ibu_nama ?? '-' }}</div>
                    </div>
                    <div class="py-1 border-b border-gray-50">
                        <span class="text-gray-500 text-xs">Saudara</span>
                        <div class="font-medium text-gray-900">K: {{ $cv->kakak_nama ?? '-' }} | D: {{ $cv->adik_nama ?? '-' }}</div>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-gray-500">Penghasilan</span>
                        <span class="font-medium text-gray-900">{{ $cv->rata_rata_penghasilan_keluarga ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-4 py-2 border-b border-gray-100">
                <h3 class="font-medium text-gray-800">Profil & Motivasi</h3>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500 text-xs">Kelebihan</span>
                    <p class="font-medium text-gray-900">{{ $cv->kelplus_diri }}</p>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Kekurangan</span>
                    <p class="font-medium text-gray-900">{{ $cv->kekurangan_diri }}</p>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Keahlian Khusus</span>
                    <p class="font-medium text-gray-900">{{ $cv->keahlian_khusus }}</p>
                </div>
                <div>
                    <span class="text-gray-500 text-xs">Point Plus</span>
                    <p class="font-medium text-gray-900">{{ $cv->point_plus_diri }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Foto Lainnya</h3>
                </div>
                <div class="p-4">
                    @php $pasFotos = json_decode($cv->pas_foto, true) ?? []; @endphp
                    @if (count($pasFotos) === 0)
                        <p class="text-gray-400 text-sm">Tidak ada file</p>
                    @else
                        <div class="flex flex-wrap gap-2">
                            @foreach ($pasFotos as $foto)
                                @php $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION)); $url = asset($foto); @endphp
                                @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <a href="{{ $url }}" target="_blank">
                                        <img src="{{ $url }}" class="w-14 h-14 object-cover rounded border border-gray-200 hover:opacity-75 transition-opacity">
                                    </a>
                                @else
                                    <a href="{{ $url }}" target="_blank" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded hover:bg-gray-200">
                                        {{ strtoupper($ext) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-4 py-2 border-b border-gray-100">
                    <h3 class="font-medium text-gray-800">Sertifikat</h3>
                </div>
                <div class="p-4">
                    @php $sertifikats = json_decode($cv->sertifikat_files, true) ?? []; @endphp
                    @if (count($sertifikats) === 0)
                        <p class="text-gray-400 text-sm">Tidak ada file</p>
                    @else
                        <div class="flex flex-wrap gap-2">
                            @foreach ($sertifikats as $file)
                                @php $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); $url = asset($file); @endphp
                                @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <a href="{{ $url }}" target="_blank">
                                        <img src="{{ $url }}" class="w-14 h-14 object-cover rounded border border-gray-200 hover:opacity-75 transition-opacity">
                                    </a>
                                @else
                                    <a href="{{ $url }}" target="_blank" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded hover:bg-gray-200">
                                        PDF
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <a href="/data/cv/kandidat" class="px-5 py-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                Kembali
            </a>
        </div>
    </div>
@endsection
