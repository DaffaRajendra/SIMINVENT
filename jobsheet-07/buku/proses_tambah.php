<?php
require __DIR__ . '/../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambah.php');
}

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = trim($_POST['tahun'] ?? '');
$isbn = trim($_POST['isbn'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');

// Validasi server-side: tetap berjalan walau JavaScript dimatikan atau request dikirim manual.
$tahunSekarang = (int) date('Y');
$errors = [];

if ($judul === '') {
    $errors[] = 'Judul wajib diisi.';
}
if ($pengarang === '') {
    $errors[] = 'Pengarang wajib diisi.';
}
if (filter_var($tahun, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1900, 'max_range' => $tahunSekarang]]) === false) {
    $errors[] = "Tahun terbit harus berupa angka antara 1900 dan $tahunSekarang.";
}
if ($isbn === '') {
    $errors[] = 'ISBN wajib diisi.';
} elseif (!preg_match('/^[0-9-]+$/', $isbn)) {
    $errors[] = 'ISBN hanya boleh berisi angka dan tanda hubung (-).';
}
if (filter_var($stok, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
    $errors[] = 'Stok harus berupa angka dan tidak boleh negatif.';
}
if (!in_array($kategori, ['fiksi', 'non-fiksi', 'referensi'], true)) {
    $errors[] = 'Kategori tidak valid.';
}

if (!empty($errors)) {
    $_SESSION['old'] = $_POST;
    setFlash('error', $errors);
    redirect('tambah.php');
}

$_SESSION['buku'][] = [
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
];

setFlash('success', 'Buku "' . $judul . '" berhasil ditambahkan.');
redirect('list.php');
