@extends('layouts.app')

@section('title', 'Daftar Cabang')

@section('content')
    <div class=" py-4">

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

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <i class="bi bi-building me-1"></i> Daftar Institusi
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-4 text-center text-md-start">
            <h2 class="mb-4">
                <i class="bi bi-building text-warning me-2"></i> Daftar Cabang
            </h2>

            <p class="text-muted fst-italic">
                Berikut adalah data cabang yang telah terdaftar dalam sistem.
            </p>
        </div>


        <div class="card shadow-sm rounded-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Cabang</h5>
                <a href="{{ url('/cabang/create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Cabang
                </a>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered align-middle" id="tableCabang">
                    <thead class="" style="background-color: #00c0ff;">
                        <tr>
                            <th class="text-white">No</th>
                            <th class="text-white">Nama Cabang</th>
                            <th class="text-white">Alamat</th>
                            <th class="text-white">Tanggal Dibuat</th>
                            <th class="text-white text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cabangs as $index => $cabang)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $cabang->nama_cabang }}</td>
                                <td>{{ $cabang->alamat }}</td>
                                <td>{{ $cabang->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <div class="btn-group d-flex justify-content-center gap-2">
                                        <div>

                                            <a href="{{ url('/cabang/' . $cabang->id . '/edit') }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>
                                        <div>

                                            <form action="{{ url('/cabang/' . $cabang->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($cabangs->isEmpty())
                    <div class="text-center py-3 text-muted">Belum ada data cabang.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // 🔹 Inisialisasi DataTable
            $('#tableCabang').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(difilter dari total _MAX_ data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // 🔹 SweetAlert konfirmasi hapus
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin menghapus cabang ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>



@endsection
