@extends('layouts.app')
@section('content')

    <style>
        .status-dot {
            width: 10px;
            height: 10px;
            display: inline-block;
            border-radius: 50%;
        }

        .list-group-item:hover {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }

        .icon-wrapper {
            transition: 0.3s ease;
        }

        .card:hover .icon-wrapper {
            transform: scale(1.05);
        }

        .card {
            transition: box-shadow 0.3s ease;
        }
    </style>


    {{-- @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
            timer: 2000, // ganti sesuai kebutuhan
            showConfirmButton: false,
            timerProgressBar: true
        }).then(() => {
            // reload halaman setelah alert hilang
            window.location.reload();
        });
    </script>
@endif --}}
    @include('components.Headers')


    <div class="page-heading d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">

        {{-- Judul halaman --}}
        <div class="mb-2 mb-md-0 mt-3">
            @if (auth()->user()->role->name === 'kandidat')
                <h3 class="mb-1">Halo, {{ auth()->user()->name }}</h3>
                <p class="text-muted mb-0">Ini adalah timeline aktivitas Anda.</p>
            @elseif(in_array(auth()->user()->role->name, ['admin cianjur', 'admin cianjur selatan']))
                <h3 class="mb-1">Halo, {{ auth()->user()->name }}</h3>
                <p class="text-muted mb-0">Menampilkan data kandidat di cabang Anda.</p>
            @elseif(auth()->user()->role->name === 'super admin')
                <h3 class="mb-1">Halo, {{ auth()->user()->name }}</h3>
                <p class="text-muted mb-0">Dashboard Super Admin: mengakses semua data dan laporan.</p>
            @endif
        </div>

    </div>
    <hr>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @if (auth()->user()->role->name === 'super admin')
                    <div class="row">
                        @foreach ($stats as $stat)
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card hover-card shadow shadow-md border-0 ">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                                <div class="stats-icon {{ $stat['color'] }} mb-2">
                                                    <i class="bi {{ $stat['icon'] }} fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                                <h6 class="text-muted font-semibold">{{ $stat['title'] }}</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stat['count'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Status Penempatan Kandidat -->
                    <div class="row mt-4">
                        @php
                            $status_icon = [
                                'Job Matching' => 'bi bi-people',
                                'Pending' => 'bi bi-hourglass-split',
                                'Interview' => 'bi bi-chat-dots',
                                'Gagal Interview' => 'bi bi-x-circle',
                                'Jadwalkan Interview Ulang' => 'bi bi-arrow-repeat',
                                'Lulus interview' => 'bi bi-check-circle',
                                'Pemberkasan' => 'bi bi-file-earmark-check',
                                'Berangkat' => 'bi bi-airplane-engines',
                                'Ditolak' => 'bi bi-x-circle',
                            ];

                            $status_gradient = [
                                'Job Matching' =>
                                    'background: linear-gradient(135deg, #6c757d, #adb5bd); color: white;',
                                'Pending' => 'background: linear-gradient(135deg, #ffc107, #ffcd39); color: #212529;',
                                'Interview' => 'background: linear-gradient(135deg, #17a2b8, #007bff); color: white;',
                                'Gagal Interview' =>
                                    'background: linear-gradient(135deg, #dc3545, #ff6b6b); color: white;',
                                'Jadwalkan Interview Ulang' =>
                                    'background: linear-gradient(135deg, #fd7e14, #fd7e14); color: white;',
                                'Lulus interview' =>
                                    'background: linear-gradient(135deg, #00c851, #007e33); color: white;',
                                'Pemberkasan' => 'background: linear-gradient(135deg, #007bff, #6610f2); color: white;',
                                'Berangkat' => 'background: linear-gradient(135deg, #28a745, #20c997); color: white;',
                                'Ditolak' => 'background: linear-gradient(135deg, #dc3545, #ff6b6b); color: white;',
                            ];
                        @endphp

                        @foreach ($status_penempatan as $status => $jumlah)
                            <div class="col-6 col-lg-3 col-md-6 mb-3">
                                <div class="card shadow shadow-md border-0 hover-card">
                                    <div class="card-body px-4 py-4-5  rounded-2">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                                <div class="stats-icon rounded-3 d-flex justify-content-center align-items-center mb-2"
                                                    style="{{ $status_gradient[$status] }} width:50px; height:50px;">
                                                    <i class="{{ $status_icon[$status] }} fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                                <h6 class="text-muted font-semibold mb-1"
                                                    style="text-transform: capitalize;">
                                                    {{ $status }}
                                                </h6>
                                                <h6 class="fw-bold mb-0 fs-5">{{ $jumlah }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <style>
                        .hover-card {
                            transition: all 0.3s ease;
                            border-radius: 15px;
                        }

                        .hover-card:hover {
                            transform: translateY(-5px);
                            box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.1);
                        }

                        .stats-icon i {
                            color: white;
                        }

                        .stats-icon.warning i {
                            color: #212529 !important;
                        }
                    </style>

                    {{-- kandidat --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow shadow-md border-0">
                                <div class="card-header">
                                    <h4>Kandidat Percabang</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-kandidat"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var options = {
                                series: @json($chart_data),
                                chart: {
                                    type: 'bar',
                                    height: 350,
                                    toolbar: {
                                        show: false
                                    }
                                },
                                colors: [
                                    '#6c757d', '#ffc107', '#17a2b8', '#dc3545',
                                    '#fd7e14', '#00c851', '#007bff', '#28a745', '#ff6b6b'
                                ],
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: '50%',
                                        borderRadius: 6
                                    },
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    show: true,
                                    width: 2,
                                    colors: ['transparent']
                                },
                                xaxis: {
                                    categories: @json(array_values($cabangs)),
                                    labels: {
                                        style: {
                                            colors: '#6c757d',
                                            fontSize: '13px'
                                        }
                                    }
                                },
                                yaxis: {
                                    title: {
                                        text: 'Jumlah Kandidat'
                                    }
                                },
                                fill: {
                                    opacity: 1
                                },
                                tooltip: {
                                    y: {
                                        formatter: function(val) {
                                            return val + " kandidat";
                                        }
                                    }
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-kandidat"), options);
                            chart.render();
                        });
                    </script>



                    <div class="row mt-4">

                        <!-- =========================
                    BAGIAN KIRI (CHART)
                ========================== -->
                        <div class="col-12 col-md-8">
                            <div class="card h-100 shadow-lg border-0 rounded-4">

                                <!-- HEADER CARD -->
                                <div class="card-header bg-light border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper bg-primary bg-opacity-10 text-primary rounded-circle me-3"
                                            style="width: 45px; height: 45px; display:flex; align-items:center; justify-content:center;">
                                            <i class="bi bi-pie-chart-fill fs-4"></i>
                                        </div>

                                        <div>
                                            <h5 class="mb-0 fw-bold">Distribusi Status Kandidat</h5>
                                            <small class="">Statistik penyebaran status kandidat terbaru</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- BODY CARD -->
                                <div class="card-body p-4">
                                    <div id="chart-status-kandidat" style="height: 350px;"></div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 col-md-4 mt-4 mt-md-0">

                            <div class="card h-100 shadow-lg border-0 rounded-4">

                                <!-- HEADER -->
                                <div class="card-header bg-light border-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-wrapper bg-success bg-opacity-10 text-success rounded-circle me-3"
                                            style="width: 45px; height: 45px; display:flex; align-items:center; justify-content:center;">
                                            <i class="bi bi-people-fill fs-4"></i>
                                        </div>

                                        <div>
                                            <h5 class="fw-bold mb-0">User yang Sedang Login</h5>
                                            <small class="">Aktivitas pengguna sistem saat ini</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- BODY -->
                                <div class="card-body p-3">

                                    <ul class="list-group list-group-flush">

                                        @foreach ($users as $user)
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3"
                                                style="border-left: 4px solid transparent; transition: .2s;">

                                                <div class="d-flex align-items-center">
                                                    <!-- Avatar -->
                                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3"
                                                        style="width: 40px; height: 40px; font-size: 18px;">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>

                                                    <!-- Nama User -->
                                                    <span class="fw-semibold">{{ $user->name }}</span>
                                                </div>

                                                <!-- Status Dot -->
                                                @php
                                                    $isOnline = $user->last_activity >= now()->subMinutes(5);
                                                @endphp

                                                <span class="d-flex align-items-center">
                                                    <span
                                                        class="status-dot {{ $isOnline ? 'bg-success' : 'bg-danger' }}"></span>
                                                    <small
                                                        class="ms-2 fw-semibold {{ $isOnline ? 'text-success' : 'text-danger' }}">
                                                        {{ $isOnline ? 'Online' : 'Offline' }}
                                                    </small>
                                                </span>

                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>


                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var statusOptions = {
                                series: @json($statusCounts),
                                chart: {
                                    type: 'pie',
                                    height: 350
                                },
                                labels: @json($statusLabels),
                                legend: {
                                    position: 'bottom'
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function(val, opts) {
                                        return opts.w.globals.series[opts.seriesIndex];
                                    }
                                },
                                colors: [
                                    '#6c757d', // Job Matching
                                    '#0dcaf0', // Pending
                                    '#ffc107', // Interview
                                    '#dc3545', // Gagal Interview
                                    '#6610f2', // Jadwalkan Interview Ulang
                                    '#198754', // Lulus Interview
                                    '#fd7e14', // Pemberkasan
                                    '#0d6efd', // Berangkat
                                    '#000000' // Ditolak
                                ]
                            };

                            var chartStatus = new ApexCharts(
                                document.querySelector("#chart-status-kandidat"),
                                statusOptions
                            );

                            chartStatus.render();
                        });
                    </script>
                @endif
                @if (auth()->user()->role->name === 'kandidat')
                    <!-- Header Tabel -->
                  
                    <div class="table-responsive mt-3">
                        @if ($cvs->isEmpty())
                            <!-- SweetAlert jika belum ada CV -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Belum Mengisi CV',
                                        html: `
                        <p>Kamu belum mengisi CV.</p>
                        <a href="/pendaftaran/cv" 
                           class="btn btn-warning fw-semibold mt-2">
                            <i class="bi bi-pencil-square me-1"></i> Klik di sini untuk mengisi CV
                        </a>
                    `,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        background: '#fffaf0',
                                        color: '#333',
                                        didOpen: (popup) => {
                                            popup.querySelector('a').addEventListener('click', () => {
                                                Swal.close();
                                            });
                                        }
                                    });
                                });
                            </script>
                        @else
                            <div class="card border-0 shadow shadow-md rounded-4">
                                <div class="card-header py-3 border-0">

                                    @if ($cvs->isEmpty())
                                        <!-- SweetAlert jika belum ada CV -->
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                Swal.fire({
                                                    icon: 'info',
                                                    title: 'Belum Mengisi CV',
                                                    html: `
                    <p>Kamu belum mengisi CV.</p>
                    <a href="{{ route('pendaftaran.cv.create') }}" 
                       class="btn btn-warning fw-semibold mt-2">
                        <i class="bi bi-pencil-square me-1"></i> Isi CV Sekarang
                    </a>
                `,
                                                    showConfirmButton: false,
                                                    allowOutsideClick: false,
                                                    allowEscapeKey: false,
                                                    background: '#fffaf0',
                                                    color: '#333'
                                                });
                                            });
                                        </script>
                                    @else
                                     @include('components.cv_kandidat')
                                    @endif



                                </div>
                            </div>
                        @endif
                    </div>



                    <div class="row ">

                        {{-- Timeline --}}
                        <div class="col-12 col-md-8">
                            <div class="card shadow shadow-md">
                                <div class="card-header">
                                    <h4 class="mb-0">Timeline Proses Penempatan</h4>
                                </div>
                                <div class="card-body">
                                    @php
                                        $timelineSteps = [
                                            [
                                                'icon' => 'check-circle-fill',
                                                'color' => 'info',
                                                'title' => 'Job Matching',
                                                'status' => 'Job Matching',
                                            ],
                                            [
                                                'icon' => 'person-video3',
                                                'color' => 'primary',
                                                'title' => 'Interview',
                                                'status' => 'Interview',
                                            ],
                                            [
                                                'icon' => 'check2-circle',
                                                'color' => 'success',
                                                'title' => 'Lulus Interview',
                                                'status' => 'Lulus interview',
                                            ],
                                            [
                                                'icon' => 'award',
                                                'color' => 'success',
                                                'title' => 'Pemberkasan',
                                                'status' => 'Pemberkasan',
                                            ],
                                            [
                                                'icon' => 'rocket-takeoff',
                                                'color' => 'success',
                                                'title' => 'Berangkat',
                                                'status' => 'Berangkat',
                                            ],
                                            [
                                                'icon' => 'x-circle', // ubah dari rocket-takeoff ke x-circle
                                                'color' => 'danger', // tetap merah
                                                'title' => 'Ditolak',
                                                'status' => 'Ditolak',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($dataKandidat as $pendaftaran)
                                        @php
                                            $kandidat = $pendaftaran->kandidat;
                                        @endphp

                                        @if ($kandidat)
                                            @foreach ($timelineSteps as $step)
                                                @php
                                                    // Tentukan warna step
                                                    if ($step['status'] === $kandidat->status_kandidat) {
                                                        $stepColor = 'danger'; // status saat ini
                                                        $stepDate = $kandidat->updated_at;
                                                    } elseif (
                                                        array_search(
                                                            $step['status'],
                                                            array_column($timelineSteps, 'status'),
                                                        ) <
                                                        array_search(
                                                            $kandidat->status_kandidat,
                                                            array_column($timelineSteps, 'status'),
                                                        )
                                                    ) {
                                                        $stepColor = 'success'; // step sudah selesai
                                                        $stepDate = $kandidat->updated_at;
                                                    } else {
                                                        $stepColor = 'secondary'; // step selanjutnya
                                                        $stepDate = null;
                                                    }
                                                @endphp

                                                <div class="row mb-4 flex-column flex-md-row align-items-start">
                                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                                        <svg class="bi text-{{ $stepColor }}" width="24"
                                                            height="24" fill="currentColor">
                                                            <use
                                                                xlink:href="assets/static/images/bootstrap-icons.svg#{{ $step['icon'] }}" />
                                                        </svg>
                                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                                    </div>
                                                    <div class="col-12 col-md-10">
                                                        <h6 class="mb-1">{{ $step['title'] }}</h6>
                                                        @if ($stepDate)
                                                            <p class="text-muted small mb-0">Tanggal:
                                                                {{ $stepDate->format('d M Y H:i') }}</p>
                                                        @endif
                                                        <span
                                                            class="badge bg-{{ $stepColor }}">{{ $step['status'] }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">Belum ada proses kandidat.</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @forelse ($dataKandidat as $kandidat)
                            <div class="col-12 col-md-4">
                                <div class="card shadow shadow-mdborder-0 rounded-4 overflow-hidden">
                                    <!-- Header -->
                                    <div class="card-header text-white text-center p-3 ">
                                        <h5 class="mb-0 fw-bold">
                                            <i class="bi bi-person-badge me-2"></i> Profil Kandidat
                                        </h5>
                                    </div>

                                    <!-- Foto & Status -->
                                    <div class="card-body text-center p-4">
                                        <div class="position-relative mb-3">
                                            <img src="{{ asset($kandidat->foto) }}" alt="Foto Kandidat"
                                                class="rounded-circle border border-3 border-white shadow-sm"
                                                width="120" height="120"
                                                style="object-fit: cover; object-position: center;">

                                        </div>

                                        <!-- Nama & Email -->
                                        <h5 class="fw-bold mb-1">{{ $kandidat->nama }}</h5>
                                        <p class="text-muted mb-1">
                                            <i class="bi bi-envelope me-2 text-primary"></i> {{ $kandidat->email }}
                                        </p>

                                        <!-- Info Tambahan -->
                                        <ul class="list-unstyled text-start mb-3 small">
                                            <li class="mb-1">
                                                <i class="bi bi-building me-2 text-info"></i>
                                                Cabang: {{ $kandidat->cabang->nama_cabang ?? 'Tidak diketahui' }}
                                            </li>
                                            <li class="mb-1">
                                                <i class="bi bi-gender-ambiguous me-2 text-warning"></i>
                                                Jenis Kelamin: {{ $kandidat->jenis_kelamin }}
                                            </li>
                                            <li class="mb-1">
                                                <i class="bi bi-telephone me-2 text-success"></i>
                                                No WA: {{ $kandidat->no_wa }}
                                            </li>
                                        </ul>

                                        <!-- Tombol -->
                                        <a href="{{ route('dokumen.show', $kandidat->id) }}"
                                            class="btn btn-outline-info w-100 fw-semibold shadow-sm">
                                            <i class="bi bi-folder2-open me-2"></i> Lihat Dokumen

                                        </a>
                                    </div>

                                    <!-- Footer -->
                                    <div class="card-footer text-center text-muted small">
                                        Terdaftar sejak:
                                        {{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Belum Melakukan Pendaftaran',
                                        html: `
                    <p>Kamu belum melakukan pendaftaran.</p>
                    <a href="{{ route('pendaftaran.create') }}" 
                       class="btn btn-warning fw-semibold mt-2">
                        <i class="bi bi-pencil-square me-1"></i> Klik di sini untuk daftar
                    </a>
                `,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        background: '#fffaf0',
                                        color: '#333',
                                        didOpen: (popup) => {
                                            popup.querySelector('a').addEventListener('click', () => {
                                                Swal.close();
                                            });
                                        }
                                    });
                                });
                            </script>
                        @endforelse

                        {{-- CSS tambahan --}}
                        <style>
                            .card-header h5 i {
                                font-size: 1.2rem;
                            }

                            .card-body ul li i {
                                min-width: 20px;
                            }

                            .card-body .btn {
                                transition: all 0.3s ease;
                            }

                            .card-body .btn:hover {
                                transform: translateY(-2px);
                                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                            }

                            @media (max-width: 768px) {
                                .card-body ul {
                                    text-align: center;
                                    padding-left: 0;
                                }
                            }
                        </style>

                    </div>


                @endif

                @if (in_array(auth()->user()->role->name, ['admin cianjur pamoyanan', 'admin cianjur selatan', 'super admin']))
                    {{-- distribusi status kandidat --}}
                    <!-- Tambahkan script chart -->


                    @include('kandidat.index')

            </div>
            {{-- super admin --}}
            @endif
        </section>
    </div>

@endsection
