<?php
require __DIR__ . '/../includes/helpers.php';
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('tambah.php');
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$status = trim($_POST['status'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');

$errors = [];

if ($nim === '') {
    $errors[] = 'NIM / NIP wajib diisi.';
} elseif (!preg_match('/^[0-9]{8,20}$/', $nim)) {
    $errors[] = 'NIM / NIP hanya boleh berisi angka (8-20 digit).';
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

try {
    $stmt = $pdo->prepare(
        'INSERT INTO peminjam (nim, nama, status, prodi, no_hp, email)
         VALUES (:nim, :nama, :status, :prodi, :no_hp, :email)'
    );
    $stmt->execute([
        'nim'    => $nim,
        'nama'   => $nama,
        'status' => $status,
        'prodi'  => $prodi,
        'no_hp'  => $noHp,
        'email'  => $email,
    ]);
} catch (PDOException $e) {
    $_SESSION['old'] = $_POST;

    if ($e->getCode() === '23505') {            // pelanggaran UNIQUE (nim)
        setFlash('error', 'NIM / NIP sudah dipakai, gunakan nomor lain.');
    } else {
        error_log($e->getMessage());            // detail hanya masuk log server
        setFlash('error', 'Terjadi kesalahan pada database. Coba lagi nanti.');
    }
    redirect('tambah.php');
}

setFlash('success', 'Peminjam "' . $nama . '" berhasil ditambahkan.');
redirect('list.php');