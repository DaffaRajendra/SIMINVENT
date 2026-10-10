<?php
$page_title = "Tambah Barang";
$active = "barang-tambah";
include __DIR__ . '/../includes/header.php';

$kategoriLama = old('kategori');
$kondisiLama = old('kondisi');
$daftarKategori = ['perabotan' => 'Perabotan', 'elektronik' => 'Elektronik'];
$daftarKondisi = ['baik' => 'Baik', 'rusak' => 'Rusak'];

$crumb = ['Barang' => 'list.php', 'Tambah' => null];
include __DIR__ . '/../includes/judul_halaman.php';
?>
<main class="container py-5 flex-grow-1">
    <?php tampilkanFlash(); ?>

    <div class="card">
        <div class="card-body p-4">
            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                        <input type="text" class="form-control py-2" id="kode_barang" name="kode_barang" value="<?= e(old('kode_barang')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" class="form-control py-2" id="nama_barang" name="nama_barang" value="<?= e(old('nama_barang')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select id="kategori" name="kategori" class="form-select py-2">
                            <?php foreach ($daftarKategori as $nilai => $label): ?>
                            <option value="<?= $nilai ?>"<?= $kategoriLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                        <input type="text" class="form-control py-2" id="lokasi" name="lokasi" value="<?= e(old('lokasi')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="stok" class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control py-2" id="stok" name="stok" min="0" value="<?= e(old('stok')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kondisi" class="form-label fw-semibold">Kondisi</label>
                        <select id="kondisi" name="kondisi" class="form-select py-2">
                            <?php foreach ($daftarKondisi as $nilai => $label): ?>
                            <option value="<?= $nilai ?>"<?= $kondisiLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="list.php" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
