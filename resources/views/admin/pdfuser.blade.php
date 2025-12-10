<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Kandidat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4472C4;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #4472C4;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #666;
            font-size: 12px;
            font-style: italic;
        }
        
        .info-box {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #4472C4;
        }
        
        .info-box table {
            width: 100%;
        }
        
        .info-box td {
            padding: 3px 0;
            font-size: 11px;
        }
        
        .info-box td:first-child {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        table.data-table thead {
            background-color: #4472C4;
            color: white;
        }
        
        table.data-table th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #ddd;
        }
        
        table.data-table td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-size: 10px;
        }
        
        table.data-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        table.data-table tbody tr:hover {
            background-color: #e9ecef;
        }
        
        .text-center {
            text-align: center;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #dee2e6;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>📋 DATA KANDIDAT</h1>
        <p>Daftar Kandidat Terdaftar dalam Sistem</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <table>
            <tr>
                <td>Tanggal Cetak</td>
                <td>: {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>Waktu Cetak</td>
                <td>: {{ \Carbon\Carbon::now()->format('H:i:s') }} WIB</td>
            </tr>
            <tr>
                <td>Total Kandidat</td>
                <td>: {{ $kandidats->count() }} Orang</td>
            </tr>
        </table>
    </div>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="30%">Nama Kandidat</th>
                <th width="35%">Email</th>
                <th width="30%">Tanggal Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kandidats as $index => $kandidat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $kandidat->name }}</strong>
                    </td>
                    <td>{{ $kandidat->email }}</td>
                    <td>{{ $kandidat->created_at->format('d M Y, H:i') }} WIB</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data kandidat</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>Dokumen ini dicetak secara otomatis oleh sistem</strong><br>
            © {{ date('Y') }} - Sistem Manajemen Kandidat
        </p>
    </div>
</body>
</html>