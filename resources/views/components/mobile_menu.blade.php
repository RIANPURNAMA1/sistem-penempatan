 <div class="fixed-bottom d-lg-none bg-white border-top shadow-lg pt-1 pb-1">
        <div class="d-flex justify-content-around">

            {{-- HOME --}}
            <a href="{{ url('/') }}"
                class="text-center text-decoration-none {{ request()->is('/') ? 'text-danger' : 'text-secondary' }}">
                <i class="bi bi-house-door-fill" style="font-size: 1.5rem;"></i>
                <div style="font-size: 0.75rem;">Home</div>
            </a>

                @php
                    $kandidatId = auth()->user()->kandidat_id;
                @endphp

                {{-- PENDAFTARAN --}}
                @php
                    $isPendaftaranActive = request()->is('pendaftaran/kandidat*') || request()->is('pendaftaran/cv*');
                @endphp
                <a href="{{ url('/pendaftaran/kandidat') }}"
                    class="text-center text-decoration-none {{ $isPendaftaranActive ? 'text-danger' : 'text-secondary' }}">
                    <i class="bi bi-person-vcard-fill" style="font-size: 1.5rem;"></i>
                    <div style="font-size: 0.75rem;">Daftar</div>
                </a>

             
                <a href="{{ route('kandidat.riwayat', $kandidat->id) }}"
                    class="text-center text-decoration-none">
                    <i class="bi bi-clock-history" style="font-size: 1.5rem;"></i>
                    <div style="font-size: 0.75rem;">Riwayat</div>
                </a>


            {{-- PROFILE --}}
            <a href="{{ url('/profile') }}"
                class="text-center text-decoration-none {{ request()->is('profile*') ? 'text-danger' : 'text-secondary' }}">
                <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                <div style="font-size: 0.75rem;">Profil</div>
            </a>

        </div>
    </div>