<?php

namespace App\Exports;

use App\Models\Cv;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CvSheet1 implements FromArray, WithStyles, ShouldAutoSize, WithTitle
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function title(): string
    {
        return 'Data Pribadi';
    }

    public function array(): array
    {
        $cv = Cv::findOrFail($this->id);

        return [
            ['FORMULIR DATA DIRI KANDIDAT'],
            ['DATA PENDAFTARAN KANDIDAT'],
            [],
            [
                'Nama Lengkap','Tempat Lahir','Tanggal Lahir',
                'Jenis Kelamin', 'Alamat', 'Email', 'No WA',
                'Tinggi Badan', 'Berat Badan', 'Keahlian'
            ],
            [
                $cv->nama_lengkap,
                $cv->tempat_lahir,
                $cv->tanggal_lahir,
                $cv->jenis_kelamin,
                $cv->alamat,
                $cv->email,
                $cv->no_wa,
                $cv->tinggi_badan,
                $cv->berat_badan,
                $cv->keahlian,
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');

        // Title
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 18],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
        ]);

        // Sub header
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
        ]);

        // Header table
        $sheet->getStyle('A4:J4')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'D9E1F2'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Data row
        $sheet->getStyle('A5:J5')->applyFromArray([
            'alignment' => [
                'wrapText' => true,
                'vertical' => Alignment::VERTICAL_TOP
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ],
            ],
        ]);

        return [];
    }
}
