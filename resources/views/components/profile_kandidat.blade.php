@forelse ($dataKandidat as $kandidat)
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <!-- Header -->
            <div class="card-header text-center  py-3">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-person-vcard me-2"></i> Pendaftaran Kandidat
                </h5>
            </div>

            <!-- Body -->
            <div class="card-body text-center p-4">

                <!-- Foto -->
                <div class="position-relative mb-3">
                    <img src="{{ asset($kandidat->foto) }}" class="rounded-circle shadow" width="120" height="120"
                        style="object-fit: cover; border: 4px solid #fff;">
                </div>

                <!-- Nama & Email -->
                <h5 class="fw-bold mb-1">{{ $kandidat->nama }}</h5>
                <p class="text-muted mb-3">
                    <i class="bi bi-envelope text-primary me-1"></i> {{ $kandidat->email }}
                </p>

                <!-- Informasi -->
                <div class="text-start small mb-4">

                    <div class="d-flex mb-2">
                        <i class="bi bi-building me-2 text-info fs-5"></i>
                        <span>Cabang: <strong>{{ $kandidat->cabang->nama_cabang ?? 'Tidak diketahui' }}</strong></span>
                    </div>

                    <div class="d-flex mb-2">
                        <i class="bi bi-gender-ambiguous me-2 text-warning fs-5"></i>
                        <span>Jenis Kelamin: <strong>{{ $kandidat->jenis_kelamin }}</strong></span>
                    </div>

                    <div class="d-flex mb-2">
                        <i class="bi bi-telephone me-2 text-success fs-5"></i>
                        <span>No WA: <strong>{{ $kandidat->no_wa }}</strong></span>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">

                    <!-- Lihat Dokumen -->
                    <a href="{{ route('dokumen.show', $kandidat->id) }}"
                        class="btn btn-dark w-100 shadow-sm fw-semibold">
                        <i class="bi bi-folder2-open me-2"></i>
                        <span class="d-none d-sm-inline">Lihat Dokumen</span>
                    </a>

                    <!-- Edit Data -->
                    <a href="{{ route('pendaftaran.edit.profile', $kandidat->id) }}"
                        class="btn btn-outline-dark w-100 shadow-sm fw-semibold">
                        <i class="bi bi-pencil-square me-2"></i>
                        <span class="d-none d-sm-inline">Edit Data</span>
                    </a>

                </div>

            </div>

            <!-- Footer -->
            <div class="card-footer text-center py-2 small">
                <i class="bi bi-calendar-event text-secondary me-1"></i>
                Terdaftar sejak:
                <strong>{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}</strong>
            </div>

        </div>
    </div>

@empty
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Belum Melakukan Pendaftaran',
                html: `
                    <p>Kamu belum melakukan pendaftaran.</p>
                    <a href="{{ route('pendaftaran.create') }}"
                       class="btn btn-warning fw-semibold mt-2">
                       <i class="bi bi-pencil-square me-1"></i> Klik di sini untuk daftar
                    </a>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                background: '#fffaf0',
                color: '#333',
            });
        });
    </script>
@endforelse
