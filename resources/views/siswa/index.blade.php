@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <!-- Init Theme -->
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    </head>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <div class=" ">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4 shadow shadow-md">
            <ol class="breadcrumb  border rounded-3 px-3 py-2 shadow-sm mb-0">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none text-secondary">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active  fw-semibold" aria-current="page">
                    <i class="bi bi-people me-1"></i> Daftar Kandidat
                </li>
            </ol>
        </nav>

        {{-- <!-- Header -->
        <div class="mb-4 text-center text-md-start">
            <h2 class="fw-bold  mb-2">
                <i class="bi bi-person-lines-fill text-warning me-2"></i> Daftar Pendaftar
            </h2>
            <p class="text-muted fst-italic">
                Berikut adalah data pendaftaran kandidat yang telah masuk dalam sistem.
            </p>
        </div> --}}

        <!-- Filter -->
        <div class="card shadow shadow-md border-0 rounded-3 mb-4">
            <div class="card-header py-3 px-4 rounded-top-4 border-bottom-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold mb-0 text-secondary">
                            <i class="bi bi-funnel me-1"></i> Filter Data
                        </h6>
                    </div>
                    <div class="d-flex flex-wrap gap-3 align-items-center">

                        <!-- Import Excel Box -->
                        <form id="importForm" enctype="multipart/form-data" class="import-form">
                            @csrf
                            <div class="import-box d-flex align-items-center gap-2">
                                <!-- Hidden Input -->
                                <input type="file" name="file" id="fileInput" accept=".xlsx,.xls" required
                                    class="d-none">

                                <!-- Label Pilih File -->
                                <label for="fileInput" class="file-label d-flex align-items-center gap-2">
                                    <i class="bi bi-cloud-upload-fill "></i>
                                    <span id="fileText" class="file-text">Pilih File Excel</span>
                                </label>

                                <!-- Import Button -->
                                <button type="submit" class="btn btn-primary btn-sm fw-semibold px-3">
                                    <i class="bi bi-upload me-1"></i>Import
                                </button>
                                <div>

                                    <!-- Export Excel -->
                                    <a href="/pendaftaran/export/exels" class="btn btn-success btn-sm fw-semibold px-3">
                                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                        <span>Export Excel</span>
                                    </a>

                                    <!-- Export PDF -->
                                    <a href="/pendaftaran/export/pdf" target="_blank"
                                        class="btn btn-danger btn-sm fw-semibold px-3">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                        <span>Export PDF</span>
                                    </a>
                                </div>

                            </div>
                        </form>

                        <!-- Export Buttons -->
                        <div class="d-flex flex-wrap gap-2">



                        </div>

                    </div>


                    <style>
                        /* Import Wrapper */
                        .import-box {
                            background: #ffffff;
                            border: 1px solid #dee2e6;
                            border-radius: 8px;
                            padding: 6px 8px;
                            transition: .25s ease;
                        }

                        .import-box:hover {
                            border-color: #0d6efd;
                            box-shadow: 0 0 0 0.18rem rgba(13, 110, 253, 0.15);
                        }

                        /* File Label */
                        .file-label {
                            cursor: pointer;
                            padding: 6px 10px;
                            color: #495057;
                            font-size: 14px;
                            border-radius: 6px;
                            transition: color .2s ease;
                        }

                        .file-label:hover {
                            color: #0d6efd;
                        }

                        .file-text {
                            display: inline-block;
                            max-width: 180px;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                        }
                    </style>


                </div>
            </div>

            <div class="card-body shadow shadow-md">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-6">
                        <form id="filterForm">
                            <label for="filterCabang" class="form-label fw-semibold text-secondary">Cabang</label>

                            <select name="cabang_id" id="filterCabang" class="form-select shadow-sm rounded-3 border-1">
                                <option value="">Semua Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('cabang_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

            </div>
        </div>


        <!-- Data Table -->
        <div class="card shadow shadow-md border-0 rounded-4">
            <div class="card-body table-responsive">
                <table id="tablependaftar" class="table table-striped shadow shadow-md align-middle nowrap"
                    style="width:100%">
                    <thead style="color: #000;">
                        <tr class=" fw-bold">
                            <th class="">No</th>
                            <th class="">Foto</th>
                            <th class="">Nik</th>
                            <th class="">Nama</th>
                            <th class="">Email</th>
                            <th class="">Alamat</th>
                            <th class="">Tempat Lahir</th>
                            <th class="">Tanggal Lahir</th>
                            <th class="">Pendidikan Terakhir</th>
                            <th class="">Bidang SSW</th>
                            <th class="">Jenis Kelamin</th>
                            <th class="">No WA</th>
                            <th class="">Cabang</th>
                            <th class="">KK</th>
                            <th class="">KTP</th>
                            <th class="">Bukti Pelunasan</th>
                            <th class="">Akte</th>
                            <th class="">Ijazah</th>
                            <th class="">Tanggal Daftar</th>
                            <th class="">Verifikasi</th>
                            <th class="">Catatan Admin</th>
                            <th class="">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kandidats as $index => $kandidat)
                            <tr data-cabang="{{ $kandidat->cabang_id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="/pendaftaran/{{ $kandidat->id }}/pendaftar">
                                        <img src="{{ $kandidat->foto && file_exists(public_path($kandidat->foto))
                                            ? asset($kandidat->foto)
                                            : asset('images/default-user.png') }}"
                                            alt="Foto Kandidat" class="rounded-circle border" width="50" height="50">
                                    </a>
                                </td>



                                <td>{{ $kandidat->nik }}</td>
                                <td>{{ ucwords(strtolower($kandidat->nama)) }}</td>

                                <td>{{ $kandidat->email }}</td>
                                <td>{{ $kandidat->alamat }}</td>
                                <td>{{ $kandidat->tempat_lahir }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($kandidat->tempat_tanggal_lahir)->translatedFormat('d F Y') }}
                                </td>

                                <td>{{ $kandidat->pendidikan_terakhir }}</td>

                                <td>{{ $kandidat->bidang_ssw }}</td>

                                <td>{{ $kandidat->jenis_kelamin }}</td>
                                <td>{{ $kandidat->no_wa }}</td>
                                <td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>

                                <!-- KK -->
                                <td>
                                    <a href="{{ asset($kandidat->kk) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>

                                <!-- KTP -->
                                <td>
                                    <a href="{{ asset($kandidat->ktp) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>

                                <!-- Bukti Pelunasan -->
                                <td>
                                    <a href="{{ asset($kandidat->bukti_pelunasan) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>

                                <!-- Akte -->
                                <td>
                                    <a href="{{ asset($kandidat->akte) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>

                                <!-- Ijazah -->
                                <td>
                                    <a href="{{ asset($kandidat->ijasah) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </a>
                                </td>

                                <!-- Tanggal Daftar -->
                                <td>{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}</td>

                                <!-- Status Verifikasi -->
                                <td>
                                    @if ($kandidat->verifikasi == 'menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif ($kandidat->verifikasi == 'data belum lengkap')
                                        <span class="badge bg-info text-dark">Data Belum Lengkap</span>
                                    @elseif ($kandidat->verifikasi == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>

                                <!-- Catatan Admin -->
                                <td>{{ $kandidat->catatan_admin ?? '-' }}</td>

                                <!-- Aksi -->
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">

                                            <!-- Verifikasi -->
                                            <li>
                                                <a href="{{ route('siswa.edit', $kandidat->id) }}" class="dropdown-item">
                                                    <i class="bi bi-check2-square me-1"></i> Verifikasi
                                                </a>
                                            </li>

                                            <!-- Edit Data -->
                                            <li>
                                                <a href="{{ route('pendaftaran.edit.full', $kandidat->id) }}"
                                                    class="dropdown-item">
                                                    <i class="bi bi-pencil-square me-1"></i> Edit Data
                                                </a>
                                            </li>

                                            {{-- <!-- Export Data -->
                                            <li>
                                                <a href="{{ route('siswa.edit', $kandidat->id) }}" class="dropdown-item">
                                                    <i class="bi bi-file-earmark-excel me-1"></i> Export Data
                                                </a>
                                            </li> --}}

                                            <?php
                                            $nomor_wa_bersih = preg_replace('/^0/', '62', $kandidat->no_wa);
                                            ?>
                                            <li>
                                                <a href="https://wa.me/<?php echo $nomor_wa_bersih; ?>" class="dropdown-item"
                                                    target="_blank">
                                                    <i class="bi bi-whatsapp me-1"></i> Wa
                                                </a>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <!-- Hapus -->
                                            <li>
                                                <button class="dropdown-item text-danger delete-btn"
                                                    data-id="{{ $kandidat->id }}">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </li>

                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
                <!-- Pagination links -->
                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">

                </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            const filterCabang = document.getElementById("filterCabang");
            const rows = document.querySelectorAll("#tablependaftar tbody tr");

            filterCabang.addEventListener("change", function() {
                const selectedCabang = this.value;

                rows.forEach(row => {
                    const rowCabang = row.getAttribute("data-cabang");

                    // Jika tidak memilih cabang = tampilkan semua
                    if (selectedCabang === "" || selectedCabang === rowCabang) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
        // Inisialisasi DataTables
        var table = $('#tablependaftar').DataTable({
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

        $('.delete-form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let id = form.data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data pendaftaran akan terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/pendaftaran/" + id,
                        type: "POST",
                        data: {
                            _token: form.find('input[name="_token"]').val(),
                            _method: "DELETE"
                        },
                        success: function(response) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus!',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // hapus row dari tabel (opsional)
                            form.closest('tr').remove();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus data.'
                            });
                        }
                    });

                }
            });

        });


        // Import Request
        $('#importForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('pendaftaran.import') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                beforeSend: function() {
                    Swal.fire({
                        title: 'Mengimport...',
                        text: 'Harap tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },

                success: function(response) {
                    Swal.close();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message ?? 'Data berhasil diimport.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                },

                error: function(xhr) {
                    Swal.close();

                    let msg = 'Terjadi kesalahan saat mengimport data.';

                    // --- ERROR MYSQL / SQLSTATE ---
                    if (xhr.responseText && xhr.responseText.includes('SQLSTATE')) {
                        msg = `
                    Format data Excel tidak sesuai.<br>
                    Pastikan setiap baris memiliki:
                    <br><b>- NIK</b><br><b>- Nama</b><br><b>- Status</b><br>
                    dan kolom wajib lainnya tidak boleh kosong.
                `;
                    }

                    // --- ERROR DARI LARAVEL RESPONSE JSON ---
                    else if (xhr.responseJSON && xhr.responseJSON.message) {

                        // Jika error validasi
                        if (xhr.responseJSON.errors) {
                            msg = "<b>Format Excel salah:</b><br>";
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                msg += `- ${value}<br>`;
                            });
                        } else {
                            msg = xhr.responseJSON.message;
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengimport!',
                        html: msg,
                        showConfirmButton: true
                    });
                }
            });
        });





        $(document).on('click', '.delete-btn', function() {
            let btn = $(this);
            let id = btn.data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data pendaftaran dan user terkait akan terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/pendaftaran/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        beforeSend: function() {
                            btn.prop('disabled', true).html('Loading...');
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message || 'Data berhasil dihapus',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Hapus row dari DataTables
                            table.row(btn.closest('tr')).remove().draw();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus data.'
                            });
                        },
                        complete: function() {
                            btn.prop('disabled', false).html(
                                '<i class="bi bi-trash"></i> Hapus');
                        }
                    });
                }
            });
        });
    </script>

    {{-- 
    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Pilih File Excel';
            document.getElementById('fileText').textContent = fileName;
        });

        document.getElementById('importForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const btn = this.querySelector('.btn-import');
            const originalHtml = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Importing...';

            fetch('/pendaftaran/import', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('✓ Import berhasil!');
                        location.reload();
                    } else {
                        alert('✗ ' + data.message);
                    }
                })
                .catch(error => alert('Error: ' + error.message))
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                });
        });
    </script> --}}

@endsection
