@extends('layouts.app')

@section('title', 'Daftar CV')

@section('content')

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold">
                    <i class="bi bi-person-lines-fill me-1"></i> Daftar CV
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-4 text-center text-md-start">
            <h2 class="fw-bold mb-2">
                <i class="bi bi-card-checklist text-warning me-2"></i> Daftar CV Kandidat
            </h2>
            <p class="text-muted fst-italic">Berikut merupakan data CV yang telah diinput oleh para kandidat.</p>
        </div>

        @if ($cvs->isEmpty())
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Belum Ada Data CV',
                        html: `
                        <p>Belum ada kandidat yang mengisi CV.</p>
                        <a href="{{ route('pendaftaran.cv.create') }}" 
                           class="btn btn-warning fw-semibold mt-2">
                            <i class="bi bi-pencil-square me-1"></i> Isi CV Sekarang
                        </a>
                    `,
                        showConfirmButton: false,
                        background: '#fffaf0'
                    });
                });
            </script>
        @else
            <div class="card shadow-sm border-0 rounded-4 p-3">
                <div class="table-responsive">
                    <table id="cvTable" class="table table-striped table-bordered align-middle">
                        <thead class="table-warning">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No WA</th>
                                <th>Tinggi / Berat</th>
                                <th>Pendidikan</th>
                                <th>Pengalaman</th>
                                <th>Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cvs as $index => $cv)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>

                                    <td>{{ $cv->nama_lengkap }}</td>

                                    <td>{{ $cv->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($cv->tanggal_lahir)->format('d-m-Y') }}
                                    </td>

                                    <td>{{ $cv->jenis_kelamin }}</td>

                                    <td>{{ $cv->alamat }}</td>

                                    <td>{{ $cv->email }}</td>

                                    <td>{{ $cv->no_wa }}</td>

                                    <td>{{ $cv->tinggi_badan }} cm / {{ $cv->berat_badan }} kg</td>

                                    <td>
                                        @forelse ($cv->pendidikan as $p)
                                            <div>• {{ $p->nama }} ({{ $p->tahun }}) - {{ $p->jurusan }}</div>
                                        @empty
                                            -
                                        @endforelse
                                    </td>

                                    <td>
                                        @forelse ($cv->pengalamans as $p)
                                            <div>• {{ $p->perusahaan }} - {{ $p->jabatan }} ({{ $p->periode }})</div>
                                        @empty
                                            -
                                        @endforelse
                                    </td>

                                    <td>{{ $cv->keahlian ?? '-' }}</td>

                                    <td class="text-center">
                                        <div class="d-flex flex-column gap-1">

                                            <a href="{{ route('pendaftaran.cv.edit', $cv->id) }}"
                                                class="btn btn-warning btn-sm text-white">
                                                <i class="bi bi-pencil-square me-1"></i>Edit
                                            </a>

                                            <a href="{{ route('cv.export', $cv->id) }}"
                                                class="btn btn-success btn-sm text-white">
                                                <i class="bi bi-file-earmark-excel me-1"></i>Excel
                                            </a>

                                            <a href="{{ route('cv.export.pdf', $cv->id) }}"
                                                class="btn btn-danger btn-sm text-white">
                                                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                            </a>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        @endif
    </div>

    <!-- Dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
