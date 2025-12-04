<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV KANDIDAT</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .cv-container {
            width: 100%;
            padding: 0;
            margin: 0 auto;
            max-width: 900px;
        }

        .bg {
            background-color: #a5bfdf;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table td,
        table th {
            border: 1px solid #000 !important;
            padding: 3px;
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

<body>
    <div style="display: flex; justify-content:center;">
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
    <div class="cv-container container2">
        <img src="{{ asset('assets/compiled/png/LOGO/logo.png') }}" style="width: 200px" alt="">
        <div class="d-flex">
            <div class="p-2 mt-5">
                <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto"
                    style="
                    width: 180px; /* Agar gambar mengisi penuh lebar sel */
                    height: 269px; /* Agar gambar mengisi penuh tinggi sel */
                    display: block; /* Penting: Menghapus spasi ekstra di bawah gambar */
                    object-fit: cover; /* Opsional: Memastikan gambar menutupi area tanpa terdistorsi */
                ">
            </div>

            <div>

                <table style="width: 642px">
                    <tr>
                        <td class="bg" rowspan="2"
                            style="width: 200px; text-align:center;vertical-align: middle;">
                            実習生 NOMOR
                        </td>
                        <td rowspan="2" style="width: 151px">
                        </td>
                        <td class="bg" style="width:  175px">
                            身長 TINGGI BADAN
                        </td>
                        <td style="width: 100px">
                            {{ $cv->tinggi_badan }}
                        </td>
                        <td style="width: ">
                            CM
                        </td>
                    </tr>
                    <tr>
                        <td class="bg">
                            体重 BERAT BADAN
                        </td>
                        <td>
                            {{ $cv->berat_badan }}
                        </td>
                        <td>
                            KG
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center bg">名前 NAMA</td>
                        <td class="bg">靴サイズ UKURAN SEPATU </td>
                        <td>{{ $cv->ukuran_sepatu }}</td>
                        <td>
                            CM
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">KATAKANA</td>
                        <td class="bg">ウェスト LINGKAR PINGGANG</td>
                        <td>{{ $cv->ukuran_pinggang }}</td>
                        <td>
                            CM
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">ROMAJI</td>
                        <td class="bg">血液型 GOLONGAN DARAH </td>
                        <td>{{ $cv->golongan_darah }}</td>
                        <td>
                            型
                        </td>
                    </tr>

                </table>
                <table style="width: 642px">
                    <tr>
                        <td class="text-center bg" style="width: 380px">生年月日　TANGGAL LAHIR</td>
                        <td class="bg" style="width: 180px">視力 PENGLIHATAN</td>
                        <td style="width: 30px">右</td>
                        <td style="width: 30px"></td>
                        <td style="width: 30px">左</td>
                        <td style="width: 30px"></td>
                    </tr>
                </table>
                <table style="width: 642px">
                    <tr>
                        <td class="text-center" style="width: 351px"> {{ $cv->tempat_tanggal_lahir }}</td>
                        <td class="bg" style=" width:175px">配偶者 STATUS PERNIKAHAN </td>
                        <td>{{ $cv->status_perkawinan }}</td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 351px"> 出身地　 TEMPAT LAHIR</td>
                        <td class="bg" style=" width:175px">宗教 AGAMA </td>
                        <td> {{ $cv->agama }}）</td>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 351px">{{ $cv->tempat_lahir }}</td>
                        <td class="bg" style=" width:175px">訪日経験 PERNAH KE JEPANG</td>
                        <td> </td>
                    </tr>
                </table>
                <table style="width: 642px">
                    <tr>
                        <td class="bg" style="width: 120px">年齢　USIA</td>
                        <td style="width: 129px">{{ $cv->usia }}</td>
                        <td style="width: 102px">歳</td>
                        <td class="bg" style="width: 175px;">旅券の有無 PERNAH MEMILIKI PASPOR</td>
                        <td>TIDAK (無）</td>
                    </tr>
                </table>
                <table style="width: 642px">
                    <tr>
                        <td class="bg" style="width: 120px">性別 JENIS KELAMIN</td>
                        <td style="width: 231px">{{ $cv->jenis_kelamin }}</td>
                        <td class="bg" style="width: 175px">利き手 TANGAN AHLI</td>
                        <td> {{ $cv->tangan_dominan }}</td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="text-center align-middle bg">携帯電話番号 NO HP</td>
                        <td rowspan="4 " class="text-left align-middle">(+62)</td>
                        <td class="bg">病歴の有無 RIWAYAT PENYAKIT</td>
                        <td>{{ $cv->penyakit_cedera_masa_lalu }}</td>
                    </tr>
                    <tr>
                        <td class="bg">タバコ MEROKOK</td>
                        <td>{{ $cv->merokok }}</td>
                    </tr>
                    <tr>
                        <td class="bg"> 飲酒 MINUM ALKOHOL</td>
                        <td>{{ $cv->minum_alkohol }}</td>
                    </tr>
                </table>
            </div>
        </div>
        {{-- informasi bawah --}}


        <div>
            <table style="width: 837px">
                <tr class="text-center">
                    <td class="bg">現住所　ALAMAT RUMAH</td>
                </tr>
                <tr class="text-center">
                    <td>{{ $cv->alamat_lengkap }}
                    </td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr class="text-center">
                    <td class="bg">緊急時の連絡先 Informasi Kontak Darurat</td>
                    <td>電話番号　： {{ $cv->no_telepon }})</td>
                    <td class="bg" style="width: 243px"></td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr class="text-center">
                    <td colspan="3" class="bg">学歴 PENDIDIKAN</td>
                </tr>
                <tr class="text-center bg">
                    <td>期間 TAHUN</td>
                    <td>学校名 NAMA SEKOLAH</td>
                    <td>専攻 JURUSAN</td>
                </tr>
            </table>
            <table style="width: 837px">
                @foreach ($cv->pendidikans as $p)
                    <tr class="text-center">
                        <td style="width:70px">{{ $p->tahun }}</td>
                        <td style="width:70px">-</td>
                        <td style="width:69px">20XX年X月</td>
                        <td style="width: 383px">{{ $p->nama }}</td>
                        <td>{{ $p->jurusan }}</td>
                    </tr>
                @endforeach
                <tr class="text-center">
                    <td style="width:70px">20XX年X月</td>
                    <td style="width:70px">-</td>
                    <td style="width:69px">20XX年X月</td>
                    <td style="width: 383px"></td>
                    <td></td>
                </tr>
                <tr class="text-center">
                    <td style="width:70px">20XX年X月</td>
                    <td style="width:70px">-</td>
                    <td style="width:69px">20XX年X月</td>
                    <td style="width: 383px"></td>
                    <td></td>
                </tr>
            </table>

            {{-- pengalaman kerja --}}
            <table style="width: 837px">
                <tr class="text-center">
                    <td colspan="4" class="bg">職歴 PENGALAMAN KERJA</td>
                </tr>
                <tr class="text-center bg">
                    <td style="width: 209px">期間 TAHUN</td>
                    <td style="width: 383px">会社名 NAMA PERUSAHAAN</td>
                    <td style="width: 122px">職種 JENIS KERJA</td>
                    <td style="width: ">月収/円 GAJI</td>
                </tr>
            </table>
            <table style="width: 837px">
                @foreach ($cv->pengalamans as $p)
                    <tr class="text-center">
                        <td style="width:70px">20XX年X月</td>
                        <td style="width:70px">-</td>
                        <td style="width:69px">20XX年X月</td>
                        <td style="width: 383px">{{ $p->perusahaan }}</td>
                        <td style="width: 122px"></td>
                        <td> {{ $p->gaji }}</td>
                    </tr>
                @endforeach
                <tr class="text-center">
                    <td style="width:70px">20XX年X月</td>
                    <td style="width:70px">-</td>
                    <td style="width:69px">20XX年X月</td>
                    <td style="width: 383px"></td>
                    <td></td>
                    <td> </td>
                </tr>
                <tr class="text-center">
                    <td style="width:70px">20XX年X月</td>
                    <td style="width:70px">-</td>
                    <td style="width:69px">20XX年X月</td>
                    <td style="width: 383px"></td>
                    <td></td>
                    <td> </td>
                </tr>
            </table>

            {{-- keluarga --}}
            <table style="width: 837px">
                <tr class="text-center">
                    <td colspan="5" class="bg">家族構成 SUSUNAN KELUARGA KANDUNG</td>
                </tr>
                <tr class="text-center bg">
                    <td style="width: 209px">続柄 URUTAN KELUARGA</td>
                    <td style="width: 383px">名前 NAMA ANGGOTA KELUARGA</td>
                    <td>年齢 USIA</td>
                    <td>職業 PEKERJAAN</td>
                    <td>月収/円 GAJI</td>
                </tr>
                <tr>
                    <td>AYAH （父）</td>
                    <td>{{ $cv->anggota_keluarga_ayah }}</td>
                    <td>歳</td>
                    <td>PEGAWAI PERUSAHAAN 会社員</td>
                    <td> ¥</td>
                </tr>
                <tr>
                    <td>IBU （母）</td>
                    <td>{{ $cv->anggota_keluarga_ibu }}</td>
                    <td>歳</td>
                    <td>PEGAWAI PERUSAHAAN 会社員</td>
                    <td> ¥</td>
                </tr>
                <tr>
                    <td>KAKAK LAKI-LAKI （兄）</td>
                    <td>{{ $cv->anggota_keluarga_kakak }}</td>
                    <td>歳</td>
                    <td>PEGAWAI PERUSAHAAN 会社員</td>
                    <td> ¥</td>
                </tr>
                <tr>
                    <td>KAKAK PEREMPUAN （姉）</td>
                    <td>{{ $cv->anggota_keluarga_kakak }}</td>
                    <td>歳</td>
                    <td>PEGAWAI PERUSAHAAN 会社員</td>
                    <td> ¥</td>
                </tr>
                <tr>
                    <td>ADIK LAKI-LAKI （弟）</td>
                    <td>{{ $cv->anggota_keluarga_adik }}</td>
                    <td>歳</td>
                    <td>PEGAWAI PERUSAHAAN 会社員</td>
                    <td> ¥</td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr>
                    <td colspan="2" style="text-align: center" class="bg">個人情報　INFORMASI PERSONAL</td>
                </tr>
                <tr>
                    <td class="bg" style="width: 209px">自己ＰＲ　PROMOSI DIRI</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg">日本へ行く目的　TUJUAN KE JEPANG</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg"> 帰国後の目標　 <br>
                        TUJUAN SETELAH PULANG DARI JEPANG</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bg">
                        長所　KELEBIHAN
                    </td>
                    <td>{{ $cv->kelebihan_diri }}</td>
                </tr>
                <tr>
                    <td class="bg">
                        短所　KEKURANGAN
                    </td>
                    <td>{{ $cv->kekurangan_diri }}</td>
                </tr>
                <tr>
                    <td class="bg">
                        特技 KEHALIAN KHUSUS
                    </td>
                    <td>{{ $cv->keahlian_khusus }}</td>
                </tr>
                <tr>
                    <td class="bg">
                        趣味　HOBI
                    </td>
                    <td>{{ $cv->hobi }}</td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr>
                    <td colspan="7" class="text-center bg">面鏡・資格　SERTIFIKAT YANG DIMILIKI</td>
                </tr>
                <tr>
                    <td class="bg" style="width: 104px">日本語能力試験 <br> JLPT/ SETARA</td>
                    <td style="width: 105px">ADA (有）</td>
                    <td>JFT A2</td>
                    <td class="bg"> 運転免許　SURAT IZIN <br> {{ $cv->jenis_sim }}
                    </td>
                    <td>{{ $cv->surat_izin_mengemudi }}</td>
                    <td class="bg"> 他　LAIN - LAIN</td>
                    <td>{{ $cv->bidang_sertifikasi }}</td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr>
                    <td colspan="7" class="text-center bg">在日親戚・知人　KERABAT / KENALAN DI JEPANG</td>
                </tr>
                <tr class="bg">
                    <td style="width: 209px">名前 NAMA</td>
                    <td>関係　HUBUNGAN</td>
                    <td>職業 PEKERJAAN</td>
                    <td>年齢 USIA</td>
                    <td>日本の住所 ALAMAT DI JEPANG</td>
                </tr>
                <tr>
                    <td style="width: 209px">SISKA PANGANDARAN</td>
                    <td>KAKAK PEREMPUAN （姉）</td>
                    <td>客室乗務員</td>
                    <td>28歳</td>
                    <td>千葉県、本三里塚、光が丘　１１４０</td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr>
                    <td colspan="" class="text-center bg">付記　CATATAN TAMBAHAN</td>
                </tr>
                <tr>
                    <td style="text-align: center">魚介類アレルギー ALERGI TERHADAP SEAFOOD</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>

            </table>

        </div>
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
