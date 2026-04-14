@extends('layouts.app')

@section('content')

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .card-hover {
            transition: all 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 2px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

    @if (session('google_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: '{{ session('google_success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- Page Header --}}
    <div class="mb-4 md:mb-6 mt-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                @if (auth()->user()->role === 'kandidat')
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Halo, {{ auth()->user()->name }} 👋</h1>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">Ini adalah timeline aktivitas Anda.</p>
                @elseif(in_array(auth()->user()->role, [
                        'Cabang Cianjur Selatan Mendunia',
                        'Cabang Cianjur Pamoyanan Mendunia',
                        'Cabang Batam Mendunia',
                        'Cabang Banyuwangi Mendunia',
                        'Cabang Kendal Mendunia',
                        'Cabang Pati Mendunia',
                        'Cabang Tulung Agung Mendunia',
                        'Cabang Bangkalan Mendunia',
                        'Cabang Bojonegoro Mendunia',
                        'Cabang Jember Mendunia',
                        'Cabang Wonosobo Mendunia',
                        'Cabang Eshan Mendunia',
                    ]))
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Halo, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">Menampilkan data kandidat di cabang Anda.</p>
                @elseif(auth()->user()->role === 'super-admin')
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Halo, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">Dashboard Super Admin</p>
                @endif
            </div>
            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500">
                <i class="bi bi-calendar3"></i>
                <span>{{ date('d M Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="space-y-4 md:space-y-6">

        @if (auth()->user()->role === 'super-admin')
            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                @foreach ($stats as $stat)
                    <div class="bg-white rounded-xl p-3 sm:p-4 md:p-5 shadow-sm border border-gray-100 card-hover">
                        <div class="flex items-center gap-2 sm:gap-3 md:gap-4">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-lg flex items-center justify-center text-white flex-shrink-0"
                                style="background-color: {{ $stat['bg_color'] ?? '#3b82f6' }}">
                                <i class="bi {{ $stat['icon'] }} text-base sm:text-lg md:text-xl"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-gray-500 text-[10px] sm:text-xs font-medium uppercase tracking-wide truncate">
                                    {{ $stat['title'] }}</p>
                                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">{{ $stat['count'] }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Status Cards --}}
            <div>
                <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-3 md:mb-4">Status Penempatan</h2>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-5 gap-2 sm:gap-3 md:gap-4">
                    @php
                        $status_config = [
                            'Job Matching'              => ['bg' => 'bg-gray-500',   'icon' => 'bi-people'],
                            'lamar ke perusahaan'       => ['bg' => 'bg-gray-400',   'icon' => 'bi-send'],
                            'Interview'                 => ['bg' => 'bg-cyan-500',   'icon' => 'bi-chat-dots'],
                            'Gagal Interview'           => ['bg' => 'bg-red-500',    'icon' => 'bi-x-circle'],
                            'Jadwalkan Interview Ulang' => ['bg' => 'bg-orange-500', 'icon' => 'bi-arrow-repeat'],
                            'Lulus interview'           => ['bg' => 'bg-emerald-500','icon' => 'bi-check-circle'],
                            'Pemberkasan'               => ['bg' => 'bg-blue-600',   'icon' => 'bi-file-earmark-check'],
                            'Berangkat'                 => ['bg' => 'bg-green-500',  'icon' => 'bi-airplane-engines'],
                            'Ditolak'                   => ['bg' => 'bg-red-600',    'icon' => 'bi-x-circle'],
                        ];
                    @endphp
                    @foreach ($status_penempatan as $status => $jumlah)
                        <div class="bg-white rounded-xl p-2 sm:p-3 md:p-4 shadow-sm border border-gray-100 card-hover">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-lg flex items-center justify-center text-white mb-2 {{ $status_config[$status]['bg'] ?? 'bg-gray-500' }}">
                                    <i class="bi {{ $status_config[$status]['icon'] ?? 'bi-circle' }} text-sm sm:text-base md:text-xl"></i>
                                </div>
                                <p class="text-[9px] sm:text-[10px] md:text-xs text-gray-500 font-medium uppercase tracking-wide truncate w-full"
                                    style="text-transform: capitalize;">{{ $status }}</p>
                                <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-800 mt-1">{{ $jumlah }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Charts Row --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                {{-- Bar Chart --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-3 sm:px-4 md:px-5 py-3 md:py-4 border-b border-gray-100">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-lg bg-indigo-500 flex items-center justify-center text-white flex-shrink-0">
                                <i class="bi bi-bar-chart text-sm sm:text-base md:text-lg"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate">Kandidat Percabang</h3>
                                <p class="text-[10px] sm:text-xs text-gray-500 hidden sm:block">Distribusi kandidat per cabang</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 sm:p-4 md:p-5">
                        <div id="chart-kandidat"></div>
                    </div>
                </div>

                {{-- Online Users --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-3 sm:px-4 md:px-5 py-3 md:py-4 border-b border-gray-100">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-lg bg-emerald-500 flex items-center justify-center text-white flex-shrink-0">
                                <i class="bi bi-people text-sm sm:text-base md:text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-sm sm:text-base">User Online</h3>
                                <p class="text-[10px] sm:text-xs text-gray-500 hidden sm:block">Aktivitas pengguna</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 sm:p-3 max-h-64 sm:max-h-80 md:max-h-96 overflow-y-auto">
                        @foreach ($users as $user)
                            @php
                                $isOnline = $user->last_activity && $user->last_activity >= now()->subMinutes(5);
                                $lastActiveText = $user->last_activity
                                    ? $user->last_activity->diffForHumans()
                                    : 'Belum pernah';
                            @endphp
                            <div class="flex items-center justify-between p-2 sm:p-3 rounded-lg hover:bg-gray-50 transition-colors mb-1">
                                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                                    <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold text-xs sm:text-sm flex-shrink-0">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs sm:text-sm font-medium text-gray-800 truncate">{{ $user->name }}</p>
                                        <p class="text-[10px] sm:text-xs text-gray-500 truncate">
                                            {{ $isOnline ? 'Online' : $lastActiveText }}</p>
                                    </div>
                                </div>
                                <span class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full flex-shrink-0 {{ $isOnline ? 'bg-emerald-500' : 'bg-gray-300' }}"></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Pie Chart --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-3 sm:px-4 md:px-5 py-3 md:py-4 border-b border-gray-100">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-lg bg-purple-500 flex items-center justify-center text-white flex-shrink-0">
                            <i class="bi bi-pie-chart text-sm sm:text-base md:text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base">Distribusi Status</h3>
                            <p class="text-[10px] sm:text-xs text-gray-500 hidden sm:block">Statistik status terbaru</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 sm:p-4 md:p-5">
                    <div id="chart-status-kandidat"></div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var options = {
                        series: @json($chart_data),
                        chart: {
                            type: 'bar',
                            height: 280,
                            toolbar: { show: false },
                            fontFamily: 'Inter, sans-serif'
                        },
                        colors: ['#6366f1', '#f59e0b', '#06b6d4', '#ef4444', '#10b981', '#8b5cf6'],
                        plotOptions: {
                            bar: { horizontal: false, columnWidth: '70%', borderRadius: 6 }
                        },
                        dataLabels: { enabled: false },
                        stroke: { show: true, width: 2, colors: ['transparent'] },
                        xaxis: {
                            categories: @json(array_values($cabangs)),
                            labels: { style: { colors: '#6b7280', fontSize: '10px' } }
                        },
                        yaxis: {
                            labels: { style: { colors: '#6b7280', fontSize: '10px' } }
                        },
                        fill: { opacity: 1 },
                        tooltip: { y: { formatter: function(val) { return val + " kandidat"; } } },
                        legend: { position: 'bottom' }
                    };
                    new ApexCharts(document.querySelector("#chart-kandidat"), options).render();

                    var statusOptions = {
                        series: @json($statusCounts),
                        chart: { type: 'pie', height: 280, fontFamily: 'Inter, sans-serif' },
                        labels: @json($statusLabels),
                        legend: { position: 'bottom' },
                        dataLabels: { enabled: true },
                        colors: ['#6b7280', '#f59e0b', '#06b6d4', '#ef4444', '#8b5cf6', '#10b981', '#3b82f6', '#22c55e', '#000000'],
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: { height: 220 },
                                legend: { position: 'bottom' }
                            }
                        }]
                    };
                    new ApexCharts(document.querySelector("#chart-status-kandidat"), statusOptions).render();
                });
            </script>
        @endif

        {{-- Kandidat View --}}
        @if (auth()->user()->role === 'kandidat')
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <span class="text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">

                {{-- Timeline --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

                        <div class="px-4 py-3 border-b border-gray-100 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-clock-history text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Timeline proses penempatan</p>
                                <p class="text-xs text-gray-400">Status perjalanan kandidat</p>
                            </div>
                        </div>

                        <div class="p-4 md:p-5">
                            @php
                                $timelineSteps = [
                                    ['icon' => 'check-circle',      'title' => 'Job Matching',        'status' => 'Job Matching'],
                                    ['icon' => 'person-badge',       'title' => 'Lamar ke perusahaan', 'status' => 'lamar ke perusahaan'],
                                    ['icon' => 'camera-video',       'title' => 'Interview',           'status' => 'Interview'],
                                    ['icon' => 'patch-check',        'title' => 'Lulus interview',     'status' => 'Lulus interview'],
                                    ['icon' => 'file-earmark-text',  'title' => 'Pemberkasan',         'status' => 'Pemberkasan'],
                                    ['icon' => 'send',               'title' => 'Berangkat',           'status' => 'Berangkat'],
                                    ['icon' => 'x-circle',           'title' => 'Gagal Interview',     'status' => 'Gagal Interview'],
                                ];

                                $statusList = array_column($timelineSteps, 'status');

                                // Filter hanya pendaftaran yang punya relasi kandidat
                                $validDataKandidat = $dataKandidat->filter(fn($p) => !is_null($p->kandidat));
                            @endphp

                            @if ($validDataKandidat->isEmpty())
                                {{-- Tampilkan pesan jika tidak ada data --}}
                                <div class="text-center py-8 text-gray-400">
                                    <i class="bi bi-inbox text-3xl block mb-2"></i>
                                    <p class="text-sm">Belum ada proses kandidat.</p>
                                </div>
                            @else
                                @foreach ($validDataKandidat as $pendaftaran)
                                    @php
                                        $kandidat      = $pendaftaran->kandidat;
                                        $namaPerusahaan = $kandidat->nama_perusahaan
                                            ?? ($kandidat->institusi->nama_perusahaan ?? '-');
                                        $bidangSsw     = optional($kandidat->bidang_ssws)->pluck('nama_bidang')->join(', ') ?: '-';
                                        $currentIndex  = array_search($kandidat->status_kandidat ?? '', $statusList);
                                        $isFail        = $kandidat->status_kandidat === 'Gagal Interview';
                                    @endphp

                                    @foreach ($timelineSteps as $step)
                                        @php
                                            $stepIdx = array_search($step['status'], $statusList);

                                            if ($isFail) {
                                                $state = $step['status'] === 'Gagal Interview' ? 'danger' : 'idle';
                                            } elseif ($stepIdx < $currentIndex) {
                                                $state = 'done';
                                            } elseif ($stepIdx === $currentIndex) {
                                                $state = 'active';
                                            } else {
                                                $state = 'idle';
                                            }

                                            $dotClass = match ($state) {
                                                'done'    => 'bg-green-50 border-green-400',
                                                'active'  => 'bg-blue-50 border-blue-400',
                                                'danger'  => 'bg-red-50 border-red-400',
                                                default   => 'bg-gray-100 border-gray-200',
                                            };
                                            $iconClass = match ($state) {
                                                'done'   => 'text-green-700',
                                                'active' => 'text-blue-700',
                                                'danger' => 'text-red-600',
                                                default  => 'text-gray-300',
                                            };
                                            $cardClass = match ($state) {
                                                'done'   => 'bg-green-50 border-green-100',
                                                'active' => 'bg-blue-50 border-blue-200',
                                                'danger' => 'bg-red-50 border-red-200',
                                                default  => 'bg-gray-50 border-gray-100',
                                            };
                                            $badgeClass = match ($state) {
                                                'done'   => 'bg-green-100 text-green-800',
                                                'active' => 'bg-blue-100 text-blue-800',
                                                'danger' => 'bg-red-100 text-red-800',
                                                default  => 'bg-gray-100 text-gray-400',
                                            };
                                            $isLast = $loop->last;
                                        @endphp

                                        <div class="flex gap-3 items-stretch">

                                            {{-- Dot + Connector --}}
                                            <div class="flex flex-col items-center w-9 flex-shrink-0">
                                                <div class="w-9 h-9 rounded-full border-2 flex items-center justify-center {{ $dotClass }}">
                                                    @if ($state === 'done')
                                                        <i class="bi bi-check-lg text-xs {{ $iconClass }}"></i>
                                                    @else
                                                        <i class="bi bi-{{ $step['icon'] }} text-xs {{ $iconClass }}"></i>
                                                    @endif
                                                </div>
                                                @unless ($isLast)
                                                    <div class="w-px flex-1 my-1 bg-gray-100"></div>
                                                @endunless
                                            </div>

                                            {{-- Card --}}
                                            <div class="flex-1 {{ $isLast ? 'pb-1' : 'pb-4' }}">
                                                <div class="rounded-xl border px-4 py-3 {{ $cardClass }}">
                                                    <div class="flex items-start justify-between gap-2 flex-wrap">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-800">
                                                                {{ $step['title'] }}</p>

                                                            @if (in_array($state, ['active', 'danger']))
                                                                <p class="text-xs text-gray-400 mt-0.5">
                                                                    Update: {{ $kandidat->updated_at->format('d M Y, H:i') }}
                                                                </p>
                                                                @if ($namaPerusahaan !== '-')
                                                                    <p class="text-xs text-gray-500 mt-1">
                                                                        Perusahaan:
                                                                        <span class="font-medium text-gray-700">{{ $namaPerusahaan }}</span>
                                                                    </p>
                                                                @endif
                                                                @if ($kandidat->detail_pekerjaan)
                                                                    <p class="text-xs text-gray-500 mt-0.5">
                                                                        Detail pekerjaan:
                                                                        <span class="italic text-gray-600">{{ $kandidat->detail_pekerjaan }}</span>
                                                                    </p>
                                                                @endif
                                                                @if ($bidangSsw !== '-')
                                                                    <p class="text-xs text-gray-500 mt-0.5">
                                                                        Bidang SSW:
                                                                        <span class="font-medium text-gray-700">{{ $bidangSsw }}</span>
                                                                    </p>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        <span class="text-[11px] font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $badgeClass }}">
                                                            {{ $step['status'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>

                {{-- Profile Card --}}
                <div>
                    @include('components.profile_kandidat')
                </div>

            </div>

            {{-- CV Section --}}
            <div class="mt-4 md:mt-6">
                @if ($cvs->isEmpty())
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Lengkapi CV Anda',
                                text: 'Lengkapi CV untuk melanjutkan proses pendaftaran',
                                icon: 'info',
                                confirmButtonText: 'Isi CV Sekarang',
                                confirmButtonColor: '#4f46e5'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('pendaftaran.cv.create') }}";
                                }
                            });
                        });
                    </script>
                @else
                    @include('components.cv_kandidat')
                @endif
            </div>
        @endif

        {{-- Branch Admin View --}}
        @if (in_array(auth()->user()->role, [
                'super-admin',
                'Cabang Cianjur Selatan Mendunia',
                'Cabang Cianjur Pamoyanan Mendunia',
                'Cabang Batam Mendunia',
                'Cabang Banyuwangi Mendunia',
                'Cabang Kendal Mendunia',
                'Cabang Pati Mendunia',
                'Cabang Tulung Agung Mendunia',
                'Cabang Bangkalan Mendunia',
                'Cabang Bojonegoro Mendunia',
                'Cabang Jember Mendunia',
                'Cabang Wonosobo Mendunia',
                'Cabang Eshan Mendunia',
            ]))
            @include('kandidat.index')
        @endif

        {{-- Table Kandidat --}}
        @include('components.table_kandidat')

    </div>

@endsection