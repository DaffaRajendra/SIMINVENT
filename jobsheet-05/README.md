# Jobsheet 5 — JavaScript DOM & Event

Sub-CPMK: Menerapkan manipulasi DOM dan event JavaScript.

## Identitas

| Data | Keterangan |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Tujuan

Menghidupkan halaman-halaman SIMPUS-Mini dengan JavaScript di sisi client: menu hamburger, validasi form, pencarian tabel, dan konfirmasi hapus. Semua berjalan di browser tanpa server atau database.

## Perubahan dari Jobsheet 4

- Ditambahkan `assets/js/app.js` dan dihubungkan ke semua halaman lewat `<script src="...app.js">`.
- Hamburger menu digerakkan oleh JavaScript (event `click` dan `classList.toggle`).
- Form Tambah Buku dan Tambah Anggota diberi validasi client-side dengan pesan error inline.
- Halaman Daftar Buku dan Daftar Anggota diberi kolom pencarian real-time, counter jumlah baris, dan konfirmasi hapus.
- Aturan CSS hamburger lama (checkbox hack) dihapus dari `style.css`, diganti animasi geser untuk menu.

## Fitur yang Dibuat

### 1. Hamburger menu
Tombol `#nav-toggle-btn` memiliki event `click` yang menambah atau menghapus class `show` pada menu `#navMenu`. Karena halaman memakai navbar Bootstrap, class `show` adalah class yang dikenali Bootstrap untuk menampilkan menu. Atribut `data-bs-toggle` dan `data-bs-target` pada tombol dihapus supaya Bootstrap tidak ikut men-toggle dan bertabrakan dengan JavaScript.

### 2. Validasi form Tambah Buku dan Tambah Anggota
- Form diberi `id="form-tambah"` dan atribut `novalidate` agar validasi bawaan browser tidak mendahului pesan error dari JavaScript.
- Pesan error dibuat lewat DOM (`createElement("span")` dan `insertAdjacentElement`) di bawah field yang salah, dan dihapus saat field sudah benar.
- Kursor otomatis pindah ke field pertama yang salah, dan form tidak terkirim (`preventDefault`) selama masih ada error. Semua berjalan tanpa reload halaman.

| Form | Field | Aturan |
|---|---|---|
| Buku | Judul, Pengarang | Wajib diisi |
| Buku | Tahun terbit | Bilangan bulat, 1900 sampai tahun berjalan |
| Buku | ISBN | Wajib, hanya angka dan tanda hubung (-) |
| Buku | Stok | Bilangan bulat, tidak boleh negatif |
| Anggota | Nama, No. Anggota, Alamat | Wajib diisi |
| Anggota | No. HP | Wajib, 8-15 karakter (angka, +, -) |
| Anggota | Email | Wajib, format email valid |

### 3. Pencarian tabel real-time
Kolom cari (`#search-input`) menyaring baris tabel setiap kali ada ketikan (event `keyup`) dengan mengatur `style.display`. Pencarian hanya membaca kolom **Judul** (buku) atau **Nama** (anggota), bukan seluruh teks baris.

### 4. Konfirmasi hapus
Tombol Hapus (`.btn-hapus`) menampilkan dialog `confirm()` yang menyebut judul atau nama data. Jika dikonfirmasi, baris dihapus dari tampilan. Penghapusan ini belum ke server, jadi data muncul kembali setelah halaman dimuat ulang.

### 5. Tugas mandiri: halaman Anggota
Validasi (form Tambah Anggota) dan pencarian (Daftar Anggota) yang sama diterapkan pada halaman Anggota. Satu file `app.js` dipakai bersama oleh semua halaman.

## Ide Latihan Tambahan (8.4)

| # | Latihan | Hasil |
|---|---|---|
| 1 | Validasi field ISBN | ISBN hanya menerima angka dan tanda hubung |
| 2 | Animasi menu hamburger | Menu bergeser halus (transisi `max-height` dan `opacity` di `style.css`) |
| 3 | Pencarian satu kolom | Pencarian hanya pada kolom Judul/Nama lewat `row.cells[idx]` |
| 4 | Counter baris | Teks "Menampilkan X dari Y buku/anggota" di atas tabel, diperbarui saat mencari dan menghapus |
| 5 | Refactor validasi | Aturan field disimpan dalam array `ATURAN` dan divalidasi dengan `forEach`, tanpa blok `if` per field |

## File yang Diubah

| File | Perubahan |
|---|---|
| `assets/js/app.js` | Baru: hamburger, validasi, pencarian, counter, konfirmasi hapus |
| `assets/css/style.css` | Hapus aturan hamburger checkbox hack, tambah animasi menu, `.error`, `.search-box` |
| Semua HTML | Tombol hamburger ber-`id="nav-toggle-btn"`, script `app.js` terpasang, footer jadi Jobsheet 5 |
| `buku/list.html`, `anggota/list.html` | Kolom cari `#search-input`, tombol Hapus ber-class `btn-hapus` |
| `buku/tambah.html`, `anggota/tambah.html` | `<form id="form-tambah" novalidate>` |

## Struktur Folder

```
jobsheet-05/
├── anggota/
│   ├── list.html
│   └── tambah.html
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── buku/
│   ├── list.html
│   └── tambah.html
├── docs/
│   └── wireframe.md
├── dokumentasi/            # Screenshot hasil
├── index.html
└── README.md
```

## Cara Menjalankan dan Menguji

Buka `index.html` di browser, lalu coba:

1. Buka **Tambah Buku** atau **Tambah Anggota**, kirim form kosong: pesan error muncul di bawah tiap field tanpa reload.
2. Isi ISBN dengan huruf (misalnya "ABC-123"): muncul pesan bahwa ISBN hanya boleh angka dan tanda hubung.
3. Buka **List Buku** atau **List Anggota**, ketik di kolom cari: tabel tersaring dan counter berubah.
4. Klik **Hapus**: muncul dialog konfirmasi, baris hilang jika dikonfirmasi, dan counter berkurang.
5. Kecilkan jendela browser di bawah 992px, lalu klik tombol ☰: menu terbuka dan tertutup dengan efek geser.
6. Buka Console browser (**F12**) dan pastikan tidak ada error.

<!--
## Dokumentasi (Screenshot)

Aktifkan bagian ini setelah screenshot terbaru diambil (hapus tanda komentar di atas
dan di bawah), lalu pastikan nama file sesuai isi folder dokumentasi/.

### Pesan error validasi
![Validasi Tambah Buku](dokumentasi/validasi-tambahbuku.png)

### Pencarian dan counter
![Pencarian Daftar Buku](dokumentasi/cari-listbuku.png)

### Konfirmasi hapus
![Konfirmasi Hapus](dokumentasi/konfirmasi-hapus.png)

### Menu hamburger (tampilan mobile)
![Hamburger](dokumentasi/hamburger.png)
-->

## Kesimpulan

Dengan JavaScript, halaman yang sebelumnya statis menjadi interaktif: pengguna mendapat umpan balik langsung saat mengisi form, dapat mencari data tanpa memuat ulang halaman, dan diminta konfirmasi sebelum menghapus. Pola yang dipakai, yaitu memilih elemen lewat id atau class, memasang event listener, lalu mengubah DOM, akan dipakai kembali pada jobsheet berikutnya ketika data diambil dari server.