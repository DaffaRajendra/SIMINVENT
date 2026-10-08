<?php
$page_title = "Tambah Peminjam";
$active = "peminjam-tambah";
include __DIR__ . '/../includes/header.php';

$statusLama = old('status');
$daftarStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];
?>
        <?php tampilkanFlash(); ?>

        <div class="kartu-lembut form-lembut">
            <h2 class="judul-halaman">Tambah Peminjam</h2>

            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nim" class="form-label">NIM / NIP</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="<?= e(old('nim')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= e(old('nama')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <?php foreach ($daftarStatus as $nilai => $label): ?>
                            <option value="<?= $nilai ?>"<?= $statusLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="prodi" class="form-label">Prodi / Unit</label>
                        <input type="text" class="form-control" id="prodi" name="prodi" value="<?= e(old('prodi')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= e(old('no_hp')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= e(old('email')) ?>" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-lembut">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
