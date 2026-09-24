<?php
$page_title = "Tambah Buku";
$active = "buku-tambah";
include __DIR__ . '/../includes/header.php';

$kategoriLama = old('kategori');
$daftarKategori = ['fiksi' => 'Fiksi', 'non-fiksi' => 'Non-Fiksi', 'referensi' => 'Referensi'];
?>
        <?php tampilkanFlash(); ?>

        <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
            <div class="mb-3">
                <label for="judul" class="form-label fw-semibold">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?= e(old('judul')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="pengarang" class="form-label fw-semibold">Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= e(old('pengarang')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label fw-semibold">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun" name="tahun" min="1900" max="<?= date('Y') ?>" value="<?= e(old('tahun')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label fw-semibold">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?= e(old('isbn')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label fw-semibold">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" min="0" value="<?= e(old('stok')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label fw-semibold">Kategori</label>
                <select id="kategori" name="kategori" class="form-select">
                    <?php foreach ($daftarKategori as $nilai => $label): ?>
                    <option value="<?= $nilai ?>"<?= $kategoriLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn" style="background-color:#1d5b8a; color:#fff;">Simpan</button>
            </div>
        </form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
