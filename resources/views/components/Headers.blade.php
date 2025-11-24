<header class="mb-3">
    <nav class="navbar navbar-expand-lg shadow-sm px-3 py-2 rounded-3" style="background-color:#00c0ff;">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <!-- Branding -->
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white" href="/">
                <img src="/assets/compiled/png/LOGO/logo4.png"
                     alt="logo"
                     class="rounded-circle"
                     style="width:40px; height:40px; object-fit:cover;">
                Sispenda Kandidat
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
                   href="#" id="profileDropdown"
                   data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff"
                         alt="profile"
                         class="rounded-circle me-2"
                         style="width:40px; height:40px; object-fit:cover;">

                    <span class="fw-semibold text-white">{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                    <li>
                        <a class="dropdown-item py-2" href="#">
                            <i class="bi bi-person-circle me-2"></i> Profil
                        </a>
                    </li>
                    <li>
                        <button class="dropdown-item text-danger py-2" id="logout-btn">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>
