<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - DOJO AL-HANIF</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/beranda/struktur.css') }}">
</head>
<body>

    @include('partials.navbar')

    <div class="structure-container">
        <h1 class="header-title">STRUKTUR ORGANISASI</h1>
        <p class="header-subtitle">Susunan pengurus DOJO AL-HANIF periode saat ini yang berdedikasi tinggi dalam pengembangan karakter dan prestasi bela diri.</p>

        <div class="tree" id="orgTree">
            <!-- Data will be populated by JavaScript -->
        </div>
    </div>

    <!-- Modal Detail Pengurus -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <div class="modal-header">
                <span class="modal-close" onclick="closeDetail()">&times;</span>
                <i class="fas fa-user-circle" id="modalIcon" style="font-size: 5rem; display: none;"></i>
                <img id="modalFoto" src="" alt="Foto Pengurus" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 3px solid white; display: none; margin: 0 auto;">
            </div>
            <div class="modal-body">
                <h3 id="modalName">-</h3>
                <p class="role" id="modalRole">-</p>
                
                <div class="detail-item">
                    <span class="detail-label">Tingkatan / Sabuk</span>
                    <span class="detail-value" id="modalBelt">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Periode Jabatan</span>
                    <span class="detail-value" id="modalPeriod">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Prestasi Lomba</span>
                    <span class="detail-value" id="modalLomba">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Sertifikasi & Lisensi</span>
                    <span class="detail-value" id="modalSertif">-</span>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        // Data dari Laravel Backend
        const rawData = @json($pengurus);
    </script>
    <script src="{{ asset('js/beranda/struktur.js') }}"></script>
</body>
</html>
