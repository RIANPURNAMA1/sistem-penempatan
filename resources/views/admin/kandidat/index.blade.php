@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Kandidat</li>
    </ol>
</nav>

<div class="container">
    <h3 class="mb-3">Kandidat Cabang {{ $dataKandidat->first()->cabang->nama_cabang ?? 'Anda' }}</h3>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <label for="filterCabang" class="form-label fw-semibold">Filter Cabang</label>
                    <select id="filterCabang" class="form-select">
                        <option value="">Semua Cabang</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->nama_cabang }}">{{ $cabang->nama_cabang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label for="filterStatus" class="form-label fw-semibold">Filter Status Kandidat</label>
                    <select id="filterStatus" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach (['Job Matching', 'Pending', 'Interview', 'Gagal Interview', 'Jadwalkan Interview Ulang', 'Lulus interview', 'Pemberkasan', 'Berangkat', 'Ditolak'] as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-4 text-md-end">
                    <button id="resetFilter" class="btn btn-outline-secondary mt-3 mt-md-0">
                        <i class="bi bi-arrow-repeat"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered nowrap" id="tableKandidat" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Cabang</th>
                        <th>Status Kandidat</th>
                        <th>Penempatan</th>
                        <th>Tanggal Daftar</th>
                        <th>Jumlah Interview</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKandidat as $kandidat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kandidat->pendaftaran->nama ?? '-' }}</td>
                            <td>{{ $kandidat->pendaftaran->email ?? '-' }}</td>
                            <td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>
                            <td>{{ $kandidat->status_kandidat }}</td>
                            <td>{{ $kandidat->institusi->nama_perusahaan ?? '-' }}</td>
                            <td>{{ $kandidat->created_at->format('Y-m-d') }}</td>
                            <td>{{ $kandidat->jumlah_interview }}</td>
                            <td class="text-center">
                                <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Dependencies -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#tableKandidat').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data ditemukan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "←", next: "→" }
        }
    });

    // Filter Cabang (kolom 3)
    $('#filterCabang').on('change', function() {
        var val = $(this).val();
        table.column(3).search(val, false, true, false).draw();
    });

    // Filter Status Kandidat (kolom 4)
    $('#filterStatus').on('change', function() {
        var val = $(this).val();
        table.column(4).search(val, false, true, false).draw();
    });

    // Reset Filter
    $('#resetFilter').on('click', function() {
        $('#filterCabang').val('');
        $('#filterStatus').val('');
        table.columns().search('').draw();
    });
});
</script>
@endsection
