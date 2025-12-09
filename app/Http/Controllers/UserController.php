<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua user kecuali yang role-nya 'kandidat'
        $kandidats = User::where('role','kandidat')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user', compact('kandidats'));
    }
}
