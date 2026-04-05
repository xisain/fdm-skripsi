<nav class="navbar">
    <a class="nav-brand" @click="navTo('dashboard')">
        <div class="brand-icon">
            <img src="/storage/images/logo.png" alt="Tanaman Logo" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div class="brand-text">
            <span class="brand-name">Flora</span>
            <span class="brand-sub">Plant Decision Manager</span>
        </div>
    </a>

    <ul class="nav-links" :class="{ open: mobileOpen }">
        <li>
            <a :class="{ active: activeNav === 'tanaman' }" @click="navTo('tanaman')">
                Tanaman
            </a>
        </li>
        <li>
            <a :class="{ active: activeNav === 'koleksi' }" @click="navTo('koleksi')">
                Koleksi
            </a>
        </li>
        <li>
            <a :class="{ active: activeNav === 'berita' }" @click="navTo('berita')">
                Berita
            </a>
        </li>
    </ul>

    <div class="nav-actions">
        <button class="btn-add" @click="navTo('login')">
            Login
        </button>
        <button class="btn-add" style="background: var(--flora-teal);" @click="navTo('register')">
            Register
        </button>
        <button class="mobile-toggle" @click="mobileOpen = !mobileOpen">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>
    </div>
</nav>
