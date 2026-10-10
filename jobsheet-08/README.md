# Jobsheet 8 — Database PostgreSQL & PDO (SIMINVENT-Mini)

Sub-CPMK: Menghubungkan aplikasi dengan basis data PostgreSQL.

## Identitas

| Data | Keterangan |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Tujuan

Mengganti penyimpanan sementara `$_SESSION` (Jobsheet 7) dengan basis data PostgreSQL sungguhan, sehingga data tetap tersimpan walau browser ditutup. Jobsheet ini mencakup perancangan skema tabel, koneksi PDO_PGSQL, dan query dasar memakai *prepared statement*. Proyek yang dikerjakan adalah **SIMINVENT-Mini** (sistem inventaris kampus) dengan entitas **Barang** dan **Peminjam**, sebagai pengganti entitas Buku dan Anggota pada modul.

## Perubahan dari Jobsheet 7

- Data tidak lagi disimpan di `$_SESSION`, melainkan di PostgreSQL (dihosting di Supabase).
- `includes/koneksi.php` dibuat: koneksi PDO ke PostgreSQL dengan mode error `ERRMODE_EXCEPTION`. Kredensial dibaca dari *environment variable*, tidak ditulis di dalam kode.
- `sql/01_barang_peminjam.sql` dibuat: skema tabel `barang` dan `peminjam`.
- `proses_tambah.php` (barang dan peminjam): `$_SESSION[...][] = ...` diganti `INSERT` lewat prepared statement.
- `list.php` (barang dan peminjam): `foreach ($_SESSION[...])` diganti `SELECT` dari database.
- Ditambahkan **Update** dan **Delete**: `edit.php`, `proses_edit.php`, dan `proses_hapus.php` untuk kedua entitas. Penghapusan hanya menerima `POST` dan didahului konfirmasi JavaScript.
- Error `UNIQUE` (kode barang atau NIM sudah dipakai) ditangani dengan `try`/`catch (PDOException)` dan ditampilkan sebagai pesan yang rapi, bukan error mentah.
- Pencarian sisi server di daftar barang memakai `ILIKE`.
- Kolom `dibuat_pada` (`TIMESTAMP DEFAULT NOW()`) ditampilkan di daftar barang.
- `migrasi_peminjam.php`: skrip sekali jalan untuk memindahkan data lama dari `jobsheet-06/data/anggota.json` ke tabel `peminjam`.
- Beranda menampilkan statistik yang dihitung dari database (total barang, total peminjam, total stok, barang rusak).
- Tampilan tabel dan form dirapikan (kartu, lencana status, tombol aksi), seluruh gaya dijadikan satu di `assets/css/style.css`.
- Aplikasi dideploy ke Vercel memakai `Dockerfile.vercel`.
- `$_SESSION` tetap dipakai, tetapi hanya untuk flash message dan isian lama (*old input*).

## Skema Database

Tabel `barang`:

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | `SERIAL` | Primary key |
| `kode_barang` | `VARCHAR(50)` | `UNIQUE`, `NOT NULL` |
| `nama_barang` | `VARCHAR(150)` | `NOT NULL` |
| `kategori` | `VARCHAR(20)` | `CHECK` salah satu: `perabotan`, `elektronik` |
| `lokasi` | `VARCHAR(100)` | `NOT NULL` |
| `stok` | `INTEGER` | `CHECK (stok >= 0)` |
| `kondisi` | `VARCHAR(20)` | `CHECK` salah satu: `baik`, `rusak` |
| `dibuat_pada` | `TIMESTAMP` | `DEFAULT NOW()` |

Tabel `peminjam`:

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | `SERIAL` | Primary key |
| `nim` | `VARCHAR(20)` | `UNIQUE`, `NOT NULL` (NIM atau NIP) |
| `nama` | `VARCHAR(150)` | `NOT NULL` |
| `status` | `VARCHAR(20)` | `CHECK` salah satu: `mahasiswa`, `dosen`, `petugas` |
| `prodi` | `VARCHAR(100)` | Prodi atau unit |
| `no_hp` | `VARCHAR(20)` | `NOT NULL` |
| `email` | `VARCHAR(150)` | `NOT NULL` |
| `tanggal_bergabung` | `TIMESTAMP` | `DEFAULT NOW()` |

Setiap tabel punya primary key `id` dan kunci bisnis yang unik (`kode_barang`, `nim`), sehingga tidak ada data ganda. Aturan nilai dijaga ganda: oleh `CHECK` di database dan oleh validasi di PHP. Pada versi ini kedua tabel berdiri sendiri (belum ada tabel `peminjaman` yang menghubungkan barang dengan peminjam).

## Validasi Server-side

Validasi JavaScript tetap ada, tetapi server memeriksa ulang semua aturan:

