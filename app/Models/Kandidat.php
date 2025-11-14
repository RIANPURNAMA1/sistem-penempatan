<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'kandidats';

    protected $fillable = [
        'pendaftaran_id',
        'cabang_id',
        'status_kandidat',
        'status_interview',
        'institusi_id',
        'jumlah_interview',
        'catatan_interview',
        'jadwal_interview',
    ];

    // RELASI KE PENDAFTARAN
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
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
}
