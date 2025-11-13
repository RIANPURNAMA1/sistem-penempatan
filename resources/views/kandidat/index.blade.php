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
    <div class="container">
        <h4 class="mb-3 fw-bold">Data Kandidat</h4>

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
                <table class="table table-striped table-bordered nowrap" id="tableKandidat" style="width:100%">
                    <thead>
                        <tr style="background-color: #00c0ff; color:white; text-align:center; vertical-align:middle;">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Cabang</th>
                            <th>Status Kandidat</th>
                            <th>Status Interview</th>
                            <th>Penempatan</th>
                            <th>Tanggal Daftar</th>
                            <th>Jumlah Interview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 25; $i++)
                            @php
                                // Cabang random
                                $cabangList = [
                                    'Cabang Bandung',
                                    'Cabang Cirebon',
                                    'Cabang Jakarta',
                                    'Cabang Bogor',
                                    'Cabang Karawang',
                                ];
                                $cabang = $cabangList[array_rand($cabangList)];

                                // Status kandidat random
                                $statusKandidatList = [
                                    'Verifikasi Dokumen',
                                    'Menunggu Job Matching',
                                    'Diterima',
                                    'Ditolak',
                                ];
                                $statusKandidat = $statusKandidatList[array_rand($statusKandidatList)];

                                // Status interview random
                                $statusInterviewList = ['PENDING', 'SELESAI', 'DITOLAK'];
                                $statusInterview = $statusInterviewList[array_rand($statusInterviewList)];

                                // Penempatan random: 50% chance belum ditempatkan
                                $penempatanList = ['-', 'Institusi A', 'Institusi B', 'Institusi C'];
                                $penempatan = $penempatanList[array_rand($penempatanList)];

                                // Jumlah interview dummy
                                $jumlahInterview = rand(1, 5);
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Nama Kandidat {{ $i }}</td>
                                <td>{{ $cabang }}</td>
                                <td>
                                    <span
                                        class="badge 
                {{ $statusKandidat === 'Verifikasi Dokumen' ? 'bg-warning text-dark' : '' }}
                {{ $statusKandidat === 'Menunggu Job Matching' ? 'bg-secondary text-white' : '' }}
                {{ $statusKandidat === 'Diterima' ? 'bg-success' : '' }}
                {{ $statusKandidat === 'Ditolak' ? 'bg-danger' : '' }}">
                                        {{ $statusKandidat }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge 
                {{ $statusInterview === 'PENDING' ? 'bg-info text-dark' : '' }}
                {{ $statusInterview === 'SELESAI' ? 'bg-success' : '' }}
                {{ $statusInterview === 'DITOLAK' ? 'bg-danger' : '' }}">
                                        {{ $statusInterview }}
                                    </span>
                                </td>
                                <td>
                                    @if ($penempatan === '-')
                                        -
                                    @else
                                        <span class="badge bg-primary">{{ $penempatan }}</span>
                                    @endif
                                </td>
                                <td>2025-01-{{ sprintf('%02d', $i) }}</td>
                                <td><span class="badge bg-secondary">{{ $jumlahInterview }}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-warning text-white"><i
                                            class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endfor


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
