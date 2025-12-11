<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangSsw extends Model
{


    protected $fillable = [ 'kandidat_id','pendaftaran_id','nama_bidang'];

    // BidangSsw.php
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
