<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Penempatan</title>



    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">



    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/style.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
</head>

<style>

</style>

<script src="assets/static/js/initTheme.js"></script>

<body>
    <div id="app">
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
                            <a href="{{ url('/dashboard') }}" class='sidebar-link rounded-full'>
                                <i class="bi bi-grid-fill text-dark"></i>
                                <span class="text-active-side">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Kelola Siswa</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/siswa') }}" class="submenu-link">Data Siswa</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/siswa/tambah') }}" class="submenu-link">Tambah Siswa</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/siswa/import') }}" class="submenu-link">Import Excel</a>
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
                                    <a href="{{ url('/penempatan') }}" class="submenu-link">Data Penempatan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/penempatan/tambah') }}" class="submenu-link">Tambah Penempatan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/penempatan/monitoring') }}" class="submenu-link">Monitoring</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-lock"></i>
                                <span>Hak Akses Admin</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('/admin') }}" class="submenu-link">Daftar Admin</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/admin/tambah') }}" class="submenu-link">Tambah Admin</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/admin/role') }}" class="submenu-link">Manajemen Role</a>
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
                                    <a href="{{ url('/laporan/siswa') }}" class="submenu-link">Laporan Siswa</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/laporan/penempatan') }}" class="submenu-link">Laporan
                                        Penempatan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/laporan/export') }}" class="submenu-link">Export PDF/Excel</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Pengaturan</li>

                        <li class="sidebar-item">
                            <a href="{{ url('/profil') }}" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Profil</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ url('/logout') }}" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Profile Views</h6>
                                                <h6 class="font-extrabold mb-0">112.000</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Followers</h6>
                                                <h6 class="font-extrabold mb-0">183.000</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Following</h6>
                                                <h6 class="font-extrabold mb-0">80.000</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Saved Post</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Profile Visit</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            {{-- timeline --}}
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Timeline Proses Penempatan</h4>
                                </div>

                                <div class="card-body">

                                    <!-- VERIFIKASI DATA -->
                                    <div class="row mb-4">
                                        <div class="col-2 text-center">
                                            <svg class="bi text-info" width="24" height="24"
                                                fill="currentColor">
                                                <use
                                                    xlink:href="assets/static/images/bootstrap-icons.svg#check-circle-fill" />
                                            </svg>
                                            <div class="vr h-100 mx-auto"></div>
                                        </div>
                                        <div class="col-10">
                                            <h6 class="mb-1">Verifikasi Dokumen</h6>
                                            <p class="text-muted small mb-0">Tanggal: 2025-01-12</p>
                                            <span class="badge bg-info">VERIFIKASI_DATA</span>
                                        </div>
                                    </div>

                                    <!-- MENUNGGU JOB MATCHING -->
                                    <div class="row mb-4">
                                        <div class="col-2 text-center">
                                            <svg class="bi text-warning" width="24" height="24"
                                                fill="currentColor">
                                                <use
                                                    xlink:href="assets/static/images/bootstrap-icons.svg#hourglass-split" />
                                            </svg>
                                            <div class="vr h-100 mx-auto"></div>
                                        </div>
                                        <div class="col-10">
                                            <h6 class="mb-1">Menunggu Job Matching</h6>
                                            <p class="text-muted small mb-0">Tanggal: 2025-01-15</p>
                                            <span class="badge bg-warning text-dark">MENUNGGU_JOB_MATCHING</span>
                                        </div>
                                    </div>

                                    <!-- INTERVIEW -->
                                    <div class="row mb-4">
                                        <div class="col-2 text-center">
                                            <svg class="bi text-primary" width="24" height="24"
                                                fill="currentColor">
                                                <use
                                                    xlink:href="assets/static/images/bootstrap-icons.svg#person-video3" />
                                            </svg>
                                            <div class="vr h-100 mx-auto"></div>
                                        </div>
                                        <div class="col-10">
                                            <h6 class="mb-1">Interview</h6>
                                            <p class="text-muted small mb-0">Tanggal: 2025-01-18</p>
                                            <span class="badge bg-primary">INTERVIEW</span>
                                        </div>
                                    </div>

                                    <!-- SUDAH BERANGKAT -->
                                    <div class="row mb-4">
                                        <div class="col-2 text-center">
                                            <svg class="bi text-success" width="24" height="24"
                                                fill="currentColor">
                                                <use
                                                    xlink:href="assets/static/images/bootstrap-icons.svg#check2-circle" />
                                            </svg>
                                            <div class="vr h-100 mx-auto"></div>
                                        </div>
                                        <div class="col-10">
                                            <h6 class="mb-1">Sudah Berangkat</h6>
                                            <p class="text-muted small mb-0">Tanggal: 2025-01-25</p>
                                            <span class="badge bg-success">SUDAH_BERANGKAT</span>
                                        </div>
                                    </div>

                                    <!-- SELESAI -->
                                    <div class="row mb-4">
                                        <div class="col-2 text-center">
                                            <svg class="bi text-success" width="24" height="24"
                                                fill="currentColor">
                                                <use xlink:href="assets/static/images/bootstrap-icons.svg#award" />
                                            </svg>
                                        </div>
                                        <div class="col-10">
                                            <h6 class="mb-1">Selesai</h6>
                                            <p class="text-muted small mb-0">Tanggal: 2025-02-20</p>
                                            <span class="badge bg-success">SELESAI</span>
                                        </div>
                                    </div>

                                    <!-- DITOLAK (Conditional) -->
                                    <!-- tampilkan hanya jika status == ditolak -->
                                    <div class="row">
                                        <div class="col-2 text-center">
                                            <svg class="bi text-danger" width="24" height="24"
                                                fill="currentColor">
                                                <use
                                                    xlink:href="assets/static/images/bootstrap-icons.svg#x-circle-fill" />
                                            </svg>
                                        </div>
                                        <div class="col-10">
                                            <h6 class="mb-1">Ditolak</h6>
                                            <p class="text-muted small mb-0">Tanggal: 2025-01-19</p>
                                            <span class="badge bg-danger">DITOLAK</span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            {{--  --}}
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
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="./assets/compiled/jpg/1.jpg" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">John Duck</h5>
                                        <h6 class="text-muted mb-0">@johnducky</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Messages</h4>
                            </div>
                            <div class="card-content pb-4">
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="./assets/compiled/jpg/4.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Hank Schrader</h5>
                                        <h6 class="text-muted mb-0">@johnducky</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="./assets/compiled/jpg/5.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Dean Winchester</h5>
                                        <h6 class="text-muted mb-0">@imdean</h6>
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="./assets/compiled/jpg/1.jpg">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">John Dodol</h5>
                                        <h6 class="text-muted mb-0">@dodoljohn</h6>
                                    </div>
                                </div>
                                <div class="px-4">
                                    <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Start
                                        Conversation</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Visitors Profile</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            {{-- table  --}}
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Cabang</th>
                        <th>Status Penempatan</th>
                        <th>Tanggal Daftar</th>
                        <th>Status Interview</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Andi Pratama</td>
                        <td>Cabang Bandung</td>
                        <td>
                            <span class="badge bg-warning">MENUNGGU JOB MATCHING</span>
                        </td>
                        <td>2025-01-12</td>
                        <td>
                            <span class="badge bg-secondary">PENDING</span>
                        </td>
                    </tr>

                    <tr>
                        <td>Sri Wahyuni</td>
                        <td>Cabang Cirebon</td>
                        <td>
                            <span class="badge bg-info">INTERVIEW</span>
                        </td>
                        <td>2025-01-08</td>
                        <td>
                            <span class="badge bg-primary">TERJADWAL</span>
                        </td>
                    </tr>

                    <tr>
                        <td>Rizki Handoko</td>
                        <td>Cabang Jakarta</td>
                        <td>
                            <span class="badge bg-success">SELESAI</span>
                        </td>
                        <td>2025-01-02</td>
                        <td>
                            <span class="badge bg-success">LULUS</span>
                        </td>
                    </tr>

                    <tr>
                        <td>Nuraini Putri</td>
                        <td>Cabang Bogor</td>
                        <td>
                            <span class="badge bg-danger">DITOLAK</span>
                        </td>
                        <td>2025-01-05</td>
                        <td>
                            <span class="badge bg-danger">TIDAK LULUS</span>
                        </td>
                    </tr>

                    <tr>
                        <td>Fadli Akbar</td>
                        <td>Cabang Karawang</td>
                        <td>
                            <span class="badge bg-secondary">PENDING</span>
                        </td>
                        <td>2025-01-11</td>
                        <td>
                            <span class="badge bg-warning text-dark">ULANG INTERVIEW</span>
                        </td>
                    </tr>

                    <tr>
                        <td>Lia Zahrani</td>
                        <td>Cabang Depok</td>
                        <td>
                            <span class="badge bg-info">VERIFIKASI DATA</span>
                        </td>
                        <td>2025-01-13</td>
                        <td>
                            <span class="badge bg-secondary">PENDING</span>
                        </td>
                    </tr>

                </tbody>
            </table>

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
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>


    <script src="assets/compiled/js/app.js"></script>



    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>

</body>

</html>
