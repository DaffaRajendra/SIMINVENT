<?php
$page_title = "Daftar Peminjam";
$active = "peminjam-list";
include __DIR__ . '/../includes/header.php';

$daftarPeminjam = $_SESSION['peminjam'] ?? [];
$labelStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];
?>
        <?php tampilkanFlash(); ?>

        <div class="search-box">
            <label for="search-input">Cari Nama Peminjam</label>
            <input type="text" id="search-input" placeholder="Ketik nama peminjam...">
        </div>
        <div class="table-responsive">
            <table>
            <thead style="background-color:#1d5b8a;">
                    <tr class="text-white">
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
                    <td colspan="7" class="text-center text-muted">Belum ada data peminjam. Silakan tambah lewat menu "Tambah Peminjam".</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($daftarPeminjam as $i => $peminjam): ?>
                <tr>
                    <td><?= e($peminjam['nim']) ?></td>
                    <td><?= e($peminjam['nama']) ?></td>
                    <td><?= e($labelStatus[$peminjam['status']] ?? $peminjam['status']) ?></td>
                    <td><?= e($peminjam['prodi']) ?></td>
                    <td><?= e($peminjam['no_hp']) ?></td>
                    <td><?= e($peminjam['email']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $i ?>" class="btn-edit">Edit</a>
                        <button type="button" class="btn-hapus" data-id="<?= $i ?>">Hapus</button>
                    </td>
                </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
