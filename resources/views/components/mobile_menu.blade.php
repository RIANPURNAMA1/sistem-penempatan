<style>
    /* ========================= */
    /* DEFAULT (LIGHT MODE)     */
    /* ========================= */
    .mobile-nav {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.596);
    }

    .mobile-nav i,
    .mobile-nav div {
        color: #000 !important;
    }

    .mobile-nav a div:hover {
        background: rgba(0, 0, 0, 0.05) !important;
    }

    .mobile-act {
        background-color: #273044;
        color: #fff !important;
        box-shadow: 0 4px 10px rgba(0, 192, 255, 0.35);
    }

    /* ========================= */
    /* DARK MODE ACTIVE         */
    /* ========================= */
    :root[data-bs-theme="dark"] .mobile-nav {
       background: #01040e;
        border-top: 1px solid rgba(255, 255, 255, 0.09);
    }

    :root[data-bs-theme="dark"] .mobile-nav i,
    :root[data-bs-theme="dark"] .mobile-nav div {
        color: #fff !important;
    }

    :root[data-bs-theme="dark"] .mobile-nav a div:hover {
        background: rgba(255, 255, 255, 0.12) !important;
    }

    /* ACTIVE ITEM DI DARK MODE */
    :root[data-bs-theme="dark"] .mobile-act {
        background-color: #3d4a63 !important;
        color: #fff !important;
        box-shadow: 0 4px 10px rgba(0, 140, 255, 0.3) !important;
    }

    /* OPTIONAL: ICON TRANSITION */
    .mobile-nav i,
    .mobile-nav div {
        transition: .25s ease-in-out;
    }
</style>

<div class="fixed-bottom d-lg-none mobile-nav shadow-lg py-2" style="z-index: 1030;">
    <div class="d-flex justify-content-around">

        <!-- HOME -->
        <a href="{{ url('/') }}" class="text-center text-decoration-none">
            <div class="p-2 rounded-3 {{ request()->is('/') ? ' bg-opacity-75' : '' }}">
                <i class="bi bi-house-door-fill text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem;">Home</div>
            </div>
        </a>

        <!-- PENDAFTARAN -->
        <a href="{{ url('/pendaftaran/kandidat') }}" class="text-center text-decoration-none">
            <div class="p-2 rounded-3 {{ request()->is('pendaftaran*') ? ' bg-opacity-75' : '' }}">
                <i class="bi bi-person-vcard-fill text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem;">Daftar</div>
            </div>
        </a>

        <!-- DAFTAR CV -->
        <a href="{{ url('/pendaftaran/cv/kandidat') }}" class="text-center text-decoration-none">
            <div class="p-2 rounded-3 {{ request()->is('cv*') ? ' bg-opacity-75' : '' }}">
                <i class="bi bi-card-list text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem;">Daftar CV</div>
            </div>
        </a>

        <!-- PROFILE -->
        <a href="{{ url('/profile') }}" class="text-center text-decoration-none">
            <div class="p-2 rounded-3 {{ request()->is('profile*') ? ' bg-opacity-75' : '' }}">
                <i class="bi bi-person-fill text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem;">Profil</div>
            </div>
        </a>

    </div>
</div>
