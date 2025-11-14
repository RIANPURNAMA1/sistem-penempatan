<?php

namespace App\Http\Controllers;

use App\Models\Institusi;
use Illuminate\Http\Request;

class InstitusiController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $institusis = Institusi::latest()->get();
        return view('institusi.index', compact('institusis'));
    }
    // Tampilkan semua data
    public function create()
    {
      
        return view('institusi.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_institusi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'penanggung_jawab' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'kuota' => 'required|integer|min:1',
        ]);

        Institusi::create($request->all());

        return redirect('/institusi')->with('success', 'Institusi berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $institusi = Institusi::findOrFail($id);
        return response()->json($institusi);
    }

    // Update data
    public function update(Request $request, $id)
    {
        $institusi = Institusi::findOrFail($id);

        $request->validate([
            'nama_institusi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'penanggung_jawab' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'kuota' => 'required|integer|min:1',
        ]);

        $institusi->update($request->all());

        return redirect()->back()->with('success', 'Institusi berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $institusi = Institusi::findOrFail($id);
        $institusi->delete();

        return redirect()->back()->with('success', 'Institusi berhasil dihapus.');
    }
}
