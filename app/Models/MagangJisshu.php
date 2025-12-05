<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagangJisshu extends Model
{
    protected $table = 'magang_jisshu';

    // Field yang boleh diisi
    protected $fillable = [
        'cv_id',
        'perusahaan',
        'kota_prefektur',
        'bidang',
        'tahun_mulai',
        'tahun_selesai',
    ];

    // Relasi ke CV
    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
