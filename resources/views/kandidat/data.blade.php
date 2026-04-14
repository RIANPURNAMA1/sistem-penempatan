@extends('layouts.app')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body,
        .table,
        .form-label,
        .form-select,
        .btn,
        div,
        span,
        th,
        td {
            font-family: 'Inter', sans-serif !important;
            font-size: 11px !important;
        }

        .table th,
        .table td {
            padding: 6px 8px;
        }

        .table .badge {
            font-size: 9px;
        }

        .table .btn {
            padding: 2px 5px;
            font-size: 10px;
        }

        .form-select,
        .btn {
            font-size: 11px;
        }

        .dataTables_length select,
        .dataTables_filter input {
            font-size: 11px;
        }

        .dataTables_info,
        .dataTables_paginate {
            font-size: 11px;
        }

        #tableKandidatutama {
            font-size: 10px;
        }
    </style>

    <div class="py-3">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <!-- Breadcrumb -->
        <nav class="mb-4">
            <ol class="flex items-center text-sm text-gray-500">
                <li><a href="#" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
                <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
                <li class="text-gray-700 font-medium">Data Kandidat</li>
            </ol>
        </nav>

        <!-- Statistik -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
            <div class="p-4">
                <h5 class="font-semibold text-gray-800 mb-4">Statistik Kandidat SSW</h5>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($statistik_ssw as $nama_bidang => $data)
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <h6 class="text-xs font-semibold text-gray-500 uppercase mb-3">{{ $nama_bidang }}</h6>
                            <div class="flex justify-between items-end">
                                <div>
                                    <span class="text-2xl font-bold text-gray-800">{{ $data['total'] }}</span>
                                    <span class="text-gray-500 text-sm ml-1">Total</span>
                                </div>
                                <div class="text-right text-xs">
                                    <div class="text-gray-600">L: <span class="font-semibold">{{ $data['L'] }}</span>
                                    </div>
                                    <div class="text-gray-600">P: <span class="font-semibold">{{ $data['P'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
            <div class="p-4 flex flex-wrap items-center justify-between gap-3">
                <h6 class="font-semibold text-gray-700"><i class="bi bi-funnel me-2"></i>Filter Kandidat</h6>
                <div class="flex items-center gap-2">
                    <button
                        class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm flex items-center gap-2 transition-colors"
                        data-bs-toggle="dropdown">
                        <!-- Icon Filter (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        <span>Filter</span>
                    </button>
                    <div class="dropdown-menu p-4 shadow-lg" style="width: 700px; max-width: 90vw;">
                        <form action="{{ route('kandidat.data') }}" method="GET">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Bidang SSW</p>
                                    <div class="max-h-32 overflow-y-auto mb-3">
                                        @foreach (['Pengolahan makanan', 'Restoran', 'Pertanian', 'Kaigo (perawat)', 'Building cleaning', 'Driver'] as $ssw)
                                            <label class="flex items-center gap-2 text-xs mb-1">
                                                <input type="checkbox" name="f_ssw[]" value="{{ $ssw }}"
                                                    {{ in_array($ssw, request('f_ssw', [])) ? 'checked' : '' }}
                                                    class="rounded">
                                                {{ $ssw }}
                                            </label>
                                        @endforeach
                                    </div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Cabang</p>
                                    <div class="max-h-32 overflow-y-auto">
                                        @foreach ($cabangs as $cabang)
                                            <label class="flex items-center gap-2 text-xs mb-1">
                                                <input type="checkbox" name="f_cabang[]" value="{{ $cabang->nama_cabang }}"
                                                    {{ in_array($cabang->nama_cabang, request('f_cabang', [])) ? 'checked' : '' }}
                                                    class="rounded">
                                                {{ $cabang->nama_cabang }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="border-l border-r px-3">
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Status</p>
                                    <div class="max-h-40 overflow-y-auto mb-3">
                                        @foreach (['Job Matching', 'Pending', 'Interview', 'Gagal Interview', 'Lulus interview', 'Pemberkasan', 'Berangkat', 'Diterima'] as $status)
                                            <label class="flex items-center gap-2 text-xs mb-1">
                                                <input type="checkbox" name="f_status[]" value="{{ $status }}"
                                                    {{ in_array($status, request('f_status', [])) ? 'checked' : '' }}
                                                    class="rounded">
                                                {{ $status }}
                                            </label>
                                        @endforeach
                                    </div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Pendidikan</p>
                                    @foreach (['SMA', 'SMK', 'D3', 'S1'] as $edu)
                                        <label class="flex items-center gap-2 text-xs mb-1">
                                            <input type="checkbox" name="f_edu[]" value="{{ $edu }}"
                                                {{ in_array($edu, request('f_edu', [])) ? 'checked' : '' }}
                                                class="rounded">
                                            {{ $edu }}
                                        </label>
                                    @endforeach
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Jenis Kelamin</p>
                                    <label class="flex items-center gap-2 text-xs mb-1">
                                        <input type="checkbox" name="f_jk[]" value="Laki-laki"
                                            {{ in_array('Laki-laki', request('f_jk', [])) ? 'checked' : '' }}
                                            class="rounded"> Laki-laki
                                    </label>
                                    <label class="flex items-center gap-2 text-xs mb-3">
                                        <input type="checkbox" name="f_jk[]" value="Perempuan"
                                            {{ in_array('Perempuan', request('f_jk', [])) ? 'checked' : '' }}
                                            class="rounded"> Perempuan
                                    </label>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Umur</p>
                                    <div class="flex gap-2 mb-3">
                                        <input type="number" name="age_min" placeholder="Min"
                                            value="{{ request('age_min') }}"
                                            class="w-full px-2 py-1 border rounded text-xs">
                                        <input type="number" name="age_max" placeholder="Max"
                                            value="{{ request('age_max') }}"
                                            class="w-full px-2 py-1 border rounded text-xs">
                                    </div>
                                    <button type="submit"
                                        class="w-full px-3 py-2 bg-blue-600 text-white rounded-lg text-xs hover:bg-blue-700 mb-2">Terapkan</button>
                                    <a href="{{ route('kandidat.data') }}"
                                        class="block text-center w-full px-3 py-2 bg-gray-100 text-gray-700 rounded-lg text-xs hover:bg-gray-200">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Filters -->
        @if (request()->hasAny(['f_ssw', 'f_cabang', 'f_status', 'f_edu', 'f_jk', 'age_min', 'age_max']))
            <div class="mb-3 flex flex-wrap gap-2">
                <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded"><i class="bi bi-funnel me-1"></i> Filter
                    Aktif</span>
                @foreach (request('f_cabang', []) as $f)
                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">Cabang: {{ $f }}</span>
                @endforeach
                @foreach (request('f_ssw', []) as $f)
                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">SSW: {{ $f }}</span>
                @endforeach
                @foreach (request('f_status', []) as $f)
                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">Status: {{ $f }}</span>
                @endforeach
                <a href="{{ route('kandidat.data') }}"
                    class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600"><i class="bi bi-x"></i></a>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
            <div class="">
                <table id="tableKandidatutama" class="w-full text-left text-xs">
                    <thead class="bg-base-200 text-base-content border-b border-base-content/10">
                        <!-- Baris 1: Grouping Header -->
                        <tr class="text-center uppercase text-[10px] tracking-wider font-bold text-gray-500">
                            <th colspan="3" class="bg-base-300/50 border-r border-base-content/10">Kandidat</th>
                            <th colspan="3" class="bg-base-300/30 border-r border-base-content/10">Status & Cabang</th>
                            <th colspan="3" class="bg-base-300/50 border-r border-base-content/10">Penempatan</th>
                            <th colspan="5" class="bg-blue-50 border-r border-blue-100 text-blue-700">Proses Interview
                            </th>
                            <th colspan="3" class="bg-green-50 border-r border-green-100 text-green-700">Biaya & ADM
                            </th>
                            <th colspan="7" class="bg-amber-50 text-amber-700">Progress Dokumen & Keberangkatan</th>
                            <th class="bg-base-300"></th>
                        </tr>

                        <!-- Baris 2: Detail Header -->
                        <tr class="text-center whitespace-nowrap">
                            <th class="px-2 py-3 border-r border-base-content/5">No</th>
                            <th class="px-2 py-3">Foto</th>
                            <th class="px-4 py-3 border-r border-base-content/10 text-left">Nama</th>

                            <th class="px-2 py-3 text-left">Cabang</th>
                            <th class="px-2 py-3">Status</th>
                            <th class="px-2 py-3 border-r border-base-content/10">Di Mendunia</th>

                            <th class="px-2 py-3">Institusi</th>
                            <th class="px-2 py-3">Perusahaan</th>
                            <th class="px-2 py-3 border-r border-base-content/10">Bidang SSW</th>

                            <th class="px-2 py-3 bg-blue-50/50">Tgl Daftar</th>
                            <th class="px-2 py-3 bg-blue-50/50">Jml Intv</th>
                            <th class="px-2 py-3 bg-blue-50/50">Jadwal</th>
                            <th class="px-2 py-3 bg-blue-50/50">Setsu</th>
                            <th class="px-2 py-3 bg-blue-50/50 border-r border-blue-100">Mensetsu</th>

                            <th class="px-2 py-3 bg-green-50/50">Biaya</th>
                            <th class="px-2 py-3 bg-green-50/50">ADM 1</th>
                            <th class="px-2 py-3 bg-green-50/50 border-r border-green-100">ADM 2</th>

                            <th class="px-2 py-3 bg-amber-50/50">Dok Soft</th>
                            <th class="px-2 py-3 bg-amber-50/50">Kontrak</th>
                            <th class="px-2 py-3 bg-amber-50/50">Paspor</th>
                            <th class="px-2 py-3 bg-amber-50/50">COE</th>
                            <th class="px-2 py-3 bg-amber-50/50">E-KTKLN</th>
                            <th class="px-2 py-3 bg-amber-50/50">Visa</th>
                            <th class="px-2 py-3 bg-amber-50/50 border-r border-amber-100 font-bold text-blue-600">TERBANG
                            </th>

                            <th class="px-4 py-3 sticky right-0 bg-base-200 shadow-l">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($kandidats as $index => $k)
                            <tr class="hover:bg-gray-50 text-center">
                                <td class="px-2 py-2 text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-2 py-2">
                                    @php $foto = $k->pendaftaran->foto ?? null; @endphp
                                    @if ($foto)
                                        <a href="{{ route('kandidat.show', $k->id) }}">
                                            <img src="{{ asset($foto) }}" class=" rounded-md object-cover">
                                        </a>
                                    @else
                                        <a href="{{ route('kandidat.show', $k->id) }}">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($k->pendaftaran->nama ?? 'U') }}&background=0D8ABC&color=fff"
                                                class="w-8 h-8 rounded-full">
                                        </a>
                                    @endif
                                </td>
                                <td class="px-2 py-2 font-medium text-gray-800 text-left">
                                    {{ $k->pendaftaran->nama ?? '-' }}</td>
                                <td class="px-2 py-2 text-gray-600">{{ $k->cabang->nama_cabang ?? '-' }}</td>
                                <td class="px-2 py-2">
                                    @php
                                        $statusColors = [
                                            'Job Matching' => 'bg-gray-100 text-gray-700',
                                            'Pending' => 'bg-yellow-100 text-yellow-700',
                                            'Interview' => 'bg-blue-100 text-blue-700',
                                            'Gagal Interview' => 'bg-red-100 text-red-700',
                                            'Lulus interview' => 'bg-green-100 text-green-700',
                                            'Pemberkasan' => 'bg-indigo-100 text-indigo-700',
                                            'Berangkat' => 'bg-green-500 text-white',
                                            'Diterima' => 'bg-green-500 text-white',
                                            'Ditolak' => 'bg-red-500 text-white',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$k->status_kandidat] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $k->status_kandidat }}
                                    </span>
                                </td>
                                <td class="px-2 py-2">
                                    <form action="{{ route('kandidat.updateMendunia', $k->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <select name="status_kandidat_di_mendunia"
                                            class="text-xs border border-gray-300 rounded px-2 py-1 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                            onchange="this.form.submit()">
                                            <option value="Tetap di Mendunia"
                                                {{ $k->status_kandidat_di_mendunia == 'Tetap di Mendunia' ? 'selected' : '' }}>
                                                Tetap</option>
                                            <option value="Keluar dari Mendunia"
                                                {{ $k->status_kandidat_di_mendunia == 'Keluar dari Mendunia' ? 'selected' : '' }}>
                                                Keluar</option>
                                            <option value="Sudah Terbang"
                                                {{ $k->status_kandidat_di_mendunia == 'Sudah Terbang' ? 'selected' : '' }}>
                                                Terbang</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->institusi->perusahaan_penempatan ?? '-' }}</td>
                                <td class="px-2 py-2 text-gray-600 text-xs">{{ $k->nama_perusahaan ?? '-' }}</td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    @if ($k->bidang_ssws && $k->bidang_ssws->count() > 0)
                                        {{ $k->bidang_ssws->pluck('nama_bidang')->join(', ') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-2 py-2 text-gray-500 text-xs">
                                    {{ $k->pendaftaran->created_at->format('d/m/Y') }}</td>
                                <td class="px-2 py-2"><span
                                        class="px-2 py-0.5 bg-gray-100 rounded text-xs">{{ $k->jumlah_interview ?? 0 }}</span>
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->jadwal_interview ? \Carbon\Carbon::parse($k->jadwal_interview)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->tgl_setsumeikai_ichijimensetsu ? \Carbon\Carbon::parse($k->tgl_setsumeikai_ichijimensetsu)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->tgl_mensetsu ? \Carbon\Carbon::parse($k->tgl_mensetsu)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">{{ $k->biaya_pemberkasan ?? '-' }}</td>
                                <td class="px-2 py-2 text-gray-600 text-xs">{{ $k->adm_tahap1 ?? '-' }}</td>
                                <td class="px-2 py-2 text-gray-600 text-xs">{{ $k->adm_tahap2 ?? '-' }}</td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->dokumen_dikirim_soft_file ? \Carbon\Carbon::parse($k->dokumen_dikirim_soft_file)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->terbit_kontrak_kerja ? \Carbon\Carbon::parse($k->terbit_kontrak_kerja)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->terbit_paspor ? \Carbon\Carbon::parse($k->terbit_paspor)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->coe_terbit ? \Carbon\Carbon::parse($k->coe_terbit)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->pembuatan_ektkln ? \Carbon\Carbon::parse($k->pembuatan_ektkln)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->visa ? \Carbon\Carbon::parse($k->visa)->format('d/m/Y') : '-' }}</td>
                                <td class="px-2 py-2 text-gray-600 text-xs">
                                    {{ $k->jadwal_penerbangan ? \Carbon\Carbon::parse($k->jadwal_penerbangan)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-2 py-2">
                                    <div class="flex justify-center gap-1">
                                        <a href="{{ route('kandidat.edit', $k->id) }}"
                                            class="p-1.5 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition"
                                            title="Edit"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ route('kandidat.history', $k->id) }}"
                                            class="p-1.5 bg-amber-100 text-amber-600 rounded hover:bg-amber-200 transition"
                                            title="History"><i class="bi bi-clock-history"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var table = $('#tableKandidatutama').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            scrollX: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "‹",
                    next: "›"
                }
            }
        });
    </script>
@endsection
