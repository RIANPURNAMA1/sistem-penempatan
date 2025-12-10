<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class userExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
     * Ambil data kandidat
     */
    public function collection()
    {
        // Sesuaikan query dengan kebutuhan Anda
        // Misalnya filter role='kandidat'
        return User::where('role', 'kandidat')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
            'Tanggal Dibuat',
            'Waktu Dibuat'
        ];
    }

    /**
     * Mapping data ke kolom
     */
    public function map($kandidat): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $kandidat->name,
            $kandidat->email,
            $kandidat->created_at->format('d M Y'),
            $kandidat->created_at->format('H:i:s')
        ];
    }

    /**
     * Styling untuk Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    /**
     * Lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,   // No
            'B' => 30,  // Nama
            'C' => 35,  // Email
            'D' => 20,  // Tanggal
            'E' => 15,  // Waktu
        ];
    }
}