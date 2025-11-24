@extends('layouts.app')

@section('title', 'Daftar CV')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<div class="container">

    <div class="mb-4">
        <h2 class="fw-bold mb-2"><i class="bi bi-card-checklist text-warning me-2"></i> Daftar CV Kandidat</h2>
        <p class="text-muted fst-italic">Berikut merupakan data CV yang telah diinput oleh para kandidat.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-3">
        <div class="table-responsive">
            <table id="cvTable" class="table table-striped table-bordered align-middle table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat & Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No WA</th>
                        <th>Tinggi / Berat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cvs as $index => $cv)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $cv->nama_lengkap_romaji ?? $cv->nama_lengkap_katakana ?? '-' }}</td>
                            <td>{{ $cv->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $cv->tempat_tanggal_lahir ?? '-' }}</td>
                            <td>{{ $cv->alamat_lengkap ?? '-' }}</td>
                            <td>{{ $cv->email_aktif ?? $cv->email ?? '-' }}</td>
                            <td>{{ $cv->no_telepon ?? '-' }}</td>
                            <td>{{ $cv->tinggi_badan ?? '-' }} cm / {{ $cv->berat_badan ?? '-' }} kg</td>
                            <td class="text-center">
                                <a href="{{ route('cv.show', $cv->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$('#cvTable').DataTable({
    responsive: true,
    pageLength: 5,
    language: {
        search: "🔍 Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        zeroRecords: "Tidak ada data ditemukan",
        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
        paginate: { previous: "←", next: "→" }
    }
});
</script>

@endsection
