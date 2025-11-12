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
    @include('components.sidebar')

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
