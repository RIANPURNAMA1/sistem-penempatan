<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa</title>

    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/logo.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #00bfff, #60efff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        #register-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            padding: 40px 30px;
            width: 100%;
            max-width: 900px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
        }

        .btn-primary,
        .btn-warning {
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #0056d6;
        }

        .btn-warning:hover {
            background: #ffb300;
        }

        h3 {
            font-weight: 700;
        }

        small {
            display: block;
            color: #6c757d;
        }

        /* Drag & Drop Styles */
        .drop-zone {
            position: relative;
            border: 2px dashed #007bff;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s, border-color 0.3s;
        }

        .drop-zone.dragover {
            background: #e6f7ff;
            border-color: #00c0ff;
        }

        .drop-zone input {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            top: 0;
            left: 0;
        }

        .file-preview {
            margin-top: 10px;
            text-align: left;
        }

        .file-preview div {
            font-size: 0.9rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-preview img {
            max-width: 50px;
            max-height: 50px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div id="register-card">
        <div class="auth-logo text-center">
            <img src="{{ asset('assets/compiled/png/LOGO/logo.png') }}" alt="Logo Sistem Kandidat" style="width:200px; height:auto;">
        </div>
        <h3 class="text-center mb-4">Form Pendaftaran Kandidat</h3>

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <div class="drop-zone" id="drop-foto">
                            Klik atau seret file ke sini
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                        </div>
                        <div class="file-preview" id="preview-foto"></div>
                        <small>Unggah foto terbaru, format JPG/PNG.</small>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                        <small>Isi nama lengkap sesuai KTP/KK.</small>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <small>Gunakan email aktif untuk konfirmasi pendaftaran.</small>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                        <small>Isi alamat lengkap termasuk RT/RW dan kode pos.</small>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <small>Pilih jenis kelamin sesuai data resmi.</small>
                    </div>

                    <div class="mb-3">
                        <label for="no_wa" class="form-label">No. WhatsApp</label>
                        <input type="text" class="form-control" id="no_wa" name="no_wa" required>
                        <small>Isi nomor aktif, contoh: 081234567890.</small>
                    </div>

                    <div class="mb-3">
                        <label for="cabang_id" class="form-label">Cabang</label>
                        <select class="form-select" id="cabang_id" name="cabang_id" required>
                            <option value="">Pilih Cabang</option>
                            <option value="1">Cabang Bandung</option>
                            <option value="2">Cabang Jakarta</option>
                            <option value="3">Cabang Bogor</option>
                            <option value="4">Cabang Karawang</option>
                            <option value="5">Cabang Cirebon</option>
                        </select>
                        <small>Pilih cabang yang akan diikuti.</small>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Dokumen dengan drag & drop -->
                    <div class="mb-3">
                        <label for="kk" class="form-label">KK</label>
                        <div class="drop-zone" id="drop-kk">
                            Klik atau seret file ke sini
                            <input type="file" class="form-control" id="kk" name="kk" accept="image/*,application/pdf" required>
                        </div>
                        <div class="file-preview" id="preview-kk"></div>
                        <small>Unggah Kartu Keluarga dalam format JPG/PNG/PDF.</small>
                    </div>

                    <div class="mb-3">
                        <label for="ktp" class="form-label">KTP</label>
                        <div class="drop-zone" id="drop-ktp">
                            Klik atau seret file ke sini
                            <input type="file" class="form-control" id="ktp" name="ktp" accept="image/*,application/pdf" required>
                        </div>
                        <div class="file-preview" id="preview-ktp"></div>
                        <small>Unggah KTP atau dokumen identitas resmi.</small>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_pelunasan" class="form-label">Bukti Pelunasan</label>
                        <div class="drop-zone" id="drop-bukti">
                            Klik atau seret file ke sini
                            <input type="file" class="form-control" id="bukti_pelunasan" name="bukti_pelunasan" accept="image/*,application/pdf" required>
                        </div>
                        <div class="file-preview" id="preview-bukti"></div>
                        <small>Unggah bukti pembayaran yang sah.</small>
                    </div>

                    <div class="mb-3">
                        <label for="akte" class="form-label">Akte</label>
                        <div class="drop-zone" id="drop-akte">
                            Klik atau seret file ke sini
                            <input type="file" class="form-control" id="akte" name="akte" accept="image/*,application/pdf" required>
                        </div>
                        <div class="file-preview" id="preview-akte"></div>
                        <small>Unggah Akte Kelahiran.</small>
                    </div>

                    <div class="mb-3">
                        <label for="ijasah" class="form-label">Ijazah</label>
                        <div class="drop-zone" id="drop-ijasah">
                            Klik atau seret file ke sini
                            <input type="file" class="form-control" id="ijasah" name="ijasah" accept="image/*,application/pdf" required>
                        </div>
                        <div class="file-preview" id="preview-ijasah"></div>
                        <small>Unggah Ijazah terakhir dalam format JPG/PNG/PDF.</small>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                        <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" required>
                        <small>Pilih tanggal pendaftaran saat ini.</small>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning mt-3 w-max-content">Daftar</button>
        </form>

        <div class="text-center mt-3">
            <p class="text-muted">Sudah melakukan pendaftaran? <a href="login" class="fw-bold text-primary">Masuk</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.drop-zone').forEach(zone => {
            const input = zone.querySelector('input');
            const preview = zone.nextElementSibling;

            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.classList.add('dragover');
            });

            zone.addEventListener('dragleave', e => {
                e.preventDefault();
                zone.classList.remove('dragover');
            });

            zone.addEventListener('drop', e => {
                e.preventDefault();
                zone.classList.remove('dragover');
                input.files = e.dataTransfer.files;
                showPreview(input, preview);
            });

            input.addEventListener('change', () => showPreview(input, preview));
        });

        function showPreview(input, preview) {
            preview.innerHTML = '';
            Array.from(input.files).forEach(file => {
                const div = document.createElement('div');

                // Jika file gambar, tampilkan preview gambar
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.onload = () => URL.revokeObjectURL(img.src);
                    div.appendChild(img);
                }

                const span = document.createElement('span');
                span.textContent = file.name;
                div.appendChild(span);
                preview.appendChild(div);
            });
        }
    </script>
</body>

</html>
