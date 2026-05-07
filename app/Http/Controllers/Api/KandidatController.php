<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BidangSsw;
use App\Models\Kandidat;
use App\Models\KandidatHistory;
use Illuminate\Http\Request;

class KandidatController extends Controller
{
    public function index(Request $request)
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

    public function show($id)
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

    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'status_kandidat' => 'required|in:Job Matching,Pending,Interview,Jadwalkan Interview Ulang,Lulus interview,Gagal Interview,Pemberkasan,Berangkat,Ditolak,lamar ke perusahaan',
                'institusi_id' => 'nullable|exists:institusis,id',
                'catatan_interview' => 'nullable|string',
                'jadwal_interview' => 'nullable|date',
                'nama_perusahaan' => 'nullable|string',
                'bidang_ssw' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $kandidat = Kandidat::with('pendaftaran')->find($id);

            if (! $kandidat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kandidat tidak ditemukan',
                ], 404);
            }

            $status_lama = $kandidat->status_kandidat;

            if (in_array($request->status_kandidat, ['Interview', 'Jadwalkan Interview Ulang'])
                && empty($request->jadwal_interview)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tanggal interview wajib diisi',
                ], 422);
            }

            if ($status_lama === 'Lulus interview' && in_array($request->status_kandidat, [
                'Interview', 'Jadwalkan Interview Ulang', 'Gagal Interview',
            ])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak boleh mengubah status setelah lulus',
                ], 422);
            }

            if (in_array($status_lama, ['Pemberkasan', 'Berangkat'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak bisa diubah setelah tahap akhir',
                ], 422);
            }

            if ($request->status_kandidat === 'Interview' && $status_lama !== 'Interview') {
                $kandidat->jumlah_interview += 1;
            }

            $kandidat->update([
                'status_kandidat' => $request->status_kandidat,
                'institusi_id' => $request->institusi_id,
                'catatan_interview' => $request->catatan_interview,
                'jadwal_interview' => $request->jadwal_interview,
                'nama_perusahaan' => $request->nama_perusahaan,
                'jumlah_interview' => $kandidat->jumlah_interview,
            ]);

            $kandidat->bidang_ssws()->delete();

            $bidang = $kandidat->pendaftaran->bidang_ssws()
                ->find($request->bidang_ssw);

            if ($bidang) {
                BidangSsw::create([
                    'kandidat_id' => $kandidat->id,
                    'pendaftaran_id' => $kandidat->pendaftaran_id,
                    'nama_bidang' => $bidang->nama_bidang,
                ]);
            }

            KandidatHistory::create([
                'kandidat_id' => $kandidat->id,
                'status_kandidat' => $kandidat->status_kandidat,
                'nama_perusahaan' => $kandidat->nama_perusahaan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data kandidat berhasil diperbarui',
                'data' => $kandidat->fresh(['pendaftaran', 'institusi', 'bidang_ssws']),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
