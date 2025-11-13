@extends('layouts.app')
@section('content')
    <div class="page-heading d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
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

        {{-- Judul halaman --}}
        <div class="mb-2 mb-md-0">
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

        {{-- Kartu user --}}
        @if (auth()->check())
            <div class="d-flex justify-content-md-end justify-content-center mt-3 mt-md-0 w-100">
                <div class="card shadow-sm w-100 w-md-auto" style="max-width: 350px;">
                    <div class="card-body py-3 px-3 d-flex align-items-center">
                        <div class="avatar rounded-circle" style="width: 50px; height: 50px; ">
                            <img src="data:image/jpeg;base64,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"
                                alt="{{ auth()->user()->name }}">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Halo, selamat datang</h6>
                            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                            <small class="text-muted d-block">{{ auth()->user()->email }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <hr>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                @if (auth()->user()->role->name === 'super admin')
                    <div class="row">
                        <!-- Total Siswa -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card hover-card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                            <div class="stats-icon blue mb-2">
                                                <i class="bi bi-person-bounding-box fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                            <h6 class="text-muted font-semibold">Total Siswa</h6>
                                            <h6 class="font-extrabold mb-0">150</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Kandidat -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card hover-card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                            <div class="stats-icon green mb-2">
                                                <i class="bi bi-people-fill fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                            <h6 class="text-muted font-semibold">Total Kandidat</h6>
                                            <h6 class="font-extrabold mb-0">120</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Cabang -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card hover-card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                            <div class="stats-icon purple mb-2">
                                                <i class="bi bi-building fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                            <h6 class="text-muted font-semibold">Total Cabang</h6>
                                            <h6 class="font-extrabold mb-0">10</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Institusi -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card hover-card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                            <div class="stats-icon red mb-2">
                                                <i class="bi bi-bank fs-3"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                            <h6 class="text-muted font-semibold">Total Institusi</h6>
                                            <h6 class="font-extrabold mb-0">8</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Status Penempatan Kandidat -->
                    <div class="row mt-4">
                        @php
                            $status_penempatan = [
                                'INTERVIEW' => 15,
                                'SUDAH_BERANGKAT' => 20,
                                'VERIFIKASI_DATA' => 10,
                                'PENDING' => 8,
                                'MENUNGGU_JOB_MATCHING' => 12,
                                'SELESAI' => 18,
                                'DITOLAK' => 5,
                            ];

                            $status_icon = [
                                'INTERVIEW' => 'bi bi-chat-dots',
                                'SUDAH_BERANGKAT' => 'bi bi-airplane-engines',
                                'VERIFIKASI_DATA' => 'bi bi-file-earmark-check',
                                'PENDING' => 'bi bi-hourglass-split',
                                'MENUNGGU_JOB_MATCHING' => 'bi bi-people',
                                'SELESAI' => 'bi bi-check-circle',
                                'DITOLAK' => 'bi bi-x-circle',
                            ];

                            $status_gradient = [
                                'INTERVIEW' => 'background: linear-gradient(135deg, #17a2b8, #007bff); color: white;',
                                'SUDAH_BERANGKAT' =>
                                    'background: linear-gradient(135deg, #28a745, #20c997); color: white;',
                                'VERIFIKASI_DATA' =>
                                    'background: linear-gradient(135deg, #007bff, #6610f2); color: white;',
                                'PENDING' => 'background: linear-gradient(135deg, #ffc107, #ffcd39); color: #212529;',
                                'MENUNGGU_JOB_MATCHING' =>
                                    'background: linear-gradient(135deg, #6c757d, #adb5bd); color: white;',
                                'SELESAI' => 'background: linear-gradient(135deg, #00c851, #007e33); color: white;',
                                'DITOLAK' => 'background: linear-gradient(135deg, #dc3545, #ff6b6b); color: white;',
                            ];
                        @endphp

                        @foreach ($status_penempatan as $status => $jumlah)
                            <div class="col-6 col-lg-3 col-md-6 mb-3">
                                <div class="card shadow-sm border-0 hover-card">
                                    <div class="card-body px-4 py-4-5">
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
                                                    {{ str_replace('_', ' ', strtolower($status)) }}</h6>
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
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kandidat Percabang</h4>
                                </div>
                                <div class="card-body">
                                    <div id="chart-kandidat-cabang"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (auth()->user()->role->name === 'kandidat')
                    <div class="row ">
                        {{-- Timeline --}}
                        <div class="col-12 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Timeline Proses Penempatan</h4>
                                </div>
                                <div class="card-body">
                                    @php
                                        $timeline = [
                                            [
                                                'icon' => 'check-circle-fill',
                                                'color' => 'info',
                                                'title' => 'Verifikasi Dokumen',
                                                'date' => '2025-01-12',
                                                'badge' => 'VERIFIKASI_DATA',
                                            ],
                                            [
                                                'icon' => 'hourglass-split',
                                                'color' => 'warning',
                                                'title' => 'Menunggu Job Matching',
                                                'date' => '2025-01-15',
                                                'badge' => 'MENUNGGU_JOB_MATCHING',
                                            ],
                                            [
                                                'icon' => 'person-video3',
                                                'color' => 'primary',
                                                'title' => 'Interview',
                                                'date' => '2025-01-18',
                                                'badge' => 'INTERVIEW',
                                            ],
                                            [
                                                'icon' => 'check2-circle',
                                                'color' => 'success',
                                                'title' => 'Sudah Berangkat',
                                                'date' => '2025-01-25',
                                                'badge' => 'SUDAH_BERANGKAT',
                                            ],
                                            [
                                                'icon' => 'award',
                                                'color' => 'success',
                                                'title' => 'Selesai',
                                                'date' => '2025-02-20',
                                                'badge' => 'SELESAI',
                                            ],
                                            [
                                                'icon' => 'x-circle-fill',
                                                'color' => 'danger',
                                                'title' => 'Ditolak',
                                                'date' => '2025-01-19',
                                                'badge' => 'DITOLAK',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($timeline as $step)
                                        <div class="row mb-4 flex-column flex-md-row align-items-start">
                                            <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                                <svg class="bi text-{{ $step['color'] }}" width="24" height="24"
                                                    fill="currentColor">
                                                    <use
                                                        xlink:href="assets/static/images/bootstrap-icons.svg#{{ $step['icon'] }}" />
                                                </svg>
                                                <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <h6 class="mb-1">{{ $step['title'] }}</h6>
                                                <p class="text-muted small mb-0">Tanggal: {{ $step['date'] }}</p>
                                                <span class="badge bg-{{ $step['color'] }}">{{ $step['badge'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @forelse ($dataKandidat as $kandidat)
                            <div class="col-12 col-md-4">
                                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                                    <!-- Header -->
                                    <div class="card-header text-white text-center p-3 bg-warning">
                                        <h5 class="mb-0 fw-bold">
                                            <i class="bi bi-person-badge me-2"></i> Profil Kandidat
                                        </h5>
                                    </div>

                                    <!-- Foto & Status -->
                                    <div class="card-body text-center p-4">
                                        <div class="position-relative mb-3">
                                            <img src="{{ asset('storage/' . $kandidat->foto) }}" alt="Foto Kandidat"
                                                class="rounded-circle border border-3 border-white shadow-sm"
                                                width="120" height="130">
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
                                            class="btn btn-warning w-100 fw-semibold shadow-sm">
                                            <i class="bi bi-eye me-2"></i> Lihat Dokumen
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

                @if (in_array(auth()->user()->role->name, ['admin cianjur', 'admin cianjur selatan', 'super admin']))
                    {{-- distribusi status kandidat --}}


                    <!-- Tambahkan script chart -->
                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var options = {
                                series: [{
                                        name: 'Lulus',
                                        data: [45, 60, 50, 70]
                                    },
                                    {
                                        name: 'Tidak Lulus',
                                        data: [20, 15, 25, 10]
                                    },
                                    {
                                        name: 'Proses',
                                        data: [25, 20, 15, 15]
                                    },
                                    {
                                        name: 'Pending',
                                        data: [10, 5, 10, 5]
                                    }
                                ],
                                chart: {
                                    type: 'bar',
                                    height: 300,
                                    toolbar: {
                                        show: false
                                    }
                                },
                                colors: ['#00E396', '#FF4560', '#FEB019', '#775DD0'],
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
                                    categories: ['Cabang Bandung', 'Cabang Garut', 'Cabang Tasik', 'Cabang Cianjur'],
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

                            var chart = new ApexCharts(document.querySelector("#chart-distribusi-status"), options);
                            chart.render();
                        });
                    </script>

            </div>


            @include('kandidat.index')
            @endif
        </section>
    </div>

@endsection
