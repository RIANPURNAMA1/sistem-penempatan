@extends('layouts.app')
@section('content')
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ✅ DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    </head>
    </style>

    <body class="bg-light">
        <div class="">
            <h4 class="mb-3 fw-bold">Data Kandidat</h4>

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
                            <label for="filterStatus" class="form-label fw-semibold">Filter Status Kandidat</label>
                            <select id="filterStatus" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Job Matching">Job Matching</option>
                                <option value="Berangkat">Berangkat</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>

                        <!-- Reset Filter -->
                        <div class="col-12 col-md-4 text-md-end">
                            <button id="resetFilter" class="btn btn-outline-secondary mt-3 mt-md-0">
                                <i class="bi bi-arrow-repeat"></i> Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 🧾 Data Table -->
            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered p-2 w-100">
                        <thead>
                            <tr class="text-white text-center" style="background-color:#00c0ff;">
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Cabang</th>
                                <th>Status Kandidat</th>
                                <th>Penempatan</th>
                                <th>Bidang Pekerjaan</th>
                                <th>Tanggal Daftar</th>
                                <th>Jumlah Interview</th>
                                <th>Catatan Interview</th>
                                <th>Jadwal Interview</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kandidats as $index => $k)
                                <tr class="text-center align-middle">
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- Nama -->
                                    <td>{{ $k->pendaftaran->nama ?? '-' }}</td>

                                    <!-- Cabang -->
                                    <td>{{ $k->cabang->nama_cabang ?? '-' }}</td>

                                    <!-- Badge Status -->
                                    <td>
                                        @php
                                            $statusColors = [
                                                'Job Matching' => 'secondary',
                                                'Pending' => 'warning',
                                                'Interview' => 'info',
                                                'Gagal Interview' => 'danger',
                                                'Jadwalkan Interview Ulang' => 'dark',
                                                'Lulus interview' => 'primary',
                                                'Pemberkasan' => 'info',
                                                'Berangkat' => 'primary',
                                                'Diterima' => 'success',
                                                'Ditolak' => 'danger',
                                            ];
                                        @endphp

                                        <span class="badge bg-{{ $statusColors[$k->status_kandidat] ?? 'secondary' }}">
                                            {{ $k->status_kandidat }}
                                        </span>
                                    </td>

                                    <!-- Penempatan -->
                                    <td>{{ $k->institusi->nama_perusahaan ?? '-' }}</td>

                                    <!-- Bidang -->
                                    <td>{{ $k->institusi->bidang_pekerjaan ?? '-' }}</td>

                                    <!-- Tanggal Daftar -->
                                    <td>
                                        {{ $k->pendaftaran->tanggal_daftar
                                            ? \Carbon\Carbon::parse($k->pendaftaran->tanggal_daftar)->format('d F Y')
                                            : '-' }}
                                    </td>

                                    <!-- Jumlah Interview -->
                                    <td>{{ $k->jumlah_interview ?? 0 }}</td>

                                    <!-- Catatan Interview -->
                                    <td>{{ $k->catatan_interview ?? '-' }}</td>

                                    <!-- Jadwal Interview -->
                                    <td>
                                        {{ $k->jadwal_interview ? \Carbon\Carbon::parse($k->jadwal_interview)->format('d F Y') : '-' }}
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td>
                                        <a href="{{ route('kandidat.edit', $k->id) }}"
                                            class="btn btn-sm btn-warning text-white mb-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="{{ route('kandidat.history', $k->id) }}" class="btn btn-info btn-sm mb-1"
                                            title="History">
                                            <i class="bi bi-clock-history"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted p-3">Tidak ada data kandidat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>




                </div>
            </div>

        </div>
       

        <!-- ✅ Dependencies -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <!-- ✅ DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                var table = $('#tableKandidat').DataTable({
                    responsive: true,
                    pageLength: 5, // tampilkan 5 baris per halaman
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

                $('#filterCabang').on('change', function() {
                    table.column(2).search(this.value).draw();
                });

                $('#filterStatus').on('change', function() {
                    table.column(3).search(this.value).draw();
                });

                $('#resetFilter').on('click', function() {
                    $('#filterCabang').val('');
                    $('#filterStatus').val('');
                    table.columns().search('').draw();
                });
            });
        </script>
    @endsection
