@extends('layouts.app')

@section('content')
<div class="">
    
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md">
            <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Detail
                </li>
            </ol>
        </nav>
   
    <div class="card p-4 shadow-sm rounded-4">
        <!-- Foto Kandidat -->
        <div class="text-center mb-4">
            <img src="{{ asset($kandidat->foto) }}" alt="Foto Kandidat" class="rounded-circle border" width="150" height="150">
        </div>

        <!-- Data Dasar -->
        <h5 class="mb-3">Identitas Dasar</h5>
        <table class="table table-bordered">
            <tr><th>NIK</th><td>{{ $kandidat->nik }}</td></tr>
            <tr><th>Nama</th><td>{{ $kandidat->nama }}</td></tr>
            <tr><th>Usia</th><td>{{ $kandidat->usia }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $kandidat->jenis_kelamin }}</td></tr>
            <tr><th>Agama</th><td>{{ $kandidat->agama }}</td></tr>
            <tr><th>Status</th><td>{{ $kandidat->status }}</td></tr>
            <tr><th>Email</th><td>{{ $kandidat->email }}</td></tr>
            <tr><th>No WA</th><td>{{ $kandidat->no_wa }}</td></tr>
            <tr><th>Tempat, Tanggal Lahir</th><td>{{ $kandidat->tempat_lahir }}, {{ \Carbon\Carbon::parse($kandidat->tempat_tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
            <tr><th>Alamat</th><td>{{ $kandidat->alamat }}, {{ $kandidat->kelurahan }}, {{ $kandidat->kecamatan }}, {{ $kandidat->kab_kota }}, {{ $kandidat->provinsi }}</td></tr>
            <tr><th>Tanggal Daftar</th><td>{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}</td></tr>
            <tr><th>Cabang</th><td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td></tr>
        </table>

        <!-- Data Tambahan -->
        <h5 class="mt-4 mb-3">Informasi Tambahan</h5>
        <table class="table table-bordered">
            <tr><th>ID Prometric</th><td>{{ $kandidat->id_prometric ?? '-' }}</td></tr>
            <tr><th>Password Prometric</th><td>{{ $kandidat->password_prometric ?? '-' }}</td></tr>
            <tr><th>Pernah ke Jepang</th><td>{{ $kandidat->pernah_ke_jepang }}</td></tr>
            <tr><th>Paspor</th><td>
                @if($kandidat->paspor)
                    <a href="{{ asset($kandidat->paspor) }}" target="_blank">Lihat Paspor</a>
                @else
                    -
                @endif
            </td></tr>
        </table>

        <!-- Status Verifikasi & Catatan -->
        <h5 class="mt-4 mb-3">Status Verifikasi</h5>
        <table class="table table-bordered">
            <tr><th>Verifikasi</th><td>{{ $kandidat->verifikasi }}</td></tr>
            <tr><th>Catatan Admin</th><td>{{ $kandidat->catatan_admin ?? '-' }}</td></tr>
        </table>

        <!-- Dokumen Upload -->
        <h5 class="mt-4 mb-3">Dokumen</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="{{ asset($kandidat->foto) }}" target="_blank">Foto</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->sertifikat_jft) }}" target="_blank">Sertifikat JFT</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->sertifikat_ssw) }}" target="_blank">Sertifikat SSW</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->kk) }}" target="_blank">KK</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->ktp) }}" target="_blank">KTP</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->bukti_pelunasan) }}" target="_blank">Bukti Pelunasan</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->akte) }}" target="_blank">Akte</a></li>
            <li class="list-group-item"><a href="{{ asset($kandidat->ijasah) }}" target="_blank">Ijazah</a></li>
        </ul>

        <div class="mt-4">
            <a href="/kandidat" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
