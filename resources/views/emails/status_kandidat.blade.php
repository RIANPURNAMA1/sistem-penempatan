<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Kandidat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .header {
            background-color: #0d6efd;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px 25px;
            color: #333333;
            line-height: 1.6;
        }

        .content h2 {
            color: #0d6efd;
            margin-top: 0;
        }

        .status-box {
            background-color: #f1f5fb;
            border-left: 5px solid #0d6efd;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777777;
            background-color: #f4f6f8;
        }

        .button {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <!-- LOGO -->
            <div class="text-center mb-4">
                <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="img-fluid rounded"
                    style="width: 120px;">
            </div>
            <h1>Status Kandidat</h1>
        </div>
        <div class="content">
            <h2>Halo {{ $nama }},</h2>

            <p>Status Anda telah diperbarui pada portal kandidat kami. Berikut detailnya:</p>

            <div class="status-box">
                <p><strong>Status Baru:</strong> {{ $status }}</p>
                <p><strong>Tanggal Update:</strong> {{ $tanggal }}</p>
                @if ($catatan)
                    <p><strong>Catatan Admin:</strong> {{ $catatan }}</p>
                @endif
            </div>

            <p>Silakan klik tombol di bawah untuk login dan melihat detail lebih lanjut:</p>
            <a href="{{ url('/login') }}" class="button">Masuk ke Portal</a>

            <p>Terima kasih atas perhatian Anda.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Sistem Penempatan. Semua hak cipta dilindungi.
        </div>
    </div>
</body>

</html>
