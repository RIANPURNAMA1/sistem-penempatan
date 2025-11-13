<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cabang_id',
        'nama',
        'email',
        'no_wa',
        'jenis_kelamin',
        'tanggal_daftar',
        'alamat',
        'foto',
        'kk',
        'ktp',
        'bukti_pelunasan',
        'akte',
        'izasah',
        'verifikasi',
        'catatan_admin'
    ];

    // Relasi ke cabang
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
