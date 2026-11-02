# Jobsheet 11 — Keamanan Web Dasar (SIMINVENT-Mini)

## Identitas

| | |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Tujuan

Menerapkan prinsip keamanan web dasar pada SIMINVENT-Mini: mencegah XSS, CSRF, dan session fixation, serta mengaudit ulang kemungkinan SQL Injection.

## Perubahan dari Jobsheet 10

| Berkas | Perubahan |
|---|---|
| `includes/csrf.php` | Fungsi `csrf_token()`, `csrf_field()`, dan `csrf_verify()` untuk token CSRF per-session |
| `includes/header.php` | Memuat `csrf.php` (`require_once`) |
| `auth/login.php`, `auth/register.php` | Form ditambah `csrf_field()` |
| `barang/tambah.php`, `barang/edit.php`, `peminjam/tambah.php`, `peminjam/edit.php` | Form ditambah `csrf_field()` |
| `barang/list.php`, `peminjam/list.php` | Tombol Hapus kini berada di dalam `<form class="form-hapus" method="post">` berisi `id` dan `csrf_field()` |
| `auth/proses_login.php`, `auth/proses_register.php` | Memanggil `csrf_verify()` sebelum memproses data |
| `barang/proses_tambah.php`, `proses_edit.php`, `proses_hapus.php` | Memanggil `csrf_verify()` setelah guard login dan pengecekan metode POST |
| `peminjam/proses_tambah.php`, `proses_edit.php`, `proses_hapus.php` | Sama seperti barang |
| `auth/proses_login.php` | `session_regenerate_id(true)` setelah login berhasil (mencegah session fixation) |
| `assets/js/app.js` | Konfirmasi hapus dipindah ke event `submit` pada `form.form-hapus` (form dibuat di HTML, bukan lewat JavaScript) |
| `docs/security-checklist.md` | Hasil audit keamanan beserta bukti sebelum dan sesudah |

## Ringkasan Perlindungan

| Kerentanan | Penanganan |
|---|---|
| XSS | Semua output data dibungkus `e()` (`htmlspecialchars`, `ENT_QUOTES`, UTF-8). Sudah diterapkan sejak Jobsheet 10 dan diaudit ulang. |
| CSRF | Token acak 64 karakter heksadesimal per-session, dikirim lewat input tersembunyi, dibandingkan dengan `hash_equals()`. Token salah atau kosong mendapat HTTP 403. |
| Session fixation | ID session diganti setelah `password_verify()` berhasil. |
| SQL Injection | Semua query memakai prepared statement PDO. Tidak ada perubahan kode. |

## Cara Kerja CSRF

1. Saat halaman dibuka, `csrf_field()` membuat token (bila belum ada), menyimpannya di `$_SESSION['csrf_token']`, dan menaruhnya di form.
2. Saat form dikirim, `csrf_verify()` membandingkan `$_POST['csrf_token']` dengan token di session.
3. Bila tidak cocok, proses dihentikan dengan HTTP 403 dan data tidak disentuh.
4. Tombol **Hapus** berada di dalam form POST yang memuat `csrf_field()`. JavaScript hanya menampilkan konfirmasi sebelum form dikirim.

Urutan di file proses: guard `auth.php` dulu, lalu `csrf_verify()`. Pengguna yang belum login langsung dialihkan ke Login.

## Struktur Folder

```
jobsheet-11/
├── index.php
├── auth/          login, register, proses_login, proses_register, logout
├── barang/        list, tambah, edit, proses_tambah, proses_edit, proses_hapus
├── peminjam/      list, tambah, edit, proses_tambah, proses_edit, proses_hapus
├── includes/      auth, csrf, header, footer, helpers, koneksi, judul_halaman
├── assets/        css, js, fonts, img
├── sql/           01_barang_peminjam.sql, 02_users.sql
├── docs/          wireframe.md, security-checklist.md
└── dokumentasi/   tangkapan layar
```

## Dokumentasi

Tambahkan tangkapan layar ke folder `dokumentasi/`, lalu tampilkan di sini.

![XSS tampil sebagai teks](dokumentasi/xss.png)

![POST tanpa token mendapat 403](dokumentasi/csrf403.png)

![Hapus barang tetap berfungsi](dokumentasi/hapus.png)

## Cara Menjalankan

1. Jalankan `sql/01_barang_peminjam.sql` dan `sql/02_users.sql` di database PostgreSQL (Supabase).
2. Atur environment variable `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`.
3. Jalankan `php -S localhost:8000` dari folder induk, lalu buka `http://localhost:8000/jobsheet-11/`.

## Cara Menguji

1. **XSS**: login, tambah barang dengan nama `<script>alert(1)</script>`. Di Daftar Barang harus tampil sebagai teks, tanpa pop-up.
2. **CSRF**: setelah login, kirim `curl -X POST http://localhost:8000/barang/proses_hapus.php -d "id=1"` (bawa cookie session). Harus mendapat HTTP 403.
3. **CSRF di login**: `curl -X POST http://localhost:8000/auth/proses_login.php -d "username=x&password=y"` harus mendapat HTTP 403.
4. **Urutan guard**: kirim POST ke `barang/proses_tambah.php` tanpa login. Harus dialihkan ke Login, bukan 403.
5. **Session fixation**: bandingkan cookie `PHPSESSID` di DevTools sebelum dan sesudah login. Nilainya harus berbeda.
6. **SQL Injection**: isi username `' OR '1'='1` di form Login. Login harus gagal.
7. **Regresi**: tambah, edit, dan hapus barang serta peminjam lewat tombol di aplikasi. Semuanya harus tetap berfungsi.

## Catatan

- Token CSRF berlaku selama session. Bila session habis lalu form lama dikirim, hasilnya 403. Muat ulang halaman form untuk mendapat token baru.
- Logout masih berupa tautan GET. Itu hanya mengakhiri sesi sendiri sehingga risikonya rendah, dan tidak diubah pada jobsheet ini.
- Pembatasan akses berdasarkan `role` belum diterapkan.

## Kesimpulan

Escape output dengan `e()` mencegah XSS, token CSRF memastikan permintaan POST berasal dari form aplikasi sendiri, dan regenerasi ID session menutup celah session fixation. Prepared statement sejak Jobsheet 8 sudah melindungi dari SQL Injection. Semua perlindungan ini murah diterapkan tetapi menutup serangan yang paling umum.
