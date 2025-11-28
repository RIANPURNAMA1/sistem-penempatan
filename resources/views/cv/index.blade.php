@extends('layouts.app')

@section('title', 'Daftar CV')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <div class="">

        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md">
            <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Daftar CV Kandidat
                </li>
            </ol>
        </nav>

        <!-- Filter -->
        <div class="card shadow shadow-md border-0 rounded-3 mb-4">
            <div class="card-header py-3 px-4 rounded-top-4 border-bottom-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold mb-0 text-secondary">
                            <i class="bi bi-funnel me-1"></i> Filter Data
                        </h6>
                    </div>

              
                </div>
            </div>

            <div class="card-body shadow shadow-md">
                <div class="row g-3 align-items-end">
                    <!-- Filter Cabang -->
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-6 d-flex justify-content-end">
                        <button id="resetFilter" class="btn btn-outline-info fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <div class="card shadow shadow-md border-0 rounded-4 p-3">
            <div class="table-responsive">
                <table id="cvTable" class="table table-striped  align-middle table-sm shadow shadow-md">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Tinggi / Berat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cvs as $index => $cv)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? '-') }}</td>
                                <td>{{ $cv->jenis_kelamin ?? '-' }}</td>
                                <td>{{ $cv->tempat_tanggal_lahir ?? '-' }}</td>
                                <td>{{ $cv->alamat_lengkap ?? '-' }}</td>
                                <td>{{ $cv->email_aktif ?? ($cv->email ?? '-') }}</td>
                                <td>{{ $cv->no_telepon ?? '-' }}</td>
                                <td>{{ $cv->tinggi_badan ?? '-' }} cm / {{ $cv->berat_badan ?? '-' }} kg</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $cv->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $cv->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cv.show', $cv->id) }}">
                                                    <i class="bi bi-eye me-1"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cv.show.pdf', $cv->id) }}">
                                                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF CV Kaigo
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('cv.show.pdf.violeta', $cv->id)}}">
                                                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF CV Violeta
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#cvTable').DataTable({
            responsive: true,
            pageLength: 5,
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
