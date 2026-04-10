<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    
    .mobile-header {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.95);
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
        background: #ef4444;
        color: white;
        font-size: 0.65rem;
        padding: 0 5px;
        border-radius: 12px;
    }
</style>

<header class="fixed-top mb-3 lg:hidden mobile-header shadow-md" style="z-index: 9999;">
    <nav class="px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <button type="button" onclick="toggleSidebar(); return false;" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="bi bi-list text-2xl text-gray-700"></i>
                </button>
                
                <a class="flex items-center gap-2 no-underline" href="/">
                    <img src="/assets/compiled/png/LOGO/logo4.png" alt="logo" class="rounded-full" style="width:40px; height:40px; object-fit:cover;">
                    <span class="font-bold text-white lg:hidden" style="color: #1a365d;">Sispenda</span>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <div class="nav-icon-btn">
                    <a href="#" id="notifBtn" class="relative" style="font-size: 1.6rem;">
                        <i class="bi bi-bell-fill text-gray-700"></i>
                        @php
                            $totalNotif = $notifCount ?? 3;
                        @endphp
                        @if ($totalNotif > 0)
                            <span class="notif-badge">{{ $totalNotif }}</span>
                        @endif
                    </a>
                </div>

                @if (auth()->check())
                    <div class="nav-icon-btn dropdown">
                        <a href="#" class="flex items-center" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                                alt="profile" class="rounded-full"
                                style="width:40px; height:40px; object-fit:cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="profileDropdown"
                            style="min-width: 150px;">
                            <li class="px-3 py-2 text-muted small">Hai, {{ auth()->user()->name }}</li>
                            <li><hr class="dropdown-divider"></li>
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
            </div>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#logoutBtn').on('click', function(e) {
            e.preventDefault();
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
        
        $('#notifBtn').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Fitur dalam pengembangan',
                text: 'Notifikasi belum tersedia saat ini.',
                confirmButtonText: 'Oke'
            });
        });
    });
</script>
