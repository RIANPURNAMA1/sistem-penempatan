<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'pas_foto' => 'array',
        'sertifikat_files' => 'array',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke cabang
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function Pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    // Relasi ke pendidikan (satu CV bisa punya banyak pendidikan)
    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class);
    }

    // Relasi ke pengalaman kerja (satu CV bisa punya banyak pengalaman)
    public function pengalamans()
    {
        return $this->hasMany(Pengalaman::class);
    }
    public function magangjisshu ()
    {
        return $this->hasMany(MagangJisshu::class);
    }
    public function riwayatpekerjaanterakhir ()
    {
        return $this->hasMany(riwayatpekerjaanterakhir::class);
    }
}
