<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>面談シート</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "MS Gothic", "Yu Gothic", sans-serif;
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
        right: -6px;
        top: 2px;
        border: 2px dashed;
        padding: 10px;
        font-size: 11px;
        line-height: 2.3;
        width: 170px;
        background-color: #fafafa;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 8px;
        text-align: left;
        font-size: 13px;
    }

    th {
        background-color: #e3f2fd;
        font-weight: bold;
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
        background-color: #daf0ff;
        font-weight: bold;
        text-align: center;
    }

    @media print {
        body {
            background-color: white;
            padding: 0;
        }

        .container {
            box-shadow: none;
            padding: 10px;
        }
        
        .btn-container {
            display: none;
        }
    }
</style>
</head>

<body>
    <div class="mb-3 btn-container">
        <button class="btn btn-success" onclick="printSheet()">印刷</button>
        <button class="btn btn-primary" onclick="downloadPDF()">PDF保存</button>
        <a href="/data/cv/kandidat" class="btn btn-info">
            戻る
        </a>
    </div>
    <div class="container" style="display: flex; margin: 1rem; justify-content: center; gap: 2rem">
        <div class="" style="">
            <div class="header">
                <h1>面談シート</h1>
            </div>

            <div class="date-section">年　　月　　日現在</div>

            <div class="" style="position: relative">
                <div class="photo-guide" style="position: absolute; bottom: 1; left: 1">
                    <img src="{{ asset($cv->pas_foto) }}" alt="写真" width="150" height="200">
                </div>
            </div>

            <!-- Personal Information Section -->
            <table>
                <tr>
                    <th class="name-cell">ふりがな</th>
                    <td colspan="5" class="input-field">{{ $cv->nama_lengkap_romaji }}</td>
                </tr>
                <tr>
                    <th class="name-cell">氏　名</th>
                    <td style="height: 200px" colspan="5" class="large-name">
                        {{ $cv->nama_lengkap_katakana }}
                    </td>
                </tr>
                <tr>
                    <th class="name-cell">国籍</th>
                    <td>インドネシア</td>
                    <th>生年月日</th>
                    <td>{{ $cv->tempat_tanggal_lahir }}</td>
                    <th>年齢</th>
                    <td>{{ $cv->usia }}歳</td>
                    <th>性別</th>
                    <td>{{ $cv->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th class="name-cell">ふりがな</th>
                    <td colspan="3" class="input-field">{{ $cv->nama_panggilan_romaji }}</td>
                    <td colspan="2"><strong>国内</strong></td>
                    <td colspan="2">国外・国内</td>
                </tr>
                <tr>
                    <th class="name-cell" rowspan="2">現住所</th>
                    <td rowspan="2" colspan="3">{{ $cv->alamat_lengkap }}</td>
                    <td colspan="2"><strong>在留資格</strong></td>
                    <td colspan="2">両親</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>在留期限</strong></td>
                    <td colspan="2">―</td>
                </tr>
                <tr>
                    <th class="name-cell">血液型</th>
                    <td>{{ $cv->golongan_darah }}型</td>
                    <th>服サイズ</th>
                    <td>{{ $cv->ukuran_atasan_baju }}</td>
                    <th colspan="2">結婚</th>
                    <td colspan="2">{{ $cv->status_perkawinan == 'Sudah Menikah' ? '既婚' : '未婚' }}</td>
                </tr>
                <tr>
                    <th class="name-cell">身長</th>
                    <td>{{ $cv->tinggi_badan }}cm</td>
                    <th>ズボンサイズ</th>
                    <td>{{ $cv->ukuran_celana }}</td>
                    <th colspan="2" rowspan="3">家族構成</th>
                    <td colspan="2" rowspan="3">
                        {{ $cv->anggota_keluarga_ibu ?? '' }}
                        {{ $cv->anggota_keluarga_ayah ?? '' }}
                        {{ $cv->anggota_keluarga_istri ?? '' }}
                        {{ $cv->anggota_keluarga_suami ?? '' }}
                        {{ $cv->anggota_keluarga_anak ?? '' }}
                        {{ $cv->anggota_keluarga_kakak ?? '' }}
                        {{ $cv->anggota_keluarga_adik ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th class="name-cell">体重</th>
                    <td>{{ $cv->berat_badan }}kg</td>
                    <th>靴サイズ</th>
                    <td>{{ $cv->ukuran_sepatu }}</td>
                </tr>
            </table>

            <!-- Education History -->
            <table>
                <tr>
                    <th class="section-header" colspan="2">年・月</th>
                    <th class="section-header" colspan="3">学　歴</th>
                    <th class="section-header" colspan="2">学部・学科</th>
                </tr>
                @forelse($cv->pendidikans ?? [] as $p)
                    <tr>
                        <td colspan="2">{{ $p->tahun }}年{{ $p->bulan ?? '' }}月</td>
                        <td colspan="3">{{ $p->nama }}　卒業</td>
                        <td colspan="2" class="input-field">{{ $p->jurusan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">-</td>
                        <td colspan="3">-</td>
                        <td colspan="2" class="input-field">-</td>
                    </tr>
                @endforelse
            </table>

            <!-- Work History -->
            <table>
                <tr>
                    <th class="section-header" colspan="2">年・月</th>
                    <th class="section-header" colspan="3">職　歴</th>
                    <th class="section-header" colspan="2">職種</th>
                </tr>
                @forelse($cv->pengalamans ?? [] as $p)
                    <tr>
                        <td colspan="2">{{ $p->periode ?? '○○○○年○○月～○○○○年○○月' }}</td>
                        <td colspan="3">{{ $p->perusahaan ?? '株式会社○○○○○○　退職' }}</td>
                        <td colspan="2" class="input-field">{{ $p->jabatan ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">○○○○年○○月～<br>○○○○年○○月</td>
                        <td colspan="3">株式会社○○○○○○　退職</td>
                        <td colspan="2" class="input-field"></td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div>
            <!-- Tabel 1: Lisensi dan Kualifikasi -->
            <table style="width: 600px; margin-top: 4rem">
                <thead>
                    <tr class="header-row">
                        <th colspan="2">年・月</th>
                        <th>免許・資格</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="year-col"></td>
                        <td class="month-col"></td>
                        <td class="content-col">
                            {{ $cv->surat_izin_mengemudi == 'Ada' ? $cv->jenis_sim . '　取得' : '' }}
                        </td>
                    </tr>
                    @for ($i = 0; $i < 7; $i++)
                        <tr class="{{ $i % 2 == 1 ? 'data-row-alt' : '' }}">
                            <td class="year-col"></td>
                            <td class="month-col"></td>
                            <td class="content-col"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <!-- Tabel 2: Keahlian dan Pengalaman -->
            <table>
                <thead>
                    <tr class="header-row">
                        <th style="width: 50%">特技・経験</th>
                        <th style="width: 25%">応募職種</th>
                        <th style="width: 25%">利き手</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="4" class="section-content">
                            <div class="section-item">
                                <div class="section-title">【やってきた作業】</div>
                                <div>{{ $cv->keahlian_khusus ?? '―' }}</div>
                            </div>

                            <div class="section-item">
                                <div class="section-title">【扱ってきた材料】</div>
                                <div>―</div>
                            </div>

                            <div class="section-item">
                                <div class="section-title">【やってきた現場】</div>
                                <div>―</div>
                            </div>

                            <div class="section-item">
                                <div class="section-title">【操作できる重機】</div>
                                <div>―</div>
                            </div>
                        </td>
                        <td style="text-align: center;">{{ $cv->bidang_sertifikasi }}</td>
                        <td style="text-align: center;">{{ $cv->tangan_dominan == 'Kanan' ? '右' : '左' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" class="label-cell">矯正視力</td>
                        <td style="text-align: center;">聴力異常</td>
                    </tr>
                    <tr>
                        <td class="label-cell">{{ $cv->kemampuan_penglihatan_mata != 'Normal' ? '有' : '無' }}</td>
                        <td>無</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blue-header" style="text-align: center;">宗教</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="no-border-top"></td>
                        <td colspan="2" style="padding: 16px; text-align: center;">{{ $cv->agama }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blue-header" style="text-align: center;">趣味</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 16px; text-align:center;">{{ $cv->hobi }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="comment-table">
                <tr>
                    <td class="comment-header"
                        style="
                background-color: #e3f2fd;
                font-weight: bold;
                text-align: center;
              ">
                        コメント
                    </td>
                </tr>
                <tr>
                    <td class="comment-body" style="height: 200px; padding: 15px; text-align: left; vertical-align: top;">
                        <strong>長所：</strong> {{ $cv->kelebihan_diri }}<br><br>
                        <strong>短所：</strong> {{ $cv->kekurangan_diri }}<br><br>
                        <strong>セールスポイント：</strong> {{ $cv->point_plus_diri }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
<script>
    function printSheet() {
        const container = document.querySelector('.container');

        html2canvas(container, {
            scale: 2
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            let heightLeft = pdfHeight;
            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
            heightLeft -= pdf.internal.pageSize.getHeight();

            while (heightLeft > 0) {
                position = heightLeft - pdfHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
                heightLeft -= pdf.internal.pageSize.getHeight();
            }

            pdf.autoPrint();
            window.open(pdf.output('bloburl'), '_blank');
        });
    }

    function downloadPDF() {
        const container = document.querySelector('.container');
        html2canvas(container, {
            scale: 2
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('面談シート_{{ $cv->nama_lengkap_romaji }}.pdf');
        });
    }
</script>

</html>