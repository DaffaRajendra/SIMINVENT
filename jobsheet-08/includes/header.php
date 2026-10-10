<?php
require_once __DIR__ . '/helpers.php';

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

$active = $active ?? '';
function navActive($menu, $active)
{
    return str_starts_with($active, $menu) ? ' active' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMINVENT-Mini<?= isset($page_title) ? ' | ' . e($page_title) : '' ?></title>
    <link rel="icon" href="<?= $base ?>assets/img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-0">
        <div class="container">
            <a class="navbar-brand sisi-navbar d-flex align-items-center fw-bold me-0 py-3" href="<?= $base ?>index.php">
                <img src="<?= $base ?>assets/img/logo.png" alt="Logo SIMINVENT" height="40" class="me-2">
                SIMINVENT<span class="text-primary fw-normal">-Mini</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link<?= navActive('beranda', $active) ?>" href="<?= $base ?>index.php"><i class="bi bi-house-door me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive('barang', $active) ?>" href="<?= $base ?>barang/list.php"><i class="bi bi-box-seam me-1"></i>Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive('peminjam', $active) ?>" href="<?= $base ?>peminjam/list.php"><i class="bi bi-people me-1"></i>Peminjam</a>
                    </li>
                </ul>
                <div class="sisi-navbar text-lg-end d-grid d-lg-block pb-3 pb-lg-0">
                    <a class="btn btn-outline-primary rounded-pill" href="<?= $base ?>barang/tambah.php"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
                </div>
            </div>
        </div>
    </nav>
