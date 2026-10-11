# Wireframe & User Flow — SIMINVENT-Mini

**Jobsheet 4 — Merancang UI/UX Aplikasi (Proyek)**

Dokumen ini adalah rancangan untuk fitur yang **belum dibangun**: Login, Registrasi Petugas, Dashboard Petugas, Peminjaman, Pengembalian, dan Riwayat Peminjaman. Rancangan ini menjadi acuan struktur HTML yang akan dibuat mulai Jobsheet 5. Halaman yang sudah ada (Beranda, Daftar dan Tambah Barang, Daftar dan Tambah Peminjam) tidak diubah.

---

## 1. Aktor dan Hak Akses

| Aktor | Peran |
|---|---|
| **Tamu** | Pengunjung tanpa login. Hanya melihat daftar barang. |
| **Petugas** | Sudah login. Mengelola barang, peminjam, dan transaksi peminjaman atau pengembalian. |

| Halaman | Tamu | Petugas |
|---|:---:|:---:|
| Beranda | ✔ | ✔ |
| Daftar Barang | ✔ | ✔ |
| Login / Registrasi | ✔ | – |
| Dashboard Petugas | ✘ | ✔ |
| Tambah/Edit/Hapus Barang | ✘ | ✔ |
| Daftar/Tambah Peminjam | ✘ | ✔ |
| Peminjaman, Pengembalian, Riwayat | ✘ | ✔ |

Tamu yang mencoba membuka halaman khusus Petugas diarahkan ke halaman Login.

---

## 2. Navigasi (Navbar)

Semua halaman sudah memakai satu pola navbar: logo di kiri, menu di tengah, dan tombol aksi di kanan. Untuk Tamu tombol aksi diganti **Login**, untuk Petugas menu bertambah **Peminjaman** dan **Pengembalian**, dan nama Petugas dengan **Logout** ditampilkan di kanan.

**Tamu:**

```
+-------------------------------------------------------------------+
| SIMINVENT-Mini        Beranda | Barang | Peminjam         [Login] |
+-------------------------------------------------------------------+
```

**Petugas:**

```
+------------------------------------------------------------------------------------------------+
| SIMINVENT-Mini  Beranda | Barang | Peminjam | Peminjaman | Pengembalian | Siti (Logout)        |
+------------------------------------------------------------------------------------------------+
```

**Tampilan mobile (di bawah 1200px):** menu disembunyikan dan dibuka lewat tombol hamburger, sama seperti navbar yang sudah dibuat di Jobsheet 3.

```
+---------------------------------------+
| SIMINVENT-Mini                    [=] |
+---------------------------------------+
```

---

## 3. User Flow

Keterangan simbol: `[ ]` = langkah/halaman, `< >` = keputusan, `-->` = alur.

### 3.1 Petugas Meminjamkan Barang ke Peminjam

```
[Buka halaman Login]
        |
        v
[Isi username & password] --> < Data benar? >
                                   |            |
                                  Ya          Tidak
                                   |            |
                                   |            v
                                   |   [Pesan "Username atau password salah"]
                                   |            |
                                   |            +--> kembali ke [Login]
                                   v
                           [Dashboard Petugas]
                                   |
                                   v
                    [Klik "+ Peminjaman Baru"]
                                   |
                                   v
                          [Pilih peminjam]
                                   |
                                   v
                   < Peminjam punya tunggakan? >
                          |                 |
                         Ya               Tidak
                          |                 |
                          v                 v
       [Peringatan: "Peminjam masih       [Pilih barang]
        punya barang belum kembali"]          |
        [Peminjaman ditolak]                  v
                          |         < Stok > 0 dan kondisi baik? >
                          v                |         |
                    [Dashboard]          Ya       Tidak
                                          |         |
                                          |         v
                                          |  [Pesan "Stok habis" / "Barang rusak"]
                                          |         |
                                          |         +--> kembali ke [Pilih barang]
                                          v
                                      [Klik Simpan]
                                          |
                                          v
                        [Stok barang dikurangi 1 & transaksi dicatat]
                                          |
                                          v
                          [Pesan sukses] --> [Dashboard]
```

### 3.2 Petugas Menerima Pengembalian Barang

```
[Dashboard]
     |
     v
[Klik "+ Pengembalian"]
     |
     v
[Cari transaksi: nama peminjam / nama barang]
     |
     v
< Transaksi aktif ditemukan? >
       |              |
      Ya            Tidak
       |              |
       |              v
       |     [Pesan "Transaksi tidak ditemukan"]
       |              |
       |              +--> kembali ke [Cari transaksi]
       v
[Pilih transaksi, klik "Kembalikan"]
     |
     v
< Melewati jatuh tempo? >
       |              |
      Ya            Tidak
       |              |
       v              |
[Tandai status        |
 "Terlambat"]         |
       |              |
       +------+-------+
              |
              v
[Stok barang ditambah 1 & tanggal kembali dicatat]
              |
              v
   [Pesan sukses] --> [Dashboard]
```

### 3.3 Daftar Edge Case

