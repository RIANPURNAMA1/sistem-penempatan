<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>履歴書</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
            background: #f5f5f5;
        }

        .cv-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .left-section {
            flex: 1;
        }

        .right-section {
            width: 250px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            margin-bottom: 1rem;
        }

        th, td {
            border: 1px solid #000;
            padding: 0.5rem;
            text-align: left;
        }

        th {
            background: #e0e0e0;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .photo-box {
            position: relative;
            margin-bottom: 1rem;
        }

        .photo-table {
            height: 200px;
            width: 140px;
            border: 3px solid #000;
        }

        .photo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-label {
            position: absolute;
            top: -1rem;
            right: -3rem;
            font-size: 2rem;
            font-weight: bold;
        }

        .section-title {
            background: #d0d0d0;
            text-align: center;
            padding: 0.5rem;
        }

        .no-border-top {
            border-top: none !important;
        }

        .no-border-bottom {
            border-bottom: none !important;
        }

        .height-20 {
            height: 20px;
        }

        .height-50 {
            height: 50px;
        }

        .height-60 {
            height: 60px;
        }

        .height-100 {
            height: 100px;
        }

        .height-150 {
            height: 150px;
        }

        .height-200 {
            height: 200px;
        }

        .flex-container {
            display: flex;
        }

        .editable-cell {
            min-height: 20px;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .btn-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="btn-container mb-3">
        <button class="btn btn-success" onclick="window.print()">印刷</button>
        <button class="btn btn-primary" onclick="downloadPDF()">PDF保存</button>
        <a href="/data/cv/kandidat" class="btn btn-info">戻る</a>
    </div>

    <div class="cv-container">
        <!-- SECTION KIRI -->
        <div class="left-section">
            <!-- Header Table -->
            <table>
                <thead>
                    <tr>
                        <th>姓</th>
                        <th>名</th>
                        <th class="no-border-bottom">写真</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-top: 2rem">{{ $cv->nama_lengkap_katakana }}</td>
                        <td></td>
                        <td class="no-border-top no-border-bottom">4x3</td>
                    </tr>
                    <tr>
                        <td class="text-center">{{ $cv->nama_lengkap_romaji }}</td>
                        <td class="text-center"></td>
                        <td class="no-border-top no-border-bottom"></td>
                    </tr>
                    <tr>
                        <td class="height-20"></td>
                        <td></td>
                        <td class="no-border-top no-border-bottom"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Informasi Pribadi -->
            <table>
                <tr>
                    <th style="padding: 1rem">生年月日</th>
                    <th colspan="4" style="width: 364px">{{ $cv->tempat_tanggal_lahir }} ({{ $cv->usia }}歳)</th>
                </tr>
            </table>

            <!-- Alamat -->
            <table>
                <tr>
                    <th class="text-left">現住所</th>
                </tr>
                <tr>
                    <td class="height-60">{{ $cv->alamat_lengkap }}</td>
                </tr>
            </table>

            <!-- Riwayat Pendidikan -->
            <table>
                <tr>
                    <th colspan="3" class="section-title">学歴</th>
                </tr>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>年月</th>
                        <th>学校名</th>
                        <th>学部等</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>小学校卒業</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>中学校卒業</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>高等学校卒業</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- Riwayat Pekerjaan -->
            <table>
                <tr>
                    <th colspan="3" class="section-title">職歴</th>
                </tr>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>年月</th>
                        <th>会社名</th>
                        <th>職種</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- Status Keluarga -->
            <table>
                <tr>
                    <th>配偶者の有無</th>
                    <th>子供</th>
                </tr>
                <tr>
                    <td>{{ $cv->status_perkawinan }}</td>
                    <td>{{ $cv->anggota_keluarga_anak ?? 'なし' }}</td>
                </tr>
            </table>

            <!-- Kemampuan -->
            <table>
                <tr>
                    <th colspan="4" class="section-title">能力</th>
                </tr>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td>日本語</td>
                        <td>{{ $cv->kemampuan_bahasa_jepang ?? '' }}</td>
                        <td>忍耐力</td>
                        <td>{{ $cv->kemampuan_pemahaman_ssw ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>理解力</td>
                        <td>{{ $cv->kelincahan_dalam_bekerja ?? '' }}</td>
                        <td>行動力</td>
                        <td>{{ $cv->kekuatan_tindakan ?? '' }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Informasi Tambahan -->
            <table>
                <tbody>
                    <tr>
                        <td style="padding: 5px">趣味</td>
                        <td style="width: 394px">{{ $cv->hobi }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Periode Belajar -->
            <table>
                <thead>
                    <tr>
                        <th>日本語学習期間</th>
                        <th>英語力</th>
                    </tr>
                    <tr>
                        <td>{{ $cv->lama_belajar_di_mendunia }}</td>
                        <td>{{ $cv->kemampuan_berbahasa_inggris ?? '' }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Kosong -->
            <table>
                <thead>
                    <tr>
                        <th height="20px">宗教</th>
                        <th>{{ $cv->agama }}</th>
                    </tr>
                </thead>
            </table>

            <!-- Informasi Lain -->
            <table>
                <thead>
                    <tr>
                        <th height="20px">興味・関心</th>
                        <th>特技</th>
                    </tr>
                    <tr>
                        <td class="height-50">{{ $cv->ketertarikan_terhadap_jepang }}</td>
                        <td>{{ $cv->keahlian_khusus }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Kelebihan -->
            <table>
                <thead>
                    <tr>
                        <th height="20px">長所</th>
                    </tr>
                    <tr>
                        <td class="height-150" style="vertical-align: top; padding: 10px;">{{ $cv->kelebihan_diri }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Kekurangan -->
            <table>
                <thead>
                    <tr>
                        <th height="20px">短所</th>
                    </tr>
                    <tr>
                        <td class="height-100" style="vertical-align: top; padding: 10px;">{{ $cv->kekurangan_diri }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Catatan -->
            <table>
                <thead>
                    <tr>
                        <th height="20px">メモ</th>
                    </tr>
                    <tr>
                        <td class="height-200" style="vertical-align: top; padding: 10px;">{{ $cv->point_plus_diri }}</td>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- SECTION KANAN -->
        <div class="right-section">
            <!-- Foto & No -->
            <div class="photo-box">
                <table class="photo-table">
                    <thead>
                        <tr>
                            <th class="text-center">
                                {{ $cv->pas_foto ? '' : '写真' }}
                                @if($cv->pas_foto)
                                <img src="{{ asset('storage/' . $cv->pas_foto) }}" alt="Photo" class="photo-img">
                                @endif
                            </th>
                        </tr>
                    </thead>
                </table>
                <h1 class="no-label">{{ $cv->id }}</h1>
            </div>

            <!-- Golongan Darah & Penglihatan -->
            <table>
                <thead>
                    <tr>
                        <th>血液型</th>
                        <th>視力</th>
                    </tr>
                    <tr>
                        <td class="height-60 text-center">{{ $cv->golongan_darah }}</td>
                        <td class="text-center">{{ $cv->kemampuan_penglihatan_mata }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Tinggi & Berat -->
            <table>
                <thead>
                    <tr>
                        <th>身長</th>
                        <th>体重</th>
                    </tr>
                    <tr>
                        <td class="height-60 text-center">{{ $cv->tinggi_badan }}cm</td>
                        <td class="text-center">{{ $cv->berat_badan }}kg</td>
                    </tr>
                </thead>
            </table>

            <!-- Tangan Dominan -->
            <table>
                <thead>
                    <tr>
                        <th colspan="2">利き手</th>
                    </tr>
                    <tr>
                        <td class="height-60 text-center" colspan="2">{{ $cv->tangan_dominan }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Ukuran Sepatu -->
            <table>
                <thead>
                    <tr>
                        <th colspan="2">靴</th>
                    </tr>
                    <tr>
                        <td class="height-60 text-center">{{ $cv->ukuran_sepatu }}cm</td>
                    </tr>
                </thead>
            </table>

            <!-- Ukuran Pakaian -->
            <table>
                <thead>
                    <tr>
                        <th colspan="2">服サイズ</th>
                    </tr>
                    <tr>
                        <td class="height-60 text-center">{{ $cv->ukuran_atasan_baju }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Status -->
            <table>
                <thead>
                    <tr>
                        <th>タバコ</th>
                        <th>飲酒</th>
                    </tr>
                    <tr>
                        <td class="height-60 text-center">{{ $cv->merokok == 'Ya' ? 'はい' : 'いいえ' }}</td>
                        <td class="text-center">{{ $cv->minum_alkohol == 'Ya' ? 'はい' : 'いいえ' }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Ukuran Lengkap -->
            <table>
                <thead>
                    <tr>
                        <td style="height: 40px" class="text-center">腰</td>
                        <td class="text-center">{{ $cv->ukuran_pinggang }}cm</td>
                        <td class="text-center">胸</td>
                        <td class="text-center">cm</td>
                    </tr>
                </thead>
            </table>

            <!-- Detail Ukuran -->
            <table>
                <thead>
                    <tr>
                        <td style="height: 40px" class="text-center">肩</td>
                        <td class="text-center">cm</td>
                        <td class="text-center">腕</td>
                        <td class="text-center">cm</td>
                    </tr>
                </thead>
            </table>

            <!-- Ukuran dengan Border Custom -->
            <table>
                <thead>
                    <tr>
                        <td style="height: 40px" class="text-center no-border-bottom">ズボン丈</td>
                        <td class="text-center">{{ $cv->ukuran_celana }}</td>
                        <td class="text-center">ヒップ</td>
                        <td class="text-center no-border-bottom"></td>
                        <td class="text-center no-border-bottom">cm</td>
                    </tr>
                    <tr>
                        <td style="height: 40px" class="text-center no-border-top"></td>
                        <td class="text-center">cm</td>
                        <td class="text-center">足回り</td>
                        <td class="text-center no-border-top">cm</td>
                        <td class="text-center no-border-top"></td>
                    </tr>
                </thead>
            </table>

            <!-- SIM -->
            <table>
                <thead>
                    <tr>
                        <td colspan="4" class="text-center">免許</td>
                    </tr>
                    <tr>
                        <td class="text-center">種類</td>
                        <td class="text-center">{{ $cv->surat_izin_mengemudi == 'Ada' ? $cv->jenis_sim : 'なし' }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Kemampuan Fisik -->
            <table>
                <thead>
                    <tr>
                        <td class="text-center">腕立</td>
                        <td class="text-center">回</td>
                        <td class="text-center">スクワット</td>
                        <td class="text-center">回</td>
                    </tr>
                    <tr>
                        <td class="text-center">腹筋</td>
                        <td class="text-center">回</td>
                        <td class="text-center">走り</td>
                        <td class="text-center">分</td>
                    </tr>
                    <tr>
                        <td class="text-center">懸垂</td>
                        <td class="text-center">回</td>
                        <td class="text-center">その他</td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
            </table>

            <!-- Ibadah -->
            <table>
                <thead>
                    <tr>
                        <td class="text-center">お祈り</td>
                        <td class="text-center">{{ $cv->agama == 'Islam' ? '5回/日' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">断食</td>
                        <td class="text-center">{{ $cv->agama == 'Islam' ? 'はい' : '' }}</td>
                    </tr>
                    <tr>
                        <td class="text-center">コーラン</td>
                        <td class="text-center">{{ $cv->agama == 'Islam' ? '読める' : '' }}</td>
                    </tr>
                </thead>
            </table>

            <!-- Keterangan Khusus -->
            <div class="flex-container">
                <table style="height: 100px; width: 50px;">
                    <thead>
                        <td class="text-center">特記</td>
                    </thead>
                </table>
                <table style="width: 170px">
                    <thead>
                        <tr>
                            <td class="text-center">タトゥー: {{ $cv->bertato }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">ワクチン: {{ $cv->sudah_vaksin_berapa_kali }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">期間: {{ $cv->ingin_bekerja_berapa_tahun }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function downloadPDF() {
            const container = document.querySelector('.cv-container');
            html2canvas(container, { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('履歴書_{{ $cv->nama_lengkap_romaji }}.pdf');
            });
        }
    </script>
</body>
</html>