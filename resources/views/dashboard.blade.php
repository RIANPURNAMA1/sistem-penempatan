@extends('layouts.app')
@section('content')
    <div class="page-heading d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
        <div class="mb-2 mb-md-0">
            <h3 class="mb-1">Dashboard Distribusi Kandidat</h3>
            <p class="text-muted mb-0">Menampilkan data statistik kandidat berdasarkan status dan cabang.</p>
        </div>
        <div class="badge text-white px-3 py-2 rounded-pill mt-2 mt-md-0" style="background-color: #00c0ff">
            Sistem Rekrutmen Penempatan Kandidat
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
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
                            'SUDAH_BERANGKAT' => 'background: linear-gradient(135deg, #28a745, #20c997); color: white;',
                            'VERIFIKASI_DATA' => 'background: linear-gradient(135deg, #007bff, #6610f2); color: white;',
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
                                            <h6 class="text-muted font-semibold mb-1" style="text-transform: capitalize;">
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
                <div class="row m-1">
                    

                    @if (auth()->user()->role === 'kandidat')
                        {{-- timeline --}}
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="mb-0">Timeline Proses Penempatan</h4>
                            </div>

                            <div class="card-body">

                                <!-- VERIFIKASI DATA -->
                                <div class="row mb-4 flex-column flex-md-row align-items-start ">
                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                        <svg class="bi text-info" width="24" height="24" fill="currentColor">
                                            <use xlink:href="assets/static/images/bootstrap-icons.svg#check-circle-fill" />
                                        </svg>
                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <h6 class="mb-1">Verifikasi Dokumen</h6>
                                        <p class="text-muted small mb-0">Tanggal: 2025-01-12</p>
                                        <span class="badge bg-info">VERIFIKASI_DATA</span>
                                    </div>
                                </div>

                                <!-- MENUNGGU JOB MATCHING -->
                                <div class="row mb-4 flex-column flex-md-row align-items-start">
                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                        <svg class="bi text-warning" width="24" height="24" fill="currentColor">
                                            <use xlink:href="assets/static/images/bootstrap-icons.svg#hourglass-split" />
                                        </svg>
                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <h6 class="mb-1">Menunggu Job Matching</h6>
                                        <p class="text-muted small mb-0">Tanggal: 2025-01-15</p>
                                        <span class="badge bg-warning text-dark">MENUNGGU_JOB_MATCHING</span>
                                    </div>
                                </div>

                                <!-- INTERVIEW -->
                                <div class="row mb-4 flex-column flex-md-row align-items-start">
                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                        <svg class="bi text-primary" width="24" height="24" fill="currentColor">
                                            <use xlink:href="assets/static/images/bootstrap-icons.svg#person-video3" />
                                        </svg>
                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <h6 class="mb-1">Interview</h6>
                                        <p class="text-muted small mb-0">Tanggal: 2025-01-18</p>
                                        <span class="badge bg-primary">INTERVIEW</span>
                                    </div>
                                </div>

                                <!-- SUDAH BERANGKAT -->
                                <div class="row mb-4 flex-column flex-md-row align-items-start">
                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                        <svg class="bi text-success" width="24" height="24" fill="currentColor">
                                            <use xlink:href="assets/static/images/bootstrap-icons.svg#check2-circle" />
                                        </svg>
                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <h6 class="mb-1">Sudah Berangkat</h6>
                                        <p class="text-muted small mb-0">Tanggal: 2025-01-25</p>
                                        <span class="badge bg-success">SUDAH_BERANGKAT</span>
                                    </div>
                                </div>

                                <!-- SELESAI -->
                                <div class="row mb-4 flex-column flex-md-row align-items-start">
                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                        <svg class="bi text-success" width="24" height="24" fill="currentColor">
                                            <use xlink:href="assets/static/images/bootstrap-icons.svg#award" />
                                        </svg>
                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <h6 class="mb-1">Selesai</h6>
                                        <p class="text-muted small mb-0">Tanggal: 2025-02-20</p>
                                        <span class="badge bg-success">SELESAI</span>
                                    </div>
                                </div>

                                <!-- DITOLAK -->
                                <div class="row flex-column flex-md-row align-items-start">
                                    <div class="col-2 col-md-2 text-center mb-2 mb-md-0">
                                        <svg class="bi text-danger" width="24" height="24" fill="currentColor">
                                            <use xlink:href="assets/static/images/bootstrap-icons.svg#x-circle-fill" />
                                        </svg>
                                        <div class="vr h-100 mx-auto d-none d-md-block"></div>
                                    </div>
                                    <div class="col-12 col-md-10">
                                        <h6 class="mb-1">Ditolak</h6>
                                        <p class="text-muted small mb-0">Tanggal: 2025-01-19</p>
                                        <span class="badge bg-danger">DITOLAK</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                    {{-- 
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Latest Comments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="./assets/compiled/jpg/5.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="./assets/compiled/jpg/2.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Wow amazing design! Can you make another
                                                    tutorial for
                                                    this design?</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
            <div class="col-12 col-lg-3">

                {{-- admin login --}}
                <div class="card">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="./assets/compiled/jpg/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">admin</h5>
                                <h6 class="text-muted mb-0">@mendunia</h6>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Daftar Siswa yang Login --}}
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Daftar Siswa yang Login</h4>
                        <i class="bi bi-person-check-fill fs-4 text-primary"></i>
                    </div>

                    <div class="card-content pb-4">
                        @php
                            $siswa_login = [
                                [
                                    'nama' => 'Rian Purnama',
                                    'email' => 'rianpurnama@example.com',
                                    'cabang' => 'Cabang Bandung',
                                    'foto' => 'https://randomuser.me/api/portraits/men/32.jpg',
                                    'waktu_login' => '5 menit yang lalu',
                                ],
                                [
                                    'nama' => 'Siti Rahmawati',
                                    'email' => 'siti.rahma@example.com',
                                    'cabang' => 'Cabang Cirebon',
                                    'foto' => 'https://randomuser.me/api/portraits/women/45.jpg',
                                    'waktu_login' => '10 menit yang lalu',
                                ],
                                [
                                    'nama' => 'Budi Santoso',
                                    'email' => 'budi.santoso@example.com',
                                    'cabang' => 'Cabang Jakarta',
                                    'foto' => 'https://randomuser.me/api/portraits/men/52.jpg',
                                    'waktu_login' => '15 menit yang lalu',
                                ],
                                [
                                    'nama' => 'Dewi Lestari',
                                    'email' => 'dewi.lestari@example.com',
                                    'cabang' => 'Cabang Bogor',
                                    'foto' => 'https://randomuser.me/api/portraits/women/33.jpg',
                                    'waktu_login' => '20 menit yang lalu',
                                ],
                            ];
                        @endphp

                        {{-- Loop daftar siswa yang login --}}
                        @foreach ($siswa_login as $siswa)
                            <div class="recent-message d-flex align-items-center px-4 py-3 border-bottom">
                                <div class="avatar avatar-lg">
                                    <img src="{{ $siswa['foto'] }}" alt="Foto {{ $siswa['nama'] }}"
                                        class="rounded-circle shadow-sm">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1 text-muted font-semibold">{{ $siswa['nama'] }}</h5>
                                    <h6 class="text-muted mb-0 small">
                                        <i class="bi bi-envelope me-1"></i>{{ $siswa['email'] }}
                                    </h6>
                                    <span class="badge bg-primary mt-1">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $siswa['cabang'] }}
                                    </span>
                                    <div class="text-muted small mt-1">
                                        <i class="bi bi-clock me-1"></i>{{ $siswa['waktu_login'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Tombol Lihat Semua --}}
                        <div class="px-4">
                            <button class="btn btn-block btn-outline-primary font-bold mt-3 w-100">
                                <i class="bi bi-list-ul me-2"></i> Lihat Semua Siswa Login
                            </button>
                        </div>
                    </div>
                </div>

                {{-- distribusi status kandidat --}}

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Distribusi Status Kandidat</h4>
                        <span class="badge bg-primary text-white">Data Dummy</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Menampilkan persentase status kandidat dari berbagai cabang.
                        </p>
                        <div id="chart-distribusi-status"></div>
                    </div>
                </div>

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
        </section>
    </div>
@endsection
