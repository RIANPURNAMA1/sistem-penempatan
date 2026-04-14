@forelse ($dataKandidat as $kandidat)
    <div class="w-full max-w-sm">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                <h5 class="font-semibold text-gray-800">
                    <svg class="w-5 h-5 inline-block mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Pendaftaran Kandidat
                </h5>
            </div>

            <div class="p-6 text-center">
                <div class="mb-4">
                    <img src="{{ asset($kandidat->foto) }}" class="w-28 h-28 rounded-full object-cover shadow-lg border-4 border-white mx-auto">
                </div>

                <h5 class="text-lg font-bold text-gray-900 mb-1">{{ $kandidat->nama }}</h5>
                <p class="text-gray-500 text-sm mb-4">
                    <svg class="w-4 h-4 inline-block mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $kandidat->email }}
                </p>

                <div class="text-left space-y-3 text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Cabang: <strong class="text-gray-800">{{ $kandidat->cabang->nama_cabang ?? 'Tidak diketahui' }}</strong></span>
                    </div>

                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Jenis Kelamin: <strong class="text-gray-800">{{ $kandidat->jenis_kelamin }}</strong></span>
                    </div>

                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>No WA: <strong class="text-gray-800">{{ $kandidat->no_wa }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="px-6 pb-6">
                <div class="flex gap-2">
                    <a href="{{ route('dokumen.show', $kandidat->id) }}" class="flex-1 px-4 py-2.5 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-900 transition text-center">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        Dokumen
                    </a>
                    <a href="{{ route('pendaftaran.edit.profile', $kandidat->id) }}" class="flex-1 px-4 py-2.5 bg-amber-100 text-amber-700 text-sm font-medium rounded-lg hover:bg-amber-200 transition text-center">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 text-center">
                <span class="text-gray-500 text-sm">
                    <svg class="w-4 h-4 inline-block mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Terdaftar sejak: <strong class="text-gray-700">{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}</strong>
                </span>
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