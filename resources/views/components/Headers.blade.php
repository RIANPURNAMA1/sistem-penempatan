<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- SweetAlert2 -->
<link />
<style>
    .mobile-header {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.596);
    }

    .nav-icon-btn {
        position: relative;
        transition: all 0.25s ease-in-out;
    }

    .nav-icon-btn:hover {
        transform: translateY(-3px);
    }

    .notif-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        background: #ff3b30;
        color: rgb(0, 0, 0);
        font-size: 0.65rem;
        padding: 0 5px;
        border-radius: 12px;
    }

    /* =============================== */
    /* DARK MODE (Bootstrap Theme API) */
    /* =============================== */
    :root[data-bs-theme="dark"] .mobile-header {
        background: #01040e;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    :root[data-bs-theme="dark"] .mobile-header .navbar-brand span {
        color: #fff !important;
    }

    :root[data-bs-theme="dark"] .nav-icon-btn i {
        color: #fff !important;
    }

    :root[data-bs-theme="dark"] .notif-badge {
        background: #ff453a;
        color: #000;
    }
    :root[data-bs-theme="dark"] .btn-sidebar {
      
        color: #ffffff !important;
    }
</style>


<header class="fixed-top  mb-3 d-md-none mobile-header shadow-lg dark light " style="z-index: 1040;">
    <nav class="navbar px-3 py-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">


            <div class="d-flex ">
                <div class="d-flex align-items-center gap-2">
                    <a href="#" class="burger-btn d-block d-xl-none btn-sidebar   rounded-md "
                        style="padding:10px 20px ; border-radius:10px; color:rgb(0, 0, 0);">
                        <i class="bi bi-list fs-4"></i>
                    </a>
                    <h5 class="m-0 fw-semibold"></h5>
                </div>
    
                <!-- BRANDING -->
                <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
                    <img src="/assets/compiled/png/LOGO/logo4.png" alt="logo" class="rounded-circle"
                        style="width:40px; height:40px; object-fit:cover;">
    
                    <span class="text-white fw-bold d-none d-md-inline">Sispenda Kandidat</span>
                    <span class="text-dark fw-bold d-md-none">Matching Job</span>
                </a>
            </div>

            <!-- RIGHT ICONS -->
            <div class="d-flex align-items-center gap-3">

                <!-- NOTIFICATION BELL -->
                <div class="nav-icon-btn">
                    <a href="#" id="notifBtn" class="position-relative" style="font-size: 1.6rem;">
                        <i class="bi bi-bell-fill" style="color: #000"></i>
                        @php
                            $totalNotif = $notifCount ?? 3; // ganti sesuai real data
                        @endphp

                        @if ($totalNotif > 0)
                            <span class="notif-badge">{{ $totalNotif }}</span>
                        @endif
                    </a>
                </div>

                <!-- PROFILE -->
                @if (auth()->check())
                    <div class="nav-icon-btn dropdown">
                        <a href="#" class="d-flex align-items-center" id="profileDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                                alt="profile" class="rounded-circle"
                                style="width:40px; height:40px; object-fit:cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown"
                            style="min-width: 150px;">
                            <li class="px-3 py-2 text-muted small">Hai, {{ auth()->user()->name }}</li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" id="logoutBtn">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif

                <!-- SweetAlert2 -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    $(document).ready(function() {
                        $('#logoutBtn').on('click', function(e) {
                            e.preventDefault(); // cegah submit langsung

                            Swal.fire({
                                title: 'Yakin ingin logout?',
                                text: "Anda akan keluar dari akun saat ini.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ya, logout',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#logoutForm').submit();
                                }
                            });
                        });
                    });
                </script>

            </div>
        </div>
    </nav>
</header>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JQuery & SweetAlert Script -->
<script>
    $(document).ready(function() {
        $('#notifBtn').on('click', function(e) {
            e.preventDefault(); // cegah redirect

            Swal.fire({
                icon: 'info',
                title: 'Fitur dalam pengembangan',
                text: 'Notifikasi belum tersedia saat ini.',
                confirmButtonText: 'Oke'
            });
        });
    });
</script>
