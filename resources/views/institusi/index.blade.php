@extends('layouts.app')

@section('title', 'Daftar Institusi')

@section('content')

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ✅ DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold">
                    <i class="bi bi-building me-1"></i> Daftar Institusi
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-4 text-center text-md-start">
            <h2 class="fw-bold mb-2">
                <i class="bi bi-bank text-warning me-2"></i> Daftar Institusi
            </h2>
            <p class="text-muted fst-italic">
                Berikut adalah data institusi yang telah terdaftar dalam sistem.
            </p>
        </div>

        <!-- Filter -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header  border-bottom-0 py-3 px-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="fw-semibold mb-0 text-secondary">
                        <i class="bi bi-funnel me-1"></i> Filter Data
                    </h6>
                    <div class="d-flex gap-2 mt-2 mt-md-0">
                        <button class="btn btn-danger btn-sm fw-semibold shadow-sm">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold text-secondary">Filter Alamat</label>
                        <input type="text" id="filterKota" class="form-control shadow-sm rounded-3"
                            placeholder="Masukkan nama kota...">
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-end align-items-end">
                        <button id="resetFilter" class="btn btn-outline-info fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel manual -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body table-responsive">
              <div class="d-flex justify-content-end">

                  <a href="{{ route('institusi.create') }}" class="btn btn-success mb-3">
                      <i class="bi bi-plus-circle me-1"></i> Tambah Institusi
                  </a>
              </div>

                <table id="tableInstitusi" class="table table-striped table-bordered align-middle" id="tableInstitusi">
                    <thead>
                        <tr>
                            <th class=" text-center">No</th>
                            <th class="">Nama Perusahaan</th>
                            <th class="">Kuota</th>
                            <th class="">Bidang Pekerjaan</th>
                            <th class="">Perusahaan Penempatan</th>
                            <th class="">Tanggal Dibuat</th>
                            <th class=" text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($institusis as $index => $institusi)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $institusi->nama_perusahaan }}</td>
                                <td>{{ $institusi->kuota }}</td>
                                <td>{{ $institusi->bidang_pekerjaan ?? '-' }}</td>
                                <td>{{ $institusi->perusahaan_penempatan ?? '-' }}</td>
                                <td>{{ $institusi->created_at->format('Y-m-d') }}</td>
                                <td class="text-center ">
                                    <div class="btn-group gap-2">
                                        <a href="{{ route('institusi.edit', $institusi->id) }}"
                                            class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('institusi.destroy', $institusi->id) }}" class="delete-form" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete btn-danger text-white">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
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


    <!-- Script Filter Manual -->
    <script>

        var table = $('#tableInstitusi').DataTable({
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

        const filterInput = document.getElementById('filterKota');
        const resetBtn = document.getElementById('resetFilter');
        const rows = document.querySelectorAll('#tableBody tr');

        filterInput.addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();

            rows.forEach(row => {
                const alamat = row.children[4].textContent.toLowerCase();
                row.style.display = alamat.includes(keyword) ? '' : 'none';
            });
        });

        resetBtn.addEventListener('click', function() {
            filterInput.value = '';
            rows.forEach(row => row.style.display = '');
        });

        // SweetAlert Delete Confirmation
    $(document).on("click", ".btn-delete", function(e) {
        e.preventDefault();

        let form = $(this).closest("form");

        Swal.fire({
            title: "Yakin menghapus data?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    </script>

@endsection
