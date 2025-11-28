<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
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

        // Buat user baru dengan role 'kandidat'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kandidat', // ganti role_id menjadi role
        ]);

        // Langsung login setelah berhasil registrasi
        Auth::login($user);

        return response()->json([
            'success' => true,
            'redirect' => route('dashboard'),
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


    // =======================================
    // === LOGIN GOOGLE : REDIRECT
    // =======================================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    // =======================================
    // === LOGIN GOOGLE : CALLBACK
    // =======================================
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari atau buat user
            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name'  => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(20)), // generate random untuk memenuhi DB
                ]
            );

            Auth::login($user, true);
            // ⬅️ Kirim tanda sukses ke halaman login
        session()->flash('google_success', 'Login Google berhasil!');

            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors([
                'google_error' => 'Gagal login dengan Google. Coba lagi.'
            ]);
        }
    }
    // === LOGIN BIASA (Biarkan seperti punya Anda) ===
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => route('dashboard')
            ]);
        }

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

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }



    public function lupapassword()
    {
        return view('forgot-password');
    }
}
