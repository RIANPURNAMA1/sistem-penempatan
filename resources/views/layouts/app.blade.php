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

<body>
    <div id="app">
        @include('components.sidebar')
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
