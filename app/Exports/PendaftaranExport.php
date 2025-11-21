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
            'No. WhatsApp',
            'Provinsi',
            'Kota/Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'Cabang',
            'Tanggal Daftar',
            'Status Verifikasi',
            'Catatan Admin',
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
            $p->no_wa,
            $p->provinsi,
            $p->kab_kota,
            $p->kecamatan,
            $p->kelurahan,
            $p->cabang ? $p->cabang->nama_cabang : '-',
            $p->tanggal_daftar,
            $p->verifikasi,
            $p->catatan_admin,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading Style
        $sheet->getStyle('A1:N1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:N1')->getAlignment()->setHorizontal('center')->setVertical('center');

        // Tinggi baris heading
        $sheet->getRowDimension(1)->setRowHeight(28);

        // Kolom besar (manual) agar lebih enak dibaca
        $columnWidths = [
            'A' => 20,
            'B' => 25,
            'C' => 30,
            'D' => 40,
            'E' => 15,
            'F' => 18,
            'G' => 20,
            'H' => 22,
            'I' => 22,
            'J' => 22,
            'K' => 20,
            'L' => 20,
            'M' => 18,
            'N' => 35,
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // Wrap Text untuk alamat dan catatan admin
        $sheet->getStyle('D:N')->getAlignment()->setWrapText(true);

        // Border semua tabel
        $sheet->getStyle('A1:N' . $sheet->getHighestRow())
            ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Background heading
                $event->sheet->getStyle('A1:N1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF4C8BF5'); // biru elegan

                // Font heading warna putih
                $event->sheet->getStyle('A1:N1')->getFont()->getColor()->setARGB('FFFFFFFF');

                // Set freeze pane (heading tetap di atas)
                $event->sheet->freezePane('A2');
            },
        ];
    }
}
