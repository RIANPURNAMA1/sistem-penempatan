<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Kandidat</title>
</head>
<body>
    <h2>Halo {{ $nama }},</h2>

    <p>Status Anda telah diperbarui:</p>

    <p>
        <strong>Status Baru:</strong> {{ $status }} <br>
        <strong>Tanggal Update:</strong> {{ $tanggal }}
    </p>

    @if ($catatan)
        <p><strong>Catatan Admin:</strong> {{ $catatan }}</p>
    @endif

    <p>Silakan login ke portal untuk melihat detail lebih lanjut.</p>

    <p>Terima kasih.</p>
</body>
</html>
