<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil {{ $member->nama }} - DOJO AL-HANIF</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/beranda/style.css') }}">
    <style>
        .profile-detail-section {
            padding: 80px 20px;
            background: #fff;
            min-height: 80vh;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 60px;
        }
        .profile-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: -1px;
        }
        .profile-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 50px;
            align-items: start;
        }
        .profile-photo-container {
            width: 100%;
            aspect-ratio: 3/4;
            background: #f0f0f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-photo-container i {
            font-size: 8rem;
            color: #ccc;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        .info-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .info-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.85rem;
            font-weight: 800;
            color: #b31b1b;
            text-transform: uppercase;
        }
        .info-value {
            font-family: 'Inter', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }
        .prestasi-section {
            max-width: 1100px;
            margin: 80px auto 0;
            text-align: center;
        }
        .prestasi-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 40px;
            color: #1a1a1a;
        }
        .prestasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        .prestasi-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #eee;
            transition: transform 0.3s;
        }
        .prestasi-card:hover {
            transform: translateY(-5px);
        }
        .prestasi-image {
            width: 100%;
            height: 200px;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .prestasi-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .prestasi-image i {
            font-size: 4rem;
            color: #ddd;
        }
        .prestasi-info {
            padding: 20px;
            background: #fff;
        }
        .prestasi-card-name {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
            .profile-photo-container {
                max-width: 300px;
                margin: 0 auto;
            }
            .profile-header h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <section class="profile-detail-section">
        <div class="profile-header">
            <h1>PROFIL ANGGOTA</h1>
        </div>

        <div class="profile-grid">
            <div class="profile-photo-container">
                @if($member->foto)
                    <img src="{{ Storage::url($member->foto) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>

            <div class="profile-info">
                <div class="info-group">
                    <span class="info-label">Nama :</span>
                    <span class="info-value">{{ strtoupper($member->nama) }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Nama Ortu :</span>
                    <span class="info-value">{{ strtoupper($member->nama_ayah) }} / {{ strtoupper($member->nama_ibu) }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Tingkatan Sabuk :</span>
                    <span class="info-value">{{ strtoupper($member->sabuk) }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Tahun Masuk :</span>
                    <span class="info-value">{{ $member->tahun_masuk }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Alamat :</span>
                    <span class="info-value">{{ $member->alamat }}</span>
                </div>
            </div>
        </div>

        <div class="prestasi-section">
            <h2 class="prestasi-title">PRESTASI</h2>
            
            <div class="prestasi-grid">
                @forelse($member->prestasi as $p)
                    <div class="prestasi-card">
                        <div class="prestasi-image">
                            @if($p->foto_prestasi)
                                <img src="{{ Storage::url($p->foto_prestasi) }}" alt="{{ $p->nama_prestasi }}">
                            @else
                                <i class="fas fa-trophy"></i>
                            @endif
                        </div>
                        <div class="prestasi-info">
                            <div class="prestasi-card-name">{{ strtoupper($p->nama_prestasi) }}</div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1/-1; padding: 40px; color: #999; background: #f9f9f9; border-radius: 12px; border: 1px dashed #ddd;">
                        Belum ada data prestasi untuk anggota ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>
