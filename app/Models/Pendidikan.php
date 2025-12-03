<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikans'; // pastikan sesuai nama tabel di migration

    protected $fillable = [
        'cv_id',
        'nama',
        'jurusan',
        'tahun_masuk',
        'tahun_lulus',
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
