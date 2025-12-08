<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Data Pendaftaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }

        th {
            background-color: #eee;
            text-align: left;
        }

        .badge {
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 10px;
        }

        .bg-success {
            background-color: #28a745;
            color: white;
        }

     

        .bg-info {
            background-color: #17a2b8;
            color: black;
        }

        .bg-danger {
            background-color: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            word-wrap: break-word;
            overflow: hidden;
        }
    </style>
</head>

<body>

    <!-- HEADER LAPORAN -->
    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-weight: bold;">LAPORAN PENDAFTARAN KANDIDAT</h2>
        <p style="margin: 0; font-size: 14px;">Data Pendaftaran Kandidat Terbaru</p>
        <hr style="margin-top: 10px;">
    </div>

    <!-- TABEL DATA -->
    <table width="100%" border="1" cellspacing="0" cellpadding="7" style="border-collapse: collapse; font-size: 14px;">
        <thead style="background: #f0f0f0; font-weight: bold;">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>Email</th>
                <th>No WA</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Daftar</th>
                <th>Alamat</th>
                <th>Verifikasi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pendaftarans as $p)
                <tr>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->usia }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_wa }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        @php
                            $status = $p->verifikasi;
                            $class = match ($status) {
                                'menunggu' => '',
                                'data belum lengkap' => '',
                                'diterima' => '',
                                'ditolak' => '',
                                default => '',
                            };
                        @endphp
                        <span style="padding: 4px 8px; border-radius: 4px; {{ $class }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>


</html>
