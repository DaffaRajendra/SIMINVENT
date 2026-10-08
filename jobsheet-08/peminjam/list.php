<?php
$page_title = "Daftar Peminjam";
$active = "peminjam-list";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$daftarPeminjam = $pdo->query('SELECT * FROM peminjam ORDER BY nama')->fetchAll(PDO::FETCH_ASSOC);
$labelStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];
$warnaStatus = ['mahasiswa' => 'biru', 'dosen' => 'hijau', 'petugas' => 'abu'];
?>
        <?php tampilkanFlash(); ?>

        <div class="kartu-lembut">
            <h2 class="judul-halaman">Daftar Peminjam</h2>

            <div class="toolbar-lembut">
                <input type="text" id="search-input" class="form-control cari-lembut" placeholder="Cari nama peminjam..." aria-label="Cari nama peminjam">
            </div>

            <div class="table-responsive">
                <table class="tabel-lembut">
                <thead>
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
                        <td colspan="7" class="text-center text-muted">Belum ada data peminjam. Silakan tambah lewat menu "Tambah Peminjam".</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarPeminjam as $peminjam): ?>
                    <tr>
                        <td><?= e($peminjam['nim']) ?></td>
                        <td><?= e($peminjam['nama']) ?></td>
                        <td><span class="lencana lencana-<?= $warnaStatus[$peminjam['status']] ?? 'abu' ?>"><?= e($labelStatus[$peminjam['status']] ?? $peminjam['status']) ?></span></td>
                        <td><?= e($peminjam['prodi']) ?></td>
                        <td><?= e($peminjam['no_hp']) ?></td>
                        <td><?= e($peminjam['email']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= (int) $peminjam['id'] ?>" class="btn-aksi"><i class="bi bi-pencil"></i> Edit</a>
                            <button type="button" class="btn-hapus" data-id="<?= (int) $peminjam['id'] ?>"><i class="bi bi-trash"></i> Hapus</button>
                        </td>
                    </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
