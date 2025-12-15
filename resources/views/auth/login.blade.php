<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login Sistem Kandidat</title>
    <link rel="icon" href="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff, #ffffff);
            font-family: 'Poppins', sans-serif !important;
            overflow-x: hidden;
        }

        /* Desktop: pakai min-vh-100 dan center */
        @media (min-width: 768px) {
            body {
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .login-card {
 
                padding: 40px 30px;
                width: 100%;
                max-width: 420px;
            }
        }

        /* Mobile: fit to screen tanpa scroll */
        @media (max-width: 767px) {
            body {
                height: 100vh;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px;
            }

            .login-card {
                width: 100%;
                max-width: 100%;
                height: 100vh;
                overflow-y: auto;
                overflow-x: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 15px 10px;
                background-color: transparent;
                box-shadow: none;
            }

            /* Perbesar input di mobile */
            .form-control {
                font-size: 16px !important;
                padding: 12px 14px !important;
                height: auto !important;
            }

            .input-group-text {
                font-size: 18px !important;
                padding: 12px 14px !important;
            }

            /* Perbesar label */
            .form-label {
                font-size: 14px !important;
                margin-bottom: 8px !important;
            }

            /* Perbesar button */
            .btn {
                font-size: 16px !important;
                padding: 14px !important;
            }

            /* Perkecil logo di mobile */
            .login-card img {
                width: 80px !important;
            }

            /* Perkecil heading */
            h3 {
                font-size: 22px !important;
            }

            /* Kurangi spacing */
            .mb-3 {
                margin-bottom: 0.8rem !important;
            }

            .mb-4 {
                margin-bottom: 1rem !important;
            }

            .mt-3 {
                margin-top: 1rem !important;
            }

            .mt-4 {
                margin-top: 1rem !important;
            }
        }

        /* Smooth scroll untuk mobile */
        .login-card {
            -webkit-overflow-scrolling: touch;
        }

        .login-card img {
            width: 100px;
        }

        .form-control {
            border-radius: 12px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(39, 48, 68, 0.15);
            border-color: #273044;
        }

        .btn-login {
            border-radius: 12px;
            background-color: #273044;
            color: #fff;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #1a1f2e;
            color: #fff;
        }

        /* Shadow untuk input */
        .input-group {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
        }

        .input-group-text {
            border: none;
            background-color: #f8f9fa;
        }

        .form-control {
            border: none;
            border-left: 1px solid #e0e0e0;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .divider:not(:empty)::before {
            margin-right: .5em;
        }

        .divider:not(:empty)::after {
            margin-left: .5em;
        }

        /* Google Button */
        .btn-google {
            border-radius: 12px;
            background-color: #ffffff;
            color: #4a4a4a;
            font-weight: 500;
            border: 1px solid #ced4da;
            transition: 0.3s;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #273044;
            color: #4a4a4a;
        }

        .google-icon {
            width: 20px;
            height: 20px;
        }

        /* Bottom Links */
        .bottom-links a {
            color: #6c757d;
            text-decoration: none;
            transition: 0.2s;
            font-size: 14px;
        }

        .bottom-links a:hover {
            color: #273044;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="text-center mb-4">
            <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="img-fluid rounded">
        </div>

        @if ($errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    Swal.fire({
                        icon: "error",
                        title: "Validasi Gagal!",
                        html: `<ul style="text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>`
                    });
                });
            </script>
        @endif

        <h3 class="text-center fw-bold mb-2">Selamat Datang 👋</h3>
        <p class="text-center text-muted mb-4">Masuk dengan akun Anda untuk melanjutkan</p>

        <form id="loginForm" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                        required>
                </div>
            </div>

            <button type="submit" id="loginBtn" class="btn btn-login w-100 mt-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </button>
        </form>

        <div class="divider text-muted small">ATAU</div>

        <button id="btnGoogle" type="button" class="btn btn-google w-100 shadow-sm d-flex justify-content-center align-items-center gap-2">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Login" class="google-icon">
            <span>Login dengan Google</span>
        </button>

        <div class="text-center mt-4 bottom-links">
            <p class="mb-1">Belum punya akun? <a href="/registrasi" class="fw-semibold">Daftar</a></p>
            <a href="/lupa/password" class="fw-semibold">Lupa Password?</a>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(() => {

            // Prevent zoom on input focus (iOS Safari)
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('focus', () => {
                    document.body.style.zoom = 1;
                });
            });

            $("#btnGoogle").on("click", function() {
                window.location.href = "/auth/google/redirect";
            });

            $("#loginForm").on("submit", function(e) {
                e.preventDefault();

                const $btn = $("#loginBtn");
                $btn.prop("disabled", true);
                const originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memproses...'
                );

                $.ajax({
                    url: "{{ route('login.post') }}",
                    type: "POST",
                    data: $(this).serialize(),

                    success: function(response) {
                        $btn.prop("disabled", false);
                        $btn.html(originalHtml);

                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Login Berhasil!",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(() => window.location.href = response.redirect, 1500);

                        } else if (response.code === 'ACCOUNT_NOT_FOUND') {
                            Swal.fire({
                                icon: "warning",
                                title: "Akun Tidak Ditemukan",
                                text: "Email yang kamu masukkan belum terdaftar."
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Login Gagal!",
                                text: response.message ?? "Email atau password salah."
                            });
                        }
                    },

                    error: function() {
                        $btn.prop("disabled", false);
                        $btn.html(originalHtml);

                        Swal.fire({
                            icon: "error",
                            title: "Login Gagal",
                            text: "Email atau password salah."
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>