@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <div class="">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-person-badge me-1"></i> Daftar Kandidat
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-4 text-center text-md-start">
            <h2 class="fw-bold mb-2">
                <i class="bi bi-people-fill text-primary me-2"></i> Daftar Kandidat
            </h2>
            <p class="text-muted fst-italic">
                Berikut adalah data seluruh akun kandidat yang terdaftar pada sistem.
            </p>
        </div>

        <!-- Filter -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header py-3 px-4 bg-white border-bottom-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="fw-semibold mb-0 text-secondary">
                        <i class="bi bi-funnel me-1"></i> Filter Data
                    </h6>
                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        <button class="btn btn-success btn-sm fw-semibold shadow-sm">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
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
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold text-secondary">Filter Nama Kandidat</label>
                        <input type="text" id="filterNama" class="form-control shadow-sm rounded-3"
                            placeholder="Masukkan nama kandidat...">
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-end">
                        <button id="resetFilter" class="btn btn-outline-dark fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body table-responsive">

                <table class="table table-hover align-middle nowrap w-100" id="tableKandidatuser">
                    <thead class="text-center text-white" style="">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kandidats as $index => $kandidat)
                            <tr class="align-middle">
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>

                                <td class="fw-semibold">
                                    <i class="bi bi-person-circle text-primary me-2"></i>
                                    {{ $kandidat->name }}
                                </td>

                                <td>
                                    <span class="text-secondary">{{ $kandidat->email }}</span>
                                </td>

                                <td>
                                    <i class="bi bi-clock-history text-warning me-1"></i>
                                    {{ $kandidat->created_at->format('d M Y, H:i') }}
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm">

                                        <a href="#" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="#" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="mt-3 px-2">
                    {{ $kandidats->links('pagination::bootstrap-5') }}
                </div>


            </div>
        </div>



    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterInput = document.getElementById('filterNama');
            const resetBtn = document.getElementById('resetFilter');
            const table = document.getElementById('tableKandidatuser');
            const rows = table.querySelectorAll('tbody tr');

            // Filter berdasarkan nama
            filterInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();

                rows.forEach(row => {
                    const nameCell = row.cells[1].textContent.toLowerCase();
                    if (nameCell.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Reset filter
            resetBtn.addEventListener('click', function() {
                filterInput.value = '';
                rows.forEach(row => row.style.display = '');
            });
        });
    </script>

@endsection
