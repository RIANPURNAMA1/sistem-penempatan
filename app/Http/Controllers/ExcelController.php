<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    /* ------------------------------------------------------------
    | EXPORT EXCEL
    ------------------------------------------------------------ */
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');

        // Data contoh, bisa diganti DB
        $data = [
            [1, 'Rian', 'rian@example.com'],
            [2, 'Dewi', 'dewi@example.com'],
            [3, 'Andi', 'andi@example.com'],
        ];

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item[0]);
            $sheet->setCellValue('B' . $row, $item[1]);
            $sheet->setCellValue('C' . $row, $item[2]);
            $row++;
        }

        // Download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_export.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    /* ------------------------------------------------------------
    | IMPORT EXCEL
    ------------------------------------------------------------ */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file')->getRealPath();

        $spreadsheet = IOFactory::load($file);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // Jika ingin masuk DB, tinggal proses data di bawah ini
        // foreach ($data as $row) {
        //     User::create([
        //         'name' => $row[1],
        //         'email' => $row[2]
        //     ]);
        // }

        return back()->with('success', 'Data berhasil diimport')->with('data_import', $data);
    }
}
