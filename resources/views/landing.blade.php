<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penempatan - Mendunia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 480px;
            width: 100%;
            text-align: center;
        }

        .badge {
            display: inline-block;
            background: #1e3a5f;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        h1 {
            color: #1e3a5f;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        p {
            color: #5a6b7d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .btn-primary {
            display: block;
            background: #1e3a5f;
            color: #ffffff;
            padding: 16px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: background 0.2s ease;
            margin-bottom: 12px;
        }

        .btn-primary:hover {
            background: #152943;
        }

        .link-secondary {
            color: #1e3a5f;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: opacity 0.2s ease;
        }

        .link-secondary:hover {
            opacity: 0.7;
        }

        .footer {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #e8ecf0;
            font-size: 13px;
            color: #9aa5b4;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="badge">Versi Baru</div>

        <h1>Sistem Kami Telah Berpindah</h1>
        <p>Seluruh sistem penempatan kerja Mendunia telah beralih ke versi terbaru. Silakan kunjungi platform baru kami untuk akses yang lebih baik dan mudah.</p>

        <a href="https://job.mendunia.id/" class="btn-primary" target="_blank" rel="noopener noreferrer">
            Buka Platform Baru
        </a>
        <div class="footer">
            &copy; {{ date('Y') }} Mendunia
        </div>
    </div>
</body>
</html>
