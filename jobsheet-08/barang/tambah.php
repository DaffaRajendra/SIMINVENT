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

        <div class="kartu-lembut form-lembut">
            <h2 class="judul-halaman">Tambah Barang</h2>

            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= e(old('kode_barang')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= e(old('nama_barang')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-select">
                            <?php foreach ($daftarKategori as $nilai => $label): ?>
                            <option value="<?= $nilai ?>"<?= $kategoriLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= e(old('lokasi')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" min="0" value="<?= e(old('stok')) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select id="kondisi" name="kondisi" class="form-select">
                            <?php foreach ($daftarKondisi as $nilai => $label): ?>
                            <option value="<?= $nilai ?>"<?= $kondisiLama === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-lembut">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
