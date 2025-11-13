<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Penempatan</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.png') }}" type="image/png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">

    <!-- Init Theme -->
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
</head>
<style>
    <style>

    /* Sidebar main links */
    .sidebar-link,
    .submenu-link {
        text-decoration: none !important;
        /* hilangkan garis bawah */
        color: #333;
        /* warna default hitam gelap */
        transition: color 0.3s;
        /* animasi smooth saat hover */
    }

    /* Hover effect */
    .sidebar-link:hover,
    .submenu-link:hover {
        color: #000;
        /* warna hitam saat hover */
        text-decoration: none;
        /* pastikan garis bawah tetap hilang */
        background-color: rgba(0, 0, 0, 0.05);
        /* opsional: efek highlight ringan */
    }

    /* Jika ada active state */
    .sidebar-item.active-sidebar>.sidebar-link {
        color: #000;
        /* warna aktif hitam */
        font-weight: 600;
    }
</style>

</style>

<body>
    <div id="app">
        {{-- sidebar --}}

        <div id="sidebar">

            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">


                    <!-- BARIS UNTUK TOGGLE & SIDEBAR TOGGLER -->
                    <div class="d-flex justify-content-center align-items-center" style="padding-right: 8px;">

                        <!-- LOGO -->
                        <div class="">
                            <a href="index.html">
                                <img src="/assets/compiled/png/LOGO/logo4.png" alt="Logo"
                                    style="width: 70px; height:auto;">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-title">Menu Utama</li>

                        <li class="sidebar-item active-sidebar">
                            <a href="{{ url('/') }}" class='sidebar-link rounded-full'>
                                <i class="bi bi-grid-fill text-dark"></i>
                                <span class="text-active-side">Dashboard</span>
                            </a>
                        </li>

                        @if (auth()->check())
                            {{-- Menu untuk kandidat --}}
                            @if (auth()->user()->role->name === 'kandidat')
                                <li class="sidebar-item has-sub">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-person-vcard"></i>
                                        <span>Pendaftaran Kandidat</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item">
                                            <a href="{{ url('/pendaftaran/kandidat') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                Pendaftaran
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Menu untuk admin cianjur & admin cianjur selatan --}}
                            @if (in_array(auth()->user()->role->name, ['admin cianjur', 'admin cianjur selatan']))
                                <li class="sidebar-item has-sub">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-people-fill"></i>
                                        <span>Kelola Kandidat</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item">
                                            <a href="{{ url('/kandidat?cabang=' . auth()->user()->cabang) }}"
                                                class="submenu-link" style="text-decoration: none;">
                                                Kandidat Cabang Saya
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            {{-- Menu untuk super admin --}}
                            @if (auth()->user()->role->name === 'super admin')
                                <li class="sidebar-item has-sub">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-people-fill"></i>
                                        <span>Kelola Kandidat</span>
                                    </a>
                                    <ul class="submenu">
                                        {{-- Data Kandidat --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/kandidat') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-list-ul me-1"></i> Data Kandidat
                                            </a>
                                        </li>

                                        {{-- Interview Kandidat --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/interview') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-chat-left-text me-1"></i> Interview
                                            </a>
                                        </li>

                                        {{-- Institusi --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/institusi') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-building me-1"></i> Institusi
                                            </a>
                                        </li>

                                        {{-- Penempatan --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/penempatan') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-geo-alt me-1"></i> Penempatan
                                            </a>
                                        </li>

                                        {{-- Import Excel --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/siswa/import') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-file-earmark-excel me-1"></i> Import Excel
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/cabang') }}" class="sidebar-link d-flex align-items-center">
                                        <i class="bi bi-building me-2"></i>
                                        <span>Cabang</span>
                                    </a>
                                </li>
                            @endif

                        @endif

                        <li class="sidebar-title">Pengaturan</li>

                        <li class="sidebar-item">
                            <a href="{{ url('/profil') }}" class='sidebar-link' style="text-decoration: none;">
                                <i class="bi bi-person-circle"></i>
                                <span>Profil</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" style="text-decoration: none;" id="logout-link">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>


            </div>
        </div>
        <!-- Tambahkan SweetAlert CDN jika belum ada -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('logout-link').addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah langsung submit

                Swal.fire({
                    title: 'Apakah Anda yakin ingin logout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form logout jika konfirmasi
                        document.getElementById('logout-form').submit();
                    }
                });
            });
        </script>
        {{-- sidebar --}}


        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>



            {{-- Content --}}
            @yield('content')

            {{-- Footer --}}
            <footer class="mt-5 border-top pt-3">
                <div
                    class=" d-flex flex-column flex-md-row justify-content-between align-items-center text-muted small px-4 py-2">
                    <div class="mb-2 mb-md-0">
                        <p class="mb-0 fw-semibold">&copy; {{ date('Y') }} Sistem Penempatan Kandidat. All Rights
                            Reserved.</p>
                    </div>
                    <div>
                        <p class="mb-0">
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart-fill"></i></span>
                            by <a href="https://riidev.my.id"
                                class="text-decoration-none fw-semibold text-primary">Mendunia.id</a>
                        </p>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>

    {{-- Datatables --}}
    <script src="//cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <!-- Chart Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cabangNames = ['Bandung', 'Cirebon', 'Jakarta', 'Bogor', 'Depok'];
            const kandidatCounts = [12, 8, 5, 9, 6];

            var options = {
                series: [{
                    name: 'Jumlah Kandidat',
                    data: kandidatCounts
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: false,
                        columnWidth: '45%',
                    },
                },
                dataLabels: {
                    enabled: true
                },
                xaxis: {
                    categories: cabangNames,
                    title: {
                        text: 'Cabang'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Kandidat'
                    }
                },
                colors: ['#00c0ff']
            };

            var chart = new ApexCharts(document.querySelector("#chart-kandidat-cabang"), options);
            chart.render();
        });
    </script>
</body>

</html>
