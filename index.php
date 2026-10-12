<?php
$jobsheet = [
    ['01', 'Jobsheet 01', 'Pengenalan struktur dasar dokumen HTML, pengelolaan direktori kerja, serta elemen teks dasar web.', 'Modul 1', 'jobsheet-01/index.html'],
    ['02', 'Jobsheet 02', 'Implementasi CSS (Cascading Style Sheets), styling elemen komponen, selektor, dan layout visual.', 'Modul 2', 'jobsheet-02/index.html'],
    ['03', 'Jobsheet 03', 'Pengembangan tata letak tingkat lanjut menggunakan teknik modern dan struktur dokumen kompleks.', 'Modul 3', 'jobsheet-03/index.html'],
    ['03b', 'Jobsheet 03 (Bootstrap)', 'Eksplorasi framework CSS Bootstrap untuk mempercepat pembuatan antarmuka responsif.', 'Framework', 'jobsheet-03_bootstrap/index.html'],
    ['04', 'Jobsheet 04', 'Penerapan form interaktif, validasi input, serta elemen kontrol form HTML lanjutan.', 'Modul 4', 'jobsheet-04/index.html'],
    ['05', 'Jobsheet 05', 'Pengenalan logika pemrograman web sisi klien dan interaksi dinamis menggunakan JavaScript.', 'Modul 5', 'jobsheet-05/index.html'],
    ['06', 'Jobsheet 06', 'Manipulasi DOM (Document Object Model) dan penanganan event handling tingkat lanjut.', 'Modul 6', 'jobsheet-06/index.html'],
    ['07', 'Jobsheet 07', 'Pengantar pemrograman web sisi server menggunakan PHP, struktur kontrol, dan penanganan variabel.', 'Modul 7', 'jobsheet-07/'],
    ['08', 'Jobsheet 08', 'Koneksi database menggunakan PostgreSQL dan mengubah isi konten.', 'Modul 8', 'jobsheet-08/'],
    ['09', 'Jobsheet 09', 'CRUD lanjutan: edit dan hapus data, konfirmasi hapus dengan JavaScript, serta pagination dan pencarian sisi server.', 'Modul 9', 'jobsheet-09/'],
    ['10', 'Jobsheet 10', 'Autentikasi dan manajemen sesi: registrasi, login, logout, dan penguncian halaman dengan PHP.', 'Modul 10', 'jobsheet-10/'],
];
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio Desain Pemrograman Web - Jobsheet 01 s/d 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0b1310;
        }

        .emas {
            color: #c2a468;
        }

        .nomor {
            width: 3.5rem;
            flex-shrink: 0;
        }

        .list-group {
            --bs-list-group-bg: transparent;
            --bs-list-group-action-hover-bg: rgba(194, 164, 104, 0.1);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <main class="container flex-grow-1 py-5">
        <div class="row g-5">

            <header class="col-lg-5">
                <p class="mb-0">Daffa Rajendra Maulana <em>TI-2D</em></p>
                <p>254107020181</p>
                <h1 class="display-4">Desain <span class="emas fst-italic">Pemrograman Web</span></h1>
                <p class="text-secondary">Kumpulan hasil praktikum, tugas, dan modul Jobsheet 01 sampai 10.</p>
            </header>

            <nav class="col-lg-7">
                <div class="list-group list-group-flush border-top">
                    <?php foreach ($jobsheet as [$nomor, $judul, $deskripsi, $tag, $link]): ?>
                    <a href="<?= $link ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-4">
                        <span class="nomor emas fs-2 fst-italic"><?= $nomor ?></span>
                        <div class="flex-grow-1">
                            <h2 class="fs-4"><?= $judul ?></h2>
                            <p class="text-secondary small mb-0"><?= $deskripsi ?></p>
                        </div>
                        <span class="badge rounded-pill border emas"><?= $tag ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </nav>

        </div>
    </main>

    <footer class="border-top text-center text-secondary small py-4">
        &copy; <?= date('Y') ?> Praktikum Desain Pemrograman Web
    </footer>

</body>
</html>
