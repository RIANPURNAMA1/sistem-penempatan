<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PendaftaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    public function collection()
    {
        return Pendaftaran::with('cabang')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Email',
            'Alamat',
            'Jenis Kelamin',
            'Agama',
            'Status',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No. WhatsApp',
            'Provinsi',
            'Kota/Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'Cabang',
            'Tanggal Daftar',
            'Status Verifikasi',
            'Catatan Admin',
            'Foto',
            'Sertifikat JFT',
            'Sertifikat SSW',
            'KK',
            'KTP',
            'Bukti Pelunasan',
            'Akte',
            'Ijazah',
        ];
    }

    public function map($p): array
    {
        return [
            $p->nik,
            $p->nama,
            $p->email,
            $p->alamat,
            $p->jenis_kelamin,
            $p->agama,
            $p->status,
            $p->tempat_lahir,
            $p->tempat_tanggal_lahir,
            $p->no_wa,
            $p->provinsi,
            $p->kab_kota,
            $p->kecamatan,
            $p->kelurahan,
            $p->cabang ? $p->cabang->nama_cabang : '-',
            $p->tanggal_daftar,
            $p->verifikasi,
            $p->catatan_admin,
            $p->foto ? asset('storage/'.$p->foto) : '-',
            $p->sertifikat_jft ? asset('storage/'.$p->sertifikat_jft) : '-',
            $p->sertifikat_ssw ? asset('storage/'.$p->sertifikat_ssw) : '-',
            $p->kk ? asset('storage/'.$p->kk) : '-',
            $p->ktp ? asset('storage/'.$p->ktp) : '-',
            $p->bukti_pelunasan ? asset('storage/'.$p->bukti_pelunasan) : '-',
            $p->akte ? asset('storage/'.$p->akte) : '-',
            $p->ijasah ? asset('storage/'.$p->ijasah) : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading Style
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal('center')->setVertical('center');

        // Tinggi baris heading
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Set column width (manual agar lebih enak dibaca)
        $columnWidths = [
            'A' => 20, 'B' => 25, 'C' => 30, 'D' => 40, 'E' => 15, 'F' => 15, 'G' => 15,
            'H' => 20, 'I' => 18, 'J' => 18, 'K' => 20, 'L' => 22, 'M' => 22, 'N' => 22,
            'O' => 20, 'P' => 20, 'Q' => 18, 'R' => 35, 'S' => 25, 'T' => 25, 'U' => 25,
            'V' => 25, 'W' => 25, 'X' => 25, 'Y' => 25, 'Z' => 25,
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // Wrap text untuk alamat dan catatan admin
        $sheet->getStyle('D:R')->getAlignment()->setWrapText(true);

        // Border semua tabel
        $sheet->getStyle('A1:Z' . $sheet->getHighestRow())
            ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Background heading
                $event->sheet->getStyle('A1:Z1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF4C8BF5'); // biru elegan

                // Font heading warna putih
                $event->sheet->getStyle('A1:Z1')->getFont()->getColor()->setARGB('FFFFFFFF');

                // Freeze pane
                $event->sheet->freezePane('A2');
            },
        ];
    }
}
