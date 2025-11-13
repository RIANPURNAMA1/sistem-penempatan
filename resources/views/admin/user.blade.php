@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
<div class="">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                <i class="bi bi-person-badge me-1"></i> Daftar Kandidat
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="mb-4 text-center text-md-start">
        <h2 class="fw-bold mb-2">
            <i class="bi bi-person-check text-success me-2"></i> Daftar Kandidat
        </h2>
        <p class="text-muted fst-italic">
            Berikut adalah data akun kandidat yang terdaftar dalam sistem.
        </p>
    </div>

    <!-- Filter dan Tombol -->
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header py-3 px-4 bg-white border-bottom-0">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h6 class="fw-semibold mb-0 text-secondary">
                    <i class="bi bi-funnel me-1"></i> Filter Data
                </h6>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <button class="btn btn-success btn-sm fw-semibold shadow-sm">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </button>
                    <button class="btn btn-primary btn-sm fw-semibold shadow-sm">
                        <i class="bi bi-file-earmark-arrow-up me-1"></i> Import Data
                    </button>
                    <button class="btn btn-danger btn-sm fw-semibold shadow-sm">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="filterRole" class="form-label fw-semibold text-secondary">Filter Nama Kandidat</label>
                    <input type="text" id="filterRole" class="form-control shadow-sm rounded-3 border-1" placeholder="Masukkan nama kandidat...">
                </div>
                <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end align-items-end">
                    <button id="resetFilter" class="btn btn-outline-dark fw-semibold shadow-sm px-4 py-2 rounded-3">
                        <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered align-middle nowrap" id="tableKandidat" style="width:100%">
                <thead class="" style="background-color: #ffc107;">
                    <tr>
                        <th class="text-white">No</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Tanggal Dibuat</th>
                        <th class="text-white">Diperbarui</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $kandidats = [
                            ['name' => 'Rian Purnama', 'email' => 'rian@example.com', 'role' => 'kandidat', 'created_at' => '2025-01-02', 'updated_at' => '2025-02-05'],
                            ['name' => 'Siti Rahmawati', 'email' => 'siti@example.com', 'role' => 'kandidat', 'created_at' => '2025-03-10', 'updated_at' => '2025-03-25'],
                            ['name' => 'Ahmad Fauzan', 'email' => 'ahmad@example.com', 'role' => 'kandidat', 'created_at' => '2025-04-01', 'updated_at' => '2025-04-15'],
                            ['name' => 'Nadia Putri', 'email' => 'nadia@example.com', 'role' => 'kandidat', 'created_at' => '2025-05-12', 'updated_at' => '2025-05-18'],
                            ['name' => 'Eka Wulandari', 'email' => 'eka@example.com', 'role' => 'kandidat', 'created_at' => '2025-09-09', 'updated_at' => '2025-09-21'],
                        ];
                    @endphp

                    @foreach ($kandidats as $index => $kandidat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kandidat['name'] }}</td>
                            <td>{{ $kandidat['email'] }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($kandidat['role']) }}</span></td>
                            <td>{{ $kandidat['created_at'] }}</td>
                            <td>{{ $kandidat['updated_at'] }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger text-white" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    #tableKandidat thead th {
        background-color: #00c0ff !important;
        color: white !important;
        text-align: center;
        vertical-align: middle;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 2px;
        padding: 6px 12px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #ffc107 !important;
        color: #000 !important;
        border: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #ffe082 !important;
        color: #000 !important;
    }

    @media (max-width: 768px) {
        h2 { font-size: 1.3rem; }
        .breadcrumb { font-size: 0.9rem; }
        .btn-group .btn { padding: 0.3rem 0.5rem; }
        th, td { white-space: nowrap; font-size: 0.85rem; }
        .d-flex.gap-2 { flex-direction: column; width: 100%; }
    }
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        const table = $('#tableKandidat').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "← Sebelumnya",
                    next: "Berikutnya →"
                },
                zeroRecords: "Tidak ada data ditemukan"
            }
        });

        $('#filterRole').on('keyup', function () {
            table.column(1).search(this.value).draw(); // Filter berdasarkan nama kandidat
        });

        $('#resetFilter').on('click', function () {
            $('#filterRole').val('');
            table.columns().search('').draw();
        });
    });
</script>
@endsection
