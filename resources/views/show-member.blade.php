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
    <link rel="stylesheet" href="{{ asset('css/beranda/show-member.css') }}">
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
                    <span class="info-label">Nomor Anggota :</span>
                    <span class="info-value">{{ $member->nomor_anggota ?? '-' }}</span>
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
                <div class="info-group">
                    <span class="info-label">Total Hadir :</span>
                    <span class="info-value">{{ $total_hadir }} Pertemuan</span>
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
