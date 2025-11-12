<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Kandidat</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

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

        h3 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        p.text-muted {
            font-size: 0.9rem;
            color: #6c757d;
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
            /* sedikit naik saat hover */
            box-shadow: 0 5px 15px rgba(0, 192, 255, 0.4);
            /* glow lembut */
        }

        .text-muted a {
            color: #0061ff;
            text-decoration: none;
            transition: 0.3s;
        }

        .text-muted a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="auth-card">
        <div class="auth-logo text-center">
            <img src="{{ asset('assets/compiled/png/LOGO/logo.png') }}" alt="Logo Sistem Kandidat">
        </div>

        <h3 class="text-center">Selamat Datang 👋</h3>
        <p class="text-center text-muted mb-4">Silakan masuk menggunakan akun Anda</p>

        <form action="#" method="POST">
            @csrf

            <div class="form-group position-relative mb-3">
                <i class="bi bi-person"></i>
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username"
                    required>
            </div>

            <div class="form-group position-relative mb-3">
                <i class="bi bi-shield-lock"></i>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"
                    required>
            </div>

            <button type="submit" class="btn btn-warning btn-lg w-100 mt-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </button>
        </form>

        <div class="text-center mt-4 text-muted">
            <p class="mb-1">Belum punya akun? <a href="/pendaftaran" class="fw-bold">Daftar</a></p>
            <a href="#" class="fw-bold">Lupa Password?</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
