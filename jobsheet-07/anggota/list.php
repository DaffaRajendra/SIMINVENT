<?php
$page_title = "Daftar Anggota";
$active = "anggota-list";
include __DIR__ . '/../includes/header.php';

$daftarAnggota = $_SESSION['anggota'] ?? [];
?>
        <?php tampilkanFlash(); ?>

        <div class="search-box">
            <label for="search-input">Cari Nama Anggota</label>
            <input type="text" id="search-input" placeholder="Ketik nama anggota...">
        </div>
        <div class="table-responsive">
            <table>
            <thead>
                <tr>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarAnggota)): ?>
                <tr class="baris-pesan">
                    <td colspan="6" class="text-center text-muted">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($daftarAnggota as $anggota): ?>
                <tr>
                    <td><?= e($anggota['no_anggota']) ?></td>
                    <td><?= e($anggota['nama']) ?></td>
                    <td><?= e($anggota['alamat']) ?></td>
                    <td><?= e($anggota['no_hp']) ?></td>
                    <td><?= e(tanggalIndonesia($anggota['tanggal_bergabung'])) ?></td>
                    <td>
                        <button type="button" class="btn-edit">Edit</button>
                        <button type="button" class="btn-hapus">Hapus</button>
                    </td>
                </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
