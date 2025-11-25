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
        padding: 6px;
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

    .container {}

    .header {
        text-align: start;
    }

    .header h1 {
        font-size: 14px;
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
        right: -1rem;
        top: -1rem;
        padding: 10px;
        font-size: 11px;
        line-height: 2.3;
        width: 170px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 5px;
        text-align: left;
        font-size: 10px;
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
        background-color: #e3f2fd;
        font-weight: bold;
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

    .no-border-top td {
        border-top: none !important;
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
    }
</style>

<style>
    .btn-container {
        margin-bottom: 1rem;
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
    }

    .btn-info {
        background-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    /* Hanya untuk print */
    @media print {
        .btn-container {
            display: none !important;
        }
    }
</style>
</head>

<body>
    <div class="mb-3 btn-container" style="display: flex; flex-wrap: wrap; gap: 10px;">
        <button class="btn btn-success" onclick="window.print()">印刷 PDF</button>
        <button class="btn btn-primary" onclick="downloadPDF()">Download PDF</button>
        <button class="btn btn-success" onclick="translateToJapanese()">日本語に翻訳 Translator To Japan</button>
        <button class="btn btn-primary" onclick="capitalizeText()">Huruf Awal Kapital</button>
        <button class="btn btn-info" onclick="window.location='/data/cv/kandidat'">Kembali</button>
    </div>

    <div class="container" style="display: flex; margin: 1rem; justify-content: center; gap: 2rem">
        <div class="" style="">
            <div class="header">
                <h1>面談シート</h1>
            </div>

            <div class="date-section" id="date-section"></div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const dateDiv = document.getElementById('date-section');

                    const today = new Date();
                    const year = today.getFullYear();
                    const month = today.getMonth() + 1; // 0-indexed
                    const day = today.getDate();

                    // Format: 2025年 11月 25日現在
                    dateDiv.textContent = `${year}年 ${month}月 ${day}日現在`;
                });
            </script>


            <div class="" style="position: relative">
                <div class="photo-guide" style="position: absolute; bottom: 10rem;">
                    <img src="{{ asset($cv->pas_foto) }}" width=130" height="" alt="">
                </div>
            </div>

            <!-- Personal Information Section -->
            <table>
                <tr>
                    <th class="name-cell" style="text-align: center">ふりがな</th>
                    <td colspan="5" class="input-field"> {{ $cv->nama_lengkap_romaji }}</td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center">氏　名</th>
                    <td style="height: 150px" colspan="5" class="large-name">
                        {{ $cv->nama_lengkap_romaji }}
                    </td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center">国籍</th>
                    <td>Indonesia</td>
                    <th style="text-align: center">生年月日</th>
                    <td>{{ $cv->tempat_tanggal_lahir }}</td>
                    <th style="text-align: center">年齢</th>
                    <td>{{ $cv->usia }}</td>
                    <th style="text-align: center">性別</th>
                    <td>{{ $cv->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center">ふりがな</th>
                    <td colspan="3" class="input-field">{{ $cv->nama_lengkap_romaji }}</td>
                    <td colspan="2" style="text-align: center"><strong>国外・国内</strong></td>
                    <td colspan="2" style="text-align: center">国外・国内</td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center" rowspan="2">現住所</th>
                    <td rowspan="2" colspan="3">{{ $cv->alamat_lengkap }}</td>
                    <td colspan="2" style="text-align: center"><strong>在留資格</strong></td>
                    <td colspan="2">―</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center"><strong>在留期限</strong></td>
                    <td colspan="2">―</td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center">血液型</th>
                    <td>{{ $cv->golongan_darah }}</td>
                    <th style="text-align: center">服サイズ</th>
                    <td>{{ $cv->ukuran_atasan_baju }}</td>
                    <th colspan="2" style="text-align: center">結婚</th>
                    <td colspan="2">{{ $cv->status_perkawinan }}</td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center">身長</th>
                    <td>{{ $cv->tinggi_badan }}</td>
                    <th style="text-align: center">ズボンサイズ</th>
                    <td>{{ $cv->ukuran_celana }}</td>
                    <th colspan="2" rowspan="3" style="text-align: center">家族構成</th>
                    <td colspan="2" rowspan="3">
                        自分・母・父・妻・子供(○人)<br />兄(○人)・姉(○人)<br />弟(○人)・妹(○人)
                    </td>
                </tr>
                <tr>
                    <th class="name-cell" style="text-align: center">体重</th>
                    <td>{{ $cv->berat_badan }}</td>
                    <th style="text-align: center">靴サイズ</th>
                    <td>{{ $cv->ukuran_sepatu }}</td>
                </tr>
            </table>
            <!-- Education History -->
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th class="section-header" colspan="2">年・月</th>
                    <th class="section-header" colspan="3">学　歴</th>
                    <th class="section-header" colspan="2">学部・学科</th>
                </tr>

                @forelse($cv->pendidikans as $pendidikan)
                    <tr>
                        <td colspan="2">{{ $pendidikan->tahun }}</td>
                        <td colspan="3">{{ $pendidikan->nama }}　卒業</td>
                        <td colspan="2" class="input-field">{{ $pendidikan->jurusan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="input-field"></td>
                        <td colspan="3" class="input-field"></td>
                        <td colspan="2" class="input-field"></td>
                    </tr>
                @endforelse
            </table>

            <!-- Work History -->
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th class="section-header" colspan="2">年・月</th>
                    <th class="section-header" colspan="3">職　歴</th>
                    <th class="section-header" colspan="2">職種</th>
                </tr>

                @forelse($cv->pengalamans as $pengalaman)
                    <tr>
                        <td colspan="2">
                            {{ $pengalaman->lama_bekerja ?? '○○○○年○○月～○○○○年○○月' }}
                        </td>
                        <td colspan="3">{{ $pengalaman->perusahaan }}　退職</td>
                        <td colspan="2" class="input-field">{{ $pengalaman->jabatan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="input-field"></td>
                        <td colspan="3" class="input-field"></td>
                        <td colspan="2" class="input-field"></td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div>
            <!-- Tabel 1: Lisensi dan Kualifikasi -->
            <table style="width: 600px; margin-top: 5rem">
                <thead>
                    <tr class="header-row">
                        <th colspan="2" style=" text-align:center;">年・月</th>
                        <th style=" text-align:center;">免許・資格</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="year-col">年</td>
                        <td class="month-col">月</td>
                        <td class="content-col">〇〇〇〇〇〇　取得</td>
                    </tr>
                    <tr class="data-row-alt">
                        <td class="year-col">年</td>
                        <td class="month-col">月</td>
                        <td class="content-col">〇〇〇〇〇〇　取得</td>
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
            <!-- Tabel 2: Keahlian dan Pengalaman -->
            <table>
                <thead>
                    <tr class="header-row" style="text-align: center">
                        <th style="width: 50%; text-align:center;">特技・経験</th>
                        <th style="width: 25% ; text-align:center;">応募職種</th>
                        <th style="width: 25%;  text-align:center;">利き手</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="no-border-top">
                        <td rowspan="7" class="section-content">
                            <div class="section-item">
                                <div class="section-title">【やってきた作業】</div>
                                <div>{{ $cv->kelincahan_dalam_bekerja ?? '—' }}</div>
                            </div>

                            <div class="section-item">
                                <div class="section-title">【扱ってきた材料】</div>
                                <div>{{ $cv->kekuatan_tindakan ?? '—' }}</div>
                            </div>

                            <div class="section-item">
                                <div class="section-title">【やってきた現場】</div>
                                <div>{{ $cv->kemampuan_pemahaman_ssw ?? '—' }}</div>
                            </div>

                            <div class="section-item">
                                <div class="section-title">【操作できる重機】</div>
                                <div>{{ $cv->kemampuan_berbahasa_inggris ?? '—' }}</div>
                            </div>
                        </td>
                        <td colspan="2" style="text-align: center;">{{ $cv->tangan_dominan ?? '左・右' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" class="label-cell">矯正視力</td>
                        <td style="text-align: center;">聴力異常</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">{{ $cv->kemampuan_penglihatan_mata ?? '有・無' }}</td>
                        <td style="text-align: center;">{{ $cv->gangguan_pendengaran ?? '有・無' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blue-header" style="text-align: center;">宗教</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 16px; text-align: center;">
                            {{ $cv->agama ?? '—' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="blue-header" style="text-align: center;">趣味</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 16px; text-align: center;">{{ $cv->hobi ?? '—' }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="comment-table" style="width: 100%; margin-top: 1rem; border-collapse: collapse;">
                <tr>
                    <td class="comment-header"
                        style="
                background-color: #e3f2fd;
                font-weight: bold;
                text-align: center;
                padding: 8px;
                border: 1px solid #000000;
            ">
                        コメント
                    </td>
                </tr>
                <tr>
                    <td class="comment-body"
                        style="
                height: 200px; 
                padding: 8px; 
                border: 1px solid #000000;
                vertical-align: top;
            ">
                        {{ $cv->komentar_guru_kelebihan_diri ?? '—' }}
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
    function capitalizeText() {
        const textNodes = [];
        const walker = document.createTreeWalker(
            document.querySelector('.container'),
            NodeFilter.SHOW_TEXT,
            null,
            false
        );

        while (walker.nextNode()) {
            const node = walker.currentNode;
            if (node.nodeValue.trim() !== '') {
                textNodes.push(node);
            }
        }

        textNodes.forEach(node => {
            node.nodeValue = node.nodeValue.replace(/\b\w/g, char => char.toUpperCase());
        });
    }

    async function translateToJapanese() {
        // Ambil semua elemen teks
        const textNodes = [];
        const walker = document.createTreeWalker(
            document.querySelector('.container'),
            NodeFilter.SHOW_TEXT,
            null,
            false
        );

        while (walker.nextNode()) {
            const node = walker.currentNode;
            if (node.nodeValue.trim() !== '') {
                textNodes.push(node);
            }
        }

        // Kirim teks ke API penerjemah
        for (let node of textNodes) {
            const originalText = node.nodeValue.trim();
            try {
                const translated = await translateText(originalText);
                node.nodeValue = translated; // replace teks asli
            } catch (err) {
                console.error('Terjemahan gagal untuk:', originalText, err);
            }
        }
    }

    // Contoh fungsi translate via API publik (DeepL atau Google Translate)
    async function translateText(text) {
        // Contoh menggunakan API Google Translate gratis via fetch
        const res = await fetch(
            `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=id|ja`);
        const data = await res.json();
        return data.responseData.translatedText;
    }

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
            pdf.save('mensetsu_sheet.pdf');
        });
    }
</script>

</html>
