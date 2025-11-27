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
        // 1. AMBIL SEMUA USER BESERTA STATUS ONLINE
        // ===============================
        $users = User::select('id', 'name', 'last_activity')
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($user) {

                // Jika belum ada aktivitas → OFFLINE
                if (!$user->last_activity) {
                    $user->status = 'Offline';
                    return $user;
                }

                $last = Carbon::parse($user->last_activity);
                $diff = $last->diffInMinutes(now());

                if ($diff <= 2) {
                    $user->status = 'Online';
                } elseif ($diff > 2 && $diff <= 10) {
                    $user->status = 'Idle';
                } else {
                    $user->status = 'Offline';
                }

                return $user;
            });

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




        return view('dashboard', compact(
            'stats',
            'status_penempatan',
            'cabangs',
            'chart_data',
            'dataKandidat',
            'kandidats',
            'cvs', // <-- data kandidat
            'kandidatsFiltered',

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
}
