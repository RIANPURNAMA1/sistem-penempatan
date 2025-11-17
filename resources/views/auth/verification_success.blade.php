<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 15px;">
    <div class="text-center">
        <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png"
             width="90" class="mb-3" alt="Success">

        <h3 class="fw-bold text-success">Verifikasi Berhasil!</h3>
        <p class="text-muted">
            Akun Anda telah berhasil diaktifkan. Silakan login untuk melanjutkan.
        </p>

        <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-3">
            Pergi ke Halaman Login
        </a>
    </div>
</div>

</body>
</html>