| # | Situasi | Perilaku sistem |
|---|---|---|
| 1 | Stok barang = 0 | Barang tampil non-aktif di dropdown dengan label "(Stok habis)". Tidak bisa dipilih. |
| 2 | Barang berkondisi rusak | Barang tampil non-aktif di dropdown dengan label "(Rusak)". Tidak bisa dipilih. |
| 3 | Peminjam punya tunggakan | Peminjaman ditolak dengan pesan yang menyebut barang yang belum dikembalikan. |
| 4 | Login gagal | Pesan error umum, tanpa menyebut mana yang salah (username atau password). |
| 5 | Tamu membuka halaman Petugas | Diarahkan ke Login. |
| 6 | Transaksi sudah dikembalikan | Tidak muncul di pencarian pengembalian, jadi stok tidak bertambah dua kali. |
| 7 | Pengembalian melewati jatuh tempo | Status "Terlambat" dicatat. |
| 8 | Tidak ada data (barang/transaksi kosong) | Tampilkan teks "Belum ada data", bukan tabel kosong. |

> Aturan jatuh tempo (misalnya 7 hari) belum ditetapkan di jobsheet. Angkanya bisa disesuaikan dengan ketentuan kelas.

---

## 4. Wireframe

Contoh isi data memakai data yang sudah ada di halaman Daftar Barang dan Daftar Peminjam.

### 4.1 Login

```
+-------------------------------------------------------------------+
| SIMINVENT-Mini        Beranda | Barang | Peminjam         [Login] |
|-------------------------------------------------------------------|
|                                                                   |
|            +----------------------------+                         |
|            |       Login Petugas        |                         |
|            |----------------------------|                         |
|            |  Username                  |                         |
|            |  [______________________]  |                         |
|            |  Password                  |                         |
|            |  [______________________]  |                         |
|            |                            |                         |
|            |  ! Pesan error (jika ada)  |                         |
|            |                            |                         |
|            |  [        Masuk        ]   |                         |
|            |                            |                         |
|            |  Belum punya akun?         |                         |
|            |  Daftar di sini            |                         |
|            +----------------------------+                         |
|                                                                   |
|-------------------------------------------------------------------|
| (c) 2026 SIMINVENT-Mini                                           |
+-------------------------------------------------------------------+
```

### 4.2 Registrasi Petugas

```
+-------------------------------------------------------------------+
| SIMINVENT-Mini        Beranda | Barang | Peminjam         [Login] |
|-------------------------------------------------------------------|
|                                                                   |
|            +----------------------------+                         |
|            |     Registrasi Petugas     |                         |
|            |----------------------------|                         |
|            |  Nama Lengkap              |                         |
|            |  [______________________]  |                         |
|            |  Username                  |                         |
|            |  [______________________]  |                         |
|            |  Password                  |                         |
|            |  [______________________]  |                         |
|            |  Konfirmasi Password       |                         |
|            |  [______________________]  |                         |
|            |                            |                         |
|            |  [       Daftar        ]   |                         |
|            |                            |                         |
|            |  Sudah punya akun?         |                         |
|            |  Login di sini             |                         |
|            +----------------------------+                         |
|                                                                   |
+-------------------------------------------------------------------+
```

### 4.3 Dashboard Petugas

```
+-----------------------------------------------------------------------------------------+
| SIMINVENT-Mini  Beranda | Barang | Peminjam | Peminjaman | Pengembalian | Siti (Logout) |
|-----------------------------------------------------------------------------------------|
| Dashboard Petugas                                                                       |
|                                                                                         |
| +----------------+   +----------------+   +----------------+                            |
| |  Total Barang  |   | Total Peminjam |   |Sedang Dipinjam |                            |
| |       8        |   |       5        |   |       3        |                            |
| +----------------+   +----------------+   +----------------+                            |
|                                                                                         |
| Aksi Cepat                                                                              |
| [ + Peminjaman Baru ]   [ + Pengembalian ]   [ + Tambah Barang ]                        |
|                                                                                         |
| Transaksi Terbaru                                                                       |
| +---------------------------------------------------------------+                       |
| | Peminjam       | Barang            | Tgl Pinjam | Status      |                       |
| |----------------|-------------------|------------|-------------|                       |
| | Aulia Rahma    | Proyektor Epson   | 15/07/2026 | Dipinjam    |                       |
| | Bagas Prasetyo | Laptop Asus       | 01/07/2026 | Dikembalikan|                       |
| +---------------------------------------------------------------+                       |
+-----------------------------------------------------------------------------------------+
```

Tiga kartu statistik memakai pola yang sama dengan halaman Beranda (kartu dengan ikon, angka, dan label). Di layar kecil, kartu ditumpuk menjadi 1 kolom.

### 4.4 Form Peminjaman

