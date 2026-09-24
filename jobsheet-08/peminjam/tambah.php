<?php
$page_title = "Tambah Peminjam";
$active = "peminjam-tambah";
include __DIR__ . '/../includes/header.php';

$statusLama = old('status');
$daftarStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];
?>
        <?php tampilkanFlash(); ?>

        <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
            <div class="mb-3">
                <label for="nim" class="form-label fw-semibold">NIM / NIP</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= e(old('nim')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= e(old('nama')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select id="status" name="status" class="form-select">
                    <?php foreach ($daftarStatus as $nilai => $label): ?>
                    <option value="<?= $nilai ?>"<?= $statusLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label fw-semibold">Prodi / Unit</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="<?= e(old('prodi')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= e(old('no_hp')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= e(old('email')) ?>" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn" style="background-color:#1d5b8a; color:#fff;">Simpan</button>
            </div>
        </form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
