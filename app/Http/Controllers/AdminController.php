<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::with('role')->orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        // Ambil semua role kecuali super admin (misal id=3)
        $roles = Role::where('name', '!=', 'super admin')->get();
        return view('admin.create', compact('roles'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email'=> 'required|email|unique:users,email',
        'password'=> 'required|min:6|confirmed',
        'role_id' => 'required|exists:roles,id'
    ]);

    // Cek role super admin atau kandidat
    $role = Role::find($request->role_id);
    if (in_array($role->name, ['super admin', 'kandidat'])) {
        return redirect()->back()
            ->withErrors(['role_id' => 'Tidak diperbolehkan membuat Super Admin atau Kandidat.'])
            ->withInput();
    }

    User::create([
        'name' => $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
        'role_id' => $request->role_id
    ]);

    return redirect()->route('admins.index')->with('success', 'Admin berhasil ditambahkan');
}


    public function edit(User $admin)
    {
        $roles = Role::where('name', '!=', 'super admin')->get();
        return view('admin.edit', compact('admin', 'roles'));
    }
public function update(Request $request, $id)
{
    // Cari admin berdasarkan id
    $admin = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email'=> 'required|email|unique:users,email,' . $admin->id,
        'password'=> 'nullable|min:6|confirmed',
        'role_id' => 'required|exists:roles,id'
    ]);

    // Cek role super admin
    $role = Role::find($request->role_id);
    if ($role->name === 'super admin') {
        return redirect()->back()
            ->withErrors(['role_id' => 'Tidak diperbolehkan mengubah menjadi Super Admin.'])
            ->withInput();
    }

    // Update admin
    $admin->update([
        'name' => $request->name,
        'email'=> $request->email,
        'role_id' => $request->role_id,
        'password'=> $request->password ? Hash::make($request->password) : $admin->password
    ]);

    return redirect()->route('admins.index')->with('success', 'Admin berhasil diperbarui');
}


    public function destroy(User $admin)
    {
        // Cek jika super admin
        if ($admin->role->name === 'super admin') {
            return redirect()->route('admins.index')->with('error', 'Super Admin tidak bisa dihapus.');
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus');
    }
}
