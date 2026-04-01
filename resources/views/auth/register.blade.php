<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Registrasi Sistem Kandidat</title>
    <link rel="icon" href="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1a365d',
                        secondary: '#2c5282',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .shake { animation: shake 0.3s ease-in-out; }
    </style>
</head>

<body class="min-h-screen  flex items-center justify-center p-4 bg-slate-100">

    <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-2xl overflow-hidden max-w-4xl w-full ">
        
        <!-- Left Side - Branding -->
        <div class="bg-gradient-to-br from-primary to-secondary p-8 md:p-12 flex flex-col items-center justify-center text-white w-full md:w-1/2">
            <img src="{{ asset('assets/compiled/png/LOGO/logo4.png') }}" alt="Logo" class="w-24 h-24 object-contain mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-2">Sistem Penempatan</h2>
            <p class="text-sm text-white/80 text-center">Buat akun baru untuk memulai perjalanan Anda.</p>
            
            <!-- Decorative elements -->
            <div class="mt-8 flex gap-3">
                <div class="w-3 h-3 bg-white/30 rounded-full"></div>
                <div class="w-3 h-3 bg-white/50 rounded-full"></div>
                <div class="w-3 h-3 bg-white/30 rounded-full"></div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="p-8 md:p-12 w-full md:w-1/2 flex flex-col justify-center max-h-[90vh] overflow-y-auto">
            @if ($errors->any())
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        Swal.fire({
                            icon: "error",
                            title: "Validasi Gagal!",
                            html: `<ul style="text-align:left;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>`
                        });
                    });
                </script>
            @endif

            <h3 class="text-2xl font-bold text-primary mb-1">Buat Akun Baru</h3>
            <p class="text-gray-500 text-sm mb-6">Isi data berikut untuk mendaftar</p>

            <form id="registerForm" class="space-y-4">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="bi bi-person-fill text-lg"></i>
                        </span>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="bi bi-envelope-fill text-lg"></i>
                        </span>
                        <input type="email" name="email" placeholder="nama@email.com" required
                            class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="bi bi-lock-fill text-lg"></i>
                        </span>
                        <input type="password" name="password" id="passwordInput" placeholder="Masukkan password" required
                            class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        <button type="button" onclick="togglePassword('passwordInput', 'togglePasswordIcon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary transition-colors">
                            <i id="togglePasswordIcon" class="bi bi-eye-slash-fill text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="bi bi-shield-lock-fill text-lg"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="confirmPasswordInput" placeholder="Konfirmasi password" required
                            class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        <button type="button" onclick="togglePassword('confirmPasswordInput', 'toggleConfirmPasswordIcon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary transition-colors">
                            <i id="toggleConfirmPasswordIcon" class="bi bi-eye-slash-fill text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Captcha -->
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Verifikasi Keamanan</label>
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-r from-primary to-secondary px-5 py-3 rounded-xl text-center flex-1">
                            <span id="captcha-text" class="text-xl font-bold text-white tracking-widest">X K D M R</span>
                        </div>
                        <button type="button" id="refresh-captcha" class="w-11 h-11 bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all hover:rotate-180">
                            <i class="bi bi-arrow-clockwise text-lg"></i>
                        </button>
                        <input type="text" id="captcha-answer" maxlength="5" placeholder="Ketik" required
                            class="w-28 px-3 py-3 text-center font-semibold uppercase tracking-wider bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" id="btnRegister" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-secondary transition-all hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none mt-6">
                    <i class="bi bi-person-plus mr-2"></i> Daftar
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-500">Sudah punya akun? <a href="/login" class="text-primary font-semibold hover:underline">Masuk</a></p>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(() => {
            // Captcha
            const characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ';

            function generateCaptcha() {
                let captcha = '';
                const letters = [];
                for (let i = 0; i < 5; i++) {
                    const char = characters.charAt(Math.floor(Math.random() * characters.length));
                    letters.push(char);
                    captcha += char + ' ';
                }
                return { display: captcha.trim(), actual: letters.join('') };
            }

            let currentCaptcha = generateCaptcha();
            $("#captcha-text").text(currentCaptcha.display);

            $("#refresh-captcha").on("click", function() {
                currentCaptcha = generateCaptcha();
                $("#captcha-text").text(currentCaptcha.display);
                $("#captcha-answer").val("").focus();
            });

            // Prevent zoom on input focus
            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('focus', () => { document.body.style.zoom = 1; });
            });

            // Form Submit
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                // Validasi Captcha
                const userAnswer = $("#captcha-answer").val().toUpperCase().replace(/\s/g, '');
                
                if (userAnswer !== currentCaptcha.actual) {
                    Swal.fire({ 
                        icon: "error", 
                        title: "Verifikasi Gagal!", 
                        text: "Huruf yang Anda masukkan tidak sesuai.", 
                        confirmButtonColor: "#1a365d" 
                    });
                    currentCaptcha = generateCaptcha();
                    $("#captcha-text").text(currentCaptcha.display);
                    $("#captcha-answer").val("").addClass("shake");
                    setTimeout(() => $("#captcha-answer").removeClass("shake"), 300);
                    return;
                }

                // Validasi Password Match
                const password = $('input[name="password"]').val();
                const confirmPassword = $('input[name="password_confirmation"]').val();
                
                if (password !== confirmPassword) {
                    Swal.fire({ 
                        icon: "error", 
                        title: "Password Tidak Cocok!", 
                        text: "Pastikan password dan konfirmasi password sama.", 
                        confirmButtonColor: "#1a365d" 
                    });
                    return;
                }

                const $btn = $("#btnRegister");
                $btn.prop("disabled", true).html('<span class="spinner-border spinner-border-sm mr-2"></span> Memproses...');

                $.ajax({
                    url: "{{ route('registrasi.post') }}",
                    method: "POST",
                    data: $(this).serialize(),

                    success: function(res) {
                        $btn.prop("disabled", false).html('<i class="bi bi-person-plus mr-2"></i> Daftar');

                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil!',
                                text: res.message,
                                timer: 2200,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                window.location.href = res.redirect;
                            }, 2200);

                        } else {
                            currentCaptcha = generateCaptcha();
                            $("#captcha-text").text(currentCaptcha.display);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message ?? 'Terjadi kesalahan.'
                            });
                        }
                    },

                    error: function(xhr) {
                        $btn.prop("disabled", false).html('<i class="bi bi-person-plus mr-2"></i> Daftar');
                        currentCaptcha = generateCaptcha();
                        $("#captcha-text").text(currentCaptcha.display);

                        if (xhr.status === 422) {
                            let msg = "";
                            $.each(xhr.responseJSON.errors, function(_, value) {
                                msg += `• ${value}<br>`;
                            });

                            Swal.fire({
                                icon: "error",
                                title: "Validasi Gagal",
                                html: msg
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: 'Hubungi admin jika masalah berlanjut.'
                            });
                        }
                    }
                });
            });
        });

        // Toggle Password Visibility
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash-fill");
                icon.classList.add("bi-eye-fill");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-fill");
                icon.classList.add("bi-eye-slash-fill");
            }
        }
    </script>

</body>
</html>
