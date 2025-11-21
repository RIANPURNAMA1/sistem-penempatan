<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register user dan langsung login
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
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        // Langsung login setelah berhasil registrasi
        Auth::login($user);

        return response()->json([
            'success' => true,
            'redirect' => route('dashboard'), // Ganti dengan route tujuan
            'message' => 'Registrasi berhasil! Anda sudah otomatis login.'
        ]);
    }




    // Tampilkan form lupa password
    public function showLupaPassword()
    {
        return view('auth.lupa-password');
    }

    // Proses reset password
    // Proses reset password via AJAX
    // Tampilkan form lupa password
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Proses reset password via email
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil direset!'
        ]);
    }

    // Form login
    public function showLogin()
    {
        return view('auth.login');
    }
    // Login user
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial
        if (Auth::attempt($request->only('email', 'password'))) {

            // Regenerasi session
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => route('dashboard') // ganti sesuai tujuan
            ]);
        }

        // Jika gagal
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }



    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function lupapassword()
    {
        return view('forgot-password');
    }
}
