@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Status Interview: {{ $kandidat->pendaftaran->nama ?? 'Kandidat' }}</h3>

    <form action="{{ route('kandidat.update', $kandidat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Status Interview -->
        <div class="mb-3">
            <label for="status_interview" class="form-label">Status Interview</label>
            <select name="status_interview" id="status_interview" class="form-select" required>
                <option value="Pending" {{ $kandidat->status_interview == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Selesai" {{ $kandidat->status_interview == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Gagal" {{ $kandidat->status_interview == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                <option value="Jadwalkan Interview Ulang" {{ $kandidat->status_interview == 'Jadwalkan Interview Ulang' ? 'selected' : '' }}>Jadwalkan Interview Ulang</option>
            </select>
        </div>

        <!-- Institusi / Penempatan -->
        <div class="mb-3">
            <label for="institusi_id" class="form-label">Penempatan / Institusi</label>
            <select name="institusi_id" id="institusi_id" class="form-select">
                <option value="">- Pilih Institusi -</option>
                @foreach ($institusis as $institusi)
                    <option value="{{ $institusi->id }}" {{ $kandidat->institusi_id == $institusi->id ? 'selected' : '' }}>
                        {{ $institusi->nama_institusi }}
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
            <input type="date" name="jadwal_interview" id="jadwal_interview" class="form-control" value="{{ old('jadwal_interview', $kandidat->jadwal_interview ? \Carbon\Carbon::parse($kandidat->jadwal_interview)->format('Y-m-d') : '') }}">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update Status & Penempatan</button>
            <a href="{{ route('kandidat.data') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
