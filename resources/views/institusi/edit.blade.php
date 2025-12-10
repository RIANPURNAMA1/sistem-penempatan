@extends('layouts.app')

@section('content')
    <div class="mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    <i class="bi bi-pencil-square"></i> Edit Perusahaan
                </li>
            </ol>
        </nav>

        <div class="card shadow-sm rounded-4">
            <div class="card-header text-white">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i> Edit Perusahaan
                </h5>
            </div>
            <div class="card-body">
                <form id="formEditPerusahaan">
                    @csrf
                    @method('PUT') <!-- Penting untuk update -->
                    <div class="row g-3">
                
                        <div class="col-md-6">
                            <label for="perusahaan_penempatan" class="form-label fw-semibold">Perusahaan Penempatan</label>
                            <input type="text" name="perusahaan_penempatan" id="perusahaan_penempatan"
                                class="form-control"
                                value="{{ old('perusahaan_penempatan', $institusi->perusahaan_penempatan) }}">
                        </div>
                      
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <a href="{{ route('institusi.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-success" id="btnUpdate">
                            <i class="bi bi-save2 me-1"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery & SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#formEditPerusahaan').submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let btn = $('#btnUpdate');

                // Tambah spinner loading
                btn.prop('disabled', true);
                btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...'
                    );

                $.ajax({
                    url: "{{ route('institusi.update', $institusi->id) }}",
                    method: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data perusahaan berhasil diperbarui.',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('institusi.index') }}";
                        });
                    },
                    error: function(xhr) {
                        let errors = '';
                        if (xhr.responseJSON?.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errors += `• ${value[0]}<br>`;
                            });
                        } else {
                            errors = 'Terjadi kesalahan pada server.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            html: errors,
                            confirmButtonText: 'Tutup'
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                        btn.html('<i class="bi bi-save2 me-1"></i> Update Data');
                    }
                });
            });
        });
    </script>
@endsection
