<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no_pendaftaran' => $this->no_pendaftaran,
            'nama' => $this->nama,
            'nik' => $this->nik,
            'usia' => $this->usia,
            'jenis_kelamin' => $this->jenis_kelamin,
            'agama' => $this->agama,
            'email' => $this->email,
            'no_wa' => $this->no_wa,
            'tempat_tanggal_lahir' => $this->tempat_tanggal_lahir,
            'alamat' => $this->alamat,
            'provinsi' => $this->provinsi,
            'kab_kota' => $this->kab_kota,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'pernah_ke_jepang' => $this->pernah_ke_jepang,
            'paspor' => $this->paspor,
            'status' => $this->status,
            'verifikasi' => $this->verifikasi,
            'id_prometric' => $this->id_prometric,
            'password_prometric' => $this->password_prometric,
            'status_jft' => $this->status_jft,
            'status_ssw' => $this->status_ssw,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cabang' => $this->cabang ? [
                'id' => $this->cabang->id,
                'nama_cabang' => $this->cabang->nama_cabang,
            ] : null,
            'user' => $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ] : null,
        ];
    }
}
