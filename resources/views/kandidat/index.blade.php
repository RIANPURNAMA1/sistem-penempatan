@if (in_array(auth()->user()->role, ['super admin']))

    <!-- Bootstrap 5 & DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <div class="py-4">

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif


        <div class="card   shadow shadow-md border-0 rounded-3">
            <div class="card-header d-flex justify-content-between align-items-center">
            </div>

            <div class="card-body table-responsive">
                <table id="tableKandidat" class="table align-middle ">
                    <thead class="text-dark fw-bold">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kandidat</th>
                            <th>Cabang</th>
                            <th>Status Kandidat</th>
                            <th>Status Interview</th>
                            <th>Penempatan</th>
                            <th>Tanggal Daftar</th>
                            <th>Jumlah Interview</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($kandidats as $index => $kandidat)
                            <tr>
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                <td>{{ $kandidat->pendaftaran->nama ?? '-' }}</td>
                                <td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge 
                                    {{ $kandidat->status_kandidat === 'Job Matching' ? 'bg-secondary text-white' : '' }}
                                    {{ $kandidat->status_kandidat === 'Pending' ? 'bg-info text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Interview' ? 'bg-warning text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Gagal Interview' ? 'bg-danger' : '' }}
                                    {{ $kandidat->status_kandidat === 'Jadwalkan Interview Ulang' ? 'bg-primary' : '' }}
                                    {{ $kandidat->status_kandidat === 'Lulus interview' ? 'bg-success' : '' }}
                                    {{ $kandidat->status_kandidat === 'Pemberkasan' ? 'bg-secondary text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Berangkat' ? 'bg-success' : '' }}
                                    {{ $kandidat->status_kandidat === 'Ditolak' ? 'bg-danger' : '' }}">
                                        {{ $kandidat->status_kandidat }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $kandidat->jumlah_interview > 0 ? 'bg-success' : 'bg-info text-dark' }}">
                                        {{ $kandidat->jumlah_interview > 0 ? 'SELESAI' : 'PENDING' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($kandidat->institusi)
                                        <span
                                            class="badge bg-primary">{{ $kandidat->institusi->nama_perusahaan ?? '-' }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">{{ $kandidat->created_at->format('d-m-Y H:i') }}</td>
                                <td class="text-center"><span
                                        class="badge bg-secondary">{{ $kandidat->jumlah_interview }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('kandidat.history', $kandidat->id) }}"
                                        class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        // Inisialisasi DataTables
        var table = $('#tableKandidat').DataTable({
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
    </script>

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



    <div class="">


        <!-- 🔍 Filter Section -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">

                    <!-- Filter Status Kandidat -->
                    <div class="col-12 col-md-4">
                        <label for="filterStatus" class="form-label fw-semibold">Filter Status Kandidat</label>
                        <select id="filterStatus" class="form-select">
                            <option value="">Semua Status</option>
                            @foreach (['Job Matching', 'Pending', 'Interview', 'Gagal Interview', 'Jadwalkan Interview Ulang', 'Lulus Interview', 'Pemberkasan', 'Berangkat', 'Diterima', 'Ditolak'] as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Filter -->
                    <div class="col-12 col-md-4 text-md-end d-flex align-items-end">
                        <button id="resetFilter" class="btn btn-outline-info w-100 w-md-auto">
                            <i class="bi bi-arrow-repeat"></i> Reset Filter
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped nowrap" id="" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. WA</th>
                            <th>Cabang</th>
                            <th>Status Kandidat</th>
                            <th>Penempatan</th>
                            <th>Jumlah Interview</th>
                            <th>Status Interview</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kandidatsFiltered as $kandidat)
                            @php
                                // Normalisasi WA
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

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kandidat->pendaftaran->nama ?? '-' }}</td>

                                <!-- EMAIL Dengan Icon -->
                                <td>
                                    @if ($kandidat->pendaftaran->email)
                                        <a href="mailto:{{ $kandidat->pendaftaran->email }}"
                                            class="btn btn-sm btn-primary rounded-circle">
                                            <i class="bi bi-envelope-fill"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <!-- WhatsApp -->
                                <td>
                                    @if ($waNumber)
                                        <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                                            class="btn btn-sm btn-success rounded-circle">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $kandidat->cabang->nama_cabang ?? '-' }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge 
                                    {{ $kandidat->status_kandidat === 'Job Matching' ? 'bg-secondary text-white' : '' }}
                                    {{ $kandidat->status_kandidat === 'Pending' ? 'bg-info text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Interview' ? 'bg-warning text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Gagal Interview' ? 'bg-danger' : '' }}
                                    {{ $kandidat->status_kandidat === 'Jadwalkan Interview Ulang' ? 'bg-primary' : '' }}
                                    {{ $kandidat->status_kandidat === 'Lulus interview' ? 'bg-success' : '' }}
                                    {{ $kandidat->status_kandidat === 'Pemberkasan' ? 'bg-secondary text-dark' : '' }}
                                    {{ $kandidat->status_kandidat === 'Berangkat' ? 'bg-success' : '' }}
                                    {{ $kandidat->status_kandidat === 'Ditolak' ? 'bg-danger' : '' }}">
                                        {{ $kandidat->status_kandidat }}
                                    </span>
                                </td>
                                <td>{{ $kandidat->institusi->nama_perusahaan ?? '-' }}</td>

                                <td class="text-center">{{ $jumlahInterview }}</td>

                                <!-- Badge Status Interview -->
                                <td class="text-center">
                                    <span
                                        class="badge {{ $jumlahInterview > 0 ? 'bg-success' : 'bg-info text-dark' }}">
                                        {{ $jumlahInterview > 0 ? 'SELESAI' : 'PENDING' }}
                                    </span>
                                </td>

                                <td>{{ $kandidat->created_at->format('Y-m-d') }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admins.dashboard.kandidat.show', $kandidat->id) }}"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('kandidat.history', $kandidat->id) }}"
                                        class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>




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
        // Inisialisasi DataTables
        var table = $('#cabang').DataTable({
            responsive: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            language: {
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });
        document.addEventListener("DOMContentLoaded", function() {

            const filterStatus = document.getElementById("filterStatus");
            const resetBtn = document.getElementById("resetFilter");
            const table = document.getElementById("cabang");
            const rows = table.getElementsByTagName("tr");

            // === FILTER STATUS ===
            filterStatus.addEventListener("change", function() {
                const selected = this.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) {
                    const statusCell = rows[i].children[5]; // kolom Status Kandidat
                    if (!statusCell) continue;

                    const statusText = statusCell.textContent.toLowerCase();

                    if (selected === "" || statusText.includes(selected)) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            });

            // === RESET FILTER ===
            if (resetBtn) {
                resetBtn.addEventListener("click", function() {
                    filterStatus.value = "";
                    for (let i = 1; i < rows.length; i++) {
                        rows[i].style.display = "";
                    }
                });
            }
        });
    </script>

@endif
