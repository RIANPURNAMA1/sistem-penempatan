<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Penempatan Kandidat</title>

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

<body >
    <div id="app">
        {{-- sidebar --}}
        <div id="sidebar" class="card">

            <div class="sidebar-wrapper active shadow shadow-md" style="">
                <div class="sidebar-header position-relative">


                    <!-- BARIS UNTUK TOGGLE & SIDEBAR TOGGLER -->
                    <div class="d-flex justify-content-center align-items-center" style="padding-right: 8px;">

                        <!-- LOGO -->
                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 p-2">

                            <a href="/"
                                class="text-decoration-none d-flex justify-content-center align-items-center">
                                <img src="/assets/compiled/png/LOGO/logo4.png" alt="Logo Mendunia Jepang"
                                    class="img-fluid rounded-circle shadow-sm"
                                    style="width: 90px; height: 90px; object-fit: cover; transition: transform 0.3s;">
                            </a>
                        </div>


                        <!-- THEME TOGGLE -->
                        <div class="theme-toggle d-flex gap-1 align-items-center">

                            <!-- ICON SUN -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 21 21">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="10.5" cy="10.5" r="4"></circle>
                                    <path d="M4.14 4.14L5.55 5.55"></path>
                                    <path d="M15.45 15.45l1.41 1.41"></path>
                                    <path d="M1.5 10.5h2M17.5 10.5h2M10.5 1.5v2M10.5 17.5v2"></path>
                                </g>
                            </svg>

                            <div class="form-check form-switch fs-6 m-0">
                                <input class="form-check-input me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer;">
                            </div>

                            <!-- ICON MOON -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09-2.53 1.94 0.91 3.06-2.63-1.81-2.63 1.81 0.91-3.06-2.53-1.94L12.44 4l1.06-3 1.06 3 3.19.09zM21.25 11l-1.64 1.25 0.59 1.98-1.7-1.17-1.7 1.17 0.59-1.98L15.75 11 17.81 11 18.5 9l0.69 1.95 2.06.05zM19.5 16.96c0.83-.08 1.72 1.1 1.19 1.85-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14.4-.4.82-.76 1.27-1.08.75-.53 1.93.36 1.85 1.19-.27 2.86.69 5.83 2.89 8.02 3.52 3.51 8.02 2.89 8.02 2.89z">
                                </path>
                            </svg>

                        </div>

                    </div>

                    <!-- CSS TAMBAHAN -->
                    <style>
                        /* Hover logo effect */
                        .d-flex a:hover img {
                            transform: scale(1.1);
                        }

                        /* Hover text color */
                        .d-flex a:hover span {
                            color: #007bff;
                        }

                        /* Responsive */
                        @media (max-width: 576px) {
                            .d-flex a span {
                                font-size: 1rem;
                            }

                            .d-flex a img {
                                width: 70px;
                                height: 70px;
                            }
                        }
                    </style>

                    <hr>

                </div>

                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-title">Menu Utama</li>

                        <li class="sidebar-item active-sidebar ">
                            <a href="{{ url('/') }}" class='sidebar-link rounded-full'>
                                <i class="bi bi-grid-fill "></i>
                                <span class="text-dark">Dashboard</span>
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
                                                <i class="bi bi-person-plus me-2"></i> Pendaftaran
                                            </a>
                                        </li>
                                        <li class="submenu-item">
                                            <a href="{{ url('/pendaftaran/cv') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-file-person me-2"></i> Data Diri CV
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            @endif

                            @if (in_array(auth()->user()->role->name, ['admin cianjur', 'admin cianjur selatan']))
                                <li class="sidebar-item has-sub">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-people-fill"></i>
                                        <span>Kelola Kandidat</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item">
                                            <a href="{{ route('admin.kandidat.index', ['cabang' => auth()->user()->cabang_id]) }}"
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
                                        {{-- Data Pendaftar --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/kandidat') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-people me-1"></i> Pendaftaran
                                            </a>
                                        </li>
                                        {{-- Data Kandidat --}}
                                        <li class="submenu-item">
                                            <a href="{{ url('/kandidat/data') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-list-ul me-1"></i> Data Kandidat
                                            </a>
                                        </li>

                                        {{-- Interview Kandidat
                                        <li class="submenu-item">
                                            <a href="{{ url('/interview') }}" class="submenu-link"
                                                style="text-decoration: none;">
                                                <i class="bi bi-chat-left-text me-1"></i>History Interview
                                            </a>
                                        </li> --}}
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/cabang') }}" class="sidebar-link d-flex align-items-center">
                                        <i class="bi bi-building me-2"></i>
                                        <span>Cabang</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/institusi') }}"
                                        class="sidebar-link d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-building"></i>
                                        <span class="fw-semibold">Perusahaan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('/data/cv/kandidat') }}"
                                        class="sidebar-link d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-person-lines-fill"></i>
                                        <span class="fw-semibold">Data CV Kandidat</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="{{ url('/admin') }}"
                                        class="sidebar-link d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-people-fill"></i>
                                        <span class="fw-semibold">Manajemen User</span>
                                    </a>
                                </li>
                            @endif

                        @endif

                        <li class="sidebar-title">Pengaturan</li>

                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link coming-soon"
                                style="text-decoration: none;">
                                <i class="bi bi-person-circle"></i>
                                <span>Profil</span>
                            </a>
                        </li>

                        <li class="sidebar-item mt-2">
                            <a href="https://wa.me/62895391685825" target="_blank" class="sidebar-link"
                                style="text-decoration: none;">
                                <i class="bi bi-headset"></i>
                                <span>Hubungi Admin</span>
                            </a>
                        </li>


                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const links = document.querySelectorAll('.coming-soon');

                                links.forEach(link => {
                                    link.addEventListener('click', function(e) {
                                        e.preventDefault(); // mencegah navigasi
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Coming Soon',
                                            text: 'Fitur ini sedang dalam pengembangan!',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                                });
                            });
                        </script>


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

    <!-- jQuery & SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#logout-link').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin logout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $('#logout-form').attr('action'),
                            type: 'POST',
                            data: $('#logout-form').serialize(),
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Logout',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href =
                                        "{{ route('login') }}";
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Logout',
                                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
