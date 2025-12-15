<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Registrasi Sistem Kandidat</title>

    <link rel="icon" href="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
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

            .form-container {
                max-width: 400px;
                width: 100%;
                border-radius: 20px;
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

            .form-container {
                width: 100%;
                max-width: 100%;
                height: 100vh;
                overflow-y: auto;
                overflow-x: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 15px 10px;
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
            .logo-img {
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
        }

        /* Smooth scroll untuk mobile */
        .form-container {
            -webkit-overflow-scrolling: touch;
        }

        /* Shadow untuk input */
        .input-group {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
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

        .form-control:focus {
            box-shadow: none;
            border-color: #273044;
        }
    </style>

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-light">

    <div class="form-container">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="img-fluid rounded logo-img"
                style="width: 120px;">
        </div>
        <h3 class="text-center fw-bold mb-2">Buat Akun Baru</h3>
        <p class="text-center text-muted mb-4">Isi data berikut untuk mendaftar</p>
        
        <form id="registerForm">
            @csrf

            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap"
                        required>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                        required>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Konfirmasi password" required>
                </div>
            </div>

            <!-- Button -->
            <button id="btnRegister" type="submit" class="btn w-100 mt-3 fw-bold"
                style="background-color: #273044; color:white;">
                <span id="btnText"><i class="bi bi-person-plus me-1"></i> Daftar</span>
                <span id="btnLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span> Memproses...
                </span>
            </button>

        </form>

        <div class="text-center mt-3">
            <p class="text-muted mb-0">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: #273044;">Masuk</a>
            </p>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(() => {

            // Prevent zoom on input focus (iOS Safari)
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('focus', () => {
                    document.body.style.zoom = 1;
                });
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                // Aktifkan loading
                $('#btnText').addClass('d-none');
                $('#btnLoading').removeClass('d-none');
                $('#btnRegister').attr('disabled', true);

                $.ajax({
                    url: "{{ route('registrasi.post') }}",
                    method: "POST",
                    data: $(this).serialize(),

                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil!',
                                text: res.message,
                                timer: 2200,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                window.location.href = res.redirect;
                            }, 2200);

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message ?? 'Terjadi kesalahan.'
                            });
                        }

                        resetButton();
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let msg = "";
                            $.each(xhr.responseJSON.errors, function(_, value) {
                                msg += `• ${value}<br>`;
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Validasi Gagal",
                                html: msg
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: 'Hubungi admin jika masalah berlanjut.'
                            });
                        }

                        resetButton();
                    }
                });

                function resetButton() {
                    $('#btnText').removeClass('d-none');
                    $('#btnLoading').addClass('d-none');
                    $('#btnRegister').attr('disabled', false);
                }
            });

        });
    </script>

</body>

</html>