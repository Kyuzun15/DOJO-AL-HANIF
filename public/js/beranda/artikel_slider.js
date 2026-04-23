document.addEventListener('DOMContentLoaded', function() {
    const section = document.getElementById('home-artikel-section');
    if (!section) return;

    const artikelData = JSON.parse(section.dataset.artikels || '[]');
    if (artikelData.length <= 1) return;

    let currentArtikelIndex = 0;
    const titleEl = document.getElementById('home-artikel-title');
    const excerptEl = document.getElementById('home-artikel-excerpt');
    const linkEl = document.getElementById('home-artikel-link');

    window.updateArtikelDisplay = function() {
        const art = artikelData[currentArtikelIndex];
        section.style.backgroundImage = `url('${art.cover}')`;
        
        titleEl.style.opacity = 0;
        excerptEl.style.opacity = 0;
        
        setTimeout(() => {
            titleEl.innerText = art.title;
            excerptEl.innerText = art.excerpt;
            linkEl.href = `/artikel/${art.slug}`;
            titleEl.style.opacity = 1;
            excerptEl.style.opacity = 1;
        }, 300);
    };

    window.nextArtikel = function() {
        currentArtikelIndex = (currentArtikelIndex + 1) % artikelData.length;
        updateArtikelDisplay();
    };

    window.prevArtikel = function() {
        currentArtikelIndex = (currentArtikelIndex - 1 + artikelData.length) % artikelData.length;
        updateArtikelDisplay();
    };
});
