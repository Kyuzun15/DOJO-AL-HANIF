document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toUpperCase();
    let table = document.getElementById("memberTable");
    let tbody = table.getElementsByTagName("tbody")[0];
    let trs = tbody.getElementsByTagName("tr");

    let currentBeltRow = null;
    let visibleCount = 0;

    for (let i = 0; i < trs.length; i++) {
        let tr = trs[i];
        if (tr.classList.contains('belt-row')) {
            // Hide previous belt row if it had no visible members
            if (currentBeltRow) {
                currentBeltRow.style.display = visibleCount === 0 && filter !== '' ? "none" : "";
            }
            currentBeltRow = tr;
            visibleCount = 0; // reset for the new belt section
        } else if (tr.getElementsByTagName("td").length > 1) { // Normal data row
            let tdNama = tr.getElementsByTagName("td")[0];
            if (tdNama) {
                let txtValue = tdNama.textContent || tdNama.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr.style.display = "";
                    visibleCount++;
                } else {
                    tr.style.display = "none";
                }
            }
        }
    }

    // Check the last belt row
    if (currentBeltRow) {
        currentBeltRow.style.display = visibleCount === 0 && filter !== '' ? "none" : "";
    }
});
