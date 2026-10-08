<?php
$page_title = "Edit Barang";
$active = "barang-list";
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/koneksi.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$barang = null;
if ($id !== false && $id !== null) {
    $stmt = $pdo->prepare('SELECT * FROM barang WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $barang = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

if ($barang === null) {
    setFlash('error', 'Data barang tidak ditemukan.');
    redirect('list.php');
}

include __DIR__ . '/../includes/header.php';


$kategoriSekarang = old('kategori', $barang['kategori']);
$kondisiSekarang = old('kondisi', $barang['kondisi']);
$daftarKategori = ['perabotan' => 'Perabotan', 'elektronik' => 'Elektronik'];
$daftarKondisi = ['baik' => 'Baik', 'rusak' => 'Rusak'];
?>
        <h2>Edit Barang</h2>

        <?php tampilkanFlash(); ?>

        <form id="form-tambah" method="post" action="proses_edit.php" novalidate>
            <input type="hidden" name="id" value="<?= (int) $id ?>">
            <div class="mb-3">
                <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= e(old('kode_barang', $barang['kode_barang'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= e(old('nama_barang', $barang['nama_barang'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label fw-semibold">Kategori</label>
                <select id="kategori" name="kategori" class="form-select">
                    <?php foreach ($daftarKategori as $nilai => $label): ?>
                    <option value="<?= $nilai ?>"<?= $kategoriSekarang === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= e(old('lokasi', $barang['lokasi'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label fw-semibold">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" min="0" value="<?= e(old('stok', $barang['stok'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="kondisi" class="form-label fw-semibold">Kondisi</label>
                <select id="kondisi" name="kondisi" class="form-select">
                    <?php foreach ($daftarKondisi as $nilai => $label): ?>
                    <option value="<?= $nilai ?>"<?= $kondisiSekarang === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn" style="background-color:#1d5b8a; color:#fff;">Simpan Perubahan</button>
                <a href="list.php" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
