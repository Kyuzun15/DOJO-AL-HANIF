<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Kendali Utama - DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
</head>
<body style="background-color: #f5f6fa;">
    <div class="hub-container">
        <h1 class="hub-title">Pusat Kendali DOJO AL-HANIF</h1>
        
        <div class="hub-grid">
            <a href="/admin/anggota" class="hub-card">
                <i class="fas fa-users hub-icon blue"></i>
                <h2 class="hub-card-title">Dashboard Anggota</h2>
                <p class="hub-card-desc">Kelola calon anggota, data anggota aktif, dan prestasi.</p>
            </a>
            
            <a href="/admin/artikel" class="hub-card">
                <i class="fas fa-newspaper hub-icon"></i>
                <h2 class="hub-card-title">Dashboard Artikel</h2>
                <p class="hub-card-desc">Kelola pengumuman dan berita press release.</p>
            </a>

            <a href="/admin/kegiatan" class="hub-card">
                <i class="fas fa-calendar-check hub-icon" style="color: #27ae60;"></i>
                <h2 class="hub-card-title">Dashboard Kegiatan</h2>
                <p class="hub-card-desc">Kelola agenda kegiatan dan jadwal agenda dojo.</p>
            </a>

            <a href="/admin/pengurus" class="hub-card">
                <i class="fas fa-sitemap hub-icon" style="color: #8e44ad;"></i>
                <h2 class="hub-card-title">Dashboard Struktur</h2>
                <p class="hub-card-desc">Kelola susunan organisasi dan data pengurus dojo.</p>
            </a>

            <a href="/admin/jadwal" class="hub-card">
                <i class="fas fa-clock hub-icon" style="color: #e67e22;"></i>
                <h2 class="hub-card-title">Jadwal Latihan</h2>
                <p class="hub-card-desc">Atur hari, jam, dan tempat latihan dojo.</p>
            </a>
            

            <a href="/admin/absensi" class="hub-card">
                <i class="fas fa-clipboard-list hub-icon" style="color: #16a085;"></i>
                <h2 class="hub-card-title">Absensi Anggota</h2>
                <p class="hub-card-desc">Kelola presensi kehadiran anggota aktif secara massal.</p>
            </a>
        </div>

        <div class="logout-btn-container">
            <a href="/" class="btn bg-blue" style="padding: 10px 30px; font-size: 1.1rem; border-radius: 30px; text-decoration: none; display: inline-block;">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
