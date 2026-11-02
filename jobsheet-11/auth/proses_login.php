<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

csrf_verify();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Ganti session ID setelah login berhasil agar session fixation tidak bisa dipakai.
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
    redirect('../index.php');
}

setFlash('error', 'Username atau password salah.');
redirect('login.php');