let currentGroup = [];
let currentIndex = 0;

function openBio(kode_jabatan) {
    if (biodataGroup[kode_jabatan] && biodataGroup[kode_jabatan].length > 0) {
        currentGroup = biodataGroup[kode_jabatan];
        currentIndex = 0;
        renderBio();
        document.getElementById('detailModal').style.display = 'flex';
    } else {
        alert("Belum ada data pengurus untuk jabatan ini. Silakan tambahkan melalui halaman Admin.");
    }
}

function renderBio() {
    if (currentGroup.length === 0) return;
    const data = currentGroup[currentIndex];
    
    document.getElementById('modalName').innerText = data.nama_lengkap;
    document.getElementById('modalRoleText').innerText = data.nama_jabatan;
    
    const subJabatanEl = document.getElementById('modalSubJabatan');
    if (data.sub_jabatan) {
        subJabatanEl.innerText = `(${data.sub_jabatan})`;
        subJabatanEl.style.display = 'inline';
    } else {
        subJabatanEl.style.display = 'none';
        subJabatanEl.innerText = '';
    }

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

    // Toggle slider controls visibility
    const controls = document.getElementById('modalSliderControls');
    if (currentGroup.length > 1) {
        controls.style.display = 'flex';
    } else {
        controls.style.display = 'none';
    }
}

function nextBio() {
    if (currentGroup.length <= 1) return;
    currentIndex = (currentIndex + 1) % currentGroup.length;
    renderBio();
}

function prevBio() {
    if (currentGroup.length <= 1) return;
    currentIndex = (currentIndex - 1 + currentGroup.length) % currentGroup.length;
    renderBio();
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
