<?php
require __DIR__ . '/../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambah.php');
}

$kodeBarang = trim($_POST['kode_barang'] ?? '');
$namaBarang = trim($_POST['nama_barang'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$lokasi = trim($_POST['lokasi'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$tahunPengadaan = trim($_POST['tahun_pengadaan'] ?? '');
$kondisi = trim($_POST['kondisi'] ?? '');

// Validasi server-side: tetap berjalan walau JavaScript dimatikan atau request dikirim manual.
$tahunSekarang = (int) date('Y');
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
if (filter_var($tahunPengadaan, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1900, 'max_range' => $tahunSekarang]]) === false) {
    $errors[] = "Tahun Pengadaan harus berupa angka antara 1900 dan $tahunSekarang.";
}
if (!in_array($kondisi, ['baik', 'rusak'], true)) {
    $errors[] = 'Kondisi tidak valid.';
}

if (!empty($errors)) {
    $_SESSION['old'] = $_POST;
    setFlash('error', $errors);
    redirect('tambah.php');
}

$_SESSION['barang'][] = [
    'kode_barang' => $kodeBarang,
    'nama_barang' => $namaBarang,
    'kategori' => $kategori,
    'lokasi' => $lokasi,
    'stok' => (int) $stok,
    'tahun_pengadaan' => (int) $tahunPengadaan,
    'kondisi' => $kondisi,
];

setFlash('success', 'Barang "' . $namaBarang . '" berhasil ditambahkan.');
redirect('list.php');
