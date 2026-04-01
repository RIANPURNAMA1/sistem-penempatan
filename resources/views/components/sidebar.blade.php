{{-- sidebar --}}
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<div id="sidebar" class="fixed inset-y-0 left-0" style="z-index: 9998;">
    <div id="sidebar-wrapper" class="flex flex-col w-64 h-screen bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 overflow-hidden" style="z-index: 9999;">
        
        {{-- Header with Logo --}}
        <div class="flex items-center gap-3 p-4 border-b border-gray-200">
            {{-- Close button for mobile --}}
            <button onclick="toggleSidebar()" class="lg:hidden w-8 h-8 flex items-center justify-center text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                <i class="bi bi-x-lg"></i>
            </button>
            
            <a href="/" class="flex items-center gap-3">
                <img src="/assets/compiled/png/LOGO/logo4.png" alt="Logo" 
                    class="w-9 h-9 rounded-lg object-cover shadow-sm">
                <span class="text-gray-800 font-semibold text-sm" style="font-family: 'Inter', sans-serif;">Sistem Penempatan</span>
            </a>
        </div>

        {{-- Menu --}}
        <nav class="flex-1 overflow-y-auto py-2">
            <ul class="space-y-0.5 px-3">

                {{-- Section: Menu Utama --}}
                <li class="px-3 py-2 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">
                    Menu Utama
                </li>

                {{-- Dashboard --}}
                <li class="sidebar-item">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (auth()->check())
                    @if (auth()->user()->role === 'kandidat')
                        {{-- Pendaftaran (has-sub) --}}
                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                <span class="flex-1">Pendaftaran</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="submenu-arrow transition-transform duration-150 text-gray-400">
                                    <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                                </svg>
                            </a>
                            <ul class="submenu hidden mt-1 ml-7 space-y-0.5">
                                <li class="submenu-item">
                                    <a href="{{ url('/pendaftaran/kandidat') }}" 
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-all duration-150 text-sm">
                                        Pendaftaran
                                    </a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/pendaftaran/cv/kandidat') }}" 
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-all duration-150 text-sm">
                                        Data Diri CV
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Riwayat Saya --}}
                        <li class="sidebar-item">
                            <a href="{{ route('kandidat.history.proses') }}" 
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/>
                                </svg>
                                <span>Riwayat Saya</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role === 'super-admin')
                        {{-- Kelola Kandidat (has-sub) --}}
                        <li class="sidebar-item has-sub">
                            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                </svg>
                                <span class="flex-1">Kelola Kandidat</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="submenu-arrow transition-transform duration-150 text-gray-400">
                                    <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                                </svg>
                            </a>
                            <ul class="submenu hidden mt-1 ml-7 space-y-0.5">
                                <li class="submenu-item">
                                    <a href="{{ url('/kandidat') }}" style="font-size: 12px;" 
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-all duration-150 text-sm">
                                        Pendaftaran
                                    </a>
                                </li>
                                <li class="submenu-item" >
                                    <a href="{{ url('/kandidat/data') }}" style="font-size: 12px;" 
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-all duration-150 text-sm">
                                        Data Kandidat
                                    </a>
                                </li>
                                <li class="submenu-item" >
                                    <a href="{{ url('/data/cv/kandidat') }}" style="font-size: 12px;" 
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-all duration-150 text-sm">
                                        CV Kandidat
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{--all --}}
                        <li class="sidebar-item">
                            <a href="{{ url('/cabang') }}" 
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                                </svg>
                                <span>Cabang</span>
                            </a>
                        </li>

                        {{-- Perusahaan Penempatan --}}
                        <li class="sidebar-item">
                            <a href="{{ url('/institusi') }}" 
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                                </svg>
                                <span>Perusahaan</span>
                            </a>
                        </li>

                        {{-- Manajemen Admin --}}
                        <li class="sidebar-item">
                            <a href="{{ url('/admin') }}" 
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                                </svg>
                                <span>Manajemen Admin</span>
                            </a>
                        </li>

                        {{-- Manajemen User --}}
                        <li class="sidebar-item">
                            <a href="{{ url('/admin/user') }}" 
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                </svg>
                                <span>Manajemen User</span>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Section: Pengaturan --}}
                <li class="px-3 py-2 mt-4 text-[11px] font-semibold text-gray-500 uppercase tracking-wider border-t border-gray-100">
                    Pengaturan
                </li>

                {{-- Profil --}}
                <li class="sidebar-item">
                    <a href="/profile" 
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <span>Profil</span>
                    </a>
                </li>

                {{-- Hubungi Admin --}}
                <li class="sidebar-item">
                    <a href="https://wa.me/6285808584617" target="_blank" 
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-100 transition-all duration-150 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
                        </svg>
                        <span>Hubungi Admin</span>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="sidebar-item">
                    <a href="#" id="logout-link" 
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-150 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                        </svg>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

    </div>
</div>

{{-- Overlay for mobile --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    
    #sidebar-wrapper a {
        text-decoration: none !important;
    }
    #sidebar-wrapper a:hover {
        text-decoration: none !important;
    }
    
    /* Scrollbar styling */
    ::-webkit-scrollbar {
        width: 4px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 2px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #d1d5db;
    }
    
    /* Active menu item */
    .sidebar-item a.active,
    .sidebar-item a[href="{{ url()->current() }}"] {
        background: #eef2ff !important;
        color: #4f46e5 !important;
    }
    .sidebar-item a.active svg,
    .sidebar-item a[href="{{ url()->current() }}"] svg {
        color: #4f46e5 !important;
    }
    
    /* Submenu animation */
    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
    }
    .submenu.show {
        max-height: 300px;
    }
    .submenu-arrow.rotate {
        transform: rotate(180deg);
    }
</style>

<script>
    function toggleSidebar() {
        console.log('Toggle clicked');
        const sidebar = document.getElementById('sidebar-wrapper');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (!sidebar) {
            console.error('Sidebar not found');
            return;
        }
        
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            if (overlay) {
                overlay.classList.remove('hidden');
            }
        } else {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            if (overlay) {
                overlay.classList.add('hidden');
            }
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle submenu
        document.querySelectorAll('.has-sub > a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;
                const arrow = this.querySelector('.submenu-arrow');
                
                if (submenu && submenu.classList.contains('submenu')) {
                    submenu.classList.toggle('hidden');
                    submenu.classList.toggle('show');
                    if (arrow) arrow.classList.toggle('rotate');
                }
            });
        });
        
        // Active menu highlighting
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar-item a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
        
        // Logout handler
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1a365d',
                cancelButtonColor: '#718096',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    });
</script>
