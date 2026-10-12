async function muatDaftarPeminjam() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise(function (resolve) { setTimeout(resolve, 600); });

        const res = await fetch("../data/peminjam.json");
        if (!res.ok) {
            throw new Error("status " + res.status);
        }
        const daftar = await res.json();

        if (daftar.length === 0) {
            tampilkanPesan(tbody, 6, "Belum ada data peminjam.");
        }
        daftar.forEach(function (item) {
            tbody.appendChild(buatBaris(
                [item.nim, item.nama, kapital(item.status), item.prodi, item.no_hp]
            ));
        });
    } catch (err) {
        tampilkanPesan(tbody, 6, "Gagal memuat data (" + err.message + ").", true);
    } finally {
        loading.style.display = "none";
        perbaruiTabel();
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarPeminjam);
