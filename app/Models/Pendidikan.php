<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_id',
        'nama',
        'jurusan',
        'tahun',
    ];

    public function cv()
    {
        return $this->belongsTo(Cv::class);
    }
}
