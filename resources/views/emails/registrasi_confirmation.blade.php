<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Akun</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #e6e6e6;
            padding-bottom: 20px;
        }

        .header h2 {
            color: #333333;
            font-size: 22px;
            font-weight: bold;
            margin: 0;
        }

        .content {
            margin-top: 25px;
            font-size: 15px;
            color: #555555;
            line-height: 1.7;
        }

        .btn-verify {
            display: inline-block;
            margin-top: 20px;
            padding: 14px 28px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: white !important;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
        }

        .btn-verify:hover {
            opacity: 0.9;
        }

        .footer {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid #e6e6e6;
            text-align: center;
            font-size: 13px;
            color: #888888;
        }

        .link {
            color: #4facfe;
            word-break: break-all;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <div class="header">
            <h2>Aktivasi Akun Anda</h2>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $user->name }}</strong>,</p>

            <p>Terima kasih telah mendaftar pada sistem kami. Untuk mulai menggunakan akun Anda, silakan melakukan verifikasi terlebih dahulu.</p>

            <a href="{{ $verificationUrl }}" class="btn-verify">
                Verifikasi Akun
            </a>

            <p style="margin-top: 25px;">
                Jika tombol tidak berfungsi, salin dan tempelkan link berikut ke browser Anda:
            </p>

            <p class="link">{{ $verificationUrl }}</p>
        </div>

        <div class="footer">
            Email ini dikirim otomatis. Mohon untuk tidak membalas email ini.
        </div>

    </div>
</body>
</html>
