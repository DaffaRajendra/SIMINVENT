<?php
$page_title = "Edit Peminjam";
$active = "peminjam-list";
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/koneksi.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$peminjam = null;
if ($id !== false && $id !== null) {
    $stmt = $pdo->prepare('SELECT * FROM peminjam WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $peminjam = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

if ($peminjam === null) {
    setFlash('error', 'Data peminjam tidak ditemukan.');
    redirect('list.php');
}

include __DIR__ . '/../includes/header.php';

$statusSekarang = old('status', $peminjam['status']);
$daftarStatus = ['mahasiswa' => 'Mahasiswa', 'dosen' => 'Dosen', 'petugas' => 'Petugas'];

$crumb = ['Peminjam' => 'list.php', 'Edit' => null];
include __DIR__ . '/../includes/judul_halaman.php';
?>
<main class="container py-5 flex-grow-1">
    <?php tampilkanFlash(); ?>

    <div class="card">
        <div class="card-body p-4">
            <form id="form-tambah" method="post" action="proses_edit.php" novalidate>
                <input type="hidden" name="id" value="<?= (int) $id ?>">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nim" class="form-label fw-semibold">NIM / NIP</label>
                        <input type="text" class="form-control py-2" id="nim" name="nim" value="<?= e(old('nim', $peminjam['nim'])) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">Nama</label>
                        <input type="text" class="form-control py-2" id="nama" name="nama" value="<?= e(old('nama', $peminjam['nama'])) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select py-2">
                            <?php foreach ($daftarStatus as $nilai => $label): ?>
                            <option value="<?= $nilai ?>"<?= $statusSekarang === $nilai ? ' selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="prodi" class="form-label fw-semibold">Prodi / Unit</label>
                        <input type="text" class="form-control py-2" id="prodi" name="prodi" value="<?= e(old('prodi', $peminjam['prodi'])) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                        <input type="tel" class="form-control py-2" id="no_hp" name="no_hp" value="<?= e(old('no_hp', $peminjam['no_hp'])) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control py-2" id="email" name="email" value="<?= e(old('email', $peminjam['email'])) ?>" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="list.php" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
