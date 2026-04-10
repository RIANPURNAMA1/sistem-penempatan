@extends('layouts.app')

@section('title', 'Daftar Kandidat')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body,
        .table,
        .form-label,
        .form-select,
        .btn,
        div,
        span,
        th,
        td {
            font-family: 'Inter', sans-serif !important;
            font-size: 13px !important;
        }

        .table th,
        .table td {
            padding: 10px 12px;
        }

        .table .badge {
            font-size: 11px;
        }

        .table .btn {
            padding: 4px 8px;
            font-size: 12px;
        }

        .form-select,
        .btn {
            font-size: 13px;
        }

        .dataTables_length select,
        .dataTables_filter input {
            font-size: 13px;
        }

        .dataTables_info,
        .dataTables_paginate {
            font-size: 13px;
        }

        #tablependaftar {
            font-size: 12px;
        }
    </style>

    <div class="py-3">
        <!-- Breadcrumb -->
        <nav class="mb-4">
            <ol class="flex items-center text-sm text-gray-500">
                <li><a href="#" class="hover:text-blue-600"><i class="bi bi-house-door"></i></a></li>
                <li class="mx-2"><i class="bi bi-chevron-right text-gray-400"></i></li>
                <li class="text-gray-700 font-medium">Daftar Kandidat</li>
            </ol>
        </nav>

        <!-- Filter Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
            <div class="p-4 border-b border-gray-100">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h5 class="font-semibold text-gray-800"><i class="bi bi-funnel me-2"></i>Filter Data</h5>
                    <div class="flex flex-wrap gap-2">
                        <form id="importForm" enctype="multipart/form-data" class="flex items-center gap-2">
                            @csrf
                            <input type="file" name="file" id="fileInput" accept=".xlsx,.xls" required class="hidden">
                            <label for="fileInput"
                                class="flex items-center gap-2 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg cursor-pointer transition text-sm">
                                <i class="bi bi-cloud-upload"></i>
                                <span id="fileText">Pilih File</span>
                            </label>
                            <button type="submit"
                                class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition text-sm">
                                <i class="bi bi-upload me-1"></i>Import
                            </button>
                        </form>
                        <a href="/pendaftaran/export/exels"
                            class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition text-sm">
                            <i class="bi bi-file-earmark-spreadsheet me-1"></i>Export
                        </a>
                        <a href="/pendaftaran/export/pdf" target="_blank"
                            class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition text-sm">
                            <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <form id="filterForm">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Cabang</label>
                            <select name="cabang_id" id="filterCabang"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                                <option value="">Semua Cabang</option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('cabang_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_cabang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status JFT</label>
                            <select name="status_jft" id="filterJft"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                                <option value="">Semua</option>
                                <option value="sudah ujian jft"
                                    {{ request('status_jft') == 'sudah ujian jft' ? 'selected' : '' }}>Sudah Ujian JFT
                                </option>
                                <option value="belum ujian jft"
                                    {{ request('status_jft') == 'belum ujian jft' ? 'selected' : '' }}>Belum Ujian JFT
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Status SSW</label>
                            <select name="status_ssw" id="filterSsw"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                                <option value="">Semua</option>
                                <option value="sudah ujian ssw"
                                    {{ request('status_ssw') == 'sudah ujian ssw' ? 'selected' : '' }}>Sudah Ujian SSW
                                </option>
                                <option value="belum ujian ssw"
                                    {{ request('status_ssw') == 'belum ujian ssw' ? 'selected' : '' }}>Belum Ujian SSW
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
    <div class="overflow-x-auto">
        <table id="tablependaftar" class="w-full text-left text-sm">
            <thead class="bg-base-200 text-base-content border-b border-base-content/10">

                {{-- Baris 1: Grouping Header --}}
                <tr class="text-center uppercase text-[10px] tracking-wider font-bold text-gray-500">
                    <th colspan="2" class="bg-base-300/50 border-r border-base-content/10">Sistem</th>
                    <th colspan="7" class="bg-blue-50 border-r border-blue-100 text-blue-700">Biodata Pribadi</th>
                    <th colspan="4" class="bg-green-50 border-r border-green-100 text-green-700">Kualifikasi (JFT/SSW)</th>
                    <th colspan="2" class="bg-purple-50 border-r border-purple-100 text-purple-700">Kontak & Cabang</th>
                    <th colspan="4" class="bg-amber-50 text-amber-700">Administrasi & Status</th>
                    <th class="bg-base-300"></th>
                </tr>

                {{-- Baris 2: Detail Header --}}
                <tr class="text-center whitespace-nowrap">
                    {{-- Sistem --}}
                    <th class="px-3 py-3 border-r border-base-content/5">No</th>
                    <th class="px-3 py-3 border-r border-base-content/10">Foto</th>

                    {{-- Biodata Pribadi (7 kolom) --}}
                    <th class="px-3 py-3 bg-blue-50/50">NIK</th>
                    <th class="px-3 py-3 bg-blue-50/50 text-left">Nama</th>
                    <th class="px-3 py-3 bg-blue-50/50">Email</th>
                    <th class="px-3 py-3 bg-blue-50/50">Alamat</th>
                    <th class="px-3 py-3 bg-blue-50/50">Tgl Lahir</th>
                    <th class="px-3 py-3 bg-blue-50/50">JK</th>
                    <th class="px-3 py-3 bg-blue-50/50 border-r border-blue-100">Pendidikan</th>

                    {{-- Kualifikasi (4 kolom) --}}
                    <th class="px-3 py-3 bg-green-50/50">JFT</th>
                    <th class="px-3 py-3 bg-green-50/50">SSW</th>
                    <th class="px-3 py-3 bg-green-50/50">Bidang SSW</th>
                    <th class="px-3 py-3 bg-green-50/50 border-r border-green-100">Nilai</th>

                    {{-- Kontak & Cabang (2 kolom) --}}
                    <th class="px-3 py-3 bg-purple-50/50">No WA</th>
                    <th class="px-3 py-3 bg-purple-50/50 border-r border-purple-100">Cabang</th>

                    {{-- Administrasi & Status (4 kolom) --}}
                    <th class="px-3 py-3 bg-amber-50/50">Dok</th>
                    <th class="px-3 py-3 bg-amber-50/50">Tgl Daftar</th>
                    <th class="px-3 py-3 bg-amber-50/50">Status</th>
                    <th class="px-3 py-3 bg-amber-50/50 border-r border-amber-100">Catatan</th>

                    <th class="px-4 py-3 sticky right-0 bg-base-200 shadow-l">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach ($kandidats as $index => $kandidat)
                    <tr class="hover:bg-gray-50 transition" data-cabang="{{ $kandidat->cabang_id }}">

                        {{-- Sistem --}}
                        <td class="px-3 py-3 text-gray-500 text-center">{{ $index + 1 }}</td>
                        <td class="px-3 py-3">
                            <a href="/pendaftaran/{{ $kandidat->id }}/pendaftar">
                                <img src="{{ $kandidat->foto && file_exists(public_path($kandidat->foto)) ? asset($kandidat->foto) : asset('images/default-user.png') }}"
                                    class="w-10 h-10 rounded-md object-cover border border-gray-200">
                            </a>
                        </td>

                        {{-- Biodata Pribadi --}}
                        <td class="px-3 py-3 text-gray-600">{{ $kandidat->nik ?? '-' }}</td>
                        <td class="px-3 py-3 font-medium text-gray-800">{{ ucwords(strtolower($kandidat->nama)) }}</td>
                        <td class="px-3 py-3 text-gray-600">{{ $kandidat->email ?? '-' }}</td>
                        <td class="px-3 py-3 text-gray-600 max-w-[150px] truncate">{{ $kandidat->alamat ?? '-' }}</td>
                        <td class="px-3 py-3 text-gray-600">
                            {{ $kandidat->tempat_tanggal_lahir ? \Carbon\Carbon::parse($kandidat->tempat_tanggal_lahir)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-3 text-gray-600 text-center">
                            @if ($kandidat->jenis_kelamin === 'Laki-laki' || $kandidat->jenis_kelamin === 'L')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">L</span>
                            @elseif ($kandidat->jenis_kelamin === 'Perempuan' || $kandidat->jenis_kelamin === 'P')
                                <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-medium">P</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-gray-600 text-center">
                            {{ $kandidat->pendidikan_terakhir ?? '-' }}
                        </td>

                        {{-- Kualifikasi --}}
                        <td class="px-3 py-3 text-center">
                            @if ($kandidat->status_jft === 'sudah ujian jft')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Sudah</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Belum</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-center">
                            @if ($kandidat->status_ssw === 'sudah ujian ssw')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Sudah</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Belum</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-gray-600 text-xs">
                            {{ $kandidat->bidang_ssws && $kandidat->bidang_ssws->count() > 0 ? $kandidat->bidang_ssws->pluck('nama_bidang')->join(', ') : '-' }}
                        </td>
                        <td class="px-3 py-3 text-gray-600 text-center text-xs">
                            {{ $kandidat->nilai_ssw ?? '-' }}
                        </td>

                        {{-- Kontak & Cabang --}}
                        <td class="px-3 py-3 text-gray-600">{{ $kandidat->no_wa ?? '-' }}</td>
                        <td class="px-3 py-3 text-gray-600">{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>

                        {{-- Administrasi --}}
                        <td class="px-3 py-3 text-center">
                            <div class="flex justify-center gap-1">
                                <a href="{{ asset($kandidat->kk) }}" target="_blank"
                                    class="p-1.5 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition" title="KK">
                                    <i class="bi bi-file-earmark-text"></i>
                                </a>
                                <a href="{{ asset($kandidat->ktp) }}" target="_blank"
                                    class="p-1.5 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition" title="KTP">
                                    <i class="bi bi-person-badge"></i>
                                </a>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-gray-500 text-center">{{ $kandidat->created_at->format('d/m/Y') }}</td>
                        <td class="px-3 py-3 text-center">
                            @if ($kandidat->verifikasi == 'menunggu')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Menunggu</span>
                            @elseif ($kandidat->verifikasi == 'data belum lengkap')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Belum Lengkap</span>
                            @elseif ($kandidat->verifikasi == 'diterima')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Diterima</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Ditolak</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 text-gray-500 text-xs max-w-[120px] truncate">
                            {{ $kandidat->catatan_admin ?? '-' }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-3 py-3 text-center sticky right-0 bg-white border-l border-gray-100">
                            <div class="inline-flex items-center gap-1 justify-center">
                                <button onclick="openVerifikasiModal('{{ $kandidat->id }}', '{{ $kandidat->nama }}', '{{ $kandidat->verifikasi }}', '{{ $kandidat->catatan_admin ?? '' }}')"
                                    class="p-2 bg-blue-100 text-blue-600 hover:bg-blue-200 rounded-lg transition" title="Verifikasi">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                <a href="{{ route('pendaftaran.edit.full', $kandidat->id) }}"
                                    class="p-2 bg-amber-100 text-amber-600 hover:bg-amber-200 rounded-lg transition" title="Edit Data">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @php $nomor_wa_bersih = preg_replace('/^0/', '62', $kandidat->no_wa ?? ''); @endphp
                                <a href="https://wa.me/{{ $nomor_wa_bersih }}" target="_blank"
                                    class="p-2 bg-green-100 text-green-600 hover:bg-green-200 rounded-lg transition" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <button class="p-2 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition delete-btn"
                                    data-id="{{ $kandidat->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Filter
        const cabang = document.getElementById('filterCabang');
        const jft = document.getElementById('filterJft');
        const ssw = document.getElementById('filterSsw');

        function applyFilter() {
            const params = new URLSearchParams();
            if (cabang.value) params.append('cabang_id', cabang.value);
            if (jft.value) params.append('status_jft', jft.value);
            if (ssw.value) params.append('status_ssw', ssw.value);
            window.location.href = `?${params.toString()}`;
        }

        cabang.addEventListener('change', applyFilter);
        jft.addEventListener('change', applyFilter);
        ssw.addEventListener('change', applyFilter);

        // Client-side filter
        const filterCabang = document.getElementById("filterCabang");
        const rows = document.querySelectorAll("#tablependaftar tbody tr");
        filterCabang.addEventListener("change", function() {
            const selectedCabang = this.value;
            rows.forEach(row => {
                const rowCabang = row.getAttribute("data-cabang");
                if (selectedCabang === "" || selectedCabang === rowCabang) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // DataTables
        var table = $('#tablependaftar').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "‹",
                    next: "›"
                }
            }
        });

        // Delete
        $(document).on('click', '.delete-btn', function() {
            let btn = $(this);
            let id = btn.data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan terhapus permanen!",
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
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message || 'Data berhasil dihapus',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            table.row(btn.closest('tr')).remove().draw();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan'
                            });
                        }
                    });
                }
            });
        });

        // Import
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
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(response) {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message ?? 'Data berhasil diimport',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => window.location.reload(), 2000);
                },
                error: function(xhr) {
                    Swal.close();
                    let msg = 'Terjadi kesalahan saat mengimport data.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        msg = "<b>Format Excel salah:</b><br>";
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            msg += `- ${value}<br>`;
                        });
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        html: msg
                    });
                }
            });
        });
    </script>

    <!-- Modal Verifikasi -->
    <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-b border-gray-100">
                    <h5 class="modal-title font-semibold text-gray-800">Verifikasi Kandidat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
