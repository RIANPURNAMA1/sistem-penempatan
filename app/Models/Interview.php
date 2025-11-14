<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'kandidat_id',
        'tanggal_interview',
        'status_interview',
        'jumlah_interview',
        'catatan',
    ];

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
