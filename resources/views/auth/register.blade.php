<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Sistem Kandidat</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #register-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 50px 35px;
            width: 100%;
            max-width: 480px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        #register-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .auth-logo img {
            width: 140px;
            margin-bottom: 30px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 1.8rem;
            color: #333;
        }

        p.text-muted {
            font-size: 0.95rem;
            color: #6c757d;
        }

        .form-group {
            position: relative;
        }

        .form-group .bi {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1.2rem;
        }

        .form-control {
            border-radius: 15px;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.4);
            outline: none;
        }

        .btn-register {
            background: linear-gradient(90deg, #ffc700, #ffea00);
            color: black;
            border-radius: 15px;
            font-weight: 600;
            border: none;
            transition: all 0.4s ease;
        }

        .btn-register:hover {
            background: linear-gradient(90deg, #ffea00, #ffc700);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            transform: translateY(-2px);
        }

        .text-muted a {
            color: #4facfe;
            text-decoration: none;
            transition: 0.3s;
        }

        .text-muted a:hover {
            text-decoration: underline;
        }

        .helper-links {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div id="register-card">
     <div class="auth-logo text-center">
            <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo Sistem Kandidat">
        </div>

        <h3 class="text-center">Buat Akun Baru ✨</h3>
        <p class="text-center text-muted mb-4">Isi data Anda untuk mendaftar</p>

        <form action="{{ route('registrasi.post') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <i class="bi bi-person"></i>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Nama Lengkap"
                    value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email"
                    value="{{ old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <i class="bi bi-shield-lock"></i>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"
                    required>
            </div>

            <div class="form-group mb-3">
                <i class="bi bi-shield-lock-fill"></i>
                <input type="password" name="password_confirmation" class="form-control form-control-lg"
                    placeholder="Konfirmasi Password" required>
            </div>

            <!-- Role otomatis "kandidat" -->
            <input type="hidden" name="role" value="kandidat">

            <button type="submit" class="btn btn-register btn-lg w-100 mt-3">
                <i class="bi bi-person-plus me-2"></i> Daftar
            </button>
        </form>

        <div class="text-center mt-4 text-muted helper-links">
            <p class="mb-1">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold">Masuk</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert untuk sukses --}}
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // redirect setelah klik OK
                window.location.href = "{{ route('login') }}";
            }
        });
    @endif

    @if ($errors->any())
        let errors = '';
        @foreach ($errors->all() as $error)
            errors += `- {{ $error }}\n`;
        @endforeach

        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            html: errors.replace(/\n/g, '<br>'),
            confirmButtonColor: '#d33',
            confirmButtonText: 'Tutup'
        });
    @endif
});
</script>

</body>

</html>
