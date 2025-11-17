@extends('layouts.app')
@section('content')

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

    <div class="page-heading d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">

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
                        @foreach ($stats as $stat)
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card hover-card">
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
                            <div class="card">
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
                @endif
                @if (auth()->user()->role->name === 'kandidat')
                    <div class="row ">
                        {{-- Timeline --}}
                        {{-- Timeline --}}
                        <div class="col-12 col-md-8">
                            <div class="card">
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
                                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                                    <!-- Header -->
                                    <div class="card-header text-white text-center p-3 ">
                                        <h5 class="mb-0 fw-bold">
                                            <i class="bi bi-person-badge me-2"></i> Profil Kandidat
                                        </h5>
                                    </div>

                                    <!-- Foto & Status -->
                                    <div class="card-body text-center p-4">
                                        <div class="position-relative mb-3">
                                            <img src="{{ asset('storage/' . $kandidat->foto) }}" alt="Foto Kandidat"
                                                class="rounded-circle border border-3 border-white shadow-sm" width="120"
                                                height="120" style="object-fit: cover; object-position: center;">

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

                @if (in_array(auth()->user()->role->name, ['admin cianjur', 'admin cianjur selatan', 'super admin']))
                    {{-- distribusi status kandidat --}}
                    <!-- Tambahkan script chart -->



            </div>
            @include('kandidat.index')
            @endif
        </section>
    </div>

@endsection
