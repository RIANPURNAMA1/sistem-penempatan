<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_cabang',
        'alamat',
    ];
    

      // Relasi: Satu cabang bisa punya banyak pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'cabang_id');
    }

      public function users()
    {
        return $this->hasMany(User::class);
    }

    // Satu cabang bisa memiliki banyak kandidat
    public function kandidats()
    {
        return $this->hasMany(Kandidat::class);
    }
        
}


