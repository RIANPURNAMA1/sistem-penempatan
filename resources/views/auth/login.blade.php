<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Kandidat</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 & jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #00bfff, #60efff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 50px 40px;
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s;
        }

        #auth-card:hover {
            transform: translateY(-5px);
        }

        .auth-logo img {
            width: 150px;
            margin-bottom: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px 12px 40px;
            position: relative;
            transition: 0.3s;
        }

        .form-group .bi {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }

        .btn-login {
            background: linear-gradient(90deg, #ffc700, white);
            color: black;
            border-radius: 12px;
            border: none;
            transition: all 0.4s ease;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #ffffff, #00c0ff);
            color: #0061ff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 192, 255, 0.4);
        }
    </style>
</head>

<body>
    <div id="auth-card">
        <div class="auth-logo text-center">
            <img src="{{ asset('assets/compiled/png/LOGO/logo.png') }}" alt="Logo Sistem Kandidat">
        </div>
  @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#ff6b6b',
                confirmButtonText: 'Tutup'
            });
        });
    </script>
@endif


        <h3 class="text-center">Selamat Datang 👋</h3>
        <p class="text-center text-muted mb-4">Silakan masuk menggunakan akun Anda</p>

        <form id="loginForm" method="POST">
            @csrf
            <div class="form-group position-relative mb-3">
                <i class="bi bi-person"></i>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
            </div>

            <div class="form-group position-relative mb-3">
                <i class="bi bi-shield-lock"></i>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"
                    required>
            </div>

            <button type="submit" class="btn btn-warning btn-lg w-100 mt-3 ">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </button>
        </form>

        <div class="text-center mt-4 text-muted">
            <p class="mb-1">Belum punya akun? <a href="/registrasi" class="fw-bold">Daftar</a></p>
            <a href="#" class="fw-bold">Lupa Password?</a>
        </div>
    </div>

    <script>
        < script >
            $(document).ready(function() {
                $('#loginForm').on('submit', function(e) {
                    e.preventDefault();

                    const email = $('input[name="email"]').val().trim();
                    const password = $('input[name="password"]').val().trim();

                    // Validasi client-side
                    if (!email || !password) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Validasi Gagal',
                            text: 'Email dan Password wajib diisi!',
                            confirmButtonColor: '#ffc107'
                        });
                        return;
                    }

                    // Validasi format email
                    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                    if (!emailPattern.test(email)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format Email Salah',
                            text: 'Pastikan email yang Anda masukkan valid.',
                            confirmButtonColor: '#ff6b6b'
                        });
                        return;
                    }

                    // Kirim ke server
                    $.ajax({
                        url: "{{ route('login.post') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Berhasil!',
                                    text: 'Anda akan diarahkan ke dashboard...',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 1500);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Gagal',
                                    text: response.message || 'Email atau password salah!',
                                    confirmButtonColor: '#ff6b6b'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: 'Periksa koneksi Anda atau hubungi admin.',
                                confirmButtonColor: '#ff6b6b'
                            });
                        }
                    });
                });
            });
    </script>

    </script>

</body>

</html>
