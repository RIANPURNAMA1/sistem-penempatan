<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institusi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_institusi',
        'alamat',
        'penanggung_jawab',
        'no_wa',
        'kuota',
    ];

       // Relasi: Satu cabang bisa punya banyak pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'cabang_id');
    }
}
