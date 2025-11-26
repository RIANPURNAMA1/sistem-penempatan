<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CV {{ $cv->nama_lengkap_romaji }}</title>

    {{-- <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    /> --> --}}
</head>
<style>
    .btn-container {
        margin-bottom: 1rem;
        display: flex;
        gap: 10px;
        /* jarak antar tombol */
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        /* agar <a> mirip tombol */
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    /* Warna tombol */
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



<body class="p-4">
    <div class="btn-container">
        <button class="btn btn-success" onclick="window.print()">印刷 PDF</button>
        <button class="btn btn-primary" onclick="downloadPDF()">Download PDF</button>
        <div class="btn-container">
            <button class="btn btn-success" onclick="translateToJapanese()">日本語に翻訳</button>
        </div>
        <div class="btn-container">
            <button class="btn btn-primary" onclick="capitalizeText()">Huruf Awal Kapital</button>
        </div>


        <a href="/data/cv/kandidat" class="btn btn-info">戻る</a>
    </div>

    <div class="container2">

        <div class="container" style="display: flex; justify-content:center;  gap: 1rem">
            <div class="" id="cvArea">
                @php
                    // Memecah nama lengkap menjadi Nama Belakang + Nama Depan
                    $nama = explode(' ', $cv->nama_lengkap_romaji);
                    $namaBelakang = $nama[0] ?? '';
                    $namaDepan = $nama[1] ?? '';
                @endphp

                <!-- ========================================= -->
                <!-- 名前（FAMILY NAME / GIVEN NAME） -->
                <!-- ========================================= -->
                <table border="1" cellspacing="0" cellpadding="2" style="width: 450px; border-collapse: collapse;"
                    class="">
                    <thead>
                        <tr>
                            <th style="text-align:center;">姓（FAMILY NAME）</th>
                            <th style="text-align:center;">名（GIVEN NAME）</th>
                            <th width="20" style="text-align:center;">性別</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris input utama -->
                        <tr>
                            <td style="height: 50px; text-align:center;">
                                {{ $namaBelakang }}
                            </td>
                            <td style="text-align:center;">
                                {{ $namaDepan }}
                            </td>
                            <td rowspan="2" style="text-align:center;">
                                {{ $cv->jenis_kelamin == '男 (Laki-laki)' ? '男' : '女' }}
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align:center;">姓</td>
                            <td style="text-align:center;">名</td>
                        </tr>


                        <!-- Baris kosong tambahan -->
                        <tr style="text-align: center">

                            <td style="height: 20px;">{{ $namaBelakang }}</td>
                            <td> {{ $namaDepan }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>


                <!-- ========================================= -->
                <!-- 生年月日（Tanggal Lahir） -->
                <!-- ========================================= -->
                <table border="1" cellspacing="0"
                    style="width: 450px; border-collapse: collapse; border-top: none;">
                    <thead>
                        <tr>
                            <th style="width: 140px; padding: 0.5rem;">生年月日</th>
                            @php
                                $tgl = \Carbon\Carbon::hasFormat($cv->tempat_tanggal_lahir, 'Y-m-d')
                                    ? \Carbon\Carbon::parse($cv->tempat_tanggal_lahir)
                                    : null;
                            @endphp

                            <th style="padding-left: 0.5rem;">
                                @if ($tgl)
                                    {{ $tgl->format('Y') }} 年 /
                                    {{ $tgl->format('m') }} 月 /
                                    {{ $tgl->format('d') }} 日
                                    （満 {{ $cv->usia }} 歳）
                                @else
                                    {{ $cv->tempat_tanggal_lahir }} （満 {{ $cv->usia }} 歳）
                                @endif
                            </th>

                            {{-- <th style="padding-left: 0.5rem;">
                                {{ \Carbon\Carbon::parse($cv->tempat_tanggal_lahir)->format('Y') }} 年 /
                                {{ \Carbon\Carbon::parse($cv->tempat_tanggal_lahir)->format('m') }} 月 /
                                {{ \Carbon\Carbon::parse($cv->tempat_tanggal_lahir)->format('d') }} 日
                                （満 {{ $cv->usia }} 歳）
                            </th> --}}

                        </tr>
                    </thead>
                </table>

                <!-- ========================= -->
                <!--    出生地・住所（Tempat Lahir & Alamat） -->
                <!-- ========================= -->
                <table border="1" cellspacing="0"
                    style="width: 450px; border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th style="text-align:center; height: 25px;">
                                出生地：{{ $cv->tempat_tanggal_lahir ?? '-' }}
                            </th>
                        </tr>
                        <tr>
                            <td style="height: 60px; padding-left: 5px;">
                                住所：{{ $cv->alamat_lengkap ?? '-' }}
                            </td>
                        </tr>
                    </thead>
                </table>

                <!-- ========================= -->
                <!--        学歴（Riwayat Pendidikan） -->
                <!-- ========================= -->
                <table border="1" cellspacing="0"
                    style="width: 450px; border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align:center; height: 25px;">学歴</th>
                        </tr>
                        <tr>
                            <th style="width: 150px; text-align:center;">年／月 ～ 年／月</th>
                            <th style="width: 200px; text-align:center;">学校名</th>
                            <th style="width: 100px; text-align:center;">学部等</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cv->pendidikans as $p)
                            <tr>
                                <td style="height: 30px; text-align:center;">
                                    {{ $p->tahun }}{{ $p->selesai }}
                                </td>
                                <td style="padding-left: 5px;">
                                    {{ $p->nama }}
                                </td>
                                <td style="text-align:center;">
                                    {{ $p->jurusan }}
                                </td>
                            </tr>
                        @empty
                            <!-- Jika tidak ada data → tetap tampil baris kosong seperti format awal -->
                            <tr>
                                <td style="height: 30px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="height: 30px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="height: 30px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                <!-- Spacer -->
                <div style="height: 15px;"></div>

                <!-- ========================= -->
                <!--        職歴（Riwayat Pekerjaan） -->
                <!-- ========================= -->
                <table border="1" cellspacing="0" style="width: 450px; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align:center; height: 25px;">職歴</th>
                        </tr>
                        <tr>
                            <th style="width: 150px; text-align:center;">年／月 ～ 年／月</th>
                            <th style="width: 200px; text-align:center;">会社名</th>
                            <th style="width: 100px; text-align:center;">職種</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cv->pengalamans as $k)
                            <tr>
                                <td style="height: 30px; text-align:center;">
                                    {{ $k->lama_bekerja }}
                                </td>
                                <td style="padding-left:5px;">
                                    {{ $k->perusahaan }}
                                </td>
                                <td style="text-align:center;">
                                    {{ $k->jabatan }}
                                </td>
                            </tr>
                        @empty
                            <!-- Jika tidak ada data → tampilkan baris kosong seperti format asli -->
                            <tr>
                                <td style="height: 30px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="height: 30px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="height: 30px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- ========================= -->
                <!--   現在の収入（Income Section） -->
                <!-- ========================= -->
                <table border="1" cellspacing="0" style="width: 450px; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 5px;">
                            現在の収入（無職の場合は最終職歴時の収入）
                        </td>
                        <td style="width: 60px; text-align:center;">万円</td>
                    </tr>
                </table>


                <!-- JUDUL KEMAMPUAN -->
                <table border="1" cellspacing="0" cellpadding="6"
                    style="margin-top: 1rem; width: 450px; border-collapse: collapse; font-size: 12px;">
                    <tr>
                        <th style="text-align: center;">能力</th>
                    </tr>
                </table>

                <!-- ISI KEMAMPUAN -->
                <table border="1" cellspacing="0" cellpadding="6"
                    style="width: 450px; border-collapse: collapse; border-top: none; border-bottom: none; font-size: 12px;">
                    <tbody>
                        <tr>
                            <td style="width: 100px;">日本語能力</td>
                            <td style="width: 125px; height: 40px;">
                                {{ $cv->kemampuan_bahasa_jepang }}
                            </td>

                            <td style="width: 100px;">体力</td>
                            <td style="width: 125px;">
                                {{ $cv->kebugaran_jasmani_seminggu }}
                            </td>
                        </tr>

                        <tr>
                            <td>理解力</td>
                            <td style="height: 40px;">
                                {{ $cv->kemampuan_pemahaman_ssw }}
                            </td>

                            <td>行動力</td>
                            <td>
                                {{ $cv->kekuatan_tindakan }}
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!-- HOBI -->
                <!-- HOBI -->
                <table border="1" cellspacing="0" cellpadding="6"
                    style="width: 450px; border-collapse: collapse; font-size: 12px;">
                    <tbody>
                        <tr>
                            <td style="width: 80px;">趣味</td>
                            <td style="width: 370px; text-align: center;">
                                {{ $cv->hobi }}
                            </td>
                        </tr>
                    </tbody>
                </table>


                {{-- TABEL BAHASA --}}
                <table border="1" cellspacing="0" cellpadding="6"
                    style="margin-top: 1rem; width: 450px; border-collapse: collapse; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="width: 225px; text-align: center;">日本語学習期間</th>
                            <th style="width: 225px; text-align: center;">英語能力</th>
                        </tr>
                        <tr>
                            <td style="height: 40px; text-align:center;">
                                {{ $cv->lama_belajar_di_mendunia ?? '-' }}
                            </td>
                            <td style="text-align:center;">
                                {{ $cv->kemampuan_berbahasa_inggris ?? '-' }}
                            </td>
                        </tr>
                    </thead>
                </table>

                {{-- TABEL MINAT & KEAHLIAN --}}
                <table border="1" cellspacing="0" cellpadding="6"
                    style="margin-top: 1rem; width: 450px; border-collapse: collapse; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="width: 225px; text-align: center;">関心・興味</th>
                            <th style="width: 225px; text-align: center;">特技</th>
                        </tr>
                        <tr>
                            <td style="height: 60px; text-align:center;">
                                {{ $cv->ketertarikan_terhadap_jepang ?? '-' }}
                            </td>
                            <td style="text-align:center;">
                                {{ $cv->keahlian_khusus ?? '-' }}
                            </td>
                        </tr>
                    </thead>
                </table>

                <!-- KELEBIHAN (長所) -->
                <table border="1" cellspacing="0" cellpadding="6"
                    style="margin-top: 1rem; width: 450px; border-collapse: collapse; font-size: 12px;">
                    <tr>
                        <th height="20px" style="text-align:center;">長所</th>
                    </tr>
                    <tr>
                        <td height="150px" style="vertical-align: top; padding: 6px;">
                            {{ $cv->kelebihan_diri ?? '-' }}
                        </td>
                    </tr>
                </table>

                <!-- KEKURANGAN (短所) -->
                <table border="1" cellspacing="0" cellpadding="6"
                    style="margin-top: 1rem; width: 450px; border-collapse: collapse; font-size: 12px;">
                    <tr>
                        <th height="20px" style="text-align:center;">短所</th>
                    </tr>
                    <tr>
                        <td height="100px" style="vertical-align: top; padding: 6px;">
                            {{ $cv->kekurangan_diri ?? '-' }}
                        </td>
                    </tr>
                </table>

                <!-- CATATAN / MEMO (メモ / コメント) -->
                <table border="1" cellspacing="0" cellpadding="6"
                    style="margin-top: 1rem; width: 450px; border-collapse: collapse; font-size: 12px;">
                    <tr>
                        <th height="20px" style="text-align:center;">メモ / コメント</th>
                    </tr>
                    <tr>
                        <td height="200px" style="vertical-align: top; padding: 6px;">
                            {{-- Jika ingin digabung --}}
                            <strong>先生コメント（長所）:</strong><br>
                            {{ $cv->komentar_guru_kelebihan_diri ?? '-' }}<br><br>

                            <strong>先生コメント（短所）:</strong><br>
                            {{ $cv->komentar_guru_kekurangan_diri ?? '-' }}
                        </td>
                    </tr>
                </table>


            </div>

            <div>
                <div style="display: flex; position: relative;">
                    <table border="3" cellspacing="0" style="height: 200px; width: 140px;">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 0; text-align: center;">
                                    @if ($cv->pas_foto_cv)
                                        <img src="{{ asset($cv->pas_foto_cv) }}" alt="Foto Kandidat"
                                            style="width: 100%; height: 180px; object-fit: cover; display: block;">
                                    @else
                                        <span style="font-size: 11px;">Tidak ada foto</span>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- Nomor (contoh: ID CV) -->
                    <h1 style="position: absolute; top: -1rem; right: -3rem; font-size: 24px;">
                        {{ $cv->id }}
                    </h1>
                </div>


                <div style="padding-top: 1rem;">
                    <table border="1" cellspacing="0" cellpadding="6"
                        style="width: 260px; border-collapse: collapse; font-size: 12px; text-align: center;">
                        <tr>
                            <th>血液型 (Golongan Darah)</th>
                            <th>視力 (Penglihatan)</th>
                        </tr>
                        <tr>
                            <td style="height: 60px;">
                                {{ $cv->golongan_darah }}
                            </td>
                            <td>
                                {{ $cv->kemampuan_penglihatan_mata }}
                                @if ($cv->kemampuan_penglihatan_mata_lainnya)
                                    <br>({{ $cv->kemampuan_penglihatan_mata_lainnya }})
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="padding-top: 1rem;">
                    <table border="1" cellspacing="0" cellpadding="6"
                        style="width: 260px; border-collapse: collapse; font-size: 12px; text-align: center;">
                        <tr>
                            <th>身長 (Tinggi)</th>
                            <th>体重 (Berat)</th>
                        </tr>
                        <tr>
                            <td style="height: 60px;">
                                {{ $cv->tinggi_badan }} cm
                            </td>
                            <td>
                                {{ $cv->berat_badan }} kg
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="padding-top: 1rem;">
                    <table border="1" cellspacing="0" cellpadding="6"
                        style="width: 260px; border-collapse: collapse; font-size: 12px; text-align: center;">
                        <tr>
                            <th colspan="2">利き手 (Tangan Dominan)</th>
                        </tr>
                        <tr>
                            <td style="height: 60px; width: 40px;">
                                {{ $cv->tangan_dominan }}
                            </td>
                            <td>
                                {{ $cv->tangan_dominan == 'Kanan' ? '右利き' : '左利き' }}
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="padding-top: 1rem;">
                    <table border="1" cellspacing="0" cellpadding="6"
                        style="width: 260px; border-collapse: collapse; font-size: 12px; text-align: center;">
                        <tr>
                            <th>靴のサイズ (Ukuran Sepatu)</th>
                        </tr>
                        <tr>
                            <td style="height: 60px;">
                                {{ $cv->ukuran_sepatu }} cm
                            </td>
                        </tr>
                    </table>
                </div>


                <div style="padding-top: 1rem;">
                    <table border="1" cellspacing="0" cellpadding="6"
                        style="width: 260px; border-collapse: collapse; font-size: 12px; text-align: center;">
                        <tr>
                            <th>服のサイズ (Ukuran Baju)</th>
                        </tr>
                        <tr>
                            <td style="height: 60px;">
                                {{ $cv->ukuran_atasan_baju }}
                                @if ($cv->ukuran_atasan_baju_lainnya)
                                    （{{ $cv->ukuran_atasan_baju_lainnya }}）
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>


                <div style="padding-top: 1rem;">
                    <table border="1" cellspacing="0" cellpadding="6"
                        style="width: 260px; border-collapse: collapse; font-size: 12px; text-align: center;">
                        <tr>
                            <th style="width: 100px;">喫煙<br>(Merokok)</th>
                            <th style="width: 100px;">飲酒<br>(Minum Alkohol)</th>
                        </tr>
                        <tr>
                            <td style="height: 60px;">
                                {{ $cv->merokok }}
                            </td>
                            <td style="height: 60px;">
                                {{ $cv->minum_alkohol }}
                            </td>
                        </tr>
                    </table>
                </div>


                <table border="1" cellpadding="4" cellspacing="0"
                    style="border-collapse: collapse; width: 260px; text-align:center; margin-top:1rem;">
                    <tr>
                        <td>身長</td>
                        <td style="width:40px;">{{ $cv->tinggi_badan }}</td>
                        <td>cm</td>

                        <td>体重</td>
                        <td style="width:40px;">{{ $cv->berat_badan }}</td>
                        <td>kg</td>
                    </tr>
                    <tr>
                        <td>腰</td>
                        <td>{{ $cv->ukuran_pinggang }}</td>
                        <td>cm</td>

                        <td>靴</td>
                        <td>{{ $cv->ukuran_sepatu }}</td>
                        <td>cm</td>
                    </tr>
                </table>

                <table border="1" cellpadding="4" cellspacing="0"
                    style="border-collapse: collapse; width:260px; margin-top:20px; text-align:center; font-size:12px;">
                    <tr>
                        <td>服</td>
                        <td>{{ $cv->ukuran_baju ?? '' }}</td>

                        <td>血液型</td>
                        <td>{{ $cv->golongan_darah ?? '' }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2">視力</td>
                        <td>右：{{ $cv->visus_kanan ?? '' }}</td>

                        <td rowspan="2">利き手</td>
                        <td rowspan="2">{{ $cv->kikite ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>左：{{ $cv->visus_kiri ?? '' }}</td>
                    </tr>
                </table>

                <table border="1" cellpadding="6" cellspacing="0"
                    style="border-collapse: collapse; width:260px; margin-top:20px; text-align:center; font-size:12px;">
                    <tr>
                        <td>日本語学習期間</td>
                    </tr>
                    <tr>
                        <td>{{ $cv->lama_belajar_jepang ?? '' }} ヶ月　～　今まで</td>
                    </tr>
                </table>

                <table border="1" cellpadding="6" cellspacing="0"
                    style="border-collapse: collapse; width:260px; margin-top:20px; text-align:center;">
                    <tr>
                        <td>日本語能力</td>
                        <td>機敏性</td>
                    </tr>
                    <tr>
                        <td>忍耐力</td>
                        <td>行動力</td>
                    </tr>
                    <tr>
                        <td>理解力</td>
                        <td>英語力</td>
                    </tr>
                </table>
                <table border="1" cellpadding="6" cellspacing="0"
                    style="border-collapse: collapse; width:260px; margin-top:20px; text-align:center;">
                    <tr>
                        <td>お祈り</td>
                    </tr>
                    <tr>
                        <td>断食</td>
                    </tr>
                    <tr>
                        <td>実習希望期間</td>
                    </tr>
                </table>
                <table border="1" cellpadding="6" cellspacing="0"
                    style="border-collapse: collapse; width:260px; margin-top:20px; text-align:center;">
                    <tr>
                        <td>腕立</td>
                    </tr>
                    <tr>
                        <td>1回：8・27回　2回目：21回　3回目：17回</td>
                    </tr>
                    <tr>
                        <td>スクワット</td>
                    </tr>
                </table>




            </div>
        </div>
    </div>
    </div>


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
