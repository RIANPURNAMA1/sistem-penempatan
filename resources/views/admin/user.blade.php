@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <div class="">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('admin') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
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
            <div class="card-header py-3 px-4  border-bottom-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="fw-semibold mb-0 text-secondary">
                        <i class="bi bi-funnel me-1"></i> Filter Data
                    </h6>
                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        <!-- Tombol Export Excel dengan route -->
                        <a href="{{ route('admin.kandidat.export') }}" class="btn btn-success btn-sm fw-semibold shadow-sm"
                            id="btnExportExcel">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                        </a>
                        <!-- Tombol Download PDF -->
                        <a href="{{ route('admin.kandidat.downloadPdf') }}"
                            class="btn btn-danger btn-sm fw-semibold shadow-sm" target="_blank">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                        </a>

                        <!-- Tombol Preview PDF (Opsional) -->
                        <a href="{{ route('admin.kandidat.previewPdf') }}"
                            class="btn btn-outline-danger btn-sm fw-semibold shadow-sm" target="_blank">
                            <i class="bi bi-eye me-1"></i> Preview PDF
                        </a>
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
                        <button id="resetFilter" class="btn btn-outline-info fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle nowrap w-100" id="tableUser">
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
                                <td class="text-center fw-semibold">
                                    {{ ($kandidats->currentPage() - 1) * $kandidats->perPage() + ($index + 1) }}
                                </td>
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
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $kandidat->id }}" title="Hapus">
                                        <i class="bi bi-trash3-fill"></i> Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Delete untuk setiap kandidat -->
                            <div class="modal fade" id="deleteModal{{ $kandidat->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $kandidat->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $kandidat->id }}">
                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center py-4">
                                            <i class="bi bi-person-x-fill text-danger" style="font-size: 4rem;"></i>
                                            <h5 class="mt-3 mb-2">Apakah Anda yakin?</h5>
                                            <p class="text-muted mb-0">Anda akan menghapus kandidat:</p>
                                            <p class="fw-bold text-dark mb-0">{{ $kandidat->name }}</p>
                                            <p class="text-muted small">{{ $kandidat->email }}</p>
                                            <div class="alert alert-warning mt-3 mb-0" role="alert">
                                                <i class="bi bi-info-circle-fill me-1"></i>
                                                <small>Data yang dihapus tidak dapat dikembalikan!</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center border-0">
                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle me-1"></i>Batal
                                            </button>
                                            <form action="{{ route('kandidats.user.destroy', $kandidat->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4">
                                                    <i class="bi bi-trash3-fill me-1"></i>Ya, Hapus!
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 px-2">
                    {{ $kandidats->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <!-- Alert untuk notifikasi -->
        @if (session('success'))
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                <div class="toast show align-items-center text-white bg-success border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                <div class="toast show align-items-center text-white bg-danger border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif




    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var table = $('#tableUser').DataTable({
            responsive: true,
            pageLength: 5, // tampilkan 5 baris per halaman
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
              
            }
        });
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

    <script>
        // Auto hide toast after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 3000
                });
            });
        });
    </script>

@endsection
