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
            tampilkanPesan(tbody, 7, "Belum ada data peminjam.");
        }
        daftar.forEach(function (item) {
            tbody.appendChild(buatBaris(
                [item.nim, item.nama, buatBadge(item.status, item.status === "mahasiswa" ? "primary" : item.status === "dosen" ? "success" : "secondary"), item.prodi, item.no_hp, item.email],
                "btn btn-sm btn-outline-secondary",
                "btn btn-sm btn-outline-danger btn-hapus"
            ));
        });
    } catch (err) {
        tampilkanPesan(tbody, 7, "Gagal memuat data (" + err.message + ").", true);
    } finally {
        loading.style.display = "none";
        perbaruiTabel();
    }
}

document.addEventListener("DOMContentLoaded", muatDaftarPeminjam);
