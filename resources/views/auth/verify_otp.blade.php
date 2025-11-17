<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - OTP</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center mt-5">
        <div class="card shadow p-4" style="width: 400px; border-radius: 15px;">
            <h4 class="text-center mb-3">Verifikasi Email</h4>
            <p class="text-center">Masukkan kode OTP yang telah dikirim ke email Anda.</p>

            <form id="otpForm">
                <div class="mb-3">
                    <input type="text" maxlength="6" class="form-control" name="otp"
                        placeholder="Masukkan kode OTP" required>
                </div>

                <button class="btn btn-primary w-100">Verifikasi</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            // Siapkan token CSRF untuk AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#otpForm').on('submit', function (e) {
                e.preventDefault();

                let otp = $('input[name="otp"]').val();

                $.ajax({
                    url: "{{ route('verify.otp') }}",
                    method: "POST",
                    data: { otp: otp },
                    success: function (response) {

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = response.redirect;
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message,
                            });
                        }

                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Server',
                            text: 'Terjadi error pada server. Periksa log Laravel.'
                        });
                    }
                });

            });

        });
    </script>

</body>

</html>
