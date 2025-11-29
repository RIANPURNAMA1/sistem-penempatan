<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Kandidat</title>
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        /* .login-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            width: 100%;
            max-width: 420px;
            transition: transform 0.3s;
        } */

    

        .login-card img {
            width: 100px;
        }

        .form-control {
            border-radius: 12px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
            border-color: #ffc107;
        }

        .btn-login {
            border-radius: 12px;
            background: linear-gradient(90deg, #ffc107, #ffb000);
            color: #fff;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #ffb000, #ffc107);
        }

        /* --- STYLE BARU UNTUK GOOGLE --- */
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
            border-color: #ffc107;
            color: #4a4a4a;
        }

        .google-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }

        /* ------------------------------- */

        .bottom-links a {
            color: #6c757d;
            text-decoration: none;
            transition: 0.2s;
        }

        .bottom-links a:hover {
            color: #ffc107;
        }
    </style>
</head>
@if (session('google_success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Login Berhasil!',
        text: '{{ session("google_success") }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif


<body class="d-flex justify-content-center align-items-center min-vh-100">

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
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                        required>
                </div>
            </div>

            <button type="submit" id="loginBtn" class="btn btn-login w-100 mt-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </button>
        </form>

        <div class="divider text-muted small">ATAU</div>

        <button id="btnGoogle" type="button"
            class="btn w-100 shadow-sm d-flex justify-content-center align-items-center gap-2"
            style="
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
        ">

            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Login"
                style="width: 20px; height: 20px;">

            <span>Login dengan Google</span>
        </button>



        <div class="text-center mt-4 bottom-links">
            <p class="mb-1">Belum punya akun? <a href="/registrasi">Daftar</a></p>
            <a href="/lupa/password">Lupa Password?</a>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(() => {


            $("#btnGoogle").on("click", function() {
                window.location.href = "/auth/google/redirect";
            });

            // ... (Kode AJAX Login reguler Anda tetap di sini) ...

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
                            title: "Email atau password salah.",
                            text: "Email atau password salah.."
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
