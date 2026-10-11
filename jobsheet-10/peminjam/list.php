<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Daftar Peminjam";
$active = "peminjam-list";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$perPage = 5;
$keyword = trim($_GET['q'] ?? '');
$page = max(1, (int) ($_GET['page'] ?? 1));

$hitung = $pdo->prepare('SELECT COUNT(*) FROM peminjam WHERE nama ILIKE :kw');
$hitung->execute(['kw' => '%' . $keyword . '%']);
$totalRows = (int) $hitung->fetchColumn();

$totalPages = max(1, (int) ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$stmt = $pdo->prepare(
    'SELECT * FROM peminjam WHERE nama ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset'
);
$stmt->bindValue('kw', '%' . $keyword . '%');
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarPeminjam = $stmt->fetchAll(PDO::FETCH_ASSOC);

$awal = $totalRows === 0 ? 0 : $offset + 1;
$akhir = $offset + count($daftarPeminjam);
$labelStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];
$warnaStatus = ['mahasiswa' => 'primary', 'dosen' => 'success', 'petugas' => 'secondary'];

$crumb = ['Peminjam' => null];
$tombol = ['href' => 'tambah.php', 'teks' => 'Tambah Peminjam', 'ikon' => 'person-plus'];
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
                        <input type="text" id="search-input" name="q" class="form-control py-2" value="<?= e($keyword) ?>" placeholder="Cari nama peminjam..." aria-label="Cari nama peminjam">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>NIM / NIP</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Prodi / Unit</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarPeminjam)): ?>
                        <tr>
                            <?php if ($keyword !== ''): ?>
                            <td colspan="7" class="text-center text-secondary py-4">Data peminjam tidak ditemukan.</td>
                            <?php else: ?>
                            <td colspan="7" class="text-center text-secondary py-4">Belum ada data peminjam. <a href="tambah.php">Tambah peminjam pertama</a></td>
                            <?php endif; ?>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarPeminjam as $peminjam): ?>
                            <?php $wStatus = $warnaStatus[$peminjam['status']] ?? 'secondary'; ?>
                        <tr>
                            <td><?= e($peminjam['nim']) ?></td>
                            <td><?= e($peminjam['nama']) ?></td>
                            <td><span class="badge rounded-pill bg-<?= $wStatus ?>-subtle text-<?= $wStatus ?>-emphasis"><?= e($labelStatus[$peminjam['status']] ?? $peminjam['status']) ?></span></td>
                            <td><?= e($peminjam['prodi']) ?></td>
                            <td><?= e($peminjam['no_hp']) ?></td>
                            <td><?= e($peminjam['email']) ?></td>
                            <td class="text-nowrap">
                                <a href="edit.php?id=<?= (int) $peminjam['id'] ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i> Edit</a>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-id="<?= (int) $peminjam['id'] ?>"><i class="bi bi-trash"></i> Hapus</button>
                            </td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4">
                <p class="text-secondary small mb-0">Menampilkan <?= $awal ?>-<?= $akhir ?> dari <?= $totalRows ?> peminjam</p>
                <?php tampilkanPaginasi($page, $totalPages, $keyword); ?>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
