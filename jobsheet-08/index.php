<?php
$page_title = "Beranda";
$active = "beranda";
include __DIR__ . '/includes/header.php';

require __DIR__ . '/includes/koneksi.php';

$totalBarang   = (int) $pdo->query('SELECT COUNT(*) FROM barang')->fetchColumn();
$totalPeminjam = (int) $pdo->query('SELECT COUNT(*) FROM peminjam')->fetchColumn();
$totalStok     = (int) $pdo->query('SELECT COALESCE(SUM(stok), 0) FROM barang')->fetchColumn();
$barangRusak   = (int) $pdo->query("SELECT COUNT(*) FROM barang WHERE kondisi = 'rusak'")->fetchColumn();
?>
<div class="hero">
    <div class="hero-inner">
        <h1>Sistem Inventaris Kampus Mini</h1>
        <p>Kelola data barang dan peminjam inventaris kampus dalam satu tempat dengan cepat dan terstruktur.</p>
        <div class="hero-actions">
            <a href="barang/tambah.php" class="btn btn-aksen btn-sm">Tambah Barang</a>
            <a href="peminjam/tambah.php" class="btn btn-garis btn-sm">Tambah Peminjam</a>
        </div>
    </div>
</div>

<main>
    <section class="panel mb-4">
        <h2>Ringkasan Statistik</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">            
            <a href="barang/list.php" class="stat-card stat-biru">
                <div class="stat-ikon">📦</div>
                <div class="stat-angka"><?= $totalBarang ?></div>
                <div class="stat-label">Total Barang</div>
            </a>

            <a href="peminjam/list.php" class="stat-card stat-teal">
                <div class="stat-ikon">👥</div>
                <div class="stat-angka"><?= $totalPeminjam ?></div>
                <div class="stat-label">Total Peminjam</div>
            </a>

            <a href="barang/list.php" class="stat-card stat-amber">
                <div class="stat-ikon">🗃️</div>
                <div class="stat-angka"><?= $totalStok ?></div>
                <div class="stat-label">Total Stok</div>
            </a>

            <a href="barang/list.php" class="stat-card stat-merah">
                <div class="stat-ikon">⚠️</div>
                <div class="stat-angka"><?= $barangRusak ?></div>
                <div class="stat-label">Barang Rusak</div>
            </a>
        </div>
    </section>

    <section class="panel">
        <h2>Aksi Cepat</h2>
        <div class="aksi-grid">
            <a href="barang/tambah.php" class="aksi-item">
                <i>➕</i> Tambah Barang
            </a>
            <a href="peminjam/tambah.php" class="aksi-item">
                <i>👤</i> Tambah Peminjam
            </a>
            <a href="barang/list.php" class="aksi-item">
                <i>📋</i> Daftar Barang
            </a>
            <a href="peminjam/list.php" class="aksi-item">
                <i>👥</i> Daftar Peminjam
            </a>
        </div>
    </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>