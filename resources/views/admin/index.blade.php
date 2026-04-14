@extends('layouts.app')

@section('title', 'Daftar Admin')

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
    #tableAdmin { font-size: 11px; }
</style>

<div class="py-3">
    @if (session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Sukses', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });</script>
    @endif
    @if (session('error'))
        <script>Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}', timer: 3000, showConfirmButton: false });</script>
    @endif

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
            <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
            <li class="text-gray-700 font-medium">Daftar Admin</li>
        </ol>
    </nav>

    <!-- Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
        <div class="p-4 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="font-bold text-gray-800"><i class="bi bi-shield-lock text-blue-600 me-2"></i>Daftar Admin Sistem</h2>
                <p class="text-gray-500 text-sm">Data akun admin yang terdaftar dalam sistem</p>
            </div>
            <a href="{{ route('admins.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Admin
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
        <div class="overflow-x-auto">
            <table id="tableAdmin" class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-center">No</th>
                        <th class="px-3 py-3 font-semibold">Nama</th>
                        <th class="px-3 py-3 font-semibold">Email</th>
                        <th class="px-3 py-3 font-semibold">Role</th>
                        <th class="px-3 py-3 font-semibold">Tgl Dibuat</th>
                        <th class="px-3 py-3 font-semibold">Diperbarui</th>
                        <th class="px-3 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($admins as $index => $admin)
                        @if ($admin->role !== 'kandidat')
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-3 text-center text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-3 py-3 font-medium text-gray-800">{{ $admin->name }}</td>
                                <td class="px-3 py-3 text-gray-600">{{ $admin->email }}</td>
                                <td class="px-3 py-3">
                                    @php
                                        $roleName = $admin->role ?? 'Tidak Ada';
                                        $badgeClass = match(strtolower($roleName)) {
                                            'super admin' => 'bg-red-100 text-red-700',
                                            'super-admin' => 'bg-red-100 text-red-700',
                                            default => 'bg-blue-100 text-blue-700',
                                        };
                                        $displayRole = str_replace(['Cabang ', ' Mendunia'], '', $roleName);
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">{{ ucfirst($displayRole) }}</span>
                                </td>
                                <td class="px-3 py-3 text-gray-500">{{ $admin->created_at->format('d/m/Y') }}</td>
                                <td class="px-3 py-3 text-gray-500">{{ $admin->updated_at->format('d/m/Y') }}</td>
                                <td class="px-3 py-3 text-center">
                                    <div class="inline-flex items-center gap-1">
                                        <a href="{{ route('admins.edit', $admin->id) }}" class="p-1.5 bg-amber-100 text-amber-600 rounded hover:bg-amber-200 transition" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="inline delete-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-red-100 text-red-600 rounded hover:bg-red-200 transition" title="Hapus">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
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
    var table = $('#tableAdmin').DataTable({
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

    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data admin akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
