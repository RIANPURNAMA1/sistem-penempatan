<?php

namespace App\Exports;

use App\Models\Kandidat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting; // Untuk format mata uang
use Maatwebsite\Excel\Concerns\WithStrictNullComparison; // Opsional, untuk penanganan null

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate; // Untuk merging

use Carbon\Carbon;

class KandidatExport implements
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    WithStyles, 
    ShouldAutoSize, 
    WithColumnFormatting,
    WithStrictNullComparison
{
    protected $kandidatId;

    public function __construct($kandidatId = null)
    {
        $this->kandidatId = $kandidatId;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Kandidat::with(['pendaftaran', 'institusi', 'bidang_ssws']);

        // Jika ID diberikan, ekspor hanya satu kandidat
        if ($this->kandidatId) {
            $query->where('id', $this->kandidatId);
        }
        
        return $query->get();
    }
    
    /**
     * Tentukan format untuk kolom tertentu (misal: mata uang)
     * Kolom AK, AL, AM adalah kolom 37, 38, 39
     * @return array
     */
    public function columnFormats(): array
    {
        return [
     
        ];
    }

    /**
     * Tentukan dua baris header: Baris 1 (Pengelompokan) dan Baris 2 (Detail)
     * @return array
     */
    public function headings(): array
    {
        // Baris 1: Header Pengelompokan (Gunakan string kosong untuk sel yang akan di-merge)
        $headerGroup = [
            'STATUS & ID', '', '',
            'DATA PRIBADI & PENDIDIKAN', '', '', '', '', '', '', '', '', '', '', '',
            'ALAMAT', '', '', '', '',
            'DATA JEPANG & VERIFIKASI', '', '', '', '', '',
            'PENEMPATAN & PEKERJAAN', '', '', '',
            'PROSES INTERVIEW', '', '', '', '',
            'BIAYA ADMINISTRASI', '', '',
            'TRACKING DOKUMEN & VISA', '', '', '', '', '',
        ];

        // Baris 2: Header Detail
        $headerDetail = [
            // KANDIDAT & STATUS (Kolom 1-3)
            'ID Kandidat', 'Status Lokal', 'Status Mendunia', 

            // DATA PRIBADI (Kolom 4-16)
            'NIK', 'Nama Lengkap', 'Email', 'No WA', 'Jenis Kelamin', 'Tanggal Daftar', 
            'Tempat Lahir', 'Tanggal Lahir', 'Usia', 'Agama', 'Status Nikah', 'Pendidikan Terakhir',

            // ALAMAT (Kolom 17-21)
            'Provinsi', 'Kab/Kota', 'Kecamatan', 'Kelurahan', 'Alamat Lengkap',
            
            // PROMETRIC & JEPANG (Kolom 22-27)
            'ID Prometric', 'Pass Prometric', 'Paspor', 'Pernah ke Jepang', 
            'Status Verifikasi Admin', 'Catatan Admin',
            
            // PENEMPATAN & PEKERJAAN (Kolom 28-31)
            'Perusahaan Penempatan (Institusi)', 'Nama Perusahaan Jepang', 
            'Detail Pekerjaan', 'Bidang SSW', 

            // PROSES INTERVIEW (Kolom 32-36)
            'Tgl Setsumeikai/Ichiji', 'Tgl Mensetsu 1', 'Tgl Mensetsu 2', 
            'Jadwal Interview Berikutnya', 'Catatan Interview',

            // BIAYA ADMINISTRASI (Kolom 37-39)
            'Biaya Pemberkasan', 'ADM Tahap 1', 'ADM Tahap 2',

            // TRACKING DOKUMEN & VISA (Kolom 40-45)
            'Tgl Terbit Kontrak Kerja', 'Tgl Masuk Imigrasi Jepang', 'Tgl COE Terbit', 
            'Tgl Pembuatan E-KTKLN', 'Tgl Visa Terbit', 'Jadwal Penerbangan',
        ];
        
        return [$headerGroup, $headerDetail];
    }
    
    /**
     * Map data dari collection ke baris Excel
     * @param mixed $kandidat
     * @return array
     */
    public function map($kandidat): array
    {
        $pendaftaran = $kandidat->pendaftaran;
        $institusi = $kandidat->institusi;

        $formatDate = function ($date) {
            return $date ? Carbon::parse($date)->format('d F Y') : '-';
        };

        // Menggabungkan semua Bidang SSW menjadi satu string
        $bidangSsws = $kandidat->bidang_ssws->pluck('nama_bidang')->implode(', ');

        return [
            // KANDIDAT & STATUS
            $kandidat->id,
            $kandidat->status_kandidat ?? '-',
            $kandidat->status_kandidat_di_mendunia ?? '-',

            // PENDAFTARAN (DATA PRIBADI)
            $pendaftaran->nik ?? '-',
            $pendaftaran->nama ?? '-',
            $pendaftaran->email ?? '-',
            $pendaftaran->no_wa ?? '-',
            $pendaftaran->jenis_kelamin ?? '-',
            $formatDate($pendaftaran->tanggal_daftar),
            $pendaftaran->tempat_lahir ?? '-',
            $formatDate($pendaftaran->tempat_tanggal_lahir),
            $pendaftaran->usia ?? '-',
            $pendaftaran->agama ?? '-',
            $pendaftaran->status ?? '-',
            $pendaftaran->pendidikan_terakhir ?? '-',
            
            // PENDAFTARAN (ALAMAT)
            $pendaftaran->provinsi ?? '-',
            $pendaftaran->kab_kota ?? '-',
            $pendaftaran->kecamatan ?? '-',
            $pendaftaran->kelurahan ?? '-',
            $pendaftaran->alamat ?? '-',
            
            // PENDAFTARAN (PROMETRIC & JEPANG)
            $pendaftaran->id_prometric ?? '-',
            $pendaftaran->password_prometric ?? '-',
            $pendaftaran->paspor ?? '-',
            $pendaftaran->pernah_ke_jepang ?? '-',
            $pendaftaran->verifikasi ?? 'menunggu',
            $pendaftaran->catatan_admin ?? '-',
            
            // PENEMPATAN & PEKERJAAN
            $institusi->perusahaan_penempatan ?? '-',
            $kandidat->nama_perusahaan ?? '-',
            $kandidat->detail_pekerjaan ?? '-',
            $bidangSsws ?? '-',

            // PROSES INTERVIEW
            $formatDate($kandidat->tgl_setsumeikai_ichijimensetsu),
            $formatDate($kandidat->tgl_mensetsu),
            $formatDate($kandidat->tgl_mensetsu2),
            $formatDate($kandidat->jadwal_interview),
            $kandidat->catatan_interview ?? '-',

            // BIAYA ADMINISTRASI (CASTING KE FLOAT AGAR FORMAT MATA UANG BEKERJA)
            (float)($kandidat->biaya_pemberkasan),
            (float)($kandidat->adm_tahap1),
            (float)($kandidat->adm_tahap2),

            // TRACKING DOKUMEN & VISA
            $formatDate($kandidat->terbit_kontrak_kerja),
            $formatDate($kandidat->masuk_imigrasi_jepang),
            $formatDate($kandidat->coe_terbit),
            $formatDate($kandidat->pembuatan_ektkln),
            $formatDate($kandidat->visa),
            $formatDate($kandidat->jadwal_penerbangan),
        ];
    }

    /**
     * Tentukan styling untuk Worksheet (termasuk merging)
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Mendapatkan indeks kolom terakhir berdasarkan jumlah detail header
        $lastColumnIndex = count($this->headings()[1]);
        $lastColumn = Coordinate::stringFromColumnIndex($lastColumnIndex); 
        $headerRange = 'A1:' . $lastColumn . '2';
        
        // --- 1. MERGING BARIS 1 (HEADER PENGELOMPOKAN) ---
        $merges = [
            'A1:C1',     // STATUS & ID (Kolom 1-3)
            'D1:P1',     // DATA PRIBADI & PENDIDIKAN (Kolom 4-16)
            'Q1:U1',     // ALAMAT (Kolom 17-21)
            'V1:AA1',    // DATA JEPANG & VERIFIKASI (Kolom 22-27)
            'AB1:AE1',   // PENEMPATAN & PEKERJAAN (Kolom 28-31)
            'AF1:AJ1',   // PROSES INTERVIEW (Kolom 32-36)
            'AK1:AM1',   // BIAYA ADMINISTRASI (Kolom 37-39)
            'AN1:' . $lastColumn . '1',   // TRACKING DOKUMEN & VISA (Kolom 40-akhir)
        ];
        foreach ($merges as $merge) {
            $sheet->mergeCells($merge);
        }

        // --- 2. STYLING BARIS 1 & 2 (HEADER) ---
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // Teks Putih
                'size' => 10,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
        
        // Warna latar belakang untuk Baris 1 (Header Group) - Ungu Tua
        $sheet->getStyle('1')->getFill()->applyFromArray([
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['rgb' => '4A148C'], 
        ]);

        // Warna latar belakang untuk Baris 2 (Header Detail) - Ungu Sedang
        $sheet->getStyle('2')->getFill()->applyFromArray([
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['rgb' => '6F42C1'], 
        ]);

        // --- 3. ZEBRA STRIPING & BORDER DATA ---
        $dataRows = $sheet->getHighestRow();
        for ($i = 3; $i <= $dataRows; $i++) {
            // Zebra Striping (baris ganjil diberi latar belakang abu-abu muda)
            if ($i % 2 !== 0) { 
                $sheet->getStyle('A' . $i . ':' . $lastColumn . $i)->getFill()->applyFromArray([
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => 'F0F0F0'], 
                ]);
            }
            // Tambahkan border tipis untuk semua baris data
            $sheet->getStyle('A' . $i . ':' . $lastColumn . $i)->getBorders()->applyFromArray([
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR],
            ]);
        }
    }
}