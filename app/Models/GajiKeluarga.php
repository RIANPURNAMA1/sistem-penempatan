<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GajiKeluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_id',
        'istri_gaji',
        'ibu_gaji',
        'ayah_gaji',
        'kakak_gaji',
        'adik_gaji',
    ];

    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cv::class);
    }
}
