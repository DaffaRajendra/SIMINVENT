<?php
require_once __DIR__ . '/helpers.php';

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

$active = $active ?? '';
function navActive($nama, $active)
{
    return $nama === $active ? ' active' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?= isset($page_title) ? ' | ' . e($page_title) : '' ?></title>
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark" style="background-color:#1d5b8a;">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="<?= $base ?>index.php">SIMPUS-Mini</a>
            <button class="navbar-toggler" type="button" id="nav-toggle-btn" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link<?= navActive('beranda', $active) ?>" href="<?= $base ?>index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('buku-list', $active) ?>" href="<?= $base ?>buku/list.php">List Buku</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('buku-tambah', $active) ?>" href="<?= $base ?>buku/tambah.php">Tambah Buku</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('anggota-list', $active) ?>" href="<?= $base ?>anggota/list.php">List Anggota</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('anggota-tambah', $active) ?>" href="<?= $base ?>anggota/tambah.php">Tambah Anggota</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
