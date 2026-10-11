<?php
require __DIR__ . '/../includes/helpers.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('list.php');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    setFlash('error', 'Data peminjam tidak ditemukan.');
    redirect('list.php');
}

$stmt = $pdo->prepare('SELECT nama FROM peminjam WHERE id = :id');
$stmt->execute(['id' => $id]);
$nama = $stmt->fetchColumn();

if ($nama === false) {
    setFlash('error', 'Data peminjam tidak ditemukan.');
    redirect('list.php');
}

$pdo->prepare('DELETE FROM peminjam WHERE id = :id')->execute(['id' => $id]);

setFlash('success', 'Peminjam "' . $nama . '" berhasil dihapus.');
redirect('list.php');
