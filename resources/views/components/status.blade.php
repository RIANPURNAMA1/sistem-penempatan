<div class="row mt-4">
                        @php
                            $status_penempatan = [
                                'INTERVIEW' => 15,
                                'SUDAH_BERANGKAT' => 20,
                                'VERIFIKASI_DATA' => 10,
                                'PENDING' => 8,
                                'MENUNGGU_JOB_MATCHING' => 12,
                                'SELESAI' => 18,
                                'DITOLAK' => 5,
                            ];

                            $status_icon = [
                                'INTERVIEW' => 'bi bi-chat-dots',
                                'SUDAH_BERANGKAT' => 'bi bi-airplane-engines',
                                'VERIFIKASI_DATA' => 'bi bi-file-earmark-check',
                                'PENDING' => 'bi bi-hourglass-split',
                                'MENUNGGU_JOB_MATCHING' => 'bi bi-people',
                                'SELESAI' => 'bi bi-check-circle',
                                'DITOLAK' => 'bi bi-x-circle',
                            ];

                            $status_gradient = [
                                'INTERVIEW' => 'background: linear-gradient(135deg, #17a2b8, #007bff); color: white;',
                                'SUDAH_BERANGKAT' =>
                                    'background: linear-gradient(135deg, #28a745, #20c997); color: white;',
                                'VERIFIKASI_DATA' =>
                                    'background: linear-gradient(135deg, #007bff, #6610f2); color: white;',
                                'PENDING' => 'background: linear-gradient(135deg, #ffc107, #ffcd39); color: #212529;',
                                'MENUNGGU_JOB_MATCHING' =>
                                    'background: linear-gradient(135deg, #6c757d, #adb5bd); color: white;',
                                'SELESAI' => 'background: linear-gradient(135deg, #00c851, #007e33); color: white;',
                                'DITOLAK' => 'background: linear-gradient(135deg, #dc3545, #ff6b6b); color: white;',
                            ];
                        @endphp

                        @foreach ($status_penempatan as $status => $jumlah)
                            <div class="col-6 col-lg-3 col-md-6 mb-3">
                                <div class="card shadow-sm border-0 hover-card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 text-center">
                                                <div class="stats-icon rounded-3 d-flex justify-content-center align-items-center mb-2"
                                                    style="{{ $status_gradient[$status] }} width:50px; height:50px;">
                                                    <i class="{{ $status_icon[$status] }} fs-3"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 text-center">
                                                <h6 class="text-muted font-semibold mb-1"
                                                    style="text-transform: capitalize;">
                                                    {{ str_replace('_', ' ', strtolower($status)) }}</h6>
                                                <h6 class="fw-bold mb-0 fs-5">{{ $jumlah }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>