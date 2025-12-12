@extends('layouts.app')

@section('title', 'History Kandidat')

@section('content')

    <div class="mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('kandidat.data') }}" class="text-decoration-none text-secondary">
                        <i class="bi bi-people me-1"></i> Daftar Kandidat
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="bi bi-clock-history me-1"></i> History Kandidat
                </li>
            </ol>
        </nav>

        <!-- Profil Kandidat -->
        <div class="d-flex align-items-center mb-4 gap-3">
            @if ($kandidat->pendaftaran->foto ?? false)
                <img src="{{ asset($kandidat->pendaftaran->foto) }}" alt="Foto Kandidat"
                    class="rounded-circle border shadow-sm" width="80" height="80">
            @else
                <div class="rounded-circle border shadow-sm d-flex justify-content-center align-items-center"
                    style="width:80px; height:80px; background-color:#f0f0f0;">
                    <i class="bi bi-person-fill fs-3 text-muted"></i>
                </div>
            @endif
            <div>
                <h3 class="mb-0">{{ $kandidat->pendaftaran->nama ?? 'Kandidat' }}</h3>
                <small class="text-muted">{{ $kandidat->pendaftaran->email ?? '-' }}</small>
            </div>
        </div>

        @php
            // --- Pindahkan logic warna status ke sini atau ke helper ---
            $statusColors = [
                'Job Matching' => 'secondary',
                'Pending' => 'warning',
                'Interview' => 'info',
                'Gagal Interview' => 'danger',
                'Jadwalkan Interview Ulang' => 'dark',
                'Lulus interview' => 'primary',
                'Pemberkasan' => 'info',
                'Berangkat' => 'success', // Ganti 'Berangkat' ke success (hijau)
                'Diterima' => 'success',
                'Ditolak' => 'danger',
            ];

            $getStatusBadge = function ($status, $colors) {
                $color = $colors[$status] ?? 'secondary';
                return '<span class="badge bg-' . $color . ' px-3 py-2 text-wrap">' . $status . '</span>';
            };
        @endphp

        {{-- ================================================================= --}}
        {{-- 1. Tabel History Lengkap --}}
        {{-- ================================================================= --}}
        <div class="card shadow-lg border-0 rounded-4 mb-5">
            <div class="card-header  rounded-top-4 py-3">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i> Riwayat Status Kandidat</h5>
            </div>
            <div class="card-body table-responsive p-4">
                <table class="table  align-middle nowrap" id="tableHistoryAll" style="width:100%">
                    <thead class="">
                        <tr class="text-center">
                            <th class="py-3">No</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Perusahaan Penempatan (LPK)</th>
                            <th class="py-3">Perusahaan Jepang</th>
                            <th class="py-3">Bidang SSW</th>
                            <th class="py-3">Tanggal & Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $index => $history)
                            <tr class="align-middle">
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>

                                <td>
                                    {!! $getStatusBadge($history->status_kandidat, $statusColors) !!}
                                </td>

                                <td>
                                    <span class="d-block text-truncate" style="max-width: 250px;"
                                        title="{{ $history->institusi->perusahaan_penempatan ?? 'Tidak ada data' }}">
                                        {{ $history->institusi->perusahaan_penempatan ?? '<span class="text-muted fst-italic">-</span>' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="d-block text-truncate" style="max-width: 250px;"
                                        title="{{ $history->kandidat->nama_perusahaan ?? 'Tidak ada data' }}">
                                        {{ $history->kandidat->nama_perusahaan ?? '<span class="text-muted fst-italic">-</span>' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $history->bidang_ssw ?? '<span class="text-muted fst-italic">-</span>' }}
                                </td>


                                <td class="text-center text-nowrap small text-muted">
                                    {{ $history->created_at->format('d M Y') }}<br>
                                    <span class="fw-semibold">{{ $history->created_at->format('H:i') }} WIB</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-info-circle me-1"></i> Tidak ada riwayat status yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        {{-- ================================================================= --}}
        {{-- 2. Tabel Summary Interview per Perusahaan --}}
        {{-- ================================================================= --}}
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header  rounded-top-4 py-3">
                <h5 class="mb-0"><i class="bi bi-briefcase-fill me-2"></i> Ringkasan Interview Berdasarkan Perusahaan</h5>
            </div>
            <div class="card-body table-responsive p-4">
                <table class="table align-middle nowrap" id="tableSummary" style="width:100%">
                    <thead class="">
                        <tr>
                            <th class="py-3">Perusahaan Penempatan (LPK)</th>
                            <th class="py-3">Perusahaan Jepang Terakhir</th>
                            <th class="py-3">Bidang SSW</th>
                            <th class="py-3 text-center">Jumlah Interview</th>
                            <th class="py-3 text-center">Status Terakhir</th>
                            <th class="py-3 text-center">Tanggal Status Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($interviewPerPerusahaan as $index => $data)
                            <tr>
                                {{-- KOLOM 1: Perusahaan Penempatan --}}
                                <td>
                                    {{ $data['institusi']->perusahaan_penempatan ?? '<span class="text-muted fst-italic">-</span>' }}
                                </td>

                                {{-- KOLOM 2: Nama Perusahaan Jepang (History) --}}
                                <td>
                                    {{ $data['nama_perusahaan_history'] ?? '<span class="text-muted fst-italic">-</span>' }}
                                </td>

                                {{-- KOLOM 3: Bidang SSW --}}
                                <td>
                                    {{ $data['bidang_ssw'] ?? '<span class="text-muted fst-italic">-</span>' }}
                                </td>

                                {{-- Kolom 4: Jumlah Interview --}}
                                <td class="text-center fw-bold">{{ $data['jumlah_interview'] }}x</td>

                                {{-- Kolom 5: Status Terakhir (Menggunakan Badge Warna) --}}
                                <td class="text-center">
                                    {!! $getStatusBadge($data['status_terakhir'], $statusColors) !!}
                                </td>

                                {{-- Kolom 6: Tanggal Terakhir --}}
                                <td class="text-center text-nowrap small text-muted">
                                    {{ $data['tanggal_terakhir']->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    <i class="bi bi-info-circle me-1"></i> Tidak ada ringkasan interview yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                const dataTableConfig = {
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    language: {
                        search: "🔍 Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        zeroRecords: "Tidak ada data ditemukan",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                        infoFiltered: "(disaring dari _MAX_ total data)",
                        paginate: {
                            previous: "←",
                            next: "→"
                        }
                    }
                };

                // Inisialisasi Tabel 1
                $('#tableHistoryAll').DataTable(dataTableConfig);

                // Inisialisasi Tabel 2
                $('#tableSummary').DataTable(dataTableConfig);
            });
        </script>
    </div>
    @if (auth()->check() && auth()->user()->role === 'super-admin')
        <!-- Back Button -->
        <div class="mt-3">
            <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Kandidat
            </a>
        </div>
    @endif

    @if (auth()->check() &&
            auth()->user()->role ===
                'Cabang Cianjur Selatan Mendunia,Cabang Cianjur Pamoyanan Mendunia,Cabang Batam Mendunia,Cabang Banyuwangi Mendunia,Cabang Kendal Mendunia,Cabang Pati Mendunia,Cabang Tulung Agung Mendunia,Cabang Bangkalan Mendunia,Cabang Bojonegoro Mendunia,Cabang Jember Mendunia,Cabang Wonosobo Mendunia,Cabang Eshan Mendunia')
        <!-- Back Button -->
        <div class="mt-3">
            <a href="/" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    @endif
    </div>
    <!-- JS Dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Inisialisasi DataTables
        var table = $('#tableKandidatutama').DataTable({
            responsive: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });


        // Custom filter untuk Cabang dan Status
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var selectedCabang = $('#filterCabang').val();
                var selectedStatus = $('#filterStatus').val();

                // Ambil elemen row
                var rowNode = table.row(dataIndex).node();

                // Ambil teks cabang dan status
                var cabang = $('td:eq(3)', rowNode).text().trim(); // kolom Cabang
                var status = $('td:eq(4)', rowNode).text().trim(); // kolom Status Kandidat

                var cabangMatch = selectedCabang === "" || cabang === selectedCabang;
                var statusMatch = selectedStatus === "" || status === selectedStatus;

                return cabangMatch && statusMatch;
            }
        );

        // Event filter change
        $('#filterCabang, #filterStatus').on('change', function() {
            table.draw(); // redraw tabel dengan filter baru
        });

        // Reset filter
        $('#resetFilter').on('click', function() {
            $('#filterCabang').val('');
            $('#filterStatus').val('');
            table.draw();
        });
    </script>

@endsection
