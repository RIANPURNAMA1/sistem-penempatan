<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lupa Password</title>

    <link rel="icon" href="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background: linear-gradient(135deg, #f0f4ff, #ffffff);
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
               
                padding: 40px 30px;
                max-width: 420px;
                width: 100%;
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
            .logo-img {
                width: 80px !important;
            }

            /* Perkecil heading */
            h4 {
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
            border-radius: 12px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(39, 48, 68, 0.15);
            border-color: #273044;
        }

        .btn-reset {
            background-color: #273044;
            color: white;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-reset:hover {
            background-color: #1a1f2e;
            color: white;
        }

        .back-link {
            color: #6c757d;
            text-decoration: none;
            transition: 0.2s;
            font-size: 14px;
        }

        .back-link:hover {
            color: #273044;
        }
    </style>
</head>

<body>
    
    <div class="form-container">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="img-fluid rounded logo-img"
                style="width: 120px;">
        </div>

        <h4 class="text-center fw-bold mb-2">Lupa Password? 🔑</h4>
        <p class="text-center text-muted mb-4">Masukkan email dan password baru Anda</p>

        <form id="forgot-password-form">
            @csrf
            
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

            <!-- Password Baru -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password baru" required>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" required>
                </div>
            </div>

            <button type="submit" id="btnReset" class="btn btn-reset w-100">
                <span id="btnText">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset Password
                </span>
                <span id="btnLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span> Memproses...
                </span>
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="/login" class="back-link fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
            </a>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // Prevent zoom on input focus (iOS Safari)
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('focus', () => {
                    document.body.style.zoom = 1;
                });
            });

            $('#forgot-password-form').on('submit', function(e) {
                e.preventDefault();

                // Aktifkan loading
                $('#btnText').addClass('d-none');
                $('#btnLoading').removeClass('d-none');
                $('#btnReset').attr('disabled', true);

                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('reset.submit') }}',
                    type: 'POST',
                    data: formData,
                    
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Password berhasil direset.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '/login';
                        });
                    },
                    
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorMessage = '';

                        if (errors) {
                            $.each(errors, function(key, val) {
                                errorMessage += '• ' + val[0] + '<br>';
                            });
                        } else {
                            errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan, coba lagi.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: errorMessage
                        });

                        // Reset button
                        $('#btnText').removeClass('d-none');
                        $('#btnLoading').addClass('d-none');
                        $('#btnReset').attr('disabled', false);
                    }
                });
            });
        });
    </script>

</body>

</html>