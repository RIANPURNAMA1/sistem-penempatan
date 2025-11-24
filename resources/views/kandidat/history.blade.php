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

        <!-- Tabel 1: Semua History -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body table-responsive">
                <h5 class="mb-3">Semua History</h5>
                <table class="table table-striped table-bordered align-middle nowrap table-hover" id="tableHistoryAll"
                    style="width:100%">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="py-3">No</th>
                            <th class="py-3">Status Kandidat</th>
                            <th class="py-3">Nama Perusahaan</th>
                            <th class="py-3">Bidang Pekerjaan</th>
                            <th class="py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $statusColors = [
                                'Job Matching' => 'secondary',
                                'Pending' => 'warning',
                                'Interview' => 'info',
                                'Gagal Interview' => 'danger',
                                'Jadwalkan Interview Ulang' => 'dark',
                                'Lulus interview' => 'primary',
                                'Pemberkasan' => 'info',
                                'Berangkat' => 'primary',
                                'Diterima' => 'success',
                                'Ditolak' => 'danger',
                            ];
                        @endphp

                        @forelse ($histories as $index => $history)
                            <tr class="align-middle">
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>

                                <td>
                                    <span
                                        class="badge bg-{{ $statusColors[$history->status_kandidat] ?? 'secondary' }} px-3 py-2">
                                        {{ $history->status_kandidat }}
                                    </span>
                                </td>

                                <td>
                                    <span class="d-block text-truncate" style="max-width: 200px;"
                                        title="{{ $history->institusi->nama_perusahaan ?? '-' }}">
                                        {{ $history->institusi->nama_perusahaan ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="d-block text-truncate" style="max-width: 200px;"
                                        title="{{ $history->institusi->bidang_pekerjaan ?? '-' }}">
                                        {{ $history->institusi->bidang_pekerjaan ?? '-' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    {{ $history->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-1"></i> Belum ada history untuk kandidat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Inisialisasi DataTables -->
                <script>
                    $(document).ready(function() {
                        $('#tableHistoryAll').DataTable({
                            responsive: true,
                            pageLength: 10,
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
                    });
                </script>

            </div>
        </div>

        <!-- Tabel 2: Summary per Perusahaan -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body table-responsive">
                <h5 class="mb-3">Summary Interview per Perusahaan</h5>
                <table class="table table-striped table-bordered align-middle nowrap" id="tableSummary" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">Nama Perusahaan</th>
                            <th class="py-3">Bidang Pekerjaan</th>
                            <th class="py-3 text-center">Jumlah Interview</th>
                            <th class="py-3 text-center">Status Terakhir</th>
                            <th class="py-3 text-center">Tanggal Terakhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($interviewPerPerusahaan as $index => $data)
                            <tr>
                                <td>{{ $data['institusi']->nama_perusahaan ?? '-' }}</td>
                                <td>{{ $data['institusi']->bidang_pekerjaan ?? '-' }}</td>
                                <td class="text-center fw-semibold">{{ $data['jumlah_interview'] }}</td>
                                <td class="text-center">{{ $data['status_terakhir'] }}</td>
                                <td class="text-center">{{ $data['tanggal_terakhir']->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-1"></i> Belum ada history interview untuk kandidat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-3">
            <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Kandidat
            </a>
        </div>

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
