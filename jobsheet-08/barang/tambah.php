<?php
$page_title = "Tambah Barang";
$active = "barang-tambah";
include __DIR__ . '/../includes/header.php';

$kategoriLama = old('kategori');
$kondisiLama = old('kondisi');
$daftarKategori = ['perabotan' => 'Perabotan', 'elektronik' => 'Elektronik'];
$daftarKondisi = ['baik' => 'Baik', 'rusak' => 'Rusak'];
?>
        <?php tampilkanFlash(); ?>

        <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
            <div class="mb-3">
                <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= e(old('kode_barang')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= e(old('nama_barang')) ?>" required>
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
                <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= e(old('lokasi')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label fw-semibold">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" min="0" value="<?= e(old('stok')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="tahun_pengadaan" class="form-label fw-semibold">Tahun Pengadaan</label>
                <input type="number" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan" min="1900" max="<?= date('Y') ?>" value="<?= e(old('tahun_pengadaan')) ?>" required>
            </div>
            <div class="mb-3">
                <label for="kondisi" class="form-label fw-semibold">Kondisi</label>
                <select id="kondisi" name="kondisi" class="form-select">
                    <?php foreach ($daftarKondisi as $nilai => $label): ?>
                    <option value="<?= $nilai ?>"<?= $kondisiLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn" style="background-color:#1d5b8a; color:#fff;">Simpan</button>
            </div>
        </form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
