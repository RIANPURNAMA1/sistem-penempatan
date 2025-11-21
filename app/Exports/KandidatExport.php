<?php

namespace App\Exports;

use App\Models\Kandidat;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KandidatExport implements FromArray, WithHeadings
{
    protected $kandidat;

    public function __construct($kandidat)
    {
        $this->kandidat = $kandidat;
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Email',
            'No WA',
            'Tinggi Badan',
            'Berat Badan',
            'Keahlian',
            'Pendidikan',
            'Pengalaman Kerja'
        ];
    }

    public function array(): array
    {
        return [[
            $this->kandidat->nama_lengkap,
            $this->kandidat->tempat_lahir,
            $this->kandidat->tanggal_lahir,
            $this->kandidat->jenis_kelamin,
            $this->kandidat->alamat,
            $this->kandidat->email,
            $this->kandidat->no_wa,
            $this->kandidat->tinggi_badan,
            $this->kandidat->berat_badan,
            $this->kandidat->keahlian,

            // Gabungkan relasi menjadi string
            $this->kandidat->pendidikan->map(function ($p) {
                return "{$p->nama} - {$p->jurusan} ({$p->tahun})";
            })->implode(", "),

            $this->kandidat->pengalamans->map(function ($p) {
                return "{$p->perusahaan} ({$p->jabatan}) - {$p->periode}";
            })->implode(", "),
        ]];
    }
}
