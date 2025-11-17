@extends('layouts.app')
@section('content')
    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    </head>
    </style>

    <body class="">
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
        <div class="">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                    <li class="breadcrumb-item">
                        <a href="#" class="text-decoration-none text-secondary">
                            <i class="bi bi-house-door me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active  fw-semibold" aria-current="page">
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
                    Berikut adalah data kandidat yang telah masuk dalam sistem.
                </p>
            </div>
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
            <!-- 🧾 Data Table -->
            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table id="tableKandidatutama" class="table table-hover table-bordered p-2 w-100">
                        <thead class="">
                            <tr class="text-white text-center">
                                <th>No</th>
                                <th>Gambar</th> <!-- ✅ Kolom baru -->
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
                            @foreach ($kandidats as $index => $k)
                                <tr class="text-center align-middle">
                                    <td>{{ $loop->iteration }}</td>

                                    <!-- ✅ Foto dari tabel pendaftarans -->
                                    <td>
                                        @php
                                            $foto = $k->pendaftaran->foto ?? null;
                                        @endphp

                                        @if ($foto)
                                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Kandidat"
                                                class="rounded-circle" width="50" height="50"
                                                style="object-fit: cover;">
                                        @else
                                            <!-- Placeholder jika tidak ada foto -->
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($k->pendaftaran->nama ?? 'User') }}&background=0D8ABC&color=fff"
                                                class="rounded-circle" width="50" height="50"
                                                style="object-fit: cover;">
                                        @endif
                                    </td>

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
                                            <i class="bi bi-pencil"></i>Edit
                                        </a>

                                        <a href="{{ route('kandidat.history', $k->id) }}" class="btn btn-info btn-sm mb-1"
                                            title="History">
                                            <i class="bi bi-clock-history"></i>History
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
            var table = $('#tableKandidatutama').DataTable({
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
