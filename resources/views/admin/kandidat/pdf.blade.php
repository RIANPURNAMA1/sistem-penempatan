<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Kandidat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            color: #0d6efd;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 12px;
        }
        .info-box {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-box p {
            margin: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background-color: #0d6efd;
            color: white;
        }
        table thead th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #0d6efd;
        }
        table tbody td {
            padding: 10px 8px;
            border: 1px solid #dee2e6;
        }
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tbody tr:hover {
            background-color: #e9ecef;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #198754;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR AKUN KANDIDAT</h1>
        <p>Laporan Data Akun Kandidat Terdaftar</p>
    </div>

    <div class="info-box">
        <p><strong>Tanggal Cetak:</strong> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
        <p><strong>Total Kandidat:</strong> {{ $kandidats->count() }} orang</p>
        <p><strong>Sistem:</strong> Aplikasi Manajemen Kandidat</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="30%">Nama Kandidat</th>
                <th width="35%">Email</th>
                <th width="30%">Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kandidats as $index => $kandidat)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $kandidat->name }}</td>
                <td>{{ $kandidat->email }}</td>
                <td>{{ $kandidat->created_at->locale('id')->isoFormat('DD MMMM YYYY, HH:mm') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem</p>
        <p>© {{ date('Y') }} - Aplikasi Manajemen Kandidat</p>
    </div>
</body>
</html>