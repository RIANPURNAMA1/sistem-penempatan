@extends('layouts.app')

@section('title', 'Daftar Kandidat')

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
    #tableUser { font-size: 11px; }
</style>

<div class="py-3">
    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center text-sm text-gray-500">
            <li><a href="{{ url('admin') }}" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
            <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li class="text-gray-700 font-medium">Daftar Kandidat</li>
        </ol>
    </nav>

    <!-- Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
        <div class="p-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-bold text-gray-800"><i class="bi bi-people-fill text-blue-600 me-2"></i>Daftar Kandidat</h2>
                    <p class="text-gray-500 text-sm">Data seluruh akun kandidat yang terdaftar</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.kandidat.export') }}" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition text-sm">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export
                    </a>
                    <a href="{{ route('admin.kandidat.downloadPdf') }}" target="_blank" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition text-sm">
                        <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
        <div class="p-4 border-b border-gray-100">
            <h5 class="font-semibold text-gray-800"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Filter Nama</label>
                    <input type="text" id="filterNama" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" placeholder="Masukkan nama kandidat...">
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button id="resetFilter" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
        <div class="overflow-x-auto">
            <table id="tableUser" class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-center">No</th>
                        <th class="px-3 py-3 font-semibold">Nama</th>
                        <th class="px-3 py-3 font-semibold">Email</th>
                        <th class="px-3 py-3 font-semibold">Tgl Dibuat</th>
                        <th class="px-3 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($kandidats as $index => $kandidat)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center text-gray-500">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-3 py-3 font-medium text-gray-800">
                                <i class="bi bi-person-circle text-blue-500 me-1"></i>
                                {{ $kandidat->name }}
                            </td>
                            <td class="px-3 py-3 text-gray-600">{{ $kandidat->email }}</td>
                            <td class="px-3 py-3 text-gray-500">{{ $kandidat->created_at->format('d/m/Y') }}</td>
                            <td class="px-3 py-3 text-center">
                                <button type="button" class="p-2 bg-red-100 text-red-600 rounded hover:bg-red-200 transition" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $kandidat->id }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal{{ $kandidat->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-xl border-0 shadow-lg">
                                    <div class="modal-header bg-red-600 text-white rounded-top-xl">
                                        <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center py-4">
                                        <i class="bi bi-person-x text-danger" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3 mb-2">Apakah Anda yakin?</h5>
                                        <p class="text-gray-500 mb-0">Anda akan menghapus:</p>
                                        <p class="font-semibold text-gray-800 mb-0">{{ $kandidat->name }}</p>
                                        <p class="text-gray-500 text-sm">{{ $kandidat->email }}</p>
                                        <div class="mt-3 p-3 bg-yellow-50 rounded-lg">
                                            <p class="text-yellow-700 text-sm mb-0"><i class="bi bi-info-circle me-1"></i>Data yang dihapus tidak dapat dikembalikan!</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center border-0 pb-3">
                                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i>Batal
                                        </button>
                                        <form action="{{ route('kandidats.user.destroy', $kandidat->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                                <i class="bi bi-trash3 me-1"></i>Ya, Hapus!
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Toast Notifications -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var table = $('#tableUser').DataTable({
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

    const filterInput = document.getElementById('filterNama');
    const resetBtn = document.getElementById('resetFilter');

    filterInput.addEventListener('input', function() {
        table.search(this.value).draw();
    });

    resetBtn.addEventListener('click', function() {
        filterInput.value = '';
        table.search('').draw();
    });
</script>
@endsection
