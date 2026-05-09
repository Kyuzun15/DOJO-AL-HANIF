/* public/js/admin/dashboard.js */

// Logika Tab Pindah Menu
function openTab(evt, tabName) {
    let tabcontent = document.getElementsByClassName("tab-content");
    for (let i = 0; i < tabcontent.length; i++) { 
        tabcontent[i].classList.remove("active"); 
    }
    let tablinks = document.getElementsByClassName("tab-btn");
    for (let i = 0; i < tablinks.length; i++) { 
        tablinks[i].classList.remove("active"); 
    }
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}

// Logika Live Search
function searchMember() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll(".data-row");

    rows.forEach(row => {
        let textValue = row.textContent || row.innerText;
        if (textValue.toLowerCase().indexOf(input) > -1) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

// Logika Buka Tutup Modal (Agar HTML lebih bersih)
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Logika Preview Gambar
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}