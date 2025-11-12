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
                                <a href="{{ url('/interview') }}" class="submenu-link" style="text-decoration: none;">
                                    Daftar Interview
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ url('/interview/tambah') }}" class="submenu-link"
                                    style="text-decoration: none;">
                                    Tambah Jadwal Interview
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ url('/interview/hasil') }}" class="submenu-link"
                                    style="text-decoration: none;">
                                    Hasil Interview
                                </a>
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
                                    style="text-decoration: none;">
                                    Data Pendaftaran
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ url('/pendaftaran/tambah') }}" class="submenu-link"
                                    style="text-decoration: none;">
                                    Tambah Kandidat
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ url('/pendaftaran/verifikasi') }}" class="submenu-link"
                                    style="text-decoration: none;">
                                    Verifikasi Kandidat
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ url('/pendaftaran/valid') }}" class="submenu-link"
                                    style="text-decoration: none;">
                                    Kandidat Valid
                                </a>
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
                                    style="text-decoration: none;">Laporan
                                    Penempatan</a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ url('/laporan/export') }}" class="submenu-link"
                                    style="text-decoration: none;">Export PDF/Excel</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-title">Pengaturan</li>

                    <li class="sidebar-item">
                        <a href="{{ url('/profil') }}" class='sidebar-link' style="text-decoration: none;">
                            <i class="bi bi-person-circle"></i>
                            <span>Profil</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ url('/logout') }}" class='sidebar-link ' style="text-decoration: none;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </div>
    {{-- sidebar --}}
