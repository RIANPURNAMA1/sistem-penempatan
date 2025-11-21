<?php

namespace App\Http\Controllers;
use App\Models\Cv;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
class CvController extends Controller
{
    public function create()
    {
        $cvs = Cv::with(['pendidikan', 'pengalamans'])->get(); // ambil semua CV beserta relasinya
        return view('pendaftaran.cv', compact('cvs'));
    }
    public function index()
    {
        $cvs = Cv::with(['pendidikan', 'pengalamans'])->get(); // ambil semua CV beserta relasinya
        return view('cv.index', compact('cvs'));
    }

  public function export($id)
{
    $cv = Cv::with(['pendidikan', 'pengalamans'])->findOrFail($id);

    return Excel::download(new \App\Exports\CvExport($cv), 'cv-kandidat.xlsx');
}

public function exportPdf($id)
{
    $cv = Cv::with(['pendidikan', 'pengalamans'])->findOrFail($id);

    $pdf = PDF::loadView('cv.pdf', compact('cv'))
        ->setPaper('a4')
        ->setOption('margin-top', 0)
        ->setOption('margin-bottom', 0)
        ->setOption('margin-left', 0)
        ->setOption('margin-right', 0)
        ->setOption('disable-smart-shrinking', true);

    return $pdf->download('cv-'.$cv->id.'.pdf');
}



    public function edit($id)
    {
        $cv = Cv::with(['pendidikan', 'pengalamans'])->findOrFail($id);
        return view('pendaftaran.edit_cv', compact('cv'));
    }

