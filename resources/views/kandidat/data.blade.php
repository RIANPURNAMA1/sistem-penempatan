@extends('layouts.app')
@section('content')
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ✅ DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    </head>
    <style>
        #tableKandidat thead th {
            background-color: #00c0ff !important;
            color: white !important;
            text-align: center;
            vertical-align: middle;
        }

        /* Supaya efek striping tetap rapi */
        #tableKandidat tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>

    <body class="bg-light">
        <div class="">
            <h4 class="mb-3 fw-bold">Data Kandidat</h4>
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: '{{ session('success') }}',
                        timer: 20000,
                        showConfirmButton: false
                    });
                </script>
            @endif
            <!-- 🔍 Filter Section -->
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="filterCabang" class="form-label fw-semibold">Filter Cabang</label>
                            <select id="filterCabang" class="form-select">
                                <option value="">Semua Cabang</option>
                                <option value="Cabang Bandung">Cabang Bandung</option>
                                <option value="Cabang Cirebon">Cabang Cirebon</option>
                                <option value="Cabang Jakarta">Cabang Jakarta</option>
                                <option value="Cabang Bogor">Cabang Bogor</option>
                                <option value="Cabang Karawang">Cabang Karawang</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="filterStatus" class="form-label fw-semibold">Filter Status Penempatan</label>
                            <select id="filterStatus" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="MENUNGGU JOB MATCHING">MENUNGGU JOB MATCHING</option>
                                <option value="INTERVIEW">INTERVIEW</option>
                                <option value="SELESAI">SELESAI</option>
                                <option value="DITOLAK">DITOLAK</option>
                                <option value="PENDING">PENDING</option>
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

            <!-- 🧾 Data Table -->
            <!-- 🧾 Data Table -->
            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered nowrap p-2" id="tableKandidat" style="width:70%">
                        <thead>
                            <tr class="text-white text-center" style="background-color:#00c0ff;">
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Cabang</th>
                                <th>Status Kandidat</th>
                                <th>Status Interview</th>
                                <th>Penempatan</th>
                                <th>Tanggal Daftar</th>
                                <th>Jumlah Interview</th>
                                <th>Catatan Interview</th>
                                <th>Jadwal Interview</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidats as $index => $k)
                                <tr class="text-center align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $k->pendaftaran->nama ?? '-' }}</td>
                                    <td>{{ $k->cabang->nama_cabang ?? '-' }}</td>

                                    <!-- Status Kandidat -->
                                    <td>
                                        <span
                                            class="badge
                        {{ $k->status_kandidat === 'Verifikasi Dokumen' ? 'bg-warning text-dark' : '' }}
                        {{ $k->status_kandidat === 'Job Matching' ? 'bg-secondary text-white' : '' }}
                        {{ $k->status_kandidat === 'Diterima' ? 'bg-success' : '' }}
                        {{ $k->status_kandidat === 'Ditolak' ? 'bg-danger' : '' }}">
                                            {{ $k->status_kandidat }}
                                        </span>
                                    </td>

                                    <!-- Status Interview -->
                                    <td>
                                        <span
                                            class="badge
                        {{ $k->status_interview === 'Pending' ? 'bg-info text-dark' : '' }}
                        {{ $k->status_interview === 'Selesai' ? 'bg-success' : '' }}
                        {{ $k->status_interview === 'Gagal' ? 'bg-danger' : '' }}
                        {{ $k->status_interview === 'Jadwalkan Interview Ulang' ? 'bg-warning text-dark' : '' }}">
                                            {{ $k->status_interview }}
                                        </span>
                                    </td>

                                    <!-- Penempatan -->
                                    <td>{{ $k->institusi->nama_institusi ?? '-' }}</td>

                                    <!-- Tanggal Daftar -->
                                    <td>{{ $k->pendaftaran->tanggal_daftar ? \Carbon\Carbon::parse($k->pendaftaran->tanggal_daftar)->format('d F Y') : '-' }}
                                    </td>

                                    <!-- Jumlah Interview -->
                                    <td>{{ $k->jumlah_interview ?? 0 }}</td>

                                    <!-- Catatan Interview -->
                                    <td>{{ $k->catatan_interview ?? '-' }}</td>

                                    <!-- Jadwal Interview -->
                                    <td>{{ $k->jadwal_interview ? \Carbon\Carbon::parse($k->jadwal_interview)->format('d F Y') : '-' }}
                                    </td>

                                    <!-- Aksi -->
                                    <td>
                                        <a href="{{ route('kandidat.edit', $k->id) }}"
                                            class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
