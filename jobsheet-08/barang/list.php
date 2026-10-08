<?php
$page_title = "Daftar Barang";
$active = "barang-list";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$q = trim($_GET['q'] ?? '');
$stmt = $pdo->prepare(
    'SELECT * FROM barang WHERE nama_barang ILIKE :keyword ORDER BY nama_barang'
);
$stmt->execute(['keyword' => '%' . $q . '%']);
$daftarBarang = $stmt->fetchAll(PDO::FETCH_ASSOC);

$warnaKategori = ['perabotan' => 'abu', 'elektronik' => 'biru'];
$warnaKondisi = ['baik' => 'hijau', 'rusak' => 'merah'];
?>
        <?php tampilkanFlash(); ?>

        <div class="kartu-lembut">
            <h2 class="judul-halaman">Daftar Barang</h2>

            <form method="get" class="toolbar-lembut">
                <input type="text" id="search-input" name="q" class="form-control cari-lembut" value="<?= e($q) ?>" placeholder="Cari nama barang..." aria-label="Cari nama barang">
            </form>

            <div class="table-responsive">
                <table class="tabel-lembut">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th>Ditambahkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBarang)): ?>
                    <tr class="baris-pesan">
                        <td colspan="8" class="text-center text-muted">Data barang tidak ditemukan.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBarang as $barang): ?>
                    <tr>
                        <td><?= e($barang['kode_barang']) ?></td>
                        <td><?= e($barang['nama_barang']) ?></td>
                        <td><span class="lencana lencana-<?= $warnaKategori[$barang['kategori']] ?? 'abu' ?>"><?= e(ucfirst($barang['kategori'])) ?></span></td>
                        <td><?= e($barang['lokasi']) ?></td>
                        <td><?= e($barang['stok']) ?></td>
                        <td><span class="lencana lencana-<?= $warnaKondisi[$barang['kondisi']] ?? 'abu' ?>"><?= e(ucfirst($barang['kondisi'])) ?></span></td>
                        <td><?= e(date('d-m-Y H:i', strtotime($barang['dibuat_pada']))) ?></td>
                        <td>
                            <a href="edit.php?id=<?= (int) $barang['id'] ?>" class="btn-aksi"><i class="bi bi-pencil"></i> Edit</a>
                            <button type="button" class="btn-hapus" data-id="<?= (int) $barang['id'] ?>"><i class="bi bi-trash"></i> Hapus</button>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
