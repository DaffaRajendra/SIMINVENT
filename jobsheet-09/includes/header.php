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
    <title>SIMINVENT-Mini<?= isset($page_title) ? ' | ' . e($page_title) : '' ?></title>
    <link rel="icon" href="<?= $base ?>assets/img/favicon.ico">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-semibold d-flex align-items-center" href="<?= $base ?>index.php">
                <img src="<?= $base ?>assets/img/logo.png" alt="Logo SIMINVENT" class="me-2">
                SIMINVENT<span class="brand-mini">-Mini</span>
            </a>
            <button class="navbar-toggler" type="button" id="nav-toggle-btn" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link<?= navActive('beranda', $active) ?>" href="<?= $base ?>index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('barang-list', $active) ?>" href="<?= $base ?>barang/list.php">List Barang</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('barang-tambah', $active) ?>" href="<?= $base ?>barang/tambah.php">Tambah Barang</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('peminjam-list', $active) ?>" href="<?= $base ?>peminjam/list.php">List Peminjam</a></li>
                    <li class="nav-item"><a class="nav-link<?= navActive('peminjam-tambah', $active) ?>" href="<?= $base ?>peminjam/tambah.php">Tambah Peminjam</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
