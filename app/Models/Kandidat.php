<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'kandidats';

    protected $guarded = [];
    // RELASI KE PENDAFTARAN
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }



    // RELASI KE CABANG
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    // RELASI KE INSTITUSI
    public function institusi()
    {
        return $this->belongsTo(Institusi::class);
    }

    public function histories()
    {
        return $this->hasMany(KandidatHistory::class);
    }
  
    // Relasi kandidat ke bidang SSW yang sudah masuk kandidat
    public function bidang_ssws()
    {
        return $this->hasMany(BidangSsw::class, 'kandidat_id');
    }
}
