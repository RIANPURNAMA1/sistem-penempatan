@extends('layouts.app')
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
                  <i class="bi bi-person-lines-fill"></i> Daftar Interview
            </li>
        </ol>
    </nav>


    <!-- Header -->
    <h4 class="fw-bold mb-3 ">
        <i class="bi bi-person-lines-fill me-2"></i>Data Interview Kandidat
    </h4>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end justify-content-between">
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="filterStatus" class="form-label fw-semibold text-secondary">
                        Filter Status Interview
                    </label>
                    <select id="filterStatus" class="form-select shadow-sm rounded-3 border-1">
                        <option value="">Semua Status</option>
                        <option value="PENDING">PENDING</option>
                        <option value="TERJADWAL">TERJADWAL</option>
                        <option value="LULUS">LULUS</option>
                        <option value="TIDAK_LULUS">TIDAK LULUS</option>
                        <option value="ULANG_INTERVIEW">ULANG INTERVIEW</option>
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
            <table id="tableInterview" class="table table-striped table-bordered nowrap w-100">
                <thead class="text-white" style="background-color: #00c0ff;">
                    <tr>
                        <th class="text-white">No</th>
                        <th class="text-white">Nama Siswa</th>
                        <th class="text-white">Tanggal Interview</th>
                        <th class="text-white">Status Interview</th>
                        <th class="text-white">Jumlah Interview</th>
                        <th class="text-white">Catatan</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Andi Pratama</td>
                        <td>2025-01-15</td>
                        <td><span class="badge bg-info text-dark">TERJADWAL</span></td>
                        <td>Interview dijadwalkan ulang minggu depan.</td>
                        <td>
                            <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Rahma</td>
                        <td>2025-02-10</td>
                        <td><span class="badge bg-success">LULUS</span></td>
                        <td>Lulus interview dan siap penempatan.</td>
                        <td>
                            <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Budi Setiawan</td>
                        <td>2025-03-05</td>
                        <td><span class="badge bg-danger">TIDAK_LULUS</span></td>
                        <td>Kurang komunikasi, disarankan ikut ulang interview.</td>
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
        var table = $('#tableInterview').DataTable({
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
