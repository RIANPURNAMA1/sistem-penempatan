<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Cv;
use App\Models\Institusi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use App\Models\Kandidat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        // Ambil data untuk user yang login
        $totalUsers = User::count(); // total semua user
        $totalKandidat = Pendaftaran::count(); // total kandidat
        $totalCabang = Cabang::count(); // total cabang
        $totalInstitusi = Institusi::count(); // total institusi

        // Buat array untuk dinamis di Blade
        $stats = [
            [
                'title' => 'Total User Login',
                'count' => $totalUsers,
                'icon'  => 'bi-person-bounding-box',
                'color' => 'blue'
            ],
            [
                'title' => 'Total Kandidat',
                'count' => $totalKandidat,
                'icon'  => 'bi-people-fill',
                'color' => 'green'
            ],
            [
                'title' => 'Total Cabang',
                'count' => $totalCabang,
                'icon'  => 'bi-building',
                'color' => 'purple'
            ],
            [
                'title' => 'Total Institusi',
                'count' => $totalInstitusi,
                'icon'  => 'bi-bank',
                'color' => 'red'
            ]
        ];

        // Daftar semua status tetap
        $all_status = [
            'Job Matching',
            'Pending',
            'Interview',
            'Gagal Interview',
            'Jadwalkan Interview Ulang',
            'Lulus interview',
            'Pemberkasan',
            'Berangkat',
            'Ditolak'
        ];

        // Ambil total per status kandidat dari DB
        $status_penempatan_db = Kandidat::select('status_kandidat')
            ->selectRaw('COUNT(*) as jumlah')
            ->groupBy('status_kandidat')
            ->pluck('jumlah', 'status_kandidat')
            ->toArray();

        // Gabungkan semua status dengan default 0
        $status_penempatan = [];
        foreach ($all_status as $status) {
            $status_penempatan[$status] = $status_penempatan_db[$status] ?? 0;
        }

        // Ambil semua cabang
        $cabangs = Cabang::pluck('nama_cabang', 'id')->toArray(); // ['1' => 'Cabang Bandung', ...]

        // Hitung jumlah kandidat per status per cabang
        $chart_data = [];
        foreach ($all_status as $status) {
            $data_per_status = [];
            foreach ($cabangs as $id => $nama) {
                $jumlah = Kandidat::where('cabang_id', $id)
                    ->where('status_kandidat', $status)
                    ->count();
                $data_per_status[] = $jumlah;
            }
            $chart_data[] = [
                'name' => $status,
                'data' => $data_per_status
            ];
        }

        // ===============================
        // 1. AMBIL SEMUA USER DAN STATUS ONLINE
        // ===============================
        $users = User::select('id', 'name', 'last_activity')
            ->get()
            ->map(function ($user) {

                // Jika belum pernah aktivitas, otomatis OFFLINE
                if (!$user->last_activity) {
                    $user->status = 'Offline';
                    return $user;
                }

                $last = Carbon::parse($user->last_activity);
                $diff = $last->diffInMinutes(now());

                if ($diff <= 2) {
                    $user->status = 'Online';
                } elseif ($diff <= 10) {
                    $user->status = 'Idle';
                } else {
                    $user->status = 'Offline';
                }

                return $user;
            });

        // ===============================
        // 2. URUTKAN: ONLINE → IDLE → OFFLINE → ALFABET
        // ===============================
        $users = $users->sortBy([
            fn($a, $b) => strcmp($a->status, $b->status), // diprioritaskan dengan mapping manual
            'name',
        ]);

        // Lakukan mapping prioritas (Online = 1, Idle = 2, Offline = 3)
        $users = $users->sortBy(function ($u) {
            return [
                $u->status === 'Online' ? 1 : ($u->status === 'Idle' ? 2 : 3),
                $u->name
            ];
        })->values();

        // distribusi status kandidat
        // Ambil semua status dan jumlahnya
        $statusData = Kandidat::select('status_kandidat', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status_kandidat')
            ->orderBy('status_kandidat')
            ->get();

        // Pisahkan menjadi labels & counts
        $statusLabels = $statusData->pluck('status_kandidat');
        $statusCounts = $statusData->pluck('jumlah');

        // Ambil semua data kandidat untuk tabel
        $kandidats = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])
            ->orderBy('created_at', 'desc')
            ->get();


        $dataKandidat = Pendaftaran::with(['kandidat', 'cabang'])->where('user_id', Auth::id())->get();
        // Ambil CV milik user yang sedang login
        $userId = Auth::id(); // id user login
        $cvs = CV::where('user_id', $userId)->with(['pendidikans', 'pengalamans'])->get();


        $user = Auth::user();
        $queryKandidat = Kandidat::with(['pendaftaran', 'cabang', 'institusi']);

        // ===============================
        // ADMIN CABANG → filter berdasarkan nama role
        // ===============================
        if ($user->role !== 'super admin') {
            // Ambil nama cabang dari role user
            $namaCabang = $user->role;

            // cocokkan dengan nama cabang di tabel cabang
            $queryKandidat->whereHas('cabang', function ($q) use ($namaCabang) {
                $q->where('nama_cabang', $namaCabang);
            });
        }

        // ===============================
        // SUPER ADMIN → boleh filter cabang
        // ===============================
        if ($user->role === 'super admin' && request()->filled('cabang_id')) {
            $queryKandidat->where('cabang_id', request('cabang_id'));
        }

        // ===============================
        // FILTER STATUS (berlaku untuk semua role)
        // ===============================
        if (request()->filled('status_kandidat')) {
            $queryKandidat->where('status_kandidat', request('status_kandidat'));
        }

        $kandidatsFiltered = $queryKandidat
            ->orderBy('created_at', 'desc')
            ->paginate(1)   // jumlah per halaman
            ->withQueryString(); // agar filter tidak hilang saat berpindah halaman


        // Ambil data kandidat beserta relasi pendaftaran, cabang, dan institusi
        $kandidatstableall = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])
            ->orderBy('created_at', 'desc')
            ->paginate(15); // pagination, 15 data per halaman




        return view('dashboard', compact(
            'stats',
            'status_penempatan',
            'cabangs',
            'chart_data',
            'dataKandidat',
            'kandidats',
            'cvs', // <-- data kandidat
            'kandidatsFiltered',
            'kandidatstableall',
            'statusLabels',
            'statusCounts',
            'users'
        ));
    }



    public function showKandidat($id)
    {
        $kandidat = Kandidat::with(['pendaftaran', 'cabang', 'institusi'])->findOrFail($id);
        return view('kandidat.show', compact('kandidat'));
    }

    public function DataKandidat(Request $request)
    {
        $cabang = Cabang::all();

        $query = Pendaftaran::with('cabang');

        if ($request->has('cabang_id') && $request->cabang_id != '') {
            $query->where('cabang_id', $request->cabang_id);
        }

        $kandidats = $query->get();

        return view('siswa.index', compact('kandidats', 'cabang'));
    }

    public function editProfile($id)
    {
        $kandidat = Pendaftaran::findOrFail($id);
        return view('pendaftaran.edit_profile_pendaftaran', compact('kandidat'));
    }

    public function updateProfile(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'sometimes|required|string|size:16|unique:pendaftarans,nik,' . $pendaftaran->id,
            'nama' => 'sometimes|required|string|max:255',
            'usia' => 'sometimes|required|string|max:255',
            'agama' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|in:belum menikah,menikah,lajang',
            'email' => 'sometimes|required|email|max:255|unique:pendaftarans,email,' . $pendaftaran->id,
            'no_wa' => ['sometimes', 'required', 'string', 'max:15', 'regex:/^08\d{8,12}$/'],
            'jenis_kelamin' => 'sometimes|required|in:Laki-laki,Perempuan',
            'alamat' => 'sometimes|required|string|max:500',
            'provinsi' => 'sometimes|required|string|max:100',
            'kab_kota' => 'sometimes|required|string|max:100',
            'kecamatan' => 'sometimes|required|string|max:100',
            'kelurahan' => 'sometimes|required|string|max:100',
            'cabang_id' => 'sometimes|required|exists:cabangs,id',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'tempat_tanggal_lahir' => 'sometimes|required|date',
            'tanggal_daftar' => 'sometimes|required|date',

            'id_prometric' => 'nullable|string|max:255',
            'password_prometric' => 'nullable|string|max:255',
            'pernah_ke_jepang' => 'sometimes|required|in:Ya,Tidak',

            // FIELD BARU
            'pendidikan_terakhir' => 'sometimes|string|max:255',
            'bidang_ssw' => 'sometimes|in:Pengolahan makanan,Restoran,Pertanian,Kaigo (perawat),Building cleaning,Driver,Lainnya',

            // FILE OPSIONAL saat update
            'paspor' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'bukti_pelunasan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'akte' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijasah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_jft' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'sertifikat_ssw' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            // Pesan error
            'file.max' => 'Ukuran file melebihi batas.',
            'foto.max' => 'Ukuran foto melebihi batas 3MB.',
            'kk.max' => 'Ukuran KK melebihi batas 5MB.',
            'ktp.max' => 'Ukuran KTP melebihi batas 5MB.',
            'bukti_pelunasan.max' => 'Ukuran bukti pelunasan melebihi batas 5MB.',
            'akte.max' => 'Ukuran akte melebihi batas 5MB.',
            'ijasah.max' => 'Ukuran ijazah melebihi batas 5MB.',
            'sertifikat_jft.max' => 'Ukuran sertifikat JFT melebihi batas 5MB.',
            'sertifikat_ssw.max' => 'Ukuran sertifikat SSW melebihi batas 5MB.',
            'paspor.max' => 'Ukuran paspor melebihi batas 5MB.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali 08 dan memiliki 10–13 digit.',
            'status.in' => 'Status harus: belum menikah, menikah, atau lajang.',
        ]);


        /*
    |--------------------------------------------------------------------------
    | 1. Siapkan data text (exclude file fields)
    |--------------------------------------------------------------------------
    */
        $data = $request->except([
            '_token',
            '_method',
            'foto',
            'kk',
            'ktp',
            'paspor',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw'
        ]);


        /*
    |--------------------------------------------------------------------------
    | 2. Daftar file yang perlu diproses
    |--------------------------------------------------------------------------
    */
        $files = [
            'foto',
            'kk',
            'ktp',
            'bukti_pelunasan',
            'akte',
            'ijasah',
            'sertifikat_jft',
            'sertifikat_ssw',
            'paspor'
        ];


        /*
    |--------------------------------------------------------------------------
    | 3. Upload file baru & hapus file lama
    |--------------------------------------------------------------------------
    */
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {

                // HAPUS FILE LAMA jika ada
                if (!empty($pendaftaran->$fileKey)) {
                    $oldFilePath = public_path($pendaftaran->$fileKey);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // UPLOAD FILE BARU
                $file = $request->file($fileKey);
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path("dokumen/{$fileKey}");

                // Pastikan folder ada
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                // Pindahkan file
                $file->move($destination, $filename);

                // Simpan path baru ke array $data
                $data[$fileKey] = "dokumen/{$fileKey}/{$filename}";
            }
        }


        /*
    |--------------------------------------------------------------------------
    | 4. Update Database
    |--------------------------------------------------------------------------
    */
        $pendaftaran->update($data);


        return redirect()
            ->route('dashboard')
            ->with('success', 'Pendaftaran berhasil diperbarui!');
    }
}
