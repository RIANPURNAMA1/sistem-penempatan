@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <div class=" ">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Daftar Kandidat
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-4 text-center text-md-start">
            <h2 class="fw-bold  mb-2">
                <i class="bi bi-person-lines-fill text-warning me-2"></i> Daftar Kandidat
            </h2>
            <p class="text-muted fst-italic">
                Berikut adalah data pendaftaran kandidat yang telah masuk dalam sistem.
            </p>
        </div>

        <!-- Filter -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header py-3 px-4 rounded-top-4 bg-white border-bottom-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold mb-0 text-secondary">
                            <i class="bi bi-funnel me-1"></i> Filter Data
                        </h6>
                    </div>
                    <!-- Tombol Import, Export & PDF -->
                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        <button class="btn btn-success btn-sm fw-semibold shadow-sm">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export Data
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
                    <!-- Filter Cabang -->
                    <div class="col-12 col-md-6 col-lg-6">
                        <label for="filterCabang" class="form-label fw-semibold text-secondary">Cabang</label>
                        <select id="filterCabang" class="form-select shadow-sm rounded-3 border-1">
                            <option value="">Semua Cabang</option>
                            <option value="Cabang Bandung">Cabang Bandung</option>
                            <option value="Cabang Cirebon">Cabang Cirebon</option>
                            <option value="Cabang Jakarta">Cabang Jakarta</option>
                            <option value="Cabang Bogor">Cabang Bogor</option>
                            <option value="Cabang Karawang">Cabang Karawang</option>
                        </select>
                    </div>

                    <!-- Tombol Reset -->
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
                    <thead style="background-color: #00c0ff">
                        <tr>
                            <th class="text-white">No</th>
                            <th class="text-white">Foto</th>
                            <th class="text-white">Nama</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">Alamat</th>
                            <th class="text-white">Jenis Kelamin</th>
                            <th class="text-white">No WA</th>
                            <th class="text-white">Cabang</th>
                            <th class="text-white">KK</th>
                            <th class="text-white">KTP</th>
                            <th class="text-white">Bukti Pelunasan</th>
                            <th class="text-white">Akte</th>
                            <th class="text-white">Ijazah</th>
                            <th class="text-white">Tanggal Daftar</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 100; $i++)
                            @php
                                $gender = $i % 2 == 0 ? 'Laki-laki' : 'Perempuan';
                                $cabangList = [
                                    'Cabang Bandung',
                                    'Cabang Cirebon',
                                    'Cabang Jakarta',
                                    'Cabang Bogor',
                                    'Cabang Karawang',
                                ];
                                $cabang = $cabangList[array_rand($cabangList)];
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td><img src="https://via.placeholder.com/50" class="rounded-circle border" alt="Foto">
                                </td>
                                <td>Nama Kandidat {{ $i }}</td>
                                <td>kandidat{{ $i }}@email.com</td>
                                <td>Jl. Contoh No.{{ $i }}, Kota Contoh</td>
                                <td>{{ $gender }}</td>
                                <td>0812345678{{ $i }}</td>
                                <td>{{ $cabang }}</td>
                                <td><a href="#" class="text-decoration-none text-primary"><i
                                            class="bi bi-file-earmark-text"></i> Lihat</a></td>
                                <td><a href="#" class="text-decoration-none text-primary"><i
                                            class="bi bi-file-earmark-person"></i> Lihat</a></td>
                                <td><a href="#" class="text-decoration-none text-primary"><i
                                            class="bi bi-file-earmark-check"></i> Lihat</a></td>
                                <td><a href="#" class="text-decoration-none text-primary"><i
                                            class="bi bi-file-earmark-richtext"></i> Lihat</a></td>
                                <td><a href="#" class="text-decoration-none text-primary"><i
                                            class="bi bi-file-earmark-zip"></i> Lihat</a></td>
                                <td>2025-01-{{ sprintf('%02d', $i) }}</td>
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
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
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
            h2 {
                font-size: 1.3rem;
            }

            .breadcrumb {
                font-size: 0.9rem;
            }

            .btn-group .btn {
                padding: 0.3rem 0.5rem;
            }

            table img {
                width: 40px;
                height: 40px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            th,
            td {
                white-space: nowrap;
                font-size: 0.85rem;
            }

            .d-flex.gap-2 {
                flex-direction: column;
                width: 100%;
            }
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
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

            $('#filterCabang').on('change', function() {
                table.column(7).search(this.value).draw();
            });

            $('#resetFilter').on('click', function() {
                $('#filterCabang').val('');
                table.columns().search('').draw();
            });
        });
    </script>
@endsection
