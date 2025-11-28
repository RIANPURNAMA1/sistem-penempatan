<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembaruan Status Kandidat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef1f5;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 620px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .header {
            background: linear-gradient(135deg, #ffffff, #ffffff);
            color: #000000;
            padding: 35px 20px;
            text-align: center;
        }

        .header img {
            max-width: 130px;
            margin-bottom: 12px;
        }

        .content {
            padding: 35px 30px;
            color: #333333;
            line-height: 1.7;
        }

        .content h2 {
            color: #0d6efd;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .content p {
            font-size: 15px;
        }

        .status-box {
            background-color: #f7f9fc;
            border-left: 5px solid #0d6efd;
            padding: 18px 20px;
            margin: 22px 0;
            border-radius: 6px;
        }

        .status-box p {
            margin: 6px 0;
            font-size: 15px;
        }

        .button {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 24px;
            font-size: 15px;
            border-radius: 6px;
            margin-top: 20px;
            font-weight: 500;
        }

        .footer {
            text-align: center;
            padding: 22px;
            font-size: 12px;
            color: #777777;
            background-color: #f6f7f9;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
 <div class="email-container">
    <div class="header">
        <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo">
        <h1 style="margin: 0; font-size: 26px; font-weight: 600;">Pembaruan Status Kandidat</h1>
    </div>

    <div class="content">
        <h2>Halo {{ $nama }},</h2>

        <p>
            Melalui email ini, kami ingin menyampaikan bahwa terdapat pembaruan terbaru terkait proses seleksi dan administrasi Anda. 
            Sistem kami mencatat adanya perubahan pada status kandidat yang perlu Anda ketahui untuk memastikan kelancaran tahapan selanjutnya.
            Berikut informasi lengkap mengenai pembaruan tersebut:
        </p>

        <div class="status-box">
            <p><strong>Status Terbaru:</strong> {{ $status }}</p>
            <p><strong>Tanggal Pembaruan:</strong> {{ $tanggal }}</p>

            @if ($catatan)
                <p><strong>Catatan dari Admin:</strong> {{ $catatan }}</p>
            @endif
        </div>

        <p>
            Untuk mendapatkan penjelasan yang lebih detail, termasuk langkah-langkah yang perlu Anda lakukan berikutnya,
            silakan mengakses portal kandidat melalui tombol berikut. Anda akan diarahkan langsung ke halaman login untuk
            melihat seluruh informasi terbaru terkait proses Anda.
        </p>

        <a href="{{ url('/login') }}" class="button">Masuk ke Portal</a>

        <p style="margin-top: 25px;">
            Terima kasih atas waktu dan perhatian Anda. Kami sangat menghargai kerja sama serta komitmen Anda dalam mengikuti setiap tahap proses.
            Apabila Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, tim kami siap membantu kapan saja.
        </p>

        <p style="margin-top: 10px;">
            Salam hormat,<br>
            <strong>Mendunia.id</strong>
        </p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Mendunia.id. Seluruh hak cipta dilindungi.
    </div>
</div>

</body>

</html>
