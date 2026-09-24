<?php
require __DIR__ . '/../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('list.php');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null || !isset($_SESSION['barang'][$id])) {
    setFlash('error', 'Data barang tidak ditemukan.');
    redirect('list.php');
}

$nama = $_SESSION['barang'][$id]['nama_barang'];
unset($_SESSION['barang'][$id]);

setFlash('success', 'Barang "' . $nama . '" berhasil dihapus.');
redirect('list.php');
