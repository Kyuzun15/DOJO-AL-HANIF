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
    <style>
        .structure-container {
            padding: 80px 20px;
            background-color: #fff;
            text-align: center;
            min-height: 100vh;
        }

        .header-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 3rem;
            font-weight: 900;
            color: #1a1a1a;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .header-subtitle {
            color: #666;
            margin-bottom: 60px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Organizational Tree CSS */
        .tree {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        .tree-row {
            display: flex;
            justify-content: center;
            gap: 60px;
            position: relative;
            width: 100%;
        }

        .member-card {
            background: #fff;
            border: 1px solid #eee;
            border-bottom: 4px solid #b31b1b;
            padding: 25px;
            width: 280px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(179, 27, 27, 0.15);
        }

        /* Modal Details */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }

        .modal-card {
            background: white;
            width: 90%;
            max-width: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            background: #b31b1b;
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
            opacity: 0.8;
        }

        .modal-close:hover { opacity: 1; }

        .modal-body {
            padding: 30px;
        }

        .modal-body h3 {
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 5px;
            color: #1a1a1a;
            font-size: 1.5rem;
        }

        .modal-body p.role {
            color: #b31b1b;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .detail-item {
            margin-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .detail-label {
            font-size: 0.75rem;
            color: #999;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
            margin-bottom: 3px;
        }

        .detail-value {
            color: #444;
            font-weight: 500;
            white-space: pre-line;
        }

        .member-icon {
            font-size: 1.5rem;
            color: #b31b1b;
            margin-bottom: 15px;
            display: block;
        }

        .member-role {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #1a1a1a;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .member-name {
            color: #666;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Connecting Lines */
        .tree::before {
            content: '';
            position: absolute;
            top: 100px;
            bottom: 100px;
            left: 50%;
            width: 2px;
            background: #b31b1b;
            z-index: 1;
            transform: translateX(-50%);
        }

        .tree-row::after {
            content: '';
            position: absolute;
            top: -20px;
            left: 15%;
            right: 15%;
            height: 2px;
            background: #b31b1b;
            z-index: 1;
        }

        .tree-row:first-child::after {
            display: none;
        }

        .vertical-line {
            position: absolute;
            top: -40px;
            left: 50%;
            height: 40px;
            width: 2px;
            background: #b31b1b;
            transform: translateX(-50%);
        }

        @media (max-width: 992px) {
            .tree-row {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }
            .tree-row::after, .tree::before, .vertical-line {
                display: none;
            }
            .member-card {
                width: 100%;
                max-width: 320px;
            }
        }
    </style>
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
                <i class="fas fa-user-circle" style="font-size: 5rem;"></i>
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

        // Mapping data ke posisi
        const biodata = {
            ketua: rawData.find(p => p.kode_jabatan === 'ketua'),
            bendahara: rawData.find(p => p.kode_jabatan === 'bendahara'),
            sekretaris: rawData.find(p => p.kode_jabatan === 'sekretaris'),
            bimbingan_presiden_1: rawData.find(p => p.kode_jabatan === 'bimbingan_presiden_1'),
            bidang_usaha: rawData.find(p => p.kode_jabatan === 'bidang_usaha'),
            bimbingan_presiden_2: rawData.find(p => p.kode_jabatan === 'bimbingan_presiden_2'),
        };

        const treeContainer = document.getElementById('orgTree');

        // Template Generator
        function createCard(data, icon, fallbackRole) {
            const hasData = data && data.nama_lengkap;
            const name = hasData ? data.nama_lengkap : '-';
            const role = hasData ? data.nama_jabatan : fallbackRole;
            const onClickAttr = hasData ? `onclick="showDetail('${data.kode_jabatan}')"` : '';

            return `
                <div class="member-card" ${onClickAttr}>
                    <i class="fas ${icon} member-icon"></i>
                    <div class="member-role">${role}</div>
                    <div class="member-name">${name}</div>
                </div>
            `;
        }

        // Render Tree
        treeContainer.innerHTML = `
            <!-- Level 1: Ketua -->
            <div class="tree-row">
                ${createCard(biodata.ketua, 'fa-user-tie', 'KETUA')}
            </div>

            <!-- Level 2: Bendahara & Sekretaris -->
            <div class="tree-row">
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    ${createCard(biodata.bendahara, 'fa-wallet', 'BENDAHARA')}
                </div>
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    ${createCard(biodata.sekretaris, 'fa-file-signature', 'SEKRETARIS')}
                </div>
            </div>

            <!-- Level 3: Bidang-Bidang -->
            <div class="tree-row">
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    ${createCard(biodata.bimbingan_presiden_1, 'fa-trophy', 'BIMBINGAN PRESTASI (KETUA)')}
                </div>
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    ${createCard(biodata.bidang_usaha, 'fa-briefcase', 'BIDANG USAHA')}
                </div>
                <div style="position: relative;">
                    <div class="vertical-line"></div>
                    ${createCard(biodata.bimbingan_presiden_2, 'fa-medal', 'BIMBINGAN PRESTASI (WAKIL KETUA)')}
                </div>
            </div>
        `;

        // Interactivity Functions
        function showDetail(kode) {
            const data = rawData.find(p => p.kode_jabatan === kode);
            if(!data) return;

            document.getElementById('modalName').innerText = data.nama_lengkap;
            document.getElementById('modalRole').innerText = data.nama_jabatan;
            document.getElementById('modalBelt').innerText = data.tingkatan || '-';
            document.getElementById('modalPeriod').innerText = data.periode || '-';
            document.getElementById('modalLomba').innerText = data.prestasi_lomba || 'Belum ada data prestasi lomba.';
            document.getElementById('modalSertif').innerText = data.prestasi_sertifikasi || 'Belum ada data sertifikasi.';

            document.getElementById('detailModal').style.display = 'flex';
        }

        function closeDetail() {
            document.getElementById('detailModal').style.display = 'none';
        }

        // Close on overlay click
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                closeDetail();
            }
        }
    </script>
</body>
</html>
