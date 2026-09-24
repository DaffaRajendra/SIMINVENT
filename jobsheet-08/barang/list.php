<?php
$page_title = "Daftar Barang";
$active = "barang-list";
include __DIR__ . '/../includes/header.php';

$daftarBarang = $_SESSION['barang'] ?? [];
?>
        <section>
            <h2>Daftar Barang</h2>

            <?php tampilkanFlash(); ?>

            <div class="search-box">
                <label for="search-input">Cari Nama Barang</label>
                <input type="text" id="search-input" placeholder="Ketik nama barang...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                <thead style="background-color:#1d5b8a;">
                    <tr class="text-white">
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Stok</th>
                        <th>Tahun Pengadaan</th>
                        <th>Kondisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBarang)): ?>
                    <tr class="baris-pesan">
                        <td colspan="8" class="text-center text-muted">Belum ada data barang. Silakan tambah lewat menu "Tambah Barang".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBarang as $i => $barang): ?>
                    <tr>
                        <td><?= e($barang['kode_barang']) ?></td>
                        <td><?= e($barang['nama_barang']) ?></td>
                        <td><?= e(ucfirst($barang['kategori'])) ?></td>
                        <td><?= e($barang['lokasi']) ?></td>
                        <td><?= e($barang['stok']) ?></td>
                        <td><?= e($barang['tahun_pengadaan']) ?></td>
                        <td><?= e(ucfirst($barang['kondisi'])) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $i ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="<?= $i ?>">Hapus</button>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
