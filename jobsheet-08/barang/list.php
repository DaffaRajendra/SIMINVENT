<?php
$page_title = "Daftar Barang";
$active = "barang-list";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

// Pencarian di server (ILIKE = tidak peduli huruf besar/kecil)
$q = trim($_GET['q'] ?? '');
$stmt = $pdo->prepare(
    'SELECT * FROM barang WHERE nama_barang ILIKE :keyword ORDER BY nama_barang'
);
$stmt->execute(['keyword' => '%' . $q . '%']);
$daftarBarang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
        <section>
            <h2>Daftar Barang</h2>

            <?php tampilkanFlash(); ?>

            <form method="get" class="search-box">
                <label for="search-input">Cari Nama Barang</label>
                <input type="text" id="search-input" name="q" value="<?= e($q) ?>" placeholder="Ketik nama barang...">
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
            </form>
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
                        <th>Ditambahkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBarang)): ?>
                    <tr class="baris-pesan">
                        <td colspan="9" class="text-center text-muted">Data barang tidak ditemukan.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBarang as $barang): ?>
                    <tr>
                        <td><?= e($barang['kode_barang']) ?></td>
                        <td><?= e($barang['nama_barang']) ?></td>
                        <td><?= e(ucfirst($barang['kategori'])) ?></td>
                        <td><?= e($barang['lokasi']) ?></td>
                        <td><?= e($barang['stok']) ?></td>
                        <td><?= e($barang['tahun_pengadaan']) ?></td>
                        <td><?= e(ucfirst($barang['kondisi'])) ?></td>
                        <td><?= e(date('d-m-Y H:i', strtotime($barang['dibuat_pada']))) ?></td>
                        <td>
                            <a href="edit.php?id=<?= (int) $barang['id'] ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="<?= (int) $barang['id'] ?>">Hapus</button>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>