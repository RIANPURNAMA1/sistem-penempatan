<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            background-color: #ffc107;
            color: #000;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #e0a800;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <p>Halo,</p>
        <p>Kamu menerima email ini karena ada permintaan untuk mereset password akunmu.</p>
        <p>Silakan klik tombol di bawah ini untuk mengatur ulang password:</p>
        <a href="{{ $url }}" class="btn">Reset Password</a>
        <p>Jika kamu tidak meminta reset password, abaikan email ini.</p>
        <p>Salam,<br>Sistem Kandidat</p>
    </div>
</body>
</html>
