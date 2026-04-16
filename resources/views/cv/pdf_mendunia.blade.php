<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CV {{ $cv->nama_lengkap_romaji }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 10px;
            font-size: 10px;
        }

        .cv-container {
            width: 100%;
            padding: 10px;
            margin: 0 auto;
            max-width: 900px;
        }

        .bg {
            background-color: #a5bfdf;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        table td,
        table th {
            padding: 3px 5px;
            vertical-align: middle;
            border: 1px solid;
            font-size: 10px;
        }

        .section-title {
            font-size: 10px;
            text-align: center;
        }

        .small-text {
            font-size: 10px;
        }

        .label-text {
            font-size: 10px;
        }

        .value-text {
            font-size: 10px;
        }

        /* Hanya untuk print */
        @media print {
            .btn-container {
                display: none !important;
            }

            body {
                font-weight: 500 !important;
            }

            @page {
                margin: 10mm;
            }
        }

        /* Hapus header/footer saat print */
        @page {
            margin: 10mm;
            size: auto;
        }
    </style>
    <style>
        .cv-table {
            width: 641px;
            border-collapse: collapse;
            /* Membuat garis antar sel menyatu (tidak double) */
            font-family: Arial, sans-serif;
            font-size: 10px;
            table-layout: fixed;
            /* Menjaga lebar kolom tetap konsisten */
        }

        .cv-table td {
            border: 1px solid black;
            border-bottom: none;
            padding: 4px;
            vertical-align: middle;
        }

        .table-alamat td {
            border-bottom: none;
        }

        .table-alamat2 td {
            border-top: none;
        }


        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .align-middle {
            vertical-align: middle;
        }

        /* Utility untuk menyembunyikan border atas jika diperlukan */
        .no-border-top {
            border-top: none !important;
        }

        /* Header title area */
        .header-title-area {
            text-align: center;
            margin-bottom: 2px;
        }

        .riwayat-hidup {
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .jisshusei-karekisho {
            font-size: 10px;
            letter-spacing: 1px;
        }
    </style>
</head>

<body class="container2">
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
    <div class="cv-container ">
        <div class="header-title-area" style="flex: 1; text-align: center; padding-top: 1px;">
            <div class="riwayat-hidup">RIWAYAT HIDUP</div>
            <div class="jisshusei-karekisho">実習生経歴書</div>
        </div>
        <img src="{{ asset('assets/compiled/png/LOGO/logo.png') }}" style="width: 180px" alt="">
        <div class="d-flex">
            <div class="p-2 mt-5">
                <img src="{{ asset($cv->pas_foto_cv) }}" alt="Pas Foto"
                    style="
                    width: 180px; /* Agar gambar mengisi penuh lebar sel */
                    height: 270px; /* Agar gambar mengisi penuh tinggi sel */
                    display: block; /* Penting: Menghapus spasi ekstra di bawah gambar */
                    object-fit: cover; /* Opsional: Memastikan gambar menutupi area tanpa terdistorsi */
                ">
            </div>

            <div>
                {{-- <style>
                    .cv-table {
                        width: 100%;
                        border-collapse: collapse;
                        table-layout: fixed;
                        /* Memaksa kolom mengikuti lebar yang ditentukan */
                        font-family: Arial, sans-serif;
                    }

                    .cv-table td {
                        border: 1px solid black;
                        padding: 5px;
                        vertical-align: middle;
                    }

                    .text-center {
                        text-align: center;
                    }
                </style> --}}

                <table class="cv-table">
                    <tr>
                        <td class="bg text-center" rowspan="2" style="width: 120px;">実習生 NOMOR</td>
                        <td rowspan="2" style="width: 150px;"></td>
                        <td class="bg" style="width: 160px;">身長 TINGGI BADAN</td>
                        <td class="text-center" colspan="2">{{ $cv->tinggi_badan }}</td>
                        <td class="text-center" colspan="2">CM</td>
                    </tr>
                    <tr>
                        <td class="bg">体重 BERAT BADAN</td>
                        <td class="text-center" colspan="2">{{ $cv->berat_badan }}</td>
                        <td class="text-center" colspan="2">KG</td>
                    </tr>

                    <tr>
                        <td colspan="2" class="bg text-center">名前 NAMA</td>
                        <td class="bg">靴サイズ UKURAN SEPATU</td>
                        <td class="text-center" colspan="2">{{ $cv->ukuran_sepatu }}</td>
                        <td class="text-center" colspan="2">CM</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">{{ $cv->nama_lengkap_katakana }}</td>
                        <td class="bg">ウェスト LINGKAR PINGGANG</td>
                        <td class="text-center" colspan="2">{{ $cv->ukuran_pinggang }}</td>
                        <td class="text-center" colspan="2">CM</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">{{ $cv->nama_lengkap_romaji }}</td>
                        <td class="bg">血液型 GOLONGAN DARAH</td>
                        <td class="text-center" colspan="2">{{ $cv->golongan_darah }}</td>
                        <td class="text-center" colspan="2">型</td>
                    </tr>

                    <tr>
                        <td class="bg text-center" colspan="2">生年月日 TANGGAL LAHIR</td>
                        <td class="bg">視力 PENGLIHATAN</td>
                        <td class="text-center" style="width: 30px;">右</td>
                        <td class="text-center" style="width: 55px;">{{ $cv->kemampuan_penglihatan_mata }}</td>
                        <td class="text-center" style="width: 30px;">左</td>
                        <td class="text-center" style="width: 55px;">{{ $cv->kemampuan_penglihatan_mata }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            {{ \Carbon\Carbon::parse($cv->tanggal_lahir)->isoFormat('YYYY年 MM月 DD日') }}
                        </td>
                        <td class="bg">配偶者 STATUS PERNIKAHAN</td>
                        <td colspan="4" class="text-center">
                            {{ $cv->status_perkawinan }}
                            @if ($cv->status_perkawinan == 'Sudah Menikah')
                                （結婚）
                            @elseif($cv->status_perkawinan == 'Belum Menikah')
                                （未婚）
                            @elseif($cv->status_perkawinan == 'Bercerai')
                                （離婚）
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="bg text-center" colspan="2">出身地 TEMPAT LAHIR</td>
                        <td class="bg">宗教 AGAMA</td>
                        <td colspan="4" class="text-center">
                            @php
                                $mappingAgama = [
                                    'Islam' => 'イスラム',
                                    'Kristen' => 'キリスト',
                                    'Katolik' => 'カトリック',
                                    'Hindu' => 'ヒンドゥー',
                                    'Buddha' => '仏教',
                                    'Konghucu' => '儒教',
                                ];
                            @endphp

                            {{ $cv->agama }} （{{ $mappingAgama[$cv->agama] ?? '-' }}）
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">{{ $cv->tempat_lahir }}</td>
                        <td class="bg">訪日経験 PERNAH KE JEPANG</td>
                        <td colspan="4" class="text-center">Tidak （無）</td>
                    </tr>

                    <tr>
                        <td class="bg text-center">年齢 USIA</td>
                        <td class="text-center">{{ $cv->usia }} 歳</td>
                        <td class="bg">旅券の有無 PASPOR</td>
                        <td colspan="4" class="text-center">TIDAK (無)</td>
                    </tr>

                    <tr>
                        <td class="bg text-center">性別 JENIS KELAMIN</td>
                        <td class="text-center">
                            {{ $cv->jenis_kelamin }} （{{ $cv->jenis_kelamin == 'Laki-laki' ? '男' : '女' }}）
                        </td>
                        <td class="bg">利き手 TANGAN DOMINAN</td>
                        <td colspan="4" class="text-center">
                            {{ $cv->tangan_dominan }} （{{ $cv->tangan_dominan == 'Kanan' ? '右' : '左' }}）
                        </td>
                    </tr>

                    <tr>
                        <td class="bg text-center" rowspan="3">携帯電話番号 NO HP</td>
                        <td rowspan="3" class="text-center">(+62) {{ $cv->no_telepon }}</td>
                        <td class="bg">病歴 RIWAYAT PENYAKIT</td>
                        <td colspan="4" class="text-center">
                            {{ $cv->penyakit_cedera_masa_lalu ?? 'Tidak Ada' }}
                            （{{ $cv->penyakit_cedera_masa_lalu && $cv->penyakit_cedera_masa_lalu != 'Tidak Ada' ? '有' : '無' }}）
                        </td>
                    </tr>
                    <tr>
                        <td class="bg">タバコ MEROKOK</td>
                        <td colspan="4" class="text-center">
                            {{ $cv->merokok }}
                            （{{ $cv->merokok == 'Iya' ? '有' : '無' }}）
                        </td>
                    </tr>
                    <tr>
                        <td class="bg">飲酒 MINUM ALKOHOL</td>
                        <td colspan="4" class="text-center">
                            {{ $cv->minum_alkohol }}
                            （{{ $cv->minum_alkohol == 'Iya' ? '有' : '無' }}）
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{-- informasi bawah --}}


        <div>
            <table class="table-alamat" style="width: 837px;">
                <tr class="text-center">
                    <td class="bg section-title">現住所　ALAMAT RUMAH</td>
                </tr>
                <tr class="text-center">
                    <td class="value-text">{{ $cv->alamat_lengkap }}
                    </td>
                </tr>
            </table>
            <table class="table-alamat" style="width: 837px">
                <tr class="text-center">
                    <td class="bg label-text">緊急時の連絡先 Informasi Kontak Darurat</td>
                    <td class="value-text">電話番号　： {{ $cv->no_telepon }}</td>
                    <td class="bg" style="width: 243px"></td>
                </tr>
            </table>
            <table class="table-alamat" style="width: 837px">
                <tr class="text-center">
                    <td colspan="3" class="bg section-title">学歴 PENDIDIKAN</td>
                </tr>
                <tr class="text-center bg">
                    <td class="small-text" style="width:212px">期間 TAHUN</td>
                    <td class="small-text" style="width: 383px">学校名 NAMA SEKOLAH</td>
                    <td class="small-text">専攻 JURUSAN</td>
                </tr>
            </table>
            <table class="table-alamat" style="width: 837px">
                @foreach ($cv->pendidikans as $p)
                    <tr class="text-center">
                        <td class="small-text" style="width:96px">
                            {{ \Carbon\Carbon::parse($p->tahun_masuk)->format('Y年 m月') }}
                        </td>
                        <td class="small-text" style="width:20px">-</td>
                        <td class="small-text" style="width:96px">
                            {{ \Carbon\Carbon::parse($p->tahun_lulus)->format('Y年 m月') }}
                        </td>
                        <td class="value-text" style="width: 383px">{{ $p->nama }}</td>
                        <td class="value-text">{{ $p->jurusan }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="height: 20px">
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

            {{-- pengalaman kerja --}}
            <table class="table-alamat" style="width: 837px">
                <tr class="text-center">
                    <td colspan="4" class="bg section-title">職歴 PENGALAMAN KERJA</td>
                </tr>
                <tr class="text-center bg">
                    <td class="small-text" style="width: 209px">期間 TAHUN</td>
                    <td class="small-text" style="width: 383px">会社名 NAMA PERUSAHAAN</td>
                    <td class="small-text" style="width: 122px">職種 JENIS KERJA</td>
                    <td class="small-text">月収/円 GAJI</td>
                </tr>
            </table>
            <table class="table-alamat" style="width: 837px">
                @foreach ($cv->pengalamans as $p)
                    <tr class="text-center">
                        <td class="small-text" style="width:95px">
                            {{ date('Y', strtotime($p->tanggal_masuk)) }} 年
                            {{ date('m', strtotime($p->tanggal_masuk)) }} 月
                        </td>
                        <td class="small-text" style="width:20px">-</td>
                        <td class="small-text" style="width:94px">
                            @if ($p->tanggal_keluar)
                                {{ date('Y', strtotime($p->tanggal_keluar)) }} 年
                                {{ date('m', strtotime($p->tanggal_keluar)) }} 月
                            @else
                                現在
                            @endif
                        </td>
                        <td class="value-text" style="width: 383px">{{ $p->perusahaan }}</td>
                        <td class="value-text" style="width: 122px">{{ $p->jabatan }}</td>
                        <td class="value-text">{{ $p->gaji }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="height: 20px"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            {{-- keluarga --}}
     {{-- keluarga --}}
<table class="table-alamat" style="width: 837px">
    <tr class="text-center">
        <td colspan="5" class="bg section-title">家族構成 SUSUNAN KELUARGA KANDUNG</td>
    </tr>
    <tr class="text-center bg">
        <td class="small-text" style="width: 209px">続柄 URUTAN KELUARGA</td>
        <td class="small-text" style="width: 383px">名前 NAMA ANGGOTA KELUARGA</td>
        <td class="small-text">年齢 USIA</td>
        <td class="small-text">職業 PEKERJAAN</td>
        <td class="small-text">月収/円 GAJI</td>
    </tr>
    
    {{-- Ayah --}}
    <tr>
        <td class="label-text">AYAH （父）</td>
        <td class="value-text">{{ (blank($cv->ayah_nama) || $cv->ayah_nama == 'なし') ? 'なし' : $cv->ayah_nama }}</td>
        <td class="value-text">{{ (blank($cv->ayah_usia) || $cv->ayah_usia == 'なし') ? 'なし' : $cv->ayah_usia }}</td>
        <td class="value-text">{{ (blank($cv->ayah_pekerjaan) || $cv->ayah_pekerjaan == 'なし') ? 'なし' : $cv->ayah_pekerjaan }}</td>
        <td class="value-text">
            {{ (blank($cv->ayah_gaji) || $cv->ayah_gaji == 'なし' || $cv->ayah_gaji == 0) ? 'なし' : $cv->ayah_gaji . ' ¥' }}
        </td>
    </tr>

    {{-- Ibu --}}
    <tr>
        <td class="label-text">IBU （母）</td>
        <td class="value-text">{{ (blank($cv->ibu_nama) || $cv->ibu_nama == 'なし') ? 'なし' : $cv->ibu_nama }}</td>
        <td class="value-text">{{ (blank($cv->ibu_usia) || $cv->ibu_usia == 'なし') ? 'なし' : $cv->ibu_usia }}</td>
        <td class="value-text">{{ (blank($cv->ibu_pekerjaan) || $cv->ibu_pekerjaan == 'なし') ? 'なし' : $cv->ibu_pekerjaan }}</td>
        <td class="value-text">
            {{ (blank($cv->ibu_gaji) || $cv->ibu_gaji == 'なし' || $cv->ibu_gaji == 0) ? 'なし' : $cv->ibu_gaji . ' ¥' }}
        </td>
    </tr>

    {{-- Kakak: Sembunyikan jika kosong/"なし" --}}
    @if(!blank($cv->kakak_nama) && $cv->kakak_nama != 'なし')
    <tr>
        <td class="label-text">KAKAK（兄）</td>
        <td class="value-text">{{ $cv->kakak_nama }}</td>
        <td class="value-text">{{ $cv->kakak_usia ?? 'なし' }}</td>
        <td class="value-text">{{ $cv->kakak_pekerjaan ?? 'なし' }}</td>
        <td class="value-text">
            {{ (blank($cv->kakak_gaji) || $cv->kakak_gaji == 'なし' || $cv->kakak_gaji == 0) ? 'なし' : $cv->kakak_gaji . ' ¥' }}
        </td>
    </tr>
    @endif

    {{-- Adik: Sembunyikan jika kosong/"なし" --}}
    @if(!blank($cv->adik_nama) && $cv->adik_nama != 'なし')
    <tr>
        <td class="label-text">ADIK LAKI-LAKI （弟）</td>
        <td class="value-text">{{ $cv->adik_nama }}</td>
        <td class="value-text">{{ $cv->adik_usia ?? 'なし' }}</td>
        <td class="value-text">{{ $cv->adik_pekerjaan ?? 'なし' }}</td>
        <td class="value-text">
            {{ (blank($cv->adik_gaji) || $cv->adik_gaji == 'なし' || $cv->adik_gaji == 0) ? 'なし' : $cv->adik_gaji . ' ¥' }}
        </td>
    </tr>
    @endif

    {{-- Pasangan: Sembunyikan jika kosong/"なし" --}}
    @if(!blank($cv->istri_nama) && $cv->istri_nama != 'なし')
    <tr>
        <td class="label-text">SUAMI / ISTRI（配偶者）</td>
        <td class="value-text">{{ $cv->istri_nama }}</td>
        <td class="value-text">{{ $cv->istri_usia ?? 'なし' }}</td>
        <td class="value-text">{{ $cv->istri_pekerjaan ?? 'なし' }}</td>
        <td class="value-text">
            {{ (blank($cv->istri_gaji) || $cv->istri_gaji == 'なし' || $cv->istri_gaji == 0) ? 'なし' : $cv->istri_gaji . ' ¥' }}
        </td>
    </tr>
    @endif
</table>
            <table class="table-alamat" style="width: 837px">
                <tr>
                    <td colspan="2" class="bg section-title">個人情報　INFORMASI PERSONAL</td>
                </tr>
                <tr>
                    <td class="bg label-text" style="width: 209px">自己ＰＲ　PROMOSI DIRI</td>
                    <td class="value-text">{{ $cv->point_plus_diri }}</td>
                </tr>
                <tr>
                    <td class="bg label-text">日本へ行く目的　TUJUAN KE JEPANG</td>
                    <td class="value-text">{{ $cv->ketertarikan_terhadap_jepang }}</td>
                </tr>
                <tr>
                    <td class="bg label-text"> 回国後の目標　TUJUAN SETELAH PULANG DARI JEPANG</td>
                    <td class="value-text">{{ $cv->tujuanSetelahPulang?->tujuan_setelah_pulang ?: '-' }}</td>
                </tr>
                <tr>
                    <td class="bg label-text">
                        長所　KELEBIHAN
                    </td>
                    <td class="value-text">{{ $cv->kelebihan_diri }}</td>
                </tr>
                <tr>
                    <td class="bg label-text">
                        短所　KEKURANGAN
                    </td>
                    <td class="value-text">{{ $cv->kekurangan_diri }}</td>
                </tr>
                <tr>
                    <td class="bg label-text">
                        特技 KEHALIAN KHUSUS
                    </td>
                    <td class="value-text">{{ $cv->keahlian_khusus }}</td>
                </tr>
                <tr>
                    <td class="bg label-text">
                        趣味　HOBI
                    </td>
                    <td class="value-text">{{ $cv->hobi }}</td>
                </tr>
            </table>
            <table class="table-alamat" style="width: 837px">
                <tr>
                    <td colspan="7" class="text-center bg section-title">面鏡・資格　SERTIFIKAT YANG DIMILIKI</td>
                </tr>
                <tr>
                    <td class="bg label-text" style="width: 104px">日本語能力試験 JLPT/ SETARA</td>
                    <td class="value-text" style="width: 105px">ADA (有）</td>
                    <td class="value-text">JFT A2</td>
                    <td class="bg label-text">
                        <minimax:tool_call> 運転免許　SURAT IZIN <br>
                            MENGEMUDI (SIM A) {{ $cv->jenis_sim }}
                    </td>
                    <td class="value-text">
                        {{ $cv->surat_izin_mengemudi }}
                        （{{ $cv->surat_izin_mengemudi == 'Ada' ? '有' : '無' }}）
                    </td>
                    <td class="bg label-text"> 他　LAIN - LAIN</td>
                    <td class="value-text">
                        @php
                            $mappingSertifikat = [
                                'Pertanian' => '農業',
                                'Kaigo (perawat)' => '介護',
                                'Pengolahan Makanan' => '飲食料品',
                                'Restoran' => '外食業', // Umumnya disebut 外食業 (Gaishokugyo) untuk SSW Restoran
                                'Building Cleaning' => 'ビルクリーニング',
                                'Driver' => '自動車運送業',
                                'Hanya JFT' => '国際交流基金日本語基礎テスト',
                            ];
                        @endphp

                        {{ $cv->bidang_sertifikasi }} （{{ $mappingSertifikat[$cv->bidang_sertifikasi] ?? '-' }}）
                    </td>
                </tr>
            </table>
            <table class="table-alamat" style="width: 837px">
                <tr>
                    <td colspan="5" class="text-center bg section-title">在日親戚・知人　KERABAT / KENALAN DI JEPANG</td>
                </tr>
                <tr class="bg">
                    <td class="small-text" style="width: 209px">名前 NAMA</td>
                    <td class="small-text">関係　HUBUNGAN</td>
                    <td class="small-text">職業 PEKERJAAN</td>
                    <td class="small-text">年齢 USIA</td>
                    <td class="small-text">日本の住所 ALAMAT DI JEPANG</td>
                </tr>
                <tr>
                    <td class="value-text" style="width: 209px; height:25px"></td>
                    <td class="value-text"></td>
                    <td class="value-text"></td>
                    <td class="value-text"></td>
                    <td class="value-text"></td>
                </tr>
            </table>
            <table style="width: 837px">
                <tr>
                    <td colspan="5" class="text-center bg section-title">付記　CATATAN TAMBAHAN</td>
                </tr>
                <tr>
                    <td style="height: 40px"></td>
                </tr>
            </table>

        </div>
        {{-- sertifikat --}}
        <div class=" mt-4">
            <div class="">
                <div class="card-body d-flex justify-content-center">
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
                                            <a href="{{ $url }}" target="_blank"
                                                class="btn btn-danger btn-sm">
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
