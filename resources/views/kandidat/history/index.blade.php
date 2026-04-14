@extends('layouts.app')

@section('title', 'History Kandidat')

@section('content')
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $kandidat->pendaftaran->nama ?? 'Kandidat' }}</h1>
                <p class="text-gray-500 text-sm">{{ $kandidat->pendaftaran->email ?? '-' }}</p>
            </div>
            <a href="{{ route('kandidat.data') }}" class="text-gray-600 hover:text-gray-900">
                ← Kembali
            </a>
        </div>

        @php
            $statusColors = [
                'Job Matching' => 'bg-gray-100 text-gray-700',
                'lamar ke perusahaan' => 'bg-gray-100 text-gray-700',
                'Pending' => 'bg-yellow-100 text-yellow-700',
                'Interview' => 'bg-blue-100 text-blue-700',
                'Gagal Interview' => 'bg-red-100 text-red-700',
                'Jadwalkan Interview Ulang' => 'bg-gray-800 text-white',
                'Lulus interview' => 'bg-indigo-100 text-indigo-700',
                'Pemberkasan' => 'bg-blue-100 text-blue-700',
                'Berangkat' => 'bg-green-100 text-green-700',
                'Diterima' => 'bg-green-100 text-green-700',
                'Ditolak' => 'bg-red-100 text-red-700',
            ];
            $interviewColors = [
                'Belum Interview' => 'bg-gray-100 text-gray-700',
                'Jadwal Ditetapkan' => 'bg-blue-100 text-blue-700',
                'Selesai Interview' => 'bg-green-100 text-green-700',
                'Gagal Interview' => 'bg-red-100 text-red-700',
            ];
            $getBadge = function ($status, $colors) {
                $color = $colors[$status] ?? 'bg-gray-100 text-gray-700';
                return '<span class="px-2 py-1 rounded text-xs font-medium ' . $color . '">' . ($status ?? '-') . '</span>';
            };
        @endphp

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Semua History</h2>
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Status Kandidat</th>
                        <th class="px-4 py-2 border">Status Interview</th>
                        <th class="px-4 py-2 border">Perusahaan</th>
                        <th class="px-4 py-2 border">Bidang SSW</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $index => $history)
                        <tr class="border">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{!! $getBadge($history->status_kandidat, $statusColors) !!}</td>
                            <td class="px-4 py-2 border">{!! $getBadge($history->status_interview, $interviewColors) !!}</td>
                            <td class="px-4 py-2 border">{{ $history->kandidat->nama_perusahaan ?? '-' }}</td>
                            <td class="px-4 py-2 border">
                                @if ($history->bidang_ssw)
                                    {{ is_array($history->bidang_ssw) ? implode(', ', $history->bidang_ssw) : $history->bidang_ssw }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-gray-500">{{ $history->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada history</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Summary Interview per Perusahaan</h2>
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Perusahaan</th>
                        <th class="px-4 py-2 border">Bidang SSW</th>
                        <th class="px-4 py-2 border text-center">Jml</th>
                        <th class="px-4 py-2 border text-center">Status</th>
                        <th class="px-4 py-2 border text-center">Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($interviewPerPerusahaan as $data)
                        <tr class="border">
                            <td class="px-4 py-2 border">{{ $data['nama_perusahaan_history'] ?? ($kandidat->nama_perusahaan ?? '-') }}</td>
                            <td class="px-4 py-2 border">
                                @if (isset($data['bidang_ssw']))
                                    {{ is_array($data['bidang_ssw']) ? implode(', ', $data['bidang_ssw']) : $data['bidang_ssw'] }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 border text-center font-medium">{{ $data['jumlah_interview'] }}</td>
                            <td class="px-4 py-2 border text-center">{!! $getBadge($data['status_terakhir'], $interviewColors) !!}</td>
                            <td class="px-4 py-2 border text-center text-gray-500">{{ $data['tanggal_terakhir']->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada history interview</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection