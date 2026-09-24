# Desain-Pemrograman-Web

# Jobsheet 03

Jobsheet ini berisi penerapan **Responsive Web Design (RWD)** pada sistem pengelolaan data buku dan anggota perpustakaan (SIMPUS-Mini), meliputi penggunaan meta viewport, media query, breakpoint, dan pendekatan desktop-first.

## Identitas

| Data | Keterangan |
|---|---|
| Nama | Daffa Rajendra Maulana |
| NIM | 254107020181 |
| Mata Kuliah | Desain Pemograman Web |
| Kelas | TI - 2D |

# Dokumentasi Jobsheet 3 (Versi Bootstrap)

Dokumentasi ini adalah **versi alternatif** dari
[dokumentasi jobsheet-03](../../jobsheet-03/Dokumentasi/README.md) yang
memakai CSS murni (hand-written CSS). Fungsionalitas dan halamannya
**identik** — Beranda, Daftar Buku, Tambah Buku, Daftar Anggota, Tambah
Anggota — tapi seluruh tata letak dan komponen visualnya dibangun ulang
memakai **framework CSS Bootstrap 5**, bukan CSS custom dari nol.

Kalau kamu belum paham konsep responsive design dasar (viewport, media
query, breakpoint), baca dulu
[bab 1 dokumentasi jobsheet-03 asli](../../jobsheet-03/Dokumentasi/01-konsep-dasar-responsive.md)
karena dokumentasi ini akan sering membandingkan "cara CSS murni" vs
"cara Bootstrap" untuk menyelesaikan masalah yang sama.

## Kenapa Ada Dua Versi?

Tujuannya supaya kamu bisa membandingkan langsung **dua pendekatan** untuk
mencapai hasil visual yang mirip:

| | Jobsheet 3 (CSS Murni) | Jobsheet 3 (Bootstrap) |
|---|---|---|
| Layout | `display: flex`, `display: grid` ditulis manual | `.row` / `.col-*` (grid 12 kolom Bootstrap) |
| Navbar & hamburger | Checkbox hack (`:checked` + sibling combinator `~`) | Komponen `.navbar` bawaan + sedikit JavaScript Bootstrap |
| Kartu | `<section>` + CSS custom (`border-radius`, `box-shadow` manual) | Komponen `.card` bawaan |
| Tabel | `<table>` + CSS custom (`nth-child`, `:hover`) | Class utility `.table`, `.table-striped`, `.table-hover` |
| Form | `<input>`/`<select>` + CSS custom | Class utility `.form-control`, `.form-select`, `.form-label` |
| Breakpoint | Ditulis sendiri (`768px`, `480px`) | Bawaan Bootstrap (`sm`, `md`, `lg`, `xl`, `xxl`) |
| Total baris CSS custom | ~245 baris (`style.css`) | ~15 baris (`style.css`) |

Intinya: **hasil akhirnya bisa mirip, tapi cara mencapainya sangat
berbeda.** CSS murni memberi kontrol penuh tapi butuh menulis semua
aturan sendiri; Bootstrap memberi banyak komponen & utility class siap
pakai, dengan konsekuensi harus memuat file CSS/JS tambahan dan mengikuti
konvensi nama class-nya.

## Daftar Isi

1. [Konsep Dasar Bootstrap](01-konsep-dasar-bootstrap.md)
2. [Apa yang Berubah di File HTML?](02-perubahan-file-html.md)
3. [Navbar Responsif ala Bootstrap](03-navbar-responsive-bootstrap.md)
4. [Grid System & Komponen Card](04-grid-dan-card.md)
5. [Tabel & Form dengan Utility Class Bootstrap](05-tabel-dan-form-bootstrap.md)
6. [Rangkuman & Perbandingan dengan CSS Murni](06-rangkuman-dan-perbandingan.md)

## Struktur Folder

