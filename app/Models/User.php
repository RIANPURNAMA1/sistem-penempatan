<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'cabang_id',
        'google_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_activity' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    // Relasi ke Pendaftaran
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class); // 1:1
        // Jika 1 user bisa punya banyak pendaftaran: return $this->hasMany(Pendaftaran::class);
    }



    // Relasi ke User
    public function cv()
    {
        return $this->hasMany(Cv::class);
    }

    // User memiliki 1 cabang (opsional)
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    // relasi langsung ke kandidat melalui pendaftaran
    public function kandidat()
    {
        return $this->hasOneThrough(
            Kandidat::class,      // model akhir
            Pendaftaran::class,   // model penghubung
            'user_id',            // FK di pendaftaran
            'pendaftaran_id',     // FK di kandidat
            'id',                 // PK user
            'id'                  // PK pendaftaran
        );
    }
}
