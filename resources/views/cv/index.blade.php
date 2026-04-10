@extends('layouts.app')

@section('title', 'Daftar CV')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, .table, .form-label, .form-select, .btn, div, span, th, td {
        font-family: 'Inter', sans-serif !important;
        font-size: 12px !important;
    }
    .table th, .table td { padding: 8px 10px; }
    .table .badge { font-size: 10px; }
    .table .btn { padding: 3px 6px; font-size: 11px; }
    .form-select, .btn { font-size: 12px; }
    .dataTables_length select, .dataTables_filter input { font-size: 11px; }
    .dataTables_info, .dataTables_paginate { font-size: 11px; }
    #tableCv { font-size: 11px; }
</style>

<div class="py-3">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center text-sm text-gray-500">
            <li><a href="#" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
            <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li class="text-gray-700 font-medium">Daftar CV Kandidat</li>
        </ol>
    </nav>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
        <div class="p-4 border-b border-gray-100">
            <h5 class="font-semibold text-gray-800"><i class="bi bi-funnel me-2"></i>Filter & Pencarian</h5>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Cabang</label>
                    <form action="/data/cv/kandidat" method="GET" id="filterForm">
                        <select name="cabang_id" id="filterCabang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Cabang</option>
                            @foreach ($cabang as $item)
                                <option value="{{ $item->id }}" {{ request('cabang_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_cabang }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Cari Kandidat</label>
                    <input type="text" id="searchInput" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" placeholder="Cari nama, email, atau alamat...">
                </div>
                <div class="flex items-end">
                    <button id="resetFilter" class="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <p class="text-sm text-gray-500 mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Total: <span class="font-semibold text-blue-600" id="totalCount">{{ count($cvs) }}</span> kandidat
                    <span class="ml-2" id="filteredInfo"></span>
                </p>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
        <div class="overflow-x-auto">
            <table id="tableCv" class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-center">Foto</th>
                        <th class="px-3 py-3 font-semibold">Nama</th>
                        <th class="px-3 py-3 font-semibold text-center">JK</th>
                        <th class="px-3 py-3 font-semibold">Email</th>
                        <th class="px-3 py-3 font-semibold">No. Telp</th>
                        <th class="px-3 py-3 font-semibold">Alamat</th>
                        <th class="px-3 py-3 font-semibold">Cabang</th>
                        <th class="px-3 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($cvs as $cv)
                        <tr class="cv-item hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center">
                                <a href="{{ route('cv.show', $cv->id) }}">
                                    @if ($cv->pas_foto_cv)
                                        <img src="{{ asset($cv->pas_foto_cv) }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-content mx-auto">
                                            <i class="bi bi-person-circle text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                </a>
                            </td>
                            <td class="px-3 py-3 font-medium text-gray-800">
                                {{ $cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? 'Nama Tidak Tersedia') }}
                            </td>
                            <td class="px-3 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $cv->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                    {{ $cv->jenis_kelamin ?? '-' }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-gray-600">{{ $cv->email_aktif ?? ($cv->email ?? '-') }}</td>
                            <td class="px-3 py-3 text-gray-600">{{ $cv->no_telepon ?? '-' }}</td>
                            <td class="px-3 py-3 text-gray-500 max-w-[150px] truncate">{{ $cv->alamat_lengkap }}</td>
                            <td class="px-3 py-3">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">{{ $cv->cabang->nama_cabang ?? '-' }}</span>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <div class="inline-flex items-center">
                                    <button class="p-1.5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded transition" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-xl py-1 min-w-[140px]">
                                        <li><a class="dropdown-item py-2 px-3 text-xs" href="{{ route('cv.show.pdf', $cv->id) }}"><i class="bi bi-file-pdf me-2 text-red-500"></i>CV Kaigo</a></li>
                                        <li><a class="dropdown-item py-2 px-3 text-xs" href="{{ route('cv.show.pdf.violeta', $cv->id) }}"><i class="bi bi-file-pdf me-2 text-red-500"></i>CV Violeta</a></li>
                                        <li><a class="dropdown-item py-2 px-3 text-xs" href="{{ route('cv.show.pdf.nawasena', $cv->id) }}"><i class="bi bi-file-pdf me-2 text-red-500"></i>CV Nawasena</a></li>
                                        <li><a class="dropdown-item py-2 px-3 text-xs" href="{{ route('cv.show.pdf.yambo', $cv->id) }}"><i class="bi bi-file-pdf me-2 text-red-500"></i>CV Yambo</a></li>
                                        <li><a class="dropdown-item py-2 px-3 text-xs" href="{{ route('cv.show.pdf.madoka', $cv->id) }}"><i class="bi bi-file-pdf me-2 text-red-500"></i>CV Madoka</a></li>
                                        <li><a class="dropdown-item py-2 px-3 text-xs" href="{{ route('cv.show.pdf.mendunia', $cv->id) }}"><i class="bi bi-file-pdf me-2 text-red-500"></i>CV Mendunia</a></li>
                                        <li><hr class="my-1"></li>
                                        <li><button class="dropdown-item py-2 px-3 text-xs text-red-500 btn-delete" data-id="{{ $cv->id }}" data-name="{{ $cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? 'Kandidat') }}"><i class="bi bi-trash me-2"></i>Hapus</button></li>
                                    </ul>
                                </div>
                                <form id="delete-form-{{ $cv->id }}" action="{{ route('cv.destroy', $cv->id) }}" method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
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
    var table = $('#tableCv').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data ditemukan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "‹", next: "›" }
        }
    });

    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
        $('#filteredInfo').text(this.value ? '(Filtered)' : '');
    });

    $('#resetFilter').on('click', function() {
        $('#searchInput').val('');
        $('#filterCabang').val('');
        table.search('').draw();
        $('#filteredInfo').text('');
        window.location.href = '/data/cv/kandidat';
    });

    $(document).on('click', '.btn-delete', function() {
        let btn = $(this);
        let id = btn.data('id');
        let name = btn.data('name');

        Swal.fire({
            title: 'Yakin hapus CV?',
            text: `Data CV "${name}" akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete-form-${id}`).submit();
            }
        });
    });
</script>
@endsection
