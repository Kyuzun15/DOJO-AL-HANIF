let secret = "";
document.addEventListener("keydown", (e) => {
    secret += e.key.toLowerCase();
    if (secret.includes("osu")) {
        document.getElementById("loginModal").style.display = "flex";
        secret = "";
    }
});

function tutupModal() { 
    const modal = document.getElementById("loginModal");
    if (modal) modal.style.display = "none"; 
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('loginModal');
    if (modal && modal.dataset.show === 'true') {
        modal.style.display = 'flex';
    }
});