
  <title>Lembar Wawancara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, "Segoe UI", sans-serif;
      padding: 20px;
      background-color: #ffffff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th,
    td {
      border: 2px solid #000;
      padding: 12px;
      text-align: center;
    }

    .header-row {
      background-color: #ffffff;
      font-weight: bold;
    }

    .year-col {
      width: 10%;
    }

    .month-col {
      width: 10%;
    }

    .content-col {
      width: 80%;
      text-align: left;
      padding-left: 20px;
    }

    .data-row-alt {
      background-color: #f9f9f9;
    }

    .label-cell {
      background-color: #ffffff;
      font-weight: bold;
    }

    .blue-header {
      background-color: #e3f2fd;
      font-weight: bold;
    }

    .no-border-top {
      border-top: none;
    }

    .section-content {
      vertical-align: top;
      text-align: left;
      padding: 20px;
    }

    .section-item {
      margin-bottom: 20px;
    }

    .section-item:last-child {
      margin-bottom: 0;
    }

    .section-title {
      font-weight: bold;
      margin-bottom: 8px;
    }

    .header {
      text-align: start;
    }

    .header h1 {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .date-section {
      text-align: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .photo-guide {
      position: absolute;
      right: 0px;
      top: 2px;
      border: 2px dashed;
      padding: 10px;
      font-size: 11px;
      line-height: 2.3;
      width: 200px;
      background-color: #fafafa;
    }

    .name-cell {
      background-color: #e3f2fd;
      font-weight: bold;
      width: 100px;
    }

    .large-name {
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      padding: 20px;
    }

    .input-field {
      background-color: white;
    }

    .section-header {
      background-color: #e3f2fd;
      font-weight: bold;
      text-align: center;
    }

    .notes {
      margin-top: 20px;
      padding: 15px;
      background-color: #fff9c4;
      border-left: 4px solid #fbc02d;
      font-size: 12px;
      line-height: 1.8;
    }

    .notes strong {
      display: block;
      margin-bottom: 5px;
    }

    .small-text {
      font-size: 11px;
    }

    @media print {
      body {
        background-color: white;
        padding: 0;
      }

      
    }
  </style>
</head>

<body class="container">
<button id="btnPdf" class="btn btn-primary mb-3">
    Download PDF
</button>


  <div class="container"  id="PdfArea">                
    <div>
      <div class="header">
        <h1>LEMBAR WAWANCARA</h1>
      </div>

      <div class="date-section">Tanggal __ / __ / ____</div>

      <div style="position: relative">
        <div class="photo-guide" style="position: absolute; bottom: 1; left: 1">
          Tempat Foto<br /><br />
          Jika diperlukan foto:<br />
          1. Ukuran 4x6 cm<br />
          2. Foto close-up<br />
          dari dada ke atas<br />
          3. Tempelkan di<br />
          bagian belakang
        </div>
      </div>

      <!-- Informasi Pribadi -->
      <table>
        <tr>
          <th class="name-cell">Nama (Furigana)</th>
          <td colspan="5" class="input-field"></td>
        </tr>
        <tr>
          <th class="name-cell">Nama Lengkap</th>
          <td style="height: 200px" colspan="5" class="large-name">
            Aldi Abduloh
          </td>
        </tr>
        <tr>
          <th class="name-cell">Kewarganegaraan</th>
          <td>Indonesia</td>
          <th>Tanggal Lahir</th>
          <td>6 Juni 2001</td>
          <th>Usia</th>
          <td>○ tahun</td>
          <th>Jenis Kelamin</th>
          <td>Laki-laki / Perempuan</td>
        </tr>
        <tr>
          <th class="name-cell">Alamat (Furigana)</th>
          <td colspan="3" class="input-field"></td>
          <td colspan="2"><strong>Lokasi</strong></td>
          <td colspan="2">Luar Negeri / Dalam Negeri</td>
        </tr>
        <tr>
          <th class="name-cell" rowspan="2">Alamat Saat Ini</th>
          <td rowspan="2" colspan="3">Kode Pos: ______<br /><br />Provinsi, Kota</td>
          <td colspan="2"><strong>Status Tinggal</strong></td>
          <td colspan="2">—</td>
        </tr>
        <tr>
          <td colspan="2"><strong>Batas Tinggal</strong></td>
          <td colspan="2">—</td>
        </tr>
        <tr>
          <th class="name-cell">Golongan Darah</th>
          <td>○</td>
          <th>Ukuran Baju</th>
          <td>S / M / L / XL</td>
          <th colspan="2">Status Pernikahan</th>
          <td colspan="2">Menikah / Belum Menikah</td>
        </tr>
        <tr>
          <th class="name-cell">Tinggi Badan</th>
          <td>○ cm</td>
          <th>Ukuran Celana</th>
          <td>S / M / L / XL</td>
          <th colspan="2" rowspan="3">Komposisi Keluarga</th>
          <td colspan="2" rowspan="3">
            Diri sendiri, Ibu, Ayah, Istri/Suami<br />
            Anak (○ orang)<br />
            Kakak laki-laki (○), Kakak perempuan (○)<br />
            Adik laki-laki (○), Adik perempuan (○)
          </td>
        </tr>
        <tr>
          <th class="name-cell">Berat Badan</th>
          <td>○ kg</td>
          <th>Ukuran Sepatu</th>
          <td></td>
        </tr>
      </table>

      <!-- Riwayat Pendidikan -->
      <table>
        <tr>
          <th class="section-header" colspan="2">Tahun / Bulan</th>
          <th class="section-header" colspan="3">Riwayat Pendidikan</th>
          <th class="section-header" colspan="2">Jurusan / Fakultas</th>
        </tr>
        <tr>
          <td colspan="2">○○○○ / 06</td>
          <td colspan="3">SD ○○○○○○ - Lulus</td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2">○○○○ / 06</td>
          <td colspan="3">SMP ○○○○○○ - Lulus</td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2">○○○○ / 06</td>
          <td colspan="3">SMA ○○○○○○ - Lulus</td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
      </table>

      <!-- Riwayat Pekerjaan -->
      <table>
        <tr>
          <th class="section-header" colspan="2">Tahun / Bulan</th>
          <th class="section-header" colspan="3">Riwayat Pekerjaan</th>
          <th class="section-header" colspan="2">Jenis Pekerjaan</th>
        </tr>
        <tr>
          <td colspan="2">○○○○ / ○○<br />s/d<br />○○○○ / ○○</td>
          <td colspan="3">PT ○○○○○○ - Berhenti</td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2">○○○○ / ○○<br />s/d<br />○○○○ / ○○</td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
        <tr>
          <td colspan="2" class="input-field"></td>
          <td colspan="3" class="input-field"></td>
          <td colspan="2" class="input-field"></td>
        </tr>
      </table>
    </div>

    <div>
      <!-- Lisensi dan Sertifikat -->
      <table style="width: 900px; margin-top: 4rem">
        <thead>
          <tr class="header-row">
            <th colspan="2">Tahun / Bulan</th>
            <th>Lisensi & Sertifikat</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="year-col">Tahun</td>
            <td class="month-col">Bulan</td>
            <td class="content-col">○○○○○○ - Diperoleh</td>
          </tr>
          <tr class="data-row-alt">
            <td class="year-col">Tahun</td>
            <td class="month-col">Bulan</td>
            <td class="content-col">○○○○○○ - Diperoleh</td>
          </tr>
          <tr>
            <td class="year-col"></td>
            <td class="month-col"></td>
            <td class="content-col"></td>
          </tr>
          <tr>
            <td class="year-col"></td>
            <td class="month-col"></td>
            <td class="content-col"></td>
          </tr>
          <tr>
            <td class="year-col"></td>
            <td class="month-col"></td>
            <td class="content-col"></td>
          </tr>
          <tr>
            <td class="year-col"></td>
            <td class="month-col"></td>
            <td class="content-col"></td>
          </tr>
          <tr>
            <td class="year-col"></td>
            <td class="month-col"></td>
            <td class="content-col"></td>
          </tr>
          <tr>
            <td class="year-col"></td>
            <td class="month-col"></td>
            <td class="content-col"></td>
          </tr>
        </tbody>
      </table>

      <!-- Keahlian dan Pengalaman -->
      <table>
        <thead>
          <tr class="header-row">
            <th style="width: 50%">Keahlian & Pengalaman</th>
            <th style="width: 25%">Posisi yang Dilamar</th>
            <th style="width: 25%">Tangan Dominan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td rowspan="4" class="section-content">
              <div class="section-item">
                <div class="section-title">【Pekerjaan yang Pernah Dilakukan】</div>
                <div>○○, ○○, ○○, ○○</div>
              </div>

              <div class="section-item">
                <div class="section-title">【Material yang Pernah Ditangani】</div>
                <div>○○, ○○, ○○, ○○</div>
              </div>

              <div class="section-item">
                <div class="section-title">【Lokasi Kerja yang Pernah Dikunjungi】</div>
                <div>○○, ○○, ○○, ○○</div>
              </div>

              <div class="section-item">
                <div class="section-title">【Alat Berat yang Bisa Dioperasikan】</div>
                <div>○○, ○○, ○○, ○○</div>
              </div>
            </td>
            <td style="text-align: center;">Kiri / Kanan</td>
            <td style="text-align: center;">Kiri / Kanan</td>
          </tr>
          <tr style="background-color: #e3f2fd;">
            <td style="text-align: center; background-color: #e3f2fd;" class="label-cell">Penglihatan (Koreksi)</td>
            <td style="text-align: center;">Kelainan Pendengaran</td>
          </tr>
          <tr>
            <td class="label-cell">Ada / Tidak Ada</td>
            <td>Ada / Tidak Ada</td>
          </tr>
          <tr>
            <td colspan="2" class="blue-header" style="text-align: center;">Agama</td>
          </tr>
          <tr>
            <td rowspan="3" class="no-border-top"></td>
            <td colspan="2" style="padding: 16px; text-align: center;">Islam / Kristen / Katolik / Hindu / Buddha /
              Lainnya</td>
          </tr>
          <tr>
            <td colspan="2" class="blue-header" style="text-align: center;">Hobi</td>
          </tr>
          <tr>
            <td colspan="2" style="padding: 16px"></td>
          </tr>
        </tbody>
      </table>

      <!-- Komentar -->
      <table class="comment-table">
        <tr>
          <td class="comment-header" style="
                background-color: #e3f2fd;
                font-weight: bold;
                text-align: center;
              ">
            KOMENTAR
          </td>
        </tr>
        <tr>
          <td class="comment-body" style="height: 200px"></td>
        </tr>
      </table>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<script>
    document.getElementById('btnPdf').addEventListener('click', function () {
        window.print();
    });

    document.getElementById('btnDownload').addEventListener('click', function () {
        const element = document.getElementById('pdfArea'); 

        const opt = {
            margin:       0.5,
            filename:     'lembar-wawancara.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  {
                scale: 2,
                useCORS: true,
                backgroundColor: "#FFFFFF"
            },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    });
</script>


</script>

