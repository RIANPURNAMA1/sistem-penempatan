<div class="fixed-bottom d-lg-none bg-warning border-top shadow-lg py-2" style="z-index: 1030;">
    <div class="d-flex justify-content-around">

        <!-- HOME -->
        <a href="{{ url('/') }}"
           class="text-center text-decoration-none text-dark">
            <div class="p-2 rounded-3 {{ request()->is('/') ? 'bg-white bg-opacity-75' : '' }}">
                <i class="bi bi-house-door-fill text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem; margin-top: 2px;">Home</div>
            </div>
        </a>

        <!-- PENDAFTARAN -->
        <a href="{{ url('/pendaftaran/cv') }}"
           class="text-center text-decoration-none text-dark">
            <div class="p-2 rounded-3 {{ request()->is('pendaftaran*') ? 'bg-white bg-opacity-75' : '' }}">
                <i class="bi bi-person-vcard-fill text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem; margin-top: 2px;">Daftar</div>
            </div>
        </a>

        <!-- DAFTAR CV -->
        <a href="{{ url('/pendaftaran/cv') }}"
           class="text-center text-decoration-none text-dark">
            <div class="p-2 rounded-3 {{ request()->is('cv*') ? 'bg-white bg-opacity-75' : '' }}">
                <i class="bi bi-card-list text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem; margin-top: 2px;">Daftar CV</div>
            </div>
        </a>

        <!-- PROFILE -->
        <a href="{{ url('/profile') }}"
           class="text-center text-decoration-none text-dark">
            <div class="p-2 rounded-3 {{ request()->is('profile*') ? 'bg-white bg-opacity-75' : '' }}">
                <i class="bi bi-person-fill text-dark" style="font-size: 1.45rem;"></i>
                <div class="text-dark" style="font-size: 0.72rem; margin-top: 2px;">Profil</div>
            </div>
        </a>

    </div>
</div>
