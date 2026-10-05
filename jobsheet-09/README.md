# SIMINVENT-Mini (versi PHP)

Aplikasi ini adalah hasil penggabungan:
- **Kerangka/struktur**: dari `jobsheet-08` (PHP, `includes/header.php` + `footer.php`, penyimpanan sementara di `$_SESSION`, pola Post/Redirect/Get, validasi server-side & client-side).
- **Isi konten**: dari `SIMINVENT-Mini` (teks, label, warna/tema, field form, dan menu Barang & Peminjam, menggantikan Buku & Anggota).

## Struktur Folder

```
SIMINVENT-Mini/
├── index.php                  # Beranda
├── barang/
│   ├── list.php                # Daftar Barang
│   ├── tambah.php               # Form Tambah Barang
│   └── proses_tambah.php        # Proses simpan + validasi server-side
├── peminjam/
│   ├── list.php                # Daftar Peminjam
│   ├── tambah.php               # Form Tambah Peminjam
│   └── proses_tambah.php        # Proses simpan + validasi server-side
├── includes/
│   ├── header.php               # Navbar SIMINVENT-Mini
│   ├── footer.php
│   ├── helpers.php              # e(), old(), flash message, redirect(), dll.
│   └── koneksi.php              # Koneksi PDO ke PostgreSQL (isi kredensial contoh, WAJIB diganti)
├── assets/
│   ├── css/style.css            # Tema SIMINVENT (navbar biru tua, stat card, dll.)
│   ├── js/app.js                # Hamburger menu, filter tabel, konfirmasi hapus, validasi form
│   └── img/logo.png, favicon.ico
├── sql/01_barang_peminjam.sql   # Skema tabel barang & peminjam (PostgreSQL)
└── docs/wireframe.md
```

## Cara Menjalankan

Butuh PHP (disarankan XAMPP/Laragon di Windows, atau `php -S` di Mac/Linux):

```bash
php -S localhost:8000
```

Lalu buka `http://localhost:8000/`.

## Catatan Penting

1. **Data belum permanen.** Saat ini "Tambah Barang" dan "Tambah Peminjam" menyimpan data ke `$_SESSION` (mengikuti pola persis jobsheet-08), bukan ke database. Data akan hilang saat session berakhir. `includes/koneksi.php` dan `sql/01_barang_peminjam.sql` sudah disiapkan sebagai langkah lanjutan jika kamu ingin menyambungkan ke PostgreSQL sungguhan (ganti query `$_SESSION[...][] = [...]` dengan `INSERT` via `$pdo`).
2. **Kredensial database.** `includes/koneksi.php` di sini hanya berisi *placeholder*, bukan kredensial asli. Isi sendiri sesuai database kamu sebelum dipakai, dan jangan pernah upload file berisi password asli ke repository publik / hosting.
