# Jobsheet 10 — Autentikasi & Manajemen Sesi (SIMINVENT-Mini)

## Identitas

| | |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Tujuan

Menerapkan autentikasi dan manajemen sesi pengguna pada SIMINVENT-Mini: registrasi, login, logout, dan penguncian halaman yang hanya boleh diakses petugas.

## Perubahan dari Jobsheet 9

| Berkas | Perubahan |
|---|---|
| `sql/02_users.sql` | Tabel `users` (nama, username, password, role) |
| `auth/register.php`, `auth/proses_register.php` | Registrasi petugas, password disimpan dengan `password_hash()`, username duplikat dicek |
| `auth/login.php`, `auth/proses_login.php` | Login dengan `password_verify()`, data pengguna disimpan di `$_SESSION` |
| `auth/logout.php` | Menghapus sesi dengan `session_destroy()` |
| `includes/auth.php` | Penjaga halaman: tamu dialihkan ke halaman login |
| `includes/header.php` | Navbar menampilkan nama petugas dan Logout bila sudah login, atau Login bila belum |

## Skema Tabel `users`

```sql
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'petugas'
);
```

## Cara Kerja Penjaga Halaman

`includes/auth.php` dipanggil di baris pertama setiap halaman yang dikunci, sebelum `header.php`, sehingga `header('Location: ...')` masih bisa dijalankan sebelum ada output HTML.

```php
<?php
require_once __DIR__ . '/helpers.php';

if (!isset($_SESSION['user_id'])) {
    setFlash('error', 'Silakan login terlebih dahulu.');
    redirect('../auth/login.php');
}
```

| Status | Halaman |
|---|---|
| Dikunci (wajib login) | `barang/tambah`, `barang/edit`, `barang/proses_*`, seluruh halaman `peminjam/*` |
| Publik | `index.php` (Beranda) dan `barang/list.php` |

## Alur Login

1. Pengguna mengisi username dan password di `auth/login.php`.
2. `proses_login.php` mengambil data pengguna dengan prepared statement.
3. `password_verify()` mencocokkan password dengan hash di database.
4. Bila cocok, `user_id`, `nama`, dan `role` disimpan di `$_SESSION`, lalu diarahkan ke Beranda.
5. Bila tidak cocok, kembali ke login dengan pesan "Username atau password salah."

## Struktur Folder

```
jobsheet-10/
├── index.php
├── auth/          login, register, proses_login, proses_register, logout
├── barang/        list, tambah, edit, proses_tambah, proses_edit, proses_hapus
├── peminjam/      list, tambah, edit, proses_tambah, proses_edit, proses_hapus
├── includes/      auth, header, footer, helpers, koneksi, judul_halaman
├── assets/        css, js, fonts, img
├── sql/           01_barang_peminjam.sql, 02_users.sql
├── docs/          wireframe.md
└── dokumentasi/   tangkapan layar
```

## Dokumentasi

Tambahkan tangkapan layar ke folder `dokumentasi/`, lalu tampilkan di sini.

![Halaman Login](dokumentasi/login.png)

![Halaman Registrasi](dokumentasi/register.png)

![Navbar setelah login](dokumentasi/setelahlogin.png)

## Cara Menjalankan

1. Jalankan `sql/02_users.sql` di database PostgreSQL (Supabase).
2. Atur environment variable `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`.
3. Jalankan `php -S localhost:8000` dari folder induk, lalu buka `http://localhost:8000/jobsheet-10/`.

## Cara Menguji

1. Tanpa login, buka `peminjam/list.php` atau `barang/tambah.php`. Harus dialihkan ke halaman Login.
2. Daftar akun lewat Register, lalu login. Navbar menampilkan nama dan tombol Logout.
3. Buka lagi halaman yang tadi terkunci. Sekarang bisa diakses.
4. Klik Logout, lalu buka `barang/list.php`. Daftar barang tetap bisa dilihat tamu.
5. Di tabel `users`, kolom `password` berisi hash, bukan password asli.

## Catatan

Pembatasan akses berdasarkan `role` (misalnya hanya admin yang boleh menghapus) belum diterapkan pada jobsheet ini.

## Kesimpulan

Halaman yang mengubah data dilindungi sehingga hanya petugas yang sudah login yang bisa mengaksesnya. Password tidak pernah disimpan sebagai teks biasa, melainkan sebagai hash.
