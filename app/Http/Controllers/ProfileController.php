<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Tampilkan halaman profil
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }


public function updatePassword(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'current_password' => 'nullable',
        'new_password' => 'nullable|min:6|confirmed',
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;

    if ($request->filled('current_password') || $request->filled('new_password')) {

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user->password = Hash::make($request->new_password);
    }

    $user->save();

     return response()->json([
        'status' => 'success',
        'message' => 'Profil berhasil diperbarui.'
    ]);
}

}
