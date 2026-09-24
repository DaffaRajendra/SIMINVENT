# Jobsheet 7 — PHP Dasar & Form Handling

Sub-CPMK: Mengimplementasikan dasar PHP dan pengolahan form.

## Identitas

| Data | Keterangan |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Tujuan

Memproses input form menggunakan PHP: mengambil data dari `$_POST`, memvalidasi di server, menyimpan sementara ke `$_SESSION`, lalu menampilkannya kembali di halaman daftar. Ini adalah titik peralihan dari front-end murni ke server-side. Belum tersambung database, sehingga `$_SESSION` menjadi jembatan menuju Jobsheet 8.

## Perubahan dari Jobsheet 6

- Semua halaman `.html` diubah menjadi `.php`.
- Navbar dan footer dipindahkan ke `includes/header.php` dan `includes/footer.php` agar tidak diulang di setiap halaman.
- Form Tambah Buku dan Tambah Anggota memakai `method="post"` dan `action="proses_tambah.php"`.
- Ditambahkan `buku/proses_tambah.php` dan `anggota/proses_tambah.php`: validasi server-side, simpan ke `$_SESSION`, lalu redirect ke `list.php`.
- `buku/list.php` dan `anggota/list.php` merender tabel dari `$_SESSION` dengan `foreach`.
- Ditambahkan flash message (sukses atau error) lewat `$_SESSION`.
- File `assets/js/buku.js`, `assets/js/anggota.js`, dan folder `data/` dari Jobsheet 6 **dihapus** karena rendering sekarang dilakukan di server.
- `assets/js/app.js`: helper render fetch (`buatBaris`, `tampilkanPesan`) dibuang. Hamburger, validasi client, pencarian, counter, dan konfirmasi hapus tetap dipakai.
- Footer diperbarui menjadi Jobsheet 7.

## Alur Data

```
tambah.php (form)  --POST-->  proses_tambah.php  --valid-->  $_SESSION['buku'][]  -->  redirect list.php
                                     |
                                     +--tidak valid-->  flash error + isian lama  -->  redirect tambah.php
```

Pola yang sama dipakai untuk entitas Anggota (tugas mandiri).

## Validasi Server-side

Validasi client (JavaScript, Jobsheet 5) bisa dilewati dengan menonaktifkan JavaScript atau mengirim request manual, sehingga validasi server wajib sebagai lapisan kedua. Server memeriksa ulang semua aturan:

| Form | Field | Aturan di server |
|---|---|---|
| Buku | Judul, Pengarang | Wajib diisi |
| Buku | Tahun terbit | Bilangan bulat, 1900 sampai tahun berjalan |
| Buku | ISBN | Wajib, hanya angka dan tanda hubung |
| Buku | Stok | Bilangan bulat, tidak boleh negatif |
| Buku | Kategori | Harus salah satu: fiksi, non-fiksi, referensi |
| Anggota | Nama, Alamat | Wajib diisi |
| Anggota | No. Anggota | Wajib dan belum pernah dipakai |
| Anggota | No. HP | 8-15 karakter (angka, +, -) |
| Anggota | Email | Format email valid (`FILTER_VALIDATE_EMAIL`) |

Jika ada yang tidak valid, semua pesan error ditampilkan sekaligus dan isian yang sudah diketik tidak hilang (*old input*).

## Struktur Folder

```
jobsheet-07/
├── README.md
├── index.php
├── includes/
│   ├── header.php        # session, hitung path relatif, navbar Bootstrap
│   ├── footer.php        # footer dan script
│   └── helpers.php       # e(), redirect(), flash message, old input, tanggal
├── buku/
│   ├── list.php
│   ├── tambah.php
│   └── proses_tambah.php
├── anggota/
│   ├── list.php
│   ├── tambah.php
│   └── proses_tambah.php
├── assets/
│   ├── css/style.css
│   └── js/app.js
└── docs/
    └── wireframe.md
```

## Catatan Implementasi

- **Path relatif otomatis.** `header.php` menghitung awalan path (`$base`) dari kedalaman folder halaman yang sedang dibuka: kosong di root, `../` untuk halaman di `buku/` dan `anggota/`. Proyek tetap berjalan benar walau diakses dari root server maupun dari subfolder. Cara ini juga memperbaiki beberapa link navbar pada versi HTML sebelumnya yang salah path.
- **Keamanan tampilan.** Semua data yang dicetak ke HTML dibungkus `htmlspecialchars` lewat fungsi `e()`, sehingga input seperti `<script>` tampil sebagai teks dan tidak dijalankan (mencegah XSS).
- **Flash message sekali tampil.** Pesan disimpan di `$_SESSION['flash']`, ditampilkan, lalu langsung dihapus sehingga tidak muncul lagi saat halaman dimuat ulang.
- **Akses langsung ke `proses_tambah.php`** lewat URL (GET) dialihkan kembali ke form.
- **Redirect setelah proses (pola PRG).** Setelah POST, server mengarahkan ke halaman lain agar submit ulang tidak terjadi saat halaman direfresh.
- Input **No. Anggota** dan **No. HP** memakai `type="text"` (sebelumnya `number`) karena keduanya bukan nilai hitung: bisa diawali angka nol dan formatnya tidak selalu angka murni.

## Cara Menjalankan

PHP tidak bisa dibuka dengan klik dua kali. Halaman harus dilayani oleh server yang menjalankan PHP.

**Opsi 1 — XAMPP:** salin folder `jobsheet-07` ke `htdocs`, jalankan Apache dari XAMPP Control Panel, lalu buka `http://localhost/jobsheet-07/index.php`.

**Opsi 2 — PHP built-in server** (jika PHP sudah terpasang), dijalankan dari dalam folder `jobsheet-07`:
```bash
php -S localhost:8000
```
lalu buka `http://localhost:8000/index.php`.

## Cara Menguji

1. Buka **Tambah Buku**, kirim form kosong: JavaScript menahan dan menampilkan pesan error di bawah field.
2. Isi form dengan benar lalu simpan: halaman pindah ke **List Buku**, muncul pesan sukses, dan buku tampil di tabel.
3. Coba **Tambah Anggota**, lalu daftarkan lagi dengan No. Anggota yang sama: muncul pesan "No. Anggota sudah terdaftar".
4. **Uji validasi server:** nonaktifkan JavaScript di browser (atau ubah `novalidate` dan hapus `required` lewat DevTools), lalu kirim form dengan tahun 1800 atau stok negatif. Server tetap menolak dan menampilkan pesan error.
5. Uji keamanan: isi judul dengan `<b>tes</b>`. Di tabel, teksnya tampil apa adanya dan tidak menjadi huruf tebal.
6. Buka Console (**F12**) dan pastikan tidak ada error, serta tidak ada notice atau warning PHP di layar.

## Kesimpulan

Dengan PHP, form yang sebelumnya hanya tampilan sekarang benar-benar memproses data: input diambil dari `$_POST`, divalidasi di server, disimpan ke session, dan ditampilkan kembali dengan pesan umpan balik. Validasi di server terbukti berjalan mandiri dari JavaScript, sehingga menjadi lapisan pengaman kedua. Pola form, proses, penyimpanan, lalu daftar ini akan dipakai kembali pada jobsheet berikutnya, dengan perubahan utama hanya pada tempat penyimpanan data, dari session menjadi database.
