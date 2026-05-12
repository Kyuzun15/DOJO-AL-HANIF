<nav class="sticky-navbar">
    <div class="navbar-container">
        <!-- Let side: Hamburger & Title -->
        <div class="navbar-left">
            <button class="hamburger-btn" aria-label="Menu" onclick="toggleSidebarMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="brand-logo" onclick="handleBrandClick(event)">DOJO AL-HANIF</a>
        </div>
        
        <!-- Right side: Federation Logos -->
        <div class="navbar-right">
            <div class="fed-logo"><img src="{{ asset('img/forki.png') }}" alt="FORKI"></div>
            <div class="fed-logo"><img src="{{ asset('img/ksk.png') }}" alt="Kei Shin Kan"></div>
            <div class="fed-logo"><img src="{{ asset('img/dojo.png') }}" alt="Dojo Al Hanif" style="transform: scale(1.25);"></div>
            </div>
        </nav>
        <link rel="stylesheet" href="{{ asset('css/partials/navbar.css') }}">
        

<!-- Sidebar Menu Modal -->
<div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebarMenu()"></div>
<div id="sidebarMenu" class="sidebar-menu">
    <div class="sidebar-header">
        <h3 style="color: #b31b1b; margin: 0; font-family: 'Montserrat', sans-serif;">MENU</h3>
        <button class="close-sidebar-btn" onclick="toggleSidebarMenu()"><i class="fas fa-times"></i></button>
    </div>
    <div class="sidebar-content">
        <a href="/" class="sidebar-link"><i class="fas fa-home"></i> Beranda</a>
        <a href="/profil-anggota" class="sidebar-link"><i class="fas fa-users"></i> Profil Anggota</a>
        <a href="/struktur-organisasi" class="sidebar-link"><i class="fas fa-sitemap"></i> Struktur Organisasi</a>
        <a href="/daftar" class="sidebar-link"><i class="fas fa-user-plus"></i> Pendaftaran Online</a>
        @auth
            <a href="/dashboard" class="sidebar-link"><i class="fas fa-columns"></i> Dashboard Admin</a>
        @endauth
    </div>
</div>


<script src="{{ asset('js/partials/navbar.js') }}"></script>