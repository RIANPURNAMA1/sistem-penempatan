@extends('layouts.app')

@section('title', 'Daftar CV')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

        <!-- Cards Container -->
        <div class="row g-4" id="cardsContainer">
            @forelse ($cvs as $cv)
                <div class="col-12 col-md-6 col-lg-3 cv-item "
                    data-name="{{ strtolower($cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? '')) }}"
                    data-email="{{ strtolower($cv->email_aktif ?? ($cv->email ?? '')) }}"
                    data-alamat="{{ strtolower($cv->alamat_lengkap ?? '') }}">

                    <div class="card shadow shadow-md border-0 rounded-4">
                        <div class="card-body p-4">
                            <!-- Header with Photo -->
                            <div class="cv-header">
                                <!-- Foto Bulat Kecil -->
                                @if ($cv->pas_foto_cv)
                                    <img src="{{ asset($cv->pas_foto_cv) }}" class="cv-photo"
                                        alt="Foto {{ $cv->nama_lengkap_romaji ?? 'Kandidat' }}">
                                @else
                                    <div class="cv-photo bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-circle text-secondary" style="font-size: 2.5rem;"></i>
                                    </div>
                                @endif

                                <!-- Nama & Badge -->
                                <div class="flex-grow-1">
                                    <h5 class="cv-name fw-bold  mb-2">
                                        {{ $cv->nama_lengkap_romaji ?? ($cv->nama_lengkap_katakana ?? 'Nama Tidak Tersedia') }}
                                    </h5>
                                    <span
                                        class="badge badge-gender 
                                        {{ $cv->jenis_kelamin == 'Laki-laki' ? 'bg-primary' : 'bg-danger' }}">
                                        <i
                                            class="bi bi-{{ $cv->jenis_kelamin == 'Laki-laki' ? 'gender-male' : 'gender-female' }} me-1"></i>
                                        {{ $cv->jenis_kelamin ?? '-' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="info-item">
                                <i class="bi bi-cake2 text-secondary me-2"></i>
                                <span class="info-label">TTL:</span>
                                <span class="">{{ $cv->tempat_tanggal_lahir ?? '-' }}</span>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-geo-alt text-secondary me-2"></i>
                                <span class="info-label">Alamat:</span>
                                <span class="">{{ $cv->alamat_lengkap ?? '-' }}</span>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-envelope text-secondary me-2"></i>
                                <span class="info-label">Email:</span>
                                <span class="">{{ $cv->email_aktif ?? ($cv->email ?? '-') }}</span>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-phone text-secondary me-2"></i>
                                <span class="info-label">WhatsApp:</span>
                                <span class="">{{ $cv->no_telepon ?? '-' }}</span>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-rulers text-secondary me-2"></i>
                                <span class="info-label">TB / BB:</span>
                                <span class="">
                                    {{ $cv->tinggi_badan ?? '-' }} cm / {{ $cv->berat_badan ?? '-' }} kg
                                </span>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="card-footer bg-light border-0 p-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('cv.show', $cv->id) }}"
                                    class="btn btn-outline-primary btn-sm action-btn">
                                    <i class="bi bi-eye me-1"></i> Lihat Detail
                                </a>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="{{ route('cv.show.pdf', $cv->id) }}"
                                            class="btn btn-outline-danger btn-sm w-100 action-btn">
                                            <i class="bi bi-file-pdf me-1"></i> CV Kaigo
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('cv.show.pdf.violeta', $cv->id) }}"
                                            class="btn btn-outline-success btn-sm w-100 action-btn">
                                            <i class="bi bi-file-pdf me-1"></i> CV Violeta
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="bi bi-info-circle fs-1 d-block mb-3"></i>
                        <h5>Tidak Ada Data CV</h5>
                        <p class="mb-0">Belum ada data CV kandidat yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="alert alert-warning text-center py-5 mt-4" style="display: none;">
            <i class="bi bi-search fs-1 d-block mb-3"></i>
            <h5>Tidak Ada Hasil</h5>
            <p class="mb-0">Tidak ditemukan kandidat yang sesuai dengan pencarian.</p>
        </div>

        <!-- Pagination -->
        @if ($cvs->hasPages())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    {{ $cvs->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
        });
    </script>

@endsection
