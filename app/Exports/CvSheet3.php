<?php

namespace App\Exports;

use App\Models\Cv;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class CvSheet3 implements WithDrawings, WithTitle
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function title(): string
    {
        return 'Foto';
    }

    public function drawings()
    {
        $cv = Cv::findOrFail($this->id);

        $path = public_path('uploads/foto/cv_foto/' . $cv->foto);

        // Jika file tidak ditemukan → jangan tampilkan foto (hindari error)
        if (!$cv->foto || !file_exists($path)) {
            return [];
        }

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Foto');
        $drawing->setDescription('Foto Kandidat');
        $drawing->setPath($path);
        $drawing->setHeight(300);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }
}
