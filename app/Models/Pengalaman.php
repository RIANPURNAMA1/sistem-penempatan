<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    use HasFactory;

    // pastikan nama tabel sesuai migrasi
    protected $table = 'pengalamans';

    protected $fillable = [
        'cv_id',
        'perusahaan',
        'jabatan',
        'periode',
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
