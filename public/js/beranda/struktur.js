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

    if (data.foto) {
        document.getElementById('modalFoto').src = '/pengurus/' + data.foto;
        document.getElementById('modalFoto').style.display = 'block';
        document.getElementById('modalIcon').style.display = 'none';
    } else {
        document.getElementById('modalFoto').style.display = 'none';
        document.getElementById('modalIcon').style.display = 'inline-block';
    }

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
