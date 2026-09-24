<?php
$page_title = "Daftar Buku";
$active = "buku-list";
include __DIR__ . '/../includes/header.php';

$daftarBuku = $_SESSION['buku'] ?? [];
?>
        <section>
            <h2>Daftar Buku</h2>

            <?php tampilkanFlash(); ?>

            <div class="search-box">
                <label for="search-input">Cari Judul Buku</label>
                <input type="text" id="search-input" placeholder="Ketik judul buku...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                <thead style="background-color:#1d5b8a;">
                    <tr class="text-white">
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Stok</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBuku)): ?>
                    <tr class="baris-pesan">
                        <td colspan="5" class="text-center text-muted">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBuku as $buku): ?>
                    <tr>
                        <td><?= e($buku['judul']) ?></td>
                        <td><?= e($buku['pengarang']) ?></td>
                        <td><?= e($buku['stok']) ?></td>
                        <td><?= e($buku['tahun']) ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm text-white">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
