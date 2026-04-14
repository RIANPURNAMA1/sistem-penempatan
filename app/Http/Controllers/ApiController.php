<?php

namespace App\Http\Controllers;

use App\Http\Resources\PendaftaranKandidatResource;
use App\Models\Kandidat;
use App\Models\KandidatHistory;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPendaftaranDanKandidat(Request $request)
    {
        $query = Pendaftaran::with(['user', 'cabang', 'kandidat', 'kandidat.institusi', 'kandidat.bidang_ssws']);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_pendaftaran', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pendaftaran = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => PendaftaranKandidatResource::collection($pendaftaran),
        ]);
    }

    public function getPendaftaranById($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'cabang', 'kandidat', 'kandidat.institusi', 'kandidat.bidang_ssws'])->find($id);

        if (! $pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PendaftaranKandidatResource($pendaftaran),
        ]);
    }

    public function getKandidat(Request $request)
    {
        $query = Kandidat::with(['pendaftaran', 'cabang', 'institusi', 'bidang_ssws', 'histories']);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_kandidat', 'like', "%{$search}%")
                    ->orWhereHas('pendaftaran', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%")
                            ->orWhere('nik', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('status') && $request->status) {
            $query->where('status_kandidat', $request->status);
        }

        $kandidat = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $kandidat->map(fn ($k) => [
                'id' => $k->id,
                'no_kandidat' => $k->no_kandidat,
                'nama' => $k->nama,
                'status_kandidat' => $k->status_kandidat,
                'status_kandidat_di_mendunia' => $k->status_kandidat_di_mendunia,
                'jumlah_interview' => $k->jumlah_interview,
                'nama_perusahaan' => $k->nama_perusahaan,
                'detail_pekerjaan' => $k->detail_pekerjaan,
                'catatan_interview' => $k->catatan_interview,
                'jadwal_interview' => $k->jadwal_interview,
                'tgl_setsumeikai_ichijimensetsu' => $k->tgl_setsumeikai_ichijimensetsu,
                'tgl_mensetsu' => $k->tgl_mensetsu,
                'tgl_mensetsu2' => $k->tgl_mensetsu2,
                'catatan_mensetsu' => $k->catatan_mensetsu,
                'biaya_pemberkasan' => $k->biaya_pemberkasan,
                'adm_tahap1' => $k->adm_tahap1,
                'dokumen_dikirim_soft_file' => $k->dokumen_dikirim_soft_file,
                'terbit_kontrak_kerja' => $k->terbit_kontrak_kerja,
                'kontrak_dikirim_ke_tsk' => $k->kontrak_dikirim_ke_tsk,
                'terbit_paspor' => $k->terbit_paspor,
                'masuk_imigrasi_jepang' => $k->masuk_imigrasi_jepang,
                'coe_terbit' => $k->coe_terbit,
                'adm_tahap2' => $k->adm_tahap2,
                'pembuatan_ektkln' => $k->pembuatan_ektkln,
                'dokumen_dikirim' => $k->dokumen_dikirim,
                'visa' => $k->visa,
                'jadwal_penerbangan' => $k->jadwal_penerbangan,
                'created_at' => $k->created_at,
                'updated_at' => $k->updated_at,
                'pendaftaran' => $k->pendaftaran ? [
                    'id' => $k->pendaftaran->id,
                    'no_pendaftaran' => $k->pendaftaran->no_pendaftaran,
                    'nama' => $k->pendaftaran->nama,
                    'nik' => $k->pendaftaran->nik,
                    'email' => $k->pendaftaran->email,
                    'no_wa' => $k->pendaftaran->no_wa,
                ] : null,
                'cabang' => $k->cabang ? [
                    'id' => $k->cabang->id,
                    'nama_cabang' => $k->cabang->nama_cabang,
                ] : null,
                'institusi' => $k->institusi ? [
                    'id' => $k->institusi->id,
                    'nama' => $k->institusi->nama,
                ] : null,
                'bidang_ssws' => $k->bidang_ssws->map(fn ($b) => [
                    'id' => $b->id,
                    'bidang' => $b->bidang,
                ]),
                'histories' => $k->histories->map(fn ($h) => [
                    'id' => $h->id,
                    'status' => $h->status,
                    'catatan' => $h->catatan,
                    'created_at' => $h->created_at,
                ]),
            ]),
        ]);
    }

    public function getKandidatById($id)
    {
        $kandidat = Kandidat::with(['pendaftaran', 'cabang', 'institusi', 'bidang_ssws', 'histories'])->find($id);

        if (! $kandidat) {
            return response()->json([
                'success' => false,
                'message' => 'Kandidat tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $kandidat->id,
                'no_kandidat' => $kandidat->no_kandidat,
                'nama' => $kandidat->nama,
                'status_kandidat' => $kandidat->status_kandidat,
                'status_kandidat_di_mendunia' => $kandidat->status_kandidat_di_mendunia,
                'jumlah_interview' => $kandidat->jumlah_interview,
                'nama_perusahaan' => $kandidat->nama_perusahaan,
                'detail_pekerjaan' => $kandidat->detail_pekerjaan,
                'catatan_interview' => $kandidat->catatan_interview,
                'jadwal_interview' => $kandidat->jadwal_interview,
                'tgl_setsumeikai_ichijimensetsu' => $kandidat->tgl_setsumeikai_ichijimensetsu,
                'tgl_mensetsu' => $kandidat->tgl_mensetsu,
                'tgl_mensetsu2' => $kandidat->tgl_mensetsu2,
                'catatan_mensetsu' => $kandidat->catatan_mensetsu,
                'biaya_pemberkasan' => $kandidat->biaya_pemberkasan,
                'adm_tahap1' => $kandidat->adm_tahap1,
                'dokumen_dikirim_soft_file' => $kandidat->dokumen_dikirim_soft_file,
                'terbit_kontrak_kerja' => $kandidat->terbit_kontrak_kerja,
                'kontrak_dikirim_ke_tsk' => $kandidat->kontrak_dikirim_ke_tsk,
                'terbit_paspor' => $kandidat->terbit_paspor,
                'masuk_imigrasi_jepang' => $kandidat->masuk_imigrasi_jepang,
                'coe_terbit' => $kandidat->coe_terbit,
                'adm_tahap2' => $kandidat->adm_tahap2,
                'pembuatan_ektkln' => $kandidat->pembuatan_ektkln,
                'dokumen_dikirim' => $kandidat->dokumen_dikirim,
                'visa' => $kandidat->visa,
                'jadwal_penerbangan' => $kandidat->jadwal_penerbangan,
                'created_at' => $kandidat->created_at,
                'updated_at' => $kandidat->updated_at,
                'pendaftaran' => $kandidat->pendaftaran ? [
                    'id' => $kandidat->pendaftaran->id,
                    'no_pendaftaran' => $kandidat->pendaftaran->no_pendaftaran,
                    'nama' => $kandidat->pendaftaran->nama,
                    'nik' => $kandidat->pendaftaran->nik,
                    'email' => $kandidat->pendaftaran->email,
                    'no_wa' => $kandidat->pendaftaran->no_wa,
                ] : null,
                'cabang' => $kandidat->cabang ? [
                    'id' => $kandidat->cabang->id,
                    'nama_cabang' => $kandidat->cabang->nama_cabang,
                ] : null,
                'institusi' => $kandidat->institusi ? [
                    'id' => $kandidat->institusi->id,
                    'nama' => $kandidat->institusi->nama,
                ] : null,
                'bidang_ssws' => $kandidat->bidang_ssws->map(fn ($b) => [
                    'id' => $b->id,
                    'bidang' => $b->bidang,
                ]),
                'histories' => $kandidat->histories->map(fn ($h) => [
                    'id' => $h->id,
                    'status' => $h->status,
                    'catatan' => $h->catatan,
                    'created_at' => $h->created_at,
                ]),
            ],
        ]);
    }

    public function getHistory(Request $request)
    {
        $query = KandidatHistory::with(['kandidat', 'institusi']);

        if ($request->has('kandidat_id') && $request->kandidat_id) {
            $query->where('kandidat_id', $request->kandidat_id);
        }

        $history = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $history->map(fn ($h) => [
                'id' => $h->id,
                'kandidat_id' => $h->kandidat_id,
                'status_kandidat' => $h->status_kandidat,
                'status_interview' => $h->status_interview,
                'institusi_id' => $h->institusi_id,
                'catatan_interview' => $h->catatan_interview,
                'jadwal_interview' => $h->jadwal_interview,
                'bidang_ssw' => $h->bidang_ssw,
                'nama_perusahaan' => $h->nama_perusahaan,
                'detail_pekerjaan' => $h->detail_pekerjaan,
                'created_at' => $h->created_at,
                'updated_at' => $h->updated_at,
                'kandidat' => $h->kandidat ? [
                    'id' => $h->kandidat->id,
                    'no_kandidat' => $h->kandidat->no_kandidat,
                    'nama' => $h->kandidat->nama,
                ] : null,
                'institusi' => $h->institusi ? [
                    'id' => $h->institusi->id,
                    'nama' => $h->institusi->nama,
                ] : null,
            ]),
        ]);
    }

    public function getHistoryById($id)
    {
        $history = KandidatHistory::with(['kandidat', 'institusi'])->find($id);

        if (! $history) {
            return response()->json([
                'success' => false,
                'message' => 'History tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $history->id,
                'kandidat_id' => $history->kandidat_id,
                'status_kandidat' => $history->status_kandidat,
                'status_interview' => $history->status_interview,
                'institusi_id' => $history->institusi_id,
                'catatan_interview' => $history->catatan_interview,
                'jadwal_interview' => $history->jadwal_interview,
                'bidang_ssw' => $history->bidang_ssw,
                'nama_perusahaan' => $history->nama_perusahaan,
                'detail_pekerjaan' => $history->detail_pekerjaan,
                'created_at' => $history->created_at,
                'updated_at' => $history->updated_at,
                'kandidat' => $history->kandidat ? [
                    'id' => $history->kandidat->id,
                    'no_kandidat' => $history->kandidat->no_kandidat,
                    'nama' => $history->kandidat->nama,
                ] : null,
                'institusi' => $history->institusi ? [
                    'id' => $history->institusi->id,
                    'nama' => $history->institusi->nama,
                ] : null,
            ],
        ]);
    }
}
