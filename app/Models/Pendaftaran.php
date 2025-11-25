<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

   protected $guarded = [ ];

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


    public function kandidat()
{
    // relasi one-to-one: satu pendaftaran punya satu kandidat
    return $this->hasOne(Kandidat::class, 'pendaftaran_id', 'id');
}

}
