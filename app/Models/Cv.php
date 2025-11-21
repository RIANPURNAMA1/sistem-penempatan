<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'email',
        'no_wa',
        'tinggi_badan',
        'berat_badan',
        'foto',
        'keahlian',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke pendidikan (satu CV bisa punya banyak pendidikan)
    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class);
    }

    // Relasi ke pengalaman kerja (satu CV bisa punya banyak pengalaman)
    public function pengalamans()
    {
        return $this->hasMany(Pengalaman::class);
    }
}
