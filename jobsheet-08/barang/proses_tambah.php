<?php
require __DIR__ . '/../includes/helpers.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambah.php');
}

$kodeBarang = trim($_POST['kode_barang'] ?? '');
$namaBarang = trim($_POST['nama_barang'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$lokasi = trim($_POST['lokasi'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$kondisi = trim($_POST['kondisi'] ?? '');

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
    redirect('tambah.php');
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO barang (kode_barang, nama_barang, kategori, lokasi, stok, kondisi)
         VALUES (:kode_barang, :nama_barang, :kategori, :lokasi, :stok, :kondisi)'
    );
    $stmt->execute([
        'kode_barang'     => $kodeBarang,
        'nama_barang'     => $namaBarang,
        'kategori'        => $kategori,
        'lokasi'          => $lokasi,
        'stok'            => (int) $stok,
        'kondisi'         => $kondisi,
    ]);
} catch (PDOException $e) {
    $_SESSION['old'] = $_POST;

    if ($e->getCode() === '23505') {            // pelanggaran UNIQUE (kode_barang)
        setFlash('error', 'Kode barang sudah dipakai, gunakan kode lain.');
    } else {
        error_log($e->getMessage());
        setFlash('error', 'Terjadi kesalahan pada database. Coba lagi nanti.');
    }
    redirect('tambah.php');
}

setFlash('success', 'Barang "' . $namaBarang . '" berhasil ditambahkan.');
redirect('list.php');