```
jobsheet-03-bootstrap/
├── index.html              # Beranda
├── assets/
│   └── css/
│       └── style.css       # Override kecil di atas Bootstrap (~15 baris)
├── buku/
│   ├── list.html
│   └── tambah.html
├── anggota/
│   ├── list.html
│   └── tambah.html
└── Dokumentasi/             # Folder dokumentasi ini
```

## Konsep yang Dipelajari

### 1. Responsive Web Design (RWD) dengan Framework
Pendekatan membangun halaman web agar tata letaknya menyesuaikan diri secara otomatis dengan lebar layar perangkat (HP, tablet, laptop, monitor besar) menggunakan satu file HTML yang sama. Pada jobsheet ini, penyesuaian tersebut tidak ditulis manual lewat CSS, melainkan memanfaatkan framework **Bootstrap 5** yang sudah menyediakan sistem grid dan komponen siap pakai.

### 2. Pendekatan Mobile-First Bootstrap
Berbeda dengan pendekatan desktop-first (menulis gaya besar dulu, lalu ditimpa media query untuk layar kecil), Bootstrap menganut strategi **mobile-first**: gaya default suatu elemen berlaku untuk layar kecil, lalu ditambahkan class breakpoint (`md-`, `lg-`, `xl-`) untuk mengubah tampilan saat layar melebar. Contohnya class `col-12 col-md-3` — secara default elemen mengambil 12 kolom (penuh) di layar kecil, lalu berubah menjadi 3 kolom saat lebar layar mencapai breakpoint `md` (≥768px) ke atas.

### 3. Grid System Bootstrap
Bootstrap membagi lebar halaman menjadi 12 kolom virtual melalui kombinasi class `container`, `row`, dan `col-*`. Jumlah kolom yang diambil suatu elemen (misalnya `col-md-3` berarti 3 dari 12 kolom, atau seperempat lebar layar) menentukan berapa banyak elemen sejenis yang muat sejajar dalam satu baris pada breakpoint tersebut.

### 4. Breakpoint
Bootstrap menyediakan beberapa titik lebar layar standar (breakpoint) yang otomatis mengubah perilaku class grid dan utility, yaitu `sm` (≥576px), `md` (≥768px), `lg` (≥992px), `xl` (≥1200px), dan `xxl` (≥1400px). Class yang tidak diberi akhiran breakpoint (misal `col-12`) berlaku untuk semua ukuran layar sebagai nilai dasar.

### 5. Utility Classes
Bootstrap menyediakan class-class kecil siap pakai untuk mengatur spacing, warna, tipografi, dan tata letak tanpa perlu menulis CSS kustom, misalnya `mb-3` (margin bawah), `p-3` (padding), `text-center` (rata tengah), `fw-bold` (tebal), dan `shadow-sm` (bayangan tipis). Pendekatan ini mengurangi kebutuhan menulis selector CSS manual untuk styling yang bersifat umum.

### 6. Navbar Responsif (Collapse Component)
Komponen `navbar` dari Bootstrap secara otomatis berubah dari tampilan horizontal (di layar besar) menjadi menu hamburger yang dapat dibuka-tutup (di layar kecil) melalui atribut `data-bs-toggle="collapse"` dan `data-bs-target`, tanpa perlu menulis JavaScript sendiri — cukup memuat file `bootstrap.bundle.min.js`.

### 7. Komponen Siap Pakai (Card, Form Control)
Bootstrap menyediakan komponen visual siap pakai seperti `card` untuk mengelompokkan konten dalam kotak dengan bayangan dan padding konsisten, serta class form seperti `form-control`, `form-label`, `form-select`, dan `btn btn-primary` yang membuat elemen form (input, label, select, tombol) memiliki tampilan seragam tanpa perlu styling manual satu per satu.


## Cara Menjalankan

Buka file `index.html` melalui browser, lalu coba ubah ukuran jendela browser (atau buka lewat DevTools mode responsive) untuk melihat perubahan tampilan di breakpoint tablet dan mobile.