```
+----------------------------------------------------------------------------------+
| (navbar Petugas)                                                                 |
|----------------------------------------------------------------------------------|
| Peminjaman Barang Baru                                                           |
|                                                                                  |
| Peminjam                                                                         |
| [ 254107020101 - Aulia Rahma         v ]                                         |
|                                                                                  |
| ! Peminjam ini punya barang yang belum dikembalikan.   <- hanya jika tunggakan   |
|   Peminjaman tidak dapat dilanjutkan.                                            |
|                                                                                  |
| Barang                                                                           |
| [ Laptop Asus Vivobook (stok 12)     v ]                                         |
|   Kursi Lipat (stok 40)                                                          |
|   Proyektor Epson (Rusak)          <- abu, tidak bisa dipilih                    |
|   Lemari Arsip (Rusak)             <- abu, tidak bisa dipilih                    |
|                                                                                  |
| Tanggal Pinjam                                                                   |
| [ 20/09/2026 ]  (otomatis hari ini)                                              |
|                                                                                  |
| [ Simpan Peminjaman ]    [ Batal ]                                               |
+----------------------------------------------------------------------------------+
```

### 4.5 Form Pengembalian

```
+----------------------------------------------------------------------------------+
| (navbar Petugas)                                                                 |
|----------------------------------------------------------------------------------|
| Pengembalian Barang                                                              |
|                                                                                  |
| Cari transaksi aktif                                                             |
| [ nama peminjam / nama barang ________ ] [ Cari ]                                |
|                                                                                  |
| +-----------------------------------------------------------------+              |
| | Peminjam       | Barang          | Tgl Pinjam | Aksi             |             |
| |----------------|-----------------|------------|------------------|             |
| | Aulia Rahma    | Proyektor Epson | 15/07/2026 | [Kembalikan]     |             |
| | Dimas Anggara  | Kabel HDMI      | 03/07/2026 | [Kembalikan]     |             |
| |                |  (Terlambat)    |            |                  |             |
| +-----------------------------------------------------------------+              |
|                                                                                  |
| Belum ada transaksi aktif.          <- tampil jika hasil kosong                  |
+----------------------------------------------------------------------------------+
```

### 4.6 Riwayat Peminjaman per Peminjam

```
+----------------------------------------------------------------------------------+
| (navbar Petugas)                                                                 |
|----------------------------------------------------------------------------------|
| Riwayat Peminjaman - 254107020101 Aulia Rahma                                    |
| [ < Kembali ke Daftar Peminjam ]                                                 |
|                                                                                  |
| +----------------------------------------------------------+                     |
| | Barang               | Pinjam     | Kembali    | Status   |                    |
| |----------------------|------------|------------|----------|                    |
| | Laptop Asus Vivobook | 01/07/2026 | 10/07/2026 | Selesai  |                    |
| | Proyektor Epson      | 15/07/2026 | -          | Dipinjam |                    |
| +----------------------------------------------------------+                     |
+----------------------------------------------------------------------------------+
```

Halaman ini dibuka dari tombol "Riwayat" yang ditambahkan di kolom Aksi pada Daftar Peminjam (di samping Edit dan Hapus).

---

## 5. Keselarasan dengan Halaman yang Sudah Ada

### 5.1 Halaman existing dan perubahannya

| Halaman | Perubahan pada rancangan |
|---|---|
| `index.html` (Beranda) | Kartu ringkasan dipakai ulang di Dashboard. Navbar sudah seragam. |
| `barang/list.html` | Tombol "+ Tambah Barang" sudah berada di header halaman. Kolom Stok tetap. |
| `barang/tambah.html` | Tidak berubah. |
| `peminjam/list.html` | Ditambah tombol "Riwayat" di kolom Aksi. |
| `peminjam/tambah.html` | Tidak berubah. |

### 5.2 Halaman baru yang direncanakan

| Halaman | Perkiraan lokasi file |
|---|---|
| Login | `auth/login` |
| Registrasi Petugas | `auth/register` |
| Dashboard Petugas | `index` (tampilan berbeda untuk Tamu dan Petugas) |
| Form Peminjaman | `peminjaman/tambah` |
| Form Pengembalian | `peminjaman/kembali` |
| Riwayat per peminjam | `peminjaman/riwayat` |

---

## 6. Style Guide (dari `assets/css/style.css`)

Mockup dan halaman baru memakai gaya yang sama dengan halaman yang sudah berjalan.

| Elemen | Nilai |
|---|---|
| Font | Segoe UI, Arial, sans-serif |
| Font angka statistik | Poppins 600 |
| Warna utama (tombol utama, menu aktif, link) | `#4f46e5` |
| Warna utama saat hover | `#4338ca` |
| Warna utama muda (badge, menu aktif di mobile) | `#e8e7fc` |
| Latar halaman | `#f5f6fc` |
| Latar navbar, kartu, dan footer | `#ffffff` |
| Teks utama | `#1b1e3d` |
| Teks sekunder (label kartu) | `#666b8f` |
| Garis dan tepi kartu | `#e4e6f4` |
| Tombol Hapus dan pesan error | `#dc3545` |
| Pesan sukses dan badge Baik | Hijau Bootstrap `#198754` |
| Lebar maksimum konten | 1140px |
| Radius kartu | 1rem |
| Breakpoint responsif | 1200px (navbar), 768px, dan 480px |
