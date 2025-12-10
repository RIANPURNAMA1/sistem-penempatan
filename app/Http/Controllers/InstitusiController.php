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

    // Tampilkan form create
    public function create()
    {
        return view('institusi.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'perusahaan_penempatan' => 'nullable|string|max:255',
        ]);


        Institusi::create($request->all());

        return redirect()->route('institusi.index')->with('success', 'Institusi berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $institusi = Institusi::findOrFail($id);
        return view('institusi.edit', compact('institusi'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $institusi = Institusi::findOrFail($id);

        $request->validate([
            'perusahaan_penempatan' => 'nullable|string|max:255',
        ]);

        $institusi->update($request->all());

        return redirect()->route('institusi.index')->with('success', 'Institusi berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $institusi = Institusi::findOrFail($id);
        $institusi->delete();

        return redirect()->back()->with('success', 'Institusi berhasil dihapus.');
    }
}
