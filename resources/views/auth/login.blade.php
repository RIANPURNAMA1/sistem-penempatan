<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login Sistem Kandidat</title>
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
            <p class="text-sm text-white/80 text-center">Selamat datang! Silakan masuk untuk melanjutkan.</p>
            
            <!-- Decorative elements -->
            <div class="mt-8 flex gap-3">
                <div class="w-3 h-3 bg-white/30 rounded-full"></div>
                <div class="w-3 h-3 bg-white/50 rounded-full"></div>
                <div class="w-3 h-3 bg-white/30 rounded-full"></div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="p-8 md:p-12 w-full md:w-1/2 flex flex-col justify-center">
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

            <h3 class="text-2xl font-bold text-primary mb-1">Selamat Datang</h3>
            <p class="text-gray-500 text-sm mb-6">Masuk dengan akun Anda</p>

            <form id="loginForm" method="POST" class="space-y-4">
                @csrf

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
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary transition-colors">
                            <i class="bi bi-eye-slash-fill text-lg"></i>
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

                <!-- Login Button -->
                <button type="submit" id="loginBtn" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-secondary transition-all hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none mt-6">
                    <i class="bi bi-box-arrow-in-right mr-2"></i> Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-5">
                <div class="flex-1 border-t border-gray-200"></div>
                <span class="px-4 text-sm text-gray-400">atau</span>
                <div class="flex-1 border-t border-gray-200"></div>
            </div>

            <!-- Google Button -->
            <button id="btnGoogle" class="w-full bg-white border-2 border-gray-200 py-3 rounded-xl font-medium text-gray-600 hover:border-primary hover:text-primary transition-all flex items-center justify-center gap-3">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5">
                Masuk dengan Google
            </button>

            <!-- Links -->
            <div class="text-center mt-6 space-y-1">
                <p class="text-sm text-gray-500">Belum punya akun? <a href="/registrasi" class="text-primary font-semibold hover:underline">Daftar</a></p>
                <p class="text-sm"><a href="/lupa/password" class="text-primary font-semibold hover:underline">Lupa password?</a></p>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(() => {
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

            $("#togglePassword").on("click", function() {
                const passwordInput = $("#passwordInput");
                const icon = $(this).find("i");
                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
                } else {
                    passwordInput.attr("type", "password");
                    icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
                }
            });

            document.querySelectorAll('input').forEach(input => {
                input.addEventListener('focus', () => { document.body.style.zoom = 1; });
            });

            $("#btnGoogle").on("click", function() { window.location.href = "/auth/google/redirect"; });

            $("#loginForm").on("submit", function(e) {
                e.preventDefault();

                const userAnswer = $("#captcha-answer").val().toUpperCase().replace(/\s/g, '');
                
                if (userAnswer !== currentCaptcha.actual) {
                    Swal.fire({ icon: "error", title: "Verifikasi Gagal!", text: "Huruf yang Anda masukkan tidak sesuai.", confirmButtonColor: "#1a365d" });
                    currentCaptcha = generateCaptcha();
                    $("#captcha-text").text(currentCaptcha.display);
                    $("#captcha-answer").val("").addClass("shake");
                    setTimeout(() => $("#captcha-answer").removeClass("shake"), 300);
                    return;
                }

                const $btn = $("#loginBtn");
                $btn.prop("disabled", true).html('<span class="spinner-border spinner-border-sm mr-2"></span> Memproses...');

                $.ajax({
                    url: "{{ route('login.post') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $btn.prop("disabled", false).html('<i class="bi bi-box-arrow-in-right mr-2"></i> Masuk');

                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Login Berhasil!", timer: 1500, showConfirmButton: false });
                            setTimeout(() => window.location.href = response.redirect, 1500);
                        } else {
                            currentCaptcha = generateCaptcha();
                            $("#captcha-text").text(currentCaptcha.display);
                            if (response.code === 'ACCOUNT_NOT_FOUND') {
                                Swal.fire({ icon: "warning", title: "Akun Tidak Ditemukan", text: "Email yang Anda masukkan belum terdaftar." });
                            } else {
                                Swal.fire({ icon: "error", title: "Login Gagal!", text: response.message ?? "Email atau password salah." });
                            }
                        }
                    },
                    error: function() {
                        $btn.prop("disabled", false).html('<i class="bi bi-box-arrow-in-right mr-2"></i> Masuk');
                        currentCaptcha = generateCaptcha();
                        $("#captcha-text").text(currentCaptcha.display);
                        Swal.fire({ icon: "error", title: "Login Gagal", text: "Terjadi kesalahan sistem, silakan coba lagi." });
                    }
                });
            });
        });
    </script>

</body>
</html>
