<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Sistem Kandidat</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

    <div class="card shadow-lg p-4 p-md-5" style="max-width: 450px; width: 100%; border-radius: 20px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="img-fluid rounded"
                style="width: 120px;">
        </div>

        <h3 class="text-center fw-bold mb-2">Buat Akun Baru</h3>
        <p class="text-center text-muted mb-4">Isi data berikut untuk mendaftar</p>

        <form id="registerForm">
            @csrf

            <div class="mb-3 position-relative">
                <i class="bi bi-person position-absolute top-50 translate-middle-y ms-3 text-secondary"></i>
                <input type="text" name="name" class="form-control ps-5 py-2 rounded-pill"
                    placeholder="Nama Lengkap" required>
            </div>

            <div class="mb-3 position-relative">
                <i class="bi bi-envelope position-absolute top-50 translate-middle-y ms-3 text-secondary"></i>
                <input type="email" name="email" class="form-control ps-5 py-2 rounded-pill" placeholder="Email"
                    required>
            </div>

            <div class="mb-3 position-relative">
                <i class="bi bi-shield-lock position-absolute top-50 translate-middle-y ms-3 text-secondary"></i>
                <input type="password" name="password" class="form-control ps-5 py-2 rounded-pill"
                    placeholder="Password" required>
            </div>

            <div class="mb-3 position-relative">
                <i class="bi bi-shield-lock-fill position-absolute top-50 translate-middle-y ms-3 text-secondary"></i>
                <input type="password" name="password_confirmation" class="form-control ps-5 py-2 rounded-pill"
                    placeholder="Konfirmasi Password" required>
            </div>

            <button id="btnRegister" type="submit" class="btn btn-warning w-100 py-2 rounded-pill fw-bold">
                <span id="btnText"><i class="bi bi-person-plus me-2"></i>Daftar</span>
                <span id="btnLoading" class="d-none">
                    <span class="spinner-border spinner-border-sm me-2"></span>Memproses...
                </span>
            </button>
        </form>

        <div class="text-center mt-3">
            <p class="text-muted mb-0">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk</a>
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
