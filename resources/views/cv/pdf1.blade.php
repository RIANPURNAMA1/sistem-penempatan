<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Diri</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #ffffff;

            font-size: 12px !important'

        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            box-shadow: none !important;
            /* ← Box Shadow dihapus */
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 14px;
        }

        .table-header {
            background-color: #4a90e2;
            color: white;
            font-weight: bold;
            font-size: 18px;
            padding: 12px;
            text-align: left;
        }

        .section-header {
            background-color: #e6e6e6;
            font-weight: bold;
            padding: 8px 10px;
        }

        .label-col {
            width: 45%;
            background-color: #fff;
        }

        .value-col {
            width: 55%;
            background-color: #f9f9f9;
        }

        .info-section {
            background-color: #fff;
            padding: 10px;
            font-size: 12px;
            line-height: 1.4;
        }

        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">

        <div class="text-center no-print my-3">
            <button onclick="window.print()" class="btn btn-primary">Cetak Form</button>
        </div>
        <table class="data-table" style="font-size: 12px;">
            <tr>
                <td colspan="2" class="table-header">DATA DIRI</td>
            </tr>
            <tr>
                <td class="label-col">Nama Katakana</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Nama</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Nama panggilan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Tempat Tanggal Lahir</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Usia</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Jenis Kelamin</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Status</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Bersedia Kerja Shift?</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Bersedia Kerja Lembur?</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Bersedia Kerja di Hari Libur</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Menggunakan Kacamata ?</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Ketajaman Mata</td>
                <td class="value-col">: Kanan_____ Kiri_____</td>
            </tr>
            <tr>
                <td class="label-col">Tinggi Badan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Berat Badan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Golongan Darah</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Tangan Dominan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td colspan="2" class="">Ukuran Baju</td>
            </tr>
            <tr>
                <td class="label-col">Atasan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Celana</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Ukuran Pinggang</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Ukuran Sepatu</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Sudah Vaksin?</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Berapa Kali?</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Merokok</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Minum Alkohol</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Jika Ya, Intensitas Minum</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Apakah Bertato</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Kesehatan Badan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Penyakit/Cedera Masa Lalu</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Agama</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Email</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td colspan="2" class="info-section">
                    <strong>** KETAJAMAN MATA :</strong><br>
                    UKURAN MINUS DI INDO:<br>
                    0.1 = 5.00 - 6.00<br>
                    0.2 = 2.50 - 3<br>
                    0.5 = 0.75<br>
                    0.6 = 0.25-50 - 0.5<br>
                    1.0 = MENUNJUKAN NORMAL<br>
                    1.2-2.0 2 = NORMAL
                </td>
            </tr>
        </table>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Biodata</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            padding: 20px;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;

        }

        .main-title {
            color: #d9534f;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            font-size: 12px;
        }

        .section-title {
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 0;
        }

        .section-education {
            background-color: #5bc0de;
        }

        .section-work {
            background-color: #f0ad4e;
        }

        .section-family {
            background-color: #5a5a7d;
        }

        table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        table td {
            border: 1px solid #333;
            padding: 10px;
            vertical-align: middle;
        }

        .label-col {
            width: 200px;
            background-color: #fff;
            font-weight: 500;
        }

        .input-col {
            background-color: #fff;
        }

        .subsection-title {
            background-color: #f0f0f0;
            font-weight: bold;
            padding: 8px 10px;
        }

        .date-cell {
            text-align: center;
        }

        .no-print {
            text-align: center;
            margin-top: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="main-title">ISILAH DATA BERIKUT DENGAN BAIK DAN BENAR SERTA JELAS DAN LENGKAP</h1>

        <!-- RIWAYAT PENDIDIKAN TERAKHIR -->
        <table style="border: 1px solid black">
            <thead>
                <tr>
                    <th colspan="2" class="section-title section-education">RIWAYAT PENDIDIKAN TERAKHIR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label-col">Nama Sekolah</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Tahun Bulan</td>
                    <td class="input-col date-cell">: 年 月 〜 年 月</td>
                </tr>
                <tr>
                    <td class="label-col">Jurusan</td>
                    <td class="input-col">:</td>
                </tr>
            </tbody>
        </table>

        <!-- RIWAYAT PEKERJAAN -->
        <table style="border: 1px solid black">
            <thead>
                <tr>
                    <th colspan="2" class="section-title section-work">RIWAYAT PEKERJAAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" class="subsection-title">Indonesia</td>
                </tr>
                <tr>
                    <td class="label-col">Nama Perusahaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Nama Kota</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Bidang Pekerjaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Tahun Bulan</td>
                    <td class="input-col date-cell">: 年 月 〜 年 月</td>
                </tr>
                <tr>
                    <td colspan="2" class="subsection-title">Magang ( Eks Jisshu )</td>
                </tr>
                <tr>
                    <td class="label-col">Nama Perusahaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Nama Kota/Prefektur</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Bidang Pekerjaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Tahun Bulan</td>
                    <td class="input-col date-cell">: 年 月 〜 年 月</td>
                </tr>
                <tr>
                    <td colspan="2" class="subsection-title">Pekerjaan Saat Ini</td>
                </tr>
                <tr>
                    <td class="label-col">Nama Perusahaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Nama Kota</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Bidang Pekerjaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Tahun Bulan Mulai s/d saat ini</td>
                    <td class="input-col date-cell">: 年 月 〜 年 月</td>
                </tr>
            </tbody>
        </table>

        <!-- DATA KELUARGA -->
        <table>
            <thead>
                <tr>
                    <th colspan="2" class="section-title section-family">DATA KELUARGA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" class="subsection-title">Ayah</td>
                </tr>
                <tr>
                    <td class="label-col">Nama lengkap</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Usia</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Profesi/Pekerjaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td colspan="2" class="subsection-title">Ibu</td>
                </tr>
                <tr>
                    <td class="label-col">Nama lengkap</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Usia</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Profesi/Pekerjaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Kontak orang tua (Ibu/Ayah)</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td colspan="2" class="subsection-title">Suami/Istri</td>
                </tr>
                <tr>
                    <td class="label-col">Nama lengkap</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Usia</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Profesi/Pekerjaan</td>
                    <td class="input-col">:</td>
                </tr>
                <tr>
                    <td colspan="" class="label-col" style="width:100px !important;">Usia</td>
                    <td colspan="4" class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Profesi/Pekerjaan</td>
                    <td colspan="4" class="input-col">:</td>
                </tr>
                <tr>
                    <td class="label-col">Kontak Suami/Istri</td>
                    <td colspan="4" class="input-col">:</td>
                </tr>
            </tbody>
        </table>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Keluarga</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #ffffff;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;

        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 8px;
            word-wrap: break-word;
        }

        .section-header,
        .subsection-header {
            text-align: center;
            font-weight: bold;
            background: #f2f2f2;
        }



        .label-col {
            background-color: #fff;
        }

        .value-col {
            background-color: #f9f9f9;
        }

        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <table class="data-table" style="border: 1px solid black">
            <tr>
                <td colspan="3" class="section-header">Anak</td>
            </tr>
            <tr>
                <td style="" class="input-col">Jenis Kelamin :</td>
                <td class="input-col">Jenis Kelamin :</td>
                <td class="input-col">Jenis Kelamin :</td>
            </tr>
            <tr>
                <td class="input-col">Usia :</td>
                <td class="input-col">Usia :</td>
                <td class="input-col">Usia :</td>
            </tr>
            <tr>
                <td class="input-col">Pendidikan :</td>
                <td class="input-col">Pendidikan :</td>
                <td class="input-col">Pendidikan :</td>
            </tr>
            <tr>
                <td colspan="3" class="subsection-header">Saudara kandung (kakak)</td>
            </tr>
            <tr>
                <td class="label-col">Jenis Kelamin :</td>
                <td class="label-col">Jenis Kelamin :</td>
                <td class="label-col">Jenis Kelamin :</td>
            </tr>
            <tr>
                <td class="value-col">Usia :</td>
                <td class="value-col">Usia :</td>
                <td class="value-col">Usia :</td>
            </tr>
            <tr>
                <td class="value-col">Profesi/Pekerjaan</td>
                <td class="value-col">Profesi/Pekerjaan</td>
                <td class="value-col">Profesi/Pekerjaan</td>
            </tr>
            <tr>
                <td class="value-col">Status saudara : Kandung/Tiri</td>
                <td class="value-col">Status saudara : Kandung/Tiri</td>
                <td class="value-col">Status saudara : Kandung/Tiri</td>
            </tr>
            <tr>
                <td class="value-col">Nama lengkap:</td>
                <td class="value-col">Nama lengkap:</td>
                <td class="value-col">Nama lengkap:</td>
            </tr>
            <tr>
                <td colspan="3" class="subsection-header">Saudara kandung (Adik)</td>
            </tr>
            <tr>
                <td class="label-col">Jenis Kelamin :</td>
                <td class="label-col">Jenis Kelamin :</td>
                <td class="label-col">Jenis Kelamin :</td>
            </tr>
            <tr>
                <td class="value-col">Usia :</td>
                <td class="value-col">Usia :</td>
                <td class="value-col">Usia :</td>
            </tr>
            <tr>
                <td class="value-col">Profesi/Pekerjaan: Pelajar</td>
                <td class="value-col">Profesi/Pekerjaan</td>
                <td class="value-col">Profesi/Pekerjaan</td>
            </tr>
            <tr>
                <td class="value-col">Status saudara : Kandung</td>
                <td class="value-col">Status saudara : Kandung/Tiri</td>
                <td class="value-col">Status saudara : Kandung/Tiri</td>
            </tr>
            <tr>
                <td class="value-col">Nama lengkap:</td>
                <td class="value-col">Nama lengkap:</td>
                <td class="value-col">Nama lengkap:</td>
            </tr>
            <tr>
                <td colspan="" class="value-col">Jumlah saudara (adik & kakak)</td>
                <td colspan="" class="value-col"></td>
                <td colspan="" class="value-col"></td>
            </tr>
            <tr>
                <td colspan="" class="subsection-header">Persetujuan Keluarga</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah memiliki kenalan di Jepang?</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Tinggal Di Prefektur?</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Kontak kenalan di Jepang</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Penghasilan orang tua</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Sumber biaya keberangkatan</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Perkiraan Biaya yang disiapkan untuk bekerja ke Jepang</td>
                <td colspan="2" class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Biaya keberangkatan sebelumnya (bagi eks jisshu)</td>
                <td colspan="2" class="value-col">:</td>
            </tr>
        </table>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kualifikasi dan Riwayat Pekerjaan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #ffffff;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;

        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
            margin-bottom: 20px;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 12px;
        }

        .section-header {
            background-color: #e8a5a5;
            font-weight: bold;
            padding: 10px;
            font-size: 18px;
        }

        .section-header-blue {
            background-color: #4a6fa5;
            color: white;
            font-weight: bold;
            padding: 10px;
            font-size: 12px;
        }

        .label-col {
            width: 40%;
            background-color: #fff;
        }

        .value-col {
            width: 60%;
            background-color: #f9f9f9;
        }

        .alert-box {
            background-color: #ff4444;
            color: white;
            padding: 8px 15px;
            margin-bottom: 15px;
            font-weight: bold;
            border-radius: 3px;
        }

        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none;
            }

            .alert-box {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">

        <!-- KUALIFIKASI -->
        <table class="data-table" style="border: 1px solid black">
            <tr>
                <td colspan="2" class="section-header">Kualifikasi</td>
            </tr>
            <tr>
                <td class="label-col">Level Bahasa</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Sertifikat Yang Dimiliki</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Bidang</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Lama ingin tinggal di Jepang</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Lama ingin bekerja di perusahaan ini</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Ingin pulang ke Indonesia berapa kali dalam 5th</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apakah ada keluarga di Jepang</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Hubungan dengan keluarga di Jepang</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Status kerabat di Jepang</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Kontak keluarga di Jepang</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Wawancara di tempat lain</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Lokasi Perusahaan lain</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Gaji perjam ditempat lain</td>
                <td class="value-col">¥ /jam</td>
            </tr>
        </table>

        <!-- ALERT BOX -->
        <div class="alert-box">
            bagi Eks Jisshu Silahkan Di isi untuk New Comer hanya sampai Kualifikasi
        </div>

        <!-- RIWAYAT PEKERJAAN TERAKHIR -->
        <table class="data-table">
            <tr>
                <td colspan="2" class="section-header-blue">Riwayat Pekerjaan Terakhir (X Jisshu/TG/Katsudo)</td>
            </tr>
            <tr>
                <td class="label-col">Nama Perusahaan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Nama Kumiai</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Total Karyawan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Total Karyawan Asing</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Bidang Pekerjaan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Klasifikasi Pekerjaan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Masa Pelatihan Kerja</td>
                <td class="value-col">: 年 月 〜 年 月</td>
            </tr>
            <tr>
                <td class="label-col">Penanggung Jawab Saat Bekerja</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Kerja Shift/Normal?</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col" rowspan="3">Jam Kerja</td>
                <td class="value-col">: start 〜 selesai</td>
            </tr>
            <tr>
                <td class="value-col">: start 〜 selesai</td>
            </tr>
            <tr>
                <td class="value-col">: start 〜 selesai</td>
            </tr>
            <tr>
                <td class="label-col">Hari Libur</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Detail Pekerjaan</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Apabila Barang Cacat</td>
                <td class="value-col">:</td>
            </tr>
        </table>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Detail Jisshu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #ffffff;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;

        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #000;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 12px;
        }

        .label-col {
            width: 40%;
            background-color: #fff;
        }

        .value-col {
            width: 60%;
            background-color: #f9f9f9;
        }

        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <table class="data-table" style="border: 1px solid black">
            <tr>
                <td class="label-col">atau salah apa yang dilakukan?</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Tempat tinggal sewaktu jisshu di Prefektur mana</td>
                <td class="value-col">: -ken</td>
            </tr>
            <tr>
                <td class="label-col">Nama kota tempat tingga waktu jisshu</td>
                <td class="value-col">: -shi</td>
            </tr>
            <tr>
                <td class="label-col">Status visa sebelumnya</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Masa tinggal waktu di Jepang sebelumnya</td>
                <td class="value-col">: 年 月 sampai 年 月</td>
            </tr>
            <tr>
                <td class="label-col">Gaji perjam sebelumnya</td>
                <td class="value-col">: ¥#/jam</td>
            </tr>
            <tr>
                <td class="label-col">Gaji bersih sebelumnya</td>
                <td class="value-col">:</td>
            </tr>
            <tr>
                <td class="label-col">Lembur rata-rata sebelumnya</td>
                <td class="value-col">: Choose an item. /bulan</td>
            </tr>
            <tr>
                <td class="label-col">Asrama sebelumnya</td>
                <td class="value-col">: kamar</td>
            </tr>
            <tr>
                <td class="label-col">Jumlah orang yang di asrama</td>
                <td class="value-col">: orang</td>
            </tr>
            <tr>
                <td class="label-col">Transportasi yang di gunakan sebelumnya</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Jarak tempuh</td>
                <td class="value-col">: menit</td>
            </tr>
            <tr>
                <td class="label-col">Apakah sudah memiliki hanko/cap</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Apakah nama di hanko jisshu sama dengan nama di CV</td>
                <td class="value-col">: Choose an item.</td>
            </tr>
            <tr>
                <td class="label-col">Tulis nama katakana yang tertera di hanko</td>
                <td class="value-col">:</td>
            </tr>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Individu Diisi Oleh Pihak LPK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;

        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .table-container {
            padding: 20px;

        }

        .main-table {
            border: 2px solid #000;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }

        .header-blue {
            background-color: #9BC2E6;
            font-weight: bold;
        }

        .header-light-blue {
            background-color: #DDEBF7;
        }

        .white-bg {
            background-color: #FFFFFF;
        }

        .small-col {
            width: 40px;
        }

        .medium-col {
            width: 80px;
        }

        .tilde-cell {
            font-size: 12px;
        }

        .title-header {
            background-color: #9BC2E6;
            font-weight: bold;
            font-size: 12px;
            padding: 15px;
        }

        .equal-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .equal-table td {
            border: 1px solid #000;
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="form-container">
            <table class="table main-table mb-0">
                <!-- Header Utama -->
                <thead>
                    <style>
                        .equal-col {
                            width: 20%;
                            /* 100% / 5 kolom = 20% per kolom */
                            height: 50px;
                            text-align: center;
                        }
                    </style>

                    <tr>
                        <th colspan="11" class="title-header" style=" background-color: #9BC2E6;">EVALUASI INDIVIDU
                            DIISI OLEH PIHAK LPK</th>
                    </tr>

                    <tr class="header-blue">
                        <th class="equal-col" style=" background-color: #9BC2E6;">NAMA</th>
                        <th class="equal-col"></th>
                        <th class="equal-col" style=" background-color: #9BC2E6;">UMUR</th>
                        <th class="equal-col"></th>
                        <th class="equal-col" style=" background-color: #9BC2E6;">P/L</th>
                    </tr>

                </thead>
                <tbody>
                    <!-- Section: Mengenai Kegiatan Siswa di LPK -->
                    <tr>
                        <td colspan="11" class="header-blue" style="background-color: #9BC2E6;">MENGENAI KEGIATAN
                            SISWA DI LPK</td>
                    </tr>
                    <tr class="header-light-blue">
                        <td colspan="2" style=" background-color: #9BC2E6;">Nama LPK</td>
                        <td colspan="3" style=" background-color: #9BC2E6; ">Sudah berapa lama belajar di LPK</td>
                        <td colspan="3"style=" background-color: #9BC2E6; width:300px !important">CATATAN</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="3">

                            <div class="d-flex justify-content-center" style="height: 20px">


                            </div>
                        </td>
                        <td colspan="3"></td>
                    </tr>

                    <tr class="header-light-blue">
                        <td colspan="2" style=" background-color: #9BC2E6;">Sertifikat bahasa yang dimiliki</td>
                        <td colspan="2" style=" background-color: #9BC2E6;">Tanggal ujian</td>
                        <td colspan="3" style=" background-color: #9BC2E6;">Sertifikat SSW</td>
                        <td colspan="4" style=" background-color: #9BC2E6;">Tanggal ujian</td>
                    </tr>
                    <tr>
                        <td class="white-bg" colspan="2" style="height: 50px;"></td>
                        <td class="white-bg" colspan="2"></td>
                        <td class="white-bg" colspan="3"></td>
                        <td class="white-bg" colspan="4"></td>
                    </tr>
                    <tr class="header-light-blue">
                        <td colspan="2"style=" background-color: #9BC2E6;">Skor level bahasa</td>
                        <td colspan="2"></td>
                        <td colspan="3"style=" background-color: #9BC2E6;">Skor SSW</td>
                        <td colspan="4"></td>
                    </tr>


                    <!-- Section: Info Penilaian dari LPK -->
                    <tr>
                        <td colspan="11" class="header-blue" style="background-color: #9BC2E6;">INFO PENILAIAN
                            DARI LPK TERHADAP KANDIDAT</td>
                    </tr>
                    <tr class="header-light-blue">
                        <td colspan="2" style=" background-color: #9BC2E6;">Bidang</td>
                        <td colspan="2" style=" background-color: #9BC2E6;">Evaluasi</td>
                        <td colspan="4" style=" background-color: #9BC2E6;">Catatan</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 50px;background-color: #9BC2E6;">Absensi kehadiran</td>
                        <td colspan="2" style=" background-color: #9BC2E6;">F1/PERBULAN</td>
                        <td colspan="4"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Evaluasi LPK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #ffffff;
        }

        .table-container {
            max-width: 900px;
            margin: 0 auto;

        }

        .main-table {
            border: 2px solid #000;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #000;
            vertical-align: middle;
            padding: 8px;
            font-size: 12px;
        }

        .header-blue {
            background-color: #9BC2E6;
            font-weight: bold;
            text-align: center;
        }

        .header-light-blue {
            background-color: #DDEBF7;
            font-weight: bold;
        }

        .white-bg {
            background-color: #FFFFFF;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .checkbox-symbol {
            font-size: 12px;
            font-weight: bold;
        }

        .numbered-list {
            text-align: left;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="table-container">
            <table class="table main-table mb-0" border="1" cellspacing="0"
                style="border: 1px solid black; width: 100%; font-size: 11px; font-weight: bold; font-family: Arial, sans-serif; border-collapse: collapse;">
                <tbody>
                    <!-- Baris 1: Kosong -->
                    <tr>
                        <td class="header-light-blue" style="width: 35%; height: 40px; border: 1px solid black;"></td>
                        <td class="white-bg" colspan="2" style="width: 22%; border: 1px solid black;"></td>
                        <td class="white-bg" style="width: 22%; border: 1px solid black;"></td>
                    </tr>

                    <!-- Baris 2: Keterlambatan/Pulang duluan -->
                    <tr>
                        <td class="header-light-blue"
                            style="height: 40px; border: 1px solid black; vertical-align: middle; background-color: #9BC2E6;">
                            Keterlambatan / Pulang duluan
                        </td>
                        <td class="white-bg text-center" style="border: 1px solid black; vertical-align: middle;">日
                        </td>
                        <td class="white-bg text-center" style="border: 1px solid black; vertical-align: middle;">日
                        </td>
                        <td class="white-bg text-center" style="border: 1px solid black; vertical-align: middle;">
                        </td>
                    </tr>

                    <!-- Baris 3: Jam pembelajaran header -->
                    <tr>
                        <td class="header-light-blue" rowspan="2"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Jam pembelajaran
                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Jam/Hari
                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            1 Minggu
                        </td>
                        <td class="header-light-blue text-center" rowspan="2"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">

                        </td>
                    </tr>
                    <!-- Baris 4: Jam pembelajaran data -->
                    <tr>
                        <td class="header-light-blue text-center"
                            style="height: 30px; border: 1px solid black; vertical-align: middle;">

                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;">

                        </td>
                    </tr>

                    <!-- Baris 5: Kemampuan ketika pembelajaran header -->
                    <tr>
                        <td rowspan="2" class="header-light-blue"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Kemampuan ketika pembelajaran（※）
                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Bahasa Jepang
                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Pembelajaran SSW
                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Kemampuan fisik
                        </td>
                    </tr>
                    <!-- Baris 6: Kemampuan ketika pembelajaran data -->
                    <tr>
                        <td class="header-light-blue text-center"
                            style="height: 30px; border: 1px solid black; vertical-align: middle;">

                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;">

                        </td>
                        <td class="header-light-blue text-center"
                            style="border: 1px solid black; vertical-align: middle;">

                        </td>
                    </tr>

                    <!-- Baris 7: Transportasi -->
                    <tr>
                        <td class="header-light-blue" rowspan="2"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            Transportasi dari asrama ke LPK
                        </td>
                        <td class="white-bg" colspan="2" rowspan="2"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            <div class="text-center">Mengenai asrama</div>
                        </td>
                        <td class="white-bg" rowspan="2"
                            style="border: 1px solid black; vertical-align: middle;  background-color: #9BC2E6;">
                            <div class="text-center">Seberapa sering pulang ke rumah pribadi</div>
                        </td>
                    </tr>
                    <!-- Baris 8: Transportasi kosong -->
                    <tr>
                        <!-- Kolom ini sudah digabung dengan baris sebelumnya -->
                    </tr>
                </tbody>
            </table>
            <table border="1" cellspacing="0"
                style="border: 1px solid black; width: 100%; font-size: 11px; font-weight: bold; font-family: Arial, sans-serif;">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center"
                            style="text-align: center; padding: 8px; background-color: #9BC2E6;">
                            基本的な生活習慣（※）
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="40%" style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            1. Mampu menyapa Guru, Teman, dan Masyarakat Sekitar dengan ramah
                        </td>
                        <td width="10%" style="padding: 6px 8px; text-align: center; vertical-align: top; ">

                        </td>
                        <td rowspan="10" width="5%"
                            style="padding: 6px 8px; text-align: center; vertical-align: middle;">

                        </td>
                        <td width="40%" style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            11. Mampu menerapkan dan melakukan seiri, seiton, dan seikatasu (3S)
                        </td>
                        <td width="10%" style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            2. Tulus dan dapat segera meminta maaf dan berterimakasih
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            12. Mampu menerapkan dan melakukan hourenshou (melaporkan, berkomunikasi, dan berkonsultasi)
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            3. Apakah patuh terhadap peraturan LPK/ lainnya
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            13. Mampu mematuhi dan memahami instruksi dari sensei LPK
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            4. Mampu mengerjakan segala sesuatu tanpa mengelu
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            14. Tidak bertindak egois dalam bersikap
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            5. Mampu bertindak secara bertanggung jawab atas perkataannya sendiri
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            15. Mampu mempersiapkan diri dalam persiapan setiap pembelajaran
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            6. Apabila Gagal, mampu untuk merenungkan diri tanpa harus menyalahkan orang lain
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            16. Mampu mendengarkan dan memahami secara baik pada materi yang diajarkan
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            7. Mampu membantu orang yang membutuhkan
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            17. Mampu bekerja sama dengan baik dalam kelompok
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            8. Mampu bergaul dengan teman, kerabat, dll
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                        <td style="padding: 6px 8px; vertical-align: top;  background-color: #9BC2E6;">
                            17. mengikuti aturan dan tata krama merokok (terbatas pada perokok)
                        </td>
                        <td style="padding: 6px 8px; text-align: center; vertical-align: top;">

                        </td>
                    </tr>
                </tbody>
            </table>


            <!-- Tabel Evaluasi -->
            <table style="border: 1px solid black; border-collapse: collapse; margin: 0; padding: 0;">
                <thead>
                    <tr style="font-size: 12px;font-weight:bold">
                        <td style="width: 300px; height: 20px; background-color: #9BC2E6;">
                            9. Mampu mendengarkan pendapat orang lain dengan baik
                        </td>
                        <td style="width: 70px;"></td>
                        <td rowspan="2" style="width: 40px;"></td>
                        <td rowspan="2" style="width: 200px; background-color: #9BC2E6;">
                            Evaluasi Keseluruhan
                        </td>
                        <td rowspan="2"></td>
                    </tr>
                    <tr style="font-size: 12px;font-weight:bold">
                        <td style="width: 300px; height: 20px; background-color: #9BC2E6;">
                            10. Mampu bekerja sama dalam tim
                        </td>
                        <td style="width: 70px;"></td>
                    </tr>
                </thead>
            </table>

            <!-- Tabel Tabungan (NO SPACING) -->
            <table style="border: 1px solid black; border-collapse: collapse; margin: 0; padding: 0;">
                <tbody>
                    <tr style="font-size: 12px; font-weight:bold">
                        <td rowspan="2" style="vertical-align: top; padding: 5px; background-color: #9BC2E6;">
                            1. Jumlah Tabungan yang diinginkan
                        </td>
                        <td style="padding: 5px; background-color: #9BC2E6;">
                            Jumlah pengiriman uang per bulan
                        </td>
                        <td style="padding: 5px; background-color: #9BC2E6;">
                            Jumlah pengiriman uang per 1 tahun
                        </td>
                        <td style="padding: 5px; background-color: #9BC2E6;">
                            Jumlah pengiriman uang selama 5 tahun
                        </td>
                    </tr>
                    <tr style="font-size: 12px; ">
                        <td style="padding: 5px; height:30px"></td>
                        <td style="padding: 5px;"></td>
                        <td style="padding: 5px;"></td>
                    </tr>

                    <tr style="font-size: 12px; font-weight:bold">
                        <td style="padding: 5px; background-color: #9BC2E6;">
                            2. Tujuan Penggunaan Tabungan Yang dihasilkan
                        </td>
                        <td style="padding: 5px;"></td>
                        <td style="padding: 5px;"></td>
                        <td style="padding: 5px;"></td>
                    </tr>

                    <tr style="font-size: 12px;font-weight:bold">
                        <td style="padding: 5px; background-color: #9BC2E6;">
                            3. Tujuan penggunaan tabungan untuk diri sendiri
                        </td>
                        <td style="padding: 5px;"></td>
                        <td style="padding: 5px;"></td>
                        <td style="padding: 5px;"></td>
                    </tr>

                    <tr>
                        <td colspan="4" style="background-color: rgb(154, 194, 113)"
                            class=" text-center small-text" style="padding: 10px; font-size: 12px;">
                            <strong>(※)</strong>
                            <strong style="padding: 10px; font-size: 12px;">A: SANGAT BAIK (SEKITAR 90%)</strong> &nbsp;&nbsp;
                            <strong style="padding: 10px; font-size: 12px;">B: BAIK (SEKITAR 75%)</strong> &nbsp;&nbsp;
                            <strong style="padding: 10px; font-size: 12px;">C: BELUM CUKUP BAIK (SEKITAR 50%)</strong><br>
                            <strong style="padding: 10px; font-size: 12px;">D: TIDAK MAMPU (SEKITAR 49%)</strong>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" class="bg-light-gray" style="height: 20px;"></td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
