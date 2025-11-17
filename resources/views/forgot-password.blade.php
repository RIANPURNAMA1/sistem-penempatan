<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Kandidat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

<div class="card shadow-lg p-4 p-md-5" style="max-width: 420px; width: 100%; border-radius: 20px;">
    <div class="text-center mb-4">
        <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="img-fluid rounded" style="width: 120px;">
    </div>

    <h3 class="text-center fw-bold">Ubah Password 🔒</h3>
    <p class="text-center text-muted mb-4">Masukkan email dan password baru Anda</p>

    <form id="forgotPasswordForm" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Password Baru</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
            </div>
        </div>

        <button type="submit" id="resetBtn" class="btn btn-warning w-100 mt-3 fw-bold">
            <i class="bi bi-box-arrow-in-right me-1"></i> Ubah Password
        </button>
    </form>

    <div class="text-center mt-4 text-muted">
        <p class="mb-0">Ingat password? 
            <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk</a>
        </p>
    </div>
</div>

<script>
$(document).ready(() => {

    $("#forgotPasswordForm").on("submit", function(e) {
        e.preventDefault();

        const $btn = $("#resetBtn");
        $btn.prop("disabled", true);
        const originalHtml = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Memproses...');

        $.ajax({
            url: "{{ route('password.update') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $btn.prop("disabled", false);
                $btn.html(originalHtml);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message
                }).then(() => {
                    window.location.href = response.redirect;
                });
            },
            error: function(xhr) {
                $btn.prop("disabled", false);
                $btn.html(originalHtml);

                let msg = 'Terjadi kesalahan, silakan coba lagi.';
                if(xhr.responseJSON && xhr.responseJSON.errors){
                    msg = Object.values(xhr.responseJSON.errors).join('\n');
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: msg
                });
            }
        });
    });

});
</script>
</body>
</html>
