<?php
$page_title = "Edit Peminjam";
$active = "peminjam-list";
require_once __DIR__ . '/../includes/helpers.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$peminjam = ($id !== false && $id !== null) ? ($_SESSION['peminjam'][$id] ?? null) : null;

if ($peminjam === null) {
    setFlash('error', 'Data peminjam tidak ditemukan.');
    redirect('list.php');
}

include __DIR__ . '/../includes/header.php';


$statusSekarang = old('status', $peminjam['status']);
$daftarStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];
?>
        <h2>Edit Peminjam</h2>

        <?php tampilkanFlash(); ?>

        <form id="form-tambah" method="post" action="proses_edit.php" novalidate>
            <input type="hidden" name="id" value="<?= (int) $id ?>">
            <div class="mb-3">
                <label for="nim" class="form-label fw-semibold">NIM / NIP</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= e(old('nim', $peminjam['nim'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= e(old('nama', $peminjam['nama'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select id="status" name="status" class="form-select">
                    <?php foreach ($daftarStatus as $nilai => $label): ?>
                    <option value="<?= $nilai ?>"<?= $statusSekarang === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label fw-semibold">Prodi / Unit</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="<?= e(old('prodi', $peminjam['prodi'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= e(old('no_hp', $peminjam['no_hp'])) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= e(old('email', $peminjam['email'])) ?>" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn" style="background-color:#1d5b8a; color:#fff;">Simpan Perubahan</button>
                <a href="list.php" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
