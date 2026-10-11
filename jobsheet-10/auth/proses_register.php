<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('register.php');
}

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];
if ($nama === '') {
    $errors[] = 'Nama wajib diisi.';
}
if ($username === '') {
    $errors[] = 'Username wajib diisi.';
}
if (strlen($password) < 6) {
    $errors[] = 'Password minimal 6 karakter.';
}

if (!empty($errors)) {
    setFlash('error', $errors);
    redirect('register.php');
}

$cek = $pdo->prepare('SELECT id FROM users WHERE username = :username');
$cek->execute(['username' => $username]);
if ($cek->fetch()) {
    setFlash('error', 'Username sudah digunakan.');
    redirect('register.php');
}

$stmt = $pdo->prepare(
    "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')"
);
$stmt->execute([
    'nama' => $nama,
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT),
]);

setFlash('success', 'Registrasi berhasil, silakan login.');
redirect('login.php');