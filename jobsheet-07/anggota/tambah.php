<?php
$page_title = "Tambah Anggota";
$active = "anggota-tambah";
include __DIR__ . '/../includes/header.php';
?>
        <?php tampilkanFlash(); ?>

        <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= e(old('nama')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_anggota" class="form-label fw-semibold">No. Anggota</label>
                <input type="text" class="form-control" id="no_anggota" name="no_anggota" value="<?= e(old('no_anggota')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label fw-semibold">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= e(old('alamat')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= e(old('no_hp')) ?>" required>
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
