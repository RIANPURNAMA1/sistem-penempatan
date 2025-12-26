@extends('layouts.app')

@section('title', 'Daftar CV')

@section('content')
    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Init Theme -->
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    </head>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <style>
        .cv-card {
            transition: all 0.3s ease;
            height: 100%;
        }

        .cv-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .cv-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #f8f9fa;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cv-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .info-item {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
            min-width: 100px;
            display: inline-block;
        }

        .badge-gender {
            font-size: 0.75rem;
            padding: 0.3rem 0.6rem;
        }

        .action-btn {
            transition: all 0.2s;
        }

        .action-btn:hover {
            transform: scale(1.05);
        }

        .search-box {
            max-width: 400px;
        }

        .cv-name {
            margin: 0;
            font-size: 1.1rem;
        }

        /* Custom SweetAlert2 */
        .swal2-popup {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <div class="">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow-md">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Daftar CV Kandidat
                </li>
            </ol>
        </nav>

        <!-- Filter & Search -->
        <div class="card shadow-md border-0 rounded-3 mb-4">
            <div class="card-header py-3 px-4  rounded-top-3 border-bottom">
                <h6 class="fw-semibold mb-0 text-secondary">
                    <i class="bi bi-funnel me-1"></i> Filter & Pencarian
                </h6>
            </div>

            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <!-- Filter Cabang -->
                    <div class="col-12 col-md-4">
                        <form action="/data/cv/kandidat" method="GET" id="filterForm">
                            <label for="filterCabang" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-building me-1"></i> Cabang
                            </label>
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

                    <!-- Search Box -->
                    <div class="col-12 col-md-5">
                        <label for="searchInput" class="form-label fw-semibold text-secondary">
                            <i class="bi bi-search me-1"></i> Cari Kandidat
                        </label>
                        <input type="text" id="searchInput" class="form-control shadow-sm rounded-3"
                            placeholder="Cari nama, email, atau alamat...">
                    </div>

                    <!-- Tombol Reset -->
                    <div class="col-12 col-md-3 d-flex justify-content-end">
                        <button id="resetFilter" class="btn btn-outline-info fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
                    </div>
                </div>

                <!-- Info Total -->
                <div class="mt-3 pt-3 border-top">
                    <p class="mb-0 text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Total: <span class="fw-bold text-primary" id="totalCount">{{ count($cvs) }}</span> kandidat
                        <span class="ms-2" id="filteredInfo"></span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-responsive">
            <table class="table align-middle" id="tableCv">
                <thead class="">
                    <tr>
                        <th scope="col" class="text-center" style="width: 80px;">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center" style="width: 120px;">Jenis Kelamin</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Cabang</th>
                        <th scope="col" class="text-center" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cvs as $cv)
                        <tr class="cv-item"
                            data-name="{{ strtolower($cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? '')) }}"
                            data-email="{{ strtolower($cv->email_aktif ?? ($cv->email ?? '')) }}"
                            data-alamat="{{ strtolower($cv->alamat_lengkap ?? '') }}">

                            <!-- Foto -->
                            <td class="text-center">
                                <a href="{{ route('cv.show', $cv->id) }}" class="">
                                    @if ($cv->pas_foto_cv)
                                        <img src="{{ asset($cv->pas_foto_cv) }}" class="rounded-circle"
                                            style="width: 50px; height: 50px; object-fit: cover;"
                                            alt="Foto {{ $cv->nama_lengkap_romaji ?? 'Kandidat' }}">
                                    @else
                                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="bi bi-person-circle text-secondary" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                </a>
                            </td>

                            <!-- Nama -->
                            <td>
                                <strong>{{ $cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? 'Nama Tidak Tersedia') }}</strong>
                            </td>

                            <!-- Jenis Kelamin -->
                            <td class="text-center">
                                <span class="badge {{ $cv->jenis_kelamin == 'Laki-laki' ? 'bg-primary' : 'bg-danger' }}">
                                    <i
                                        class="bi bi-{{ $cv->jenis_kelamin == 'Laki-laki' ? 'gender-male' : 'gender-female' }} me-1"></i>
                                    {{ $cv->jenis_kelamin ?? '-' }}
                                </span>
                            </td>

                            <!-- Email -->
                            <td>
                                <small>{{ $cv->email_aktif ?? ($cv->email ?? '-') }}</small>
                            </td>

                            <!-- WhatsApp -->
                            <td>
                                <small>{{ $cv->no_telepon ?? '-' }}</small>
                            </td>

                            <!-- Alamat -->
                            <td>
                                <small class="text-muted">{{ $cv->alamat_lengkap }}</small>
                            </td>

                            <!-- Cabang -->
                            <td>
                                <span class="badge bg-secondary">{{ $cv->cabang->nama_cabang ?? '-' }}</span>
                            </td>

                            <!-- Aksi -->
                            <td class="d-flex">
                                <div class="btn-group-vertical btn-group-sm " role="group">
                                    <!-- Dropdown untuk CV -->
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-file-pdf me-1"></i> Download CV
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('cv.show.pdf', $cv->id) }}">
                                                    <i class="bi bi-file-pdf me-2"></i>CV Kaigo
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('cv.show.pdf.violeta', $cv->id) }}">
                                                    <i class="bi bi-file-pdf me-2"></i>CV Violeta
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('cv.show.pdf.nawasena', $cv->id) }}">
                                                    <i class="bi bi-file-earmark-pdf me-2"></i>CV Nawasena
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('cv.show.pdf.yambo', $cv->id) }}">
                                                    <i class="bi bi-file-earmark-pdf me-2"></i>CV Yambo
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('cv.show.pdf.madoka', $cv->id) }}">
                                                    <i class="bi bi-file-earmark-pdf me-2"></i>CV Madoka
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('cv.show.pdf.mendunia', $cv->id) }}">
                                                    <i class="bi bi-file-earmark-pdf me-2"></i>CV Mendunia
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Tombol Delete -->
                                    <button type="button" class="btn btn-danger btn-sm mt-1 btn-delete"
                                        data-id="{{ $cv->id }}"
                                        data-name="{{ $cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? 'Kandidat') }}"
                                        data-photo="{{ $cv->pas_foto_cv ? asset($cv->pas_foto_cv) : '' }}">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </div>

                                <!-- Hidden Form untuk Delete -->
                                <form id="delete-form-{{ $cv->id }}" action="{{ route('cv.destroy', $cv->id) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-info-circle fs-1 d-block mb-3 text-muted"></i>
                                <h5>Tidak Ada Data CV</h5>
                                <p class="mb-0 text-muted">Belum ada data CV kandidat yang tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="alert alert-warning text-center py-5 mt-4" style="display: none;">
            <i class="bi bi-search fs-1 d-block mb-3"></i>
            <h5>Tidak Ada Hasil</h5>
            <p class="mb-0">Tidak ditemukan kandidat yang sesuai dengan pencarian.</p>
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
        var table = $('#tableCv').DataTable({
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

        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                let visibleCount = 0;

                $('.cv-item').each(function() {
                    const name = $(this).data('name');
                    const email = $(this).data('email');
                    const alamat = $(this).data('alamat');

                    const matchFound = name.includes(searchTerm) ||
                        email.includes(searchTerm) ||
                        alamat.includes(searchTerm);

                    if (matchFound) {
                        $(this).show();
                        visibleCount++;
                    } else {
                        $(this).hide();
                    }
                });

                // Update info
                if (searchTerm !== '') {
                    $('#filteredInfo').html(`(Menampilkan ${visibleCount} dari ${$('.cv-item').length})`);
                } else {
                    $('#filteredInfo').html('');
                }

                // Show/hide no results message
                if (visibleCount === 0) {
                    $('#noResults').show();
                } else {
                    $('#noResults').hide();
                }
            });

            // Reset filter
            $('#resetFilter').click(function() {
                $('#searchInput').val('');
                $('#filterCabang').val('');
                $('.cv-item').show();
                $('#filteredInfo').html('');
                $('#noResults').hide();

                // Submit form to reset cabang filter
                $('#filterForm').submit();
            });

            // Delete Confirmation dengan SweetAlert2
            $('.btn-delete').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const photo = $(this).data('photo');

                let imageHtml = '';
                if (photo) {
                    imageHtml =
                        `<img src="${photo}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">`;
                } else {
                    imageHtml = `<div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                        <i class="bi bi-person-circle text-secondary" style="font-size: 4rem;"></i>
                    </div>`;
                }

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        ${imageHtml}
                        <p class="mb-2">Apakah Anda yakin ingin menghapus CV kandidat:</p>
                        <h5 class="text-primary mb-3"><strong>${name}</strong></h5>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <small>Data yang dihapus tidak dapat dikembalikan!</small>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-trash me-1"></i> Ya, Hapus!',
                    cancelButtonText: '<i class="bi bi-x-circle me-1"></i> Batal',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-danger px-4 m-2',
                        cancelButton: 'btn btn-secondary px-4'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit form
                        $('#delete-form-' + id).submit();
                    }
                });
            });

            // Success/Error message dari session
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>

@endsection
