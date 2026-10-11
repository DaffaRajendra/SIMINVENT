# Desain-Pemrograman-Web

# Jobsheet 03

Jobsheet ini berisi penerapan **Responsive Web Design (RWD)** pada sistem pengelolaan inventaris kampus (SIMINVENT-Mini), meliputi penggunaan meta viewport, media query, breakpoint, dan pendekatan desktop-first.

## Identitas

| Data | Keterangan |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

## Struktur Folder

```
jobsheet-03/
├── index.html          → halaman beranda
├── assets/
│   ├── css/style.css    → file utama styling (termasuk media query)
│   ├── fonts/           → font Poppins untuk angka statistik
│   └── img/             → logo dan favicon
├── barang/
│   ├── list.html        → tabel daftar barang
│   └── tambah.html      → form tambah barang
├── peminjam/
│   ├── list.html        → tabel daftar peminjam
│   └── tambah.html      → form tambah peminjam
├── README.md
└── dokumentasi/         → dokumentasi pendukung jobsheet
```

## Konsep yang Dipelajari

### 1. Responsive Web Design (RWD)
Pendekatan membangun halaman web agar tata letaknya menyesuaikan diri secara otomatis dengan lebar layar perangkat (HP, tablet, laptop, monitor besar) menggunakan satu file HTML/CSS yang sama, tanpa perlu membuat versi terpisah untuk tiap perangkat.

### 2. Pendekatan Desktop-First
Jobsheet ini memakai strategi **desktop-first**: gaya default untuk layar besar (grid empat kolom, navbar horizontal, dan seterusnya) ditulis lebih dulu, lalu ditimpa sebagian melalui blok `@media (max-width: ...)` di bagian **paling bawah** file `style.css` untuk menyesuaikan tampilan di layar sempit. Urutan ini penting karena pada spesifisitas selector yang sama, aturan yang ditulis paling akhir dalam file yang menang.

### 3. Breakpoint yang Dipakai

| Lebar layar | Perubahan |
|---|---|
| 1199px ke bawah | Menu dan tombol aksi disembunyikan, diganti tombol hamburger |
| 768px ke bawah | Kartu statistik jadi 2 kolom, Barang terbaru dan Aksi cepat ditumpuk, form jadi 1 kolom |
| 480px ke bawah | Kartu statistik jadi 1 kolom, judul hero diperkecil, tombol di header halaman selebar layar |

## Tata Letak dan Desain

| Elemen | Rancangan |
|---|---|
| Navbar | Putih, logo di kiri, menu Beranda, Barang, dan Peminjam di tengah, dua tombol aksi di kanan |
| Beranda | Header sambutan, empat kartu statistik, kartu Barang terbaru (3 data), dan kartu Aksi cepat |
| Halaman lain | Breadcrumb dan judul halaman di atas, isi di dalam kartu |
| Footer | Putih dengan garis di bagian atas |
| Warna utama | Indigo `#4f46e5` |
| Latar halaman | `#f5f6fc` |

## Status Pengerjaan

- Meta `viewport` sudah ditambahkan di setiap halaman HTML.
- Media query untuk breakpoint 1199px, 768px, dan 480px sudah diterapkan di `style.css` (total 580 baris CSS).
- Navbar berubah menjadi menu hamburger (checkbox hack) di bawah 1199px.
- Kartu statistik (CSS Grid) menyesuaikan jumlah kolom sesuai lebar layar.
- Tabel data dibungkus `.table-responsive` agar bisa di-scroll horizontal di layar sempit.
- Form menjadi satu kolom di layar sempit.

## Cara Menjalankan

Buka file `index.html` melalui browser, lalu coba ubah ukuran jendela browser (atau buka lewat DevTools mode responsive) untuk melihat perubahan tampilan di breakpoint tablet dan mobile.

## Dokumentasi

### Beranda
![Beranda](dokumentasi/beranda.png)

### Daftar Barang
![Daftar Barang](dokumentasi/daftarbarang.png)

### Tambah Barang
![Tambah Barang](dokumentasi/tambahbarang.png)

### Daftar Peminjam
![Daftar Peminjam](dokumentasi/daftarpeminjam.png)

### Tambah Peminjam
![Tambah Peminjam](dokumentasi/tambahpeminjam.png)

### Tampilan mobile
![Tampilan mobile](dokumentasi/mobile-beranda.png)

### Menu hamburger terbuka
![Menu hamburger terbuka](dokumentasi/hamburger.png)
