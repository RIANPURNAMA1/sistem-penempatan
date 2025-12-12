@extends('layouts.app')
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

    </head>
    </style>

    <body class="">
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
                        <i class="bi bi-people me-1"></i> Daftar Kandidat
                    </li>
                </ol>
            </nav>
            {{-- <!-- Header -->
            <div class="mb-4 text-center text-md-start">
                <h2 class="fw-bold  mb-2">
                    <i class="bi bi-person-lines-fill text-warning me-2"></i> Daftar Kandidat
                </h2>
                <p class="text-muted fst-italic">
                    Berikut adalah data kandidat yang telah masuk dalam sistem.
                </p>
            </div> --}}
            <!-- 🔍 Filter Section -->
            <div class="card shadow shadow-md mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Filter Cabang -->
                        <div class="col-12 col-md-4">
                            <label for="filterCabang" class="form-label fw-semibold">Filter Cabang</label>
                            <select id="filterCabang" class="form-select">
                                <option value="">Semua Cabang</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->nama_cabang }}">{{ $cabang->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Status Kandidat -->
                        <div class="col-12 col-md-4">
                            @php
                                $statuses = [
                                    'Job Matching',
                                    'lamar_ke_perusahaan',
                                    'Pending',
                                    'Interview',
                                    'Gagal Interview',
                                    'Jadwalkan Interview Ulang',
                                    'Lulus interview',
                                    'Pemberkasan',
                                    'Berangkat',
                                    'Diterima',
                                    'Ditolak',
                                ];
                            @endphp

                            <label for="filterStatus" class="form-label fw-semibold">Filter Status Kandidat</label>
                            <select id="filterStatus" class="form-select">
                                <option value="">Semua Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>

                        </div>

                        <!-- Reset Filter -->
                        <div class="col-12 col-md-4 text-md-end">
                            <button id="resetFilter" class="btn btn-outline-info mt-3 mt-md-0">
                                <i class="bi bi-arrow-repeat"></i> Reset Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 🧾 Data Table -->
            <div class="card shadow shadow-md">
                <div class="card-body table-responsive">
                    <table id="tableKandidatutama" class="table shadow shadow-md align-middle nowrap" style="width:100%">
                        <thead class="">
                            <tr class="text-white text-center">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Kandidat</th>
                                <th>Cabang</th>
                                <th>Progress Kandidat</th>
                                <th>Status Kandidat di Mendunia</th>
                                <th>Perusahaan Penempatan</th>
                                <th>Nama Perusahaan</th>
                                <th>Bidang Pekerjaan SSW</th>
                                <th>Tanggal Daftar</th>
                                <th>Jumlah Interview</th>
                                <th>Catatan Interview</th>
                                <th>Jadwal Interview</th>

                                <!-- Kolom Baru: Tanggal Interview/Mensetsu -->
                                <th>TGL Setsumeikai</th>
                                <th>TGL Mensetsu 1</th>
                                <th>TGL Mensetsu 2</th>
                                <th>Catatan Mensetsu</th>

                                <!-- Kolom Baru: Biaya -->
                                <th>Biaya Pemberkasan</th>
                                <th>ADM Tahap 1</th>
                                <th>ADM Tahap 2</th>

                                <!-- Kolom Baru: Tracking Dokumen -->
                                <th>Dokumen Soft File</th>
                                <th>Terbit Kontrak Kerja</th>
                                <th>Kontrak ke TSK</th>
                                <th>Terbit Paspor</th>
                                <th>Masuk Imigrasi Jepang</th>
                                <th>COE Terbit</th>
                                <th>Pembuatan E-KTKLN</th>
                                <th>Dokumen Dikirim</th>
                                <th>Visa</th>
                                <th>Jadwal Penerbangan</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidats as $index => $k)
                                <tr class="text-center align-middle">
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @php
                                            $foto = $k->pendaftaran->foto ?? null;
                                            $detailUrl = route('kandidat.show', $k->id); // Route menuju halaman detail
                                        @endphp

                                        @if ($foto)
                                            <a href="{{ $detailUrl }}">
                                                <img src="{{ asset($foto) }}" alt="Foto Kandidat" class="rounded-circle"
                                                    width="50" height="50" style="object-fit: cover;">
                                            </a>
                                        @else
                                            <a href="{{ $detailUrl }}">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($k->pendaftaran->nama ?? 'User') }}&background=0D8ABC&color=fff"
                                                    class="rounded-circle" width="50" height="50"
                                                    style="object-fit: cover;">
                                            </a>
                                        @endif
                                    </td>


                                    <!-- Nama -->
                                    <td>{{ $k->pendaftaran->nama ?? '-' }}</td>

                                    <!-- Cabang -->
                                    <td>{{ $k->cabang->nama_cabang ?? '-' }}</td>

                                    <!-- Badge Status -->
                                    <td>
                                        @php
                                            $statusColors = [
                                                'Job Matching' => 'secondary',
                                                'Pending' => 'warning',
                                                'Interview' => 'info',
                                                'Gagal Interview' => 'danger',
                                                'Jadwalkan Interview Ulang' => 'dark',
                                                'Lulus interview' => 'primary',
                                                'Pemberkasan' => 'info',
                                                'Berangkat' => 'primary',
                                                'Diterima' => 'success',
                                                'Ditolak' => 'danger',
                                            ];
                                        @endphp

                                        <span class="badge bg-{{ $statusColors[$k->status_kandidat] ?? 'secondary' }}">
                                            {{ $k->status_kandidat }}
                                        </span>
                                    </td>

                                    <!-- Status di Mendunia -->
                                    <td>
                                        <form class="form-mendunia border-none"
                                            action="{{ route('kandidat.updateMendunia', $k->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <select name="status_kandidat_di_mendunia"
                                                class="form-select form-select-sm status-mendunia">

                                                <option value="Tetap di Mendunia"
                                                    {{ $k->status_kandidat_di_mendunia == 'Tetap di Mendunia' ? 'selected' : '' }}>
                                                    Tetap di Mendunia
                                                </option>

                                                <option value="Keluar dari Mendunia"
                                                    {{ $k->status_kandidat_di_mendunia == 'Keluar dari Mendunia' ? 'selected' : '' }}>
                                                    Keluar dari Mendunia
                                                </option>

                                                <option value="Sudah Terbang"
                                                    {{ $k->status_kandidat_di_mendunia == 'Sudah Terbang' ? 'selected' : '' }}>
                                                    Sudah Terbang
                                                </option>

                                            </select>
                                        </form>
                                    </td>

                                    <!-- Penempatan -->
                                    <td>{{ $k->institusi->perusahaan_penempatan ?? '-' }}</td>

                                    <!-- Nama Perusahaan -->
                                    <td>{{ $k->nama_perusahaan ?? '-' }}</td>

                                    <!-- Bidang -->
                                    <td>
                                        @if ($k->bidang_ssws && $k->bidang_ssws->count() > 0)
                                            {{ $k->bidang_ssws->pluck('nama_bidang')->join(', ') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <!-- Tanggal Daftar -->
                                    <td>
                                        {{ $k->pendaftaran->tanggal_daftar
                                            ? \Carbon\Carbon::parse($k->pendaftaran->tanggal_daftar)->format('d F Y')
                                            : '-' }}
                                    </td>

                                    <!-- Jumlah Interview -->
                                    <td>{{ $k->jumlah_interview ?? 0 }}</td>

                                    <!-- Catatan Interview -->
                                    <td>{{ $k->catatan_interview ?? '-' }}</td>

                                    <!-- Jadwal Interview -->
                                    <td>
                                        {{ $k->jadwal_interview ? \Carbon\Carbon::parse($k->jadwal_interview)->format('d F Y') : '-' }}
                                    </td>

                                    <!-- ========== KOLOM BARU: Tanggal Interview/Mensetsu ========== -->
                                    <td>
                                        {{ $k->tgl_setsumeikai_ichijimensetsu ? \Carbon\Carbon::parse($k->tgl_setsumeikai_ichijimensetsu)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->tgl_mensetsu ? \Carbon\Carbon::parse($k->tgl_mensetsu)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->tgl_mensetsu2 ? \Carbon\Carbon::parse($k->tgl_mensetsu2)->format('d F Y') : '-' }}
                                    </td>

                                    <td>{{ $k->catatan_mensetsu ?? '-' }}</td>

                                    <!-- ========== KOLOM BARU: Biaya ========== -->
                                    <td>
                                        {{ $k->biaya_pemberkasan ? 'Rp ' . number_format($k->biaya_pemberkasan, 0, ',', '.') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->adm_tahap1 ? 'Rp ' . number_format($k->adm_tahap1, 0, ',', '.') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->adm_tahap2 ? 'Rp ' . number_format($k->adm_tahap2, 0, ',', '.') : '-' }}
                                    </td>

                                    <!-- ========== KOLOM BARU: Tracking Dokumen ========== -->
                                    <td>
                                        {{ $k->dokumen_dikirim_soft_file ? \Carbon\Carbon::parse($k->dokumen_dikirim_soft_file)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->terbit_kontrak_kerja ? \Carbon\Carbon::parse($k->terbit_kontrak_kerja)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->kontrak_dikirim_ke_tsk ? \Carbon\Carbon::parse($k->kontrak_dikirim_ke_tsk)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->terbit_paspor ? \Carbon\Carbon::parse($k->terbit_paspor)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->masuk_imigrasi_jepang ? \Carbon\Carbon::parse($k->masuk_imigrasi_jepang)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->coe_terbit ? \Carbon\Carbon::parse($k->coe_terbit)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->pembuatan_ektkln ? \Carbon\Carbon::parse($k->pembuatan_ektkln)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->dokumen_dikirim ? \Carbon\Carbon::parse($k->dokumen_dikirim)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->visa ? \Carbon\Carbon::parse($k->visa)->format('d F Y') : '-' }}
                                    </td>

                                    <td>
                                        {{ $k->jadwal_penerbangan ? \Carbon\Carbon::parse($k->jadwal_penerbangan)->format('d F Y') : '-' }}
                                    </td>

                                    <!-- Tombol Aksi -->
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('kandidat.edit', $k->id) }}"
                                            class="btn btn-sm btn-warning text-white mb-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="{{ route('kandidat.history', $k->id) }}" class="btn btn-info btn-sm mb-1"
                                            title="History">
                                            <i class="bi bi-clock-history"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            var table = $('#tableKandidatutama').DataTable({
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

            // update status kandidat mendunia 
            $(document).on('change', '.status-mendunia', function() {

                let form = $(this).closest('form');

                Swal.fire({
                    title: "Yakin Ubah Status?",
                    text: "Status kandidat akan diperbarui.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, ubah!",
                    cancelButtonText: "Batal",
                }).then((result) => {

                    if (result.isConfirmed) {

                        // submit via AJAX
                        $.ajax({
                            url: form.attr('action'),
                            type: "POST",
                            data: form.serialize(),
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: "Status kandidat di Mendunia telah diperbarui.",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal!",
                                    text: xhr.responseJSON?.message ?? "Terjadi kesalahan.",
                                });
                            }
                        });
                    }
                });
            });


            // Custom filter untuk Cabang dan Status
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var selectedCabang = $('#filterCabang').val();
                    var selectedStatus = $('#filterStatus').val();

                    // Ambil elemen row
                    var rowNode = table.row(dataIndex).node();

                    // Ambil teks cabang dan status
                    var cabang = $('td:eq(3)', rowNode).text().trim(); // kolom Cabang
                    var status = $('td:eq(4)', rowNode).text().trim(); // kolom Status Kandidat

                    var cabangMatch = selectedCabang === "" || cabang === selectedCabang;
                    var statusMatch = selectedStatus === "" || status === selectedStatus;

                    return cabangMatch && statusMatch;
                }
            );

            // Event filter change
            $('#filterCabang, #filterStatus').on('change', function() {
                table.draw(); // redraw tabel dengan filter baru
            });

            // Reset filter
            $('#resetFilter').on('click', function() {
                $('#filterCabang').val('');
                $('#filterStatus').val('');
                table.draw();
            });
        </script>
    @endsection
