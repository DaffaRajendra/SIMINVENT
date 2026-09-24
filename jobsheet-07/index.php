<?php
$page_title = "Beranda";
$active = "beranda";
include __DIR__ . '/includes/header.php';

$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
?>
            <div class="container">
            <section class="my-4">
                <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
                <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
            </section>

            <section class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="card-title mb-3" style="color:#1d5b8a;">Ringkasan</h2>
                    <div class="row g-3 text-center">
                        <div class="col-12 col-md-3">
                            <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                                <h3 class="h6 text-secondary">Total Buku</h3>
                                <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;"><?= $totalBuku ?></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                                <h3 class="h6 text-secondary">Total Anggota</h3>
                                <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;"><?= $totalAnggota ?></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                                <h3 class="h6 text-secondary">Sedang Dipinjam</h3>
                                <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;">3</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                                <h3 class="h6 text-secondary">Buku Terlambat</h3>
                                <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;">5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php include __DIR__ . '/includes/footer.php'; ?>
