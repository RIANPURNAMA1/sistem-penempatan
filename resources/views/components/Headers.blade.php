<header class="fixed-top mb-3 d-md-none bg-warning">
    <nav class="navbar shadow-lg px-3 py-2" style="">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <!-- Branding -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
                <img src="/assets/compiled/png/LOGO/logo4.png" alt="logo" class="rounded-circle"
                    style="width:40px; height:40px; object-fit:cover;">

                <span class="d-none d-md-inline">Sispenda Kandidat</span>
                <span class="d-md-none ">SPK</span>
            </a>

            <!-- Profile Section -->
            <div class="d-flex align-items-center gap-2">

                @if (auth()->check())
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                        alt="profile" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                @endif

            </div>

        </div>
    </nav>

</header>
