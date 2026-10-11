# Jobsheet 9 — Pagination & Pencarian Server (SIMINVENT-Mini)

## Identitas

| | |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Tujuan

Melengkapi CRUD SIMINVENT-Mini dari Jobsheet 8 dengan **pagination** (`LIMIT` / `OFFSET`) dan **pencarian sisi server** (`ILIKE`) pada daftar barang dan daftar peminjam.

## Perubahan dari Jobsheet 8

| Berkas | Perubahan |
|---|---|
| `barang/list.php` | Hitung total data, ambil 5 data per halaman, cari nama barang lewat `ILIKE`, urut `id DESC` |
| `peminjam/list.php` | Sama seperti barang, pencarian berdasarkan nama peminjam |
| `includes/helpers.php` | Fungsi `tampilkanPaginasi()` untuk navigasi halaman |
| `assets/js/app.js` | Filter tabel sisi klien dihapus karena pencarian sekarang dikerjakan server |
| `assets/css/style.css` | Warna komponen pagination mengikuti tema indigo |

## Cara Kerja

1. Form pencarian memakai `method="get"` sehingga kata kunci dan nomor halaman ada di URL (`list.php?q=kursi&page=2`).
2. Server menghitung total data yang cocok dengan `SELECT COUNT(*)`.
3. `$totalPages = max(1, ceil($totalRows / $perPage))`, lalu `$page` dibatasi agar tidak melebihi halaman terakhir.
4. `$offset = ($page - 1) * $perPage`.
5. Data diambil dengan `LIMIT :limit OFFSET :offset`. Nilainya di-bind memakai `PDO::PARAM_INT`.

```php
$stmt = $pdo->prepare(
    'SELECT * FROM barang WHERE nama_barang ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset'
);
$stmt->bindValue('kw', '%' . $keyword . '%');
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
```

## Struktur Folder

```
jobsheet-09/
├── index.php
├── barang/        list, tambah, edit, proses_tambah, proses_edit, proses_hapus
├── peminjam/      list, tambah, edit, proses_tambah, proses_edit, proses_hapus
├── includes/      header, footer, helpers, koneksi, judul_halaman
├── assets/        css, js, fonts, img
├── sql/           01_barang_peminjam.sql
├── docs/          wireframe.md
└── dokumentasi/   tangkapan layar
```

## Dokumentasi

Tambahkan tangkapan layar ke folder `dokumentasi/`, lalu tampilkan di sini.

![Daftar Barang dengan Pagination](dokumentasi/listbarang.png)

![Hasil Pencarian Barang](dokumentasi/caribarang.png)

![Daftar Peminjam dengan Pagination](dokumentasi/listpeminjam.png)

## Cara Menjalankan

1. Jalankan `sql/01_barang_peminjam.sql` di database PostgreSQL (Supabase).
2. Atur environment variable `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`.
3. Jalankan `php -S localhost:8000` dari folder induk, lalu buka `http://localhost:8000/jobsheet-09/`.

## Cara Menguji

1. Tambahkan lebih dari 5 barang, pastikan nomor halaman muncul dan halaman 2 berisi sisanya.
2. Ketik kata kunci lalu klik **Cari**, pastikan URL menjadi `list.php?q=...` dan jumlah halaman mengikuti jumlah hasil.
3. Buka `list.php?page=99`, pastikan otomatis menampilkan halaman terakhir.
4. Cari kata yang tidak ada, pastikan muncul pesan data tidak ditemukan.
5. Edit dan hapus data, pastikan daftar ikut berubah.

## Kesimpulan

Pagination membatasi data yang tampil per halaman sehingga ringan saat data banyak. Pencarian sisi server mencari di seluruh data, bukan hanya baris yang sedang tampil di browser.
