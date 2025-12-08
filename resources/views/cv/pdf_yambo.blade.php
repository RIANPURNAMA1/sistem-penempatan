<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv {{ $cv->nama_lengkap_romaji ?? '.............................' }} </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: "Times New Roman", serif;
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

        .cv-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding-top: 10px;
        }

        .cv-subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Hanya untuk print */
        @media print {
            .btn-container {
                display: none !important;
            }
        }
    </style>
</head>

<body class="container2">
    <div class="d-flex justify-content-center">

        <div class="btn-container d-flex gap-2 flex-wrap">

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
    <div class="cv-title">特 定 技 能 外 国 人 の 履 歴 書</div>
    <div class="cv-subtitle">Curriculum Vitae Pekerja Asing Berketerampilan Khusus</div>
    <div class="cv-container">


        <table>
            <!-- JUDUL DALAM TABEL -->


            <!-- NAMA -->
            <tr>
                <td style="width:13%;" rowspan="2">①氏名 <br> Nama</td>

                <td style="width:10%;">
                    アルファベット <br> Alfabet <br><br>
                </td>
                <td style="width:40%">{{ $cv->nama_lengkap_katakana ?? '.............................' }}</td>
                <td style="">②性別 <br> Jenis kelamin</td>
                <td colspan="3">
                    {{ $cv->jenis_kelamin ?? '............................................' }}
                </td>
            </tr>

            <!-- JENIS KELAMIN -->
            <tr>
                <td style="width:10%;">
                    漢字 <br> Kanji <br><br>

                </td>
                <td> {{ $cv->nama_lengkap_romaji ?? '.............................' }}</td>
                <td style="">③生年月日 <br> Tanggal lahir</td>
                <td colspan="3">
                    {{ $cv->tanggal_lahir ?? '............................................' }}
                </td>
            </tr>

            <!-- KEWARGANEGARAAN + BAHASA -->
            <tr>
                <td colspan="2" style="">
                    ④国籍・地域 <br> Kewarganegaraan, wilayah
                </td>
                <td>
                    インドネシア
                </td>

                <td style="">
                    ⑤ ⼗分に理解
                    できる⾔語 <br>
                    Bahasa yang mahir dikuasai
                </td>
                <td>
                    インドネシア語 <br> Bahasa Indonesia <br>
                    日本語 <br> Bahasa Jepang
                </td>
            </tr>
            <td colspan="2">
                ⑥本国⼜は居住国
            </td>
            <td colspan="3">インドネシア</td>
            <tr>
            </tr>
            <td colspan="2">
                における住所
            </td>
            <td colspan="3">{{ $cv->alamat_lengkap ?? '-' }}<br>
                {{ $cv->kelurahan ?? '-' }}, {{ $cv->kecamatan ?? '-' }}
                {{ $cv->kabupaten ?? '-' }}, {{ $cv->provinsi ?? '-' }}</td>
            <tr>
            </tr>
            <td colspan="2">
                Alamat di negara asal atau negara
            </td>
            <td style="text-align: right" colspan="3">（電話 ）
                {{ $cv->no_telepon }}</td>
            <tr>
            <tr>
            </tr>
            <td colspan="2">
                tempat tinggal
            </td>
            <td colspan="3">{{ $cv->tempat_lahir }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="" rowspan="" style="width:204px">
                    ⑦学歴・職歴
                </td>
                <td style="text-align: center">
                    年
                    <br>
                    Tahun masuk
                </td>
                <td style="text-align: center">
                    ⽉<br>
                    lulus
                </td>
                <td style="text-align: center">
                    最終学歴・主たる職歴<br>
                    Latar belakang pendidikan terbaru/riwayat pekerjaan utama
                </td>
            </tr>
            @foreach ($cv->pendidikans as $p)
                <tr>
                    <td colspan="" style="width:204px">
                        Latar belakang pendidikan
                    </td>
                    <td class="text-center" style="width: 80px">
                        {{ $p->tahun_masuk }}
                    </td>
                    <td style="width: 80px">
                        {{ $p->tahun_lulus }}
                    </td>
                    <td style="text-align: center">
                        {{ $p->nama }}
                    </td>
                </tr>
            @endforeach

            @foreach ($cv->pengalamans as $p)
                <tr>
                    <td colspan="" style="width:204px">

                        riwayat pekerjaan

                    </td>
                    <td class="text-center">
                        {{ $p->tanggal_masuk }}
                    </td>
                    <td class="text-center">
                        {{ $p->tanggal_keluar }}
                    </td>
                    <td class="text-center">
                        {{ $p->perusahaan }}
                    </td>
                </tr>
            @endforeach
        </table>
        <table>
            <tr>
                <td style="width:204px; height:70px">
                    ⑧資格・免許
                    Kualifikasi, lisensi
                </td>
                <td>
                    {{ $cv->surat_izin_mengemudi }} - {{ $cv->jenis_sim }}
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width:204px; height:70px">
                    ⑨過去に技能実習<br>
                    ⽣として本邦に在留
                </td>
                <td>
                    年<br>
                    Tahun
                </td>
                <td>
                    ⽉<br>
                    Bulan

                </td>
                <td>
                    在留資格<br>
                    Izin tinggal

                </td>
                <td>
                    所属機関等<br>
                    Organisasi terkait, dll.

                </td>
                <td>
                    監理団体
                    <br>
                    Organisasi
                    pengawas
                </td>
            </tr>
            <tr>
                <td style="width:204px; height:70px">
                    していた場合は， そ
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
            <tr>
                <td style="width:204px; height:70px">
                    の在留歴
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
            <tr>
                <td style="width:204px; height:70px">
                    Jika pernah tinggal di Jepang sebagai pekerja magang sebelumnya,
                    tuliskan riwayat tersebut.
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

    </div>
    <div style="" class="cv-container mt-2">

        <div class="">
            <div class="card-body">
                <h6 class="card-title mb-3">（注意） <span class="text-muted">/ (Catatan)</span></h6>

                <ol class="list-unstyled ms-0">
                    <li class="mb-3">
                        <div class="fw-bold">①の「英字」及び「漢字」⽒名は，旅券上の表記を記載すること。</div>
                        <div class="text-muted fst-italic">1. Untuk bagian ①, tulis nama sesuai paspor dalam alfabet
                            dan karakter kanji bila ada.</div>
                    </li>

                    <li class="mb-3">
                        <div class="fw-bold">⑤は，特定技能外国⼈が⼗分に理解できる⾔語（⺟国語に限らない。）について記載すること。</div>
                        <div class="text-muted fst-italic">2. Untuk bagian ⑤, tulis bahasa yang dapat dipahami
                            dengan mencukupi oleh pekerja asing berketerampilan khusus (tidak terbatas bahasa ibu).
                        </div>
                    </li>

                    <li class="mb-0">
                        <div class="fw-bold">
                            ⑨は，在留資格「技能実習」をもって本邦に在留していた期間，実習実施者（機関）及び監理団体（団体監理型技能実習の場合のみ）について詳細に記載すること。</div>
                        <div class="text-muted fst-italic">3. Untuk bagian ⑨, tulis dengan detail periode tinggal di
                            Jepang dengan izin tinggal “Pekerja Magang”, pelaksana (organisasi) pelatihan magang,
                            dan organisasi pengawas (hanya untuk pekerja magang dengan organisasi pengawas).</div>
                    </li>
                    <li style="font-size:12px">
                        2025 年 0 4 ⽉ 23 ⽇ CIANJUR 作成 <br>

                        Disusun tanggal:
                    </li>
                    <li style="font-size:12px">
                        特定技能外国⼈の署名 <br>
                        Tanda tangan pekerja asing berketerampilan khusus
                    </li>
                </ol>
            </div>
        </div>

            {{-- sertifikat --}}
    <div class=" mt-4">
        <div class="">
            <div class="card-body d-flex justify-content-center" style="display: flex; justify-content: center;">
                {{-- SERTIFIKAT --}}
                {{-- <tr>

                    <td>
                        @php
                            $sertifikats = json_decode($cv->sertifikat_files, true) ?? [];
                        @endphp

                        @if (count($sertifikats) === 0)
                            <span class="text-muted">Tidak ada file</span>
                        @else
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($sertifikats as $file)
                                    @php
                                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                        $url = asset($file);
                                    @endphp

                                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ $url }}" target="_blank">
                                            <img src="{{ $url }}"
                                                style="width:300px; height:auto; object-fit:cover; border-radius:8px; border:1px solid #ccc;">
                                        </a>
                                    @elseif ($ext === 'pdf')
                                        <a href="{{ $url }}" target="_blank" class="btn btn-danger btn-sm">
                                            <i class="bi bi-file-earmark-pdf"></i> PDF Sertifikat
                                        </a>
                                    @else
                                        <a href="{{ $url }}" target="_blank"
                                            class="btn btn-secondary btn-sm">
                                            <i class="bi bi-file-earmark-text"></i> Lihat Dokumen
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </td>
                </tr> --}}
            </div>
        </div>
    </div>

        <!-- Optional small CSS tweak -->
        <style>
            .card .card-body {
                padding: 1rem 1.1rem;
            }

            .card-title {
                font-size: 0.98rem;
            }

            .fw-bold {
                font-size: 0.95rem;
            }

            .fst-italic {
                font-size: 0.92rem;
            }
        </style>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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


</body>

</html>
