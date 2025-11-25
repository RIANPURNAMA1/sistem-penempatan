@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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

                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <!-- Import Form -->
                        <form id="importForm" enctype="multipart/form-data" class="d-flex gap-2 align-items-center">
                            @csrf
                            <input type="file" name="file" accept=".xlsx,.xls" required
                                class="form-control form-control-sm">
                            <button class="btn btn-primary btn-sm">Import</button>
                        </form>

                        <!-- Export Excel Button -->
                        <a href="{{ route('pendaftaran.export') }}" class="btn btn-success btn-sm fw-semibold shadow-sm">
                            <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                        </a>

                        <!-- Export PDF Button -->
                        <a href="" target="_blank"
                            class="btn btn-danger btn-sm fw-semibold shadow-sm">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                        </a>
                    </div>

                </div>
            </div>

            <div class="card-body shadow shadow-md">
                <div class="row g-3 align-items-end">
                    <!-- Filter Cabang -->
                    <div class="col-12 col-md-6">
                        <form action="{{ route('pendaftar') }}" method="GET" id="filterForm">
                            <label for="filterCabang" class="form-label fw-semibold text-secondary">Cabang</label>
                            <select name="cabang_id" id="filterCabang" class="form-select shadow-sm rounded-3 border-1"
                                onchange="document.getElementById('filterForm').submit()">
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

                    <!-- Tombol Reset -->
                    <div class="col-12 col-md-6 d-flex justify-content-end">
                        <button id="resetFilter" class="btn btn-outline-info fw-semibold shadow-sm px-4 py-2 rounded-3">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Filter
                        </button>
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
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <!-- FOTO -->
                                <td style="cursor: pointer">
                                    <img src="{{ asset($kandidat->foto) }}" alt="Foto Kandidat"
                                        class="rounded-circle border foto-detail" width="50" height="50"
                                        data-bs-toggle="modal" data-bs-target="#detailModal" data-nik="{{ $kandidat->nik }}"
                                        data-nama="{{ $kandidat->nama }}" data-usia="{{ $kandidat->usia }}"
                                        data-agama="{{ $kandidat->agama }}" data-status="{{ $kandidat->status }}"
                                        data-email="{{ $kandidat->email }}" data-no_wa="{{ $kandidat->no_wa }}"
                                        data-jk="{{ $kandidat->jenis_kelamin }}"
                                        data-tempat="{{ $kandidat->tempat_lahir }}"
                                        data-ttl="{{ \Carbon\Carbon::parse($kandidat->tempat_tanggal_lahir)->translatedFormat('d F Y') }}"
                                        data-alamat="{{ $kandidat->alamat }}" data-provinsi="{{ $kandidat->provinsi }}"
                                        data-kab="{{ $kandidat->kab_kota }}" data-kec="{{ $kandidat->kecamatan }}"
                                        data-kel="{{ $kandidat->kelurahan }}"
                                        data-tanggal="{{ \Carbon\Carbon::parse($kandidat->tanggal_daftar)->translatedFormat('d F Y') }}"
                                        data-cabang="{{ $kandidat->cabang->nama_cabang ?? '-' }}"
                                        data-verifikasi="{{ $kandidat->verifikasi }}"
                                        data-catatan="{{ $kandidat->catatan_admin ?? '-' }}"
                                        data-foto="{{ asset($kandidat->foto) }}"
                                        data-sertifikat_jft="{{ asset($kandidat->sertifikat_jft) }}"
                                        data-sertifikat_ssw="{{ asset($kandidat->sertifikat_ssw) }}"
                                        data-kk="{{ asset($kandidat->kk) }}" data-ktp="{{ asset($kandidat->ktp) }}"
                                        data-bukti="{{ asset($kandidat->bukti_pelunasan) }}"
                                        data-akte="{{ asset($kandidat->akte) }}"
                                        data-ijasah="{{ asset($kandidat->ijasah) }}">

                                </td>


                                <td>{{ $kandidat->nik }}</td>
                                <td>{{ $kandidat->nama }}</td>
                                <td>{{ $kandidat->email }}</td>
                                <td>{{ $kandidat->alamat }}</td>
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

                                            <!-- Export Data -->
                                            <li>
                                                <a href="{{ route('siswa.edit', $kandidat->id) }}" class="dropdown-item">
                                                    <i class="bi bi-file-earmark-excel me-1"></i> Export Data
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


    <!-- Modal Detail Kandidat -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailModalLabel"><i class="bi bi-person-circle me-2"></i>Detail Kandidat
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Foto & Status -->
                        <div class="col-md-4 text-center mb-3">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-3">
                                    <img src="" id="detailFoto" class="img-fluid rounded mb-3 border"
                                        style="max-height:250px;" alt="Foto Kandidat">
                                    <p class="mb-1"><strong>Cabang:</strong> <span id="detailCabang"></span></p>
                                    <p class="mb-1"><strong>Status Verifikasi:</strong> <span id="detailVerifikasi"
                                            class="badge fs-6"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Detail Data -->
                        <div class="col-md-8">
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body p-3">
                                    <h6 class="mb-3 text-primary"><i class="bi bi-info-circle me-1"></i>Informasi Kandidat
                                    </h6>
                                    <table class="table table-borderless table-sm mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="text-end" style="width:35%;">NIK</th>
                                                <td id="detailNIK"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Nama</th>
                                                <td id="detailNama"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Usia</th>
                                                <td id="detailUsia"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Agama</th>
                                                <td id="detailAgama"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Status</th>
                                                <td id="detailStatus"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Email</th>
                                                <td id="detailEmail"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">No WA</th>
                                                <td id="detailWA"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Jenis Kelamin</th>
                                                <td id="detailJK"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Tempat Lahir</th>
                                                <td id="detailTempatLahir"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Tanggal Lahir</th>
                                                <td id="detailTTL"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Alamat</th>
                                                <td id="detailAlamat"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Provinsi</th>
                                                <td id="detailProvinsi"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Kab/Kota</th>
                                                <td id="detailKab"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Kecamatan</th>
                                                <td id="detailKec"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Kelurahan</th>
                                                <td id="detailKel"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Catatan Admin</th>
                                                <td id="detailCatatan"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Dokumen -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-3">
                                    <h6 class="mb-3 text-primary"><i class="bi bi-file-earmark-text me-1"></i>Dokumen</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="#" target="_blank" id="linkSertifikatJFT"
                                            class="btn btn-outline-primary btn-sm">Sertifikat JFT</a>
                                        <a href="#" target="_blank" id="linkSertifikatSSW"
                                            class="btn btn-outline-primary btn-sm">Sertifikat SSW</a>
                                        <a href="#" target="_blank" id="linkKK"
                                            class="btn btn-outline-primary btn-sm">KK</a>
                                        <a href="#" target="_blank" id="linkKTP"
                                            class="btn btn-outline-primary btn-sm">KTP</a>
                                        <a href="#" target="_blank" id="linkBukti"
                                            class="btn btn-outline-primary btn-sm">Bukti Pelunasan</a>
                                        <a href="#" target="_blank" id="linkAkte"
                                            class="btn btn-outline-primary btn-sm">Akte</a>
                                        <a href="#" target="_blank" id="linkIjazah"
                                            class="btn btn-outline-primary btn-sm">Ijazah</a>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end col-md-8 -->
                    </div> <!-- end row -->
                </div> <!-- end modal-body -->
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
        document.addEventListener('DOMContentLoaded', function() {
            const detailModal = document.getElementById('detailModal');
            detailModal.addEventListener('show.bs.modal', function(event) {
                const img = event.relatedTarget;

                // Foto
                document.getElementById('detailFoto').src = img.getAttribute('data-foto');

                // Informasi dasar
                document.getElementById('detailNIK').textContent = img.getAttribute('data-nik');
                document.getElementById('detailNama').textContent = img.getAttribute('data-nama');
                document.getElementById('detailEmail').textContent = img.getAttribute('data-email');
                document.getElementById('detailWA').textContent = img.getAttribute('data-no_wa');
                document.getElementById('detailJK').textContent = img.getAttribute('data-jk');
                document.getElementById('detailAlamat').textContent = img.getAttribute('data-alamat');

                // Tambahan field migration
                document.getElementById('detailUsia').textContent = img.getAttribute('data-usia');
                document.getElementById('detailAgama').textContent = img.getAttribute('data-agama');
                document.getElementById('detailStatus').textContent = img.getAttribute('data-status');
                document.getElementById('detailTempat').textContent = img.getAttribute('data-tempat');
                document.getElementById('detailTTL').textContent = img.getAttribute('data-ttl');

                // Lokasi lengkap
                document.getElementById('detailProvinsi').textContent = img.getAttribute('data-provinsi');
                document.getElementById('detailKab').textContent = img.getAttribute('data-kab');
                document.getElementById('detailKec').textContent = img.getAttribute('data-kec');
                document.getElementById('detailKel').textContent = img.getAttribute('data-kel');

                // Tanggal daftar & cabang
                document.getElementById('detailTanggal').textContent = img.getAttribute('data-tanggal');
                document.getElementById('detailCabang').textContent = img.getAttribute('data-cabang');

                // Catatan admin
                document.getElementById('detailCatatan').textContent = img.getAttribute('data-catatan');

                // Status verifikasi styling
                const verifikasi = document.getElementById('detailVerifikasi');
                verifikasi.textContent = img.getAttribute('data-verifikasi');
                verifikasi.className = 'badge';
                switch (verifikasi.textContent) {
                    case 'menunggu':
                        verifikasi.classList.add('bg-warning', 'text-dark');
                        break;
                    case 'data belum lengkap':
                        verifikasi.classList.add('bg-info', 'text-dark');
                        break;
                    case 'diterima':
                        verifikasi.classList.add('bg-success');
                        break;
                    case 'ditolak':
                        verifikasi.classList.add('bg-danger');
                        break;
                }

                // Dokumen
                document.getElementById('linkKK').href = img.getAttribute('data-kk');
                document.getElementById('linkKTP').href = img.getAttribute('data-ktp');
                document.getElementById('linkBukti').href = img.getAttribute('data-bukti');
                document.getElementById('linkAkte').href = img.getAttribute('data-akte');
                document.getElementById('linkIjazah').href = img.getAttribute('data-ijasah');
                document.getElementById('linkJFT').href = img.getAttribute('data-sertifikat_jft');
                document.getElementById('linkSSW').href = img.getAttribute('data-sertifikat_ssw');
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


        // import rquesst
        $('#importForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('pendaftaran.import') }}",
                type: "POST",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,

                beforeSend: function() {
                    Swal.showLoading();
                },

                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },

                error: function(xhr) {
                    Swal.close();

                    let msg = 'Terjadi kesalahan saat mengimport data.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengimport!',
                        text: msg,
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

@endsection
