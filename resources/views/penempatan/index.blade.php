@extends('layouts.app')
@section('content')
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>

    
    <div class="container-fluid">

       
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                   <i class="bi bi-building-check"></i> Daftar Penempatan Kandidat
            </li>
        </ol>
    </nav>


        <!-- Header -->
        <h4 class="fw-bold mb-3">
            <i class="bi bi-briefcase-fill me-2"></i>Data Penempatan Kandidat
        </h4>

        <!-- Filter Section -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-end justify-content-between">
                    <div class="col-12 col-md-6 col-lg-6">
                        <label for="filterStatus" class="form-label fw-semibold text-secondary">
                            Filter Status Penempatan
                        </label>
                        <select id="filterStatus" class="form-select shadow-sm rounded-3 border-1">
                            <option value="">Semua Status</option>
                            <option value="INTERVIEW">INTERVIEW</option>
                            <option value="SUDAH_BERANGKAT">SUDAH BERANGKAT</option>
                            <option value="VERIFIKASI_DATA">VERIFIKASI DATA</option>
                            <option value="PENDING">PENDING</option>
                            <option value="MENUNGGU_JOB_MATCHING">MENUNGGU JOB MATCHING</option>
                            <option value="SELESAI">SELESAI</option>
                            <option value="DITOLAK">DITOLAK</option>
                        </select>
                    </div>

                    <!-- Tombol Reset -->
                    <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-md-end">
                        <button id="resetFilter" class="btn btn-outline-dark fw-semibold shadow-sm">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table id="tablePenempatan" class="table table-striped table-bordered nowrap w-100">
                    <thead class="text-white" style="background-color: #00c0ff;">
                        <tr>
                            <th class="text-white">No</th>
                            <th class="text-white">Nama Siswa</th>
                            <th class="text-white">Institusi</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Tanggal Update</th>
                            <th class="text-white">Tanggal Mulai</th>
                            <th class="text-white">Tanggal Selesai</th>
                            <th class="text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Andi Pratama</td>
                            <td>PT Maju Jaya</td>
                            <td><span class="badge bg-warning text-dark">MENUNGGU_JOB_MATCHING</span></td>
                            <td>2025-01-15 10:30:00</td>
                            <td>2025-02-01</td>
                            <td>2025-08-01</td>
                            <td>
                                <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Siti Rahma</td>
                            <td>CV Sinar Abadi</td>
                            <td><span class="badge bg-success">SELESAI</span></td>
                            <td>2025-03-10 09:20:00</td>
                            <td>2025-01-10</td>
                            <td>2025-06-10</td>
                            <td>
                                <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JS CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#tablePenempatan').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(disaring dari _MAX_ total data)"
                },
                pageLength: 5
            });

            // Filter berdasarkan status
            $('#filterStatus').on('change', function() {
                table.column(3).search(this.value).draw();
            });

            // Reset filter
            $('#resetFilter').on('click', function() {
                $('#filterStatus').val('');
                table.columns().search('').draw();
            });
        });
    </script>
@endsection
