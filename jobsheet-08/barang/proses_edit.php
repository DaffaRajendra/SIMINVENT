<?php
require __DIR__ . '/../includes/helpers.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('list.php');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    setFlash('error', 'Data barang tidak ditemukan.');
    redirect('list.php');
}

$kodeBarang = trim($_POST['kode_barang'] ?? '');
$namaBarang = trim($_POST['nama_barang'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$lokasi = trim($_POST['lokasi'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$kondisi = trim($_POST['kondisi'] ?? '');

// Validasi server-side (aturan sama dengan proses_tambah.php)
$errors = [];

if ($kodeBarang === '') {
    $errors[] = 'Kode Barang wajib diisi.';
} elseif (!preg_match('/^[A-Za-z0-9-]+$/', $kodeBarang)) {
    $errors[] = 'Kode Barang hanya boleh berisi huruf, angka, dan tanda hubung (-).';
}
if ($namaBarang === '') {
    $errors[] = 'Nama Barang wajib diisi.';
}
if (!in_array($kategori, ['perabotan', 'elektronik'], true)) {
    $errors[] = 'Kategori tidak valid.';
}
if ($lokasi === '') {
    $errors[] = 'Lokasi wajib diisi.';
}
if (filter_var($stok, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
    $errors[] = 'Stok harus berupa angka dan tidak boleh negatif.';
}
if (!in_array($kondisi, ['baik', 'rusak'], true)) {
    $errors[] = 'Kondisi tidak valid.';
}

if (!empty($errors)) {
    $_SESSION['old'] = $_POST;
    setFlash('error', $errors);
    redirect('edit.php?id=' . $id);
}

try {
    $stmt = $pdo->prepare(
        'UPDATE barang
         SET kode_barang = :kode_barang, nama_barang = :nama_barang, kategori = :kategori,
             lokasi = :lokasi, stok = :stok, kondisi = :kondisi
         WHERE id = :id'
    );
    $stmt->execute([
        'kode_barang'     => $kodeBarang,
        'nama_barang'     => $namaBarang,
        'kategori'        => $kategori,
        'lokasi'          => $lokasi,
        'stok'            => (int) $stok,
        'kondisi'         => $kondisi,
        'id'              => $id,
    ]);
} catch (PDOException $e) {
    $_SESSION['old'] = $_POST;

    if ($e->getCode() === '23505') {            // pelanggaran UNIQUE (kode_barang)
        setFlash('error', 'Kode barang sudah dipakai, gunakan kode lain.');
    } else {
        error_log($e->getMessage());
        setFlash('error', 'Terjadi kesalahan pada database. Coba lagi nanti.');
    }
    redirect('edit.php?id=' . $id);
}

setFlash('success', 'Barang "' . $namaBarang . '" berhasil diperbarui.');
redirect('list.php');
