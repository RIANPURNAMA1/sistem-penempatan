@if (in_array(auth()->user()->role, ['super-admin']))
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, .table, .form-label, .form-select, .btn, div, span, th, td {
        font-family: 'Inter', sans-serif !important;
        font-size: 12px !important;
    }
    .table th, .table td { padding: 8px 10px; }
    .table .badge { font-size: 10px; }
    .table .btn { padding: 3px 6px; font-size: 11px; }
    .form-select, .btn { font-size: 12px; }
    .dataTables_length select, .dataTables_filter input { font-size: 11px; }
    .dataTables_info, .dataTables_paginate { font-size: 11px; }
    #tableKandidat { font-size: 11px; }
</style>

<div class="py-3">
    @if (session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Sukses', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });</script>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
        <div class="overflow-x-auto">
            <table id="tableKandidat" class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-center">No</th>
                        <th class="px-3 py-3 font-semibold">Foto</th>
                        <th class="px-3 py-3 font-semibold">Nama Kandidat</th>
                        <th class="px-3 py-3 font-semibold">Cabang</th>
                        <th class="px-3 py-3 font-semibold text-center">Status</th>
                        <th class="px-3 py-3 font-semibold text-center">Interview</th>
                        <th class="px-3 py-3 font-semibold text-center">Perusahaan</th>
                        <th class="px-3 py-3 font-semibold text-center">Nama Perusahaan</th>
                        <th class="px-3 py-3 font-semibold text-center">Tgl Daftar</th>
                        <th class="px-3 py-3 font-semibold text-center">Jml</th>
                        <th class="px-3 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($kandidats as $index => $kandidat)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-3 py-3">
                                <img src="{{ asset($kandidat->pendaftaran->foto) }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            </td>
                            <td class="px-3 py-3 font-medium text-gray-800">{{ $kandidat->pendaftaran->nama ?? '-' }}</td>
                            <td class="px-3 py-3 text-gray-600">{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">
                                @php
                                    $statusClass = match($kandidat->status_kandidat) {
                                        'Job Matching', 'lamar ke perusahaan' => 'bg-gray-100 text-gray-700',
                                        'Pending' => 'bg-blue-100 text-blue-700',
                                        'Interview' => 'bg-yellow-100 text-yellow-700',
                                        'Gagal Interview' => 'bg-red-100 text-red-700',
                                        'Jadwalkan Interview Ulang' => 'bg-indigo-100 text-indigo-700',
                                        'Lulus interview' => 'bg-green-100 text-green-700',
                                        'Pemberkasan' => 'bg-gray-200 text-gray-700',
                                        'Berangkat' => 'bg-green-500 text-white',
                                        'Ditolak' => 'bg-red-500 text-white',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusClass }}">{{ $kandidat->status_kandidat }}</span>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $kandidat->jumlah_interview > 0 ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $kandidat->jumlah_interview > 0 ? 'SELESAI' : 'PENDING' }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-center">
                                @if ($kandidat->institusi)
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs">{{ $kandidat->institusi->perusahaan_penempatan ?? '-' }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-3 py-3 text-center text-gray-600">{{ $kandidat->nama_perusahaan ?? '-' }}</td>
                            <td class="px-3 py-3 text-center text-gray-500">{{ $kandidat->created_at->format('d/m/Y') }}</td>
                            <td class="px-3 py-3 text-center"><span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $kandidat->jumlah_interview }}</span></td>
                            <td class="px-3 py-3 text-center">
                                <div class="inline-flex items-center gap-1">
                                    {{-- <button onclick="openVerifikasiModal({{ $kandidat->pendaftaran->id }}, '{{ $kandidat->pendaftaran->nama ?? '' }}', '{{ $kandidat->pendaftaran->verifikasi ?? 'menunggu' }}', '{{ $kandidat->pendaftaran->catatan_admin ?? '' }}')" class="p-1.5 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition" title="Verifikasi">
                                        <i class="bi bi-check-circle"></i>
                                    </button> --}}
                                    <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}" class="p-1.5 bg-cyan-100 text-cyan-600 rounded hover:bg-cyan-200 transition" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('kandidat.history', $kandidat->id) }}" class="p-1.5 bg-amber-100 text-amber-600 rounded hover:bg-amber-200 transition" title="Riwayat">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
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
    var table = $('#tableKandidat').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data ditemukan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "‹", next: "›" }
        }
    });

    function openVerifikasiModal(id, nama, verifikasi, catatan) {
        document.getElementById('verifikasiId').value = id;
        document.getElementById('kandidatNama').textContent = nama;
        document.getElementById('verifikasiStatus').value = verifikasi;
        document.getElementById('catatanAdmin').value = catatan;
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

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold">Verifikasi Kandidat</h5>
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
@endif


@if (in_array(auth()->user()->role, [
        'Cabang Cianjur Selatan Mendunia',
        'Cabang Cianjur Pamoyanan Mendunia',
        'Cabang Batam Mendunia',
        'Cabang Banyuwangi Mendunia',
        'Cabang Kendal Mendunia',
        'Cabang Pati Mendunia',
        'Cabang Tulung Agung Mendunia',
        'Cabang Bangkalan Mendunia',
        'Cabang Bojonegoro Mendunia',
        'Cabang Jember Mendunia',
        'Cabang Wonosobo Mendunia',
        'Cabang Eshan Mendunia',
    ]))

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, .table, .form-label, .form-select, .btn, div, span, th, td {
        font-family: 'Inter', sans-serif !important;
        font-size: 12px !important;
    }
    .table th, .table td { padding: 8px 10px; }
    .table .badge { font-size: 10px; }
    .table .btn { padding: 3px 6px; font-size: 11px; }
    .form-select, .btn { font-size: 12px; }
    .dataTables_length select, .dataTables_filter input { font-size: 11px; }
    .dataTables_info, .dataTables_paginate { font-size: 11px; }
    #cabang { font-size: 11px; }
</style>

<div class="py-3">
    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Filter Status</label>
                    <select id="filterStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm">
                        <option value="">Semua Status</option>
                        @foreach (['Job Matching', 'Pending', 'Interview', 'Gagal Interview', 'Jadwalkan Interview Ulang', 'Lulus Interview', 'Pemberkasan', 'Berangkat', 'Diterima', 'Ditolak'] as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button id="resetFilter" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-3">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="cabang">
                <thead class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-3 font-semibold text-center">No</th>
                        <th class="px-3 py-3 font-semibold">Nama</th>
                        <th class="px-3 py-3 font-semibold text-center">Email</th>
                        <th class="px-3 py-3 font-semibold text-center">WA</th>
                        <th class="px-3 py-3 font-semibold">Cabang</th>
                        <th class="px-3 py-3 font-semibold text-center">Status</th>
                        <th class="px-3 py-3 font-semibold">Perusahaan</th>
                        <th class="px-3 py-3 font-semibold text-center">Nama Perusahaan</th>
                        <th class="px-3 py-3 font-semibold text-center">Jml</th>
                        <th class="px-3 py-3 font-semibold text-center">Interview</th>
                        <th class="px-3 py-3 font-semibold text-center">Tgl Daftar</th>
                        <th class="px-3 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($kandidatsFiltered as $kandidat)
                        @php
                            $waRaw = $kandidat->pendaftaran->no_wa ?? null;
                            $waNumber = null;
                            if ($waRaw) {
                                $waNumber = preg_replace('/[^0-9]/', '', $waRaw);
                                if (substr($waNumber, 0, 1) === '0') {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                            }
                            $jumlahInterview = $kandidat->jumlah_interview ?? 0;
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3 text-center text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-3 py-3 font-medium text-gray-800">{{ $kandidat->pendaftaran->nama ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">
                                @if ($kandidat->pendaftaran->email)
                                    <a href="mailto:{{ $kandidat->pendaftaran->email }}" class="p-1.5 bg-blue-100 text-blue-600 rounded hover:bg-blue-200 transition">
                                        <i class="bi bi-envelope-fill"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-3 py-3 text-center">
                                @if ($waNumber)
                                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="p-1.5 bg-green-100 text-green-600 rounded hover:bg-green-200 transition">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-3 py-3 text-gray-600">{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>
                            <td class="px-3 py-3 text-center">
                                @php
                                    $statusClass = match($kandidat->status_kandidat) {
                                        'Job Matching' => 'bg-gray-100 text-gray-700',
                                        'Pending' => 'bg-blue-100 text-blue-700',
                                        'Interview' => 'bg-yellow-100 text-yellow-700',
                                        'Gagal Interview' => 'bg-red-100 text-red-700',
                                        'Jadwalkan Interview Ulang' => 'bg-indigo-100 text-indigo-700',
                                        'Lulus interview' => 'bg-green-100 text-green-700',
                                        'Pemberkasan' => 'bg-gray-200 text-gray-700',
                                        'Berangkat' => 'bg-green-500 text-white',
                                        'Ditolak' => 'bg-red-500 text-white',
                                        default => 'bg-gray-100 text-gray-700'
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusClass }}">{{ $kandidat->status_kandidat }}</span>
                            </td>
                            <td class="px-3 py-3 text-gray-600">{{ $kandidat->institusi->perusahaan_penempatan ?? '-' }}</td>
                            <td class="px-3 py-3 text-center text-gray-600">{{ $kandidat->nama_perusahaan ?? '-' }}</td>
                            <td class="px-3 py-3 text-center"><span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $jumlahInterview }}</span></td>
                            <td class="px-3 py-3 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $jumlahInterview > 0 ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $jumlahInterview > 0 ? 'SELESAI' : 'PENDING' }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-center text-gray-500">{{ $kandidat->created_at->format('Y-m-d') }}</td>
                            <td class="px-3 py-3 text-center">
                                <div class="inline-flex items-center gap-1">
                                    <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}" class="p-1.5 bg-cyan-100 text-cyan-600 rounded hover:bg-cyan-200 transition" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('kandidat.history', $kandidat->id) }}" class="p-1.5 bg-amber-100 text-amber-600 rounded hover:bg-amber-200 transition" title="Riwayat">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
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
    var table = $('#cabang').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            zeroRecords: "Tidak ada data ditemukan",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: { previous: "‹", next: "›" }
        }
    });

    document.getElementById("filterStatus").addEventListener("change", function() {
        var selected = this.value.toLowerCase();
        var rows = document.getElementById("cabang").getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) {
            var statusCell = rows[i].children[5];
            if (!statusCell) continue;
            var statusText = statusCell.textContent.toLowerCase();
            rows[i].style.display = (selected === "" || statusText.includes(selected)) ? "" : "none";
        }
    });

    document.getElementById("resetFilter").addEventListener("click", function() {
        document.getElementById("filterStatus").value = "";
        var rows = document.getElementById("cabang").getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) {
            rows[i].style.display = "";
        }
    });
</script>
@endif