| Form | Field | Aturan di server |
|---|---|---|
| Barang | Kode Barang | Wajib, hanya huruf, angka, dan tanda hubung; harus unik |
| Barang | Nama Barang, Lokasi | Wajib diisi |
| Barang | Kategori | Harus salah satu: perabotan, elektronik |
| Barang | Stok | Bilangan bulat, tidak boleh negatif |
| Barang | Kondisi | Harus salah satu: baik, rusak |
| Peminjam | NIM / NIP | Wajib, hanya angka (8-20 digit); harus unik |
| Peminjam | Nama, Prodi / Unit | Wajib diisi |
| Peminjam | Status | Harus salah satu: mahasiswa, dosen, petugas |
| Peminjam | No. HP | 8-15 karakter (angka, +, -) |
| Peminjam | Email | Format email valid (`FILTER_VALIDATE_EMAIL`) |

Jika ada yang tidak valid, semua pesan error ditampilkan sekaligus dan isian yang sudah diketik tidak hilang.

## Struktur Folder

```
jobsheet-08/
├── README.md
├── index.php                 # Beranda dengan statistik dari database
├── migrasi_peminjam.php      # Migrasi data lama (JSON) ke tabel peminjam
├── Dockerfile.vercel         # Deploy ke Vercel (PHP + pdo_pgsql)
├── barang/
│   ├── list.php
│   ├── tambah.php
│   ├── proses_tambah.php
│   ├── edit.php
│   ├── proses_edit.php
│   └── proses_hapus.php
├── peminjam/
│   ├── list.php
│   ├── tambah.php
│   ├── proses_tambah.php
│   ├── edit.php
│   ├── proses_edit.php
│   └── proses_hapus.php
├── includes/
│   ├── header.php            # Navbar, path relatif otomatis
│   ├── footer.php
│   ├── helpers.php           # e(), redirect(), flash message, old input, anti-cache
│   └── koneksi.php           # Koneksi PDO ke PostgreSQL
├── assets/
│   ├── css/style.css
│   ├── js/app.js
│   └── img/
├── sql/
│   └── 01_barang_peminjam.sql
├── docs/
│   └── wireframe.md
└── dokumentasi/              # Tangkapan layar hasil
```

## Dokumentasi

Beranda:

![Beranda](dokumentasi/beranda.png)

Daftar Barang:

![Daftar Barang](dokumentasi/listbarang.png)

Tambah Barang:

![Tambah Barang](dokumentasi/tambahbarang.png)

Daftar Peminjam:

![Daftar Peminjam](dokumentasi/listpeminjam.png)

Tambah Peminjam:

![Tambah Peminjam](dokumentasi/tambahpeminjam.png) 


## Cara Menjalankan

Untuk versi online, hubungkan repository ke Vercel dengan preset `Container`, isi kelima environment variable di atas, lalu deploy.

## Cara Menguji

1. Buka **Tambah Barang**, kirim form kosong: JavaScript menahan dan menampilkan pesan error di bawah field.
2. Isi form dengan benar lalu simpan: halaman pindah ke **List Barang**, muncul pesan sukses, dan barang tampil di tabel.
3. **Uji persistensi:** tutup browser, buka lagi, atau buka di tab baru. Data harus tetap ada, dan baris juga terlihat di Table Editor database.
4. Tambahkan barang dengan **kode yang sama**: muncul pesan "Kode barang sudah dipakai", bukan error PHP. Lakukan hal yang sama untuk NIM yang sama di peminjam.
5. Klik **Edit**, ubah data, simpan: daftar berubah. Klik **Hapus**, pilih Batal (tidak ada yang terhapus), lalu OK (baris hilang dari daftar).
6. Ketik kata kunci di kolom pencarian daftar barang lalu tekan Enter: hanya barang yang cocok yang tampil, tanpa memandang huruf besar atau kecil.
7. Uji keamanan: isi nama barang dengan `<b>tes</b>`. Di tabel, teksnya tampil apa adanya dan tidak menjadi huruf tebal.
8. Buka Console (**F12**) dan pastikan tidak ada error, serta tidak ada notice atau warning PHP di layar.

## Kesimpulan

Dengan PostgreSQL dan PDO, data yang sebelumnya hilang saat session berakhir kini tersimpan permanen. Prepared statement mencegah SQL injection, `try`/`catch` membuat kegagalan query tertangani dengan rapi, dan batasan `UNIQUE` serta `CHECK` di database menjadi lapisan pengaman di samping validasi PHP. Alur form, proses, penyimpanan, lalu daftar tetap sama seperti Jobsheet 7, dengan perubahan utama pada tempat penyimpanan data. Pondasi ini dipakai pada jobsheet berikutnya untuk menyempurnakan CRUD dengan pagination dan pencarian sisi server.