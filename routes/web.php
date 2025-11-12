<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("dashboard");
});


Route::get('/login', function(){
    return view("auth.login");
});


Route::get('/registrasi', function(){
    return view("auth.register");
});
Route::get('/pendaftaran/kandidat', function(){
    return view("pendaftaran.index");
});


Route::get('/kandidat', function(){
    return view("siswa.index");
});
Route::get('/institusi', function(){
    return view("institusi.index");
});
Route::get('/penempatan', function(){
    return view("penempatan.index");
});
Route::get('/interview', function(){
    return view("interview.index");
});
Route::get('/admin', function(){
    return view("admin.index");
});
Route::get('/admin/user', function(){
    return view("admin.user");
});
