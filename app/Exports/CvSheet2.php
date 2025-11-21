<?php

namespace App\Exports;

use App\Models\Cv;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CvSheet2 implements FromArray, WithTitle, WithStyles
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function title(): string
    {
        return 'Riwayat';
    }

    public function array(): array
    {
        $cv = Cv::with(['pendidikan', 'pengalamans'])->findOrFail($this->id);

        $rows = [
            ['DATA PENDIDIKAN'],
            [],
            ['Nama Pendidikan', 'Tahun'],
        ];

        foreach ($cv->pendidikan as $p) {
            $rows[] = [$p->nama, $p->tahun];
        }

        $rows[] = [];
        $rows[] = ['PENGALAMAN KERJA'];
        $rows[] = ['Perusahaan', 'Jabatan', 'Tahun'];

        foreach ($cv->pengalamans as $pg) {
            $rows[] = [$pg->perusahaan, $pg->jabatan, $pg->tahun];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        // Judul
        $sheet->mergeCells('A1:C1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
        ]);

        // Header pendidikan
        $sheet->getStyle('A3:B3')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FCE4D6'],
            ],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);

        // Header pengalaman
        $sheet->getStyle('A6:C6')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'DDEBF7'],
            ],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);
    }
}
