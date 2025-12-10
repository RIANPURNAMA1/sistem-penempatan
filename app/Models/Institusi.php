<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institusi extends Model
{
    use HasFactory;

 protected $fillable = [
  
        'perusahaan_penempatan',
    ];

       // Relasi: Satu cabang bisa punya banyak pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'pendaftaran_id');
    }

       // Relasi ke history
    public function histories()
    {
        return $this->hasMany(KandidatHistory::class)->orderBy('created_at', 'desc');
    }

}
