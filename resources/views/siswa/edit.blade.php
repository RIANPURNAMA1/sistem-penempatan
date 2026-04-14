@extends('layouts.app')

@section('content')
    <div class="space-y-4">
        <nav class="bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-3">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-700">Dashboard</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">Verifikasi Kandidat</span>
            </div>
        </nav>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-5 py-3 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Edit Verifikasi & Catatan</h2>
            </div>
            <div class="p-5">
                @if ($errors->any())
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal!',
                            html: `{!! implode('<br>', $errors->all()) !!}`,
                            confirmButtonColor: '#dc3545'
                        });
                    </script>
                @endif

                <form id="verifikasiForm" action="{{ route('siswa.update', $kandidat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="verifikasi" class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
                        <select name="verifikasi" id="verifikasi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">
                            <option value="menunggu" {{ $kandidat->verifikasi == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="data belum lengkap" {{ $kandidat->verifikasi == 'data belum lengkap' ? 'selected' : '' }}>Data Belum Lengkap</option>
                            <option value="diterima" {{ $kandidat->verifikasi == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ $kandidat->verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="catatan_admin" class="block text-sm font-medium text-gray-700 mb-1">Catatan Admin</label>
                        <textarea name="catatan_admin" id="catatan_admin" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">{{ old('catatan_admin', $kandidat->catatan_admin) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('siswa.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            Kembali
                        </a>
                        <button type="submit" id="btnSubmit" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#verifikasiForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let btn = $('#btnSubmit');

                btn.prop('disabled', true);
                btn.html('<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span> Memproses...');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message ?? 'Data verifikasi berhasil diperbarui!',
                            confirmButtonColor: '#198754'
                        }).then(() => {
                            if ($('#verifikasi').val() === 'diterima') {
                                window.location.href = "{{ route('kandidat.data') }}";
                            } else {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        let errorMsg = errors ? Object.values(errors).flat().join('<br>') : 'Terjadi kesalahan!';
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: errorMsg,
                            confirmButtonColor: '#dc3545'
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                        btn.html('Simpan Perubahan');
                    }
                });
            });
        });
    </script>
@endsection
