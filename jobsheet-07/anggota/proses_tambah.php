<?php
require __DIR__ . '/../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambah.php');
}

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');

// Validasi server-side: tetap berjalan walau JavaScript dimatikan atau request dikirim manual.
$errors = [];

if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}
if ($noAnggota === '') {
    $errors[] = 'No. Anggota wajib diisi.';
} elseif (in_array($noAnggota, array_column($_SESSION['anggota'] ?? [], 'no_anggota'), true)) {
    $errors[] = 'No. Anggota sudah terdaftar.';
}
if ($alamat === '') {
    $errors[] = 'Alamat wajib diisi.';
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

$_SESSION['anggota'][] = [
    'no_anggota' => $noAnggota,
    'nama' => $nama,
    'alamat' => $alamat,
    'no_hp' => $noHp,
    'email' => $email,
    'tanggal_bergabung' => time(),
];

setFlash('success', 'Anggota "' . $nama . '" berhasil ditambahkan.');
redirect('list.php');
