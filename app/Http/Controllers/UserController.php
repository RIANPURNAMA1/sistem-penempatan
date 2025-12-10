<?php

namespace App\Http\Controllers;

use App\Exports\userExport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua user kecuali yang role-nya 'kandidat'
        $kandidats = User::where('role', 'kandidat')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user', compact('kandidats'));
    }

    // Method untuk export Excel
    public function exportExcel()
    {
        $fileName = 'Data_Kandidat_' . date('Y-m-d_His') . '.xlsx';

        return Excel::download(new userExport, $fileName);
    }

    // Method untuk download PDF
public function downloadPdf()
{
    // Ambil semua data kandidat
    // Sesuaikan query dengan kebutuhan Anda
    $kandidats = User::where('role', 'kandidat')
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Load view dan passing data
    $pdf = Pdf::loadView('admin.kandidat.kandidat-pdf', [
        'kandidats' => $kandidats
    ]);
    
    // Set paper size dan orientation
    $pdf->setPaper('A4', 'landscape');
    
    // Generate nama file dengan timestamp
    $fileName = 'Data_Kandidat_' . date('Y-m-d_His') . '.pdf';
    
    // Download PDF
    return $pdf->download($fileName);
    
    // Atau jika ingin tampilkan di browser (inline):
    // return $pdf->stream($fileName);
}
}