    public function destroy($id)
    {
        $cv = Cv::findOrFail($id);
        $cv->pendidikans()->delete();
        $cv->pengalamans()->delete();
        $cv->delete();
        return redirect()->route('pendaftaran.cv.index')->with('success', 'CV berhasil dihapus');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_wa' => 'required|string|max:20',
            'tinggi_badan' => 'nullable|integer|min:30|max:300',
            'berat_badan' => 'nullable|integer|min:10|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pendidikan_nama.*' => 'required|string|max:255',
            'pendidikan_tahun.*' => 'required|string|max:50',
            'pendidikan_jurusan.*' => 'required|string|max:255',
            'pengalaman_perusahaan.*' => 'nullable|string|max:255',
            'pengalaman_jabatan.*' => 'nullable|string|max:255',
            'pengalaman_periode.*' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string|max:500',
        ]);

        // Ambil CV berdasarkan ID
        $cv = Cv::findOrFail($id);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($cv->foto) {
                Storage::disk('public')->delete($cv->foto);
            }
            $cv->foto = $request->file('foto')->store('cv_foto', 'public');
        }

        // Update data CV
        $cv->update([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'keahlian' => $request->keahlian,
        ]);

        // Update pendidikan
        $cv->pendidikan()->delete(); // hapus dulu yang lama
        foreach ($request->pendidikan_nama as $i => $nama) {
            Pendidikan::create([
                'cv_id' => $cv->id,
                'nama' => $nama,
                'tahun' => $request->pendidikan_tahun[$i],
                'jurusan' => $request->pendidikan_jurusan[$i],
            ]);
        }

        // Update pengalaman
        $cv->pengalamans()->delete(); // hapus dulu yang lama
        foreach ($request->pengalaman_perusahaan as $i => $perusahaan) {
            if ($perusahaan) {
                Pengalaman::create([
                    'cv_id' => $cv->id,
                    'perusahaan' => $perusahaan,
                    'jabatan' => $request->pengalaman_jabatan[$i] ?? null,
                    'periode' => $request->pengalaman_periode[$i] ?? null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'CV berhasil diupdate!');
    }


    public function store(Request $request)
    {
        // Cek apakah user sudah punya CV
        if (Cv::where('user_id', Auth::id())->exists()) {
            return response()->json([
                'message' => 'Kamu sudah mengisi CV, tidak bisa menambah lagi.'
            ], 422); // HTTP 422 untuk validasi gagal
        }

        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'no_wa' => 'required|string|max:20',
            'tinggi_badan' => 'nullable|integer|min:30|max:300',
            'berat_badan' => 'nullable|integer|min:10|max:500',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pendidikan_nama.*' => 'required|string|max:255',
            'pendidikan_tahun.*' => 'required|string|max:50',
            'pendidikan_jurusan.*' => 'required|string|max:255',
            'pengalaman_perusahaan.*' => 'nullable|string|max:255',
            'pengalaman_jabatan.*' => 'nullable|string|max:255',
            'pengalaman_periode.*' => 'nullable|string|max:255',
            'keahlian' => 'nullable|string|max:500',
        ]);

        // Upload foto
        $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('cv_foto', 'public') : null;

        // Simpan CV
        $cv = Cv::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'foto' => $fotoPath,
            'keahlian' => $request->keahlian,
        ]);

        // Simpan pendidikan
        foreach ($request->pendidikan_nama as $i => $nama) {
            $cv->pendidikan()->create([
                'nama' => $nama,
                'tahun' => $request->pendidikan_tahun[$i],
                'jurusan' => $request->pendidikan_jurusan[$i],
            ]);
        }

        // Simpan pengalaman
        foreach ($request->pengalaman_perusahaan as $i => $perusahaan) {
            if ($perusahaan) {
                $cv->pengalamans()->create([
                    'perusahaan' => $perusahaan,
                    'jabatan' => $request->pengalaman_jabatan[$i] ?? null,
                    'periode' => $request->pengalaman_periode[$i] ?? null,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }



    // word
    public function exportWord($id)
{
    $cv = Cv::with(['pendidikan', 'pengalamans'])->findOrFail($id);

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // ========== JUDUL ==========
    $section->addText(
        'CURRICULUM VITAE',
        ['bold' => true, 'size' => 18],
        ['alignment' => 'center']
    );

    $section->addTextBreak(1);

    // ========== DATA PRIBADI ==========
    $section->addText('DATA PRIBADI', ['bold' => true, 'size' => 14]);
    $section->addTextBreak(0.3);

    $section->addText('Nama Lengkap: ' . $cv->nama_lengkap);
    $section->addText('Tempat Lahir: ' . $cv->tempat_lahir);
    $section->addText('Tanggal Lahir: ' . $cv->tanggal_lahir);
    $section->addText('Jenis Kelamin: ' . $cv->jenis_kelamin);
    $section->addText('Alamat: ' . $cv->alamat);
    $section->addText('Email: ' . $cv->email);
    $section->addText('No. WA: ' . $cv->no_wa);

    if ($cv->tinggi_badan) {
        $section->addText('Tinggi Badan: ' . $cv->tinggi_badan . ' cm');
    }

    if ($cv->berat_badan) {
        $section->addText('Berat Badan: ' . $cv->berat_badan . ' kg');
    }

    if ($cv->keahlian) {
        $section->addText('Keahlian: ' . $cv->keahlian);
    }

    $section->addTextBreak(1);

    // ========== PENDIDIKAN ==========
    $section->addText('RIWAYAT PENDIDIKAN', ['bold' => true, 'size' => 14]);
    $section->addTextBreak(0.3);

    if ($cv->pendidikan->count() > 0) {
        foreach ($cv->pendidikan as $p) {
            $section->addListItem(
                $p->tingkatan . ' - ' . $p->instansi . ' (' . $p->tahun . ')'
            );
        }
    } else {
        $section->addText('- Tidak ada data pendidikan');
    }

    $section->addTextBreak(1);

    // ========== PENGALAMAN ==========
    $section->addText('PENGALAMAN KERJA', ['bold' => true, 'size' => 14]);
    $section->addTextBreak(0.3);

    if ($cv->pengalamans->count() > 0) {
        foreach ($cv->pengalamans as $pg) {
            $section->addListItem(
                $pg->posisi . ' - ' . $pg->perusahaan . ' (' . $pg->tahun_mulai . ' - ' . $pg->tahun_selesai . ')'
            );
        }
    } else {
        $section->addText('- Tidak ada data pengalaman');
    }

    // ========== FOTO (JIKA ADA) ==========
    if ($cv->foto && file_exists(public_path('uploads/cv/' . $cv->foto))) {
        $section->addTextBreak(1);
        $section->addText('Foto:', ['bold' => true]);

        $section->addImage(
            public_path('uploads/cv/' . $cv->foto),
            [
                'width' => 120,
                'height' => 150,
                'alignment' => 'left'
            ]
        );
    }

    // ========== EXPORT FILE ==========
    $filename = 'CV-' . str_replace(' ', '-', $cv->nama_lengkap) . '.docx';
    $path = storage_path($filename);

    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($path);

    return response()->download($path)->deleteFileAfterSend(true);
}
}