<form id="verifikasiForm">
                @csrf
                <input type="hidden" name="id" id="verifikasiId">
                <div class="modal-body">
                        <p class="mb-3 text-gray-600">Kandidat: <span id="kandidatNama" class="font-semibold text-gray-900"></span></p>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
                            <select name="verifikasi" id="verifikasiStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none">
                                <option value="menunggu">Menunggu</option>
                                <option value="data belum lengkap">Data Belum Lengkap</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Admin</label>
                            <textarea name="catatan_admin" id="catatanAdmin" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-400 focus:border-gray-400 outline-none"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnSubmit" class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openVerifikasiModal(id, nama, verifikasi, catatan) {
            document.getElementById('verifikasiId').value = id;
            document.getElementById('kandidatNama').textContent = nama;
            document.getElementById('verifikasiStatus').value = verifikasi;
            document.getElementById('catatanAdmin').value = catatan || '';
            var modal = new bootstrap.Modal(document.getElementById('verifikasiModal'));
            modal.show();
        }

        document.getElementById('verifikasiForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('btnSubmit');
        var id = document.getElementById('verifikasiId').value;
        var verifikasi = document.getElementById('verifikasiStatus').value;
        var catatan = document.getElementById('catatanAdmin').value;
        
        btn.disabled = true;
        btn.innerHTML = '<span class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span> Memproses...';
        
        $.ajax({
            url: "{{ url('/siswa') }}/" + id,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                verifikasi: verifikasi,
                catatan_admin: catatan
            },
            success: function(data) {
                $('#verifikasiModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message || 'Verifikasi berhasil diperbarui',
                    confirmButtonColor: '#198754'
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan',
                    confirmButtonColor: '#dc3545'
                });
            },
            complete: function() {
                btn.disabled = false;
                btn.innerHTML = 'Simpan Perubahan';
            }
        });
    });
    </script>
@endsection
