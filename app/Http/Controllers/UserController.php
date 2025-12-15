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


public function destroy($id)
{
    try {
        $kandidat = User::findOrFail($id); // atau model yang sesuai
        
        // Hapus kandidat
        $kandidat->delete();
        
        return redirect()->back()->with('success', 'Kandidat berhasil dihapus!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus kandidat: ' . $e->getMessage());
    }
}

 public function downloadPdf()
    {
        try {
            // Ambil semua kandidat dengan role 'kandidat'
            $kandidats = User::where('role', 'kandidat')
                            ->orderBy('created_at', 'desc')
                            ->get();

            // Load view untuk PDF
            $pdf = Pdf::loadView('admin.kandidat.pdf', compact('kandidats'));
            
            // Set paper size dan orientation
            $pdf->setPaper('A4', 'landscape');
            
            // Generate nama file dengan timestamp
            $filename = 'Daftar_Kandidat_' . date('Y-m-d_His') . '.pdf';
            
            // Download PDF
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

    /**
     * Stream/Preview PDF di browser (opsional)
     */
    public function previewPdf()
    {
        try {
            $kandidats = User::where('role', 'kandidat')
                            ->orderBy('created_at', 'desc')
                            ->get();

            $pdf = Pdf::loadView('admin.kandidat.pdf', compact('kandidats'));
            $pdf->setPaper('A4', 'landscape');
            
            // Stream ke browser (preview)
            return $pdf->stream('Daftar_Kandidat.pdf');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }
}
