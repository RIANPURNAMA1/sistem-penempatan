<?php

namespace App\Exports;

use App\Models\Kandidat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles; // Tambahkan ini
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Tambahkan ini
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; // Tambahkan ini
use Carbon\Carbon;

class KandidatExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize // IMPLEMENTASIKAN INI
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
     * Tentukan styling untuk Worksheet (khususnya header)
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // 1. Terapkan warna latar belakang ungu gelap dan teks putih pada baris pertama (Header)
        $sheet->getStyle(1)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // Teks Putih
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '6F42C1'], // Ungu gelap (contoh warna bootstrap purple)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);
        
        // Catatan: Implementasi ShouldAutoSize (di deklarasi class) akan menangani padding/lebar kolom.
    }

    /**
     * Tentukan baris header di Excel
     * (Isi fungsi headings() dan map() tetap sama seperti sebelumnya)
     * @return array
     */
    public function headings(): array
    {
         return [
            // KANDIDAT & STATUS
            'ID Kandidat',
            'Status Lokal', // status_kandidat
            'Status Mendunia', // status_kandidat_di_mendunia

            // PENDAFTARAN (DATA PRIBADI)
            'NIK',
            'Nama Lengkap',
            'Email',
            'No WA',
            'Jenis Kelamin',
            'Tanggal Daftar',
            'Tempat Lahir',
            'Tanggal Lahir', 
            'Usia',
            'Agama',
            'Status Nikah',
            'Pendidikan Terakhir',
            
            // PENDAFTARAN (ALAMAT)
            'Provinsi',
            'Kab/Kota',
            'Kecamatan',
            'Kelurahan',
            'Alamat Lengkap',
            
            // PENDAFTARAN (PROMETRIC & JEPANG)
            'ID Prometric',
            'Pass Prometric',
            'Paspor',
            'Pernah ke Jepang',
            'Status Verifikasi Admin',
            'Catatan Admin',
            
            // PENEMPATAN & PEKERJAAN
            'Perusahaan Penempatan (Institusi)',
            'Nama Perusahaan Jepang', 
            'Detail Pekerjaan', 
            'Bidang SSW', 

            // PROSES INTERVIEW
            'Tgl Setsumeikai/Ichiji',
            'Tgl Mensetsu 1',
            'Tgl Mensetsu 2',
            'Jadwal Interview Berikutnya',
            'Catatan Interview',

            // BIAYA ADMINISTRASI
            'Biaya Pemberkasan',
            'ADM Tahap 1',
            'ADM Tahap 2',

            // TRACKING DOKUMEN & VISA
            'Tgl Terbit Kontrak Kerja',
            'Tgl Masuk Imigrasi Jepang',
            'Tgl COE Terbit',
            'Tgl Pembuatan E-KTKLN',
            'Tgl Visa Terbit',
            'Jadwal Penerbangan',
        ];
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

            // BIAYA ADMINISTRASI
            $kandidat->biaya_pemberkasan ?? 0,
            $kandidat->adm_tahap1 ?? 0,
            $kandidat->adm_tahap2 ?? 0,

            // TRACKING DOKUMEN & VISA
            $formatDate($kandidat->terbit_kontrak_kerja),
            $formatDate($kandidat->masuk_imigrasi_jepang),
            $formatDate($kandidat->coe_terbit),
            $formatDate($kandidat->pembuatan_ektkln),
            $formatDate($kandidat->visa),
            $formatDate($kandidat->jadwal_penerbangan),
        ];
    }
}