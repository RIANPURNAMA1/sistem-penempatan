<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae Pekerja Asing</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 20px;
            /* Perubahan Font di sini */
            /* font-family: "MS Mincho", "Hiragino Mincho ProN", "Yu Mincho", serif; */
            /* Menambahkan font Times New Roman sebagai fallback jika MS Mincho tidak tersedia */
            /* Pastikan font MS Mincho tersedia di sistem pengguna atau ter-embed (jika ini untuk dokumen cetak/PDF) */
            /* ... pengaturan font-family sebelumnya ... */

        }


        .cv-container {
            width: 100%;
            padding: 0;
            margin: 0 auto;

            max-width: 900px;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table td,
        table th {
            border: 1px solid #000 !important;
            padding: 6px;
            vertical-align: top;
        }

        /* Hanya untuk print */
        @media print {
            .btn-container {
                display: none !important;
            }

            body {
                font-weight: 600 !important;
            }
        }
    </style>
</head>

<body class="">
    <div class="d-flex justify-content-center">

        <div class="btn-container mb-3 d-flex gap-2 flex-wrap">

            <!-- Print PDF -->
            <button class="btn btn-success" onclick="window.print()">印刷 PDF</button>

            <!-- Translate to Japanese -->
            <button class="btn btn-success" onclick="translateToJapanese()">Ubah ke bahasa jepang</button>

            <!-- Capitalize Text -->
            <button class="btn btn-primary" onclick="capitalizeText()">Huruf Awal Kapital</button>

            <!-- Back Button -->
            <a href="/data/cv/kandidat" class="btn btn-info" style="font-size: 12px">Kembali</a>

        </div>
    </div>


    <div class="cv-container container2">

        <div class="d-flex ">
            <div style="">
                <table style="width: 520px;">
                    <tr>
                        <td colspan="2">
                            フリガナ : {{ $cv->nama_lengkap_katakana }}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            名前 : {{ $cv->nama_lengkap_romaji }}
                        </td>
                        <td class="" style="width: 20%">
                            性別
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            {{ $cv->jenis_kelamin }}
                        </td>
                    </tr>
                </table>

                <table style="width: 520px; height:100px">
                    <tr>
                        <td>
                            生年月日
                        </td>
                        <td style="width: 340px">
                            {{ $cv->tanggal_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ふりがな
                        </td>
                        <td>
                            -
                        </td>
                    </tr>
                </table>
            </div>
            <div class="mx-1 ">

                <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto"
                    style="
                    width: 172x; /* Agar gambar mengisi penuh lebar sel */
                    height: 201px; /* Agar gambar mengisi penuh tinggi sel */
                    display: block; /* Penting: Menghapus spasi ekstra di bawah gambar */
                    object-fit: cover; /* Opsional: Memastikan gambar menutupi area tanpa terdistorsi */
                ">
            </div>

        </div>
        <table style="width: 100%">
            <tr>
                <td rowspan="2" style="width: 20%">
                    現住所
                </td>
                <td rowspan="2">
                    {{ $cv->alamat_lengkap ?? '-' }}<br>
                    {{ $cv->kelurahan ?? '-' }}, {{ $cv->kecamatan ?? '-' }}
                    {{ $cv->kabupaten ?? '-' }}, {{ $cv->provinsi ?? '-' }}
                </td>
                <td style="width: 30%; text-align:center">
                    携帯電話番号
                </td>
            </tr>
            <tr>

                <td>
                    {{ $cv->no_telepon }}
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td rowspan="2" style="width: 20%">
                    家族
                </td>
                <td>
                    配偶者
                </td>
                <td>
                    子供
                </td>
                <td style="width: 30%;">
                    メールアドレス
                </td>
            </tr>
            <tr>

                <td>

                    {{ $cv->istri_nama }}
                </td>

                <td>
                    {{ $cv->anak_nama ?? '' }}
                </td>

                <td>
                    {{ $cv->email_aktif }}
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 20%" class="text-center">年（西暦）</td>
                <td>月</td>
                <td style="text-align: center" class="">学歴（高校卒業以降）</td>
            </tr>
            @foreach ($cv->pendidikans as $p)
                <tr>
                    <td style="width: 20%" class="text-center">{{ $p->tahun_masuk }} - {{ $p->tahun_masuk }}</td>
                    <td>{{ $p->bulan ?? '-' }}</td>
                    <td style="width:70%">{{ $p->nama }}</td>
                </tr>
            @endforeach
            {{-- <tr>
                    <td style="width: 20%"></td>
                    <td></td>
                    <td style="width:70%">NAMA SD 入学</td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td></td>
                    <td style="width:70%">NAMA SD 入学</td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td></td>
                    <td style="width:70%">NAMA SD 入学</td>
                </tr>
                <tr>
                    <td style="width: 20%"></td>
                    <td></td>
                    <td style="width:70%">NAMA SD 入学</td>
                </tr> --}}
        </table>
        <table>
            <tr>
                <td style="width: 20%" class="text-center">年（西暦）</td>
                <td>月</td>
                <td style="text-align: center">職歴(なければアルバイト歴)</td>
            </tr>
            @foreach ($cv->pengalamans as $p)
                <tr>
                    <td style="width: 20%" class="text-center">{{ $p->tanggal_masuk }} - {{ $p->tanggal_keluar }}</td>
                    <td>{{ $p->bulan }}</td>
                    <td style="width:70%">{{ $p->perusahaan }}</td>
                </tr>
            @endforeach
            <tr>
                <td style="width: 20%"></td>
                <td></td>
                <td style="width:70%">-----</td>
            </tr>
            <tr>
                <td style="width: 20%"></td>
                <td></td>
                <td style="width:70%">-----</td>
            </tr>
        </table>

        <table style="margin-top: 1rem;">
            <tr>
                <td style="text-align: center">
                    語学力・資格など<br>
                    (Kemampuan Bahasa & Sertifikat)
                </td>
                <td style="text-align: center">
                    趣味・得意な運動など<br>
                    (Hobi & Olahraga yang dikuasai)
                </td>
            </tr>

            <tr>
                <td>
                    {{-- Kemampuan Bahasa Jepang --}}
                    @if (!empty($cv->kemampuan_bahasa_jepang))
                        kemampuan bahasa jepang : {{ $cv->kemampuan_bahasa_jepang }} <br>
                    @endif

                    {{-- Kemampuan Bahasa Inggris --}}
                    @if (!empty($cv->kemampuan_berbahasa_inggris))
                        kemampuan bahasa inggris : {{ $cv->kemampuan_berbahasa_inggris }} <br>
                    @endif

                    {{-- Bidang Sertifikasi --}}
                    @if (!empty($cv->bidang_sertifikasi))
                        {{ $cv->bidang_sertifikasi }} <br>
                    @endif

                    {{-- Sertifikasi Lain (jika ada) --}}
                    @if (!empty($cv->bidang_sertifikasi_lainnya))
                        {{ $cv->bidang_sertifikasi_lainnya }} <br>
                    @endif
                </td>

                <td>
                    {{-- Hobi --}}
                    @if (!empty($cv->hobi))
                        {{ $cv->hobi }}
                    @else
                        —
                    @endif
                </td>
            </tr>
        </table>


        <table style="margin-top: 1rem;">
            <tr>
                <td style="text-align: center">
                    志望動機　　TUJUAN KE JEPANG
                </td>

            </tr>
            <tr>

                <td>
                    {{ $cv->ketertarikan_terhadap_jepang }}
                </td>
            </tr>
        </table>

        <table style="margin-top: 1rem;">
            <tr>
                <td style="text-align: center; background-color:rgb(213, 228, 197); font-weight:bold" colspan="2">
                    日本に住んだ事がある方 STATUS PERNAH TINGGAL DI JEPANG
                </td>

            </tr>
            <tr>
                <td style="width: 20%;background-color:rgb(213, 228, 197);">
                    在留資格
                </td>
                <td>
                    -----------------
                </td>
            </tr>

        </table>
        <table>
            <tr>
                <td style="width: 20%;background-color:rgb(213, 228, 197);">
                    雇用期間
                </td>
                <td>

                </td>
                <td style="width: 20%;background-color:rgb(213, 228, 197);">
                    専門級試験
                </td>
                <td style="width: 40%;background-color:rgb(213, 228, 197);">
                    合格した・合格していない・未受験
                </td>
            </tr>
        </table>
        <table style="margin-top:1rem">
            <tr>
                <td style="text-align: center;background-color:rgb(213, 228, 197); font-weight:bold">
                    家族構成 KELUARGA
                </td>
            </tr>
        </table>
        <table>
            <tr style="text-align: center;background-color:rgb(213, 228, 197);">
                <td>
                    順番
                </td>
                <td>
                    続柄
                </td>
                <td>
                    氏名
                </td>
                <td>
                    年齢
                </td>
                <td>
                    住所
                </td>
                <td>
                    職業
                </td>
            </tr>
            <tr style="text-align: center">
                <td>
                    1
                </td>
                <td>
                    父

                </td>
                <td>
                    {{ $cv->ayah_nama }}
                </td>
                <td>
                    {{ $cv->ayah_usia }}
                </td>
                <td>
                    {{ $cv->ayah_pekerjaan }}

                </td>
                <td>
                    -
                </td>
            </tr>
            <tr style="text-align: center">
                <td>
                    2
                </td>
                <td>
                    母
                </td>
                <td>
                    {{ $cv->ibu_nama }}
                </td>
                <td>
                    {{ $cv->ibu_usia }}
                </td>
                <td>
                    {{ $cv->ibu_pekerjaan }}
                </td>
                <td>
                    -
                </td>
            </tr>
            <!-- Kakak -->
            <tr style="text-align: center">
                <td>3</td>
                <td>兄 / 姉</td> <!-- 兄 (あに, ani) untuk kakak laki-laki, 姉 (あね, ane) untuk kakak perempuan -->
                <td>{{ $cv->kakak_nama ?? '-' }}</td>
                <td>{{ $cv->kakak_usia ?? '-' }}</td>
                <td>{{ $cv->kakak_pekerjaan ?? '-' }}</td>
                <td>-</td> <!-- status: kandung / tiri -->
            </tr>

            <!-- Adik -->
            <tr style="text-align: center">
                <td>4</td>
                <td>弟 / 妹</td> <!-- 弟 (おとうと, otōto) untuk adik laki-laki, 妹 (いもうと, imōto) untuk adik perempuan -->
                <td>{{ $cv->adik_nama ?? '-' }}</td>
                <td>{{ $cv->adik_usia ?? '-' }}</td>
                <td>{{ $cv->adik_pekerjaan ?? '-' }}</td>
                <td>-</td> <!-- status: kandung / tiri -->
            </tr>

            <tr style="text-align: center">
                <td>
                    5
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr style="text-align: center">
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>

        </table>

        <table style="margin-top: 1rem">
            <tr>
                <td style="font-weight: bold; text-align:center;background-color:rgb(213, 228, 197);">
                    その他
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="background-color:rgb(213, 228, 197); width:20%;">
                    民族
                </td>
                <td style="width:50%;">
                    民族：{{ $cv->suku ?? '-' }}

                </td>
                <td style="background-color:rgb(213, 228, 197); width:20%;">
                    身長
                </td>
                <td>
                   {{$cv->tinggi_badan}} cm
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="background-color:rgb(213, 228, 197); width:20%;">
                    宗教
                </td>
                <td style="width:50%;">
                    {{$cv->agama}}
                </td>
                <td style="background-color:rgb(213, 228, 197); width:20%;">
                    体重
                </td>
                <td>
                   {{$cv->berat_badan}} kg
                </td>
            </tr>
        </table>

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
<script>
    function capitalizeText() {
        const textNodes = [];
        const walker = document.createTreeWalker(
            document.querySelector('.container2'),
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
            document.querySelector('.container2'),
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


    function downloadPDF() {
        const container = document.querySelector('.container2');


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

            pdf.save('mensetsu_sheet.pdf');
        });
    }
</script>

</html>


</html>
