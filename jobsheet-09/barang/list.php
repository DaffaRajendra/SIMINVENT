<?php
$page_title = "Daftar Barang";
$active = "barang-list";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$perPage = 5;
$keyword = trim($_GET['q'] ?? '');
$page = max(1, (int) ($_GET['page'] ?? 1));

$hitung = $pdo->prepare('SELECT COUNT(*) FROM barang WHERE nama_barang ILIKE :kw');
$hitung->execute(['kw' => '%' . $keyword . '%']);
$totalRows = (int) $hitung->fetchColumn();

$totalPages = max(1, (int) ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare(
    'SELECT * FROM barang WHERE nama_barang ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset'
);
$stmt->bindValue('kw', '%' . $keyword . '%');
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarBarang = $stmt->fetchAll(PDO::FETCH_ASSOC);

$awal = $totalRows === 0 ? 0 : $offset + 1;
$akhir = $offset + count($daftarBarang);

$warnaKategori = ['perabotan' => 'secondary', 'elektronik' => 'primary'];
$warnaKondisi = ['baik' => 'success', 'rusak' => 'danger'];

$crumb = ['Barang' => null];
$tombol = ['href' => 'tambah.php', 'teks' => 'Tambah Barang', 'ikon' => 'plus-lg'];
include __DIR__ . '/../includes/judul_halaman.php';
?>
<main class="container py-5 flex-grow-1">
    <?php tampilkanFlash(); ?>

    <div class="card">
        <div class="card-body p-4">
            <form method="get" action="list.php" class="row mb-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="search-input" name="q" class="form-control py-2" value="<?= e($keyword) ?>" placeholder="Cari nama barang..." aria-label="Cari nama barang">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
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
                        <tr>
                            <td colspan="8" class="text-center text-secondary py-4"><?= $keyword !== '' ? 'Data barang tidak ditemukan.' : 'Belum ada data barang.' ?></td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarBarang as $barang): ?>
                            <?php $wKategori = $warnaKategori[$barang['kategori']] ?? 'secondary'; ?>
                            <?php $wKondisi = $warnaKondisi[$barang['kondisi']] ?? 'secondary'; ?>
                        <tr>
                            <td><?= e($barang['kode_barang']) ?></td>
                            <td><?= e($barang['nama_barang']) ?></td>
                            <td><span class="badge rounded-pill bg-<?= $wKategori ?>-subtle text-<?= $wKategori ?>-emphasis"><?= e(ucfirst($barang['kategori'])) ?></span></td>
                            <td><?= e($barang['lokasi']) ?></td>
                            <td><?= e($barang['stok']) ?></td>
                            <td><span class="badge rounded-pill bg-<?= $wKondisi ?>-subtle text-<?= $wKondisi ?>-emphasis"><?= e(ucfirst($barang['kondisi'])) ?></span></td>
                            <td><?= e(date('d-m-Y H:i', strtotime($barang['dibuat_pada']))) ?></td>
                            <td class="text-nowrap">
                                <a href="edit.php?id=<?= (int) $barang['id'] ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i> Edit</a>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-id="<?= (int) $barang['id'] ?>"><i class="bi bi-trash"></i> Hapus</button>
                            </td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4">
                <p class="text-secondary small mb-0">Menampilkan <?= $awal ?>-<?= $akhir ?> dari <?= $totalRows ?> barang</p>
                <?php tampilkanPaginasi($page, $totalPages, $keyword); ?>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
