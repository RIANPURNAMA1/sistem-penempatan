        {{-- sidebar --}}
        <div id="sidebar" class="card" style="z-index: 1050 !important;">

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
                                {{-- <li class="sidebar-item">
                                    <a href="{{ route('kandidat.riwayat', $kandidat->id) }}"
                                        class="sidebar-link d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-clock-history"></i> <span class="fw-semibold">Riwayat</span>
                                    </a>
                                </li> --}}
                            @endif

                            {{-- Menu untuk super admin --}}
                            @if (auth()->user()->role === 'super admin')
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
