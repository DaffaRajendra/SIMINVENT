# Checklist Keamanan — Jobsheet 11

Audit terhadap kode Jobsheet 8-10 SIMINVENT-Mini (`barang/`, `peminjam/`, `auth/`, `includes/`), dengan bukti sebelum dan sesudah.

| # | Kerentanan | Ditemukan di | Sebelum | Sesudah (perbaikan) |
|---|---|---|---|---|
| 1 | SQL Injection | Semua query di `barang/`, `peminjam/`, `auth/` | Sejak Jobsheet 8 sudah memakai prepared statement PDO (`:parameter`, `bindValue`) | **Diaudit ulang, sudah aman.** Tidak ada query yang menyisipkan `$_POST` atau `$_GET` langsung ke string SQL. Diuji `' OR '1'='1` di form Login, tidak berhasil. |
| 2 | XSS (Cross-Site Scripting) | `barang/list.php`, `barang/edit.php`, `peminjam/list.php`, `peminjam/edit.php`, `includes/header.php` (nama petugas), `includes/judul_halaman.php`, pesan flash | Data dari database dan input pengguna dicetak ke HTML | **Diaudit ulang, sudah aman.** Semua output dibungkus `e()` (`includes/helpers.php`, `htmlspecialchars` dengan `ENT_QUOTES` dan UTF-8). Diuji nama barang `<script>alert(1)</script>` tampil sebagai teks. |
| 3 | CSRF (Cross-Site Request Forgery) | Form Tambah, Edit, Hapus Barang dan Peminjam, Login, Register | Form POST tidak punya token verifikasi, sehingga bisa dipicu dari situs lain | Ditambah `includes/csrf.php`. `csrf_field()` dipasang di 6 form dan di form Hapus pada `barang/list.php` dan `peminjam/list.php`, dan `csrf_verify()` dipanggil di 8 file `proses_*`. Token disimpan di `$_SESSION['csrf_token']` dan dibandingkan dengan `hash_equals()`. |
| 4 | Validasi dan sanitasi input | `proses_tambah.php`, `proses_edit.php`, `proses_hapus.php` | Sudah ada validasi wajib-isi dan tipe, `id` divalidasi `filter_var(..., FILTER_VALIDATE_INT)` | **Diaudit ulang, dipertahankan.** Hidden input `id` di form Edit sudah di-cast `(int)`. |
| 5 | Session fixation | `auth/proses_login.php` | ID session tidak diperbarui setelah login | `session_regenerate_id(true)` dipanggil tepat setelah `password_verify()` berhasil. |

## Catatan Implementasi

- Guard `includes/auth.php` selalu dijalankan **sebelum** `csrf_verify()` di file proses, sehingga pengguna yang belum login langsung dialihkan ke Login.
- `csrf_verify()` menghentikan eksekusi dengan HTTP 403 bila token kosong atau tidak cocok, sebelum query apa pun dijalankan.
- Di `proses_login.php` dan `proses_register.php` tidak ada guard login, jadi `csrf_verify()` dipanggil langsung setelah `require`.

## Hasil Uji

| Uji | Hasil yang diharapkan | Hasil |
|---|---|---|
| POST `proses_login.php` tanpa token | HTTP 403 | Lolos |
| POST `proses_login.php` dengan token salah | HTTP 403 | Lolos |
| Login dengan token benar | HTTP 302 ke beranda | Lolos |
| `PHPSESSID` sebelum dan sesudah login | Berbeda | Lolos |
| POST `proses_hapus.php` tanpa token (sudah login) | HTTP 403 | Lolos |
| POST `proses_tambah.php` tanpa login | Redirect ke Login | Lolos |
