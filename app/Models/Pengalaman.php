<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
   use HasFactory;

    protected $table = 'pengalamans';

    protected $fillable = [
        'cv_id',
        'perusahaan',
        'jabatan',
        'tanggal_masuk',
        'tanggal_keluar',
        'gaji',
        'kota'
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
