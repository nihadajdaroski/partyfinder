<nav class="navbar">
    <div class="container">
        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 2rem;">
            
            <a class="navbar-brand" href="/">
                PartyFinder
            </a>

            <!-- Right Side: Auth Buttons & Menu -->
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                @guest
                    <a href="{{ route('login') }}" class="btn-nav btn-nav-secondary">
                        Prijava
                    </a>
                    <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">
                        Registracija
                    </a>
                @endguest

                @auth
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('profile.edit') }}" class="btn-icon" title="Profil">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-icon" title="Odjava">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                @endauth

                <!-- Mobile Menu Toggle -->
                <button class="btn-icon d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navMenu" aria-controls="navMenu">
                    <i class="bi bi-list"></i>
                </button>
            </div>

        </div>

        <!-- Mobile Search -->
        <div style="display: none;" class="d-lg-none" style="margin-top: 1rem;">
            <input 
                type="search" 
                class="nav-search" 
                style="width: 100%; max-width: 100%;"
                placeholder="Iskanje..."
            >
        </div>
    </div>

    <!-- Mobile Menu Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="navMenu" style="background: var(--bg-secondary); border-left: 1px solid var(--border-color);">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" style="color: var(--text-primary); font-weight: 700;">Meni</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <a href="#" style="color: var(--text-secondary); text-decoration: none; font-weight: 500;">Iskanje zabav</a>
                <a href="#" style="color: var(--text-secondary); text-decoration: none; font-weight: 500;">Moje rezervacije</a>
                <a href="#" style="color: var(--text-secondary); text-decoration: none; font-weight: 500;">Ustvari dogodek</a>
                <hr style="background: var(--border-color);">
                @auth
                    <a href="#" style="color: var(--text-secondary); text-decoration: none; font-weight: 500;">Nastavitve profila</a>
                @endauth
            </div>
        </div>
    </div>
</nav>