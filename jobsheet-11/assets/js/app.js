function ambilTabel() {
    return document.querySelector(".table-responsive table");
}

function indeksKolomCari(table) {
    const judulKolom = Array.from(table.querySelectorAll("thead th")).map(function (th) {
        return th.textContent.trim();
    });
    const idx = judulKolom.findIndex(function (teks) {
        return teks === "Nama Barang" || teks === "Nama";
    });
    return idx === -1 ? 0 : idx;
}

function initHapusConfirm() {
    // Tombol Hapus ada di dalam <form class="form-hapus" method="post"> berisi
    // id dan token CSRF. Konfirmasi di event "submit" agar bisa dibatalkan.
    document.addEventListener("submit", function (e) {
        const form = e.target;
        if (!form.classList.contains("form-hapus")) return;

        const row = form.closest("tr");
        const table = ambilTabel();
        let nama = "data ini";
        if (row && table) {
            const sel = row.cells[indeksKolomCari(table)];
            if (sel) nama = sel.textContent.trim();
        }
        if (!confirm("Yakin ingin menghapus \"" + nama + "\"?")) {
            e.preventDefault();
        }
    });
}

function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error text-danger small d-block mt-1";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

const ATURAN = [
    { name: "kode_barang",     label: "Kode Barang",     wajib: true, pola: /^[A-Za-z0-9-]+$/, pesanPola: "Kode Barang hanya boleh berisi huruf, angka, dan tanda hubung (-)." },
    { name: "nama_barang",     label: "Nama Barang",     wajib: true },
    { name: "lokasi",          label: "Lokasi",          wajib: true },
    { name: "stok",            label: "Stok",            wajib: true, bulat: true, min: 0 },
    { name: "nim",             label: "NIM / NIP",       wajib: true, pola: /^[0-9]{8,20}$/, pesanPola: "NIM / NIP hanya boleh berisi angka (8-20 digit)." },
    { name: "nama",            label: "Nama",            wajib: true },
    { name: "prodi",           label: "Prodi / Unit",    wajib: true },
    { name: "no_hp",           label: "No. HP",          wajib: true, pola: /^[0-9+\-\s]{8,15}$/, pesanPola: "No. HP harus 8-15 karakter (angka, +, -)." },
    { name: "email",           label: "Email",           wajib: true, pola: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, pesanPola: "Format email tidak valid." }
];

function cekNilai(aturan, nilai) {
    nilai = nilai.trim();

    if (nilai === "") {
        return aturan.wajib ? aturan.label + " wajib diisi." : "";
    }

    if (aturan.bulat) {
        const angka = Number(nilai);
        if (!Number.isInteger(angka)) {
            return aturan.label + " harus berupa bilangan bulat.";
        }
        const adaMin = aturan.min !== undefined;
        const adaMax = aturan.max !== undefined;
        if ((adaMin && angka < aturan.min) || (adaMax && angka > aturan.max)) {
            if (adaMin && adaMax) {
                return aturan.label + " harus antara " + aturan.min + " dan " + aturan.max + ".";
            }
            return aturan.label + " tidak boleh kurang dari " + aturan.min + ".";
        }
    }

    if (aturan.pola && !aturan.pola.test(nilai)) {
        return aturan.pesanPola;
    }

    return "";
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;
        let inputPertamaSalah = null;

        ATURAN.forEach(function (aturan) {
            const input = form.querySelector("[name='" + aturan.name + "']");
            if (!input) return;

            const pesan = cekNilai(aturan, input.value);
            if (pesan) {
                tampilkanError(input, pesan);
                valid = false;
                if (!inputPertamaSalah) inputPertamaSalah = input;
            } else {
                hapusError(input);
            }
        });

        if (!valid) {
            e.preventDefault();
            inputPertamaSalah.focus();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initHapusConfirm();
    initValidasiForm();
});
