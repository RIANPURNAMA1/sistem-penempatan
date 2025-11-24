<!-- Bootstrap 5 & DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="py-4">

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif


    <div class="card   shadow shadow-md border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center">
        </div>

        <div class="card-body table-responsive">
            <table id="tableKandidat" class="table align-middle mb-0 bg-white">
                <thead class="text-dark fw-bold">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Siswa</th>
                        <th>Cabang</th>
                        <th>Status Kandidat</th>
                        <th>Status Interview</th>
                        <th>Penempatan</th>
                        <th>Tanggal Daftar</th>
                        <th>Jumlah Interview</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kandidats as $index => $kandidat)
                        <tr>
                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                            <td>{{ $kandidat->pendaftaran->nama ?? '-' }}</td>
                            <td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>
                            <td class="text-center">
                                <span
                                    class="badge 
                                    {{ $kandidat->status_kandidat === 'Job Matching' ? 'bg-secondary text-white' : '' }}
                                    {{ $kandidat->status_kandidat === 'Pending' ? 'bg-info text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Interview' ? 'bg-warning text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Gagal Interview' ? 'bg-danger' : '' }}
                                    {{ $kandidat->status_kandidat === 'Jadwalkan Interview Ulang' ? 'bg-primary' : '' }}
                                    {{ $kandidat->status_kandidat === 'Lulus interview' ? 'bg-success' : '' }}
                                    {{ $kandidat->status_kandidat === 'Pemberkasan' ? 'bg-secondary text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Berangkat' ? 'bg-success' : '' }}
                                    {{ $kandidat->status_kandidat === 'Ditolak' ? 'bg-danger' : '' }}">
                                    {{ $kandidat->status_kandidat }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge {{ $kandidat->jumlah_interview > 0 ? 'bg-success' : 'bg-info text-dark' }}">
                                    {{ $kandidat->jumlah_interview > 0 ? 'SELESAI' : 'PENDING' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if ($kandidat->institusi)
                                    <span
                                        class="badge bg-primary">{{ $kandidat->institusi->nama_perusahaan ?? '-' }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">{{ $kandidat->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center"><span
                                    class="badge bg-secondary">{{ $kandidat->jumlah_interview }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}"
                                    class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('kandidat.history', $kandidat->id) }}"
                                    class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-clock-history"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    var table = $('#tableKandidat').DataTable({
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
</script>
