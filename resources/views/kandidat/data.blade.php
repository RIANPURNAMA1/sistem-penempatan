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

            <div class="card shadow-sm border-0">
                <div class="card-body ">
                    <h5 class="card-title mb-4 fw-bold text-secondary">Statistik Kandidat SSW</h5>
                    <div class="row g-3">
                        @foreach ($statistik_ssw as $nama_bidang => $data)
                            <div class="col-md-4 col-lg-4">
                                <div class="card h-100 border-1 shadow-none">
                                    <div class="card-body">
                                        <h6 class="text-uppercase small fw-bold text-muted mb-3">{{ $nama_bidang }}</h6>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div>
                                                <span class="display-6 fw-bold">{{ $data['total'] }}</span>
                                                <span class="text-muted">Total</span>
                                            </div>
                                            <div class="text-end small">
                                                <div class="text-secondary border-bottom mb-1">L: <span
                                                        class="fw-bold">{{ $data['L'] }}</span></div>
                                                <div class="text-secondary">P: <span
                                                        class="fw-bold">{{ $data['P'] }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <!-- Header -->
            <div class="mb-4 text-center text-md-start">
                <h2 class="fw-bold  mb-2">
                    <i class="bi bi-person-lines-fill text-warning me-2"></i> Daftar Kandidat
                </h2>
                <p class="text-muted fst-italic">
                    Berikut adalah data kandidat yang telah masuk dalam sistem.
                </p>
            </div> --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h6 class="fw-bold text-secondary mb-0 me-3">
                            <i class="fas fa-users me-2"></i>Filter Kandidat
                        </h6>

                        <div class="dropdown me-2">
                            <button class="btn btn-white border shadow-none dropdown-toggle" type="button" id="megaFilter"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="fas fa-filter me-2 text-muted"></i> Saring & Filter Data
                            </button>

                            <div class="dropdown-menu shadow-lg p-4" aria-labelledby="megaFilter"
                                style="width: 750px; max-width: 90vw;">
                                <form action="{{ route('kandidat.data') }}" method="GET" id="filterForm">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Bidang SSW</p>
                                            <div class="filter-scroll mb-3" style="max-height: 150px; overflow-y: auto;">
                                                @foreach (['Pengolahan makanan', 'Restoran', 'Pertanian', 'Kaigo (perawat)', 'Building cleaning', 'Driver'] as $ssw)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="f_ssw[]"
                                                            value="{{ $ssw }}" id="ssw_{{ $loop->index }}"
                                                            {{ in_array($ssw, request('f_ssw', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label small"
                                                            for="ssw_{{ $loop->index }}">{{ $ssw }}</label>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Cabang</p>
                                            <div class="filter-scroll" style="max-height: 150px; overflow-y: auto;">
                                                @foreach ($cabangs as $cabang)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="f_cabang[]"
                                                            value="{{ $cabang->nama_cabang }}"
                                                            id="cab_{{ $cabang->id }}"
                                                            {{ in_array($cabang->nama_cabang, request('f_cabang', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label small"
                                                            for="cab_{{ $cabang->id }}">{{ $cabang->nama_cabang }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-md-4 border-start border-end">
                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Status Kandidat</p>
                                            <div class="filter-scroll mb-3" style="max-height: 250px; overflow-y: auto;">
                                                @php
                                                    $statuses = [
                                                        'Job Matching',
                                                        'lamar ke perusahaan',
                                                        'Pending',
                                                        'Interview',
                                                        'Gagal Interview',
                                                        'Lulus interview',
                                                        'Pemberkasan',
                                                        'Berangkat',
                                                        'Diterima',
                                                    ];
                                                @endphp
                                                @foreach ($statuses as $status)
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="f_status[]"
                                                            value="{{ $status }}" id="st_{{ $loop->index }}"
                                                            {{ in_array($status, request('f_status', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label small text-capitalize"
                                                            for="st_{{ $loop->index }}">{{ $status }}</label>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Pendidikan</p>
                                            @foreach (['SMA', 'SMK', 'D3', 'S1'] as $edu)
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input" type="checkbox" name="f_edu[]"
                                                        value="{{ $edu }}" id="edu_{{ $edu }}"
                                                        {{ in_array($edu, request('f_edu', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label small"
                                                        for="edu_{{ $edu }}">{{ $edu }}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-md-4">
                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Jenis Kelamin</p>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="f_jk[]"
                                                    value="Laki-laki" id="jkL"
                                                    {{ in_array('Laki-laki', request('f_jk', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label small" for="jkL">Laki-laki</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="f_jk[]"
                                                    value="Perempuan" id="jkP"
                                                    {{ in_array('Perempuan', request('f_jk', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label small" for="jkP">Perempuan</label>
                                            </div>

                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Pengalaman</p>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="f_eks[]"
                                                    value="Ya" id="eksYa"
                                                    {{ in_array('Ya', request('f_eks', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label small" for="eksYa">Eks-Jepang</label>
                                            </div>

                                            <p class="small fw-bold text-uppercase text-muted border-bottom pb-1 mb-2">
                                                Rentang Umur</p>
                                            <div class="input-group input-group-sm mb-4">
                                                <input type="number" name="age_min" class="form-control"
                                                    placeholder="Min" value="{{ request('age_min') }}">
                                                <input type="number" name="age_max" class="form-control"
                                                    placeholder="Max" value="{{ request('age_max') }}">
                                            </div>

                                            <button type="submit" class="btn btn-dark btn-sm w-100 mb-2">
                                                Terapkan Filter
                                            </button>
                                            <a href="{{ route('kandidat.data') }}"
                                                class="btn btn-outline-secondary btn-sm w-100">
                                                Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Tombol Reset di sebelah dropdown filter --}}
                        @if (request()->hasAny(['f_ssw', 'f_cabang', 'f_status', 'f_edu', 'f_jk', 'f_eks', 'age_min', 'age_max']))
                            <a href="{{ route('kandidat.data') }}" class="btn btn-outline-danger btn-sm shadow-none">
                                <i class="fas fa-redo me-1"></i> Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Tampilkan Badge Filter Aktif (Monokrom / Tidak Warna-warni) --}}
            @if (request()->hasAny(['f_ssw', 'f_cabang', 'f_status', 'f_edu', 'f_jk', 'f_eks', 'age_min', 'age_max']))
                <div class="mb-3 d-flex flex-wrap align-items-center gap-2">

                    <span class="badge bg-secondary-subtle text-dark border">
                        <i class="fas fa-filter me-1"></i> Filter Aktif
                    </span>

                    @foreach (request('f_cabang', []) as $cabang)
                        <span class="badge bg-light text-dark border">
                            Cabang: {{ $cabang }}
                        </span>
                    @endforeach

                    @foreach (request('f_ssw', []) as $ssw)
                        <span class="badge bg-light text-dark border">
                            SSW: {{ $ssw }}
                        </span>
                    @endforeach

                    @foreach (request('f_status', []) as $status)
                        <span class="badge bg-light text-dark border">
                            Status: {{ $status }}
                        </span>
                    @endforeach

                    @foreach (request('f_edu', []) as $edu)
                        <span class="badge bg-light text-dark border">
                            Pendidikan: {{ $edu }}
                        </span>
                    @endforeach

                    @foreach (request('f_jk', []) as $jk)
                        <span class="badge bg-light text-dark border">
                            JK: {{ $jk }}
                        </span>
                    @endforeach

                    @foreach (request('f_eks', []) as $eks)
                        <span class="badge bg-light text-dark border">
                            Pengalaman Jepang: {{ $eks }}
                        </span>
                    @endforeach

                    @if (request('age_min') || request('age_max'))
                        <span class="badge bg-light text-dark border">
                            Umur: {{ request('age_min', '0') }} – {{ request('age_max', '∞') }}
                        </span>
                    @endif

                    <a href="{{ route('kandidat.data') }}" class="badge bg-dark text-white text-decoration-none ms-2">
                        <i class="fas fa-times me-1"></i> Reset Filter
                    </a>

                </div>
            @endif


            <!-- 🧾 Data Table -->
            <div class="card shadow shadow-md">
                <div class="card-body table-responsive">
                    <table id="tableKandidatutama" class="table shadow shadow-md align-middle nowrap "
                        style="width:100%">
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
                                <th>Bidang ssw yang di miliki</th>
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
                                                <img src="{{ asset($foto) }}" alt="Foto Kandidat"
                                                    class="rounded-circle" width="50" height="50"
                                                    style="object-fit: cover;">
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
                                                'lamar ke perusahaan' => 'secondary',
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
                                    <td class="col-sm-7">
                                        {{ $k->pendaftaran->bidang_ssws->pluck('nama_bidang')->implode(', ')}}

                                    </td>

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
                                        {{ $k->pendaftaran->created_at }}
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

                                    <!-- Kolom Biaya -->
                                    <td>{{ $k->biaya_pemberkasan }}</td>

                                    <td>{{ $k->adm_tahap1 }}</td>

                                    <td>{{ $k->adm_tahap2 }}</td>


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
                                            class="btn btn-sm btn-success text-white mb-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="{{ route('kandidat.history', $k->id) }}"
                                            class="btn btn-info btn-sm mb-1" title="History">
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
                pageLength: 10,
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

            // Update status kandidat mendunia (AJAX)
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
                        $.ajax({
                            url: form.attr('action'),
                            type: "POST",
                            data: form.serialize(),
                            success: function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: "Status kandidat telah diperbarui.",
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

            // // Custom filter untuk DataTables
            // $.fn.dataTable.ext.search.push(
            //     function(settings, data, dataIndex) {
            //         // DEBUG: Uncomment baris ini untuk melihat data setiap kolom
            //         // console.log('Data Row:', data);

            //         // 1. Filter Cabang - COBA BEBERAPA INDEX
            //         var selectedCabang = $('input[name="f_cabang[]"]:checked').map(function() {
            //             return $(this).val().toLowerCase().trim();
            //         }).get();

            //         // Coba cek di beberapa kolom (sesuaikan dengan tabel Anda)
            //         var cabangData = '';
            //         // Coba index 1, 2, atau 3 - sesuaikan dengan posisi kolom cabang
            //         for (var i = 0; i < 5; i++) {
            //             if (data[i] && data[i].toLowerCase().includes('cabang') === false) {
            //                 // Cek apakah ini kolom cabang dengan mencocokkan dengan salah satu nilai cabang
            //                 var tempData = data[i].toLowerCase().trim();
            //                 if (selectedCabang.length > 0 && selectedCabang.some(cab => tempData.includes(cab))) {
            //                     cabangData = tempData;
            //                     break;
            //                 } else if (selectedCabang.length === 0) {
            //                     // Jika tidak ada filter, ambil data dari kolom yang diduga cabang
            //                     cabangData = data[1] ? data[1].toLowerCase().trim() : '';
            //                     break;
            //                 }
            //             }
            //         }

            //         var cabangMatch = selectedCabang.length === 0 || selectedCabang.some(function(cab) {
            //             return cabangData === cab || cabangData.includes(cab);
            //         });

            //         // 2. Filter SSW (Bidang)
            //         var selectedSSW = $('input[name="f_ssw[]"]:checked').map(function() {
            //             return $(this).val().toLowerCase().trim();
            //         }).get();

            //         var bidangSSW = (data[8] || '').toLowerCase().trim();
            //         var sswMatch = selectedSSW.length === 0 || selectedSSW.some(function(ssw) {
            //             return bidangSSW.includes(ssw);
            //         });

            //         // 3. Filter Status
            //         var selectedStatus = $('input[name="f_status[]"]:checked').map(function() {
            //             return $(this).val().toLowerCase().trim();
            //         }).get();

            //         var statusData = (data[7] || '').toLowerCase().trim();
            //         var statusMatch = selectedStatus.length === 0 || selectedStatus.some(function(status) {
            //             return statusData.includes(status);
            //         });

            //         // 4. Filter Pendidikan
            //         var selectedEdu = $('input[name="f_edu[]"]:checked').map(function() {
            //             return $(this).val().toLowerCase().trim();
            //         }).get();

            //         var eduData = (data[5] || '').toLowerCase().trim();
            //         var eduMatch = selectedEdu.length === 0 || selectedEdu.some(function(edu) {
            //             return eduData.includes(edu);
            //         });

            //         // 5. Filter Jenis Kelamin
            //         var selectedJK = $('input[name="f_jk[]"]:checked').map(function() {
            //             return $(this).val().toLowerCase().trim();
            //         }).get();

            //         var jkData = (data[4] || '').toLowerCase().trim();
            //         var jkMatch = selectedJK.length === 0 || selectedJK.some(function(jk) {
            //             return jkData.includes(jk);
            //         });

            //         // 6. Filter Pengalaman (Eks-Jepang)
            //         var selectedEks = $('input[name="f_eks[]"]:checked').map(function() {
            //             return $(this).val().toLowerCase().trim();
            //         }).get();

            //         var eksData = (data[9] || '').toLowerCase().trim();
            //         var eksMatch = selectedEks.length === 0 || selectedEks.some(function(eks) {
            //             return eksData.includes(eks) || (eks === 'ya' && eksData !== 'tidak');
            //         });

            //         // 7. Filter Rentang Umur
            //         var ageMin = parseInt($('input[name="age_min"]').val()) || 0;
            //         var ageMax = parseInt($('input[name="age_max"]').val()) || 999;
            //         var ageData = parseInt(data[6]) || 0;
            //         var ageMatch = (ageData >= ageMin && ageData <= ageMax);

            //         // Return true jika semua filter match
            //         return cabangMatch && sswMatch && statusMatch && eduMatch && jkMatch && eksMatch && ageMatch;
            //     }
            // );

            // // Event handler untuk tombol "Terapkan Filter"
            // $('#filterForm').on('submit', function(e) {
            //     e.preventDefault();
            //     table.draw();
            // });

            // // Event handler untuk checkbox filter (real-time)
            // $('input[name="f_ssw[]"], input[name="f_edu[]"], input[name="f_status[]"], input[name="f_jk[]"], input[name="f_eks[]"], input[name="f_cabang[]"]')
            //     .on('change', function() {
            //         table.draw();
            //     });

            // // Event handler untuk input umur
            // $('input[name="age_min"], input[name="age_max"]').on('keyup change', function() {
            //     table.draw();
            // });

            // // Reset filter
            // $('#resetFilter').on('click', function() {
            //     $('input[type="checkbox"]').prop('checked', false);
            //     $('input[name="age_min"], input[name="age_max"]').val('');
            //     table.draw();
            // });

            // // Search box kustom
            // $('input[placeholder="Cari nama atau NIK..."]').on('keyup', function() {
            //     table.search(this.value).draw();
            // });
        </script>
    @endsection
