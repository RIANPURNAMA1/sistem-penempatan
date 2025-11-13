    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Daftar Siswa yang Login</h4>
                            <i class="bi bi-person-check-fill fs-4 text-primary"></i>
                        </div>
                        <div class="card-content pb-4">
                            @php
                                $siswa_login = [
                                    [
                                        'nama' => 'Rian Purnama',
                                        'email' => 'rianpurnama@example.com',
                                        'cabang' => 'Cabang Bandung',
                                        'foto' => 'https://randomuser.me/api/portraits/men/32.jpg',
                                        'waktu_login' => '5 menit yang lalu',
                                    ],
                                    [
                                        'nama' => 'Siti Rahmawati',
                                        'email' => 'siti.rahma@example.com',
                                        'cabang' => 'Cabang Cirebon',
                                        'foto' => 'https://randomuser.me/api/portraits/women/45.jpg',
                                        'waktu_login' => '10 menit yang lalu',
                                    ],
                                    [
                                        'nama' => 'Budi Santoso',
                                        'email' => 'budi.santoso@example.com',
                                        'cabang' => 'Cabang Jakarta',
                                        'foto' => 'https://randomuser.me/api/portraits/men/52.jpg',
                                        'waktu_login' => '15 menit yang lalu',
                                    ],
                                    [
                                        'nama' => 'Dewi Lestari',
                                        'email' => 'dewi.lestari@example.com',
                                        'cabang' => 'Cabang Bogor',
                                        'foto' => 'https://randomuser.me/api/portraits/women/33.jpg',
                                        'waktu_login' => '20 menit yang lalu',
                                    ],
                                ];
                            @endphp

                            {{-- Loop daftar siswa yang login --}}
                            @foreach ($siswa_login as $siswa)
                                <div class="recent-message d-flex align-items-center px-4 py-3 border-bottom">
                                    <div class="avatar avatar-lg">
                                        <img src="{{ $siswa['foto'] }}" alt="Foto {{ $siswa['nama'] }}"
                                            class="rounded-circle shadow-sm">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1 text-muted font-semibold">{{ $siswa['nama'] }}</h5>
                                        <h6 class="text-muted mb-0 small">
                                            <i class="bi bi-envelope me-1"></i>{{ $siswa['email'] }}
                                        </h6>
                                        <span class="badge bg-primary mt-1">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $siswa['cabang'] }}
                                        </span>
                                        <div class="text-muted small mt-1">
                                            <i class="bi bi-clock me-1"></i>{{ $siswa['waktu_login'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Tombol Lihat Semua --}}
                            <div class="px-4">
                                <button class="btn btn-block btn-outline-primary font-bold mt-3 w-100">
                                    <i class="bi bi-list-ul me-2"></i> Lihat Semua Siswa Login
                                </button>
                            </div>
                        </div>
                    </div>