@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <div class=" ">

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
                <i class="bi bi-person-lines-fill text-warning me-2"></i> Daftar Pendaftar
            </h2>
            <p class="text-muted fst-italic">
                Berikut adalah data pendaftaran kandidat yang telah masuk dalam sistem.
            </p>
        </div>

        <!-- Filter -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header py-3 px-4 rounded-top-4 border-bottom-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold mb-0 text-secondary ">
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
                        <form action="{{ route('pendaftar') }}" method="GET" id="filterForm">
                            <label for="filterCabang" class="form-label fw-semibold text-secondary">Cabang</label>
                            <select name="cabang_id" id="filterCabang" class="form-select shadow-sm rounded-3 border-1"
                                onchange="document.getElementById('filterForm').submit()">
                                <option value="">Semua Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('cabang_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>



                    <!-- Tombol Reset -->
                    <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end align-items-end">
                        <button id="resetFilter" class="btn btn-outline-info fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body table-responsive">
                <table id="tablependaftar" class="table table-striped table-bordered align-middle nowrap"
                    style="width:100%">
                    <thead style="color: #000;">
                        <tr class=" fw-bold">
                            <th class="">No</th>
                            <th class="">Foto</th>
                            <th class="">Nik</th>
                            <th class="">Nama</th>
                            <th class="">Email</th>
                            <th class="">Alamat</th>
                            <th class="">Jenis Kelamin</th>
                            <th class="">No WA</th>
                            <th class="">Cabang</th>
                            <th class="">KK</th>
                            <th class="">KTP</th>
                            <th class="">Bukti Pelunasan</th>
                            <th class="">Akte</th>
                            <th class="">Ijazah</th>
                            <th class="">Tanggal Daftar</th>
                            <th class="">Verifikasi</th>
                            <th class="">Catatan Admin</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kandidats as $index => $kandidat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $kandidat->foto) }}" alt="Foto Kandidat"
                                        class="rounded-circle border" width="50" height="50">
                                </td>
                                <td>{{ $kandidat->nik }}</td>
                                <td>{{ $kandidat->nama }}</td>
                                <td>{{ $kandidat->email }}</td>
                                <td>{{ $kandidat->alamat }}</td>
                                <td>{{ $kandidat->jenis_kelamin }}</td>
                                <td>{{ $kandidat->no_wa }}</td>
                                <td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>

                                <!-- Dokumen -->
                                <td>
                                    <a href="{{ asset('storage/' . $kandidat->kk) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $kandidat->ktp) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $kandidat->bukti_pelunasan) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $kandidat->akte) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('storage/' . $kandidat->ijasah) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>

                                <!-- Tanggal Daftar -->
                                <td>{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}</td>

                                <!-- Status Verifikasi -->
                                <td>
                                    @if ($kandidat->verifikasi == 'menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif ($kandidat->verifikasi == 'data belum lengkap')
                                        <span class="badge bg-info text-dark">Data Belum Lengkap</span>
                                    @elseif ($kandidat->verifikasi == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>

                                <!-- Catatan Admin -->
                                <td>{{ $kandidat->catatan_admin ?? '-' }}</td>

                                <!-- Aksi -->
                                <td class="text-center">
                                    <div class="btn-group gap-2">

                                        <a href="{{ route('siswa.edit', $kandidat->id) }}"
                                            class="btn btn-sm btn-warning text-white" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <!-- Pagination links -->
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">

                </div>
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
            var table = $('#tablependaftar').DataTable({
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
        </script>

@endsection
