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
            $getStatusBadge = function ($status, $colors) {
                $color = $colors[$status] ?? 'bg-gray-100 text-gray-700';
                return '<span class="px-2 py-1 rounded text-xs font-medium ' . $color . '">' . $status . '</span>';
            };
        @endphp

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Status</h2>
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Perusahaan</th>
                        <th class="px-4 py-2 border">Bidang SSW</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $index => $history)
                        <tr class="border">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{!! $getStatusBadge($history->status_kandidat, $statusColors) !!}</td>
                            <td class="px-4 py-2 border">{{ $history->institusi->perusahaan_penempatan ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $history->bidang_ssw ?? '-' }}</td>
                            <td class="px-4 py-2 border text-gray-500">{{ $history->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Tidak ada riwayat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Ringkasan Interview per Perusahaan</h2>
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">Perusahaan LPK</th>
                        <th class="px-4 py-2 border">Perusahaan Jepang</th>
                        <th class="px-4 py-2 border">Bidang SSW</th>
                        <th class="px-4 py-2 border text-center">Jml</th>
                        <th class="px-4 py-2 border text-center">Status</th>
                        <th class="px-4 py-2 border text-center">Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($interviewPerPerusahaan as $data)
                        <tr class="border">
                            <td class="px-4 py-2 border">{{ $data['institusi']->perusahaan_penempatan ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $data['nama_perusahaan_history'] ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $data['bidang_ssw'] ?? '-' }}</td>
                            <td class="px-4 py-2 border text-center font-medium">{{ $data['jumlah_interview'] }}x</td>
                            <td class="px-4 py-2 border text-center">{!! $getStatusBadge($data['status_terakhir'], $statusColors) !!}</td>
                            <td class="px-4 py-2 border text-center text-gray-500">{{ $data['tanggal_terakhir']->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada ringkasan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection