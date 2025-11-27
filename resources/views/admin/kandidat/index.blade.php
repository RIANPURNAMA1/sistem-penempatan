@extends('layouts.app')

@section('content')
    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Kandidat</li>
        </ol>
    </nav>

    <div class="">
        <h3 class="mb-3">Kandidat Cabang {{ $dataKandidat->first()->cabang->nama_cabang ?? 'Anda' }}</h3>
        <!-- 🔍 Filter Section -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <!-- Filter Cabang -->
                    <div class="col-12 col-md-4">
                        <label for="filterCabang" class="form-label fw-semibold">Filter Cabang</label>
                        <select id="filterCabang" class="form-select">
                            <option value="">Semua Cabang</option>
                            @foreach ($cabangs as $cabang)
                                <option value="{{ $cabang->nama_cabang }}">{{ $cabang->nama_cabang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Status Kandidat -->
                    <div class="col-12 col-md-4">
                        @php
                            $statuses = [
                                'Job Matching',
                                'Pending',
                                'Interview',
                                'Gagal Interview',
                                'Jadwalkan Interview Ulang',
                                'Lulus interview',
                                'Pemberkasan',
                                'Berangkat',
                                'Diterima',
                                'Ditolak',
                            ];
                        @endphp

                        <label for="filterStatus" class="form-label fw-semibold">Filter Status Kandidat</label>
                        <select id="filterStatus" class="form-select">
                            <option value="">Semua Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Reset Filter -->
                    <div class="col-12 col-md-4 text-md-end">
                        <button id="resetFilter" class="btn btn-outline-info mt-3 mt-md-0">
                            <i class="bi bi-arrow-repeat"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered nowrap" id="cabang" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Cabang</th>
                            <th>Status Kandidat</th>
                            <th>Penempatan</th>
                            <th>Tanggal Daftar</th>
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
                                <td class="text-center">
                                    <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('kandidat.history', $kandidat->id) }}"
                                        class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <div class="mt-4 d-flex justify-content-end">
                        {{ $kandidatsFiltered->links('pagination::bootstrap-5') }}
                    </div>

                </table>
            </div>
        </div>
    </div>
    <!-- JS Dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Inisialisasi DataTables
        var table = $('#cabang').DataTable({
            responsive: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });

        // Custom filter untuk Cabang dan Status
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var selectedCabang = $('#filterCabang').val();
                var selectedStatus = $('#filterStatus').val();

                // Ambil elemen row
                var rowNode = table.row(dataIndex).node();

                // Ambil teks cabang dan status
                var cabang = $('td:eq(3)', rowNode).text().trim(); // kolom Cabang
                var status = $('td:eq(4)', rowNode).text().trim(); // kolom Status Kandidat

                var cabangMatch = selectedCabang === "" || cabang === selectedCabang;
                var statusMatch = selectedStatus === "" || status === selectedStatus;

                return cabangMatch && statusMatch;
            }
        );

        // Event filter change
        $('#filterCabang, #filterStatus').on('change', function() {
            table.draw(); // redraw tabel dengan filter baru
        });

        // Reset filter
        $('#resetFilter').on('click', function() {
            $('#filterCabang').val('');
            $('#filterStatus').val('');
            table.draw();
        });
    </script>
@endsection
