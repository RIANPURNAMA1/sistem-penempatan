<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Penempatan Kandidat</title>

    <link rel="icon" href="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" type="image/png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.4/css/dataTables.datsaTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">

    <!-- Vite Compiled CSS -->
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Init Theme -->
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div id="app" class="min-h-screen bg-gray-50">
        
        {{-- Sidebar --}}
        @include('components.sidebar')
        
        {{-- Main Content Area --}}
        <div id="main" class="lg:ml-64 min-h-screen">
            
            {{-- Mobile Header --}}
            @include('components.Headers')
            
            {{-- Desktop Header Bar --}}
            <div class="hidden lg:flex items-center justify-end py-3 px-6  border-b border-gray-300 rounded-lg">
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600 font-medium">Welcome {{ auth()->user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            {{-- Page Content --}}
            <div class="p-4 md:p-6 lg:p-8">
                @yield('content')
            </div>

            {{-- Footer --}}
            <footer class="mt-auto">
                <div class="px-4 md:px-6 lg:px-8 py-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-500 font-medium">&copy; {{ date('Y') }} Sistem Penempatan Kandidat. All Rights Reserved.</p>
                        <p class="text-xs text-gray-400 mt-1">
                            Crafted with <span class="text-red-500"><i class="bi bi-heart-fill"></i></span> 
                            by <a href="https://riidev.my.id" class="text-indigo-600 hover:underline font-medium">Mendunia.id</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Mobile Menu for Kandidat --}}
    @if (auth()->check() && auth()->user()->role === 'kandidat')
        @include('components.mobile_menu')
    @endif

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>

    {{-- Datatables --}}
    <script src="//cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <!-- jQuery & SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Vite Compiled JS -->
    @vite(['resources/js/app.js'])
</body>

</html>
