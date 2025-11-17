<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Jika user tidak memiliki role → error aman & editor tidak merah
        if (!$user->role) {
            return abort(403, 'Role tidak ditemukan. Hubungi admin.');
        }

        // Nama role user
        $userRole = strtolower($user->role->name);

        // Normalisasi daftar role yang diizinkan
        $allowedRoles = array_map(fn($r) => strtolower(trim($r)), $roles);

        // Cek apakah role user diizinkan
        if (!in_array($userRole, $allowedRoles)) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
