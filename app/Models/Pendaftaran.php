<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = [];


    // agar muncul di array / json
    protected $appends = [
        'status_jft',
        'status_ssw'
    ];

    /* =========================
       ACCESSOR STATUS UJIAN
       ========================= */

    // STATUS JFT (JSF)
    public function getStatusJftAttribute()
    {
        return !empty($this->sertifikat_jft)
            ? 'sudah ujian jft'
            : 'belum ujian jft';
    }

    // STATUS SSW
    public function getStatusSswAttribute()
    {
        return !empty($this->sertifikat_ssw)
            ? 'sudah ujian ssw'
            : 'belum ujian ssw';
    }

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
    // Relasi ke user
    public function cv()
    {
        return $this->hasMany(Cv::class, 'cv_id');
    }


    public function kandidat()
    {
        // relasi one-to-one: satu pendaftaran punya satu kandidat
        return $this->hasOne(Kandidat::class, 'pendaftaran_id', 'id');
    }
    public function bidang_ssws()
    {
        return $this->hasMany(BidangSsw::class, 'pendaftaran_id');
    }
}
