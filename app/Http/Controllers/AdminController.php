<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Daftar Role yang valid berdasarkan migration
    private const VALID_ROLES = [
        'Cabang Cianjur Selatan Mendunia',
        'Cabang Cianjur Pamoyanan Mendunia',
        'Cabang Batam Mendunia',
        'Cabang Banyuwangi Mendunia',
        'Cabang Kendal Mendunia',
        'Cabang Pati Mendunia',
        'Cabang Tulung Agung Mendunia',
        'Cabang Bangkalan Mendunia',
        'Cabang Bojonegoro Mendunia',
        'Cabang Jember Mendunia',
        'Cabang Wonosobo Mendunia',
        'Cabang Eshan Mendunia',
        'super admin',
        'kandidat'
    ];

    // Daftar Role yang TIDAK BOLEH dibuat atau diubah (Super Admin dan Kandidat)
    private const FORBIDDEN_ROLES = [
        'super admin',
        'kandidat'
    ];

    /**
     * Tampilkan daftar admin (selain 'kandidat', jika tujuannya adalah user admin)
     */
    public function index()
    {
        // Ambil semua user kecuali yang role-nya 'kandidat'
        $admins = User::where('role', '!=', 'kandidat')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('admin.index', compact('admins'));
    }

    /**
     * Tampilkan form untuk membuat admin baru.
     */
    public function create()
    {
        // Ambil daftar role yang diperbolehkan untuk dipilih saat membuat admin baru (selain FORBIDDEN_ROLES)
        $allowedRoles = array_diff(self::VALID_ROLES, self::FORBIDDEN_ROLES);
        
        // Menggunakan array asosiatif untuk kemudahan di view (opsional, tergantung implementasi view)
        $roles = array_combine($allowedRoles, $allowedRoles);

        return view('admin.create', compact('roles'));
    }

    /**
     * Simpan admin baru.
     */
    public function store(Request $request)
    {
        // Daftar role yang diperbolehkan untuk dibuat (selain 'super admin' dan 'kandidat')
        $allowedRoles = array_diff(self::VALID_ROLES, self::FORBIDDEN_ROLES);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // Validasi role harus ada di daftar yang diperbolehkan (bukan super admin atau kandidat)
            'role' => ['required', 'string', Rule::in($allowedRoles)],
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role // Menggunakan kolom 'role'
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Tampilkan form untuk mengedit admin.
     */
    public function edit(User $admin)
    {
        // Ambil daftar role yang diperbolehkan untuk dipilih saat edit (selain FORBIDDEN_ROLES)
        $allowedRoles = array_diff(self::VALID_ROLES, self::FORBIDDEN_ROLES);
        $roles = array_combine($allowedRoles, $allowedRoles);

        return view('admin.edit', compact('admin', 'roles'));
    }

    /**
     * Perbarui admin yang ada.
     */
    public function update(Request $request, User $admin)
    {
        // Daftar role yang diperbolehkan untuk diubah (selain 'super admin' dan 'kandidat')
        $allowedRoles = array_diff(self::VALID_ROLES, self::FORBIDDEN_ROLES);
        
        // Validasi tidak mengizinkan mengubah role menjadi 'super admin' atau 'kandidat'
        $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan email unik, kecuali untuk diri sendiri
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
            // Validasi role harus ada di daftar yang diperbolehkan (bukan super admin atau kandidat)
            'role' => ['required', 'string', Rule::in($allowedRoles)],
        ]);

        // Tidak perlu pengecekan role secara manual di sini, karena sudah divalidasi dengan Rule::in($allowedRoles)
        // yang sudah mengecualikan 'super admin' dan 'kandidat'.

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Menggunakan kolom 'role'
            // Perbarui password jika ada, jika tidak gunakan password lama
            'password' => $request->password ? Hash::make($request->password) : $admin->password
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Hapus admin.
     */
    public function destroy(User $admin)
    {
        // Cek jika super admin
        if ($admin->role === 'super admin') {
            return redirect()->route('admins.index')->with('error', 'Super Admin tidak bisa dihapus.');
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin berhasil dihapus');
    }
}