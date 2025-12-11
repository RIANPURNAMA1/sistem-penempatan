{{-- 
    Simpan file ini di: resources/views/wablas/test.blade.php
    
    Pastikan folder 'wablas' sudah dibuat di dalam resources/views/
    Jika belum ada, buat dulu folder tersebut.
--}}

@extends('layouts.app')

@section('content')
<div class=" mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <!-- Header -->
            <div class="alert alert-warning mb-4">
                <h5 class="alert-heading">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Halaman Testing - Jangan Diakses di Production!
                </h5>
                <p class="mb-0">Halaman ini hanya untuk testing koneksi API Wablas. Pastikan untuk menghapus atau membatasi akses halaman ini di production.</p>
            </div>

            <!-- Card Test Koneksi -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="bi bi-whatsapp me-2"></i> Test Koneksi Wablas API
                </div>
                <div class="card-body">
                    
                    <!-- Info Device -->
                    <div class="alert alert-info mb-3">
                        <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-2"></i>Konfigurasi Saat Ini:</h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td width="150">Domain:</td>
                                <td><strong>{{ config('services.wablas.domain') ?? 'Belum diset' }}</strong></td>
                            </tr>
                            <tr>
                                <td>Token:</td>
                                <td>
                                    @if(config('services.wablas.token'))
                                        <span class="badge bg-success">✓ Tersedia</span>
                                        <small class="text-muted">({{ substr(config('services.wablas.token'), 0, 10) }}...)</small>
                                    @else
                                        <span class="badge bg-danger">✗ Belum diset</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Secret Key:</td>
                                <td>
                                    @if(config('services.wablas.secret_key'))
                                        <span class="badge bg-success">✓ Tersedia</span>
                                    @else
                                        <span class="badge bg-warning">Opsional (tidak wajib)</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Form Test Device Info -->
                    <form id="testDeviceForm">
                        <h6 class="fw-bold mb-3">
                            <span class="badge bg-primary me-2">1</span>
                            Test Device Info (Cek Status Device)
                        </h6>
                        <p class="text-muted small">Mengecek apakah device Wablas Anda terhubung dan mendapatkan info quota, expired date, dll.</p>
                        <button type="submit" class="btn btn-primary w-100 mb-4">
                            <i class="bi bi-info-circle me-2"></i> Cek Info Device
                        </button>
                    </form>

                    <hr class="my-4">

                    <!-- Form Test Send Message -->
                    <form id="testMessageForm">
                        <h6 class="fw-bold mb-3">
                            <span class="badge bg-success me-2">2</span>
                            Test Kirim Pesan WhatsApp
                        </h6>
                        <p class="text-muted small">Kirim pesan test ke nomor WhatsApp untuk memastikan API berfungsi dengan baik.</p>
                        
                        <div class="mb-3">
                            <label for="test_phone" class="form-label">Nomor WhatsApp Tujuan</label>
                            <input type="text" class="form-control" id="test_phone" name="phone" 
                                   placeholder="628123456789" required>
                            <small class="text-muted">Format: 628xxx (tanpa +, spasi, atau tanda hubung)</small>
                        </div>

                        <div class="mb-3">
                            <label for="test_message" class="form-label">Pesan Test</label>
                            <textarea class="form-control" id="test_message" name="message" rows="3" required>Halo! Ini adalah pesan test dari Wablas API. 🚀</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-send me-2"></i> Kirim Pesan Test
                        </button>
                    </form>

                </div>
            </div>

            <!-- Card Result -->
            <div class="card shadow-sm border-0 rounded-4" id="resultCard" style="display: none;">
                <div class="card-header fw-bold" id="resultHeader">
                    <i class="bi bi-check-circle me-2"></i> Hasil Test
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Response dari API:</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copyResult()">
                            <i class="bi bi-clipboard me-1"></i> Copy
                        </button>
                    </div>
                    <pre id="resultContent" class="bg-light p-3 rounded border" style="max-height: 400px; overflow-y: auto;"></pre>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    
    // Test Device Info
    $('#testDeviceForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Mengecek Device...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '{{ route("test.wablas.device") }}',
            method: 'GET',
            success: function(response) {
                Swal.close();
                showResult('success', 'Device Info - Berhasil', response);
                
                // Tampilkan info penting
                if (response.data) {
                    let info = response.data;
                    let statusIcon = info.status === 'connected' ? '✅' : '❌';
                    let activeIcon = info.active ? '✅' : '❌';
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Device Berhasil Terdeteksi!',
                        html: `
                            <div class="text-start">
                                <p><strong>Nama Device:</strong> ${info.name || '-'}</p>
                                <p><strong>Nomor Pengirim:</strong> ${info.sender || '-'}</p>
                                <p><strong>Status:</strong> ${statusIcon} ${info.status || '-'}</p>
                                <p><strong>Aktif:</strong> ${activeIcon} ${info.active ? 'Ya' : 'Tidak'}</p>
                                <p><strong>Quota:</strong> ${info.quota || 0}</p>
                                <p><strong>Expired Date:</strong> ${info.expired_date || '-'}</p>
                            </div>
                        `,
                        confirmButtonColor: '#198754'
                    });
                }
            },
            error: function(xhr) {
                Swal.close();
                let errorData = xhr.responseJSON || {message: 'Terjadi kesalahan!'};
                showResult('error', 'Device Info - Error', errorData);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengecek Device!',
                    html: errorData.message || 'Terjadi kesalahan saat menghubungi API',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    });

    // Test Send Message
    $('#testMessageForm').on('submit', function(e) {
        e.preventDefault();
        
        let phone = $('#test_phone').val();
        let message = $('#test_message').val();

        if (!phone || !message) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: 'Nomor dan pesan harus diisi!',
                confirmButtonColor: '#ffc107'
            });
            return;
        }

        Swal.fire({
            title: 'Mengirim Pesan...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '{{ route("test.wablas.send") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                phone: phone,
                message: message
            },
            success: function(response) {
                Swal.close();
                showResult('success', 'Pesan Terkirim - Berhasil', response);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Pesan Berhasil Dikirim!',
                    html: `Pesan telah dikirim ke nomor:<br><strong>${phone}</strong>`,
                    confirmButtonColor: '#198754'
                });
            },
            error: function(xhr) {
                Swal.close();
                let errorData = xhr.responseJSON || {message: 'Gagal mengirim pesan!'};
                showResult('error', 'Kirim Pesan - Error', errorData);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengirim Pesan!',
                    html: errorData.message || 'Terjadi kesalahan',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    });

    // Function to show result
    function showResult(type, title, data) {
        $('#resultCard').show();
        $('#resultHeader').removeClass('text-bg-success text-bg-danger')
                         .addClass(type === 'success' ? 'text-bg-success' : 'text-bg-danger');
        $('#resultHeader').html('<i class="bi bi-' + (type === 'success' ? 'check-circle' : 'x-circle') + ' me-2"></i>' + title);
        $('#resultContent').text(JSON.stringify(data, null, 2));
        
        // Scroll to result
        $('html, body').animate({
            scrollTop: $('#resultCard').offset().top - 20
        }, 500);
    }
});

// Copy result to clipboard
function copyResult() {
    let content = document.getElementById('resultContent').textContent;
    navigator.clipboard.writeText(content).then(function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Response berhasil di-copy!',
            timer: 1500,
            showConfirmButton: false
        });
    });
}
</script>
@endsection