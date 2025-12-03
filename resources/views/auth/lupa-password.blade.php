<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">

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
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container mt-5" style="max-width: 500px;">
        <div class=" p-4 p-md-5" style="max-width: 420px; width: 100%; border-radius: 20px;">

            <h4 class="mb-4 text-center">Lupa Password</h4>

            <form id="forgot-password-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-warning w-100">Reset Password</button>
            </form>

            <div class="text-center mt-3">
                <a href="/login" class="text-decoration-none">Kembali ke Login</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#forgot-password-form').on('submit', function(e) {
                e.preventDefault(); // hentikan submit default

                let formData = $(this).serialize(); // ambil semua data form

                $.ajax({
                    url: '{{ route('reset.submit') }}', // route lupa password
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Password berhasil direset.',
                            confirmButtonColor: '#ffc107'
                        }).then(() => {
                            window.location.href = '/login'; // redirect ke login
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        if (errors) {
                            $.each(errors, function(key, val) {
                                errorMessage += val[0] + '\n';
                            });
                        } else {
                            errorMessage = 'Terjadi kesalahan, coba lagi.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage,
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
