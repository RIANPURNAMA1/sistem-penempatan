
<header class="fixed-top mb-3 d-md-none">
    <!-- Catatan: Karena header ini fixed, pastikan konten utama (misalnya, di layouts.app) memiliki padding-top atau margin-top yang cukup (sekitar 70px-80px) agar tidak tertutup oleh navbar ini. -->
    <nav class="navbar navbar-expand-lg  shadow-lg px-3 py-2" style="background-color:#00c0ff;">
        <div class="container-fluid d-flex justify-content-start justify-content-md-between align-items-center">

            <!-- Branding -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white" href="/">
                <img src="/assets/compiled/png/LOGO/logo4.png"
                    alt="logo"
                    class="rounded-circle"
                    style="width:40px; height:40px; object-fit:cover;">
                <!-- Full text for large screens -->
                <span class="d-none d-md-inline">Sispenda Kandidat</span>
                <!-- Abbreviated text for mobile -->
                <span class="d-md-none">SPK</span>
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   href="#" id="profileDropdown"
                   data-bs-toggle="dropdown" aria-expanded="false">

                    {{-- Memastikan auth()->user() tersedia sebelum mengakses propertinya --}}
                    @if (auth()->check())
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                            alt="profile"
                            class="rounded-circle me-2"
                            style="width:40px; height:40px; object-fit:cover;">

                        <span class="fw-semibold text-white">{{ auth()->user()->name }}</span>
                    @else
                         <span class="fw-semibold text-white">Guest</span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                    <li>
                        <a class="dropdown-item py-2" href="{{ url('/profile') }}">
                            <i class="bi bi-person-circle me-2"></i> Profil
                        </a>
                    </li>
                    <li>
                        {{-- Tombol Logout yang akan dipicu oleh jQuery --}}
                        <button class="dropdown-item text-danger py-2" id="logout-btn">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- FORM LOGOUT TERSEMBUNYI -->
    {{-- Form ini diperlukan untuk mengirimkan POST request ke route 'logout' Laravel --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Pastikan Anda memuat jQuery, Bootstrap JS, dan SweetAlert2 sebelum skrip ini, biasanya di file layout utama --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // FUNGSI LOGOUT AJAX UTAMA
        function performLogout(form) {
            // Cek apakah SweetAlert2 tersedia untuk menampilkan loading
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Memproses Logout...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            }

            // Kirimkan request POST menggunakan AJAX (memerlukan jQuery)
            if (typeof jQuery !== 'undefined') {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(), // Mengirimkan token CSRF
                    success: function() {
                        // Jika logout berhasil, tutup SweetAlert dan redirect
                        if (typeof Swal !== 'undefined') {
                            Swal.close();
                        }
                        window.location.href = '/'; // Redirect ke halaman utama
                    },
                    error: function(xhr, status, error) {
                        console.error('Logout failed:', error);
                        // Tampilkan pesan error jika SweetAlert2 tersedia
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Logout Gagal',
                                text: 'Terjadi kesalahan saat logout. Silakan coba lagi.'
                            });
                        }
                        // Tetap lakukan redirect manual sebagai fallback
                        setTimeout(() => {
                             window.location.href = '/';
                        }, 1500);
                    }
                });
            } else {
                // Fallback jika jQuery tidak dimuat: submit form secara langsung
                form[0].submit();
            }
        }

        // TANGANI KLIK TOMBOL LOGOUT
        $('#logout-btn').on('click', function(e) {
            e.preventDefault();
            var form = $('#logout-form');

            // Cek ketersediaan SweetAlert2
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: "Apakah Anda yakin ingin keluar dari akun ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00c0ff',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        performLogout(form);
                    }
                });
            } else {
                // Jika SweetAlert2 tidak dimuat, lakukan logout tanpa konfirmasi (seperti sebelumnya)
                console.warn('SweetAlert2 not loaded. Performing direct logout.');
                performLogout(form);
            }
        });

        // Peringatan untuk memastikan library penting dimuat
        if (typeof jQuery === 'undefined') {
            console.error('ERROR: jQuery belum dimuat. Fungsi Logout AJAX tidak akan berjalan.');
        }
        if (typeof bootstrap === 'undefined' || typeof bootstrap.Dropdown === 'undefined') {
            console.error('ERROR: Bootstrap 5 JS (atau Popper.js) belum dimuat. Dropdown tidak akan berfungsi.');
        }
        if (typeof Swal === 'undefined') {
            console.warn('PERINGATAN: SweetAlert2 belum dimuat. Konfirmasi logout akan menggunakan tindakan default.');
        }
    });
</script>