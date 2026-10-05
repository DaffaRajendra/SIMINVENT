<?php
require __DIR__ . '/../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambah.php');
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$status = trim($_POST['status'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');

// Validasi server-side: tetap berjalan walau JavaScript dimatikan atau request dikirim manual.
$errors = [];

if ($nim === '') {
    $errors[] = 'NIM / NIP wajib diisi.';
} elseif (!preg_match('/^[0-9]{8,20}$/', $nim)) {
    $errors[] = 'NIM / NIP hanya boleh berisi angka (8-20 digit).';
} elseif (in_array($nim, array_column($_SESSION['peminjam'] ?? [], 'nim'), true)) {
    $errors[] = 'NIM / NIP sudah terdaftar.';
}
if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}
if (!in_array($status, ['mahasiswa', 'dosen', 'petugas'], true)) {
    $errors[] = 'Status tidak valid.';
}
if ($prodi === '') {
    $errors[] = 'Prodi / Unit wajib diisi.';
}
if (!preg_match('/^[0-9+\-\s]{8,15}$/', $noHp)) {
    $errors[] = 'No. HP harus 8-15 karakter (angka, +, -).';
}
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Format email tidak valid.';
}

if (!empty($errors)) {
    $_SESSION['old'] = $_POST;
    setFlash('error', $errors);
    redirect('tambah.php');
}

$_SESSION['peminjam'][] = [
    'nim' => $nim,
    'nama' => $nama,
    'status' => $status,
    'prodi' => $prodi,
    'no_hp' => $noHp,
    'email' => $email,
    'tanggal_bergabung' => time(),
];

setFlash('success', 'Peminjam "' . $nama . '" berhasil ditambahkan.');
redirect('list.php');
