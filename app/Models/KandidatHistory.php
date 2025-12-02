<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandidatHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'kandidat_id',
        'status_kandidat',
        'status_interview',
        'institusi_id',
        'catatan_interview',
        'jadwal_interview',
        'bidang_ssw',
    ];
  
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }

    public function institusi()
    {
        return $this->belongsTo(Institusi::class);
    }
}
