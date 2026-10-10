<?php
$page_title = "Beranda";
$active = "beranda";
include __DIR__ . '/includes/header.php';

require __DIR__ . '/includes/koneksi.php';

$totalBarang   = (int) $pdo->query('SELECT COUNT(*) FROM barang')->fetchColumn();
$totalPeminjam = (int) $pdo->query('SELECT COUNT(*) FROM peminjam')->fetchColumn();
$totalStok     = (int) $pdo->query('SELECT COALESCE(SUM(stok), 0) FROM barang')->fetchColumn();
$barangRusak   = (int) $pdo->query("SELECT COUNT(*) FROM barang WHERE kondisi = 'rusak'")->fetchColumn();

$barangTerbaru = $pdo->query(
    'SELECT kode_barang, nama_barang, kondisi FROM barang ORDER BY dibuat_pada DESC LIMIT 3'
)->fetchAll(PDO::FETCH_ASSOC);
$warnaKondisi = ['baik' => 'success', 'rusak' => 'danger'];
?>
<div class="bg-white border-bottom py-4">
    <div class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <span class="badge rounded-pill bg-primary-subtle text-primary mb-3"><i class="bi bi-stars"></i> Inventaris Kampus</span>
                <h1 class="fw-bold fs-2">Kelola inventaris kampus <span class="text-primary">lebih rapi</span> dan cepat</h1>
                <p class="text-secondary mb-0">Catat barang, pantau stok, dan atur data peminjam dalam satu tempat yang sederhana.</p>
            </div>
            <a href="peminjam/tambah.php" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah Peminjam</a>
        </div>
    </div>
</div>

<main class="container py-5 flex-grow-1">
    <?php tampilkanFlash(); ?>

    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <a href="barang/list.php" class="card h-100 text-decoration-none shadow-sm">
                <div class="card-body p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary-subtle text-primary fs-5 mb-2 ikon-kotak"><i class="bi bi-box-seam"></i></div>
                    <div class="angka fs-1"><?= $totalBarang ?></div>
                    <div class="text-secondary small">Total Barang</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="peminjam/list.php" class="card h-100 text-decoration-none shadow-sm">
                <div class="card-body p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success-subtle text-success fs-5 mb-2 ikon-kotak"><i class="bi bi-people"></i></div>
                    <div class="angka fs-1"><?= $totalPeminjam ?></div>
                    <div class="text-secondary small">Total Peminjam</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="barang/list.php" class="card h-100 text-decoration-none shadow-sm">
                <div class="card-body p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning-subtle text-warning fs-5 mb-2 ikon-kotak"><i class="bi bi-stack"></i></div>
                    <div class="angka fs-1"><?= $totalStok ?></div>
                    <div class="text-secondary small">Total Stok</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="barang/list.php" class="card h-100 text-decoration-none shadow-sm">
                <div class="card-body p-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger-subtle text-danger fs-5 mb-2 ikon-kotak"><i class="bi bi-exclamation-triangle"></i></div>
                    <div class="angka fs-1"><?= $barangRusak ?></div>
                    <div class="text-secondary small">Barang Rusak</div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h6 fw-bold mb-0">Barang terbaru</h2>
                        <a href="barang/list.php" class="small fw-semibold text-decoration-none">Lihat semua <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($barangTerbaru)): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-secondary py-4">Belum ada barang. <a href="barang/tambah.php">Tambah barang pertama</a></td>
                                </tr>
                                <?php else: ?>
                                    <?php foreach ($barangTerbaru as $barang): ?>
                                <tr>
                                    <td><?= e($barang['kode_barang']) ?></td>
                                    <td><?= e($barang['nama_barang']) ?></td>
                                    <?php $warna = $warnaKondisi[$barang['kondisi']] ?? 'secondary'; ?>
                                    <td><span class="badge rounded-pill bg-<?= $warna ?>-subtle text-<?= $warna ?>-emphasis"><?= e(ucfirst($barang['kondisi'])) ?></span></td>
                                </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h2 class="h6 fw-bold mb-3">Aksi cepat</h2>
                    <div class="d-grid gap-2">
                        <a href="barang/tambah.php" class="btn btn-light text-start py-2"><i class="bi bi-plus-circle text-primary me-2"></i>Tambah Barang</a>
                        <a href="peminjam/tambah.php" class="btn btn-light text-start py-2"><i class="bi bi-person-plus text-primary me-2"></i>Tambah Peminjam</a>
                        <a href="barang/list.php" class="btn btn-light text-start py-2"><i class="bi bi-list-ul text-primary me-2"></i>Daftar Barang</a>
                        <a href="peminjam/list.php" class="btn btn-light text-start py-2"><i class="bi bi-people text-primary me-2"></i>Daftar Peminjam</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
