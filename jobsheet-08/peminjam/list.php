<?php
$page_title = "Daftar Peminjam";
$active = "peminjam-list";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$daftarPeminjam = $pdo->query('SELECT * FROM peminjam ORDER BY nama')->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="search-input" class="form-control py-2" placeholder="Cari nama peminjam..." aria-label="Cari nama peminjam">
                    </div>
                </div>
            </div>

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
                        <tr class="baris-pesan">
                            <td colspan="7" class="text-center text-secondary py-4">Belum ada data peminjam. <a href="tambah.php">Tambah peminjam pertama</a></td>
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
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
