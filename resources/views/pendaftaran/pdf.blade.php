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

        .bg-warning {
            background-color: #ffc107;
            color: black;
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
    <h4>Data Pendaftaran Kandidat</h4>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>Agama</th>
                <th>Status</th>
                <th>Email</th>
                <th>No WA</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Daftar</th>
                <th>Tempat/Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Verifikasi</th>
                <th>Catatan Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftarans as $p)
                <tr>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->usia }}</td>
                    <td>{{ $p->agama }}</td>
                    <td>{{ ucfirst($p->status) }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_wa }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}</td>
                    <td>{{ $p->tempat_lahir }}, {{ \Carbon\Carbon::parse($p->tempat_tanggal_lahir)->format('d-m-Y') }}
                    </td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        @php
                            $status = $p->verifikasi;
                            $class = match ($status) {
                                'menunggu' => 'bg-warning',
                                'data belum lengkap' => 'bg-info',
                                'diterima' => 'bg-success',
                                'ditolak' => 'bg-danger',
                                default => 'bg-info',
                            };
                        @endphp
                        <span class="badge {{ $class }}">{{ ucfirst($status) }}</span>
                    </td>
                    <td>{{ $p->catatan_admin ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
