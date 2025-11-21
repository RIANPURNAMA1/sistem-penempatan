<?php

namespace App\Http\Controllers;

use App\Exports\CvExport;
use App\Models\Cv;
use App\Models\Pendidikan;
use App\Models\Pengalaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class CvController extends Controller
{
    public function create()
    {
        $cvs = Cv::with(['pendidikan', 'pengalamans'])->get(); // ambil semua CV beserta relasinya
        return view('cv.index', compact('cvs'));
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
   $cv = Cv::with(['pendidikan','pengalamans'])->findOrFail($id);
    $pdf = Pdf::loadView('cv.pdf', compact('cv'))
              ->setPaper('A4', 'portrait');
    return $pdf->download('kaigo-cv-' . $cv->id . '.pdf');
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
}
