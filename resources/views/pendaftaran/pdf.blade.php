<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran Kandidat</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #333;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #0d6efd;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #666;
        }

        /* ===== INFO BOX ===== */
        .info-box {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
        }

        .info-box p {
            margin: 4px 0;
            font-size: 11px;
        }

        .info-box strong {
            color: #0d6efd;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 10px;
        }

        thead {
            background-color: #0d6efd;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 8px 6px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 11px;
        }

        td {
            font-size: 10.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        /* ===== ALIGNMENT ===== */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        /* ===== BADGE STATUS ===== */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 4px;
            text-align: center;
            text-transform: uppercase;
        }

        .badge-menunggu {
            background-color: #6c757d;
            color: #fff;
        }

        .badge-belum {
            background-color: #ffc107;
            color: #000;
        }

        .badge-diterima {
            background-color: #28a745;
            color: #fff;
        }

        .badge-ditolak {
            background-color: #dc3545;
            color: #fff;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 12px;
        }

        .footer p {
            margin: 3px 0;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h1>LAPORAN PENDAFTARAN KANDIDAT</h1>
        <p>Data Pendaftaran Kandidat Terbaru</p>
    </div>

    <!-- INFO BOX -->
    <div class="info-box">
        <p><strong>Tanggal Cetak:</strong> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
        <p><strong>Total Pendaftaran:</strong> {{ $pendaftarans->count() }} orang</p>
        <p><strong>Sistem:</strong> Aplikasi Manajemen Kandidat Mendunia Jepang</p>
    </div>

    <!-- TABLE DATA -->
    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 18%;">Nama Lengkap</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 12%;">No WhatsApp</th>
                <th style="width: 15%;">Cabang</th>
                <th style="width: 10%;">Status Verifikasi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pendaftarans as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->email }}</td>
                    <td class="text-center">{{ $p->no_wa }}</td>
                    <td>{{ $p->cabang->nama_cabang ?? '-' }}</td>
                    
                    <td class="text-center">
                        @php
                            $statusClass = match ($p->verifikasi) {
                                'menunggu' => 'badge-menunggu',
                                'data belum lengkap' => 'badge-belum',
                                'diterima' => 'badge-diterima',
                                'ditolak' => 'badge-ditolak',
                                default => 'badge-menunggu',
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">
                            {{ $p->verifikasi }}
                        </span>
                    </td>

                
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <p><strong>Mendunia Jepang</strong></p>
        <p>Dokumen ini dibuat secara otomatis oleh sistem</p>
        <p>© {{ date('Y') }} - Aplikasi Manajemen Kandidat. All Rights Reserved.</p>
    </div>

</body>

</html>