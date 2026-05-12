let brandClickCount = 0;
let brandClickTimer = null;

function handleBrandClick(event) {
    event.preventDefault(); // Cegah pindah halaman langsung
    brandClickCount++;
    
    if (brandClickTimer) clearTimeout(brandClickTimer);
    
    if (brandClickCount >= 5) {
        brandClickCount = 0;
        const modal = document.getElementById("loginModal");
        if (modal) {
            modal.style.display = "flex"; // Munculkan modal rahasia
        } else {
            window.location.href = "/"; // Jika di halaman lain, tetap arahkan ke beranda
        }
    } else {
        brandClickTimer = setTimeout(() => {
            if (brandClickCount > 0 && brandClickCount < 5) {
                window.location.href = "/"; // Pindah halaman normal jika kurang dari 5 klik
            }
            brandClickCount = 0;
        }, 300); // Tunggu 300ms untuk ngecek ada klik tambahan atau ngga
    }
}

function toggleSidebarMenu() {
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
        if (sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        } else {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        }
    }
}
