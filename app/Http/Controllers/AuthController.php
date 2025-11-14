<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Ups! Nama harus diisi.',
            'name.string' => 'Ups! Nama harus berupa teks.',
            'name.max' => 'Ups! Nama maksimal 255 karakter.',

            'email.required' => 'Ups! Alamat email harus diisi.',
            'email.email' => 'Ups! Alamat email tidak valid.',
            'email.unique' => 'Ups! Alamat email sudah digunakan.',

            'password.required' => 'Ups! Kata sandi harus diisi.',
            'password.string' => 'Ups! Kata sandi harus berupa teks.',
            'password.min' => 'Ups! Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Ups! Konfirmasi kata sandi tidak cocok.',
        ]);


        // Ambil role kandidat
        $role = Role::where('name', 'kandidat')->first();

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id, // otomatis jadi kandidat
        ]);

        return redirect()->back()->with('success', 'Registrasi berhasil. Silakan login.');
    }


    // Form login
    public function showLogin()
    {
        return view('auth.login');
    }
    // Login user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect ke halaman home atau dashboard setelah login berhasil
            return redirect()->intended('/')->with('success', 'Login Berhasil');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email'); // agar input email tetap terisi
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
