<?php
$page_title = "Beranda";
$active = "beranda";
include __DIR__ . '/includes/header.php';

$totalBarang = count($_SESSION['barang'] ?? []);
$totalPeminjam = count($_SESSION['peminjam'] ?? []);
?>
<!-- Hero Section -->
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
    <!-- Panel Ringkasan Statistik -->
    <section class="panel mb-4">
        <h2>Ringkasan Statistik</h2>
        <!-- Menggunakan auto-fit agar otomatis menyesuaikan agar tidak turun ke bawah -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">            
            <!-- Total Barang -->
            <a href="barang/list.php" class="stat-card stat-biru">
                <div class="stat-ikon">📦</div>
                <div class="stat-angka">1</div>
                <div class="stat-label">Total Barang</div>
            </a>

            <!-- Total Peminjam -->
            <a href="peminjam/list.php" class="stat-card stat-teal">
                <div class="stat-ikon">👥</div>
                <div class="stat-angka">1</div>
                <div class="stat-label">Total Peminjam</div>
            </a>

            <!-- Sedang Dipinjam -->
            <div class="stat-card stat-amber">
                <div class="stat-ikon">⏳</div>
                <div class="stat-angka">4</div>
                <div class="stat-label">Sedang Dipinjam</div>
            </div>

            <!-- Barang Terlambat -->
            <div class="stat-card stat-merah">
                <div class="stat-ikon">⚠️</div>
                <div class="stat-angka">1</div>
                <div class="stat-label">Barang Terlambat</div>
            </div>
        </div>
    </section>

    <!-- Panel Aksi Cepat -->
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