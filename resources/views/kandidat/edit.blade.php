@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Status Kandidat & Interview: {{ $kandidat->pendaftaran->nama ?? 'Kandidat' }}</h3>

        <form action="{{ route('kandidat.update', $kandidat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Status Kandidat -->
            <!-- Status Kandidat -->
            <div class="mb-3">
                <label for="status_kandidat" class="form-label">Status Kandidat</label>
                <select name="status_kandidat" id="status_kandidat" class="form-select" required>

                    <option value="Job Matching" {{ $kandidat->status_kandidat == 'Job Matching' ? 'selected' : '' }}>
                        Job Matching
                    </option>

                    <option value="Pending" {{ $kandidat->status_kandidat == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Interview" {{ $kandidat->status_kandidat == 'Interview' ? 'selected' : '' }}>
                        Interview
                    </option>

                    <option value="Jadwalkan Interview Ulang"
                        {{ $kandidat->status_kandidat == 'Jadwalkan Interview Ulang' ? 'selected' : '' }}>
                        Jadwalkan Interview Ulang
                    </option>

                    <option value="Lulus interview" {{ $kandidat->status_kandidat == 'Lulus interview' ? 'selected' : '' }}>
                        Lulus Interview
                    </option>

                    <option value="Gagal Interview" {{ $kandidat->status_kandidat == 'Gagal Interview' ? 'selected' : '' }}>
                        Gagal Interview
                    </option>

                    <option value="Pemberkasan" {{ $kandidat->status_kandidat == 'Pemberkasan' ? 'selected' : '' }}>
                        Pemberkasan
                    </option>

                    <option value="Berangkat" {{ $kandidat->status_kandidat == 'Berangkat' ? 'selected' : '' }}>
                        Berangkat
                    </option>

                    <option value="Diterima" {{ $kandidat->status_kandidat == 'Diterima' ? 'selected' : '' }}>
                        Diterima
                    </option>

                    <option value="Ditolak" {{ $kandidat->status_kandidat == 'Ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>

                </select>
            </div>



            <!-- Institusi / Penempatan -->
            <div class="mb-3">
                <label for="institusi_id" class="form-label">Penempatan / Institusi</label>
                <select name="institusi_id" id="institusi_id" class="form-select">
                    <option value="">- Pilih Institusi -</option>
                    @foreach ($institusis as $institusi)
                        <option value="{{ $institusi->id }}"
                            {{ $kandidat->institusi_id == $institusi->id ? 'selected' : '' }}>
                            {{ $institusi->nama_perusahaan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Catatan Interview -->
            <div class="mb-3">
                <label for="catatan_interview" class="form-label">Catatan Interview</label>
                <textarea name="catatan_interview" id="catatan_interview" class="form-control" rows="3">{{ old('catatan_interview', $kandidat->catatan_interview) }}</textarea>
            </div>

            <!-- Jadwal Interview -->
            <div class="mb-3">
                <label for="jadwal_interview" class="form-label">Jadwal Interview</label>
                <input type="date" name="jadwal_interview" id="jadwal_interview" class="form-control"
                    value="{{ old('jadwal_interview', $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('Y-m-d') : '') }}">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Status & Penempatan</button>
                <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Maaf',
                    text: '{{ session('error') }}',
                    showConfirmButton: true
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'OK'
                });
            @endif
        </script>

@endsection
