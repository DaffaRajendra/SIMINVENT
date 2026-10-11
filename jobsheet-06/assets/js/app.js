function initNavToggle() {
    const tombol = document.getElementById("nav-toggle-btn");
    const menu = document.getElementById("navMenu");
    if (!tombol || !menu) return;

    tombol.addEventListener("click", function () {
        const terbuka = menu.classList.toggle("show");
        tombol.setAttribute("aria-expanded", terbuka);
    });
}

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

function perbaruiTabel() {
    const table = ambilTabel();
    if (!table) return;

    const input = document.getElementById("search-input");
    const keyword = input ? input.value.trim().toLowerCase() : "";
    const idx = indeksKolomCari(table);
    const rows = table.querySelectorAll("tbody tr:not(.baris-pesan)");
    let tampil = 0;

    rows.forEach(function (row) {
        const sel = row.cells[idx];
        const teks = sel ? sel.textContent.toLowerCase() : "";
        const cocok = teks.includes(keyword);
        row.style.display = cocok ? "" : "none";
        if (cocok) tampil++;
    });

    const info = document.getElementById("info-jumlah");
    if (info) {
        const namaKolom = table.querySelectorAll("thead th")[idx].textContent.trim();
        const satuan = namaKolom === "Nama Barang" ? "barang" : "peminjam";
        info.textContent = "Menampilkan " + tampil + " dari " + rows.length + " " + satuan;
    }
}

function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = ambilTabel();
    if (!table || !input) return;

    const info = document.createElement("p");
    info.id = "info-jumlah";
    info.className = "text-secondary small mb-2";
    table.closest(".table-responsive").insertAdjacentElement("beforebegin", info);

    input.addEventListener("keyup", perbaruiTabel);
    perbaruiTabel();
}

function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const table = ambilTabel();
        let nama = "data ini";
        if (row && table) {
            const sel = row.cells[indeksKolomCari(table)];
            if (sel) nama = sel.textContent.trim();
        }
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) {
            row.remove();
            perbaruiTabel();
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
    { name: "kode_barang", label: "Kode Barang", wajib: true, pola: /^[A-Za-z0-9-]+$/, pesanPola: "Kode Barang hanya boleh berisi huruf, angka, dan tanda hubung (-)." },
    { name: "nama_barang", label: "Nama Barang", wajib: true },
    { name: "lokasi",      label: "Lokasi",      wajib: true },
    { name: "stok",        label: "Stok",        wajib: true, bulat: true, min: 0 },
    { name: "nim",         label: "NIM / NIP",   wajib: true, pola: /^[0-9]{8,20}$/, pesanPola: "NIM / NIP hanya boleh berisi angka (8-20 digit)." },
    { name: "nama",        label: "Nama",        wajib: true },
    { name: "prodi",       label: "Prodi / Unit", wajib: true },
    { name: "no_hp",       label: "No. HP",      wajib: true, pola: /^[0-9+\-\s]{8,15}$/, pesanPola: "No. HP harus 8-15 karakter (angka, +, -)." },
    { name: "email",       label: "Email",       wajib: true, pola: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, pesanPola: "Format email tidak valid." }
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
        if (aturan.min !== undefined && angka < aturan.min) {
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

function buatBadge(teks, warna) {
    const span = document.createElement("span");
    span.className = "badge rounded-pill bg-" + warna + "-subtle text-" + warna + "-emphasis";
    span.textContent = teks.charAt(0).toUpperCase() + teks.slice(1);
    return span;
}

function buatBaris(nilaiKolom, kelasEdit, kelasHapus) {
    const tr = document.createElement("tr");

    nilaiKolom.forEach(function (nilai) {
        const td = document.createElement("td");
        td.append(nilai);
        tr.appendChild(td);
    });

    const tdAksi = document.createElement("td");
    tdAksi.className = "text-nowrap";
    const tombolEdit = document.createElement("button");
    tombolEdit.type = "button";
    tombolEdit.className = kelasEdit;
    tombolEdit.innerHTML = '<i class="bi bi-pencil"></i> Edit';
    const tombolHapus = document.createElement("button");
    tombolHapus.type = "button";
    tombolHapus.className = kelasHapus;
    tombolHapus.innerHTML = '<i class="bi bi-trash"></i> Hapus';
    tdAksi.append(tombolEdit, " ", tombolHapus);
    tr.appendChild(tdAksi);

    return tr;
}

function tampilkanPesan(tbody, jumlahKolom, pesan, error) {
    const tr = document.createElement("tr");
    tr.className = "baris-pesan";
    const td = document.createElement("td");
    td.colSpan = jumlahKolom;
    td.className = "text-center py-4 " + (error ? "text-danger" : "text-secondary");
    td.textContent = pesan;
    tr.appendChild(td);
    tbody.appendChild(tr);
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});
