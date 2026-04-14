@extends('layouts.app')

@section('title', 'Daftar Institusi')

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
    #tableInstitusi { font-size: 11px; }
</style>

<div class="py-3">
    @if (session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Sukses', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });</script>
    @endif

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center text-sm text-gray-500">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
            <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li class="text-gray-700 font-medium">Daftar Institusi</li>
        </ol>
    </nav>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
        <div class="p-4 border-b border-gray-100">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h5 class="font-semibold text-gray-800"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
            </div>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Filter Alamat</label>
                    <input type="text" id="filterKota" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" placeholder="Masukkan nama kota...">
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button id="resetFilter" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
                <div class="flex items-end justify-end">
                    <a href="{{ route('institusi.create') }}" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition text-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
        <div class="overflow-x-auto">
            <table id="tableInstitusi" class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-center">No</th>
                        <th class="px-3 py-3 font-semibold">Perusahaan Penempatan</th>
                        <th class="px-3 py-3 font-semibold">Tgl Dibuat</th>
                        <th class="px-3 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($institusis as $index => $institusi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-3 py-3 font-medium text-gray-800">{{ $institusi->perusahaan_penempatan ?? '-' }}</td>
                            <td class="px-3 py-3 text-gray-500">{{ $institusi->created_at->format('d/m/Y') }}</td>
                            <td class="px-3 py-3 text-center">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('institusi.edit', $institusi->id) }}" class="p-1.5 bg-amber-100 text-amber-600 rounded hover:bg-amber-200 transition" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('institusi.destroy', $institusi->id) }}" method="POST" class="inline delete-form">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 bg-red-100 text-red-600 rounded hover:bg-red-200 transition btn-delete" title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
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
    var table = $('#tableInstitusi').DataTable({
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

    const filterInput = document.getElementById('filterKota');
    const resetBtn = document.getElementById('resetFilter');

    filterInput.addEventListener('keyup', function() {
        table.search(this.value).draw();
    });

    resetBtn.addEventListener('click', function() {
        filterInput.value = '';
        table.search('').draw();
    });

    $(document).on("click", ".btn-delete", function(e) {
        e.preventDefault();
        let form = $(this).closest("form");
        Swal.fire({
            title: "Yakin menghapus data?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
