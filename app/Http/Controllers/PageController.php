<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    // Menampilkan halaman data kandidat
    public function kandidat()
    {
        return view('siswa.index');
    }

    // Menampilkan halaman institusi
    public function institusi()
    {
        return view('institusi.index');
    }

    // Menampilkan halaman penempatan
    public function penempatan()
    {
        return view('penempatan.index');
    }

    // Menampilkan halaman interview
    public function interview()
    {
        return view('interview.index');
    }

    // Menampilkan halaman admin utama
    public function admin()
    {
        return view('admin.index');
    }

    // Menampilkan halaman daftar user/admin
    public function adminUser()
    {
        return view('admin.user');
    }
    public function cabang(){
        return view('cabang.index');
    }
}
