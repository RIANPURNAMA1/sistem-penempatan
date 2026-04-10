<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PendaftaranKandidatResource extends JsonResource
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
            'dokumen' => [
                'foto' => $this->foto ? asset($this->foto) : null,
                'sertifikat_jft' => $this->sertifikat_jft ? asset($this->sertifikat_jft) : null,
                'sertifikat_ssw' => $this->sertifikat_ssw ? collect($this->sertifikat_ssw)->map(fn ($s) => asset($s))->toArray() : [],
                'kk' => $this->kk ? asset($this->kk) : null,
                'ktp' => $this->ktp ? asset($this->ktp) : null,
                'bukti_pelunasan' => $this->bukti_pelunasan ? asset($this->bukti_pelunasan) : null,
                'akte' => $this->akte ? asset($this->akte) : null,
                'ijasah' => $this->ijasah ? asset($this->ijasah) : null,
            ],
            'cabang' => $this->cabang ? [
                'id' => $this->cabang->id,
                'nama_cabang' => $this->cabang->nama_cabang,
            ] : null,
            'user' => $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ] : null,
            'kandidat' => $this->kandidat ? [
                'id' => $this->kandidat->id,
                'no_kandidat' => $this->kandidat->no_kandidat,
                'nama' => $this->kandidat->nama,
                'status' => $this->kandidat->status,
                'jenis_kelamin' => $this->kandidat->jenis_kelamin,
                'tgl_interview' => $this->kandidat->tgl_interview,
                'tgl_berangkat' => $this->kandidat->tgl_berangkat,
                'institusi' => $this->kandidat->institusi ? [
                    'id' => $this->kandidat->institusi->id,
                    'nama' => $this->kandidat->institusi->nama,
                ] : null,
                'bidang_ssws' => $this->kandidat->bidang_ssws->map(fn ($b) => [
                    'id' => $b->id,
                    'bidang' => $b->bidang,
                ]),
            ] : null,
        ];
    }
}
