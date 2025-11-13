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
                <div class="d-flex justify-content-end align-items-center" style="padding-right: 8px;">

                    <!-- LOGO -->
                    <div class="">
                        <a href="index.html">
                            <img src="/assets/compiled/png/LOGO/logo.png" alt="Logo"
                                style="width: 150px; height:auto;">
                        </a>
                    </div>
                    <!-- THEME TOGGLE -->
                    <div class="theme-toggle d-flex gap-1 align-items-center">

                        <!-- ICON SUN -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 21 21">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.5 14.5c2.2 0 4-1.8 4-4s-1.8-4-4-4s-4 1.8 4 4z"></path>
                                <path d="M4.14 4.14L5.55 5.55"></path>
                                <path d="M15.45 15.45l1.41 1.41"></path>
                                <path d="M1.5 10.5h2M17.5 10.5h2M10.5 1.5v2M10.5 17.5v2"></path>
                            </g>
                        </svg>

                        <div class="form-check form-switch fs-6" style="margin: 0;">
                            <input class="form-check-input me-0" type="checkbox" id="toggle-dark"
                                style="cursor:pointer;">
                        </div>

                        <!-- ICON MOON -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m17.75 4.09-2.53 1.94 0.91 3.06-2.63-1.81-2.63 1.81 0.91-3.06-2.53-1.94L12.44 4l1.06-3 1.06 3 3.19.09zM21.25 11l-1.64 1.25 0.59 1.98-1.7-1.17-1.7 1.17 0.59-1.98L15.75 11 17.81 11 18.5 9l0.69 1.95 2.06.05zM19.5 16.96c0.83-.08 1.72 1.1 1.19 1.85-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14.4-.4.82-.76 1.27-1.08.75-.53 1.93.36 1.85 1.19-.27 2.86.69 5.83 2.89 8.02 3.52 3.51 8.02 2.89 8.02 2.89z">
                            </path>
                        </svg>
                    </div>

                    <!-- SIDEBAR TOGGLER -->
                    <div class="sidebar-toggler x ms-1">
                        <a href="#" class="sidebar-hide d-xl-none d-block">
                            <i class="bi bi-x bi-middle"></i>
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

                    {{-- Menu untuk kandidat --}}
                    @if (auth()->user()->role === 'kandidat')
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
                    @if (auth()->user()->role === 'admin cianjur' || auth()->user()->role === 'admin cianjur selatan')
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
                    @if (auth()->user()->role === 'super admin')
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Kelola Kandidat</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/kandidat') }}" class="submenu-link"
                                        style="text-decoration: none;">Data Kandidat</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/siswa/import') }}" class="submenu-link"
                                        style="text-decoration: none;">Import Excel</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-building"></i>
                                <span>Institusi</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/institusi') }}" class="submenu-link"
                                        style="text-decoration: none;">Data Institusi</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/institusi/tambah') }}" class="submenu-link"
                                        style="text-decoration: none;">Tambah Institusi</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/institusi/import') }}" class="submenu-link"
                                        style="text-decoration: none;">Import Excel</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Interview</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/interview') }}" class="submenu-link"
                                        style="text-decoration: none;">Daftar Interview</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/interview/tambah') }}" class="submenu-link"
                                        style="text-decoration: none;">Tambah Jadwal Interview</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/interview/hasil') }}" class="submenu-link"
                                        style="text-decoration: none;">Hasil Interview</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-building-check"></i>
                                <span>Penempatan</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/penempatan') }}" class="submenu-link"
                                        style="text-decoration: none;">Data Penempatan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/penempatan/tambah') }}" class="submenu-link"
                                        style="text-decoration: none;">Tambah Penempatan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/penempatan/monitoring') }}" class="submenu-link"
                                        style="text-decoration: none;">Monitoring</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-vcard"></i>
                                <span>Pendaftaran Kandidat</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/pendaftaran/kandidat') }}" class="submenu-link"
                                        style="text-decoration: none;">Data Pendaftaran</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/pendaftaran/tambah') }}" class="submenu-link"
                                        style="text-decoration: none;">Tambah Kandidat</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/pendaftaran/verifikasi') }}" class="submenu-link"
                                        style="text-decoration: none;">Verifikasi Kandidat</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/pendaftaran/valid') }}" class="submenu-link"
                                        style="text-decoration: none;">Kandidat Valid</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-lock"></i>
                                <span>Hak Akses</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/admin') }}" class="submenu-link"
                                        style="text-decoration: none;">Daftar Admin</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/admin/user') }}" class="submenu-link"
                                        style="text-decoration: none;">Daftar Akun Kandidat</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/admin/tambah') }}" class="submenu-link"
                                        style="text-decoration: none;">Tambah Admin</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/admin/role') }}" class="submenu-link"
                                        style="text-decoration: none;">Manajemen Role</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/laporan/siswa') }}" class="submenu-link"
                                        style="text-decoration: none;">Laporan Kandidat</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/laporan/penempatan') }}" class="submenu-link"
                                        style="text-decoration: none;">Laporan Penempatan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/laporan/export') }}" class="submenu-link"
                                        style="text-decoration: none;">Export PDF/Excel</a>
                                </li>
                            </ul>
                        </li>
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
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
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
