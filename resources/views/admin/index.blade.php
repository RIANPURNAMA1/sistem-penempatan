@extends('layouts.app')

@section('title', 'Daftar Admin')

@section('content')
    <div class="">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md border-none">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-person-gear me-1"></i> Daftar Admin
                </li>
            </ol>
        </nav>

        <div
            class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <div>
                <h2 class="fw-bold mb-2">
                    <i class="bi bi-shield-lock text-primary me-2"></i> Daftar Admin Sistem
                </h2>
                <p class="text-muted fst-italic">
                    Berikut adalah data akun admin yang terdaftar dalam sistem manajemen.
                </p>
            </div>
            <a href="{{ route('admins.create') }}"
                class="btn btn-primary fw-semibold shadow-sm px-4 py-2 rounded-3 text-white">
                <i class="bi bi-plus-circle me-1"></i> Tambah Admin Baru
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body table-responsive">
                <table class="table table-striped align-middle nowrap" id="tableAdmin" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Dibuat</th>
                            <th>Diperbarui</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $index => $admin)
                            @if ($admin->role !== 'kandidat')
                                {{-- skip kandidat --}}
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @php
                                            $roleName = $admin->role ?? 'Tidak Ada';
                                            $badge = match (strtolower($roleName)) {
                                                'super admin' => 'danger',
                                                'admin cianjur' => 'success',
                                                'admin cianjur selatan' => 'primary',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badge }}">{{ ucfirst($roleName) }}</span>
                                    </td>
                                    <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $admin->updated_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admins.edit', $admin->id) }}"
                                                class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger text-white"
                                                    title="Hapus">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- CSS & JS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            const table = $('#tableAdmin').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                language: {
                    search: "🔍 Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "← Sebelumnya",
                        next: "Berikutnya →"
                    },
                    zeroRecords: "Tidak ada data ditemukan"
                }
            });

            $('#filterRole').on('keyup', function() {
                table.column(3).search(this.value).draw();
            });

            $('#resetFilter').on('click', function() {
                $('#filterRole').val('');
                table.columns().search('').draw();
            });

            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data admin akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <style>
        #tableAdmin thead th {
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 2px;
            padding: 6px 12px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #ffc107 !important;
            color: #000 !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #ffe082 !important;
            color: #000 !important;
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.3rem;
            }

            .breadcrumb {
                font-size: 0.9rem;
            }

            .btn-group .btn {
                padding: 0.3rem 0.5rem;
            }

            th,
            td {
                white-space: nowrap;
                font-size: 0.85rem;
            }
        }
    </style>
@endsection
