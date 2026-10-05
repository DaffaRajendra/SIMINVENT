<?php
require __DIR__ . '/../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('list.php');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null || !isset($_SESSION['peminjam'][$id])) {
    setFlash('error', 'Data peminjam tidak ditemukan.');
    redirect('list.php');
}

$nama = $_SESSION['peminjam'][$id]['nama'];
unset($_SESSION['peminjam'][$id]);

setFlash('success', 'Peminjam "' . $nama . '" berhasil dihapus.');
redirect('list.php');
