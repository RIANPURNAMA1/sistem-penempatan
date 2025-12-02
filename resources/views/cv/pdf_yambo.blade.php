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

<body>
    <div class="d-flex justify-content-center">

        <button class="btn-container btn btn-success" onclick="window.print()">
            Print PDF
        </button>
    </div>
    <div class="cv-title">特 定 技 能 外 国 人 の 履 歴 書</div>
    <div class="cv-subtitle">Curriculum Vitae Pekerja Asing Berketerampilan Khusus</div>
    <div class="cv-container">


        <table>
            <!-- JUDUL DALAM TABEL -->


            <!-- NAMA -->
            <tr>
                <td style="width:10%;" rowspan="2">①氏名 <br> Nama</td>

                <td style="width:10%;">
                    アルファベット <br> Alfabet <br><br>
                    {{ $cv->nama ?? '.............................' }}
                </td>
                <td style="width:40%"></td>
                <td style="">②性別 <br> Jenis kelamin</td>
                <td colspan="3">
                    {{ $cv->jenis_kelamin ?? '............................................' }}
                </td>
            </tr>

            <!-- JENIS KELAMIN -->
            <tr>
                <td style="width:10%;">
                    漢字 <br> Kanji <br><br>
                    {{ $cv->nama_kanji ?? '.............................' }}
                </td>
                <td></td>
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
                    インドネシア <br> Indonesia
                </td>

                <td style="">
                    ⑨使用できる言語 <br> Bahasa yang mahir dikuasai
                </td>
                <td>
                    インドネシア語 <br> Bahasa Indonesia <br>
                    日本語 <br> Bahasa Jepang
                </td>
            </tr>
            <td colspan="2">
                ⑥本国⼜は居住国
            </td>
            <td colspan="3">---------------------------</td>
            <tr>
            </tr>
            <td colspan="2">
                における住所
            </td>
            <td colspan="3">---------------------------</td>
            <tr>
            </tr>
            <td colspan="2">
                Alamat di negara asal atau negara
            </td>
            <td style="text-align: right" colspan="3">（電話 ）
                (Telepon )</td>
            <tr>
            <tr>
            </tr>
            <td colspan="2">
                tempat tinggal
            </td>
            <td colspan="3">---------------------------</td>
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
                    Tahun
                </td>
                <td style="text-align: center">
                    ⽉<br>
                    Bulan
                </td>
                <td style="text-align: center">
                    最終学歴・主たる職歴<br>
                    Latar belakang pendidikan terbaru/riwayat pekerjaan utama
                </td>
            </tr>
            <tr>
                <td colspan="" style="width:204px">
                    Latar belakang pendidikan
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td colspan="" style="width:204px">

                    riwayat pekerjaan

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width:204px; height:70px">
                    ⑧資格・免許
                    Kualifikasi, lisensi
                </td>
                <td>
                    dadadadd
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
</body>

</html>
